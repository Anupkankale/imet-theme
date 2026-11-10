<?php
/**
 * One-time switch of the MBA and DBA pages to their own testimonials.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Patterns;

use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class SplitTestimonials
 *
 * Until 1.1.20 every page showed the one shared testimonials section ("Testimonials – Global"). The MBA and
 * DBA pages now have their own ("Testimonials – MBA / – DBA", see SyncedSections). The first time an
 * administrator opens wp-admin after the update, this points the pages saved earlier at their own section: a page
 * whose address has "mba" in it moves to the MBA one, "dba" or "doctorate" to the DBA one, every other page (Home)
 * keeps the Global one. Only that one block reference changes; WordPress keeps a revision of each page. It runs once.
 *
 * @since 1.1.20
 */
class SplitTestimonials implements Registrable {

	/**
	 * Option set once the switch has run.
	 *
	 * @since 1.1.20
	 * @var string
	 */
	public const OPTION = 'imet_testimonials_split';

	/**
	 * Version of the switch.
	 *
	 * @since 1.1.20
	 * @var string
	 */
	public const VERSION = '1';

	/**
	 * Register hooks.
	 *
	 * @since 1.1.20
	 */
	public function register_hooks(): void {
		add_action( 'admin_init', [ $this, 'maybe_split' ], 20 ); // After SyncedSections has made the sections (10).
	}

	/**
	 * Switch the pages once, when an administrator is in wp-admin and the three sections exist.
	 *
	 * @since 1.1.20
	 */
	public function maybe_split(): void {
		if ( self::VERSION === get_option( self::OPTION ) || ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		$from = SyncedSections::id( 'clients-testimonials' );
		$to   = [
			'mba' => SyncedSections::id( 'mba-testimonials' ),
			'dba' => SyncedSections::id( 'dba-testimonials' ),
		];

		if ( ! $from || in_array( 0, $to, true ) ) {
			return; // Try again on the next visit.
		}

		$this->split( $from, $to );
		update_option( self::OPTION, self::VERSION, false );
	}

	/**
	 * Point MBA and DBA pages at their own section.
	 *
	 * @since 1.1.20
	 *
	 * @param int                $from The Global section's ID.
	 * @param array<string, int> $to   Section ID by kind (mba, dba).
	 *
	 * @return array<int, string> Kind by page ID, for the pages changed.
	 */
	public function split( int $from, array $to ): array {
		$changed = [];
		$pages   = get_posts(
			[
				'post_type'   => 'page',
				'post_status' => [ 'publish', 'draft', 'pending', 'private', 'future' ],
				'numberposts' => -1,
			]
		);

		foreach ( $pages as $page ) {
			$kind = self::kind( (string) $page->post_name );

			if ( '' === $kind || empty( $to[ $kind ] ) ) {
				continue;
			}

			$content = self::swap( (string) $page->post_content, $from, (int) $to[ $kind ] );

			if ( $content === $page->post_content ) {
				continue;
			}

			$saved = wp_update_post(
				wp_slash(
					[
						'ID'           => $page->ID,
						'post_content' => $content,
					]
				),
				true
			);

			if ( ! is_wp_error( $saved ) ) {
				$changed[ (int) $page->ID ] = $kind;
			}
		}

		return $changed;
	}

	/**
	 * Which testimonials a page gets, from its address.
	 *
	 * @since 1.1.20
	 *
	 * @param string $slug Page slug.
	 *
	 * @return string 'mba', 'dba', or '' for the Global one.
	 */
	public static function kind( string $slug ): string {
		if ( 1 === preg_match( '/(^|-)mba(-|$)/', $slug ) ) {
			return 'mba';
		}

		return 1 === preg_match( '/(^|-)(dba|doctorate)(-|$)/', $slug ) ? 'dba' : '';
	}

	/**
	 * Change the synced pattern reference $from to $to, and nothing else.
	 *
	 * @since 1.1.20
	 *
	 * @param string $content Page content.
	 * @param int    $from    Old synced pattern ID.
	 * @param int    $to      New synced pattern ID.
	 *
	 * @return string The content.
	 */
	public static function swap( string $content, int $from, int $to ): string {
		return (string) preg_replace( '/(<!--\s+wp:block\s+\{"ref":)' . $from . '(?=[,}])/', '${1}' . $to, $content );
	}
}

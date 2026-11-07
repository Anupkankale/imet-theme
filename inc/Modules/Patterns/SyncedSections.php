<?php
/**
 * Shared sections as synced patterns: fix once, shown everywhere.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Patterns;

use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;
use WP_Block_Patterns_Registry;

/**
 * Class SyncedSections
 *
 * The sections that several pages share (offer banner, client testimonials, the closing call to action, achievements,
 * the career table) live in WordPress as synced patterns (Patterns > My patterns). Every page shows the same one, so an
 * edit made on any page, or in the pattern itself, changes all of them.
 *
 * The first time an administrator opens wp-admin, this creates each one from the theme's hidden source pattern. It
 * never updates or duplicates them afterwards (the team owns them from then on), and only recreates one that was
 * deleted for good. The page patterns use block() to place them.
 *
 * @since 1.1.5
 */
class SyncedSections implements Registrable {

	/**
	 * Option holding the synced pattern ID of each section.
	 *
	 * @since 1.1.5
	 * @var string
	 */
	public const OPTION = 'imet_synced_sections';

	/**
	 * Post meta that marks a synced pattern as a theme section (its value is the section key).
	 *
	 * @since 1.1.5
	 * @var string
	 */
	public const META = '_imet_section';

	/**
	 * The shared sections: key => title of the synced pattern and the theme pattern it starts from.
	 *
	 * @since 1.1.5
	 * @var array<string, array{title: string, pattern: string}>
	 */
	public const SECTIONS = [
		'offer-banner'         => [
			'title'   => 'Offer Banner',
			'pattern' => 'imet-theme/offer-banner',
		],
		'clients-testimonials' => [
			'title'   => 'Clients Testimonials',
			'pattern' => 'imet-theme/clients-testimonials',
		],
		'cta-next-chapter'     => [
			'title'   => 'CTA: Step Into Your Next Chapter',
			'pattern' => 'imet-theme/cta-next-chapter',
		],
		'achievements'         => [
			'title'   => 'Our Achievements',
			'pattern' => 'imet-theme/achievements',
		],
		'career-table'         => [
			'title'   => 'Career Table',
			'pattern' => 'imet-theme/career-table',
		],
	];

	/**
	 * Register hooks.
	 *
	 * @since 1.1.5
	 */
	public function register_hooks(): void {
		add_action( 'admin_init', [ $this, 'maybe_seed' ] );
		add_action( 'after_switch_theme', [ $this, 'maybe_seed' ] );
	}

	/**
	 * Create the missing sections, for administrators (their content is saved unfiltered, like the editor would).
	 *
	 * @since 1.1.5
	 */
	public function maybe_seed(): void {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		$ids = (array) get_option( self::OPTION, [] );

		foreach ( array_keys( self::SECTIONS ) as $key ) {
			if ( empty( $ids[ $key ] ) || ! get_post( (int) $ids[ $key ] ) ) {
				$this->seed();

				return;
			}
		}
	}

	/**
	 * Create every section that has no synced pattern yet.
	 *
	 * @since 1.1.5
	 *
	 * @return int Number of synced patterns created.
	 */
	public function seed(): int {
		$ids      = (array) get_option( self::OPTION, [] );
		$registry = WP_Block_Patterns_Registry::get_instance();
		$created  = 0;

		foreach ( self::SECTIONS as $key => $section ) {
			$existing = $this->find( $key );

			if ( $existing ) {
				$ids[ $key ] = $existing;
				continue;
			}

			$pattern = $registry->get_registered( $section['pattern'] );

			if ( ! $pattern || empty( $pattern['content'] ) ) {
				continue;
			}

			$id = wp_insert_post(
				wp_slash(
					[
						'post_type'    => 'wp_block',
						'post_status'  => 'publish',
						'post_title'   => $section['title'],
						'post_content' => (string) $pattern['content'],
						'meta_input'   => [ self::META => $key ],
					]
				),
				true
			);

			if ( is_wp_error( $id ) || ! $id ) {
				continue;
			}

			$ids[ $key ] = (int) $id;
			++$created;
		}

		update_option( self::OPTION, $ids, true );

		return $created;
	}

	/**
	 * The synced pattern ID of a section.
	 *
	 * @since 1.1.5
	 *
	 * @param string $key Section key.
	 *
	 * @return int Synced pattern ID, or 0 when it does not exist (yet).
	 */
	public static function id( string $key ): int {
		$ids = (array) get_option( self::OPTION, [] );
		$id  = (int) ( $ids[ $key ] ?? 0 );

		return $id && 'wp_block' === get_post_type( $id ) ? $id : 0;
	}

	/**
	 * Block markup that places a section in a page pattern: the synced pattern, or the theme's source pattern until
	 * the synced one exists (before an administrator has opened wp-admin).
	 *
	 * @since 1.1.5
	 *
	 * @param string $key Section key.
	 *
	 * @return string Block markup, or an empty string for an unknown section.
	 */
	public static function block( string $key ): string {
		if ( ! isset( self::SECTIONS[ $key ] ) ) {
			return '';
		}

		$id = self::id( $key );

		if ( $id ) {
			return '<!-- wp:block ' . wp_json_encode( [ 'ref' => $id ] ) . ' /-->';
		}

		return '<!-- wp:pattern ' . wp_json_encode( [ 'slug' => self::SECTIONS[ $key ]['pattern'] ], JSON_UNESCAPED_SLASHES ) . ' /-->';
	}

	/**
	 * Find the synced pattern already made for a section (also when the option was lost).
	 *
	 * @since 1.1.5
	 *
	 * @param string $key Section key.
	 *
	 * @return int Synced pattern ID, or 0.
	 */
	private function find( string $key ): int {
		$id = self::id( $key );

		if ( $id ) {
			return $id;
		}

		$found = get_posts(
			[
				'post_type'   => 'wp_block',
				'post_status' => 'any',
				'numberposts' => 1,
				'fields'      => 'ids',
				'meta_key'    => self::META, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- runs once, in wp-admin.
				'meta_value'  => $key, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value -- runs once, in wp-admin.
			]
		);

		return $found ? (int) $found[0] : 0;
	}
}

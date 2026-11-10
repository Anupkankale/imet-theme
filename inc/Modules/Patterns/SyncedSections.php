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
 * the career table, and every photo with labels on it) live in WordPress as synced patterns (Patterns > My patterns).
 * Every page shows the same one, so an edit made on any page, or in the pattern itself, changes all of them. The photo
 * sections ("photo-*") let each page override the photo and the label text (pattern overrides); their layout and
 * design stay shared.
 *
 * The first time an administrator opens wp-admin, this creates each one from the theme's hidden source pattern. It
 * never updates or duplicates them afterwards (the team owns them from then on), and only recreates one that was
 * deleted for good. The page patterns use block() to place them. They are filed under "IMET: Shared Sections
 * (reusable)" in the inserter and in Patterns.
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
	 * Option holding the version of the setup that last ran (bumped when existing sections need a one-time update).
	 *
	 * @since 1.1.6
	 * @var string
	 */
	public const VERSION_OPTION = 'imet_synced_sections_version';

	/**
	 * Setup version: 2 files every section under the shared category; 3 adds the photo sections; 4 adds the MBA and DBA
	 * testimonials and prefixes the testimonials' titles.
	 *
	 * @since 1.1.6
	 * @var string
	 */
	public const VERSION = '4';

	/**
	 * Pattern category (wp_pattern_category term) the shared sections are filed under in the inserter and Patterns.
	 *
	 * @since 1.1.6
	 * @var string
	 */
	public const CATEGORY = 'imet-shared';

	/**
	 * Post meta that marks a synced pattern as a theme section (its value is the section key).
	 *
	 * @since 1.1.5
	 * @var string
	 */
	public const META = '_imet_section';

	/**
	 * The shared sections: key => title of the synced pattern and the theme pattern it starts from. Optional:
	 * `copy` starts it as a copy of another section's synced pattern as the team has edited it (the theme pattern only
	 * when that one doesn't exist), `replace` swaps text in that copy, and `was` is an older title that is renamed to
	 * `title` (a title the team chose is kept).
	 *
	 * @since 1.1.5 The photo sections since 1.1.11; the MBA and DBA testimonials since 1.1.20.
	 * @var array<string, array{title: string, pattern: string, copy?: string, replace?: array<string, string>, was?: string}>
	 */
	public const SECTIONS = [
		'offer-banner'         => [
			'title'   => 'Offer Banner',
			'pattern' => 'imet-theme/offer-banner',
		],
		'clients-testimonials' => [
			'title'   => 'Testimonials – Global',
			'pattern' => 'imet-theme/clients-testimonials',
			'was'     => 'Clients Testimonials',
		],
		'mba-testimonials'     => [
			'title'   => 'Testimonials – MBA',
			'pattern' => 'imet-theme/mba-testimonials',
			'copy'    => 'clients-testimonials',
			'replace' => [ 'during their DBA doctor of business administration online experience' => 'during their online MBA experience' ],
		],
		'dba-testimonials'     => [
			'title'   => 'Testimonials – DBA',
			'pattern' => 'imet-theme/dba-testimonials',
			'copy'    => 'clients-testimonials',
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
		],		'photo-dba-requirements'        => [
			'title'   => 'Photo: DBA Eligibility Criteria',
			'pattern' => 'imet-theme/photo-dba-requirements',
		],
		'photo-dba-benefits'            => [
			'title'   => 'Photo: DBA Benefits',
			'pattern' => 'imet-theme/photo-dba-benefits',
		],
		'photo-dba-highlights'          => [
			'title'   => 'Photo: DBA Category Highlights',
			'pattern' => 'imet-theme/photo-dba-highlights',
		],
		'photo-dba-graduate'            => [
			'title'   => 'Photo: DBA Category Graduate',
			'pattern' => 'imet-theme/photo-dba-graduate',
		],
		'photo-mba-highlights'          => [
			'title'   => 'Photo: MBA Highlights',
			'pattern' => 'imet-theme/photo-mba-highlights',
		],
		'photo-mba-usp'                 => [
			'title'   => 'Photo: MBA USP',
			'pattern' => 'imet-theme/photo-mba-usp',
		],
		'photo-mba-course-highlights'   => [
			'title'   => 'Photo: MBA Course Highlights',
			'pattern' => 'imet-theme/photo-mba-course-highlights',
		],
		'photo-mba-course-requirements' => [
			'title'   => 'Photo: MBA Course Requirements',
			'pattern' => 'imet-theme/photo-mba-course-requirements',
		],
		'photo-mba-course-benefits'     => [
			'title'   => 'Photo: MBA Course Benefits',
			'pattern' => 'imet-theme/photo-mba-course-benefits',
		],
		'photo-location'                => [
			'title'   => 'Photo: Location Highlights',
			'pattern' => 'imet-theme/photo-location',
		],
		'photo-home-doctorate'          => [
			'title'   => 'Photo: Home Doctorate Tab',
			'pattern' => 'imet-theme/photo-home-doctorate',
		],
		'photo-home-mba'                => [
			'title'   => 'Photo: Home MBA Tab',
			'pattern' => 'imet-theme/photo-home-mba',
		],
		'photo-why-1'                   => [
			'title'   => 'Photo: Why Choose 1 (Research-Driven)',
			'pattern' => 'imet-theme/photo-why-1',
		],
		'photo-why-2'                   => [
			'title'   => 'Photo: Why Choose 2 (Affordable)',
			'pattern' => 'imet-theme/photo-why-2',
		],
		'photo-why-3'                   => [
			'title'   => 'Photo: Why Choose 3 (100% Online)',
			'pattern' => 'imet-theme/photo-why-3',
		],
		'photo-why-4'                   => [
			'title'   => 'Photo: Why Choose 4 (Mentoring)',
			'pattern' => 'imet-theme/photo-why-4',
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

		$ids     = (array) get_option( self::OPTION, [] );
		$missing = self::VERSION !== get_option( self::VERSION_OPTION );

		foreach ( array_keys( self::SECTIONS ) as $key ) {
			$missing = $missing || empty( $ids[ $key ] ) || ! get_post( (int) $ids[ $key ] );
		}

		if ( $missing ) {
			$this->seed();
			update_option( self::VERSION_OPTION, self::VERSION, false );
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
		$created  = 0;
		$category = $this->category();

		foreach ( self::SECTIONS as $key => $section ) {
			$existing = $this->find( $key );

			if ( $existing ) {
				$ids[ $key ] = $existing;
				$this->file( $existing, $category );
				$this->rename( $existing, $section );
				continue;
			}

			$content = $this->source( $section, $ids );

			if ( '' === $content ) {
				continue;
			}

			$id = wp_insert_post(
				wp_slash(
					[
						'post_type'    => 'wp_block',
						'post_status'  => 'publish',
						'post_title'   => $section['title'],
						'post_content' => $content,
						'meta_input'   => [ self::META => $key ],
					]
				),
				true
			);

			if ( is_wp_error( $id ) || ! $id ) {
				continue;
			}

			$ids[ $key ] = (int) $id;
			$this->file( (int) $id, $category );
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
	 * The shared sections' pattern category, created when missing.
	 *
	 * @since 1.1.6
	 *
	 * @return int Term ID, or 0 when it could not be created.
	 */
	/**
	 * What a new section starts with: a copy of another section's synced pattern (as edited), else the theme pattern.
	 *
	 * @param array<string, mixed> $section The section.
	 * @param array<string, mixed> $ids     Synced pattern IDs found so far, by key.
	 *
	 * @return string Block markup, or '' when there is none.
	 */
	private function source( array $section, array $ids ): string {
		$copy = isset( $section['copy'] ) ? get_post( (int) ( $ids[ (string) $section['copy'] ] ?? 0 ) ) : null;

		if ( $copy && 'wp_block' === $copy->post_type && '' !== $copy->post_content ) {
			$replace = (array) ( $section['replace'] ?? [] );

			return strtr( (string) $copy->post_content, array_map( 'strval', $replace ) );
		}

		$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( (string) $section['pattern'] );

		return $pattern && ! empty( $pattern['content'] ) ? (string) $pattern['content'] : '';
	}

	/**
	 * Give a section its current title when it still has the older one (a title the team chose is kept).
	 *
	 * @param int                  $id      Synced pattern ID.
	 * @param array<string, mixed> $section The section.
	 */
	private function rename( int $id, array $section ): void {
		if ( empty( $section['was'] ) || get_the_title( $id ) !== $section['was'] ) {
			return;
		}

		wp_update_post(
			wp_slash(
				[
					'ID'         => $id,
					'post_title' => (string) $section['title'],
				]
			)
		);
	}

	private function category(): int {
		$term = get_term_by( 'slug', self::CATEGORY, 'wp_pattern_category' );

		if ( $term ) {
			return (int) $term->term_id;
		}

		$made = wp_insert_term( __( 'IMET: Shared Sections (reusable)', 'imet-theme' ), 'wp_pattern_category', [ 'slug' => self::CATEGORY ] );

		return is_wp_error( $made ) ? 0 : (int) $made['term_id'];
	}

	/**
	 * Add a synced pattern to the shared category (keeping any category the team gave it).
	 *
	 * @since 1.1.6
	 *
	 * @param int $id      Synced pattern ID.
	 * @param int $term_id Category term ID.
	 */
	private function file( int $id, int $term_id ): void {
		if ( $term_id ) {
			wp_set_object_terms( $id, [ $term_id ], 'wp_pattern_category', true );
		}
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

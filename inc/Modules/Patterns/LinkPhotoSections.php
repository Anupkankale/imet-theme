<?php
/**
 * One-time link of saved pages to the synced photo sections.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Patterns;

use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class LinkPhotoSections
 *
 * Pages saved before the photo sections were synced keep their own copy: an old photo with labels drawn into it, or an
 * inline copy of the labelled section. `wp imet-theme link-photo-sections` swaps exactly those blocks for a reference to
 * the synced section, so later edits of that section reach the page. Everything else on the page stays as saved.
 *
 * It only reports by default; `--yes` saves (each page gets a revision, so a page can be rolled back on its own). It is
 * safe to run again: a linked page has nothing left to swap.
 *
 * The command lives in the theme because it links pages to the theme's own synced sections. If other data migrations
 * are added later, move it next to `wp imet migrate` in the imet-core plugin.
 *
 * @since 1.1.11
 */
class LinkPhotoSections implements Registrable {

	/**
	 * Old photos (file in assets/images/imet) => the synced section that replaces them. A file used in two places is
	 * keyed by its wrapper class as well (`slot:file`).
	 *
	 * @since 1.1.11
	 * @var array<string, string>
	 */
	public const PHOTOS = [
		'course-requirements.webp'        => 'photo-dba-requirements',
		'course-benefits.webp'            => 'photo-dba-benefits',
		'highlights.webp'                 => 'photo-dba-highlights',
		'graduate.webp'                   => 'photo-dba-graduate',
		'tab-photo:mba-highlights.jpg'    => 'photo-home-mba',
		'mba-highlights.jpg'              => 'photo-mba-highlights',
		'mba-usp.jpg'                     => 'photo-mba-usp',
		'mba-course-highlights.webp'      => 'photo-mba-course-highlights',
		'mba-course-requirements.webp'    => 'photo-mba-course-requirements',
		'mba-course-benefits.webp'        => 'photo-mba-course-benefits',
		'loc-highlights.jpg'              => 'photo-location',
		'home-tab-doctorate.webp'         => 'photo-home-doctorate',
		'home-why-1.webp'                 => 'photo-why-1',
		'home-why-2.webp'                 => 'photo-why-2',
		'home-why-3.webp'                 => 'photo-why-3',
		'home-why-4.webp'                 => 'photo-why-4',
	];

	/**
	 * Inline labelled sections (from the 1.1.10 page patterns) => the synced section. Keyed by a class of the group, or
	 * `slot:class` when the same section sits in two places.
	 *
	 * @since 1.1.11
	 * @var array<string, string>
	 */
	public const GROUPS = [
		'join-photo:has-chips'      => 'photo-dba-requirements',
		'ov-visual:has-chips'       => 'photo-dba-benefits',
		'is-pc-dba-hl'              => 'photo-dba-highlights',
		'is-pc-dba-grad'            => 'photo-dba-graduate',
		'tab-photo:is-pc-mba-hl'    => 'photo-home-mba',
		'is-pc-mba-hl'              => 'photo-mba-highlights',
		'is-pc-mba-usp'             => 'photo-mba-usp',
		'is-pc-mba-course-hl'       => 'photo-mba-course-highlights',
		'is-pc-mba-course-req'      => 'photo-mba-course-requirements',
		'is-pc-mba-course-ben'      => 'photo-mba-course-benefits',
		'is-pc-loc-hl'              => 'photo-location',
		'is-pc-home-tab'            => 'photo-home-doctorate',
		'is-pc-why-1'               => 'photo-why-1',
		'is-pc-why-2'               => 'photo-why-2',
		'is-pc-why-3'               => 'photo-why-3',
		'is-pc-why-4'               => 'photo-why-4',
	];

	/**
	 * Register the WP-CLI command (only under WP-CLI).
	 *
	 * @since 1.1.11
	 */
	public function register_hooks(): void {
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			\WP_CLI::add_command( 'imet-theme link-photo-sections', [ $this, 'run' ] );
		}
	}

	/**
	 * Link saved pages to the synced photo sections.
	 *
	 * ## OPTIONS
	 *
	 * [<id>...]
	 * : Only these posts or pages.
	 *
	 * [--yes]
	 * : Save the changes. Without it, the command only reports what it would change.
	 *
	 * ## EXAMPLES
	 *
	 *     wp imet-theme link-photo-sections
	 *     wp imet-theme link-photo-sections 247 --yes
	 *
	 * @since 1.1.11
	 *
	 * @param string[]             $args  Post IDs.
	 * @param array<string, mixed> $assoc Flags.
	 */
	public function run( array $args, array $assoc ): void {
		$save = ! empty( $assoc['yes'] );

		( new SyncedSections() )->seed(); // The synced sections must exist before pages can point at them.

		$ids = [];
		foreach ( array_keys( SyncedSections::SECTIONS ) as $key ) {
			$ids[ $key ] = SyncedSections::id( $key );
		}

		$posts = $args ? array_map( 'intval', $args ) : get_posts(
			[
				'post_type'   => [ 'page', 'post' ],
				'post_status' => [ 'publish', 'draft', 'pending', 'private', 'future' ],
				'numberposts' => -1,
				'fields'      => 'ids',
			]
		);
		$changed = 0;

		foreach ( $posts as $id ) {
			$post = get_post( (int) $id );

			if ( ! $post || ! in_array( $post->post_type, [ 'page', 'post' ], true ) ) {
				continue;
			}

			$result = self::link( (string) $post->post_content, $ids );

			if ( ! $result['linked'] ) {
				continue;
			}

			++$changed;
			\WP_CLI::log( sprintf( '#%d %s (%s): %s', $post->ID, $post->post_title, $post->post_status, implode( ', ', $result['linked'] ) ) );

			if ( $save ) {
				$saved = wp_update_post(
					wp_slash(
						[
							'ID'           => $post->ID,
							'post_content' => $result['content'],
						]
					),
					true
				);

				if ( is_wp_error( $saved ) ) {
					\WP_CLI::warning( sprintf( '#%d not saved: %s', $post->ID, $saved->get_error_message() ) );
				}
			}
		}

		if ( ! $changed ) {
			\WP_CLI::success( 'Nothing to link.' );
			return;
		}

		\WP_CLI::success( $save ? sprintf( 'Linked %d page(s). Each has a revision to roll back to.', $changed ) : sprintf( '%d page(s) would change. Run again with --yes to save.', $changed ) );
	}

	/**
	 * Swap the old photo blocks in some content for references to their synced sections.
	 *
	 * Only a block whose saved markup is found as is in the content is swapped, so the rest of the page is kept byte for
	 * byte.
	 *
	 * @since 1.1.11
	 *
	 * @param string             $content Post content.
	 * @param array<string, int> $ids     Section key => synced pattern ID (0 or missing = not linked).
	 *
	 * @return array{content: string, linked: string[]} The new content and the sections linked, in page order.
	 */
	public static function link( string $content, array $ids ): array {
		$linked = [];

		foreach ( self::targets( parse_blocks( $content ) ) as [ $block, $key ] ) {
			$id = (int) ( $ids[ $key ] ?? 0 );

			if ( ! $id ) {
				continue;
			}

			$markup = serialize_block( $block );
			$at     = strpos( $content, $markup );

			if ( false === $at ) {
				continue;
			}

			$content  = substr_replace( $content, '<!-- wp:block ' . wp_json_encode( [ 'ref' => $id ] ) . ' /-->', $at, strlen( $markup ) );
			$linked[] = $key;
		}

		return [
			'content' => $content,
			'linked'  => $linked,
		];
	}

	/**
	 * The blocks to swap, with their section key, in page order.
	 *
	 * @since 1.1.11
	 *
	 * @param array<array<string, mixed>> $blocks Parsed blocks (as parse_blocks() returns them).
	 *
	 * @return array<int, array{0: array<string, mixed>, 1: string}>
	 */
	private static function targets( array $blocks ): array {
		$found = [];

		foreach ( $blocks as $block ) {
			$key = self::key( $block );

			if ( $key ) {
				$found[] = [ $block, $key ];
				continue;
			}

			if ( ! empty( $block['innerBlocks'] ) ) {
				$found = array_merge( $found, self::targets( $block['innerBlocks'] ) );
			}
		}

		return $found;
	}

	/**
	 * The synced section a block stands for.
	 *
	 * @since 1.1.11
	 *
	 * @param array<string, mixed> $block Parsed block.
	 *
	 * @return string Section key, or an empty string.
	 */
	private static function key( array $block ): string {
		$classes = preg_split( '/\s+/', (string) ( $block['attrs']['className'] ?? '' ) ) ?: [];
		$slot    = (string) ( $classes[0] ?? '' );

		if ( 'core/image' === $block['blockName'] && preg_match( '#/images/imet/([A-Za-z0-9._-]+)"#', (string) $block['innerHTML'], $m ) ) {
			return self::PHOTOS[ $slot . ':' . $m[1] ] ?? self::PHOTOS[ $m[1] ] ?? '';
		}

		if ( 'core/group' === $block['blockName'] ) {
			foreach ( $classes as $class ) {
				$key = self::GROUPS[ $slot . ':' . $class ] ?? self::GROUPS[ $class ] ?? '';

				if ( $key ) {
					return $key;
				}
			}
		}

		return '';
	}
}

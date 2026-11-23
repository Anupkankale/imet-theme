<?php
/**
 * Page-specific stylesheets, loaded only on the pages that use them.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Blocks;

use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class PageStyles
 *
 * The styles of single pages (About, Alumni, Blog, a blog article, Contact, ...) used to be part of the shared
 * base.css, so every page downloaded all of them (~180 KB) before it could paint. Each one is now its own file
 * (`assets/build/blocks/shared/page-<name>.css`, built from `src/blocks-shared/_<name>.scss`) and loads only where it
 * is used: when a rendered IMET block carries a class that starts with that page's prefix (`ab-` for About,
 * `bp-` for a blog article, ...). Every selector in these files sits under `.imet-section` and names a class with the
 * prefix, so a page without the prefix can't be affected by the file.
 *
 * The cascade is unchanged: the shared styles are split into four always-loaded parts at the places where base.scss
 * used to include the page styles, and `imet-base` (the last part, which every block style depends on) gets its
 * dependencies in that original order with the page's own styles between them (see ORDER). The block editor gets
 * every page stylesheet.
 *
 * @since 1.1.94
 */
class PageStyles implements Registrable {

	/**
	 * Page stylesheet name => the class-name prefixes that mean the page uses it.
	 *
	 * @var array<string, list<string>>
	 */
	public const STYLES = [
		'contact-page'       => [ 'ct-' ],
		'alumni-page'        => [ 'al-' ],
		'blog-page'          => [ 'bl-' ],
		'blog-post'          => [ 'bp-' ],
		'accreditation-page' => [ 'ac-' ],
		'text-page'          => [ 'tp-' ],
		'testimonials-page'  => [ 'tm-' ],
		'success-stories'    => [ 'ss-' ],
		'case-studies'       => [ 'cs-' ],
		'convocation-page'   => [ 'cv-' ],
		'about-page'         => [ 'ab-', 'pm-' ],
		'photo-chips'        => [ 'photo-chips', 'pc-' ],
	];

	/**
	 * The always-loaded parts of the shared styles before `imet-base` (base-end.css): name => built file.
	 *
	 * @var array<string, string>
	 */
	public const BASE_PARTS = [
		'start'    => 'base.css',
		'sections' => 'base-sections.css',
		'dba'      => 'base-dba.css',
	];

	/**
	 * The cascade order base.scss used to have, before its end part (`imet-base`): `base:<part>` is a shared part (always
	 * loaded), anything else a page stylesheet (loaded where used).
	 *
	 * @var list<string>
	 */
	public const ORDER = [
		'base:start',
		'contact-page',
		'base:sections',
		'alumni-page',
		'blog-page',
		'blog-post',
		'accreditation-page',
		'text-page',
		'testimonials-page',
		'base:dba',
		'success-stories',
		'case-studies',
		'convocation-page',
		'about-page',
		'photo-chips',
	];

	/**
	 * Names of the page stylesheets the current page needs.
	 *
	 * @var array<string, true>
	 */
	private array $needed = [];

	/**
	 * Register hooks.
	 *
	 * @since 1.1.94
	 */
	public function register_hooks(): void {
		add_action( 'init', [ $this, 'register_styles' ] );
		add_filter( 'render_block', [ $this, 'collect' ], 10, 2 );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_needed' ], 20 );
		add_action( 'enqueue_block_assets', [ $this, 'enqueue_in_editor' ] );
	}

	/**
	 * Style handle for a page stylesheet.
	 *
	 * @since 1.1.94
	 *
	 * @param string $name Page stylesheet name.
	 *
	 * @return string Handle.
	 */
	public static function handle( string $name ): string {
		return 'imet-page-' . $name;
	}

	/**
	 * Handles of the always-loaded shared parts, in order (the default dependencies of `imet-base`).
	 *
	 * @since 1.1.94
	 *
	 * @return list<string> Handles.
	 */
	public static function base_handles(): array {
		return array_map( static fn ( string $part ): string => 'imet-base-' . $part, array_keys( self::BASE_PARTS ) );
	}

	/**
	 * Register the shared parts and every page stylesheet (with a path, so WordPress can inline the small ones).
	 *
	 * @since 1.1.94
	 */
	public function register_styles(): void {
		$files = [];

		foreach ( self::BASE_PARTS as $part => $file ) {
			$files[ 'imet-base-' . $part ] = $file;
		}

		foreach ( array_keys( self::STYLES ) as $name ) {
			$files[ self::handle( $name ) ] = 'page-' . $name . '.css';
		}

		foreach ( $files as $handle => $file ) {
			$path = IMET_PATH . '/assets/build/blocks/shared/' . $file;

			wp_register_style(
				$handle,
				get_theme_file_uri( 'assets/build/blocks/shared/' . $file ),
				[],
				file_exists( $path ) ? (string) filemtime( $path ) : null
			);
			wp_style_add_data( $handle, 'path', $path );
		}
	}

	/**
	 * Note which page stylesheets a rendered IMET block needs (the block template renders before wp_head).
	 *
	 * @since 1.1.94
	 *
	 * @param string               $content Rendered block HTML.
	 * @param array<string, mixed> $block   Parsed block.
	 *
	 * @return string The HTML, unchanged.
	 */
	public function collect( string $content, array $block ): string {
		if ( str_starts_with( (string) ( $block['blockName'] ?? '' ), 'imet/' ) ) {
			foreach ( $this->matches( $content ) as $name ) {
				$this->needed[ $name ] = true;
			}
		}

		return $content;
	}

	/**
	 * The page stylesheets the current page needs, in cascade order.
	 *
	 * @since 1.1.94
	 *
	 * @return list<string> Page stylesheet names.
	 */
	public function needed(): array {
		return array_values( array_filter( array_keys( self::STYLES ), fn ( string $name ): bool => isset( $this->needed[ $name ] ) ) );
	}

	/**
	 * The handles `imet-base` depends on for a set of page stylesheets: the shared parts and those page stylesheets, in
	 * the original cascade order.
	 *
	 * @since 1.1.94
	 *
	 * @param array<int, string> $names Page stylesheet names.
	 *
	 * @return list<string> Handles.
	 */
	public function dependencies( array $names ): array {
		$handles = [];

		foreach ( self::ORDER as $item ) {
			if ( str_starts_with( $item, 'base:' ) ) {
				$handles[] = 'imet-base-' . substr( $item, 5 );
			} elseif ( in_array( $item, $names, true ) ) {
				$handles[] = self::handle( $item );
			}
		}

		return $handles;
	}

	/**
	 * On a page with IMET blocks: give `imet-base` the page's stylesheets in cascade order, and enqueue them too
	 * (WordPress only inlines enqueued styles, not plain dependencies).
	 *
	 * @since 1.1.94
	 */
	public function enqueue_needed(): void {
		if ( wp_style_is( 'imet-base', 'enqueued' ) ) {
			$this->apply( $this->needed() );
		}
	}

	/**
	 * The block editor shows every kind of page: give it every page stylesheet.
	 *
	 * @since 1.1.94
	 */
	public function enqueue_in_editor(): void {
		if ( is_admin() ) {
			$this->apply( array_keys( self::STYLES ) );
		}
	}

	/**
	 * The page stylesheets whose prefix starts a class name in the HTML, in cascade order.
	 *
	 * @since 1.1.94
	 *
	 * @param string $html Rendered HTML.
	 *
	 * @return list<string> Page stylesheet names.
	 */
	public function matches( string $html ): array {
		if ( ! preg_match_all( '/\bclass=(["\'])(.*?)\1/s', $html, $attrs ) ) {
			return [];
		}

		$classes = preg_split( '/\s+/', implode( ' ', $attrs[2] ), -1, PREG_SPLIT_NO_EMPTY );
		$classes = is_array( $classes ) ? array_unique( $classes ) : [];
		$found   = [];

		foreach ( self::STYLES as $name => $prefixes ) {
			foreach ( $classes as $class ) {
				foreach ( $prefixes as $prefix ) {
					if ( str_starts_with( $class, $prefix ) ) {
						$found[] = $name;
						continue 3;
					}
				}
			}
		}

		return $found;
	}

	/**
	 * Set `imet-base`'s dependencies to the shared parts and the given page stylesheets, and enqueue them all.
	 *
	 * @param array<int, string> $names Page stylesheet names.
	 */
	private function apply( array $names ): void {
		$base = wp_styles()->query( 'imet-base' );

		if ( ! $base ) {
			return;
		}

		$base->deps = $this->dependencies( $names );

		foreach ( $base->deps as $handle ) {
			wp_enqueue_style( $handle );
		}
	}
}

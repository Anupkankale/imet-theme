<?php
/**
 * Print managed menus inside the header and footer template parts.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Menus;

use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class MenuRenderer
 *
 * The header and footer are edited in the Site Editor, but their links are managed in Appearance > Menus. A Navigation or
 * List block carrying the class `imet-menu-<location>` prints the menu assigned to that location instead of its own items.
 * With no menu assigned the block prints as saved, so nothing disappears.
 *
 * @since 1.2.0
 */
class MenuRenderer implements Registrable {

	/**
	 * Register hooks.
	 *
	 * @since 1.2.0
	 */
	public function register_hooks(): void {
		add_filter( 'render_block', [ $this, 'render' ], 10, 2 );
	}

	/**
	 * Replace the items of a block that is tied to a menu location.
	 *
	 * @since 1.2.0
	 *
	 * @param string               $content Rendered block HTML.
	 * @param array<string, mixed> $block   Parsed block.
	 *
	 * @return string The block HTML.
	 */
	public function render( string $content, array $block ): string {
		$name = (string) ( $block['blockName'] ?? '' );

		if ( 'core/navigation' !== $name && 'core/list' !== $name ) {
			return $content;
		}

		$location = $this->location( (string) ( $block['attrs']['className'] ?? '' ) );

		if ( '' === $location || ! has_nav_menu( $location ) ) {
			return $content;
		}

		return 'core/navigation' === $name ? $this->navigation( $content, $location ) : $this->list( $content, $location );
	}

	/**
	 * The menu location named by an `imet-menu-<location>` class.
	 *
	 * @since 1.2.0
	 *
	 * @param string $class_name Block class names.
	 *
	 * @return string The location, or an empty string.
	 */
	public function location( string $class_name ): string {
		return 1 === preg_match( '/(?:^|\s)imet-menu-([a-z0-9-]+)(?:\s|$)/', $class_name, $match ) ? $match[1] : '';
	}

	/**
	 * Swap the item list of a Navigation block, keeping its wrapper, toggle button and overlay.
	 *
	 * @since 1.2.0
	 *
	 * @param string $content  Rendered block HTML.
	 * @param string $location Menu location.
	 *
	 * @return string The block HTML.
	 */
	private function navigation( string $content, string $location ): string {
		// The item list is the <ul> carrying the `wp-block-navigation__container` class, wherever that class sits in the
		// attribute and whatever attributes come before it. MenuRendererTest renders a real Navigation block on every
		// WordPress version CI runs, so a change in core's markup fails a test instead of silently keeping the saved links.
		$pattern = '/<ul\b[^>]*\sclass="(?:[^"]*\s)?wp-block-navigation__container(?:\s[^"]*)?"[^>]*>/';

		if ( 1 !== preg_match( $pattern, $content, $match, PREG_OFFSET_CAPTURE ) ) {
			return $content;
		}

		$open_tag = $match[0][0];
		$start    = (int) $match[0][1];
		$end      = $this->closing_ul( $content, $start );

		if ( null === $end ) {
			return $content;
		}

		return substr( $content, 0, $start ) . $open_tag . $this->items( $location, 0 ) . '</ul>' . substr( $content, $end );
	}

	/**
	 * Replace a List block's items with the menu, keeping the list's own opening tag (classes, anchor, inline style).
	 *
	 * @since 1.2.0
	 *
	 * @param string $content  Rendered block HTML.
	 * @param string $location Menu location.
	 *
	 * @return string The list HTML.
	 */
	private function list( string $content, string $location ): string {
		$open_tag = 1 === preg_match( '/<ul\b[^>]*>/', $content, $match ) ? $match[0] : '<ul class="wp-block-list">';

		return $open_tag . $this->items( $location, 1, true ) . '</ul>';
	}

	/**
	 * Menu items as list markup.
	 *
	 * @since 1.2.0
	 *
	 * @param string $location Menu location.
	 * @param int    $depth    Levels to print (0 = all).
	 * @param bool   $plain    Use WordPress's default item markup.
	 *
	 * @return string The `<li>` items.
	 */
	private function items( string $location, int $depth, bool $plain = false ): string {
		$args = [
			'theme_location' => $location,
			'container'      => '',
			'items_wrap'     => '%3$s',
			'fallback_cb'    => false,
			'echo'           => false,
			'depth'          => $depth,
		];

		if ( ! $plain ) {
			$args['walker'] = new NavWalker();
		}

		$html = wp_nav_menu( $args );

		return is_string( $html ) ? $html : '';
	}

	/**
	 * Offset just past the `</ul>` that closes the list opened at `$start`.
	 *
	 * @since 1.2.0
	 *
	 * @param string $html  HTML.
	 * @param int    $start Offset of the opening `<ul`.
	 *
	 * @return int|null Offset after the closing tag, or null when unbalanced.
	 */
	private function closing_ul( string $html, int $start ): ?int {
		$depth  = 0;
		$offset = $start;

		while ( 1 === preg_match( '/<ul[\s>]|<\/ul>/', $html, $match, PREG_OFFSET_CAPTURE, $offset ) ) {
			$depth += '</ul>' === $match[0][0] ? -1 : 1;
			$offset = $match[0][1] + strlen( $match[0][0] );

			if ( 0 === $depth ) {
				return $offset;
			}
		}

		return null;
	}
}

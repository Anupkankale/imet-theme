<?php
/**
 * Navigation walker that prints the markup of the core Navigation block.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Menus;

use WP_HTML_Tag_Processor;
use Walker_Nav_Menu;

/**
 * Class NavWalker
 *
 * A menu managed in Appearance > Menus is printed with the same classes and Interactivity API attributes as the core
 * Navigation block, so the header's existing styles, dropdowns and mobile overlay keep working.
 *
 * The submenu directives are not written here: they differ between WordPress versions (6.6 uses
 * `data-wp-on-async--mouseenter`, 7.0 `data-wp-on--pointerenter`; 7.0 binds the toggle to `state.isMenuOpen`). They
 * are copied from a submenu that core itself renders, once per request, so they always match the running version.
 *
 * @since 1.2.0
 */
class NavWalker extends Walker_Nav_Menu {

	/**
	 * Interactivity attributes of core's submenu markup, by element (`li`, `button`, `ul`). Null until first read.
	 *
	 * @var array<string, array<string, string>>|null
	 */
	private static ?array $core_directives = null;

	/**
	 * The `data-wp-*` attributes (and the item's tabindex) that core puts on its own submenu `li`, toggle `button` and
	 * submenu `ul`, read from a Navigation block rendered by core.
	 *
	 * @since 1.2.1
	 *
	 * @return array<string, array<string, string>> Element => attribute name => value.
	 */
	public static function core_directives(): array {
		if ( null !== self::$core_directives ) {
			return self::$core_directives;
		}

		$html = do_blocks( '<!-- wp:navigation --><!-- wp:navigation-submenu {"label":"a","url":"#"} --><!-- wp:navigation-link {"label":"b","url":"#"} /--><!-- /wp:navigation-submenu --><!-- /wp:navigation -->' );
		$tags = new WP_HTML_Tag_Processor( $html );
		$read = [
			'li'     => 'wp-block-navigation-submenu',
			'button' => 'wp-block-navigation-submenu__toggle',
			'ul'     => 'wp-block-navigation__submenu-container',
		];

		self::$core_directives = [];

		foreach ( $read as $element => $class ) {
			$found = [];

			if ( $tags->next_tag(
				[
					'tag_name'   => $element,
					'class_name' => $class,
				]
			) ) {
				$names = (array) $tags->get_attribute_names_with_prefix( 'data-wp-' );

				if ( 'li' === $element ) {
					$names[] = 'tabindex';
				}

				foreach ( $names as $name ) {
					$value = $tags->get_attribute( $name );

					if ( is_string( $value ) ) {
						$found[ $name ] = $value;
					}
				}
			}

			self::$core_directives[ $element ] = $found;
		}

		return self::$core_directives;
	}

	/**
	 * Core's submenu attributes for one element, ready to print.
	 *
	 * @since 1.2.1
	 *
	 * @param string $element `li`, `button` or `ul`.
	 *
	 * @return string Attributes, each with a leading space.
	 */
	private function directives( string $element ): string {
		$attributes = '';

		foreach ( self::core_directives()[ $element ] ?? [] as $name => $value ) {
			$attributes .= ' ' . $name . '="' . esc_attr( $value ) . '"';
		}

		return $attributes;
	}

	/**
	 * Start a sub-menu list.
	 *
	 * @since 1.2.0
	 *
	 * @param string                              $output Output so far.
	 * @param int                                 $depth  Depth of the parent item.
	 * @param \stdClass|array<string, mixed>|null $args Menu arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ): void {
		$output .= '<ul' . $this->directives( 'ul' ) . ' class="wp-block-navigation__submenu-container wp-block-navigation-submenu">';
	}

	/**
	 * End a sub-menu list.
	 *
	 * @since 1.2.0
	 *
	 * @param string                              $output Output so far.
	 * @param int                                 $depth  Depth of the parent item.
	 * @param \stdClass|array<string, mixed>|null $args Menu arguments.
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ): void {
		$output .= '</ul>';
	}

	/**
	 * Start an item.
	 *
	 * @since 1.2.0
	 *
	 * @param string                                                                          $output Output so far.
	 * @param object{classes: array<int, string>, title: string, url: string, current?: bool} $data_object Menu item.
	 * @param int                                                                             $depth  Depth of the item.
	 * @param \stdClass|array<string, mixed>|null                                             $args Menu arguments.
	 * @param int                                                                             $current_object_id Current object ID.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ): void {
		$item      = $data_object;
		$has_child = in_array( 'menu-item-has-children', (array) $item->classes, true );
		$extra     = array_diff( array_filter( (array) $item->classes ), [ 'menu-item', 'menu-item-has-children' ] );
		// Drop WordPress's per-item ids and duplicate current_* spellings; keep the current-menu-* state classes so a parent of
		// the current page can be styled as active.
		$extra   = array_filter( $extra, static fn ( $css ) => ! str_starts_with( (string) $css, 'menu-item-' ) && ! str_starts_with( (string) $css, 'current_' ) && ! str_starts_with( (string) $css, 'current-page' ) );
		$classes = array_merge(
			[ 'wp-block-navigation-item' ],
			$has_child ? [ 'has-child', 'open-on-hover-click', 'wp-block-navigation-submenu' ] : [ 'wp-block-navigation-link' ],
			array_values( $extra )
		);

		$attributes = $has_child ? $this->directives( 'li' ) : '';

		$title   = esc_html( (string) $item->title );
		$href    = '' !== (string) $item->url && '#' !== (string) $item->url ? ' href="' . esc_url( (string) $item->url ) . '"' : '';
		$current = ! empty( $item->current ) ? ' aria-current="page"' : '';
		$link    = $href . $current . $this->link_attributes( $item );

		$output .= '<li' . $attributes . ' class="' . esc_attr( implode( ' ', $classes ) ) . '">';
		$output .= '<a class="wp-block-navigation-item__content"' . $link . '><span class="wp-block-navigation-item__label">' . $title . '</span></a>';

		if ( $has_child ) {
			$output .= '<button' . $this->directives( 'button' ) . ' aria-label="' . esc_attr( sprintf( /* translators: %s: menu item title */ __( '%s submenu', 'imet-theme' ), wp_strip_all_tags( (string) $item->title ) ) ) . '" class="wp-block-navigation__submenu-icon wp-block-navigation-submenu__toggle"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true" focusable="false"><path d="M1.50002 4L6.00002 8L10.5 4" stroke-width="1.5"></path></svg></button>';
		}
	}

	/**
	 * The target, rel and title set on the item in Appearance > Menus, as core's Walker_Nav_Menu prints them.
	 *
	 * @since 1.2.1
	 *
	 * @param object $item Menu item.
	 *
	 * @return string Attributes, each with a leading space.
	 */
	private function link_attributes( object $item ): string {
		$target = (string) ( $item->target ?? '' );
		$rel    = (string) ( $item->xfn ?? '' );
		$title  = (string) ( $item->attr_title ?? '' );

		// A new tab gets rel="noopener" unless the editor set a rel of their own, as in core.
		if ( '_blank' === $target && '' === $rel ) {
			$rel = 'noopener';
		}

		$attributes = '';

		foreach ( [
			'target' => $target,
			'rel'    => $rel,
			'title'  => $title,
		] as $name => $value ) {
			if ( '' !== $value ) {
				$attributes .= ' ' . $name . '="' . esc_attr( $value ) . '"';
			}
		}

		return $attributes;
	}

	/**
	 * End an item.
	 *
	 * @since 1.2.0
	 *
	 * @param string                                                                          $output Output so far.
	 * @param object{classes: array<int, string>, title: string, url: string, current?: bool} $data_object Menu item.
	 * @param int                                                                             $depth  Depth of the item.
	 * @param \stdClass|array<string, mixed>|null                                             $args Menu arguments.
	 */
	public function end_el( &$output, $data_object, $depth = 0, $args = null ): void {
		$output .= '</li>';
	}
}

<?php
/**
 * Navigation walker that prints the markup of the core Navigation block.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Menus;

use Walker_Nav_Menu;

/**
 * Class NavWalker
 *
 * A menu managed in Appearance > Menus is printed with the same classes and Interactivity API attributes as the core
 * Navigation block, so the header's existing styles, dropdowns and mobile overlay keep working.
 *
 * @since 1.2.0
 */
class NavWalker extends Walker_Nav_Menu {

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
		$output .= '<ul data-wp-on--focus="actions.openMenuOnFocus" class="wp-block-navigation__submenu-container wp-block-navigation-submenu">';
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
		$extra     = array_filter( $extra, static fn ( $css ) => ! str_starts_with( (string) $css, 'menu-item-' ) && ! str_starts_with( (string) $css, 'current-' ) && ! str_starts_with( (string) $css, 'current_' ) );
		$classes   = array_merge(
			[ 'wp-block-navigation-item' ],
			$has_child ? [ 'has-child', 'open-on-hover-click', 'wp-block-navigation-submenu' ] : [ 'wp-block-navigation-link' ],
			array_values( $extra )
		);

		$attributes = $has_child
			? ' data-wp-context="{ &quot;submenuOpenedBy&quot;: { &quot;click&quot;: false, &quot;hover&quot;: false, &quot;focus&quot;: false }, &quot;type&quot;: &quot;submenu&quot;, &quot;modal&quot;: null, &quot;previousFocus&quot;: null }" data-wp-interactive="core/navigation" data-wp-on--focusout="actions.handleMenuFocusout" data-wp-on--keydown="actions.handleMenuKeydown" data-wp-on--pointerenter="actions.openMenuOnHover" data-wp-on--pointerleave="actions.closeMenuOnHover" data-wp-watch="callbacks.initMenu" tabindex="-1"'
			: '';

		$title   = esc_html( (string) $item->title );
		$href    = '' !== (string) $item->url && '#' !== (string) $item->url ? ' href="' . esc_url( (string) $item->url ) . '"' : '';
		$current = ! empty( $item->current ) ? ' aria-current="page"' : '';

		$output .= '<li' . $attributes . ' class="' . esc_attr( implode( ' ', $classes ) ) . '">';
		$output .= '<a class="wp-block-navigation-item__content"' . $href . $current . '><span class="wp-block-navigation-item__label">' . $title . '</span></a>';

		if ( $has_child ) {
			$output .= '<button data-wp-bind--aria-expanded="state.isSubmenuOpen" data-wp-on--click="actions.toggleMenuOnClick" aria-label="' . esc_attr( sprintf( /* translators: %s: menu item title */ __( '%s submenu', 'imet-theme' ), wp_strip_all_tags( (string) $item->title ) ) ) . '" class="wp-block-navigation__submenu-icon wp-block-navigation-submenu__toggle"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true" focusable="false"><path d="M1.50002 4L6.00002 8L10.5 4" stroke-width="1.5"></path></svg></button>';
		}
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

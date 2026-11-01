<?php
/**
 * Tests for MenuRenderer.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Tests\Modules\Menus;

use IMET\Theme\Modules\Menus\MenuRenderer;
use WP_HTML_Tag_Processor;
use WP_UnitTestCase;

/**
 * Class MenuRendererTest
 *
 * @since 1.2.0
 */
class MenuRendererTest extends WP_UnitTestCase {

	/**
	 * The location is read from the class name.
	 *
	 * @since 1.2.0
	 */
	public function test_location_is_read_from_class(): void {
		$renderer = new MenuRenderer();

		$this->assertSame( 'footer-main', $renderer->location( 'imet-footer-list imet-menu-footer-main' ) );
		$this->assertSame( 'primary', $renderer->location( 'imet-menu-primary' ) );
		$this->assertSame( '', $renderer->location( 'imet-footer-list' ) );
	}

	/**
	 * A block without a menu assigned prints as saved.
	 *
	 * @since 1.2.0
	 */
	public function test_block_is_untouched_without_a_menu(): void {
		$html = '<ul class="wp-block-list imet-menu-footer-main"><li>Saved</li></ul>';
		$out  = ( new MenuRenderer() )->render(
			$html,
			[
				'blockName' => 'core/list',
				'attrs'     => [ 'className' => 'imet-menu-footer-main' ],
			]
		);

		$this->assertSame( $html, $out );
	}

	/**
	 * A list tied to an assigned menu prints the menu's items.
	 *
	 * @since 1.2.0
	 */
	public function test_list_prints_the_assigned_menu(): void {
		register_nav_menu( 'footer-main', 'Footer main' );

		$menu_id = wp_create_nav_menu( 'Footer test' );
		wp_update_nav_menu_item(
			$menu_id,
			0,
			[
				'menu-item-title'  => 'Managed link',
				'menu-item-url'    => 'https://example.org/managed/',
				'menu-item-type'   => 'custom',
				'menu-item-status' => 'publish',
			]
		);
		set_theme_mod( 'nav_menu_locations', [ 'footer-main' => $menu_id ] );

		$out = ( new MenuRenderer() )->render(
			'<ul class="wp-block-list imet-menu-footer-main"><li>Saved</li></ul>',
			[
				'blockName' => 'core/list',
				'attrs'     => [ 'className' => 'imet-menu-footer-main' ],
			]
		);

		$this->assertStringContainsString( 'Managed link', $out );
		$this->assertStringNotContainsString( 'Saved', $out );
		$this->assertStringContainsString( 'wp-block-list imet-menu-footer-main', $out );
	}

	/**
	 * A list tied to a menu keeps every attribute set in the editor (anchor, inline style), not only its classes.
	 *
	 * @since 1.2.1
	 */
	public function test_list_keeps_its_attributes(): void {
		register_nav_menu( 'footer-main', 'Footer main' );

		$menu_id = wp_create_nav_menu( 'Footer attrs' );
		wp_update_nav_menu_item(
			$menu_id,
			0,
			[
				'menu-item-title'  => 'Managed link',
				'menu-item-url'    => 'https://example.org/managed/',
				'menu-item-type'   => 'custom',
				'menu-item-status' => 'publish',
			]
		);
		set_theme_mod( 'nav_menu_locations', [ 'footer-main' => $menu_id ] );

		$out = ( new MenuRenderer() )->render(
			'<ul id="footer-links" class="wp-block-list imet-menu-footer-main" style="gap:4px"><li>Saved</li></ul>',
			[
				'blockName' => 'core/list',
				'attrs'     => [ 'className' => 'imet-menu-footer-main' ],
			]
		);

		$this->assertStringStartsWith( '<ul id="footer-links" class="wp-block-list imet-menu-footer-main" style="gap:4px">', $out );
		$this->assertStringContainsString( 'Managed link', $out );
	}

	/**
	 * A real core Navigation block tied to an assigned menu prints the menu's items, nested, inside core's own item
	 * list, and keeps the mobile overlay. Rendered by core on every WordPress version CI runs, so a change in core's
	 * markup fails here instead of silently leaving the saved links on the live header.
	 *
	 * @since 1.2.1
	 */
	public function test_navigation_prints_the_assigned_menu_inside_core_markup(): void {
		$this->assign_menu_with_submenu( 'primary' );

		$html = $this->core_navigation( 'imet-menu-primary', '<!-- wp:navigation-link {"label":"Saved link","url":"https://example.org/saved/"} /-->' );
		$out  = ( new MenuRenderer() )->render(
			$html,
			[
				'blockName' => 'core/navigation',
				'attrs'     => [ 'className' => 'imet-menu-primary' ],
			]
		);

		$this->assertNotSame( $html, $out, 'Core Navigation markup changed: MenuRenderer no longer finds the item list.' );
		$this->assertStringNotContainsString( 'Saved link', $out );
		$this->assertStringContainsString( 'Managed parent', $out );
		$this->assertStringContainsString( 'Managed child', $out );
		$this->assertSame( 1, substr_count( $out, 'wp-block-navigation__container' ) );
		$this->assertStringContainsString( 'wp-block-navigation__responsive-container', $out );
		$this->assertStringEndsWith( '</nav>', trim( $out ) );
	}

	/**
	 * The walker's submenu markup carries the same Interactivity API directives as core's own Navigation submenu, so
	 * the dropdowns keep working. Fails when core renames an action, callback or context key.
	 *
	 * @since 1.2.1
	 */
	public function test_walker_submenu_directives_match_core(): void {
		$core = $this->core_navigation(
			'',
			'<!-- wp:navigation-submenu {"label":"Core parent","url":"https://example.org/p/"} --><!-- wp:navigation-link {"label":"Core child","url":"https://example.org/c/"} /--><!-- /wp:navigation-submenu -->'
		);

		$this->assign_menu_with_submenu( 'primary' );
		$ours = ( new MenuRenderer() )->render(
			$this->core_navigation( 'imet-menu-primary', '<!-- wp:navigation-link {"label":"Saved","url":"https://example.org/s/"} /-->' ),
			[
				'blockName' => 'core/navigation',
				'attrs'     => [ 'className' => 'imet-menu-primary' ],
			]
		);

		foreach ( [
			[ 'LI', 'wp-block-navigation-submenu' ],
			[ 'BUTTON', 'wp-block-navigation-submenu__toggle' ],
			[ 'UL', 'wp-block-navigation__submenu-container' ],
		] as [ $tag, $class ] ) {
			$expected = $this->directives( $core, $tag, $class );

			$this->assertNotEmpty( $expected, "Core renders no {$tag}.{$class} directives: update this test to core's markup." );
			$this->assertSame( $expected, $this->directives( $ours, $tag, $class ), "NavWalker {$tag}.{$class} directives differ from core." );
		}
	}

	/**
	 * Create a menu with a parent and a child item and assign it to a location.
	 *
	 * @param string $location Menu location.
	 */
	private function assign_menu_with_submenu( string $location ): void {
		register_nav_menu( $location, $location );

		$menu_id = wp_create_nav_menu( 'Test ' . $location );
		$item    = [
			'menu-item-type'   => 'custom',
			'menu-item-status' => 'publish',
		];
		$parent  = wp_update_nav_menu_item(
			$menu_id,
			0,
			$item + [
				'menu-item-title' => 'Managed parent',
				'menu-item-url'   => 'https://example.org/parent/',
			]
		);
		wp_update_nav_menu_item(
			$menu_id,
			0,
			$item + [
				'menu-item-title'     => 'Managed child',
				'menu-item-url'       => 'https://example.org/child/',
				'menu-item-parent-id' => $parent,
			]
		);
		set_theme_mod( 'nav_menu_locations', [ $location => $menu_id ] );
	}

	/**
	 * Core's rendering of a Navigation block, without the theme's own MenuRenderer filter.
	 *
	 * @param string $class_name Extra class on the block.
	 * @param string $inner      Inner block markup.
	 *
	 * @return string Rendered HTML.
	 */
	private function core_navigation( string $class_name, string $inner ): string {
		global $wp_filter;

		// The theme registers its own MenuRenderer on render_block; take it off so this is core's markup alone.
		foreach ( $wp_filter['render_block']->callbacks ?? [] as $priority => $callbacks ) {
			foreach ( $callbacks as $callback ) {
				if ( is_array( $callback['function'] ) && $callback['function'][0] instanceof MenuRenderer ) {
					remove_filter( 'render_block', $callback['function'], $priority );
				}
			}
		}

		$attrs = '' === $class_name ? '' : ' ' . wp_json_encode( [ 'className' => $class_name ] );

		return do_blocks( '<!-- wp:navigation' . $attrs . ' -->' . $inner . '<!-- /wp:navigation -->' );
	}

	/**
	 * The `data-wp-*` attributes of the first matching tag, JSON values decoded so formatting does not matter.
	 *
	 * @param string $html  HTML.
	 * @param string $tag   Tag name.
	 * @param string $class Class the tag must carry.
	 *
	 * @return array<string, mixed> Attribute name => value.
	 */
	private function directives( string $html, string $tag, string $class ): array {
		$tags = new WP_HTML_Tag_Processor( $html );

		if ( ! $tags->next_tag(
			[
				'tag_name'   => $tag,
				'class_name' => $class,
			]
		) ) {
			return [];
		}

		$found = [];

		foreach ( (array) $tags->get_attribute_names_with_prefix( 'data-wp-' ) as $name ) {
			$value          = $tags->get_attribute( $name );
			$decoded        = is_string( $value ) ? json_decode( $value, true ) : null;
			$found[ $name ] = is_array( $decoded ) ? $decoded : $value;
		}

		ksort( $found );

		return $found;
	}
}

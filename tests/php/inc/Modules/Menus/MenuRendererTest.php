<?php
/**
 * Tests for MenuRenderer.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Tests\Modules\Menus;

use IMET\Theme\Modules\Menus\MenuRenderer;
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
}

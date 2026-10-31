<?php
/**
 * Tests for MenuSeeder.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Tests\Modules\Menus;

use IMET\Theme\Modules\Menus\DefaultMenus;
use IMET\Theme\Modules\Menus\MenuSeeder;
use WP_UnitTestCase;

/**
 * Class MenuSeederTest
 *
 * @since 1.2.0
 */
class MenuSeederTest extends WP_UnitTestCase {

	/**
	 * Every default menu is created and assigned, with nested items.
	 *
	 * @since 1.2.0
	 */
	public function test_seed_creates_and_assigns_menus(): void {
		$created   = ( new MenuSeeder() )->seed();
		$locations = get_theme_mod( 'nav_menu_locations' );

		$this->assertSame( count( DefaultMenus::all() ), $created );
		$this->assertArrayHasKey( 'primary', $locations );

		$items   = wp_get_nav_menu_items( (int) $locations['primary'] );
		$parents = array_filter( $items, static fn ( $item ) => 0 !== (int) $item->menu_item_parent );

		$this->assertNotEmpty( $parents );
	}

	/**
	 * Seeding again never replaces an assigned menu.
	 *
	 * @since 1.2.0
	 */
	public function test_seed_keeps_assigned_menus(): void {
		$seeder = new MenuSeeder();
		$seeder->seed();

		$this->assertSame( 0, $seeder->seed() );
	}
}

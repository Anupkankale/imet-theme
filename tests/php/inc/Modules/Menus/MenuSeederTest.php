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

	/**
	 * A menu that already exists under the default name, but is not assigned, is assigned as it is: its items are not
	 * added a second time (e.g. after someone unassigned it and DefaultMenus::VERSION was bumped).
	 *
	 * @since 1.2.1
	 */
	public function test_seed_reuses_an_existing_menu_without_duplicating_items(): void {
		$name    = DefaultMenus::all()['primary']['name'];
		$menu_id = wp_create_nav_menu( $name );
		wp_update_nav_menu_item(
			$menu_id,
			0,
			[
				'menu-item-title'  => 'Kept link',
				'menu-item-url'    => 'https://example.org/kept/',
				'menu-item-type'   => 'custom',
				'menu-item-status' => 'publish',
			]
		);

		( new MenuSeeder() )->seed();

		$locations = get_theme_mod( 'nav_menu_locations' );
		$items     = wp_get_nav_menu_items( $menu_id );

		$this->assertSame( $menu_id, (int) $locations['primary'] );
		$this->assertCount( 1, $items );
		$this->assertSame( 'Kept link', $items[0]->title );
	}
}

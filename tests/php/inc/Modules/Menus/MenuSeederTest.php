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
	 * A site seeded before the Kenya row existed gets only the new Kenya menu on the next seed (VERSION bumped): the
	 * menus editors already manage are left as they are.
	 *
	 * @since 1.1.100
	 */
	public function test_seed_adds_the_kenya_menu_to_a_seeded_site(): void {
		$seeder = new MenuSeeder();
		$seeder->seed();

		$locations = (array) get_theme_mod( 'nav_menu_locations' );
		wp_delete_nav_menu( (int) $locations['footer-kenya'] );
		unset( $locations['footer-kenya'] );
		set_theme_mod( 'nav_menu_locations', $locations );

		$this->assertSame( 1, $seeder->seed() );

		$items = wp_get_nav_menu_items( (int) get_theme_mod( 'nav_menu_locations' )['footer-kenya'] );
		$this->assertSame(
			[ '/dba-kenya/', '/dba-ai-ml-kenya/', '/dba-project-management-kenya/' ],
			array_map( static fn ( $item ) => wp_parse_url( $item->url, PHP_URL_PATH ), $items )
		);
		$this->assertSame( '4', MenuSeeder::VERSION, 'Bumped so sites seeded with version 3 add the Kenya menu.' );
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

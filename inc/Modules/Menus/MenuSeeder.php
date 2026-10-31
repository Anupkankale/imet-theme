<?php
/**
 * Create the starting menus once.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Menus;

use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class MenuSeeder
 *
 * On a fresh site every menu location is empty. The first time an administrator opens wp-admin after the theme is active,
 * this creates the menus from DefaultMenus and assigns them to their locations. It never replaces a menu that is already
 * assigned, and it runs once per DefaultMenus version.
 *
 * @since 1.2.0
 */
class MenuSeeder implements Registrable {

	/**
	 * Option that remembers the seeded version.
	 *
	 * @since 1.2.0
	 *
	 * @var string
	 */
	public const OPTION = 'imet_menus_seeded';

	/**
	 * Version of the default menus.
	 *
	 * @since 1.2.0
	 *
	 * @var string
	 */
	public const VERSION = '1';

	/**
	 * Register hooks.
	 *
	 * @since 1.2.0
	 */
	public function register_hooks(): void {
		add_action( 'admin_init', [ $this, 'maybe_seed' ] );
		add_action( 'after_switch_theme', [ $this, 'maybe_seed' ] );
	}

	/**
	 * Seed once, for administrators.
	 *
	 * @since 1.2.0
	 */
	public function maybe_seed(): void {
		if ( self::VERSION === get_option( self::OPTION ) || ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		$this->seed();
		update_option( self::OPTION, self::VERSION, false );
	}

	/**
	 * Create and assign every default menu that has no menu yet.
	 *
	 * @since 1.2.0
	 *
	 * @return int Number of menus created.
	 */
	public function seed(): int {
		$locations = (array) get_theme_mod( 'nav_menu_locations', [] );
		$created   = 0;

		foreach ( DefaultMenus::all() as $location => $menu ) {
			if ( ! empty( $locations[ $location ] ) && is_nav_menu( (int) $locations[ $location ] ) ) {
				continue;
			}

			$menu_id = wp_create_nav_menu( $menu['name'] );

			if ( is_wp_error( $menu_id ) ) {
				$existing = wp_get_nav_menu_object( $menu['name'] );
				$menu_id  = $existing ? (int) $existing->term_id : 0;
			}

			if ( ! $menu_id ) {
				continue;
			}

			$this->add_items( (int) $menu_id, $menu['items'], 0 );
			$locations[ $location ] = (int) $menu_id;
			++$created;
		}

		set_theme_mod( 'nav_menu_locations', $locations );

		return $created;
	}

	/**
	 * Add items (and their children) to a menu.
	 *
	 * @since 1.2.0
	 *
	 * @param int                              $menu_id Menu ID.
	 * @param array<int, array<string, mixed>> $items   Items.
	 * @param int                              $parent_id Parent menu item ID.
	 */
	private function add_items( int $menu_id, array $items, int $parent_id ): void {
		foreach ( $items as $item ) {
			$id = wp_update_nav_menu_item(
				$menu_id,
				0,
				[
					'menu-item-title'     => (string) $item['title'],
					'menu-item-url'       => str_starts_with( (string) $item['url'], '/' ) ? home_url( (string) $item['url'] ) : (string) $item['url'],
					'menu-item-type'      => 'custom',
					'menu-item-status'    => 'publish',
					'menu-item-parent-id' => $parent_id,
					'menu-item-classes'   => (string) ( $item['classes'] ?? '' ),
				]
			);

			if ( ! is_wp_error( $id ) && ! empty( $item['children'] ) ) {
				$this->add_items( $menu_id, $item['children'], (int) $id );
			}
		}
	}
}

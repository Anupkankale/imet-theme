<?php
/**
 * Menu registration.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Core;

use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class Menu
 *
 * @since 1.0.0
 */
class Menu implements Registrable {

	/**
	 * Register hooks.
	 *
	 * @since 1.0.0
	 */
	public function register_hooks(): void {
		add_action( 'after_setup_theme', [ $this, 'register_menus' ] );
	}

	/**
	 * Register navigation menus.
	 *
	 * @since 1.0.0
	 */
	public function register_menus(): void {
		register_nav_menus(
			[
				'primary' => esc_html__( 'Primary Menu', 'imet-theme' ),
				'footer'  => esc_html__( 'Footer Menu', 'imet-theme' ),
			]
		);
	}
}

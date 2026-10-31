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
				'primary'          => esc_html__( 'Header menu', 'imet-theme' ),
				'footer-main'      => esc_html__( 'Footer: Main Menu', 'imet-theme' ),
				'footer-courses'   => esc_html__( 'Footer: Courses', 'imet-theme' ),
				'footer-mba'       => esc_html__( 'Footer: Online Master’s (MBA)', 'imet-theme' ),
				'footer-dba'       => esc_html__( 'Footer: Online Doctorate (DBA)', 'imet-theme' ),
				'footer-countries' => esc_html__( 'Footer: Doctorate Programs by Country', 'imet-theme' ),
			]
		);
	}
}

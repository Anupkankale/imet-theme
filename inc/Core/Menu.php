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
				'primary'            => esc_html__( 'Header menu', 'imet-theme' ),
				'footer-main'        => esc_html__( 'Footer: Main Menu', 'imet-theme' ),
				'footer-courses'     => esc_html__( 'Footer: Courses', 'imet-theme' ),
				'footer-mba'         => esc_html__( 'Footer: Online Master’s (MBA)', 'imet-theme' ),
				'footer-dba'         => esc_html__( 'Footer: Online Doctorate (DBA)', 'imet-theme' ),
				'footer-usa'         => esc_html__( 'Footer: Doctorate Programs In USA', 'imet-theme' ),
				'footer-uk'          => esc_html__( 'Footer: Doctorate Programs In UK', 'imet-theme' ),
				'footer-canada'      => esc_html__( 'Footer: Doctorate Programs In Canada', 'imet-theme' ),
				'footer-uae'         => esc_html__( 'Footer: Doctorate Programs In UAE', 'imet-theme' ),
				'footer-west-africa' => esc_html__( 'Footer: Doctorate Programs In West Africa', 'imet-theme' ),
				'blog'               => esc_html__( 'Blog: Category bar (single articles)', 'imet-theme' ),
			]
		);
	}
}

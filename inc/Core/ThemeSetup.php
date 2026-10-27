<?php
/**
 * Theme setup configuration.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Core;

use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class ThemeSetup
 *
 * @since 1.0.0
 */
class ThemeSetup implements Registrable {

	/**
	 * Register hooks.
	 *
	 * @since 1.0.0
	 */
	public function register_hooks(): void {
		add_action( 'after_setup_theme', [ $this, 'add_theme_support' ] );
		add_action( 'after_setup_theme', [ $this, 'register_image_sizes' ] );
		add_action( 'after_setup_theme', [ $this, 'load_textdomain' ] );
	}

	/**
	 * Add theme support.
	 *
	 * @since 1.0.0
	 */
	public function add_theme_support(): void {
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'custom-spacing' );
		add_theme_support( 'align-wide' );
	}

	/**
	 * Register custom image sizes.
	 *
	 * @since 1.0.0
	 */
	public function register_image_sizes(): void {
		add_image_size( 'elementary-featured', 1200, 630, true );
	}

	/**
	 * Load theme textdomain.
	 *
	 * @since 1.0.0
	 *
	 * @action after_setup_theme
	 */
	public function load_textdomain(): void {
		load_theme_textdomain(
			'imet-theme',
			get_template_directory() . '/languages'
		);
	}
}

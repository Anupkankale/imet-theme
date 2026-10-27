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
		add_action( 'init', [ $this, 'disable_emoji' ] );
	}

	/**
	 * Add theme support.
	 *
	 * @since 1.0.0
	 */
	public function add_theme_support(): void {
		add_theme_support( 'responsive-embeds' );
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

	/**
	 * Stop WordPress from loading the emoji detection script and styles.
	 *
	 * Browsers render emoji natively, so wp-emoji only costs a request and
	 * inline JS on every page.
	 *
	 * @since 1.0.0
	 *
	 * @action init
	 */
	public function disable_emoji(): void {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	}
}

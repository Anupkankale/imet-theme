<?php
/**
 * Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Define theme constants.
 */
function constants(): void {
	if ( ! defined( 'IMET_VERSION' ) ) {
		define( 'IMET_VERSION', wp_get_theme()->get( 'Version' ) );
	}

	if ( ! defined( 'IMET_PATH' ) ) {
		define( 'IMET_PATH', untrailingslashit( get_template_directory() ) );
	}

	if ( ! defined( 'IMET_BUILD_URI' ) ) {
		define( 'IMET_BUILD_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build' );
	}

	if ( ! defined( 'IMET_BUILD_DIR' ) ) {
		define( 'IMET_BUILD_DIR', untrailingslashit( get_template_directory() ) . '/assets/build' );
	}

	if ( ! defined( 'IMET_ENABLE_TAILWIND' ) ) {
		define( 'IMET_ENABLE_TAILWIND', false );
	}
}

constants();

// If the autoloader fails, we cannot proceed.
require_once IMET_PATH . '/inc/Autoloader.php';
if ( ! class_exists( Autoloader::class ) || ! Autoloader::autoload() ) {
	return;
}

// Instantiate the theme.
if ( class_exists( Main::class ) ) {
	Main::get_instance();
}

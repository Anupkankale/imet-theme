<?php
/**
 * Test ThemeSetup class.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

use IMET\Theme\Core\ThemeSetup;
use IMET\Theme\Tests\TestCase;

/**
 * Class ThemeSetupTest
 *
 * @since 1.0.0
 */
class ThemeSetupTest extends TestCase {

	/**
	 * ThemeSetup instance.
	 *
	 * @var ThemeSetup
	 */
	private ThemeSetup $instance;

	/**
	 * Setup test.
	 */
	public function set_up(): void {
		parent::set_up();

		$this->instance = new ThemeSetup();
	}

	/**
	 * Test class exists.
	 */
	public function test_class_exists(): void {
		$this->assertTrue( class_exists( ThemeSetup::class ) );
	}

	/**
	 * Test class implements Registrable.
	 */
	public function test_implements_registrable(): void {
		$this->assertInstanceOf( 'rtCamp\WPPrimitives\Contracts\Interfaces\Registrable', $this->instance );
	}

	/**
	 * Test register_hooks adds actions.
	 */
	public function test_register_hooks(): void {
		$this->instance->register_hooks();

		$this->assertGreaterThan( 0, has_action( 'after_setup_theme', [ $this->instance, 'add_theme_support' ] ) );
		$this->assertGreaterThan( 0, has_action( 'after_setup_theme', [ $this->instance, 'register_image_sizes' ] ) );
		$this->assertGreaterThan( 0, has_action( 'after_setup_theme', [ $this->instance, 'load_textdomain' ] ) );
		$this->assertGreaterThan( 0, has_action( 'init', [ $this->instance, 'disable_emoji' ] ) );
	}

	/**
	 * Test theme support is added.
	 */
	public function test_add_theme_support(): void {
		$this->instance->add_theme_support();

		$this->assertTrue( current_theme_supports( 'responsive-embeds' ) );
		$this->assertFalse( current_theme_supports( 'custom-spacing' ) );
		$this->assertTrue( current_theme_supports( 'align-wide' ) );
	}

	/**
	 * Test image sizes are registered.
	 */
	public function test_register_image_sizes(): void {
		$this->instance->register_image_sizes();

		$sizes = wp_get_additional_image_sizes();
		$this->assertArrayHasKey( 'imet-featured', $sizes );
		$this->assertSame( 1200, $sizes['imet-featured']['width'] );
		$this->assertSame( 630, $sizes['imet-featured']['height'] );
		$this->assertTrue( $sizes['imet-featured']['crop'] );
	}

	/**
	 * The text domain is pointed at the theme's languages directory.
	 */
	public function test_load_textdomain_registers_languages_path(): void {
		global $wp_textdomain_registry;

		$this->instance->load_textdomain();

		// WP_Textdomain_Registry has no public getter for custom paths, so read the
		// protected property that load_theme_textdomain() fills via set_custom_path().
		$custom_paths = ( new \ReflectionProperty( $wp_textdomain_registry, 'custom_paths' ) )->getValue( $wp_textdomain_registry );

		$this->assertIsArray( $custom_paths );
		$this->assertSame( get_template_directory() . '/languages', $custom_paths['imet-theme'] ?? null );
	}

	/**
	 * Test the emoji script and styles are unhooked.
	 */
	public function test_disable_emoji(): void {
		$this->instance->disable_emoji();

		$this->assertFalse( has_action( 'wp_head', 'print_emoji_detection_script' ) );
		$this->assertFalse( has_action( 'wp_print_styles', 'print_emoji_styles' ) );
	}
}

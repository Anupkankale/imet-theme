<?php
/**
 * Test Blocks and Defaults classes.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

use IMET\Theme\Modules\Blocks\Blocks;
use IMET\Theme\Modules\Blocks\Defaults;
use IMET\Theme\Tests\TestCase;

/**
 * Class BlocksTest
 *
 * @since 1.0.0
 */
class BlocksTest extends TestCase {

	/**
	 * Blocks instance.
	 *
	 * @var Blocks
	 */
	private Blocks $instance;

	/**
	 * Setup test.
	 */
	public function set_up(): void {
		parent::set_up();

		$this->instance = new Blocks();
	}

	/**
	 * Test class implements Registrable.
	 */
	public function test_implements_registrable(): void {
		$this->assertInstanceOf( 'rtCamp\WPPrimitives\Contracts\Interfaces\Registrable', $this->instance );
	}

	/**
	 * Test hooks are registered.
	 */
	public function test_register_hooks(): void {
		$this->instance->register_hooks();

		$this->assertNotFalse( has_action( 'init', [ $this->instance, 'register_blocks' ] ) );
		$this->assertNotFalse( has_filter( 'block_categories_all', [ $this->instance, 'add_category' ] ) );
		$this->assertNotFalse( has_filter( 'render_block', [ $this->instance, 'add_alignfull' ] ) );
	}

	/**
	 * Test hooks keep built block assets cache-busted.
	 */
	public function test_register_hooks_versions_block_assets(): void {
		$this->instance->register_hooks();

		$this->assertNotFalse( has_filter( 'style_loader_src', [ $this->instance, 'version_asset' ] ) );
		$this->assertNotFalse( has_filter( 'script_loader_src', [ $this->instance, 'version_asset' ] ) );
	}

	/**
	 * Test a built block asset gets its file time as version.
	 */
	public function test_version_asset_uses_the_file_time(): void {
		$file = get_theme_file_path( 'assets/build/blocks/zz-version-test/style-index.css' );
		wp_mkdir_p( dirname( $file ) );
		file_put_contents( $file, '/* fixture */' ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents -- Test fixture.
		touch( $file, 1700000000 );

		$src = get_theme_file_uri( 'assets/build/blocks/zz-version-test/style-index.css' ) . '?ver=1.0.0';

		$this->assertStringContainsString( 'ver=1700000000', $this->instance->version_asset( $src ) );
		$this->assertStringNotContainsString( 'ver=1.0.0', $this->instance->version_asset( $src ) );

		unlink( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions.unlink_unlink -- Test fixture.
		rmdir( dirname( $file ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.rmdir_rmdir -- Test fixture.
	}

	/**
	 * Test other URLs and missing files are left alone.
	 */
	public function test_version_asset_ignores_other_urls(): void {
		$this->assertSame( 'https://example.org/a.css?ver=1', $this->instance->version_asset( 'https://example.org/a.css?ver=1' ) );

		$missing = get_theme_file_uri( 'assets/build/blocks/nope/style-index.css' ) . '?ver=1.0.0';
		$this->assertSame( $missing, $this->instance->version_asset( $missing ) );
	}

	/**
	 * Test registering without a build is silent (no _doing_it_wrong from the asset loader).
	 */
	public function test_register_blocks_without_a_build_is_silent(): void {
		if ( file_exists( get_theme_file_path( 'assets/build/blocks/blocks-manifest.php' ) ) ) {
			$this->markTestSkipped( 'The theme is built here.' );
		}

		$this->instance->register_blocks();

		// An unexpected _doing_it_wrong fails the test on its own; this asserts we got here.
		$this->assertTrue( wp_style_is( 'imet-base', 'registered' ) );
	}

	/**
	 * Test the IMET category comes first.
	 */
	public function test_add_category_is_first(): void {
		$categories = $this->instance->add_category( [ [ 'slug' => 'text' ] ] );

		$this->assertSame( 'imet', $categories[0]['slug'] );
		$this->assertSame( 'text', $categories[1]['slug'] );
	}

	/**
	 * Test alignfull is added to a block saved before full width support.
	 */
	public function test_add_alignfull_adds_class(): void {
		$html = $this->instance->add_alignfull(
			'<section class="wp-block-imet-cta imet-section">x</section>',
			[
				'blockName' => 'imet/cta',
				'attrs'     => [],
			]
		);

		$this->assertStringContainsString( 'alignfull', $html );
	}

	/**
	 * Test other blocks are left alone.
	 */
	public function test_add_alignfull_ignores_other_blocks(): void {
		$html = '<p>x</p>';

		$this->assertSame(
			$html,
			$this->instance->add_alignfull(
				$html,
				[
					'blockName' => 'core/paragraph',
					'attrs'     => [],
				] 
			)
		);
	}

	/**
	 * Test default content tokens resolve to theme URLs and ids are dropped.
	 */
	public function test_defaults_resolve_tokens(): void {
		$html = ( new Defaults() )->resolve_tokens( '<!-- wp:image {"id":{{ID:a.webp}},"x":1} --><img src="{{URL:a.webp}}" class="wp-image-{{ID:a.webp}}"/>' );

		$this->assertStringNotContainsString( '{{', $html );
		$this->assertStringContainsString( 'assets/images/imet/a.webp', $html );
		$this->assertStringContainsString( '{"x":1}', $html );
	}
}

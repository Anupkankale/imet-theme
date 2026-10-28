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

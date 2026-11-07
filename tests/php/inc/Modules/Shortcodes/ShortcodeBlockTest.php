<?php
/**
 * Test ShortcodeBlock class.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

use IMET\Theme\Modules\Shortcodes\ShortcodeBlock;
use IMET\Theme\Tests\TestCase;

/**
 * Class ShortcodeBlockTest
 *
 * @since 1.1.4
 */
class ShortcodeBlockTest extends TestCase {

	/**
	 * Register a throwaway shortcode for the tests.
	 */
	public function set_up(): void {
		parent::set_up();

		add_shortcode( 'imet_test_hello', static fn (): string => '<span>hello</span>' );
	}

	/**
	 * Remove the throwaway shortcode.
	 */
	public function tear_down(): void {
		remove_shortcode( 'imet_test_hello' );

		parent::tear_down();
	}

	/**
	 * Test class implements Registrable.
	 */
	public function test_implements_registrable(): void {
		$this->assertInstanceOf( 'rtCamp\WPPrimitives\Contracts\Interfaces\Registrable', new ShortcodeBlock() );
	}

	/**
	 * Test the filter is hooked to the Shortcode block's render.
	 */
	public function test_hooks_the_shortcode_block_render(): void {
		$feature = new ShortcodeBlock();
		$feature->register_hooks();

		$this->assertNotFalse( has_filter( 'render_block_core/shortcode', [ $feature, 'run' ] ) );
	}

	/**
	 * Test a shortcode in the block's output is run (a template renders blocks after its own shortcode pass).
	 */
	public function test_runs_the_shortcode(): void {
		$this->assertStringContainsString( '<span>hello</span>', ( new ShortcodeBlock() )->run( "[imet_test_hello]\n" ) );
	}

	/**
	 * Test output without a shortcode passes through unchanged.
	 */
	public function test_leaves_plain_output_alone(): void {
		$this->assertSame( '<p>No shortcode here.</p>', ( new ShortcodeBlock() )->run( '<p>No shortcode here.</p>' ) );
	}

	/**
	 * Test a whole template renders the shortcode inside a Shortcode block.
	 */
	public function test_shortcode_block_renders_through_do_blocks(): void {
		( new ShortcodeBlock() )->register_hooks();

		$html = do_blocks( "<!-- wp:shortcode -->\n[imet_test_hello]\n<!-- /wp:shortcode -->" );

		$this->assertStringContainsString( '<span>hello</span>', $html );
	}
}

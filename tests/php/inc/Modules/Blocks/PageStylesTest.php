<?php
/**
 * Test the PageStyles class.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

use IMET\Theme\Modules\Blocks\PageStyles;
use IMET\Theme\Tests\TestCase;
use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class PageStylesTest
 *
 * @since 1.1.94
 */
class PageStylesTest extends TestCase {

	/**
	 * PageStyles instance.
	 *
	 * @var PageStyles
	 */
	private PageStyles $instance;

	/**
	 * Setup test.
	 */
	public function set_up(): void {
		parent::set_up();

		$this->instance = new PageStyles();
	}

	/**
	 * Test class implements Registrable.
	 */
	public function test_implements_registrable(): void {
		$this->assertInstanceOf( Registrable::class, $this->instance );
	}

	/**
	 * Test hooks are registered.
	 */
	public function test_register_hooks(): void {
		$this->instance->register_hooks();

		$this->assertGreaterThan( 0, has_action( 'init', [ $this->instance, 'register_styles' ] ) );
		$this->assertGreaterThan( 0, has_filter( 'render_block', [ $this->instance, 'collect' ] ) );
		$this->assertGreaterThan( 0, has_action( 'wp_enqueue_scripts', [ $this->instance, 'enqueue_needed' ] ) );
		$this->assertGreaterThan( 0, has_action( 'enqueue_block_assets', [ $this->instance, 'enqueue_in_editor' ] ) );
		$this->assertLessThan( has_action( 'wp_enqueue_scripts', [ $this->instance, 'enqueue_needed' ] ), has_action( 'wp_enqueue_scripts', [ $this->instance, 'enqueue_base' ] ), 'The shared styles are enqueued before the page styles are ordered.' );
	}

	/**
	 * The footer (on every page) uses the shared form styles: the shared styles load on pages without IMET blocks too
	 * (the blog archives, search, 404), where the footer's newsletter form was unstyled and overflowed at 1024px.
	 */
	public function test_shared_styles_load_on_every_front_end_page(): void {
		wp_register_style( 'imet-base', 'https://example.test/base-end.css', PageStyles::base_handles(), '1' );
		$this->instance->register_styles();
		wp_dequeue_style( 'imet-base' );
		$this->assertFalse( wp_style_is( 'imet-base', 'enqueued' ) );

		$this->instance->enqueue_base();
		$this->instance->enqueue_needed();

		$this->assertTrue( wp_style_is( 'imet-base', 'enqueued' ) );
		$this->assertSame( PageStyles::base_handles(), wp_styles()->query( 'imet-base' )->deps, 'No page styles on a page without IMET blocks.' );

		wp_dequeue_style( 'imet-base' );
	}

	/**
	 * A page's own class prefix selects its stylesheet; other pages' stylesheets stay out.
	 */
	public function test_matches_the_page_prefix(): void {
		$html = '<section class="wp-block-imet-section alignfull imet-section ab-hero"><div class="ab-gc is-active"></div></section>';

		$this->assertSame( [ 'about-page' ], $this->instance->matches( $html ) );
	}

	/**
	 * Only class names count: the same letters in text, a link or another attribute don't load anything.
	 */
	public function test_ignores_prefixes_outside_class_attributes(): void {
		$html = '<section class="imet-section"><p>ab-testing and bl-ue</p><a href="/bp-guide/" data-x="tm-1">x</a></section>';

		$this->assertSame( [], $this->instance->matches( $html ) );
	}

	/**
	 * A prefix must start the class name: "tab-panel" is not the About page's "ab-", "label-x" not the blog's "bl-".
	 */
	public function test_prefix_must_start_a_class_name(): void {
		$this->assertSame( [], $this->instance->matches( '<div class="tab-panel label-x imet-section"></div>' ) );
	}

	/**
	 * Pages that reuse another page's styles get both, in the order base.scss loaded them (cascade order).
	 */
	public function test_several_pages_keep_the_cascade_order(): void {
		$html = '<section class="imet-section bl-hero ss-hero"></section><div class="al-grid cv-card"></div>';

		$this->assertSame( [ 'alumni-page', 'blog-page', 'success-stories', 'convocation-page' ], $this->instance->matches( $html ) );
	}

	/**
	 * Photo chips match on their wrapper or their chip class; single-quoted class attributes count too.
	 */
	public function test_photo_chips_and_single_quotes(): void {
		$this->assertSame( [ 'photo-chips' ], $this->instance->matches( "<div class='photo-chips is-2'></div>" ) );
		$this->assertSame( [ 'photo-chips' ], $this->instance->matches( '<span class="pc-chip is-green"></span>' ) );
	}

	/**
	 * Only IMET blocks are scanned (every split selector sits under .imet-section); what they need is enqueued in order.
	 */
	public function test_collects_from_imet_blocks_only(): void {
		$this->instance->collect( '<div class="bp-content"></div>', [ 'blockName' => 'core/group' ] );
		$this->assertSame( [], $this->instance->needed() );

		$this->instance->collect( '<section class="imet-section ss-cases"></section>', [ 'blockName' => 'imet/section' ] );
		$this->instance->collect( '<section class="imet-section bl-hero"></section>', [ 'blockName' => 'imet/section' ] );
		$this->assertSame( [ 'blog-page', 'success-stories' ], $this->instance->needed() );
	}

	/**
	 * The collect() filter returns the block markup unchanged.
	 */
	public function test_collect_returns_markup_unchanged(): void {
		$html = '<section class="imet-section ab-hero">x</section>';

		$this->assertSame( $html, $this->instance->collect( $html, [ 'blockName' => 'imet/section' ] ) );
	}

	/**
	 * Every split stylesheet is listed with a prefix, and handles carry the theme prefix.
	 */
	public function test_handles(): void {
		foreach ( PageStyles::STYLES as $name => $prefixes ) {
			$this->assertNotEmpty( $prefixes, $name );
			$this->assertSame( 'imet-page-' . $name, PageStyles::handle( $name ) );
		}
	}

	/**
	 * The imet-base handle depends on the shared parts and the page's stylesheets in the original cascade order.
	 */
	public function test_dependencies_keep_the_original_cascade_order(): void {
		$this->assertSame(
			[ 'imet-base-start', 'imet-base-sections', 'imet-base-dba' ],
			$this->instance->dependencies( [] ),
			'A page without page styles still gets every shared part.'
		);

		$this->assertSame(
			[ 'imet-base-start', 'imet-page-contact-page', 'imet-base-sections', 'imet-page-blog-page', 'imet-page-testimonials-page', 'imet-base-dba', 'imet-page-success-stories', 'imet-page-about-page' ],
			$this->instance->dependencies( [ 'about-page', 'success-stories', 'testimonials-page', 'blog-page', 'contact-page' ] )
		);
	}

	/**
	 * Every page stylesheet has a place in the cascade order, and the shared parts are the default dependencies.
	 */
	public function test_every_page_style_is_in_the_order(): void {
		foreach ( array_keys( PageStyles::STYLES ) as $name ) {
			$this->assertContains( $name, PageStyles::ORDER, $name );
		}

		$this->assertSame( [ 'imet-base-start', 'imet-base-sections', 'imet-base-dba' ], PageStyles::base_handles() );
	}

	/**
	 * On a page with IMET blocks, imet-base gets the page's stylesheets as dependencies and they are enqueued.
	 */
	public function test_enqueue_needed_sets_the_order_on_imet_base(): void {
		wp_register_style( 'imet-base', 'https://example.test/base-end.css', PageStyles::base_handles(), '1' );
		$this->instance->register_styles();
		wp_enqueue_style( 'imet-base' );

		$this->instance->collect( '<section class="imet-section tm-page"></section>', [ 'blockName' => 'imet/section' ] );
		$this->instance->enqueue_needed();

		$this->assertSame(
			[ 'imet-base-start', 'imet-base-sections', 'imet-page-testimonials-page', 'imet-base-dba' ],
			wp_styles()->query( 'imet-base' )->deps
		);
		$this->assertTrue( wp_style_is( 'imet-page-testimonials-page', 'enqueued' ) );
		$this->assertFalse( wp_style_is( 'imet-page-about-page', 'enqueued' ) );

		wp_dequeue_style( 'imet-base' );
	}

	/**
	 * The page stylesheets are no longer in the shared styles, and each one is a build entry.
	 */
	public function test_split_out_of_base(): void {
		$shared = '';
		foreach ( [ 'base', 'base-sections', 'base-end' ] as $file ) {
			$shared .= (string) file_get_contents( IMET_PATH . '/src/blocks-shared/' . $file . '.scss' );
		}
		$config = (string) file_get_contents( IMET_PATH . '/webpack.blocks.config.js' );

		foreach ( array_keys( PageStyles::STYLES ) as $name ) {
			$this->assertStringNotContainsString( "load-css('" . $name . "')", $shared, $name );
			$this->assertFileExists( IMET_PATH . '/src/blocks-shared/_' . $name . '.scss' );
			$this->assertStringContainsString( "'" . $name . "'", $config, $name );
		}

		foreach ( [ 'shared/base', 'shared/base-sections', 'shared/base-dba', 'shared/base-end' ] as $entry ) {
			$this->assertStringContainsString( "'" . $entry . "'", $config, $entry );
		}
	}
}

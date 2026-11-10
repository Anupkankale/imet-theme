<?php
/**
 * Test SplitTestimonials class.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

use IMET\Theme\Modules\Patterns\SplitTestimonials;
use IMET\Theme\Modules\Patterns\SyncedSections;
use IMET\Theme\Tests\TestCase;

/**
 * Class SplitTestimonialsTest
 *
 * @since 1.1.20
 */
class SplitTestimonialsTest extends TestCase {

	/**
	 * Set up: start without the one-time switch done.
	 */
	public function setUp(): void {
		parent::setUp();

		delete_option( SplitTestimonials::OPTION );
	}

	/**
	 * Test class implements Registrable.
	 */
	public function test_implements_registrable(): void {
		$this->assertInstanceOf( 'rtCamp\WPPrimitives\Contracts\Interfaces\Registrable', new SplitTestimonials() );
	}

	/**
	 * Test it runs on admin_init after the synced sections are made.
	 */
	public function test_registers_hooks(): void {
		$instance = new SplitTestimonials();
		$instance->register_hooks();

		$this->assertSame( 20, has_action( 'admin_init', [ $instance, 'maybe_split' ] ) );
	}

	/**
	 * Test pages are told apart by their address.
	 */
	public function test_kind_from_slug(): void {
		$this->assertSame( 'mba', SplitTestimonials::kind( 'mba' ) );
		$this->assertSame( 'mba', SplitTestimonials::kind( 'mba-cybersecurity' ) );
		$this->assertSame( 'mba', SplitTestimonials::kind( 'online-masters-mba-degree-programs' ) );
		$this->assertSame( 'dba', SplitTestimonials::kind( 'dba-category' ) );
		$this->assertSame( 'dba', SplitTestimonials::kind( 'online-doctorate-cybersecurity-certificate-program' ) );
		$this->assertSame( '', SplitTestimonials::kind( 'home' ) );
		$this->assertSame( '', SplitTestimonials::kind( 'dubai-campus' ) );
	}

	/**
	 * Test only the testimonials reference changes.
	 */
	public function test_swap_changes_only_that_reference(): void {
		$content = "<!-- wp:block {\"ref\":12} /-->\n<!-- wp:block {\"ref\":120} /-->\n<!-- wp:paragraph -->\n<p>ref 12</p>\n<!-- /wp:paragraph -->";

		$this->assertSame(
			"<!-- wp:block {\"ref\":34} /-->\n<!-- wp:block {\"ref\":120} /-->\n<!-- wp:paragraph -->\n<p>ref 12</p>\n<!-- /wp:paragraph -->",
			SplitTestimonials::swap( $content, 12, 34 )
		);
	}

	/**
	 * Test the switch on real pages: MBA and DBA pages move to their own section, others keep the Global one, and it
	 * runs only once.
	 */
	public function test_maybe_split_switches_mba_and_dba_pages_once(): void {
		wp_set_current_user( self::factory()->user->create( [ 'role' => 'administrator' ] ) );
		( new SyncedSections() )->seed();

		$global = SyncedSections::id( 'clients-testimonials' );
		$mba    = SyncedSections::id( 'mba-testimonials' );
		$dba    = SyncedSections::id( 'dba-testimonials' );
		$markup = '<!-- wp:block {"ref":' . $global . '} /-->';
		$pages  = [];

		foreach ( [ 'mba-pmp', 'dba-ai-ml', 'home' ] as $slug ) {
			$pages[ $slug ] = self::factory()->post->create(
				[
					'post_type'    => 'page',
					'post_name'    => $slug,
					'post_content' => $markup,
				]
			);
		}

		( new SplitTestimonials() )->maybe_split();

		$this->assertSame( '<!-- wp:block {"ref":' . $mba . '} /-->', get_post( $pages['mba-pmp'] )->post_content );
		$this->assertSame( '<!-- wp:block {"ref":' . $dba . '} /-->', get_post( $pages['dba-ai-ml'] )->post_content );
		$this->assertSame( $markup, get_post( $pages['home'] )->post_content );
		$this->assertSame( SplitTestimonials::VERSION, get_option( SplitTestimonials::OPTION ) );

		// Once done, a page put back on the Global section by an editor stays so.
		wp_update_post(
			[
				'ID'           => $pages['mba-pmp'],
				'post_content' => $markup,
			]
		);
		( new SplitTestimonials() )->maybe_split();

		$this->assertSame( $markup, get_post( $pages['mba-pmp'] )->post_content );
	}

	/**
	 * Test the new sections start as a copy of the Global one, the MBA one with MBA wording, under prefixed titles.
	 */
	public function test_new_sections_copy_the_global_one(): void {
		$synced = new SyncedSections();
		$synced->seed();

		$global = SyncedSections::id( 'clients-testimonials' );
		wp_update_post(
			[
				'ID'           => $global,
				'post_title'   => 'Clients Testimonials',
				'post_content' => '<!-- wp:paragraph --><p>Edited quote during their DBA doctor of business administration online experience</p><!-- /wp:paragraph -->',
			]
		);
		foreach ( [ 'mba-testimonials', 'dba-testimonials' ] as $key ) {
			wp_delete_post( SyncedSections::id( $key ), true );
		}

		$synced->seed();

		$this->assertSame( 'Testimonials – Global', get_the_title( $global ) );
		$this->assertSame( 'Testimonials – MBA', get_the_title( SyncedSections::id( 'mba-testimonials' ) ) );
		$this->assertStringContainsString( 'Edited quote during their online MBA experience', get_post( SyncedSections::id( 'mba-testimonials' ) )->post_content );
		$this->assertStringContainsString( 'Edited quote during their DBA doctor', get_post( SyncedSections::id( 'dba-testimonials' ) )->post_content );
	}

	/**
	 * Test a title the team chose is kept.
	 */
	public function test_custom_title_is_kept(): void {
		$synced = new SyncedSections();
		$synced->seed();

		$global = SyncedSections::id( 'clients-testimonials' );
		wp_update_post(
			[
				'ID'         => $global,
				'post_title' => 'Our own name',
			]
		);
		$synced->seed();

		$this->assertSame( 'Our own name', get_the_title( $global ) );
	}
}

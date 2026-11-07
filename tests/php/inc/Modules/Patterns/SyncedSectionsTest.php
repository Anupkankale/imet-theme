<?php
/**
 * Test SyncedSections class.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

use IMET\Theme\Modules\Patterns\SyncedSections;
use IMET\Theme\Tests\TestCase;

/**
 * Class SyncedSectionsTest
 *
 * @since 1.1.5
 */
class SyncedSectionsTest extends TestCase {

	/**
	 * Source patterns registered by the test (when the theme's are not loaded).
	 *
	 * @var string[]
	 */
	private array $registered = [];

	/**
	 * Make sure every source pattern exists, and start without seeded sections.
	 */
	public function set_up(): void {
		parent::set_up();

		$registry = WP_Block_Patterns_Registry::get_instance();

		foreach ( SyncedSections::SECTIONS as $key => $section ) {
			if ( ! $registry->is_registered( $section['pattern'] ) ) {
				register_block_pattern(
					$section['pattern'],
					[
						'title'   => $section['title'],
						'content' => '<!-- wp:paragraph --><p>' . $key . '</p><!-- /wp:paragraph -->',
					]
				);
				$this->registered[] = $section['pattern'];
			}
		}

		delete_option( SyncedSections::OPTION );
		delete_option( SyncedSections::VERSION_OPTION );
	}

	/**
	 * Remove what the test registered.
	 */
	public function tear_down(): void {
		foreach ( $this->registered as $slug ) {
			unregister_block_pattern( $slug );
		}

		delete_option( SyncedSections::OPTION );

		parent::tear_down();
	}

	/**
	 * Test class implements Registrable.
	 */
	public function test_implements_registrable(): void {
		$this->assertInstanceOf( 'rtCamp\WPPrimitives\Contracts\Interfaces\Registrable', new SyncedSections() );
	}

	/**
	 * Test the seeding hooks.
	 */
	public function test_registers_hooks(): void {
		$feature = new SyncedSections();
		$feature->register_hooks();

		$this->assertNotFalse( has_action( 'admin_init', [ $feature, 'maybe_seed' ] ) );
		$this->assertNotFalse( has_action( 'after_switch_theme', [ $feature, 'maybe_seed' ] ) );
	}

	/**
	 * Test seeding creates one published synced pattern per section, with the source pattern's content.
	 */
	public function test_seed_creates_one_synced_pattern_per_section(): void {
		$this->assertSame( count( SyncedSections::SECTIONS ), ( new SyncedSections() )->seed() );

		foreach ( SyncedSections::SECTIONS as $key => $section ) {
			$id   = SyncedSections::id( $key );
			$post = get_post( $id );

			$this->assertInstanceOf( WP_Post::class, $post );
			$this->assertSame( 'wp_block', $post->post_type );
			$this->assertSame( 'publish', $post->post_status );
			$this->assertSame( $section['title'], $post->post_title );
			$this->assertNotSame( 'unsynced', get_post_meta( $id, 'wp_pattern_sync_status', true ) );
			$this->assertNotSame( '', trim( $post->post_content ) );
		}
	}

	/**
	 * Test seeding twice never duplicates or overwrites a section (the team's edits stay).
	 */
	public function test_seed_is_idempotent_and_keeps_edits(): void {
		$feature = new SyncedSections();
		$feature->seed();

		$id = SyncedSections::id( 'clients-testimonials' );
		wp_update_post(
			[
				'ID'           => $id,
				'post_content' => '<!-- wp:paragraph --><p>Edited by the team</p><!-- /wp:paragraph -->',
			]
		);

		delete_option( SyncedSections::OPTION ); // A lost option must not create duplicates either.

		$this->assertSame( 0, $feature->seed() );
		$this->assertSame( $id, SyncedSections::id( 'clients-testimonials' ) );
		$this->assertStringContainsString( 'Edited by the team', get_post( $id )->post_content );
		$this->assertCount( count( SyncedSections::SECTIONS ), get_posts( [ 'post_type' => 'wp_block', 'meta_key' => SyncedSections::META, 'numberposts' => -1 ] ) ); // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
	}

	/**
	 * Test every synced section is filed under the "IMET: Shared Sections" pattern category.
	 */
	public function test_sections_are_in_the_shared_category(): void {
		( new SyncedSections() )->seed();

		foreach ( array_keys( SyncedSections::SECTIONS ) as $key ) {
			$this->assertTrue( has_term( SyncedSections::CATEGORY, 'wp_pattern_category', SyncedSections::id( $key ) ), $key );
		}

		$this->assertSame( 'IMET: Shared Sections (reusable)', get_term_by( 'slug', SyncedSections::CATEGORY, 'wp_pattern_category' )->name );
	}

	/**
	 * Test sections made before the category existed get it on the next administrator visit.
	 */
	public function test_maybe_seed_files_older_sections(): void {
		( new SyncedSections() )->seed();
		$id = SyncedSections::id( 'offer-banner' );
		wp_set_object_terms( $id, [], 'wp_pattern_category' );
		delete_option( SyncedSections::VERSION_OPTION );

		wp_set_current_user( self::factory()->user->create( [ 'role' => 'administrator' ] ) );
		( new SyncedSections() )->maybe_seed();

		$this->assertTrue( has_term( SyncedSections::CATEGORY, 'wp_pattern_category', $id ) );
	}

	/**
	 * Test only administrators seed.
	 */
	public function test_maybe_seed_needs_an_administrator(): void {
		wp_set_current_user( self::factory()->user->create( [ 'role' => 'editor' ] ) );
		( new SyncedSections() )->maybe_seed();
		$this->assertSame( 0, SyncedSections::id( 'offer-banner' ) );

		wp_set_current_user( self::factory()->user->create( [ 'role' => 'administrator' ] ) );
		( new SyncedSections() )->maybe_seed();
		$this->assertGreaterThan( 0, SyncedSections::id( 'offer-banner' ) );
	}

	/**
	 * Test the block markup points at the synced pattern, or at the source pattern until it exists.
	 */
	public function test_block_markup(): void {
		$this->assertSame( '<!-- wp:pattern {"slug":"imet-theme/offer-banner"} /-->', SyncedSections::block( 'offer-banner' ) );

		( new SyncedSections() )->seed();

		$this->assertSame( '<!-- wp:block {"ref":' . SyncedSections::id( 'offer-banner' ) . '} /-->', SyncedSections::block( 'offer-banner' ) );
		$this->assertSame( '', SyncedSections::block( 'no-such-section' ) );
	}
}

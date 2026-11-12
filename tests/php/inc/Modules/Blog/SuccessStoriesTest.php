<?php
/**
 * Test SuccessStories class.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

// phpcs:disable WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- query-var fixtures, not queries.

use IMET\Theme\Modules\Blog\SuccessStories;
use IMET\Theme\Tests\TestCase;

/**
 * Class SuccessStoriesTest
 *
 * @since 1.1.38
 */
class SuccessStoriesTest extends TestCase {

	/**
	 * Instance under test.
	 *
	 * @var SuccessStories
	 */
	private SuccessStories $instance;

	/**
	 * Set up.
	 */
	public function setUp(): void {
		parent::setUp();

		$this->instance = new SuccessStories();
	}

	/**
	 * Test class implements Registrable and hooks the query filter.
	 */
	public function test_registers_hooks(): void {
		$this->assertInstanceOf( 'rtCamp\WPPrimitives\Contracts\Interfaces\Registrable', $this->instance );

		$this->instance->register_hooks();

		$this->assertGreaterThan( 0, has_filter( 'query_loop_block_query_vars', [ $this->instance, 'query_vars' ] ) );
	}

	/**
	 * A stories loop over an empty category lists the latest posts instead.
	 */
	public function test_empty_category_falls_back_to_latest_posts(): void {
		$term = self::factory()->category->create( [ 'slug' => SuccessStories::CATEGORY ] );
		$vars = [
			'posts_per_page' => 3,
			'tax_query'      => [
				[
					'taxonomy' => 'category',
					'terms'    => [ $term ],
				],
			],
		];

		$out = $this->instance->query_vars( $vars, $this->block( true ) );

		$this->assertArrayNotHasKey( 'tax_query', $out );
		$this->assertSame( 3, $out['posts_per_page'] );
	}

	/**
	 * Once the category has a story, the loop keeps to it.
	 */
	public function test_category_with_stories_is_kept(): void {
		$term = self::factory()->category->create( [ 'slug' => SuccessStories::CATEGORY ] );
		self::factory()->post->create( [ 'post_category' => [ $term ] ] );
		$vars = [
			'tax_query' => [
				[
					'taxonomy' => 'category',
					'terms'    => [ $term ],
				],
			],
		];

		$this->assertSame( $vars, $this->instance->query_vars( $vars, $this->block( true ) ) );
	}

	/**
	 * Other loops are left alone.
	 */
	public function test_other_loops_are_untouched(): void {
		$vars = [
			'tax_query' => [
				[
					'taxonomy' => 'category',
					'terms'    => [ 1 ],
				],
			],
		];

		$this->assertSame( $vars, $this->instance->query_vars( $vars, $this->block( false ) ) );
	}

	/**
	 * A Post Template block inside a Query Loop, flagged as a stories loop or not.
	 *
	 * @param bool $stories Whether the loop is flagged.
	 *
	 * @return WP_Block The block.
	 */
	private function block( bool $stories ): WP_Block {
		$query = [ 'perPage' => 3 ];

		if ( $stories ) {
			$query['imetStories'] = true;
		}

		return new WP_Block( [ 'blockName' => 'core/post-template' ], [ 'query' => $query ] );
	}
}

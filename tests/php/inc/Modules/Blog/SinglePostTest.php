<?php
/**
 * Test SinglePost class.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

use IMET\Theme\Modules\Blog\SinglePost;
use IMET\Theme\Tests\TestCase;

/**
 * Class SinglePostTest
 *
 * @since 1.1.18
 */
class SinglePostTest extends TestCase {

	/**
	 * Instance under test.
	 *
	 * @var SinglePost
	 */
	private SinglePost $instance;

	/**
	 * Set up.
	 */
	public function setUp(): void {
		parent::setUp();

		$this->instance = new SinglePost();
	}

	/**
	 * Test class implements Registrable.
	 */
	public function test_implements_registrable(): void {
		$this->assertInstanceOf( 'rtCamp\WPPrimitives\Contracts\Interfaces\Registrable', $this->instance );
	}

	/**
	 * Test the shortcodes and the query filter are registered.
	 */
	public function test_registers_hooks(): void {
		$this->instance->register_hooks();

		$this->assertTrue( shortcode_exists( 'imet_share_linkedin' ) );
		$this->assertTrue( shortcode_exists( 'imet_author_linkedin' ) );
		$this->assertGreaterThan( 0, has_filter( 'query_loop_block_query_vars', [ $this->instance, 'related_query_vars' ] ) );
	}

	/**
	 * Test the share link carries the current post's address.
	 */
	public function test_share_link_uses_the_permalink(): void {
		$post_id = self::factory()->post->create();
		$this->go_to( get_permalink( $post_id ) );

		$html = $this->instance->share_linkedin();

		$this->assertStringContainsString( 'linkedin.com/sharing/share-offsite/?url=' . rawurlencode( (string) get_permalink( $post_id ) ), $html );
		$this->assertStringContainsString( 'rel="noopener noreferrer"', $html );
	}

	/**
	 * Test the share link prints nothing away from a single post.
	 */
	public function test_share_link_is_empty_off_a_post(): void {
		$this->go_to( home_url( '/' ) );

		$this->assertSame( '', $this->instance->share_linkedin() );
	}

	/**
	 * Test the author link uses a LinkedIn website and ignores any other website.
	 */
	public function test_author_link_needs_a_linkedin_website(): void {
		$author  = self::factory()->user->create( [ 'user_url' => 'https://www.linkedin.com/in/someone/' ] );
		$post_id = self::factory()->post->create( [ 'post_author' => $author ] );
		$this->go_to( get_permalink( $post_id ) );

		$this->assertStringContainsString( 'href="https://www.linkedin.com/in/someone/"', $this->instance->author_linkedin() );

		wp_update_user(
			[
				'ID'       => $author,
				'user_url' => 'https://example.com/',
			]
		);

		$this->assertSame( '', $this->instance->author_linkedin() );
	}

	/**
	 * Test a related-posts query takes the post's categories and leaves the post out.
	 */
	public function test_related_query_vars(): void {
		$category = self::factory()->category->create();
		$post_id  = self::factory()->post->create( [ 'post_category' => [ $category ] ] );
		$this->go_to( get_permalink( $post_id ) );

		$block = new WP_Block(
			[ 'blockName' => 'core/post-template' ],
			[ 'query' => [ 'imetRelated' => true ] ]
		);

		$vars = $this->instance->related_query_vars( [ 'posts_per_page' => 3 ], $block );

		$this->assertSame( [ $post_id ], $vars['post__not_in'] );
		$this->assertSame( [ $category ], $vars['category__in'] );
		$this->assertSame( 3, $vars['posts_per_page'] );
	}

	/**
	 * Test other queries are left alone.
	 */
	public function test_other_queries_are_untouched(): void {
		$block = new WP_Block( [ 'blockName' => 'core/post-template' ], [ 'query' => [ 'perPage' => 6 ] ] );

		$this->assertSame( [ 'posts_per_page' => 6 ], $this->instance->related_query_vars( [ 'posts_per_page' => 6 ], $block ) );
	}
}

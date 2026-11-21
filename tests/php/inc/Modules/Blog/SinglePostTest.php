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
		$this->assertGreaterThan( 0, has_filter( 'render_block_core/post-content', [ $this->instance, 'article_parts' ] ) );
		$this->assertGreaterThan( 0, has_filter( 'render_block_core/post-terms', [ $this->instance, 'tags_or_categories' ] ) );
	}

	/**
	 * A rendered post body with the given number of H2 headings.
	 *
	 * @param int $headings Number of headings.
	 *
	 * @return string Markup.
	 */
	private function body( int $headings ): string {
		$html = '<div class="entry-content bp-content wp-block-post-content"><p>Intro</p>';

		for ( $i = 1; $i <= $headings; $i++ ) {
			$html .= '<h2>Heading ' . $i . '</h2><p>Text ' . $i . '</p>';
		}

		return $html . '</div>';
	}

	/**
	 * Test the parts land where the design has them: TL;DR first, then before the 2nd, 4th and 6th headings.
	 */
	public function test_article_parts_follow_the_headings(): void {
		self::factory()->post->create( [ 'post_title' => 'Older article' ] );
		$post_id = self::factory()->post->create( [ 'post_excerpt' => "First point.\nSecond point." ] );
		$this->go_to( get_permalink( $post_id ) );
		$GLOBALS['post'] = get_post( $post_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- the loop's post in a test.

		$html = $this->instance->article_parts( $this->body( 7 ), [ 'attrs' => [ 'className' => 'bp-content' ] ] );

		$this->assertMatchesRegularExpression( '/^<div[^>]*><div class="wp-block-group bp-tldr">/', $html );
		$this->assertStringContainsString( '<li>First point.</li><li>Second point.</li>', $html );
		$this->assertLessThan( strpos( $html, 'Heading 2' ), strpos( $html, 'bp-cta-card' ) );
		$this->assertGreaterThan( strpos( $html, 'Heading 1' ), strpos( $html, 'bp-cta-card' ) );
		$this->assertLessThan( strpos( $html, 'Heading 4' ), strpos( $html, 'bp-banner' ) );
		$this->assertGreaterThan( strpos( $html, 'Heading 3' ), strpos( $html, 'bp-banner' ) );
		$this->assertLessThan( strpos( $html, 'Heading 6' ), strpos( $html, 'bp-reading' ) );
		$this->assertStringContainsString( 'Older article', $html );
	}

	/**
	 * Test a short post gets the parts at the end, and a part the post already has isn't added twice.
	 */
	public function test_article_parts_short_post_and_own_parts(): void {
		$post_id = self::factory()->post->create( [ 'post_excerpt' => 'One sentence only.' ] );
		$this->go_to( get_permalink( $post_id ) );
		$GLOBALS['post'] = get_post( $post_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- the loop's post in a test.

		$body = str_replace( '<p>Intro</p>', '<div class="wp-block-group bp-banner">Own banner</div>', $this->body( 1 ) );
		$html = $this->instance->article_parts( $body, [ 'attrs' => [ 'className' => 'bp-content' ] ] );

		$this->assertSame( 1, substr_count( $html, 'bp-banner' ) );
		$this->assertGreaterThan( strpos( $html, 'Text 1' ), strpos( $html, 'bp-cta-card' ) );
		$this->assertStringEndsWith( '</div></div>', $html );
		$this->assertStringContainsString( '<ol class="wp-block-list"><li>One sentence only.</li></ol>', $html );
	}

	/**
	 * Test other Post Content blocks and pages are left alone.
	 */
	public function test_article_parts_only_in_the_article(): void {
		$page_id = self::factory()->post->create( [ 'post_type' => 'page' ] );
		$this->go_to( get_permalink( $page_id ) );
		$GLOBALS['post'] = get_post( $page_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- the loop's post in a test.

		$this->assertSame( $this->body( 3 ), $this->instance->article_parts( $this->body( 3 ), [ 'attrs' => [ 'className' => 'bp-content' ] ] ) );
		$this->assertSame( 'x', $this->instance->article_parts( 'x', [ 'attrs' => [] ] ) );
	}

	/**
	 * Test a post without tags shows its categories as chips, and tags win when there are some.
	 */
	public function test_tag_chips_fall_back_to_categories(): void {
		$category = self::factory()->category->create( [ 'name' => 'Cyber Topics' ] );
		$post_id  = self::factory()->post->create( [ 'post_category' => [ $category ] ] );
		$this->go_to( get_permalink( $post_id ) );
		$GLOBALS['post'] = get_post( $post_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- the loop's post in a test.

		$block = [
			'attrs' => [
				'term'      => 'post_tag',
				'className' => 'bp-tags',
			],
		];
		$html  = $this->instance->tags_or_categories( '', $block );

		$this->assertStringContainsString( 'bp-tags', $html );
		$this->assertStringContainsString( '>Cyber Topics</a>', $html );
		$this->assertSame( '<div>tags</div>', $this->instance->tags_or_categories( '<div>tags</div>', $block ) );
		$this->assertSame( '', $this->instance->tags_or_categories( '', [ 'attrs' => [ 'term' => 'category' ] ] ) );
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
	 * Test the author link uses a LinkedIn website, and IMET's LinkedIn page for any other website or none.
	 */
	public function test_author_link_falls_back_to_imet_linkedin(): void {
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

		$this->assertStringContainsString( 'href="' . SinglePost::IMET_LINKEDIN . '"', $this->instance->author_linkedin() );
		$this->assertStringContainsString( 'IMET Worldwide on LinkedIn', $this->instance->author_linkedin() );

		wp_update_user(
			[
				'ID'       => $author,
				'user_url' => '',
			]
		);

		$this->assertStringContainsString( 'href="' . SinglePost::IMET_LINKEDIN . '"', $this->instance->author_linkedin() );
	}

	/**
	 * Test a related-posts query takes the post's categories and leaves the post out.
	 */
	public function test_related_query_vars(): void {
		$category = self::factory()->category->create();
		$post_id  = self::factory()->post->create( [ 'post_category' => [ $category ] ] );
		self::factory()->post->create( [ 'post_category' => [ $category ] ] );
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
	 * Test a post alone in its categories gets the latest other posts instead of an empty section.
	 */
	public function test_related_falls_back_to_latest_posts(): void {
		$category = self::factory()->category->create();
		$post_id  = self::factory()->post->create( [ 'post_category' => [ $category ] ] );
		self::factory()->post->create();
		$this->go_to( get_permalink( $post_id ) );

		$block = new WP_Block(
			[ 'blockName' => 'core/post-template' ],
			[ 'query' => [ 'imetRelated' => true ] ]
		);

		$vars = $this->instance->related_query_vars( [ 'posts_per_page' => 3 ], $block );

		$this->assertSame( [ $post_id ], $vars['post__not_in'] );
		$this->assertArrayNotHasKey( 'category__in', $vars );
	}

	/**
	 * Test other queries are left alone.
	 */
	public function test_other_queries_are_untouched(): void {
		$block = new WP_Block( [ 'blockName' => 'core/post-template' ], [ 'query' => [ 'perPage' => 6 ] ] );

		$this->assertSame( [ 'posts_per_page' => 6 ], $this->instance->related_query_vars( [ 'posts_per_page' => 6 ], $block ) );
	}
}

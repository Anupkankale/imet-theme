<?php
/**
 * The dynamic parts of the single post template.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Blog;

use WP_Block;
use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class SinglePost
 *
 * Fills the bits of templates/single.html that a block template can't express on its own:
 * - `[imet_share_linkedin]`: "Share this Resource" link that shares the current post on LinkedIn.
 * - `[imet_author_linkedin]`: the post author's LinkedIn profile, taken from the Website field of their user profile
 *   (printed only when that address is a linkedin.com one).
 * - "Our Related Blogs": a Query Loop whose `query` attribute has `"imetRelated": true` lists posts from the current
 *   post's categories, without the post itself (the latest posts when no other post shares a category).
 *
 * @since 1.1.18
 */
class SinglePost implements Registrable {

	/**
	 * Register hooks.
	 *
	 * @since 1.1.18
	 */
	public function register_hooks(): void {
		add_shortcode( 'imet_share_linkedin', [ $this, 'share_linkedin' ] );
		add_shortcode( 'imet_author_linkedin', [ $this, 'author_linkedin' ] );
		add_filter( 'query_loop_block_query_vars', [ $this, 'related_query_vars' ], 10, 2 );
	}

	/**
	 * Share-on-LinkedIn link for the current post.
	 *
	 * @since 1.1.18
	 *
	 * @return string Link markup, or '' away from a single post.
	 */
	public function share_linkedin(): string {
		if ( ! is_singular() ) {
			return '';
		}

		$permalink = get_permalink();

		if ( ! is_string( $permalink ) || '' === $permalink ) {
			return '';
		}

		return $this->linkedin_link(
			'https://www.linkedin.com/sharing/share-offsite/?url=' . rawurlencode( $permalink ),
			__( 'Share this article on LinkedIn', 'imet-theme' ),
			'bp-linkedin bp-share-linkedin'
		);
	}

	/**
	 * The post author's LinkedIn profile link.
	 *
	 * @since 1.1.18
	 *
	 * @return string Link markup, or '' when the author has no LinkedIn website.
	 */
	public function author_linkedin(): string {
		$post = get_post();

		if ( ! $post ) {
			return '';
		}

		$url  = (string) get_the_author_meta( 'user_url', (int) $post->post_author );
		$host = (string) wp_parse_url( $url, PHP_URL_HOST );

		if ( 'linkedin.com' !== $host && ! str_ends_with( $host, '.linkedin.com' ) ) {
			return '';
		}

		return $this->linkedin_link(
			$url,
			/* translators: %s: author name. */
			sprintf( __( '%s on LinkedIn', 'imet-theme' ), get_the_author_meta( 'display_name', (int) $post->post_author ) ),
			'bp-linkedin bp-author-linkedin'
		);
	}

	/**
	 * Query vars for the related-posts Query Loop.
	 *
	 * @since 1.1.18
	 *
	 * @param array<string, mixed> $query The query vars.
	 * @param WP_Block             $block The Post Template block.
	 *
	 * @return array<string, mixed> The query vars.
	 */
	public function related_query_vars( array $query, WP_Block $block ): array {
		if ( empty( $block->context['query']['imetRelated'] ) ) {
			return $query;
		}

		$post_id = get_queried_object_id();

		if ( ! $post_id ) {
			return $query;
		}

		$query['post__not_in']        = [ $post_id ]; // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in -- one ID, three posts.
		$query['ignore_sticky_posts'] = true;
		$categories                   = wp_get_post_categories( $post_id );

		if ( ! is_array( $categories ) || [] === $categories ) {
			return $query;
		}

		$categories = array_map( 'intval', $categories );

		// Only when another post shares a category: a post alone in its categories shows the latest posts instead, so
		// the section isn't empty (and hidden) on a new blog.
		$others = get_posts(
			[
				'category__in'           => $categories,
				'post__not_in'           => [ $post_id ], // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in -- one ID, one post.
				'numberposts'            => 1,
				'fields'                 => 'ids',
				'no_found_rows'          => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
			]
		);

		if ( [] !== $others ) {
			$query['category__in'] = $categories;
		}

		return $query;
	}

	/**
	 * A link with the LinkedIn logo that opens in a new tab.
	 *
	 * @param string $url     Address.
	 * @param string $label   Accessible name.
	 * @param string $classes CSS classes.
	 *
	 * @return string Link markup.
	 */
	private function linkedin_link( string $url, string $label, string $classes ): string {
		return sprintf(
			'<a class="%1$s" href="%2$s" target="_blank" rel="noopener noreferrer" aria-label="%3$s"><img src="%4$s" alt="" width="1000" height="250"/></a>',
			esc_attr( $classes ),
			esc_url( $url ),
			esc_attr( $label ),
			esc_url( get_theme_file_uri( 'assets/images/imet/linkedin-logo.svg' ) )
		);
	}
}

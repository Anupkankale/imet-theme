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
 *   (IMET's LinkedIn page when that address isn't a linkedin.com one).
 * - "Our Related Blogs": a Query Loop whose `query` attribute has `"imetRelated": true` lists posts from the current
 *   post's categories, without the post itself (the latest posts when no other post shares a category).
 * - The article parts of the design, added to every post's body (`.bp-content`) unless the post already has its own:
 *   the program card before the 2nd heading, the "Build job-ready skills" banner before the 4th and "Recommended
 *   Blog/Reading" (the newest other post) before the 6th; at the end when the post has fewer headings.
 * - The TL;DR box at the top of the article, from the writer's own TL;DR: a "TL;DR"/"TLDR" heading with a list under
 *   it, or the "Blog: TL;DR box" pattern, wherever it is in the post. A post without one gets no box. The excerpt is
 *   not used: writers keep it as the search/SEO description (the editor's "Blog layout" panel says so).
 * - The tag chips under the title (`.bp-tags`) show the post's categories when it has no tags.
 *
 * @since 1.1.18
 */
class SinglePost implements Registrable {

	/**
	 * IMET's LinkedIn page: the author box's link when the author has no LinkedIn profile.
	 *
	 * @since 1.1.84
	 * @var string
	 */
	public const IMET_LINKEDIN = 'https://www.linkedin.com/school/imetworldwide/';

	/**
	 * Register hooks.
	 *
	 * @since 1.1.18
	 */
	public function register_hooks(): void {
		add_shortcode( 'imet_share_linkedin', [ $this, 'share_linkedin' ] );
		add_shortcode( 'imet_author_linkedin', [ $this, 'author_linkedin' ] );
		add_filter( 'query_loop_block_query_vars', [ $this, 'related_query_vars' ], 10, 2 );
		add_filter( 'render_block_core/post-content', [ $this, 'article_parts' ], 10, 2 );
		add_filter( 'render_block_core/post-terms', [ $this, 'tags_or_categories' ], 10, 2 );
	}

	/**
	 * Adds the design's article parts to a post's body: the TL;DR box at the top, then the program card, the contact
	 * banner and the recommended article before the 2nd, 4th and 6th headings. A part the post already has is skipped.
	 *
	 * @since 1.1.89
	 *
	 * @param string               $content The rendered post content.
	 * @param array<string, mixed> $block   The parsed block.
	 *
	 * @return string The content with the parts added.
	 */
	public function article_parts( string $content, array $block ): string {
		$class = (string) ( $block['attrs']['className'] ?? '' );
		$post  = get_post();

		if ( ! str_contains( $class, 'bp-content' ) || ! $post || 'post' !== $post->post_type ) {
			return $content;
		}

		// The writer's TL;DR comes out first, so its heading isn't counted for the parts below; it goes back in at the top.
		[ $content, $tldr ] = $this->take_tldr( $content );

		$parts = [
			'bp-cta-card' => 2,
			'bp-banner'   => 4,
			'bp-reading'  => 6,
		];

		$inserts = [];

		foreach ( $parts as $part => $heading ) {
			if ( str_contains( $content, $part ) ) {
				continue;
			}

			$html = 'bp-reading' === $part ? $this->recommended( $post->ID ) : $this->pattern( 'bp-cta-card' === $part ? 'blog-program-cta' : 'blog-skills-banner' );

			if ( '' !== $html ) {
				$inserts[ $heading ] = $html;
			}
		}

		$content = $this->insert_before_headings( $content, $inserts );

		// First thing inside the post content wrapper.
		if ( '' !== $tldr && 1 === preg_match( '/^\s*<div\b[^>]*>/', $content, $wrapper ) ) {
			$content = substr_replace( $content, $tldr, strlen( $wrapper[0] ), 0 );
		}

		return $content;
	}

	/**
	 * Takes the writer's TL;DR out of the post body: the "Blog: TL;DR box" pattern as it is, or a heading that reads
	 * "TL;DR" (also "TLDR", "TL DR", "TL:DR") with a list right under it, made into the box.
	 *
	 * @since 1.1.103
	 *
	 * @param string $content The rendered post content.
	 *
	 * @return array{0: string, 1: string} The content without the TL;DR, and the box ('' when the post has none).
	 */
	private function take_tldr( string $content ): array {
		// The pattern's box.
		if ( 1 === preg_match( '/<div\b[^>]*\bclass="[^"]*\bbp-tldr\b[^"]*"[^>]*>/', $content, $box, PREG_OFFSET_CAPTURE ) ) {
			$start = (int) $box[0][1];
			$end   = $this->element_end( $content, $start, 'div' );

			if ( null !== $end ) {
				return [ substr_replace( $content, '', $start, $end - $start ), substr( $content, $start, $end - $start ) ];
			}
		}

		// A TL;DR heading and the list under it.
		preg_match_all( '/<h([2-4])\b[^>]*>(.*?)<\/h\1>\s*/is', $content, $headings, PREG_SET_ORDER | PREG_OFFSET_CAPTURE );

		foreach ( $headings as $heading ) {
			if ( 1 !== preg_match( '/^\W*TL\W{0,2}DR\b/i', trim( html_entity_decode( wp_strip_all_tags( $heading[2][0] ) ) ) ) ) {
				continue;
			}

			$start = (int) $heading[0][1];
			$after = $start + strlen( $heading[0][0] );

			if ( 1 !== preg_match( '/\G<(ul|ol)\b[^>]*>/i', $content, $list, 0, $after ) ) {
				continue;
			}

			$end = $this->element_end( $content, $after, strtolower( $list[1] ) );

			if ( null === $end ) {
				continue;
			}

			$items = substr( $content, $after + strlen( $list[0] ), $end - $after - strlen( $list[0] ) - strlen( '</' . $list[1] . '>' ) );
			$box   = '<div class="wp-block-group bp-tldr"><p class="bp-tldr-title">' . esc_html__( 'TL;DR', 'imet-theme' ) . '</p><ol class="wp-block-list">' . $items . '</ol></div>';

			return [ substr_replace( $content, '', $start, $end - $start ), $box ];
		}

		return [ $content, '' ];
	}

	/**
	 * Where an element ends (just after its closing tag), counting the same tags nested inside it.
	 *
	 * @param string $html  Markup.
	 * @param int    $start Offset of the element's opening tag.
	 * @param string $tag   Tag name.
	 *
	 * @return int|null Offset after the closing tag, or null when it isn't closed.
	 */
	private function element_end( string $html, int $start, string $tag ): ?int {
		preg_match_all( '/<(\/?)' . $tag . '\b[^>]*>/i', $html, $tags, PREG_SET_ORDER | PREG_OFFSET_CAPTURE, $start );
		$depth = 0;

		foreach ( $tags as $found ) {
			$depth += '' === $found[1][0] ? 1 : -1;

			if ( 0 === $depth ) {
				return (int) $found[0][1] + strlen( $found[0][0] );
			}
		}

		return null;
	}

	/**
	 * The post's categories as the tag chips, for a post without tags.
	 *
	 * @since 1.1.89
	 *
	 * @param string               $content The rendered Post Terms block.
	 * @param array<string, mixed> $block   The parsed block.
	 *
	 * @return string The chips.
	 */
	public function tags_or_categories( string $content, array $block ): string {
		$class = (string) ( $block['attrs']['className'] ?? '' );

		if ( '' !== trim( $content ) || 'post_tag' !== ( $block['attrs']['term'] ?? '' ) || ! str_contains( $class, 'bp-tags' ) ) {
			return $content;
		}

		$links = [];

		foreach ( get_the_category() as $category ) {
			if ( 'uncategorized' === $category->slug ) {
				continue;
			}

			$links[] = sprintf( '<a href="%1$s" rel="tag">%2$s</a>', esc_url( get_category_link( $category ) ), esc_html( $category->name ) );
		}

		if ( [] === $links ) {
			return $content;
		}

		return '<div class="taxonomy-category bp-tags wp-block-post-terms">' . implode( '', $links ) . '</div>';
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
	 * The post author's LinkedIn profile link, or IMET's LinkedIn page when the author's Website isn't a LinkedIn one
	 * (the author box always shows the logo, as in the design).
	 *
	 * @since 1.1.18
	 *
	 * @return string Link markup, or '' away from a post.
	 */
	public function author_linkedin(): string {
		$post = get_post();

		if ( ! $post ) {
			return '';
		}

		$url  = (string) get_the_author_meta( 'user_url', (int) $post->post_author );
		$host = (string) wp_parse_url( $url, PHP_URL_HOST );

		if ( 'linkedin.com' !== $host && ! str_ends_with( $host, '.linkedin.com' ) ) {
			return $this->linkedin_link( self::IMET_LINKEDIN, __( 'IMET Worldwide on LinkedIn', 'imet-theme' ), 'bp-linkedin bp-author-linkedin' );
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
	 * Puts each piece of markup in front of the post's nth H2 (1-based), or at the end when there are fewer headings.
	 *
	 * @param string             $content Rendered post content.
	 * @param array<int, string> $inserts Markup by heading number.
	 *
	 * @return string The content.
	 */
	private function insert_before_headings( string $content, array $inserts ): string {
		if ( [] === $inserts ) {
			return $content;
		}

		preg_match_all( '/<h2\b/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$offsets = array_column( $matches[0], 1 );
		$tail    = '';

		krsort( $inserts ); // From the last heading back, so the earlier offsets stay right.

		foreach ( $inserts as $heading => $html ) {
			if ( ! isset( $offsets[ $heading - 1 ] ) ) {
				$tail = $html . $tail;
				continue;
			}

			$content = substr_replace( $content, $html, (int) $offsets[ $heading - 1 ], 0 );
		}

		if ( '' === $tail ) {
			return $content;
		}

		// Inside the post content wrapper, after its last child.
		$end = strrpos( $content, '</div>' );

		return false === $end ? $content . $tail : substr_replace( $content, $tail, $end, 0 );
	}

	/**
	 * A theme pattern, rendered.
	 *
	 * @param string $slug Pattern slug without the theme prefix.
	 *
	 * @return string Markup, or '' when the pattern isn't registered.
	 */
	private function pattern( string $slug ): string {
		$pattern = \WP_Block_Patterns_Registry::get_instance()->get_registered( 'imet-theme/' . $slug );

		return is_array( $pattern ) && isset( $pattern['content'] ) ? do_blocks( (string) $pattern['content'] ) : '';
	}

	/**
	 * "Recommended Blog/Reading" for the newest other post: its title and featured image, both linked.
	 *
	 * @param int $post_id The current post.
	 *
	 * @return string Markup, or '' when there is no other post.
	 */
	private function recommended( int $post_id ): string {
		$others = get_posts(
			[
				'post__not_in'     => [ $post_id ], // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in -- one ID, one post.
				'numberposts'      => 1,
				'suppress_filters' => false,
			]
		);

		if ( [] === $others ) {
			return '';
		}

		$other = $others[0];
		$url   = (string) get_permalink( $other );
		$image = get_the_post_thumbnail( $other, 'medium_large', [ 'alt' => '' ] );

		return sprintf(
			'<div class="wp-block-group bp-reading"><div class="wp-block-group bp-reading-text"><p class="bp-reading-label">%1$s</p><p><a href="%2$s">%3$s</a></p></div>%4$s</div>',
			esc_html__( 'Recommended Blog/Reading', 'imet-theme' ),
			esc_url( $url ),
			esc_html( get_the_title( $other ) ),
			'' === $image ? '' : '<figure class="wp-block-image bp-reading-img"><a href="' . esc_url( $url ) . '" tabindex="-1">' . $image . '</a></figure>'
		);
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

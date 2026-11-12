<?php
/**
 * Success Stories page: stories loops that never show empty.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Blog;

use WP_Block;
use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class SuccessStories
 *
 * The Success Stories and Case Studies pages list posts in their own category (Query Loops whose `query` attribute
 * has `"imetStories": true`, see patterns/success-stories-page.php and case-studies-page.php). While a loop's category
 * has no published post yet, the loop lists the latest posts instead, so the page keeps its layout; the first post
 * filed in the category takes over.
 *
 * @since 1.1.38
 */
class SuccessStories implements Registrable {

	/**
	 * Slug of the category the stories are filed under.
	 *
	 * @since 1.1.38
	 * @var string
	 */
	public const CATEGORY = 'success-stories';

	/**
	 * Register hooks.
	 *
	 * @since 1.1.38
	 */
	public function register_hooks(): void {
		add_filter( 'query_loop_block_query_vars', [ $this, 'query_vars' ], 10, 2 );
	}

	/**
	 * Drop the category filter from a stories loop while the category has no published post.
	 *
	 * @since 1.1.38
	 *
	 * @param array<string, mixed> $query The query vars.
	 * @param WP_Block             $block The Post Template block.
	 *
	 * @return array<string, mixed> The query vars.
	 */
	public function query_vars( array $query, WP_Block $block ): array {
		if ( empty( $block->context['query']['imetStories'] ) || ! isset( $query['tax_query'] ) ) {
			return $query;
		}

		// The loop's own category (Success Stories, Case Studies, ...): kept while it has a published post.
		$terms = $this->category_ids( (array) $query['tax_query'] );

		foreach ( $terms as $term_id ) {
			if ( $this->has_stories( $term_id ) ) {
				return $query;
			}
		}

		unset( $query['tax_query'] );

		return $query;
	}

	/**
	 * The category IDs a tax query filters on.
	 *
	 * @param array<int|string, mixed> $tax_query The tax query.
	 *
	 * @return array<int, int> Category IDs.
	 */
	private function category_ids( array $tax_query ): array {
		$ids = [];

		foreach ( $tax_query as $clause ) {
			if ( is_array( $clause ) && 'category' === ( $clause['taxonomy'] ?? '' ) ) {
				$ids = array_merge( $ids, array_map( 'intval', (array) ( $clause['terms'] ?? [] ) ) );
			}
		}

		return $ids;
	}

	/**
	 * Whether a category has at least one published post.
	 *
	 * @param int $term_id Category ID.
	 *
	 * @return bool True when it has one.
	 */
	private function has_stories( int $term_id ): bool {
		$found = get_posts(
			[
				'cat'                    => $term_id,
				'numberposts'            => 1,
				'fields'                 => 'ids',
				'no_found_rows'          => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
			]
		);

		return [] !== $found;
	}
}

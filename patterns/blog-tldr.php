<?php
/**
 * Title: Blog: TL;DR box
 * Slug: imet-theme/blog-tldr
 * Description: Key takeaways at the top of an article: a "TL;DR" title with a rocket icon over a two-column numbered list. Styled inside blog articles (templates/single.html).
 * Categories: imet-sections
 * Keywords: imet, blog, article, tldr, summary, takeaways
 * Viewport Width: 800
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:group {"className":"bp-tldr","layout":{"type":"default"}} -->
<div class="wp-block-group bp-tldr"><!-- wp:paragraph {"className":"bp-tldr-title"} -->
<p class="bp-tldr-title"><?php esc_html_e( 'TL;DR', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:list {"ordered":true} -->
<ol class="wp-block-list"><!-- wp:list-item -->
<li><?php esc_html_e( 'Digital leadership is no longer optional.', 'imet-theme' ); ?></li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li><?php esc_html_e( 'CXOs must build digital fluency, not just delegate it.', 'imet-theme' ); ?></li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li><?php esc_html_e( 'Research skills turn experience into credible insight.', 'imet-theme' ); ?></li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li><?php esc_html_e( 'A doctorate signals strategic depth to boards.', 'imet-theme' ); ?></li>
<!-- /wp:list-item --></ol>
<!-- /wp:list --></div>
<!-- /wp:group -->

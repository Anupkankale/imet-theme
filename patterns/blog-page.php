<?php
/**
 * Title: Blog Page
 * Slug: imet-theme/blog-page
 * Description: The blog's main page: a hero with the latest article, the newest Doctorate and MBA articles under two tabs (each with View More to its category), and a sidebar with the advisor form, article search and tags. Used by the posts page template (templates/home.html) and insertable on a page.
 * Categories: imet-pages
 * Keywords: imet, page, blog, articles, posts
 * Block Types: core/post-content
 * Viewport Width: 1440
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// One tab per category, found by slug (IDs differ from site to site). Without the category the tab lists every article.
$imet_blog_tabs = array();

foreach (
	array(
		'doctorate-blogs' => __( 'Doctorate', 'imet-theme' ),
		'mba'             => __( 'MBA', 'imet-theme' ),
	) as $imet_slug => $imet_label
) {
	$imet_term        = get_category_by_slug( $imet_slug );
	$imet_blog_tabs[] = array(
		'slug'  => $imet_slug,
		'label' => $imet_label,
		'id'    => $imet_term ? (int) $imet_term->term_id : 0,
		'link'  => $imet_term ? get_category_link( $imet_term ) : home_url( '/blog/' ),
	);
}
?>
<!-- wp:imet/section {"className":"bl-hero"} -->
<section class="wp-block-imet-section alignfull imet-section section imet-blank bl-hero"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"bl-hero-bg"} -->
<figure class="wp-block-image size-full bl-hero-bg"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/blog-hero-bg.webp' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->
<!-- wp:group {"className":"imet-container bl-hero-text","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container bl-hero-text"><!-- wp:paragraph {"className":"bl-crumbs"} -->
<p class="bl-crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'imet-theme' ); ?></a> &gt; <?php esc_html_e( 'Blog', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"eyebrow-line"} -->
<p class="eyebrow-line"><?php esc_html_e( 'Blog', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Ideas for leaders who are ready for what’s next.', 'imet-theme' ); ?></h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"bl-lead"} -->
<p class="bl-lead"><?php esc_html_e( 'Explore practical perspectives on AI, cybersecurity, business leadership and doctoral research, created for professionals who want to turn experience into meaningful impact.', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:query {"queryId":20,"query":{"perPage":1,"pages":1,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"bl-latest"} -->
<div class="wp-block-query bl-latest"><!-- wp:post-template -->
<!-- wp:read-more {"content":"<?php echo esc_attr__( 'Read Latest Article', 'imet-theme' ); ?>","className":"bl-latest-btn"} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->
<!-- wp:imet/section {"anchor":"articles","className":"bl-main"} -->
<section id="articles" class="wp-block-imet-section alignfull imet-section section imet-blank bl-main"><!-- wp:group {"className":"imet-container bl-layout","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container bl-layout"><!-- wp:group {"className":"bl-posts","layout":{"type":"default"}} -->
<div class="wp-block-group bl-posts"><!-- wp:buttons {"className":"bl-tabs"} -->
<div class="wp-block-buttons bl-tabs">
<?php foreach ( $imet_blog_tabs as $imet_i => $imet_tab ) : ?>
<!-- wp:button<?php echo 0 === $imet_i ? ' {"className":"is-active"}' : ''; ?> -->
<div class="wp-block-button<?php echo 0 === $imet_i ? ' is-active' : ''; ?>"><a class="wp-block-button__link wp-element-button" href="#<?php echo esc_attr( $imet_tab['slug'] ); ?>"><?php echo esc_html( $imet_tab['label'] ); ?></a></div>
<!-- /wp:button -->
<?php endforeach; ?>
</div>
<!-- /wp:buttons -->
<?php
foreach ( $imet_blog_tabs as $imet_i => $imet_tab ) :
	$imet_query = array(
		'perPage'  => 6,
		'pages'    => 1,
		'offset'   => 0,
		'postType' => 'post',
		'order'    => 'desc',
		'orderBy'  => 'date',
		'author'   => '',
		'search'   => '',
		'exclude'  => array(),
		'sticky'   => '',
		'inherit'  => false,
	);
	if ( $imet_tab['id'] ) {
		$imet_query['taxQuery'] = array( 'category' => array( $imet_tab['id'] ) );
	}
	?>
<!-- wp:group {"className":"bl-panel bl-panel-<?php echo esc_attr( $imet_tab['slug'] ); ?>","layout":{"type":"default"}} -->
<div class="wp-block-group bl-panel bl-panel-<?php echo esc_attr( $imet_tab['slug'] ); ?>"><!-- wp:query <?php echo wp_json_encode( array( 'queryId' => 21 + $imet_i, 'query' => $imet_query, 'className' => 'bl-query' ) ); ?> -->
<div class="wp-block-query bl-query"><!-- wp:post-template {"className":"bl-grid","layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"className":"bl-card","layout":{"type":"default"}} -->
<div class="wp-block-group bl-card"><!-- wp:post-featured-image {"isLink":true,"className":"bl-img"} /-->
<!-- wp:post-terms {"term":"category","separator":" · ","className":"bl-cats"} /-->
<!-- wp:post-title {"level":3,"isLink":true,"className":"bl-title"} /-->
<!-- wp:post-excerpt {"excerptLength":12,"className":"bl-excerpt"} /-->
<!-- wp:read-more {"content":"<?php echo esc_attr__( 'Read article', 'imet-theme' ); ?>","className":"bl-read"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->
<!-- wp:query-no-results -->
<!-- wp:paragraph {"className":"bl-empty"} -->
<p class="bl-empty"><?php esc_html_e( 'New articles are on their way.', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->
<!-- wp:buttons {"className":"bl-more"} -->
<div class="wp-block-buttons bl-more"><!-- wp:button {"className":"btn-navy btn-md"} -->
<div class="wp-block-button btn-navy btn-md"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $imet_tab['link'] ); ?>"><?php esc_html_e( 'View More', 'imet-theme' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->
<!-- wp:group {"className":"bl-aside","layout":{"type":"default"}} -->
<div class="wp-block-group bl-aside"><!-- wp:group {"anchor":"advisor-form","className":"bl-form","layout":{"type":"default"}} -->
<div id="advisor-form" class="wp-block-group bl-form"><!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Talk to an Advisor', 'imet-theme' ); ?></h2>
<!-- /wp:heading -->
<!-- wp:shortcode -->
[imet_advisor_form]
<!-- /wp:shortcode --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"bl-hub","layout":{"type":"default"}} -->
<div class="wp-block-group bl-hub"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Explore the knowledge hub with Tags', 'imet-theme' ); ?></h3>
<!-- /wp:heading -->
<!-- wp:search {"label":"<?php echo esc_attr__( 'Search articles', 'imet-theme' ); ?>","showLabel":false,"placeholder":"<?php echo esc_attr__( 'Search articles, topics, keywords', 'imet-theme' ); ?>","buttonText":"<?php echo esc_attr__( 'Search', 'imet-theme' ); ?>","buttonPosition":"button-inside","buttonUseIcon":true,"className":"bl-search"} /-->
<!-- wp:tag-cloud {"smallestFontSize":"12pt","largestFontSize":"12pt","className":"bl-tags"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->

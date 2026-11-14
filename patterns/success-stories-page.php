<?php
/**
 * Title: Success Stories Page
 * Slug: imet-theme/success-stories-page
 * Description: Success stories: a hero (convocation photo under a round gradient) with the latest story, story cards (posts in the "Success Stories" category, author shown as "by: …") beside a sticky advisor form, a Related Programs band, more stories with View More, and a "Case Studies of our Alumni" box.
 * Categories: imet-pages
 * Keywords: imet, page, success stories, alumni, case studies, stories
 * Block Types: core/post-content
 * Viewport Width: 1440
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// The stories are posts in the "Success Stories" category, found by slug (IDs differ from site to site). Without the
// category every post is listed, so the page never shows empty.
$imet_ss_term = get_category_by_slug( 'success-stories' );
$imet_ss_link = $imet_ss_term ? get_category_link( $imet_ss_term ) : home_url( '/blog/' );

/**
 * A Query Loop of story cards.
 *
 * @param int $query_id Query ID (unique on the page).
 * @param int $per_page How many stories.
 * @param int $offset   How many newest stories to skip.
 */
$imet_ss_stories = static function ( int $query_id, int $per_page, int $offset ) use ( $imet_ss_term ): void {
	$query = array(
		'perPage'  => $per_page,
		'pages'    => 1,
		'offset'   => $offset,
		'postType' => 'post',
		'order'    => 'desc',
		'orderBy'  => 'date',
		'author'   => '',
		'search'   => '',
		'exclude'  => array(),
		'sticky'   => '',
		'inherit'  => false,
	);
	if ( $imet_ss_term ) {
		$query['taxQuery'] = array( 'category' => array( (int) $imet_ss_term->term_id ) );
	}
	$query['imetStories'] = true; // Latest posts while the category is still empty (SuccessStories).
	?>
<!-- wp:query <?php echo wp_json_encode( array( 'queryId' => $query_id, 'query' => $query, 'className' => 'bl-query ss-query' ) ); ?> -->
<div class="wp-block-query bl-query ss-query"><!-- wp:post-template {"className":"bl-grid","layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"className":"bl-card","layout":{"type":"default"}} -->
<div class="wp-block-group bl-card"><!-- wp:post-featured-image {"isLink":true,"className":"bl-img"} /-->
<!-- wp:post-author-name {"className":"ss-by"} /-->
<!-- wp:post-title {"level":3,"isLink":true,"className":"bl-title"} /-->
<!-- wp:post-excerpt {"excerptLength":12,"className":"bl-excerpt"} /-->
<!-- wp:read-more {"content":"<?php echo esc_attr__( 'Read story', 'imet-theme' ); ?>","className":"bl-read"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->
	<?php
};
?>
<!-- wp:imet/section {"className":"bl-hero ss-hero"} -->
<section class="wp-block-imet-section alignfull imet-section section imet-blank bl-hero ss-hero"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"bl-hero-bg"} -->
<figure class="wp-block-image size-full bl-hero-bg"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/ss-hero-bg.webp' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->
<!-- wp:group {"className":"imet-container bl-hero-text","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container bl-hero-text"><!-- wp:paragraph {"className":"bl-crumbs"} -->
<p class="bl-crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'imet-theme' ); ?></a> &gt; <?php esc_html_e( 'Success Stories', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"eyebrow-line"} -->
<p class="eyebrow-line"><?php esc_html_e( 'Success Stories', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Real leaders. Real journeys. Real impact.', 'imet-theme' ); ?></h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"bl-lead"} -->
<p class="bl-lead"><?php esc_html_e( 'See how senior IT leaders, CXOs and entrepreneurs turned their IMET Doctorate or MBA into boardroom roles, published research and global recognition.', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<?php
$imet_ss_latest = array(
	'perPage'  => 1,
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
if ( $imet_ss_term ) {
	$imet_ss_latest['taxQuery'] = array( 'category' => array( (int) $imet_ss_term->term_id ) );
}
$imet_ss_latest['imetStories'] = true;
?>
<!-- wp:query <?php echo wp_json_encode( array( 'queryId' => 40, 'query' => $imet_ss_latest, 'className' => 'bl-latest' ) ); ?> -->
<div class="wp-block-query bl-latest"><!-- wp:post-template -->
<!-- wp:read-more {"content":"<?php echo esc_attr__( 'Read Latest Story', 'imet-theme' ); ?>","className":"bl-latest-btn"} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->
<!-- wp:imet/section {"anchor":"stories","className":"bl-main ss-main"} -->
<section id="stories" class="wp-block-imet-section alignfull imet-section section imet-blank bl-main ss-main"><!-- wp:group {"className":"imet-container bl-layout","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container bl-layout"><!-- wp:group {"className":"bl-posts ss-col","layout":{"type":"default"}} -->
<div class="wp-block-group bl-posts ss-col">
<?php $imet_ss_stories( 41, 3, 0 ); ?>
<!-- wp:group {"className":"ss-programs","layout":{"type":"default"}} -->
<div class="wp-block-group ss-programs"><!-- wp:group {"className":"ss-programs-text","layout":{"type":"default"}} -->
<div class="wp-block-group ss-programs-text"><!-- wp:paragraph {"className":"eyebrow-line left"} -->
<p class="eyebrow-line left"><?php esc_html_e( 'Related Programs', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Top Featured Doctorate (DBA) & Masters (MBA) Programs', 'imet-theme' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"ss-programs-links","layout":{"type":"default"}} -->
<div class="wp-block-group ss-programs-links"><!-- wp:paragraph {"className":"ss-program-link"} -->
<p class="ss-program-link"><a href="<?php echo esc_url( home_url( '/online-doctorate-business-administration-dba-programs/' ) ); ?>"><?php esc_html_e( 'Doctorate (DBA) Programs', 'imet-theme' ); ?></a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"ss-program-link"} -->
<p class="ss-program-link"><a href="<?php echo esc_url( home_url( '/online-masters-mba-degree-programs/' ) ); ?>"><?php esc_html_e( 'Online MBA Programs', 'imet-theme' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<?php $imet_ss_stories( 42, 3, 3 ); ?>
<!-- wp:buttons {"className":"bl-more"} -->
<div class="wp-block-buttons bl-more"><!-- wp:button {"className":"btn-navy btn-md"} -->
<div class="wp-block-button btn-navy btn-md"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $imet_ss_link ); ?>"><?php esc_html_e( 'View More', 'imet-theme' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- wp:group {"className":"ss-cases","layout":{"type":"default"}} -->
<div class="wp-block-group ss-cases"><!-- wp:group {"className":"ss-cases-text","layout":{"type":"default"}} -->
<div class="wp-block-group ss-cases-text"><!-- wp:paragraph {"className":"eyebrow-line left"} -->
<p class="eyebrow-line left"><?php esc_html_e( 'Case Studies of our Alumni', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Publish your research paper in International Journals', 'imet-theme' ); ?></h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p><?php esc_html_e( 'Discover real journeys of transformation from IMET alumni who turned their doctoral research into global recognition.', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-white btn-md"} -->
<div class="wp-block-button btn-white btn-md"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/case-studies/' ) ); ?>"><?php esc_html_e( 'View More', 'imet-theme' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
<?php require get_theme_file_path( 'inc/pattern-parts/alumni-cases.php' ); ?></div>
<!-- /wp:group -->
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
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->

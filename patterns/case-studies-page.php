<?php
/**
 * Title: Case Studies Page
 * Slug: imet-theme/case-studies-page
 * Description: Alumni case studies (Case Study post type from imet-core): a light hero with floating alumni avatars on a dashed arc and a button to the latest case study PDF, person cards (photo, name, summary, Read More opens the PDF) beside the sticky advisor form, a Related Programs band, the other case studies, and a Success Stories banner.
 * Categories: imet-pages
 * Keywords: imet, page, case studies, case study, alumni, stories
 * Block Types: core/post-content
 * Viewport Width: 1440
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// The case studies are the Case Study post type (imet-core): name = title, photo = featured image, summary = excerpt,
// and a PDF field (imet_case_study_pdf) that Read More opens in a new tab, bound with core/post-meta.

/**
 * The query of a case-studies loop.
 *
 * @param int $per_page How many.
 * @param int $offset   How many newest to skip.
 *
 * @return array<string, mixed> Query attribute.
 */
$imet_cs_query = static function ( int $per_page, int $offset ): array {
	return array(
		'perPage'  => $per_page,
		'pages'    => 1,
		'offset'   => $offset,
		'postType' => 'imet_case_study',
		'order'    => 'desc',
		'orderBy'  => 'date',
		'author'   => '',
		'search'   => '',
		'exclude'  => array(),
		'sticky'   => '',
		'inherit'  => false,
	);
};

/**
 * A button whose link is the case study's PDF (opens in a new tab).
 *
 * @param string $label      Button text.
 * @param string $class_name Button block class.
 */
$imet_cs_pdf_button = static function ( string $label, string $class_name ): void {
	$attrs = array(
		'className'  => $class_name,
		'linkTarget' => '_blank',
		'rel'        => 'noopener',
		'metadata'   => array(
			'bindings' => array(
				'url' => array(
					'source' => 'core/post-meta',
					'args'   => array( 'key' => 'imet_case_study_pdf' ),
				),
			),
		),
	);
	?>
<!-- wp:button <?php echo wp_json_encode( $attrs ); ?> -->
<div class="wp-block-button <?php echo esc_attr( $class_name ); ?>"><a class="wp-block-button__link wp-element-button" target="_blank" rel="noopener"><?php echo esc_html( $label ); ?></a></div>
<!-- /wp:button -->
	<?php
};

/**
 * A row of person cards: the photo, the name, the summary and Read More (the PDF).
 *
 * @param int $query_id Query ID (unique on the page).
 * @param int $per_page How many.
 * @param int $offset   How many newest to skip.
 */
$imet_cs_cards = static function ( int $query_id, int $per_page, int $offset ) use ( $imet_cs_query, $imet_cs_pdf_button ): void {
	?>
<!-- wp:query <?php echo wp_json_encode( array( 'queryId' => $query_id, 'query' => $imet_cs_query( $per_page, $offset ), 'className' => 'cs-query' ) ); ?> -->
<div class="wp-block-query cs-query"><!-- wp:post-template {"className":"cs-grid","layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"className":"cs-card","layout":{"type":"default"}} -->
<div class="wp-block-group cs-card"><!-- wp:post-featured-image {"aspectRatio":"236/207","className":"cs-photo"} /-->
<!-- wp:post-title {"level":3,"className":"cs-name"} /-->
<!-- wp:post-excerpt {"excerptLength":22,"className":"cs-text"} /-->
<!-- wp:buttons {"className":"cs-read"} -->
<div class="wp-block-buttons cs-read"><?php $imet_cs_pdf_button( __( 'Read More', 'imet-theme' ), 'cs-read-btn' ); ?></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->
	<?php
};
?>
<!-- wp:imet/section {"className":"bl-hero cs-hero"} -->
<section class="wp-block-imet-section alignfull imet-section section imet-blank bl-hero cs-hero"><!-- wp:group {"className":"cs-avatars","layout":{"type":"default"}} -->
<div class="wp-block-group cs-avatars" aria-hidden="true">
<?php foreach ( range( 1, 6 ) as $imet_cs_n ) : ?>
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cs-avatar is-<?php echo (int) $imet_cs_n; ?>"} -->
<figure class="wp-block-image size-full cs-avatar is-<?php echo (int) $imet_cs_n; ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/cs-avatar-' . (int) $imet_cs_n . '.webp' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->
<!-- wp:group {"className":"imet-container bl-hero-text","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container bl-hero-text"><!-- wp:paragraph {"className":"bl-crumbs"} -->
<p class="bl-crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'imet-theme' ); ?></a> &gt; <?php esc_html_e( 'Case Studies', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"eyebrow-line"} -->
<p class="eyebrow-line"><?php esc_html_e( 'Case Study', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Ideas for leaders who are ready for what’s next.', 'imet-theme' ); ?></h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"bl-lead"} -->
<p class="bl-lead"><?php esc_html_e( 'Discover how IMET’s Doctorate (DBA) and MBA programs empower professionals to become global leaders, driving innovation, advancing careers, and achieving thought leadership.', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:query <?php echo wp_json_encode( array( 'queryId' => 50, 'query' => $imet_cs_query( 1, 0 ), 'className' => 'bl-latest' ) ); ?> -->
<div class="wp-block-query bl-latest"><!-- wp:post-template -->
<!-- wp:buttons -->
<div class="wp-block-buttons"><?php $imet_cs_pdf_button( __( 'Read Latest Case Study', 'imet-theme' ), 'btn-navy btn-lg cs-latest-btn' ); ?></div>
<!-- /wp:buttons -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->
<!-- wp:imet/section {"anchor":"case-studies","className":"bl-main ss-main cs-main"} -->
<section id="case-studies" class="wp-block-imet-section alignfull imet-section section imet-blank bl-main ss-main cs-main"><!-- wp:group {"className":"imet-container bl-layout","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container bl-layout"><!-- wp:group {"className":"bl-posts ss-col","layout":{"type":"default"}} -->
<div class="wp-block-group bl-posts ss-col">
<?php $imet_cs_cards( 51, 3, 0 ); ?>
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
<?php $imet_cs_cards( 52, 100, 3 ); ?>
<!-- wp:group {"className":"cs-banner","layout":{"type":"default"}} -->
<div class="wp-block-group cs-banner"><!-- wp:paragraph {"className":"eyebrow-line left"} -->
<p class="eyebrow-line left"><?php esc_html_e( 'Success Stories', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Publish your research paper', 'imet-theme' ); ?></h2>
<!-- /wp:heading -->
<!-- wp:group {"className":"cs-banner-foot","layout":{"type":"default"}} -->
<div class="wp-block-group cs-banner-foot"><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-white btn-sm"} -->
<div class="wp-block-button btn-white btn-sm"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/success-stories/' ) ); ?>"><?php esc_html_e( 'View More', 'imet-theme' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- wp:paragraph -->
<p><?php esc_html_e( 'Discover real journeys of success stories from IMET alumni.', 'imet-theme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
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

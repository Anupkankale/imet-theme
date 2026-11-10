<?php
/**
 * Title: Blog: Recommended reading
 * Slug: imet-theme/blog-recommended
 * Description: A navy strip inside an article pointing to another article: "Recommended Blog/Reading", the linked title and its thumbnail. Change the link, title and image to the article you recommend.
 * Categories: imet-sections
 * Keywords: imet, blog, article, related, recommended, reading
 * Viewport Width: 800
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$imet_reading_url = home_url( '/what-is-golden-visa-in-the-uae/' );
?>
<!-- wp:group {"className":"bp-reading","layout":{"type":"default"}} -->
<div class="wp-block-group bp-reading"><!-- wp:group {"className":"bp-reading-text","layout":{"type":"default"}} -->
<div class="wp-block-group bp-reading-text"><!-- wp:paragraph {"className":"bp-reading-label"} -->
<p class="bp-reading-label"><?php esc_html_e( 'Recommended Blog/Reading', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p><a href="<?php echo esc_url( $imet_reading_url ); ?>"><?php esc_html_e( 'What Is Golden Visa in the UAE? Eligibility, Benefits & Smart Pathways for Senior Professionals', 'imet-theme' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"bp-reading-img"} -->
<figure class="wp-block-image size-full bp-reading-img"><a href="<?php echo esc_url( $imet_reading_url ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/blog-reading.webp' ) ); ?>" alt="" width="612" height="324"/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<?php
/**
 * Title: Blog: Program card
 * Slug: imet-theme/blog-program-cta
 * Description: A program call-out inside an article: title, short text and a "Get Program Details" button on a light blue panel beside a graduate photo.
 * Categories: imet-sections
 * Keywords: imet, blog, article, cta, program, doctorate, dba
 * Viewport Width: 800
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:group {"className":"bp-cta-card","layout":{"type":"default"}} -->
<div class="wp-block-group bp-cta-card"><!-- wp:group {"className":"bp-cta-text","layout":{"type":"default"}} -->
<div class="wp-block-group bp-cta-text"><!-- wp:paragraph {"className":"bp-cta-title"} -->
<p class="bp-cta-title"><?php esc_html_e( 'Doctorate in Business Administration for IT Leaders', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p><?php esc_html_e( 'Develop strategic thinking, leadership expertise, and research-driven decision-making to lead enterprise transformation.', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-navy btn-sm"} -->
<div class="wp-block-button btn-navy btn-sm"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/online-doctorate-business-administration-dba-programs/' ) ); ?>"><?php esc_html_e( 'Get Program Details', 'imet-theme' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"bp-cta-img"} -->
<figure class="wp-block-image size-full bp-cta-img"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/blog-cta-dba.webp' ) ); ?>" alt="<?php echo esc_attr__( 'IMET doctorate graduate in cap and gown', 'imet-theme' ); ?>" width="584" height="700"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

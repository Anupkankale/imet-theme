<?php
/**
 * Title: CTA: Step Into Your Next Chapter
 * Slug: imet-theme/cta-next-chapter
 * Description: The closing call to action with the graduates photo. The source of the synced pattern "CTA: Step Into Your Next Chapter" (Patterns > My patterns), which the theme creates once; edit that one and it changes on every page. Hidden from the inserter so no unsynced copy is added by mistake.
 * Categories: imet-sections
 * Keywords: imet, section, shared
 * Inserter: no
 * Viewport Width: 1440
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:imet/cta {"align":"full"} -->
<section class="wp-block-imet-cta alignfull imet-section cta-wrap"><!-- wp:group {"className":"imet-container","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container"><!-- wp:group {"className":"cta","layout":{"type":"default"}} -->
<div class="wp-block-group cta"><!-- wp:group {"className":"cta-text","layout":{"type":"default"}} -->
<div class="wp-block-group cta-text"><!-- wp:heading -->
<h2 class="wp-block-heading">Step into your next chapter<br>as a <strong>Tech Advisor, CxO, or<br>Boardroom Leader.</strong></h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"cta-sub"} -->
<p class="cta-sub">Discover how the program transformed their careers and enhanced their leadership journey. Gain valuable insights from professionals who have walked the same path.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-white btn-lg"} -->
<div class="wp-block-button btn-white btn-lg"><a class="wp-block-button__link wp-element-button" href="#advisor-form">Talk to a Doctoral Advisor</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cta-photo"} -->
<figure class="wp-block-image size-full cta-photo"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/imet/cta-graduates.jpg" ) ); ?>" alt="IMET DBA graduates at convocation"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/cta -->

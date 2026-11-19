<?php
/**
 * Title: Contact Page
 * Slug: imet-theme/contact-page
 * Description: The Contact Us page: the navy-to-gold hero, then a "24×7 Support" header, email and phone cards and the four offices as cards with their flags, beside the sticky Contact Form 7 form ("Contact Us", found by title). On phones the form comes right after the header.
 * Categories: imet-pages
 * Keywords: imet, page, contact, offices, form, support
 * Block Types: core/post-content
 * Viewport Width: 1440
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:imet/section {"className":"ac-hero tp-hero"} -->
<section class="wp-block-imet-section alignfull imet-section section imet-blank ac-hero tp-hero"><!-- wp:group {"className":"imet-container ac-hero-text","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container ac-hero-text"><!-- wp:paragraph {"className":"ac-crumbs"} -->
<p class="ac-crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'imet-theme' ); ?></a> » <?php esc_html_e( 'Contact Us', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Contact Us', 'imet-theme' ); ?></h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"ac-lead"} -->
<p class="ac-lead"><?php esc_html_e( 'We’re Here To Provide Support', 'imet-theme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->
<!-- wp:imet/section {"className":"ct-main"} -->
<section class="wp-block-imet-section alignfull imet-section section imet-blank ct-main"><!-- wp:group {"className":"imet-container ct-layout","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container ct-layout"><!-- wp:group {"className":"sec-head is-left ct-intro","layout":{"type":"default"}} -->
<div class="wp-block-group sec-head is-left ct-intro"><!-- wp:paragraph {"className":"eyebrow-line left"} -->
<p class="eyebrow-line left"><?php esc_html_e( '24×7 Support', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"title left"} -->
<h2 class="wp-block-heading title left"><?php esc_html_e( 'Talk to a Mentor: Book Your 1:1 Mentoring Session', 'imet-theme' ); ?></h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"sub left"} -->
<p class="sub left"><?php esc_html_e( 'Our team is always here to support you. In any case where our experts are busy, we may take a little extra time to respond, but rest assured your request will be addressed as soon as possible.', 'imet-theme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"ct-quick","layout":{"type":"default"}} -->
<div class="wp-block-group ct-quick"><!-- wp:group {"className":"ct-quick-item ct-quick-mail","layout":{"type":"default"}} -->
<div class="wp-block-group ct-quick-item ct-quick-mail"><!-- wp:paragraph {"className":"ct-quick-label"} -->
<p class="ct-quick-label"><?php esc_html_e( 'Email us', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"ct-quick-value"} -->
<p class="ct-quick-value"><a href="mailto:imetworldwide@gmail.com">imetworldwide@gmail.com</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"ct-quick-item ct-quick-phone","layout":{"type":"default"}} -->
<div class="wp-block-group ct-quick-item ct-quick-phone"><!-- wp:paragraph {"className":"ct-quick-label"} -->
<p class="ct-quick-label"><?php esc_html_e( 'Call us', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"ct-quick-value"} -->
<p class="ct-quick-value"><a href="tel:+971523085167">+971 523085167</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"ct-offices","layout":{"type":"default"}} -->
<div class="wp-block-group ct-offices"><!-- wp:heading {"level":3,"className":"ct-offices-title"} -->
<h3 class="wp-block-heading ct-offices-title"><?php esc_html_e( 'Our offices', 'imet-theme' ); ?></h3>
<!-- /wp:heading -->
<!-- wp:group {"className":"ct-office-grid","layout":{"type":"default"}} -->
<div class="wp-block-group ct-office-grid"><!-- wp:group {"className":"ct-office ct-office-ae","layout":{"type":"default"}} -->
<div class="wp-block-group ct-office ct-office-ae"><!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading"><?php esc_html_e( 'Dubai', 'imet-theme' ); ?></h4>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p><?php esc_html_e( 'Bur Dubai, United Arab Emirates', 'imet-theme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"ct-office ct-office-sg","layout":{"type":"default"}} -->
<div class="wp-block-group ct-office ct-office-sg"><!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading"><?php esc_html_e( 'Singapore', 'imet-theme' ); ?></h4>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p><?php esc_html_e( '77 Robinson Rd, Singapore', 'imet-theme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"ct-office ct-office-us","layout":{"type":"default"}} -->
<div class="wp-block-group ct-office ct-office-us"><!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading"><?php esc_html_e( 'USA', 'imet-theme' ); ?></h4>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p><?php esc_html_e( 'East Brunswick, New Jersey, USA', 'imet-theme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"ct-office ct-office-gb","layout":{"type":"default"}} -->
<div class="wp-block-group ct-office ct-office-gb"><!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading"><?php esc_html_e( 'UK', 'imet-theme' ); ?></h4>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p><?php esc_html_e( 'Fitzrovia, London, United Kingdom', 'imet-theme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:group {"anchor":"contact-form","className":"bl-form ct-form","layout":{"type":"default"}} -->
<div id="contact-form" class="wp-block-group bl-form ct-form"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Book a 1:1 Mentoring Session', 'imet-theme' ); ?></h2>
<!-- /wp:heading -->
<!-- wp:shortcode -->
[contact-form-7 title="Contact Us"]
<!-- /wp:shortcode --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->

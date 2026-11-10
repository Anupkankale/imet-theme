<?php
/**
 * Title: Blog: Contact banner
 * Slug: imet-theme/blog-skills-banner
 * Description: A blue banner inside an article: "Build job-ready skills with IMET", two short points and a Contact Us button (goes to the advisor form in the sidebar).
 * Categories: imet-sections
 * Keywords: imet, blog, article, cta, contact, banner
 * Viewport Width: 800
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:group {"className":"bp-banner","layout":{"type":"default"}} -->
<div class="wp-block-group bp-banner"><!-- wp:paragraph {"className":"bp-banner-title"} -->
<p class="bp-banner-title"><?php esc_html_e( 'Build job-ready skills with IMET', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li><?php esc_html_e( 'Unleash in-demand skills across your team', 'imet-theme' ); ?></li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li><?php esc_html_e( 'Align skill development with business goals', 'imet-theme' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->
<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-white btn-sm"} -->
<div class="wp-block-button btn-white btn-sm"><a class="wp-block-button__link wp-element-button" href="#advisor-form"><?php esc_html_e( 'Contact Us', 'imet-theme' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

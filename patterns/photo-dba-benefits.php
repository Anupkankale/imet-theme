<?php
/**
 * Title: Photo: DBA Benefits
 * Slug: imet-theme/photo-dba-benefits
 * Description: A photo with its labels as text. The source of the synced pattern "Photo: DBA Benefits" (Patterns > My patterns), which the theme creates once; edit that one and it changes on every page. Each page can still swap the photo and the label text (pattern overrides). Hidden from the inserter so no unsynced copy is added by mistake.
 * Categories: imet-sections
 * Keywords: imet, section, shared, photo
 * Inserter: no
 * Viewport Width: 1440
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:group {"className":"ov-visual has-chips","layout":{"type":"default"}} -->
<div class="wp-block-group ov-visual has-chips"><!-- wp:image {"metadata":{"name":"Photo","bindings":{"__default":{"source":"core/pattern-overrides"}}},"sizeSlug":"full","linkDestination":"none","className":"ov-photo"} -->
<figure class="wp-block-image size-full ov-photo"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/imet/course-benefits-clean.webp" ) ); ?>" alt="<?php echo esc_attr__( 'Cybersecurity leader beside a holographic globe', 'imet-theme' ); ?>"/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"metadata":{"name":"Label 1","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"ov-chip is-jobs"} -->
<p class="ov-chip is-jobs"><?php echo wp_kses_post( __( '<strong>3.5M+</strong> Cybersecurity job openings worldwide', 'imet-theme' ) ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 2","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"ov-chip is-roi"} -->
<p class="ov-chip is-roi"><?php echo wp_kses_post( __( 'Immediate ROI <strong>+85%</strong>', 'imet-theme' ) ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 3","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"ov-chip is-path"} -->
<p class="ov-chip is-path"><?php echo wp_kses_post( __( 'IT Professional → Cybersecurity Specialist → AI &amp; Cloud Security Lead → Cyber Resilience Head → <strong>CISO</strong>', 'imet-theme' ) ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

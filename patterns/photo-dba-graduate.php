<?php
/**
 * Title: Photo: DBA Category Graduate
 * Slug: imet-theme/photo-dba-graduate
 * Description: A photo with its labels as text. The source of the synced pattern "Photo: DBA Category Graduate" (Patterns > My patterns), which the theme creates once; edit that one and it changes on every page. Each page can still swap the photo and the label text (pattern overrides). Hidden from the inserter so no unsynced copy is added by mistake.
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
<!-- wp:group {"className":"ov-visual photo-chips is-pc-dba-grad","layout":{"type":"default"}} -->
<div class="wp-block-group ov-visual photo-chips is-pc-dba-grad"><!-- wp:image {"metadata":{"name":"Photo","bindings":{"__default":{"source":"core/pattern-overrides"}}},"sizeSlug":"full","linkDestination":"none","className":"pc-photo"} -->
<figure class="wp-block-image size-full pc-photo"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/imet/photo-placeholder.webp" ) ); ?>" alt="<?php echo esc_attr__( 'DBA graduate', 'imet-theme' ); ?>"/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"metadata":{"name":"Label 1","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-1 is-white num-blue"} -->
<p class="pc-chip pc-1 is-white num-blue"><?php echo wp_kses_post( __( '<strong>Google</strong> Scholar', 'imet-theme' ) ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 2","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-2 is-white num-blue is-row"} -->
<p class="pc-chip pc-2 is-white num-blue is-row"><?php echo wp_kses_post( __( '<strong>3.5M+</strong> Cybersecurity job openings worldwide', 'imet-theme' ) ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 3","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-3 is-white is-roi"} -->
<p class="pc-chip pc-3 is-white is-roi"><?php echo wp_kses_post( __( 'Immediate ROI <strong>+85%</strong>', 'imet-theme' ) ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 4","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-4 is-white is-path"} -->
<p class="pc-chip pc-4 is-white is-path"><?php echo wp_kses_post( __( 'IT Professional → Cybersecurity Specialist → AI &amp; Cloud Security Lead → Cyber Resilience Head → <strong>CISO</strong>', 'imet-theme' ) ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

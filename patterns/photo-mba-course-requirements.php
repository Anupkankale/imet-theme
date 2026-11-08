<?php
/**
 * Title: Photo: MBA Course Requirements
 * Slug: imet-theme/photo-mba-course-requirements
 * Description: A photo with its labels as text. The source of the synced pattern "Photo: MBA Course Requirements" (Patterns > My patterns), which the theme creates once; edit that one and it changes on every page. Each page can still swap the photo and the label text (pattern overrides). Hidden from the inserter so no unsynced copy is added by mistake.
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
<!-- wp:group {"className":"join-photo photo-chips is-pc-mba-course-req","layout":{"type":"default"}} -->
<div class="wp-block-group join-photo photo-chips is-pc-mba-course-req"><!-- wp:image {"metadata":{"name":"Photo","bindings":{"__default":{"source":"core/pattern-overrides"}}},"sizeSlug":"full","linkDestination":"none","className":"pc-photo"} -->
<figure class="wp-block-image size-full pc-photo"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/imet/photo-placeholder.webp" ) ); ?>" alt="<?php echo esc_attr__( 'Circuit board with a padlock', 'imet-theme' ); ?>"/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"metadata":{"name":"Label 1","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-1 is-blue"} -->
<p class="pc-chip pc-1 is-blue"><?php echo wp_kses_post( __( 'Cyber Resilience', 'imet-theme' ) ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 2","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-2 is-green"} -->
<p class="pc-chip pc-2 is-green"><?php echo wp_kses_post( __( 'Enterprise Risk Alignment', 'imet-theme' ) ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 3","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-3 is-white is-stat"} -->
<p class="pc-chip pc-3 is-white is-stat"><?php echo wp_kses_post( __( '<strong>85%</strong> Management Readiness', 'imet-theme' ) ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

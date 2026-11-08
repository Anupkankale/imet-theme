<?php
/**
 * Title: Photo: Why Choose 2 (Affordable)
 * Slug: imet-theme/photo-why-2
 * Description: A photo with its labels as text. The source of the synced pattern "Photo: Why Choose 2 (Affordable)" (Patterns > My patterns), which the theme creates once; edit that one and it changes on every page. Each page can still swap the photo and the label text (pattern overrides). Hidden from the inserter so no unsynced copy is added by mistake.
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
<!-- wp:group {"className":"sc-photo photo-chips is-pc-why-2","layout":{"type":"default"}} -->
<div class="wp-block-group sc-photo photo-chips is-pc-why-2"><!-- wp:image {"metadata":{"name":"Photo","bindings":{"__default":{"source":"core/pattern-overrides"}}},"sizeSlug":"full","linkDestination":"none","className":"pc-photo"} -->
<figure class="wp-block-image size-full pc-photo"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/imet/photo-placeholder.webp" ) ); ?>" alt="<?php echo esc_attr__( 'Executive learner', 'imet-theme' ); ?>"/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"metadata":{"name":"Label 1","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-1 is-white"} -->
<p class="pc-chip pc-1 is-white"><?php echo wp_kses_post( __( 'Affordable', 'imet-theme' ) ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 2","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-2 is-green"} -->
<p class="pc-chip pc-2 is-green"><?php echo wp_kses_post( __( 'Scholarships Available', 'imet-theme' ) ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

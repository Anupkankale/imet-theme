<?php
/**
 * Title: Photo: Why Choose 3 (100% Online)
 * Slug: imet-theme/photo-why-3
 * Description: A photo with its labels as text. The source of the synced pattern "Photo: Why Choose 3 (100% Online)" (Patterns > My patterns), which the theme creates once; edit that one and it changes on every page. Each page can still swap the photo and the label text (pattern overrides). Hidden from the inserter so no unsynced copy is added by mistake.
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
<!-- wp:group {"className":"sc-photo photo-chips is-pc-why-3","layout":{"type":"default"}} -->
<div class="wp-block-group sc-photo photo-chips is-pc-why-3"><!-- wp:image {"metadata":{"name":"Photo","bindings":{"__default":{"source":"core/pattern-overrides"}}},"sizeSlug":"full","linkDestination":"none","className":"pc-photo"} -->
<figure class="wp-block-image size-full pc-photo"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/imet/photo-placeholder.webp" ) ); ?>" alt="Smiling professional"/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"metadata":{"name":"Label 1","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-1 is-blue is-row"} -->
<p class="pc-chip pc-1 is-blue is-row"><strong>100%</strong> Online</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 2","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-2 is-white num-blue"} -->
<p class="pc-chip pc-2 is-white num-blue"><strong>Google</strong> Scholar</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

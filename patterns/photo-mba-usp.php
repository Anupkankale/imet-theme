<?php
/**
 * Title: Photo: MBA USP
 * Slug: imet-theme/photo-mba-usp
 * Description: A photo with its labels as text. The source of the synced pattern "Photo: MBA USP" (Patterns > My patterns), which the theme creates once; edit that one and it changes on every page. Each page can still swap the photo and the label text (pattern overrides). Hidden from the inserter so no unsynced copy is added by mistake.
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
<!-- wp:group {"className":"ov-visual photo-chips is-pc-mba-usp","layout":{"type":"default"}} -->
<div class="wp-block-group ov-visual photo-chips is-pc-mba-usp"><!-- wp:image {"metadata":{"name":"Photo","bindings":{"__default":{"source":"core/pattern-overrides"}}},"sizeSlug":"full","linkDestination":"none","className":"pc-photo"} -->
<figure class="wp-block-image size-full pc-photo"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/imet/photo-placeholder.webp" ) ); ?>" alt="MBA graduate"/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"metadata":{"name":"Label 1","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-1 is-white num-blue"} -->
<p class="pc-chip pc-1 is-white num-blue"><strong>Google</strong> Scholar</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 2","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-2 is-white num-blue is-row"} -->
<p class="pc-chip pc-2 is-white num-blue is-row"><strong>4.5M+</strong> job openings worldwide</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 3","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-3 is-white is-roi"} -->
<p class="pc-chip pc-3 is-white is-roi">Immediate ROI <strong>100%</strong></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 4","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-4 is-white is-path"} -->
<p class="pc-chip pc-4 is-white is-path">Business Professional → Business Analyst → Project/Operations Manager → Director of Business Strategy → CEO / Managing Director</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

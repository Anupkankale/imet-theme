<?php
/**
 * Title: Photo: Location Highlights
 * Slug: imet-theme/photo-location
 * Description: A photo with its labels as text. The source of the synced pattern "Photo: Location Highlights" (Patterns > My patterns), which the theme creates once; edit that one and it changes on every page. Each page can still swap the photo and the label text (pattern overrides). Hidden from the inserter so no unsynced copy is added by mistake.
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
<!-- wp:group {"className":"hl-visual photo-chips is-pc-loc-hl","layout":{"type":"default"}} -->
<div class="wp-block-group hl-visual photo-chips is-pc-loc-hl"><!-- wp:image {"metadata":{"name":"Photo","bindings":{"__default":{"source":"core/pattern-overrides"}}},"sizeSlug":"full","linkDestination":"none","className":"pc-photo"} -->
<figure class="wp-block-image size-full pc-photo"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/imet/photo-placeholder.webp" ) ); ?>" alt="DBA graduate"/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"metadata":{"name":"Label 1","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-1 is-white num-blue"} -->
<p class="pc-chip pc-1 is-white num-blue"><strong>IEEE</strong></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 2","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-2 is-white num-gold"} -->
<p class="pc-chip pc-2 is-white num-gold">Elsevier <strong>Scopus</strong></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 3","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-3 is-white num-blue"} -->
<p class="pc-chip pc-3 is-white num-blue"><strong>Google</strong> Scholar</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 4","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-4 is-cream is-stat"} -->
<p class="pc-chip pc-4 is-cream is-stat">Research Visibility <strong>100% ↗</strong></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 5","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-5 is-lavender"} -->
<p class="pc-chip pc-5 is-lavender">1-1 mentoring session</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

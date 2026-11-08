<?php
/**
 * Title: Photo: DBA Category Highlights
 * Slug: imet-theme/photo-dba-highlights
 * Description: A photo with its labels as text. The source of the synced pattern "Photo: DBA Category Highlights" (Patterns > My patterns), which the theme creates once; edit that one and it changes on every page. Each page can still swap the photo and the label text (pattern overrides). Hidden from the inserter so no unsynced copy is added by mistake.
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
<!-- wp:group {"className":"hl-visual photo-chips is-pc-dba-hl","layout":{"type":"default"}} -->
<div class="wp-block-group hl-visual photo-chips is-pc-dba-hl"><!-- wp:image {"metadata":{"name":"Photo","bindings":{"__default":{"source":"core/pattern-overrides"}}},"sizeSlug":"full","linkDestination":"none","className":"pc-photo"} -->
<figure class="wp-block-image size-full pc-photo"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/imet/photo-placeholder.webp" ) ); ?>" alt="DBA graduates"/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"metadata":{"name":"Label 1","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-1 is-green is-pill is-row"} -->
<p class="pc-chip pc-1 is-green is-pill is-row"><strong>15+</strong> Top Global Specializations</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 2","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-2 is-blue has-check"} -->
<p class="pc-chip pc-2 is-blue has-check">Promoted to CxO</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 3","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"pc-chip pc-3 is-white"} -->
<p class="pc-chip pc-3 is-white">Skill Growth</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

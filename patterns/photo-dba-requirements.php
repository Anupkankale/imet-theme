<?php
/**
 * Title: Photo: DBA Eligibility Criteria
 * Slug: imet-theme/photo-dba-requirements
 * Description: A photo with its labels as text. The source of the synced pattern "Photo: DBA Eligibility Criteria" (Patterns > My patterns), which the theme creates once; edit that one and it changes on every page. Each page can still swap the photo and the label text (pattern overrides). Hidden from the inserter so no unsynced copy is added by mistake.
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
<!-- wp:group {"className":"join-photo has-chips","layout":{"type":"default"}} -->
<div class="wp-block-group join-photo has-chips"><!-- wp:image {"metadata":{"name":"Photo","bindings":{"__default":{"source":"core/pattern-overrides"}}},"sizeSlug":"full","linkDestination":"none","className":"join-pic"} -->
<figure class="wp-block-image size-full join-pic"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/imet/course-requirements-clean.webp" ) ); ?>" alt="Digital head with a padlock: cybersecurity leadership"/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"metadata":{"name":"Label 1","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"join-chip is-green"} -->
<p class="join-chip is-green">AI Ethics &amp; Security</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 2","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"join-chip is-blue"} -->
<p class="join-chip is-blue">Cyber Resilience</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"metadata":{"name":"Label 3","bindings":{"__default":{"source":"core/pattern-overrides"}}},"className":"join-chip is-card"} -->
<p class="join-chip is-card">C-Suite Reporting: <strong>50% direct to Board</strong></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<?php
/**
 * Title: Section header
 * Slug: imet-theme/section-header
 * Description: Eyebrow, section title and subtitle, centred, as every IMET section opens.
 * Categories: imet-sections
 * Keywords: imet, section
 * Viewport Width: 1440
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:group {"className":"imet-section-head","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"var(--wp--style--global--content-size)"}} -->
<div class="wp-block-group imet-section-head">
<!-- wp:paragraph {"className":"is-style-paragraph-eyebrow"} -->
<p class="is-style-paragraph-eyebrow">Eyebrow</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">Section title</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-paragraph-section-sub"} -->
<p class="is-style-paragraph-section-sub">One or two sentences that introduce the section. Keep it short and specific.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

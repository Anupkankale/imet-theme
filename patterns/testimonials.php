<?php
/**
 * Title: Testimonials
 * Slug: imet-theme/testimonials
 * Description: Three testimonial cards: a grid on desktop, a swipeable row on phones.
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
<!-- wp:group {"align":"full","className":"imet-section-band","layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group alignfull imet-section-band">
<!-- wp:group {"className":"imet-section-head","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"1020px"}} -->
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

<!-- wp:group {"className":"is-style-group-testimonial-grid","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-group-testimonial-grid">
<!-- wp:quote {"className":"is-style-quote-testimonial"} -->
<blockquote class="wp-block-quote is-style-quote-testimonial"><!-- wp:paragraph -->
<p>The program gave me a structured way to turn years of industry experience into research that boardrooms listen to.</p>
<!-- /wp:paragraph --><cite><strong>Name Surname</strong><br>Role, Company</cite></blockquote>
<!-- /wp:quote -->

<!-- wp:quote {"className":"is-style-quote-testimonial"} -->
<blockquote class="wp-block-quote is-style-quote-testimonial"><!-- wp:paragraph -->
<p>Flexible, rigorous and genuinely supportive. My supervisor was available at every stage of the dissertation.</p>
<!-- /wp:paragraph --><cite><strong>Name Surname</strong><br>Role, Company</cite></blockquote>
<!-- /wp:quote -->

<!-- wp:quote {"className":"is-style-quote-testimonial"} -->
<blockquote class="wp-block-quote is-style-quote-testimonial"><!-- wp:paragraph -->
<p>I finished while leading a team of forty. The online format made it possible without stepping back from work.</p>
<!-- /wp:paragraph --><cite><strong>Name Surname</strong><br>Role, Company</cite></blockquote>
<!-- /wp:quote -->
</div>
<!-- /wp:group -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"36px"}}}} -->
<div class="wp-block-buttons" style="margin-top:36px">
<!-- wp:button {"className":"is-style-button-link btn-sm"} -->
<div class="wp-block-button is-style-button-link btn-sm"><a class="wp-block-button__link wp-element-button" href="#">View More</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->

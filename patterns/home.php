<?php
/**
 * Title: Home (IMET)
 * Slug: imet-theme/home
 * Description: The Home page: hero with graduate cards, "Why choose IMET Worldwide?" with the advisor form, and the fee and scholarship offer.
 * Categories: imet-sections
 * Keywords: imet, home, hero, offer
 * Block Types: core/post-content
 * Viewport Width: 1440
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:imet/hero {"className":"is-style-home","anchor":"top"} -->
<section class="wp-block-imet-hero alignfull imet-section hero is-style-home" id="top"><!-- wp:group {"className":"imet-container hero-home","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container hero-home"><!-- wp:paragraph {"className":"h-pill"} -->
<p class="h-pill">Your No.1 Platform for Leadership Growth</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Best Online Doctorate (DBA) &amp;<br>Master's (MBA) Program</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"hero-lead"} -->
<p class="hero-lead">Online Doctorate (DBA) &amp; Master’s Programs for executives and IT leaders – Pursue a globally recognized online doctorate of business administration (DBA) program or MBA program, tailored for senior IT leaders and CXOs ready to turn their industry experience into thought leadership, boardroom influence, and digital visibility.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-navy btn-md"} -->
<div class="wp-block-button btn-navy btn-md"><a class="wp-block-button__link wp-element-button" href="#advisor-form">Talk to an Advisor</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"h-grads","layout":{"type":"default"}} -->
<div class="wp-block-group h-grads"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"h-grad"} -->
<figure class="wp-block-image size-full h-grad"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-grad-5.webp' ) ); ?>" alt="Dr. Olaniyi Olaniyan, Director CyberSecurity"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"h-grad"} -->
<figure class="wp-block-image size-full h-grad"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-grad-6.webp' ) ); ?>" alt="Dr. Rufino Jr, VP CyberSecurity"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"h-grad"} -->
<figure class="wp-block-image size-full h-grad"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-grad-1.webp' ) ); ?>" alt="Dr. Suresh A Shan, Chairman CSI"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"h-grad"} -->
<figure class="wp-block-image size-full h-grad"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-grad-2.webp' ) ); ?>" alt="Dr. Adebola Paveun, Medical Aesthetician"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"h-grad"} -->
<figure class="wp-block-image size-full h-grad"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-grad-3.webp' ) ); ?>" alt="Dr. Caroline Koech, Executive Director"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/hero -->

<!-- wp:imet/highlights {"className":"is-style-home","anchor":"overview"} -->
<section class="wp-block-imet-highlights alignfull imet-section highlights is-style-home" id="overview"><!-- wp:group {"className":"imet-container hl-grid","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container hl-grid"><!-- wp:group {"className":"hl-text","layout":{"type":"default"}} -->
<div class="wp-block-group hl-text"><!-- wp:paragraph {"className":"eyebrow-line left"} -->
<p class="eyebrow-line left">Why choose IMET Worldwide?</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"title left"} -->
<h2 class="wp-block-heading title left">Doctorate for Visionaries, Built on Business Realities</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"hl-lead"} -->
<p class="hl-lead">Online Doctorate (DBA) &amp; Master’s Programs for executives and IT leaders – Pursue a globally recognized online doctorate of business administration (DBA) program or MBA program.</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"hl-list hl-pills"} -->
<ul class="wp-block-list hl-list hl-pills"><!-- wp:list-item -->
<li><span class="hl-amount"><sup>Up to</sup><strong>45%</strong></span> Scholarship Available</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Internationally Recognized</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>12-24 Months Course Duration</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>100%</strong> Online</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Cybersecurity | AI | Digital Transformation</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>1-on-1</strong> Mentoring Session</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"hl-form","layout":{"type":"default"},"anchor":"advisor-form"} -->
<div id="advisor-form" class="wp-block-group hl-form"><!-- wp:heading -->
<h2 class="wp-block-heading">Talk to an Advisor</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[imet_advisor_form]
<!-- /wp:shortcode --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/highlights -->

<!-- wp:imet/cost-banner -->
<section class="wp-block-imet-cost-banner imet-section cost-banner"><!-- wp:group {"className":"cost-left","layout":{"type":"default"}} -->
<div class="wp-block-group cost-left"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Doctorate (DBA)<br>Program Fee</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"price-tag"} -->
<p class="price-tag">USD $6500</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:group {"className":"cost-mid","layout":{"type":"default"}} -->
<div class="wp-block-group cost-mid"><!-- wp:paragraph {"className":"up-to"} -->
<p class="up-to">Up to</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"pct"} -->
<p class="pct">45%</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"merit"} -->
<p class="merit">Merit-Based Scholarship Available</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:group {"className":"cost-right","layout":{"type":"default"}} -->
<div class="wp-block-group cost-right"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Scholarship Opportunity</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>(Granted to senior tech professionals based on leadership depth, career trajectory, and visibility potential.)</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-white btn-sm btn-arrow"} -->
<div class="wp-block-button btn-white btn-sm btn-arrow"><a class="wp-block-button__link wp-element-button" href="#advisor-form">Check Your Eligibility</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group --></section>
<!-- /wp:imet/cost-banner -->

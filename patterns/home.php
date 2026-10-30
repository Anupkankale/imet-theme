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

<!-- wp:imet/embassy {"className":"is-style-home is-accred"} -->
<section class="wp-block-imet-embassy alignfull imet-section section embassy is-style-home is-accred"><!-- wp:group {"className":"imet-container","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container"><!-- wp:group {"className":"sec-head","layout":{"type":"default"}} -->
<div class="wp-block-group sec-head"><!-- wp:heading {"className":"title"} -->
<h2 class="wp-block-heading title">Accredited Doctoral Programs with Global Recognition</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"emblem-row","layout":{"type":"default"}} -->
<div class="wp-block-group emblem-row"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/logo-ministry-education.webp' ) ); ?>" alt="Ministry of Education Accredited Program"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/logo-mca.webp' ) ); ?>" alt="Ministry of Corporate Affairs Accredited Program"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/logo-wes.webp' ) ); ?>" alt="WES Accredited Program"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/logo-mofa.webp' ) ); ?>" alt="Ministry of Foreign Affairs Accredited Program"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/logo-singapore.webp' ) ); ?>" alt="Singapore Governing Body"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-navy btn-sm"} -->
<div class="wp-block-button btn-navy btn-sm"><a class="wp-block-button__link wp-element-button" href="https://imetworldwide.com/accreditation-and-recognition/">Verify Accreditations &amp; Global Standing</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/embassy -->

<!-- wp:imet/tabs {"className":"is-style-home","anchor":"learn-more"} -->
<section class="wp-block-imet-tabs alignfull imet-section section tabs is-style-home" id="learn-more"><!-- wp:group {"className":"imet-container","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container"><!-- wp:group {"className":"sec-head","layout":{"type":"default"}} -->
<div class="wp-block-group sec-head"><!-- wp:paragraph {"className":"eyebrow-line"} -->
<p class="eyebrow-line">Our Programs</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"title"} -->
<h2 class="wp-block-heading title">Learn More About the Programs</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"tab-nav","layout":{"type":"default"}} -->
<div class="wp-block-group tab-nav"><!-- wp:paragraph {"className":"tab-label"} -->
<p class="tab-label">Doctorate</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"tab-label"} -->
<p class="tab-label">MBA</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"tab-label"} -->
<p class="tab-label">Diploma</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"tab-panels","layout":{"type":"default"}} -->
<div class="wp-block-group tab-panels"><!-- wp:group {"className":"tab-panel","layout":{"type":"default"}} -->
<div class="wp-block-group tab-panel"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"tab-photo"} -->
<figure class="wp-block-image size-full tab-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-tab-doctorate.webp' ) ); ?>" alt="Online DBA graduate with research visibility on IEEE, Scopus and Google Scholar"/></figure>
<!-- /wp:image -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li><strong><a href="https://imetworldwide.com/online-doctorate-digital-transformation-program/">DBA in Digital Transformation</a></strong>Equip yourself to lead large-scale change initiatives that integrate emerging technologies, process automation, and innovation strategies.</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong><a href="https://imetworldwide.com/online-doctorate-cybersecurity-certificate-program/">DBA in Cybersecurity</a></strong>Gain strategic mastery over enterprise security frameworks, governance models, and threat intelligence.</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong><a href="https://imetworldwide.com/online-doctorate-dba-artificial-intelligence-ml/">DBA in AI/ML</a></strong>Drive AI-driven innovation by combining business leadership with deep AI/ML application knowledge.</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong><a href="https://imetworldwide.com/online-doctorate-dba-project-management/">DBA in Project Management</a></strong>Advance beyond operational project delivery to strategic oversight of complex, global initiatives.</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong><a href="https://imetworldwide.com/online-doctorate-it-governance-risk-compliance/">DBA in IT Governance</a></strong>A DBA in IT Governance develops expertise in managing IT risks, compliance, and strategic technology leadership effectively.</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-white btn-sm"} -->
<div class="wp-block-button btn-white btn-sm"><a class="wp-block-button__link wp-element-button" href="https://imetworldwide.com/online-doctorate-business-administration-dba-programs/">Start Your DBA Journey</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"tab-panel","layout":{"type":"default"}} -->
<div class="wp-block-group tab-panel"><!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li><strong><a href="https://imetworldwide.com/online-masters-mba-cybersecurity/">MBA in Cybersecurity</a></strong></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong><a href="https://imetworldwide.com/online-masters-mba-project-management-program/">MBA in Project Management</a></strong></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong><a href="https://imetworldwide.com/best-online-masters-mba-degree-data-analytics/">MBA in Data Analytics</a></strong></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong><a href="https://imetworldwide.com/mba-supply-chain-management-online-programs-career-scope-and-salary-in-2025/">MBA in Supply Chain Management</a></strong></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-white btn-sm"} -->
<div class="wp-block-button btn-white btn-sm"><a class="wp-block-button__link wp-element-button" href="https://imetworldwide.com/online-masters-mba-cybersecurity-program/">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"tab-panel","layout":{"type":"default"}} -->
<div class="wp-block-group tab-panel"><!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li><strong>Diploma in Project Management</strong></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>Diploma of Leadership and Management</strong></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>Diploma in Entrepreneurship</strong></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-white btn-sm"} -->
<div class="wp-block-button btn-white btn-sm"><a class="wp-block-button__link wp-element-button" href="https://imetworldwide.com/how-online-diploma-programs-can-boost-your-career-without-quitting-your-job/">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/tabs -->

<!-- wp:imet/embassy {"className":"is-style-home"} -->
<section class="wp-block-imet-embassy alignfull imet-section section embassy is-style-home"><!-- wp:group {"className":"imet-container","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container"><!-- wp:group {"className":"sec-head","layout":{"type":"default"}} -->
<div class="wp-block-group sec-head"><!-- wp:paragraph {"className":"eyebrow-line"} -->
<p class="eyebrow-line">Recognized Worldwide</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"title"} -->
<h2 class="wp-block-heading title">Internationally Validated Doctorate Program With Embassy Affiliations</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"emblem-row","layout":{"type":"default"}} -->
<div class="wp-block-group emblem-row"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-emb-4.webp' ) ); ?>" alt="Embassy of Kuwait"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-emb-5.webp' ) ); ?>" alt="Saudi Arabia Ministry of Foreign Affairs"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-emb-6.webp' ) ); ?>" alt="Embassy of South Africa"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-emb-7.webp' ) ); ?>" alt="Embassy of United Arab Emirates"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-emb-1.webp' ) ); ?>" alt="Embassy of New Zealand"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-emb-2.webp' ) ); ?>" alt="Embassy of Singapore"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-emb-3.webp' ) ); ?>" alt="Embassy of United Kingdom"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/embassy -->

<!-- wp:imet/specializations {"className":"is-style-home","anchor":"programs"} -->
<section class="wp-block-imet-specializations alignfull imet-section section specs is-style-home" id="programs"><!-- wp:group {"className":"imet-container sec-head","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container sec-head"><!-- wp:paragraph {"className":"eyebrow-line"} -->
<p class="eyebrow-line">Our Programs</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"title"} -->
<h2 class="wp-block-heading title">Top Featured Doctorate (DBA) &amp; Master’s (MBA) Programs</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"sub"} -->
<p class="sub">Explore our internationally validated Doctorate in Business Administration (DBA) programs, supported by embassy affiliations.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"spec-grid","layout":{"type":"default"}} -->
<div class="wp-block-group spec-grid"><!-- wp:paragraph {"className":"spec-card"} -->
<p class="spec-card"><a href="https://imetworldwide.com/online-doctorate-cybersecurity-certificate-program/"><span class="sp-title">Doctorate in CyberSecurity</span><span class="sp-desc">Develop board-level authority in cyber risk, governance, and enterprise security strategy.</span></a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"spec-card"} -->
<p class="spec-card"><a href="https://imetworldwide.com/online-masters-mba-cybersecurity/"><span class="sp-title">MBA in Cybersecurity</span><span class="sp-desc">Build managerial and business-driven cybersecurity leadership for modern enterprises.</span></a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"spec-card"} -->
<p class="spec-card"><a href="https://imetworldwide.com/online-doctorate-digital-transformation-program/"><span class="sp-title">Doctorate in Digital Transformation</span><span class="sp-desc">Lead large-scale digital change by aligning technology, strategy, and organizational impact.</span></a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"spec-card"} -->
<p class="spec-card"><a href="https://imetworldwide.com/online-masters-mba-project-management-program/"><span class="sp-title">MBA in Project Management</span><span class="sp-desc">Master structured delivery, stakeholder control, and execution of complex business initiatives.</span></a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"spec-card"} -->
<p class="spec-card"><a href="https://imetworldwide.com/online-doctorate-dba-artificial-intelligence-ml/"><span class="sp-title">Doctorate in AI/ML</span><span class="sp-desc">Establish thought leadership in AI strategy, advanced analytics, and intelligent enterprise systems.</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-navy btn-md"} -->
<div class="wp-block-button btn-navy btn-md"><a class="wp-block-button__link wp-element-button" href="https://imetworldwide.com/online-doctorate-business-administration-dba-programs/">View More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/specializations -->

<!-- wp:imet/step-cards {"className":"is-style-home","anchor":"why-imet"} -->
<section class="wp-block-imet-step-cards alignfull imet-section section step-cards is-style-home" id="why-imet"><!-- wp:group {"className":"sc-head","layout":{"type":"default"}} -->
<div class="wp-block-group sc-head"><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"eyebrow-line left"} -->
<p class="eyebrow-line left">Our Programs</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"title left"} -->
<h2 class="wp-block-heading title left">Why Choose IMET Worldwide for Your Online Doctorate(DBA) or Master's(MBA) Program?</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"sub"} -->
<p class="sub">At IMET Worldwide, we don’t award degrees, we shape industry authorities. Our programs are built for senior leaders, entrepreneurs, C-Suite executives, and domain experts who want to convert their experience into thought leadership, boardroom influence, and lasting digital visibility.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"imet-container","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container"><!-- wp:group {"className":"step-grid","layout":{"type":"default"}} -->
<div class="wp-block-group step-grid"><!-- wp:group {"className":"step-card","layout":{"type":"default"}} -->
<div class="wp-block-group step-card"><!-- wp:group {"className":"sc-text","layout":{"type":"default"}} -->
<div class="wp-block-group sc-text"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Online, Flexible &amp; Affordable Program</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Our 12–24 month online program is designed for working and IT professionals who want to have Dr. Prefix without giving a break in their career.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"sc-photo"} -->
<figure class="wp-block-image size-full sc-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-why-3.webp' ) ); ?>" alt="Online, Flexible &amp; Affordable Program"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"step-card","layout":{"type":"default"}} -->
<div class="wp-block-group step-card"><!-- wp:group {"className":"sc-text","layout":{"type":"default"}} -->
<div class="wp-block-group sc-text"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">EMI &amp; Scholarship options available</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We offer convenient EMI plans and up to 45% scholarship support. This makes your Doctorate or Master’s program affordable without compromising your financial stability, while still gaining a globally recognized qualification.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"sc-photo"} -->
<figure class="wp-block-image size-full sc-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-why-4.webp' ) ); ?>" alt="Scholarship for online master degree"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"step-card","layout":{"type":"default"}} -->
<div class="wp-block-group step-card"><!-- wp:group {"className":"sc-text","layout":{"type":"default"}} -->
<div class="wp-block-group sc-text"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Personalized Research Guidance</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Work 1-on-1 with our expert research mentors, and receive dedicated support for publishing in SCOPUS / IEEE journals and boost citations on Google Scholar, ResearchGate, and similar platforms.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"sc-photo"} -->
<figure class="wp-block-image size-full sc-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-why-1.webp' ) ); ?>" alt="Why choose IMET's online doctorate and master's program"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"step-card","layout":{"type":"default"}} -->
<div class="wp-block-group step-card"><!-- wp:group {"className":"sc-text","layout":{"type":"default"}} -->
<div class="wp-block-group sc-text"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Digital Presence &amp; Brand Visibility</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We help amplify your professional identity through strategic digital branding, optimizing profiles, showcasing research globally, and ensuring recognition across boardrooms, media, and professional networks worldwide.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"sc-photo"} -->
<figure class="wp-block-image size-full sc-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-why-2.webp' ) ); ?>" alt="Executive branding services"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/step-cards -->

<!-- wp:imet/alumni-video {"className":"is-style-home"} -->
<section class="wp-block-imet-alumni-video alignfull imet-section section alumni is-style-home"><!-- wp:group {"className":"imet-container","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container"><!-- wp:group {"className":"sec-head","layout":{"type":"default"}} -->
<div class="wp-block-group sec-head"><!-- wp:heading {"className":"title"} -->
<h2 class="wp-block-heading title">Alumni Speak: Real Journeys of Global Leadership</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"video-trio","layout":{"type":"default"}} -->
<div class="wp-block-group video-trio"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"video-tile yt-auto"} -->
<figure class="wp-block-image size-full video-tile yt-auto"><a href="https://www.youtube.com/watch?v=Iz36TrS8Aas"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/alumni-convocation.jpg' ) ); ?>" alt="My Doctorate Journey to Global Visibility – with Dr. Raj Srirambatla"/></a><figcaption class="wp-element-caption">My Doctorate Journey to Global Visibility – with Dr. Raj Srirambatla</figcaption></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"video-tile yt-auto"} -->
<figure class="wp-block-image size-full video-tile yt-auto"><a href="https://www.youtube.com/watch?v=si5_oKHCI6g"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/alumni-convocation.jpg' ) ); ?>" alt="How the Doctorate Journey Transformed my Self branding - with Dr. Moutasim Billah"/></a><figcaption class="wp-element-caption">How the Doctorate Journey Transformed my Self branding - with Dr. Moutasim Billah</figcaption></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"video-tile yt-auto"} -->
<figure class="wp-block-image size-full video-tile yt-auto"><a href="https://www.youtube.com/watch?v=LPXJiGiubQI"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/alumni-convocation.jpg' ) ); ?>" alt="Doctorate as My Launchpad with Dr. Irfan Baig"/></a><figcaption class="wp-element-caption">Doctorate as My Launchpad with Dr. Irfan Baig</figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:buttons {"className":"video-more"} -->
<div class="wp-block-buttons video-more"><!-- wp:button {"className":"btn-navy btn-sm"} -->
<div class="wp-block-button btn-navy btn-sm"><a class="wp-block-button__link wp-element-button" href="https://imetworldwide.com/alumni-speak/" target="_blank" rel="noreferrer noopener">View More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/alumni-video -->

<!-- wp:imet/embassy {"className":"is-style-home is-employers"} -->
<section class="wp-block-imet-embassy alignfull imet-section section embassy is-style-home is-employers"><!-- wp:group {"className":"imet-container","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container"><!-- wp:group {"className":"sec-head","layout":{"type":"default"}} -->
<div class="wp-block-group sec-head"><!-- wp:heading {"className":"title"} -->
<h2 class="wp-block-heading title">Our DBA Alumni Lead at Global Powerhouses</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"sub"} -->
<p class="sub">Graduates of our Doctorate in Business Administration hold leadership positions across Fortune 500 companies, top consulting firms, financial institutions, and technology innovators — driving transformation, shaping strategy, and influencing industries worldwide.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"emblem-row","layout":{"type":"default"}} -->
<div class="wp-block-group emblem-row"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-1.webp' ) ); ?>" alt="Ooredoo logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-2.webp' ) ); ?>" alt="First Abu Dhabi Bank logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-3.webp' ) ); ?>" alt="Cure Medical Centres logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-4.webp' ) ); ?>" alt="Alshaya Group logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-5.webp' ) ); ?>" alt="Nesto logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-6.webp' ) ); ?>" alt="Ceer logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-7.webp' ) ); ?>" alt="Alpha Data logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-8.webp' ) ); ?>" alt="Cognizant logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-9.webp' ) ); ?>" alt="Edelweiss logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-10.webp' ) ); ?>" alt="MAP logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-11.webp' ) ); ?>" alt="AG&amp;P logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-12.webp' ) ); ?>" alt="Dexian logo"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"emblem-row","layout":{"type":"default"}} -->
<div class="wp-block-group emblem-row"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-13.webp' ) ); ?>" alt="HP logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-14.webp' ) ); ?>" alt="Katara logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-15.webp' ) ); ?>" alt="Dubai Culture logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-16.webp' ) ); ?>" alt="Western International Group logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-17.webp' ) ); ?>" alt="Adnoc logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-18.webp' ) ); ?>" alt="Global Care logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-19.webp' ) ); ?>" alt="IBM logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-20.webp' ) ); ?>" alt="Ericsson logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-21.webp' ) ); ?>" alt="Deloitte logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-22.webp' ) ); ?>" alt="RIVIAN logo"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"emblem"} -->
<figure class="wp-block-image size-full emblem"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-logo-23.webp' ) ); ?>" alt="ANZ logo"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/embassy -->

<!-- wp:imet/certificate {"className":"is-style-home"} -->
<section class="wp-block-imet-certificate alignfull imet-section section cert is-style-home"><!-- wp:group {"className":"imet-container cert-wrap","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container cert-wrap"><!-- wp:group {"className":"cert-card","layout":{"type":"default"}} -->
<div class="wp-block-group cert-card"><!-- wp:heading {"className":"title left"} -->
<h2 class="wp-block-heading title left">Doctorate Convocation Ceremony of IMET Worldwide Celebrating Excellence in Professional Development</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"cert-sub"} -->
<p class="cert-sub">Discover real journeys of transformation from professionals who turned experience into influence. Explore how our Alumni built personal brands, earned global recognition, and unlocked leadership opportunities through research, visibility, and the “Dr.” title.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-navy btn-sm"} -->
<div class="wp-block-button btn-navy btn-sm"><a class="wp-block-button__link wp-element-button" href="https://imetworldwide.com/convocation-ceremony/">View More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"cert-photos","layout":{"type":"default"}} -->
<div class="wp-block-group cert-photos"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cert-p"} -->
<figure class="wp-block-image size-full cert-p"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-conv-1.webp' ) ); ?>" alt="Doctorate Convocation Ceremony of IMET Worldwide"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cert-p"} -->
<figure class="wp-block-image size-full cert-p"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-conv-2.webp' ) ); ?>" alt="Doctorate Convocation Ceremony of IMET Worldwide"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cert-p"} -->
<figure class="wp-block-image size-full cert-p"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-conv-3.webp' ) ); ?>" alt="Doctorate Convocation Ceremony of IMET Worldwide"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cert-wide"} -->
<figure class="wp-block-image size-full cert-wide"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-convocation.webp' ) ); ?>" alt="Doctorate Convocation Ceremony of IMET Worldwide"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/certificate -->

<!-- wp:imet/step-cards {"className":"is-style-home is-cases","anchor":"case-studies"} -->
<section class="wp-block-imet-step-cards alignfull imet-section section step-cards is-style-home is-cases" id="case-studies"><!-- wp:group {"className":"imet-container","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container"><!-- wp:group {"className":"sec-head","layout":{"type":"default"}} -->
<div class="wp-block-group sec-head"><!-- wp:heading {"className":"title"} -->
<h2 class="wp-block-heading title">Case Studies of Doctorate Alumni</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"step-grid","layout":{"type":"default"}} -->
<div class="wp-block-group step-grid"><!-- wp:group {"className":"step-card","layout":{"type":"default"}} -->
<div class="wp-block-group step-card"><!-- wp:group {"className":"sc-text","layout":{"type":"default"}} -->
<div class="wp-block-group sc-text"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Dr. Ernesto Rufino Jr.</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Achieving New Heights with the Power of a Doctorate.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"sc-more"} -->
<p class="sc-more"><a href="https://imetworldwide.com/success-stories/">Read More</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"sc-photo"} -->
<figure class="wp-block-image size-full sc-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-case-1.webp' ) ); ?>" alt="Dr. Ernesto Rufino Jr."/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"step-card","layout":{"type":"default"}} -->
<div class="wp-block-group step-card"><!-- wp:group {"className":"sc-text","layout":{"type":"default"}} -->
<div class="wp-block-group sc-text"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Dr. Christian Senyo Atitsogbu</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Fueled by a Doctorate, Achieving What Once Seemed Impossible.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"sc-more"} -->
<p class="sc-more"><a href="https://imetworldwide.com/success-stories/">Read More</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"sc-photo"} -->
<figure class="wp-block-image size-full sc-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-case-2.webp' ) ); ?>" alt="Dr. Christian Senyo Atitsogbu"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"step-card","layout":{"type":"default"}} -->
<div class="wp-block-group step-card"><!-- wp:group {"className":"sc-text","layout":{"type":"default"}} -->
<div class="wp-block-group sc-text"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Dr. Shan Shokanwar</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Achieving New Heights with the Power of a Doctorate.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"sc-more"} -->
<p class="sc-more"><a href="https://imetworldwide.com/success-stories/">Read More</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"sc-photo"} -->
<figure class="wp-block-image size-full sc-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-case-3.webp' ) ); ?>" alt="Dr. Shan Shokanwar"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"step-card","layout":{"type":"default"}} -->
<div class="wp-block-group step-card"><!-- wp:group {"className":"sc-text","layout":{"type":"default"}} -->
<div class="wp-block-group sc-text"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Dr. Sona Saha Das</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Achieving New Heights with the Power of a Doctorate.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"sc-more"} -->
<p class="sc-more"><a href="https://imetworldwide.com/wp-content/uploads/2025/10/Case-Study-Dr.-Sona-Saha-Das-2.pdf">Read More</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"sc-photo"} -->
<figure class="wp-block-image size-full sc-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-case-4.webp' ) ); ?>" alt="Dr. Sona Saha Das"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/step-cards -->

<!-- wp:imet/cta {"className":"is-style-home is-publish"} -->
<section class="wp-block-imet-cta alignfull imet-section cta-wrap is-style-home is-publish"><!-- wp:group {"className":"imet-container","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container"><!-- wp:group {"className":"cta","layout":{"type":"default"}} -->
<div class="wp-block-group cta"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cta-bulb"} -->
<figure class="wp-block-image size-full cta-bulb"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-bulb.webp' ) ); ?>" alt="Light bulb"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"cta-text","layout":{"type":"default"}} -->
<div class="wp-block-group cta-text"><!-- wp:heading -->
<h2 class="wp-block-heading">Publish your research paper in International Journals.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"cta-sub"} -->
<p class="cta-sub">Get expert guidance to publish your research papers in top international journals.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cta-photo"} -->
<figure class="wp-block-image size-full cta-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-journals.webp' ) ); ?>" alt="International journals: IEEE, ResearchGate, Elsevier Scopus, Google Scholar, UGC, Web of Science"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/cta -->

<!-- wp:imet/testimonials {"className":"is-style-home is-stories"} -->
<section class="wp-block-imet-testimonials alignfull imet-section section testimonials is-style-home is-stories"><!-- wp:group {"className":"imet-container testi-head","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container testi-head"><!-- wp:paragraph {"className":"eyebrow-line"} -->
<p class="eyebrow-line">Our Programs</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"title"} -->
<h2 class="wp-block-heading title">Our Success Stories</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"sub"} -->
<p class="sub">Discover real journeys of transformation from professionals who turned experience into influence. Explore how our Alumni built personal brands, earned global recognition, and unlocked leadership opportunities through research, visibility, and the “Dr.” title.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"story-grid","layout":{"type":"default"}} -->
<div class="wp-block-group story-grid"><!-- wp:group {"className":"story-card","layout":{"type":"default"}} -->
<div class="wp-block-group story-card"><!-- wp:group {"className":"story-inner","layout":{"type":"default"}} -->
<div class="wp-block-group story-inner"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"story-front"} -->
<figure class="wp-block-image size-full story-front"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-success-1.jpg' ) ); ?>" alt="Dr. Shibin Chulliparambil"/></figure>
<!-- /wp:image -->
<!-- wp:group {"className":"story-back","layout":{"type":"default"}} -->
<div class="wp-block-group story-back"><!-- wp:paragraph {"className":"story-quote"} -->
<p class="story-quote">The Doctorate at IMET Worldwide empowered me to lead with clarity, speak with impact, and influence with purpose.</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"story-foot","layout":{"type":"default"}} -->
<div class="wp-block-group story-foot"><!-- wp:paragraph {"className":"story-name"} -->
<p class="story-name">Dr. Shibin Chulliparambil</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"story-links","layout":{"type":"default"}} -->
<div class="wp-block-group story-links"><!-- wp:paragraph {"className":"story-linkedin"} -->
<p class="story-linkedin"><a href="https://www.linkedin.com/" target="_blank" rel="noreferrer noopener">LinkedIn</a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"story-more"} -->
<p class="story-more"><a href="https://imetworldwide.com/success-stories/">Read More</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"story-card","layout":{"type":"default"}} -->
<div class="wp-block-group story-card"><!-- wp:group {"className":"story-inner","layout":{"type":"default"}} -->
<div class="wp-block-group story-inner"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"story-front"} -->
<figure class="wp-block-image size-full story-front"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-success-2.jpg' ) ); ?>" alt="Dr. Abhishek Mathur"/></figure>
<!-- /wp:image -->
<!-- wp:group {"className":"story-back","layout":{"type":"default"}} -->
<div class="wp-block-group story-back"><!-- wp:paragraph {"className":"story-quote"} -->
<p class="story-quote">Doctorate journey with IMET Worldwide was a catalyst for my leadership growth, transforming me into a stronger leader, speaker, and influencer.</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"story-foot","layout":{"type":"default"}} -->
<div class="wp-block-group story-foot"><!-- wp:paragraph {"className":"story-name"} -->
<p class="story-name">Dr. Abhishek Mathur</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"story-links","layout":{"type":"default"}} -->
<div class="wp-block-group story-links"><!-- wp:paragraph {"className":"story-linkedin"} -->
<p class="story-linkedin"><a href="https://www.linkedin.com/" target="_blank" rel="noreferrer noopener">LinkedIn</a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"story-more"} -->
<p class="story-more"><a href="https://imetworldwide.com/success-stories/">Read More</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"story-card","layout":{"type":"default"}} -->
<div class="wp-block-group story-card"><!-- wp:group {"className":"story-inner","layout":{"type":"default"}} -->
<div class="wp-block-group story-inner"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"story-front"} -->
<figure class="wp-block-image size-full story-front"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-success-3.jpg' ) ); ?>" alt="Dr. Shijin Prasad"/></figure>
<!-- /wp:image -->
<!-- wp:group {"className":"story-back","layout":{"type":"default"}} -->
<div class="wp-block-group story-back"><!-- wp:paragraph {"className":"story-quote"} -->
<p class="story-quote">My Doctorate journey at IMET Worldwide was transformational, shaping me into a tech leader whose voice and influence create lasting value.</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"story-foot","layout":{"type":"default"}} -->
<div class="wp-block-group story-foot"><!-- wp:paragraph {"className":"story-name"} -->
<p class="story-name">Dr. Shijin Prasad</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"story-links","layout":{"type":"default"}} -->
<div class="wp-block-group story-links"><!-- wp:paragraph {"className":"story-linkedin"} -->
<p class="story-linkedin"><a href="https://www.linkedin.com/in/shijinprasad/" target="_blank" rel="noreferrer noopener">LinkedIn</a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"story-more"} -->
<p class="story-more"><a href="https://imetworldwide.com/success-stories/">Read More</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"story-card","layout":{"type":"default"}} -->
<div class="wp-block-group story-card"><!-- wp:group {"className":"story-inner","layout":{"type":"default"}} -->
<div class="wp-block-group story-inner"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"story-front"} -->
<figure class="wp-block-image size-full story-front"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-success-4.jpg' ) ); ?>" alt="Dr. Sona Saha Das"/></figure>
<!-- /wp:image -->
<!-- wp:group {"className":"story-back","layout":{"type":"default"}} -->
<div class="wp-block-group story-back"><!-- wp:paragraph {"className":"story-quote"} -->
<p class="story-quote">Achieving New Heights with the Power of a Doctorate.</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"story-foot","layout":{"type":"default"}} -->
<div class="wp-block-group story-foot"><!-- wp:paragraph {"className":"story-name"} -->
<p class="story-name">Dr. Sona Saha Das</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"story-links","layout":{"type":"default"}} -->
<div class="wp-block-group story-links"><!-- wp:paragraph {"className":"story-more"} -->
<p class="story-more"><a href="https://imetworldwide.com/wp-content/uploads/2025/10/Case-Study-Dr.-Sona-Saha-Das-2.pdf">Read More</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/testimonials -->

<!-- wp:imet/section {"className":"is-style-home","anchor":"centers"} -->
<section class="wp-block-imet-section alignfull imet-section section imet-blank is-style-home" id="centers"><!-- wp:group {"className":"imet-container","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container"><!-- wp:heading {"className":"title"} -->
<h2 class="wp-block-heading title">Affiliated Information Centers</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"sub"} -->
<p class="sub">We are globally accessible, with affiliations and accreditations across multiple regions.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"centres-map"} -->
<figure class="wp-block-image size-full centres-map"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-map.webp' ) ); ?>" alt="Map of IMET Worldwide affiliated information centers across the USA, Europe, Dubai (UAE) and Singapore"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->

<!-- wp:imet/testimonials {"align":"full"} -->
<section class="wp-block-imet-testimonials alignfull imet-section section testimonials"><!-- wp:group {"className":"imet-container testi-head","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container testi-head"><!-- wp:paragraph {"className":"eyebrow-line"} -->
<p class="eyebrow-line">Clients Testimonials</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"title"} -->
<h2 class="wp-block-heading title">What Our Clients Say</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"sub"} -->
<p class="sub">Our success stories cut across various industries, countries, and levels of career experience – learners have received worldwide recognition, CXO appointments, and huge salary increments during their DBA doctor of business administration online experience.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"imet-container","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container"><!-- wp:group {"className":"testi-grid","layout":{"type":"default"}} -->
<div class="wp-block-group testi-grid"><!-- wp:group {"className":"testi-card","layout":{"type":"default"}} -->
<div class="wp-block-group testi-card"><!-- wp:paragraph {"className":"testi-quote"} -->
<p class="testi-quote">“The DBA journey with IMET Worldwide gave me deeper strategic insights to complement my Salesforce and cloud expertise. It empowered me to drive digital innovation with stronger academic and practical grounding.”</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"testi-foot","layout":{"type":"default"}} -->
<div class="wp-block-group testi-foot"><!-- wp:group {"className":"testi-who","layout":{"type":"default"}} -->
<div class="wp-block-group testi-who"><!-- wp:paragraph {"className":"testi-name"} -->
<p class="testi-name"><strong>Dr. Davinder Pal S.</strong></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"testi-role"} -->
<p class="testi-role">Salesforce Application Architect | AWS Certified | Digital Transformation Specialist</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:paragraph {"className":"testi-linkedin"} -->
<p class="testi-linkedin"><a href="https://www.linkedin.com/in/davindersingh-sfdc/" target="_blank" rel="noreferrer noopener">LinkedIn</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"testi-card","layout":{"type":"default"}} -->
<div class="wp-block-group testi-card"><!-- wp:paragraph {"className":"testi-quote"} -->
<p class="testi-quote">“The DBA program at IMET Worldwide enhanced my ability to align technology with business goals. It provided the right blend of academic rigor and practical application for CTO-level leadership.”</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"testi-foot","layout":{"type":"default"}} -->
<div class="wp-block-group testi-foot"><!-- wp:group {"className":"testi-who","layout":{"type":"default"}} -->
<div class="wp-block-group testi-who"><!-- wp:paragraph {"className":"testi-name"} -->
<p class="testi-name"><strong>Dinesh Singh</strong></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"testi-role"} -->
<p class="testi-role">Chief Technology Officer</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:paragraph {"className":"testi-linkedin"} -->
<p class="testi-linkedin"><a href="https://www.linkedin.com/in/dinesh-singh-a9a68912/" target="_blank" rel="noreferrer noopener">LinkedIn</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"testi-card","layout":{"type":"default"}} -->
<div class="wp-block-group testi-card"><!-- wp:paragraph {"className":"testi-quote"} -->
<p class="testi-quote">“The DBA journey at IMET Worldwide enriched my strategic approach to IT operations and management. The mentorship and research exposure helped me align business goals with technology leadership more effectively.”</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"testi-foot","layout":{"type":"default"}} -->
<div class="wp-block-group testi-foot"><!-- wp:group {"className":"testi-who","layout":{"type":"default"}} -->
<div class="wp-block-group testi-who"><!-- wp:paragraph {"className":"testi-name"} -->
<p class="testi-name"><strong>Meheriar Patel</strong></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"testi-role"} -->
<p class="testi-role">Group CIO | CDO | CTO | Mentor &amp; Advisor</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:paragraph {"className":"testi-linkedin"} -->
<p class="testi-linkedin"><a href="https://www.linkedin.com/in/meheriar/" target="_blank" rel="noreferrer noopener">LinkedIn</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:buttons {"className":"testi-more"} -->
<div class="wp-block-buttons testi-more"><!-- wp:button {"className":"btn-link btn-lg"} -->
<div class="wp-block-button btn-link btn-lg"><a class="wp-block-button__link wp-element-button" href="#">View More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/testimonials -->

<!-- wp:imet/faq {"align":"full","anchor":"faq"} -->
<section id="faq" class="wp-block-imet-faq alignfull imet-section section faq"><!-- wp:group {"className":"imet-container narrow","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container narrow"><!-- wp:group {"className":"sec-head","layout":{"type":"default"}} -->
<div class="wp-block-group sec-head"><!-- wp:paragraph {"className":"eyebrow-line faq-eyebrow"} -->
<p class="eyebrow-line faq-eyebrow">Doctorate (DBA) Frequently Asked Questions (FAQs)</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"title"} -->
<h2 class="wp-block-heading title">Doctorate in Cybersecurity certificate Program</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"faq-acc","layout":{"type":"default"}} -->
<div class="wp-block-group faq-acc"><!-- wp:details -->
<details class="wp-block-details"><summary>What is an Online Doctorate (DBA) and Master’s Programs ?</summary><!-- wp:paragraph -->
<p>The online Doctor of Business Administration (DBA) program at IMET Worldwide delivers terminal-level education for senior information technology professionals who want to reach leadership roles in business or consulting or academic positions. Students gain leadership skills and research abilities through its combination of flexible internet learning and research-based studies.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->
<!-- wp:details -->
<details class="wp-block-details"><summary>How long does it take to complete an online doctorate program in IMET Worldwide &amp; what are the fees?</summary><!-- wp:paragraph -->
<p>An online doctorate program at IMET Worldwide can be completed in 12–24 months. The total program fee for the course is USD 8,000.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->
<!-- wp:details -->
<details class="wp-block-details"><summary>Who can take the IMET Doctorate (DBA) Program?</summary><!-- wp:paragraph -->
<p>This program is for:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li>Senior Working Professionals</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>The program aims for postgraduate students who wish to enhance their professional development</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Masters graduates who specialized in a defined field of study</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></details>
<!-- /wp:details -->
<!-- wp:details -->
<details class="wp-block-details"><summary>Which specializations do you offer for online doctoral (DBA) programs?</summary><!-- wp:paragraph -->
<p>Doctoral programs at IMET enable working IT professionals to choose between IT Governance training as well as advanced studies in AI &amp; Machine Learning and Cybersecurity and Project Management and Data Analytics and Generative AI and Supply Chain Management. Every concentration teaches them advanced capabilities with strategic understandings which empower leaders to boost modern digital business success through security and efficiency and innovation.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->
<!-- wp:details -->
<details class="wp-block-details"><summary>Which specialization should I choose for an online Doctorate program?</summary><!-- wp:paragraph -->
<p>To determine the right specialization for your online Doctorate research consider your professional objectives alongside your selected field of work. The IMET Worldwide program features a range of focused learning options which include IT Governance together with AI &amp; Machine Learning and Cybersecurity Quadrilaterals and Project Management and Data Analytics along with Generative AI and Supply Chain Management. These areas provide you with essential competencies and sharp intelligence to lead within today’s digital environment.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->
<!-- wp:details -->
<details class="wp-block-details"><summary>How can an online Doctorate degree from IMET Worldwide help me to advance my career?</summary><!-- wp:paragraph -->
<p>An online Doctorate from IMET Worldwide enhances your cognitive understanding and teaches you to become a strategic leader through successive learning along with practical specialization training. Your new skills will help you both lead digital transformations and generate innovation which leads to enhanced industry competition and positions you for senior leadership opportunities while enhancing your professional standing.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->
<!-- wp:details -->
<details class="wp-block-details"><summary>Can I specialize in Artificial Intelligence or Cybersecurity within the Online DBA?</summary><!-- wp:paragraph -->
<p>Yes. Our Online DBA programs allow you to focus their research on high-demand areas such as Artificial Intelligence, Cybersecurity, Data Analytics, Digital Transformation, or IT Governance. While the program is typically a Doctor of Business Administration, the specialization is reflected in the research topic and dissertation.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->
<!-- wp:details -->
<details class="wp-block-details"><summary>Can a graduate from an Online DBA program use the title “Dr.”?</summary><!-- wp:paragraph -->
<p>Yes. Professionals of accredited and recognized doctoral programs, including Online DBA programs, are academically entitled to use the title “Dr.” as per the awarding institution’s regulations and local laws.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->
<!-- wp:details -->
<details class="wp-block-details"><summary>Are online MBA and DBA programs valid for the UAE Golden Visa?</summary><!-- wp:paragraph -->
<p>Eligibility for the UAE Golden Visa depends on official government criteria, accreditation status, academic ranking, and degree recognition. While postgraduate degrees may support eligibility, applicants should verify requirements directly with UAE authorities or immigration advisors before making decisions.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->
<!-- wp:details -->
<details class="wp-block-details"><summary>Can I complete my doctoral thesis while working full-time?</summary><!-- wp:paragraph -->
<p>Yes. Most Online DBA programs are specifically designed for working professionals. With structured supervision, milestone-based research planning, and time management, candidates can complete their thesis alongside full-time employment.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details --></div>
<!-- /wp:group -->
<!-- wp:buttons {"className":"center faq-more"} -->
<div class="wp-block-buttons center faq-more"><!-- wp:button {"className":"btn-navy btn-md"} -->
<div class="wp-block-button btn-navy btn-md"><a class="wp-block-button__link wp-element-button" href="#faq">See More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/faq -->

<!-- wp:imet/cta {"align":"full"} -->
<section class="wp-block-imet-cta alignfull imet-section cta-wrap"><!-- wp:group {"className":"imet-container","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container"><!-- wp:group {"className":"cta","layout":{"type":"default"}} -->
<div class="wp-block-group cta"><!-- wp:group {"className":"cta-text","layout":{"type":"default"}} -->
<div class="wp-block-group cta-text"><!-- wp:heading -->
<h2 class="wp-block-heading">Step into your next chapter<br>as a <strong>Tech Advisor, CxO, or<br>Boardroom Leader.</strong></h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"cta-sub"} -->
<p class="cta-sub">Discover how the program transformed their careers and enhanced their leadership journey. Gain valuable insights from professionals who have walked the same path.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cta-photo"} -->
<figure class="wp-block-image size-full cta-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/cta-graduates.jpg' ) ); ?>" alt="IMET DBA graduates at convocation"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/cta -->

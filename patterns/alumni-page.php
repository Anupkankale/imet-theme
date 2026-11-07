<?php
/**
 * Title: Alumni Page
 * Slug: imet-theme/alumni-page
 * Description: Alumni stories and community page: a navy hero with graduate portraits and stats, alumni podcasts and success stories filtered by topic beside a sticky advisor form, more ways to explore and a closing call to action.
 * Categories: imet-sections
 * Keywords: imet, page, alumni, stories, community, podcast
 * Block Types: core/post-content
 * Viewport Width: 1440
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:imet/section {"anchor":"top","className":"al-hero"} -->
<section id="top" class="wp-block-imet-section alignfull imet-section section imet-blank al-hero"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"al-hero-bg"} -->
<figure class="wp-block-image size-full al-hero-bg"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-convocation.webp' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->
<!-- wp:group {"className":"imet-container al-hero-grid","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container al-hero-grid"><!-- wp:group {"className":"al-hero-text","layout":{"type":"default"}} -->
<div class="wp-block-group al-hero-text"><!-- wp:paragraph {"className":"eyebrow-line left"} -->
<p class="eyebrow-line left">Alumni Stories &amp; Global Community</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Real Leaders. Real Journeys.<br><span class="al-accent">Global Impact.</span></h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"al-lead"} -->
<p class="al-lead">Listen to inspiring conversations with our Doctorate graduates who turned their vision into impact, and share their experience with IMET Worldwide.</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"al-stats","layout":{"type":"default"}} -->
<div class="wp-block-group al-stats"><!-- wp:paragraph {"className":"al-stat"} -->
<p class="al-stat"><strong>450+</strong> Leaders</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"al-stat"} -->
<p class="al-stat"><strong>40+</strong> Countries Represented</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"al-stat"} -->
<p class="al-stat"><strong>18+</strong> Years since inception</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-grads","layout":{"type":"default"}} -->
<div class="wp-block-group al-grads"><!-- wp:group {"className":"al-grad","layout":{"type":"default"}} -->
<div class="wp-block-group al-grad"><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-grad-6.webp' ) ); ?>" alt="Dr. Rufino Jr."/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"className":"al-grad-name"} -->
<p class="al-grad-name"><a href="/alumni-speak/"><strong>Dr. Rufino Jr.</strong> Doctorate Graduate</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-grad","layout":{"type":"default"}} -->
<div class="wp-block-group al-grad"><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-grad-5.webp' ) ); ?>" alt="Dr. Olaniyi Olaniyan"/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"className":"al-grad-name"} -->
<p class="al-grad-name"><a href="/alumni-speak/"><strong>Dr. Olaniyi Olaniyan</strong> Doctorate Graduate</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-grad","layout":{"type":"default"}} -->
<div class="wp-block-group al-grad"><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-grad-3.webp' ) ); ?>" alt="Dr. Caroline Koech"/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"className":"al-grad-name"} -->
<p class="al-grad-name"><a href="/alumni-speak/"><strong>Dr. Caroline Koech</strong> Doctorate Graduate</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->
<!-- wp:imet/section {"anchor":"stories","className":"al-stories"} -->
<section id="stories" class="wp-block-imet-section alignfull imet-section section imet-blank al-stories"><!-- wp:group {"className":"imet-container al-layout","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container al-layout"><!-- wp:group {"className":"al-main","layout":{"type":"default"}} -->
<div class="wp-block-group al-main"><!-- wp:group {"className":"al-bar","layout":{"type":"default"}} -->
<div class="wp-block-group al-bar"><!-- wp:buttons {"className":"al-chips"} -->
<div class="wp-block-buttons al-chips"><!-- wp:button {"className":"is-active"} -->
<div class="wp-block-button is-active"><a class="wp-block-button__link wp-element-button" href="#all">Featured Stories</a></div>
<!-- /wp:button -->
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#journey">Doctorate Journey</a></div>
<!-- /wp:button -->
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#leadership">Leadership Insights</a></div>
<!-- /wp:button -->
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#life">Life After Doctorate</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- wp:paragraph {"className":"al-more-link"} -->
<p class="al-more-link"><a href="/alumni-speak/">Watch more inspiring stories</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-grid","layout":{"type":"default"}} -->
<div class="wp-block-group al-grid"><!-- wp:group {"className":"al-card al-cat-journey","layout":{"type":"default"}} -->
<div class="wp-block-group al-card al-cat-journey"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb yt-auto"} -->
<figure class="wp-block-image size-full al-thumb yt-auto"><a href="https://www.youtube.com/watch?v=Iz36TrS8Aas"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/alumni-convocation.jpg' ) ); ?>" alt="My Doctorate Journey to Global Visibility, with Dr. Raj Srirambatla"/></a></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"className":"al-badge"} -->
<p class="al-badge">Podcast</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">My Doctorate Journey to Global Visibility, with Dr. Raj Srirambatla</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"al-card-text"} -->
<p class="al-card-text">Dr. Raj Srirambatla, Executive Manager at IBM and Global Program Leader in Hybrid Cloud Transformation, shares how the Doctorate repositioned the leader in him.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"al-tags"} -->
<p class="al-tags"><span>Leadership</span><span>Cloud</span><span>Career Growth</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-card al-cat-leadership","layout":{"type":"default"}} -->
<div class="wp-block-group al-card al-cat-leadership"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb yt-auto"} -->
<figure class="wp-block-image size-full al-thumb yt-auto"><a href="https://www.youtube.com/watch?v=LPXJiGiubQI"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/alumni-convocation.jpg' ) ); ?>" alt="Doctorate as My Launchpad, featuring Dr. Irfan Baig"/></a></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"className":"al-badge"} -->
<p class="al-badge">Podcast</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">Doctorate as My Launchpad, featuring Dr. Irfan Baig</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"al-card-text"} -->
<p class="al-card-text">Dr. Irfan Baig on redefining leadership in global health tech, and how the Doctorate became the launchpad for his next role.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"al-tags"} -->
<p class="al-tags"><span>Health Tech</span><span>Innovation</span><span>Leadership</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-card al-cat-life","layout":{"type":"default"}} -->
<div class="wp-block-group al-card al-cat-life"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb yt-auto"} -->
<figure class="wp-block-image size-full al-thumb yt-auto"><a href="https://www.youtube.com/watch?v=si5_oKHCI6g"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/alumni-convocation.jpg' ) ); ?>" alt="Video interview podcast with Moutasim Billah"/></a></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"className":"al-badge"} -->
<p class="al-badge">Podcast</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">In Conversation with Moutasim Billah</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"al-card-text"} -->
<p class="al-card-text">A video interview podcast hosted by Deepti Kaur: Moutasim Billah on his experience with IMET Worldwide and what came next.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"al-tags"} -->
<p class="al-tags"><span>Global Impact</span><span>Education</span><span>Personal Growth</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-card al-cat-leadership","layout":{"type":"default"}} -->
<div class="wp-block-group al-card al-cat-leadership"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb"} -->
<figure class="wp-block-image size-full al-thumb"><a href="/success-stories/"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-success-1.jpg' ) ); ?>" alt="Dr. Shibin Chulliparambil"/></a></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"className":"al-badge is-story"} -->
<p class="al-badge is-story">Success Story</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">Leading with Clarity and Purpose: Dr. Shibin Chulliparambil</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"al-card-text"} -->
<p class="al-card-text">“The Doctorate at IMET Worldwide empowered me to lead with clarity, speak with impact, and influence with purpose.”</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"al-tags"} -->
<p class="al-tags"><span>Leadership</span><span>Influence</span><span>Strategy</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-card al-cat-journey","layout":{"type":"default"}} -->
<div class="wp-block-group al-card al-cat-journey"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb"} -->
<figure class="wp-block-image size-full al-thumb"><a href="/success-stories/"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-success-2.jpg' ) ); ?>" alt="Dr. Abhishek Mathur"/></a></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"className":"al-badge is-story"} -->
<p class="al-badge is-story">Success Story</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">A Catalyst for Leadership Growth: Dr. Abhishek Mathur</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"al-card-text"} -->
<p class="al-card-text">“The Doctorate journey with IMET Worldwide was a catalyst for my leadership growth, transforming me into a stronger leader, speaker, and influencer.”</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"al-tags"} -->
<p class="al-tags"><span>Transformation</span><span>Speaking</span><span>Success</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-card al-cat-life","layout":{"type":"default"}} -->
<div class="wp-block-group al-card al-cat-life"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb"} -->
<figure class="wp-block-image size-full al-thumb"><a href="https://www.linkedin.com/in/shijinprasad/"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-success-3.jpg' ) ); ?>" alt="Dr. Shijin Prasad"/></a></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"className":"al-badge is-story"} -->
<p class="al-badge is-story">Success Story</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">A Voice That Creates Lasting Value: Dr. Shijin Prasad</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"al-card-text"} -->
<p class="al-card-text">“My Doctorate journey at IMET Worldwide was transformational, shaping me into a tech leader whose voice and influence create lasting value.”</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"al-tags"} -->
<p class="al-tags"><span>AI &amp; Tech</span><span>Influence</span><span>Impact</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:buttons {"className":"al-all"} -->
<div class="wp-block-buttons al-all"><!-- wp:button {"className":"btn-navy btn-md"} -->
<div class="wp-block-button btn-navy btn-md"><a class="wp-block-button__link wp-element-button" href="/alumni-speak/">View All Alumni Stories</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- wp:paragraph {"className":"al-note"} -->
<p class="al-note">More stories. More perspectives. More inspiration.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-aside","layout":{"type":"default"}} -->
<div class="wp-block-group al-aside"><!-- wp:group {"anchor":"advisor-form","className":"al-form","layout":{"type":"default"}} -->
<div id="advisor-form" class="wp-block-group al-form"><!-- wp:group {"className":"al-form-head","layout":{"type":"default"}} -->
<div class="wp-block-group al-form-head"><!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Take the Next Step</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Talk to an advisor and explore how our Doctorate program can support your goals.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:shortcode -->
[imet_advisor_form]
<!-- /wp:shortcode -->
<!-- wp:paragraph {"className":"al-safe"} -->
<p class="al-safe">Your information is safe with us.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-box al-programs","layout":{"type":"default"}} -->
<div class="wp-block-group al-box al-programs"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Explore Our Programs</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"al-prog"} -->
<p class="al-prog"><a href="/online-doctorate-business-administration-dba-programs/"><strong>Online Doctorate (DBA)</strong> Advance your research. Create real-world impact.</a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"al-prog"} -->
<p class="al-prog"><a href="/online-masters-mba-degree-programs/"><strong>Online Masters (MBA)</strong> Build business acumen. Lead with confidence.</a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"al-prog"} -->
<p class="al-prog"><a href="/online-doctorate-dba-artificial-intelligence-ml/"><strong>Doctorate in AI &amp; ML</strong> Future-ready leadership for a digital world.</a></p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-navy btn-sm btn-block"} -->
<div class="wp-block-button btn-navy btn-sm btn-block"><a class="wp-block-button__link wp-element-button" href="/online-doctorate-business-administration-dba-programs/">View All Programs</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-box al-community","layout":{"type":"default"}} -->
<div class="wp-block-group al-box al-community"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Join Our Global Community</h3>
<!-- /wp:heading -->
<!-- wp:group {"className":"al-mini-stats","layout":{"type":"default"}} -->
<div class="wp-block-group al-mini-stats"><!-- wp:paragraph -->
<p><strong>10,000+</strong> Alumni</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p><strong>40+</strong> Countries</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p><strong>18+</strong> Years</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:paragraph {"className":"al-linkedin"} -->
<p class="al-linkedin"><a href="https://www.linkedin.com/school/imetworldwide/" target="_blank" rel="noreferrer noopener"><strong>Follow us on LinkedIn</strong> for the latest updates, events and alumni stories.</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->
<!-- wp:imet/section {"className":"al-explore"} -->
<section class="wp-block-imet-section alignfull imet-section section imet-blank al-explore"><!-- wp:group {"className":"imet-container al-explore-grid","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container al-explore-grid"><!-- wp:group {"className":"al-explore-head","layout":{"type":"default"}} -->
<div class="wp-block-group al-explore-head"><!-- wp:paragraph {"className":"eyebrow-line left"} -->
<p class="eyebrow-line left">More Ways to Explore</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"title left"} -->
<h2 class="wp-block-heading title left">Your Next Step Starts Here</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"al-explore-text"} -->
<p class="al-explore-text">Discover how our Doctorate and Masters programs can help you achieve your goals, build your network and create a lasting impact.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-links","layout":{"type":"default"}} -->
<div class="wp-block-group al-links"><!-- wp:paragraph {"className":"al-link is-details"} -->
<p class="al-link is-details"><a href="/online-doctorate-business-administration-dba-programs/"><strong>Program Details</strong> Curriculum, duration, deliverables &amp; fees</a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"al-link is-brochure"} -->
<p class="al-link is-brochure"><a href="#advisor-form"><strong>Download Brochure</strong> Get the complete program guide</a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"al-link is-advisor"} -->
<p class="al-link is-advisor"><a href="#advisor-form"><strong>Talk to an Advisor</strong> Personalised guidance for your goals</a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"al-link is-stories"} -->
<p class="al-link is-stories"><a href="/success-stories/"><strong>Success Stories</strong> Read more alumni experiences</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->
<!-- wp:imet/cta {"align":"full","className":"al-cta"} -->
<section class="wp-block-imet-cta alignfull imet-section cta-wrap al-cta"><!-- wp:group {"className":"imet-container","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container"><!-- wp:group {"className":"cta","layout":{"type":"default"}} -->
<div class="wp-block-group cta"><!-- wp:group {"className":"cta-text","layout":{"type":"default"}} -->
<div class="wp-block-group cta-text"><!-- wp:paragraph {"className":"eyebrow-line left"} -->
<p class="eyebrow-line left">Global Doctorate. Real-World Impact.</p>
<!-- /wp:paragraph -->
<!-- wp:heading -->
<h2 class="wp-block-heading">Join a Community of Change-Makers</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"cta-sub"} -->
<p class="cta-sub">Be part of a global network of professionals who are shaping the future.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-gold btn-md"} -->
<div class="wp-block-button btn-gold btn-md"><a class="wp-block-button__link wp-element-button" href="/assessment/">Apply Now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- wp:paragraph {"className":"al-or"} -->
<p class="al-or">or <a href="/contact/">Contact an Advisor</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cta-photo"} -->
<figure class="wp-block-image size-full cta-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/cta-graduates.jpg' ) ); ?>" alt="IMET Doctorate graduates at convocation"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/cta -->

<?php
/**
 * Title: Alumni Page
 * Slug: imet-theme/alumni-page
 * Description: Alumni page: a boxed navy hero (eyebrow, title, laurel stats, Download Brochure) with three graduate cards; then "A Milestone Worth Celebrating" with alumni podcast and story cards (YouTube videos play in place), the Related Programs band, See More and the alumni case studies, beside Follow Us, the sticky advisor form and the page tabs.
 * Categories: imet-pages
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
<!-- wp:imet/section {"anchor":"top","className":"al-hero is-v2"} -->
<section id="top" class="wp-block-imet-section alignfull imet-section section imet-blank al-hero is-v2"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"al-hero-bg"} -->
<figure class="wp-block-image size-full al-hero-bg"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-convocation.webp' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->
<!-- wp:group {"className":"imet-container al-hero-grid","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container al-hero-grid"><!-- wp:group {"className":"al-hero-text","layout":{"type":"default"}} -->
<div class="wp-block-group al-hero-text"><!-- wp:paragraph {"className":"eyebrow-line left"} -->
<p class="eyebrow-line left"><?php esc_html_e( 'Our Alumni Shaping Global Leadership', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Driving Leadership Across Global Institutions', 'imet-theme' ); ?></h1>
<!-- /wp:heading -->
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
<!-- /wp:group -->
<!-- wp:buttons {"className":"hero-brochure"} -->
<div class="wp-block-buttons hero-brochure"><!-- wp:button {"className":"btn-white btn-lg btn-icon-download"} -->
<div class="wp-block-button btn-white btn-lg btn-icon-download"><a class="wp-block-button__link wp-element-button" href="#advisor-form"><?php esc_html_e( 'Download Brochure', 'imet-theme' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-grads","layout":{"type":"default"}} -->
<div class="wp-block-group al-grads"><!-- wp:group {"className":"al-grad is-1","layout":{"type":"default"}} -->
<div class="wp-block-group al-grad is-1"><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/al-grad-1.webp' ) ); ?>" alt="Dr. Rufino Jr, IMET Doctorate graduate" width="360" height="726"/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"className":"al-grad-name"} -->
<p class="al-grad-name"><a href="/alumni-speak/"><strong>Dr. Rufino Jr</strong></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-grad is-2","layout":{"type":"default"}} -->
<div class="wp-block-group al-grad is-2"><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/al-grad-2.webp' ) ); ?>" alt="Dr. Olaniyi Olaniyan, IMET Doctorate graduate" width="360" height="726"/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"className":"al-grad-name"} -->
<p class="al-grad-name"><a href="/alumni-speak/"><strong>Dr. Olaniyi Olaniyan</strong></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-grad is-3","layout":{"type":"default"}} -->
<div class="wp-block-group al-grad is-3"><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/al-grad-3.webp' ) ); ?>" alt="Dr. Caroline Koech, IMET Doctorate graduate" width="360" height="726"/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"className":"al-grad-name"} -->
<p class="al-grad-name"><a href="/alumni-speak/"><strong>Dr. Caroline Koech</strong></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->
<!-- wp:imet/section {"anchor":"stories","className":"al-stories is-v2"} -->
<section id="stories" class="wp-block-imet-section alignfull imet-section section imet-blank al-stories is-v2"><!-- wp:group {"className":"imet-container al-layout","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container al-layout"><!-- wp:group {"className":"al-main","layout":{"type":"default"}} -->
<div class="wp-block-group al-main"><!-- wp:group {"className":"al-intro","layout":{"type":"default"}} -->
<div class="wp-block-group al-intro"><!-- wp:paragraph {"className":"eyebrow-line left"} -->
<p class="eyebrow-line left"><?php esc_html_e( 'Overview', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'A Milestone Worth Celebrating', 'imet-theme' ); ?></h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p><?php esc_html_e( 'The Graduation ceremony took place in April 2025 in Prague, Czech Republic. Take a glimpse on how it looked like and maybe we will celebrate next.', 'imet-theme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-grid","layout":{"type":"default"}} -->
<div class="wp-block-group al-grid"><!-- wp:group {"className":"al-card al-cat-journey","layout":{"type":"default"}} -->
<div class="wp-block-group al-card al-cat-journey"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb yt-auto"} -->
<figure class="wp-block-image size-full al-thumb yt-auto"><a href="https://www.youtube.com/watch?v=Iz36TrS8Aas"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/alumni-convocation.jpg' ) ); ?>" alt="My Doctorate Journey to Global Visibility, with Dr. Raj Srirambatla"/></a></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">My Doctorate Journey to Global Visibility, with Dr. Raj Srirambatla</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"al-card-text"} -->
<p class="al-card-text">Dr. Raj Srirambatla, Executive Manager at IBM and Global Program Leader in Hybrid Cloud Transformation, shares how the Doctorate repositioned the leader in him.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-card al-cat-leadership","layout":{"type":"default"}} -->
<div class="wp-block-group al-card al-cat-leadership"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb yt-auto"} -->
<figure class="wp-block-image size-full al-thumb yt-auto"><a href="https://www.youtube.com/watch?v=LPXJiGiubQI"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/alumni-convocation.jpg' ) ); ?>" alt="Doctorate as My Launchpad, featuring Dr. Irfan Baig"/></a></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">Doctorate as My Launchpad, featuring Dr. Irfan Baig</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"al-card-text"} -->
<p class="al-card-text">Dr. Irfan Baig on redefining leadership in global health tech, and how the Doctorate became the launchpad for his next role.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-card al-cat-life","layout":{"type":"default"}} -->
<div class="wp-block-group al-card al-cat-life"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb yt-auto"} -->
<figure class="wp-block-image size-full al-thumb yt-auto"><a href="https://www.youtube.com/watch?v=si5_oKHCI6g"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/alumni-convocation.jpg' ) ); ?>" alt="Video interview podcast with Moutasim Billah"/></a></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">In Conversation with Moutasim Billah</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"al-card-text"} -->
<p class="al-card-text">A video interview podcast hosted by Deepti Kaur: Moutasim Billah on his experience with IMET Worldwide and what came next.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"ss-programs","layout":{"type":"default"}} -->
<div class="wp-block-group ss-programs"><!-- wp:group {"className":"ss-programs-text","layout":{"type":"default"}} -->
<div class="wp-block-group ss-programs-text"><!-- wp:paragraph {"className":"eyebrow-line left"} -->
<p class="eyebrow-line left"><?php esc_html_e( 'Related Programs', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Top Featured Doctorate (DBA) & Masters (MBA) Programs', 'imet-theme' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"ss-programs-links","layout":{"type":"default"}} -->
<div class="wp-block-group ss-programs-links"><!-- wp:paragraph {"className":"ss-program-link"} -->
<p class="ss-program-link"><a href="<?php echo esc_url( home_url( '/online-doctorate-business-administration-dba-programs/' ) ); ?>"><?php esc_html_e( 'Doctorate (DBA) Programs', 'imet-theme' ); ?></a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"ss-program-link"} -->
<p class="ss-program-link"><a href="<?php echo esc_url( home_url( '/online-masters-mba-degree-programs/' ) ); ?>"><?php esc_html_e( 'Online MBA Programs', 'imet-theme' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-grid","layout":{"type":"default"}} -->
<div class="wp-block-group al-grid"><!-- wp:group {"className":"al-card al-cat-leadership","layout":{"type":"default"}} -->
<div class="wp-block-group al-card al-cat-leadership"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb"} -->
<figure class="wp-block-image size-full al-thumb"><a href="/success-stories/"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-success-1.jpg' ) ); ?>" alt="Dr. Shibin Chulliparambil"/></a></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">Leading with Clarity and Purpose: Dr. Shibin Chulliparambil</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"al-card-text"} -->
<p class="al-card-text">“The Doctorate at IMET Worldwide empowered me to lead with clarity, speak with impact, and influence with purpose.”</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-card al-cat-journey","layout":{"type":"default"}} -->
<div class="wp-block-group al-card al-cat-journey"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb"} -->
<figure class="wp-block-image size-full al-thumb"><a href="/success-stories/"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-success-2.jpg' ) ); ?>" alt="Dr. Abhishek Mathur"/></a></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">A Catalyst for Leadership Growth: Dr. Abhishek Mathur</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"al-card-text"} -->
<p class="al-card-text">“The Doctorate journey with IMET Worldwide was a catalyst for my leadership growth, transforming me into a stronger leader, speaker, and influencer.”</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-card al-cat-life","layout":{"type":"default"}} -->
<div class="wp-block-group al-card al-cat-life"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb"} -->
<figure class="wp-block-image size-full al-thumb"><a href="https://www.linkedin.com/in/shijinprasad/"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/home-success-3.jpg' ) ); ?>" alt="Dr. Shijin Prasad"/></a></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">A Voice That Creates Lasting Value: Dr. Shijin Prasad</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"al-card-text"} -->
<p class="al-card-text">“My Doctorate journey at IMET Worldwide was transformational, shaping me into a tech leader whose voice and influence create lasting value.”</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:buttons {"className":"al-all"} -->
<div class="wp-block-buttons al-all"><!-- wp:button {"className":"btn-navy btn-md"} -->
<div class="wp-block-button btn-navy btn-md"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/success-stories/' ) ); ?>"><?php esc_html_e( 'See More', 'imet-theme' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- wp:group {"className":"ss-cases","layout":{"type":"default"}} -->
<div class="wp-block-group ss-cases"><!-- wp:group {"className":"ss-cases-text","layout":{"type":"default"}} -->
<div class="wp-block-group ss-cases-text"><!-- wp:paragraph {"className":"eyebrow-line left"} -->
<p class="eyebrow-line left"><?php esc_html_e( 'Case Studies of our Alumni', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Publish your research paper in International Journals', 'imet-theme' ); ?></h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p><?php esc_html_e( 'Discover real journeys of transformation from IMET alumni who turned their doctoral research into global recognition.', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-white btn-md"} -->
<div class="wp-block-button btn-white btn-md"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/case-studies/' ) ); ?>"><?php esc_html_e( 'View More', 'imet-theme' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"ss-case-list","layout":{"type":"default"}} -->
<div class="wp-block-group ss-case-list">
<?php
// Three alumni case studies (from the old site's Case Studies): photo, doctorate, name linking to the case study PDF
// (in the Media Library).
$imet_al_cases = array(
	array( 'rufino', __( 'Doctorate in Digital Transformation & Cybersecurity', 'imet-theme' ), __( 'Dr. Ernesto Rufino Jr.', 'imet-theme' ), '/wp-content/uploads/2026/11/Rufino-Case-Study_compressed.pdf' ),
	array( 'srijit-nair', __( 'Doctorate in Artificial Intelligence & Cybersecurity', 'imet-theme' ), __( 'Dr. Srijit Nair', 'imet-theme' ), '/wp-content/uploads/2026/11/Srijit-Nair-Case-Study_compressed.pdf' ),
	array( 'sona-saha-das', __( 'Doctorate in Artificial Intelligence & Data Governance', 'imet-theme' ), __( 'Dr. Sona Saha Das', 'imet-theme' ), '/wp-content/uploads/2026/11/SONA-Saha-Das-Case-Study_compressed.pdf' ),
);
foreach ( $imet_al_cases as $imet_ss_i => $imet_ss_case ) :
	$imet_ss_n = $imet_ss_i + 1;
	?>
<!-- wp:group {"className":"ss-case is-<?php echo (int) $imet_ss_n; ?>","layout":{"type":"default"}} -->
<div class="wp-block-group ss-case is-<?php echo (int) $imet_ss_n; ?>"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"ss-case-photo"} -->
<figure class="wp-block-image size-full ss-case-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/ss-case-' . $imet_ss_case[0] . '.webp' ) ); ?>" alt="<?php echo esc_attr( $imet_ss_case[2] ); ?>" width="300" height="270"/></figure>
<!-- /wp:image -->
<!-- wp:group {"className":"ss-case-text","layout":{"type":"default"}} -->
<div class="wp-block-group ss-case-text"><!-- wp:paragraph -->
<p><?php echo esc_html( $imet_ss_case[1] ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"ss-case-name"} -->
<p class="ss-case-name"><a href="<?php echo esc_url( home_url( $imet_ss_case[3] ) ); ?>" target="_blank" rel="noreferrer noopener"><?php echo esc_html( $imet_ss_case[2] ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-aside","layout":{"type":"default"}} -->
<div class="wp-block-group al-aside"><!-- wp:group {"className":"al-follow","layout":{"type":"default"}} -->
<div class="wp-block-group al-follow"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Follow Us:', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-follow-logo"} -->
<figure class="wp-block-image size-full al-follow-logo"><a href="https://www.linkedin.com/school/imetworldwide/" target="_blank" rel="noreferrer noopener"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/linkedin-logo.svg' ) ); ?>" alt="IMET Worldwide on LinkedIn"/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
<!-- wp:group {"anchor":"advisor-form","className":"bl-form","layout":{"type":"default"}} -->
<div id="advisor-form" class="wp-block-group bl-form"><!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Talk to an Advisor', 'imet-theme' ); ?></h2>
<!-- /wp:heading -->
<!-- wp:shortcode -->
[imet_advisor_form]
<!-- /wp:shortcode --></div>
<!-- /wp:group -->
<!-- wp:buttons {"className":"al-tabs"} -->
<div class="wp-block-buttons al-tabs"><!-- wp:button {"className":"al-tab"} -->
<div class="wp-block-button al-tab"><a class="wp-block-button__link wp-element-button" href="/accreditation-and-recognition/">Accreditation</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"al-tab"} -->
<div class="wp-block-button al-tab"><a class="wp-block-button__link wp-element-button" href="/case-studies/">Case Studies</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"al-tab is-accent"} -->
<div class="wp-block-button al-tab is-accent"><a class="wp-block-button__link wp-element-button" href="/alumni-page/" aria-current="page">Alumni Speak</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"al-tab"} -->
<div class="wp-block-button al-tab"><a class="wp-block-button__link wp-element-button" href="/success-stories/">Success Stories</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"al-tab"} -->
<div class="wp-block-button al-tab"><a class="wp-block-button__link wp-element-button" href="/convocation-ceremony/">Convocation Ceremony</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->

<?php
/**
 * Title: Convocation Page
 * Slug: imet-theme/convocation-page
 * Description: Convocation ceremony page: a navy-to-gold hero with the speaker, laurel stats and Download Brochure, a "Convocation Highlights" card over its edge, then "A Milestone Worth Celebrating" with a filter (All, Video by city, Photos) over the ceremony videos (YouTube plays in place) and photos, the Related Programs band, See More and the alumni case studies, beside Follow Us, the sticky advisor form and the page tabs.
 * Categories: imet-pages
 * Keywords: imet, page, convocation, ceremony, graduation, videos, photos
 * Block Types: core/post-content
 * Viewport Width: 1440
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:imet/section {"anchor":"top","className":"cv-hero"} -->
<section id="top" class="wp-block-imet-section alignfull imet-section section imet-blank cv-hero"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cv-hero-bg"} -->
<figure class="wp-block-image size-full cv-hero-bg"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/ss-hero-bg.webp' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cv-speaker"} -->
<figure class="wp-block-image size-full cv-speaker"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/cv-hero-speaker.webp' ) ); ?>" alt="IMET graduate speaking at the convocation ceremony"/></figure>
<!-- /wp:image -->
<!-- wp:group {"className":"imet-container cv-hero-text","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container cv-hero-text"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Celebrating Achievement', 'imet-theme' ); ?><br><?php esc_html_e( 'Convocation Ceremony', 'imet-theme' ); ?></h1>
<!-- /wp:heading -->
<!-- wp:group {"className":"al-stats","layout":{"type":"default"}} -->
<div class="wp-block-group al-stats"><!-- wp:paragraph {"className":"al-stat"} -->
<p class="al-stat"><strong>18+</strong> years of Excellence</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"al-stat"} -->
<p class="al-stat"><strong>450+</strong> Industry Leaders</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"al-stat"} -->
<p class="al-stat"><strong>98%</strong> Satisfaction</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:buttons {"className":"hero-brochure"} -->
<div class="wp-block-buttons hero-brochure"><!-- wp:button {"className":"btn-white btn-lg btn-icon-download"} -->
<div class="wp-block-button btn-white btn-lg btn-icon-download"><a class="wp-block-button__link wp-element-button" href="#advisor-form"><?php esc_html_e( 'Download Brochure', 'imet-theme' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"imet-container cv-highlights","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container cv-highlights"><!-- wp:heading {"level":2,"className":"cv-highlights-title"} -->
<h2 class="wp-block-heading cv-highlights-title"><?php esc_html_e( 'Convocation Highlights', 'imet-theme' ); ?></h2>
<!-- /wp:heading -->
<!-- wp:group {"className":"cv-hl-list","layout":{"type":"default"}} -->
<div class="wp-block-group cv-hl-list"><!-- wp:paragraph {"className":"cv-hl is-cap"} -->
<p class="cv-hl is-cap"><?php esc_html_e( 'Certificate Conferment', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"cv-hl is-globe"} -->
<p class="cv-hl is-globe"><?php esc_html_e( 'Global Graduates', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"cv-hl is-medal"} -->
<p class="cv-hl is-medal"><?php esc_html_e( 'Academic Excellence', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"cv-hl is-trophy"} -->
<p class="cv-hl is-trophy"><?php esc_html_e( 'Industry Leaders', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"cv-hl is-hands"} -->
<p class="cv-hl is-hands"><?php esc_html_e( 'Alumni Networking', 'imet-theme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->
<!-- wp:imet/section {"anchor":"ceremony","className":"al-stories is-v2 cv-main"} -->
<section id="ceremony" class="wp-block-imet-section alignfull imet-section section imet-blank al-stories is-v2 cv-main"><!-- wp:group {"className":"imet-container al-layout","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container al-layout"><!-- wp:group {"className":"al-main","layout":{"type":"default"}} -->
<div class="wp-block-group al-main"><!-- wp:group {"className":"al-intro cv-intro","layout":{"type":"default"}} -->
<div class="wp-block-group al-intro cv-intro"><!-- wp:paragraph {"className":"eyebrow-line"} -->
<p class="eyebrow-line"><?php esc_html_e( 'Overview', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'A Milestone Worth Celebrating', 'imet-theme' ); ?></h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p><?php esc_html_e( 'The Graduation ceremony took place in April 2025 in Prague, Czech Republic. Take a glimpse on how it looked like and maybe we will celebrate next Graduation Ceremony with you, as our new graduates.', 'imet-theme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"cv-filter","layout":{"type":"default"}} -->
<div class="wp-block-group cv-filter"><!-- wp:buttons {"className":"al-chips"} -->
<div class="wp-block-buttons al-chips"><!-- wp:button {"className":"is-active"} -->
<div class="wp-block-button is-active"><a class="wp-block-button__link wp-element-button" href="#all"><?php esc_html_e( 'All', 'imet-theme' ); ?></a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"cv-chip-video"} -->
<div class="wp-block-button cv-chip-video"><a class="wp-block-button__link wp-element-button" href="#video"><?php esc_html_e( 'Video', 'imet-theme' ); ?></a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"cv-chip-photo"} -->
<div class="wp-block-button cv-chip-photo"><a class="wp-block-button__link wp-element-button" href="#photo"><?php esc_html_e( 'Photos', 'imet-theme' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- wp:html -->
<details class="cv-cities"><summary><?php esc_html_e( 'Video by city', 'imet-theme' ); ?></summary><ul><li><a href="#dubai">Dubai</a></li><li><a href="#london">London</a></li><li><a href="#singapore">Singapore</a></li><li><a href="#india">India</a></li></ul></details>
<!-- /wp:html --></div>
<!-- /wp:group -->
<!-- wp:paragraph {"className":"cv-empty"} -->
<p class="cv-empty"><?php esc_html_e( 'Videos from this city are coming soon.', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"al-grid cv-grid","layout":{"type":"default"}} -->
<div class="wp-block-group al-grid cv-grid"><!-- wp:group {"className":"al-card cv-card al-cat-video","layout":{"type":"default"}} -->
<div class="wp-block-group al-card cv-card al-cat-video"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb yt-auto"} -->
<figure class="wp-block-image size-full al-thumb yt-auto"><a href="https://www.youtube.com/watch?v=70KUGav8eso"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/alumni-convocation.jpg' ) ); ?>" alt="Convocation Ceremony: IMET Worldwide"/></a></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">Convocation Ceremony: IMET Worldwide</h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-card cv-card al-cat-video","layout":{"type":"default"}} -->
<div class="wp-block-group al-card cv-card al-cat-video"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb yt-auto"} -->
<figure class="wp-block-image size-full al-thumb yt-auto"><a href="https://www.youtube.com/watch?v=_SeKHPMTEmo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/alumni-convocation.jpg' ) ); ?>" alt="Convocation Ceremony highlights"/></a></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">Convocation Ceremony highlights</h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-card cv-card al-cat-video","layout":{"type":"default"}} -->
<div class="wp-block-group al-card cv-card al-cat-video"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb yt-auto"} -->
<figure class="wp-block-image size-full al-thumb yt-auto"><a href="https://www.youtube.com/watch?v=TCV5TA53m3c"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/alumni-convocation.jpg' ) ); ?>" alt="Graduates receive their degrees"/></a></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">Graduates receive their degrees</h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-card cv-card al-cat-video","layout":{"type":"default"}} -->
<div class="wp-block-group al-card cv-card al-cat-video"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"al-thumb yt-auto"} -->
<figure class="wp-block-image size-full al-thumb yt-auto"><a href="https://www.youtube.com/watch?v=WYhd5UaIbgo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/alumni-convocation.jpg' ) ); ?>" alt="Celebrating our new Doctors"/></a></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">Celebrating our new Doctors</h3>
<!-- /wp:heading --></div>
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
<!-- wp:group {"className":"al-grid cv-grid","layout":{"type":"default"}} -->
<div class="wp-block-group al-grid cv-grid"><!-- wp:group {"className":"al-card cv-card al-cat-photo","layout":{"type":"default"}} -->
<div class="wp-block-group al-card cv-card al-cat-photo"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"al-thumb cv-photo"} -->
<figure class="wp-block-image size-full al-thumb cv-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/ss-hero-bg.webp' ) ); ?>" alt="IMET graduates at the convocation ceremony" loading="lazy"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">IMET graduates at the convocation ceremony</h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-card cv-card al-cat-photo","layout":{"type":"default"}} -->
<div class="wp-block-group al-card cv-card al-cat-photo"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"al-thumb cv-photo"} -->
<figure class="wp-block-image size-full al-thumb cv-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/alumni-convocation.jpg' ) ); ?>" alt="Graduates on stage at the convocation" loading="lazy"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">Graduates on stage at the convocation</h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-card cv-card al-cat-photo","layout":{"type":"default"}} -->
<div class="wp-block-group al-card cv-card al-cat-photo"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"al-thumb cv-photo"} -->
<figure class="wp-block-image size-full al-thumb cv-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/cta-graduates.jpg' ) ); ?>" alt="IMET Doctorate graduates in their gowns" loading="lazy"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">IMET Doctorate graduates in their gowns</h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"al-card cv-card al-cat-photo","layout":{"type":"default"}} -->
<div class="wp-block-group al-card cv-card al-cat-photo"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"al-thumb cv-photo"} -->
<figure class="wp-block-image size-full al-thumb cv-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/join-graduates.jpg' ) ); ?>" alt="Graduates celebrating together" loading="lazy"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"className":"al-card-title"} -->
<h3 class="wp-block-heading al-card-title">Graduates celebrating together</h3>
<!-- /wp:heading --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:buttons {"className":"al-all"} -->
<div class="wp-block-buttons al-all"><!-- wp:button {"className":"btn-navy btn-md"} -->
<div class="wp-block-button btn-navy btn-md"><a class="wp-block-button__link wp-element-button" href="/alumni-page/"><?php esc_html_e( 'See More', 'imet-theme' ); ?></a></div>
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
<?php require get_theme_file_path( 'inc/pattern-parts/alumni-cases.php' ); ?></div>
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
<div class="wp-block-buttons al-tabs"><!-- wp:button {"className":"al-tab is-accent"} -->
<div class="wp-block-button al-tab is-accent"><a class="wp-block-button__link wp-element-button" href="/accreditation-and-recognition/">Accreditation</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"al-tab"} -->
<div class="wp-block-button al-tab"><a class="wp-block-button__link wp-element-button" href="/case-studies/">Case Studies</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"al-tab"} -->
<div class="wp-block-button al-tab"><a class="wp-block-button__link wp-element-button" href="/alumni-speak/">Alumni Speak</a></div>
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

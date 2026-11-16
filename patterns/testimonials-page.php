<?php
/**
 * Title: Testimonials Page
 * Slug: imet-theme/testimonials-page
 * Description: Testimonials: a centred heading (eyebrow, title, lead) on a lavender-to-cream band, and a row of learner cards (photo, name, role, LinkedIn link, quote) that glides sideways and loops. Duplicate a card to add a learner.
 * Categories: imet-pages
 * Keywords: imet, page, testimonials, learners, reviews, linkedin
 * Block Types: core/post-content
 * Viewport Width: 1440
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$imet_tm_learners = array(
	array(
		'photo'    => 'testimonial-patel.webp',
		'name'     => 'Meheriar Patel',
		'role'     => 'Group CIO | CDO | CTO | Mentor & Advisor',
		'linkedin' => 'https://www.linkedin.com/in/meheriar/',
		'quote'    => '“The DBA journey at IMET Worldwide enriched my strategic approach to IT operations and management. The mentorship and research exposure helped me align business goals with technology leadership more effectively.”',
	),
	array(
		'photo'    => 'testimonial-naik.webp',
		'name'     => 'Dr. Amey Naik',
		'role'     => 'Partner, Saga Technologies',
		'linkedin' => 'https://www.linkedin.com/in/dr-amey-naik-b290a882/',
		'quote'    => '“The DBA program at IMET Worldwide helped me refine my leadership vision in digital technology. It strengthened my ability to innovate and mentor global organizations with confidence.”',
	),
	array(
		'photo'    => 'testimonial-nivate.webp',
		'name'     => 'Dr. Vikrant Nivate',
		'role'     => 'Global Service Delivery Manager | DBA | PRINCE2® | Safran Group',
		'linkedin' => 'https://www.linkedin.com/in/vikrant-nivate-105881ba/',
		'quote'    => '“The DBA journey with IMET Worldwide was enriching and practical. It gave me clarity on how to merge research with real-world business practices while driving technology solutions.”',
	),
	array(
		'photo'    => 'testimonial-radha.webp',
		'name'     => 'Dr. Jey Radha',
		'role'     => 'Project/Practice Director – Digital Transformation & IT Security',
		'linkedin' => 'https://www.linkedin.com/in/radhaj/',
		'quote'    => '“The DBA at IMET Worldwide added depth to my service delivery and IT leadership journey. It equipped me with research-driven insights to lead secure, efficient, and future-ready operations.”',
	),
);
?>
<!-- wp:imet/section {"className":"tm-page"} -->
<section class="wp-block-imet-section alignfull imet-section section imet-blank tm-page"><!-- wp:group {"className":"imet-container tm-head","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container tm-head"><!-- wp:paragraph {"className":"eyebrow-line"} -->
<p class="eyebrow-line"><?php esc_html_e( 'Testimonials', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'What Our Learners Say', 'imet-theme' ); ?></h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"tm-lead"} -->
<p class="tm-lead"><?php esc_html_e( 'Real journeys from professionals who turned research and mentorship into leadership impact.', 'imet-theme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"tm-row","layout":{"type":"default"}} -->
<div class="wp-block-group tm-row">
<?php foreach ( $imet_tm_learners as $imet_tm_learner ) : ?>
<!-- wp:group {"className":"tm-card","layout":{"type":"default"}} -->
<div class="wp-block-group tm-card"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"tm-photo"} -->
<figure class="wp-block-image size-full tm-photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/' . $imet_tm_learner['photo'] ) ); ?>" alt="<?php echo esc_attr( $imet_tm_learner['name'] ); ?>"/></figure>
<!-- /wp:image -->
<!-- wp:group {"className":"tm-body","layout":{"type":"default"}} -->
<div class="wp-block-group tm-body"><!-- wp:group {"className":"tm-top","layout":{"type":"default"}} -->
<div class="wp-block-group tm-top"><!-- wp:group {"className":"tm-who","layout":{"type":"default"}} -->
<div class="wp-block-group tm-who"><!-- wp:heading {"level":2,"className":"tm-name"} -->
<h2 class="wp-block-heading tm-name"><?php echo esc_html( $imet_tm_learner['name'] ); ?></h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"tm-role"} -->
<p class="tm-role"><?php echo esc_html( $imet_tm_learner['role'] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:paragraph {"className":"tm-linkedin"} -->
<p class="tm-linkedin"><a href="<?php echo esc_url( $imet_tm_learner['linkedin'] ); ?>" target="_blank" rel="noreferrer noopener">LinkedIn</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:paragraph {"className":"tm-quote"} -->
<p class="tm-quote"><?php echo esc_html( $imet_tm_learner['quote'] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->

<?php
/**
 * Title: Accreditation Page
 * Slug: imet-theme/accreditation-page
 * Description: "Our Accreditation Framework": a navy-to-gold hero with a strip of the five recognition logos, an introduction, one section per accreditation (WES, MOFA UAE, MCA India, Ministry of Education India, MOFA Qatar: title, logo, description), a "Ready to Get Globally Recognized?" band and a Contact Us card.
 * Categories: imet-pages
 * Keywords: imet, page, accreditation, recognition, wes, mofa, mca, ministry of education
 * Block Types: core/post-content
 * Viewport Width: 1440
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$imet_ac_logo = static fn( string $file ): string => esc_url( get_theme_file_uri( 'assets/images/imet/' . $file ) );

// One entry per accreditation: title before the gold part, gold part, title after it, logo, logo alt text, description.
$imet_ac_items = array(
	array(
		'before' => __( 'World Education Services', 'imet-theme' ),
		'gold'   => __( '(WES)', 'imet-theme' ),
		'after'  => __( 'Recognition', 'imet-theme' ),
		'logo'   => 'logo-wes.webp',
		'alt'    => __( 'World Education Services (WES)', 'imet-theme' ),
		'text'   => __( 'World Education Services (WES) evaluates and verifies international academic credentials, ensuring global recognition and equivalency of degrees.', 'imet-theme' ),
	),
	array(
		'before' => __( 'Ministry of Foreign Affairs', 'imet-theme' ),
		'gold'   => __( '(MOFA)', 'imet-theme' ),
		'after'  => __( 'Attestation', 'imet-theme' ),
		'logo'   => 'logo-mofa.webp',
		'alt'    => __( 'Ministry of Foreign Affairs, United Arab Emirates', 'imet-theme' ),
		'text'   => __( 'MOFA attestation is the official verification of educational and legal documents by a country’s Ministry of Foreign Affairs, confirming their authenticity for use abroad in immigration, employment, or higher education purposes.', 'imet-theme' ),
	),
	array(
		'before' => __( 'Ministry of Corporate Affairs', 'imet-theme' ),
		'gold'   => __( '(MCA),', 'imet-theme' ),
		'after'  => __( 'India', 'imet-theme' ),
		'logo'   => 'logo-mca.webp',
		'alt'    => __( 'Ministry of Corporate Affairs, Government of India', 'imet-theme' ),
		'text'   => __( 'IMET programs comply with MCA India regulations, providing official recognition for corporate and executive roles. This makes your program relevant for leadership and consulting opportunities in India.', 'imet-theme' ),
	),
	array(
		'before' => __( 'Ministry of Education', 'imet-theme' ),
		'gold'   => __( '(Shiksha Mantralaya)', 'imet-theme' ),
		'after'  => __( ', India', 'imet-theme' ),
		'logo'   => 'logo-ministry-education.webp',
		'alt'    => __( 'Ministry of Education, India (Shiksha Mantralaya)', 'imet-theme' ),
		'text'   => __( 'Our programs are aligned with India’s Ministry of Education standards, ensuring academic legitimacy and recognition within the Indian education system. Your credentials are fully compliant with national educational requirements.', 'imet-theme' ),
	),
	array(
		'before' => __( 'Ministry of Foreign Affairs', 'imet-theme' ),
		'gold'   => __( 'state of Qatar', 'imet-theme' ),
		'after'  => '',
		'logo'   => 'logo-qatar-mofa.jpg',
		'alt'    => __( 'Ministry of Foreign Affairs, State of Qatar', 'imet-theme' ),
		'text'   => __( 'IMET operates within a Singapore-based academic framework, offering international collaborations, cross-border faculty, and research opportunities. This global approach enhances your learning experience and career prospects worldwide.', 'imet-theme' ),
	),
);
?>
<!-- wp:imet/section {"className":"ac-hero"} -->
<section class="wp-block-imet-section alignfull imet-section section imet-blank ac-hero"><!-- wp:group {"className":"imet-container ac-hero-text","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container ac-hero-text"><!-- wp:paragraph {"className":"ac-crumbs"} -->
<p class="ac-crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'imet-theme' ); ?></a> » <?php esc_html_e( 'Accreditation', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Our Accreditation Framework', 'imet-theme' ); ?></h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"ac-lead"} -->
<p class="ac-lead"><?php esc_html_e( 'Get clarity on IMET Worldwide’s Accreditations & Global Recognition', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"className":"ac-hero-cta"} -->
<div class="wp-block-buttons ac-hero-cta"><!-- wp:button {"className":"btn-white btn-md"} -->
<div class="wp-block-button btn-white btn-md"><a class="wp-block-button__link wp-element-button" href="#contact"><?php esc_html_e( 'Speak to Career Advisor', 'imet-theme' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
<!-- wp:group {"className":"imet-container ac-logos","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container ac-logos">
<?php foreach ( array( 3, 2, 0, 4, 1 ) as $imet_ac_i ) : ?>
<!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo $imet_ac_logo( $imet_ac_items[ $imet_ac_i ]['logo'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by the closure. ?>" alt="<?php echo esc_attr( $imet_ac_items[ $imet_ac_i ]['alt'] ); ?>"/></figure>
<!-- /wp:image -->
<?php endforeach; ?>
</div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->
<!-- wp:imet/section {"className":"ac-main"} -->
<section class="wp-block-imet-section alignfull imet-section section imet-blank ac-main"><!-- wp:group {"className":"imet-container","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container"><!-- wp:group {"className":"ac-intro","layout":{"type":"default"}} -->
<div class="wp-block-group ac-intro"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Globally Recognized. Credible. Career-Ready.', 'imet-theme' ); ?></h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p><?php esc_html_e( 'At IMET Worldwide, we ensure that your Doctorate, MBA, or Diploma journey is backed by strong academic credibility and international validation. Our institutional and documentation framework aligns with globally recognized standards to support career mobility, credential equivalence, and government attestation.', 'imet-theme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<?php foreach ( $imet_ac_items as $imet_ac_item ) : ?>
<!-- wp:group {"className":"ac-item","layout":{"type":"default"}} -->
<div class="wp-block-group ac-item"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php echo esc_html( $imet_ac_item['before'] ); ?><br><strong><?php echo esc_html( $imet_ac_item['gold'] ); ?></strong><?php echo '' !== $imet_ac_item['after'] && ',' !== $imet_ac_item['after'][0] ? ' ' : ''; ?><?php echo esc_html( $imet_ac_item['after'] ); ?></h2>
<!-- /wp:heading -->
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"ac-item-logo"} -->
<figure class="wp-block-image size-full ac-item-logo"><img src="<?php echo $imet_ac_logo( $imet_ac_item['logo'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by the closure. ?>" alt="<?php echo esc_attr( $imet_ac_item['alt'] ); ?>"/></figure>
<!-- /wp:image -->
<!-- wp:paragraph {"className":"ac-item-text"} -->
<p class="ac-item-text"><?php echo esc_html( $imet_ac_item['text'] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->
<!-- wp:imet/section {"className":"ac-band"} -->
<section class="wp-block-imet-section alignfull imet-section section imet-blank ac-band"><!-- wp:group {"className":"imet-container","layout":{"type":"default"}} -->
<div class="wp-block-group imet-container"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Ready to Get Globally Recognized?', 'imet-theme' ); ?></h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p><?php esc_html_e( 'Get clarity on IMET Worldwide’s Accreditations & Global Recognition', 'imet-theme' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->
<!-- wp:imet/section {"anchor":"contact","className":"ac-contact"} -->
<section id="contact" class="wp-block-imet-section alignfull imet-section section imet-blank ac-contact"><!-- wp:group {"className":"ac-contact-card","layout":{"type":"default"}} -->
<div class="wp-block-group ac-contact-card"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Contact Us', 'imet-theme' ); ?></h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p><?php esc_html_e( 'If you have any questions about our accreditations, you can contact us by:', 'imet-theme' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"ac-contact-links","layout":{"type":"default"}} -->
<div class="wp-block-group ac-contact-links"><!-- wp:paragraph {"className":"ac-mail"} -->
<p class="ac-mail"><a href="mailto:imetworldwide@gmail.com">imetworldwide@gmail.com</a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"ac-web"} -->
<p class="ac-web"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php echo esc_html( preg_replace( '#^https?://#', '', home_url( '/contact/' ) ) ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:imet/section -->

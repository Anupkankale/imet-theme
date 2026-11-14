<?php
/**
 * Shared pattern markup (kept out of patterns/, which WordPress scans for patterns): the "Case Studies of our
 * Alumni" list of three real alumni case studies, used by the Alumni, Convocation and Success Stories patterns. Each row:
 * photo, doctorate, name linking to the case study PDF (Media Library). Photos keep room above the head.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$imet_al_cases = [
	// Photo, doctorate, name, case study PDF, cut-out photo (its head rises above the row).
	[ 'srijit-nair', __( 'Doctorate in Artificial Intelligence & Cybersecurity', 'imet-theme' ), __( 'Dr. Srijit Nair', 'imet-theme' ), '/wp-content/uploads/2026/11/Srijit-Nair-Case-Study_compressed.pdf', false ],
	[ 'sona-saha-das-v2', __( 'Doctorate in Artificial Intelligence & Data Governance', 'imet-theme' ), __( 'Dr. Sona Saha Das', 'imet-theme' ), '/wp-content/uploads/2026/11/SONA-Saha-Das-Case-Study_compressed.pdf', true ],
	[ 'rufino-v2', __( 'Doctorate in Digital Transformation & Cybersecurity', 'imet-theme' ), __( 'Dr. Ernesto Rufino Jr.', 'imet-theme' ), '/wp-content/uploads/2026/11/Rufino-Case-Study_compressed.pdf', true ],
];
?>
<!-- wp:group {"className":"ss-case-list","layout":{"type":"default"}} -->
<div class="wp-block-group ss-case-list">
<?php
foreach ( $imet_al_cases as $imet_ss_i => $imet_ss_case ) :
	$imet_ss_n   = $imet_ss_i + 1;
	$imet_ss_cls = 'ss-case is-' . $imet_ss_n . ( $imet_ss_case[4] ? ' is-cutout' : '' );
	?>
<!-- wp:group {"className":"<?php echo esc_attr( $imet_ss_cls ); ?>","layout":{"type":"default"}} -->
<div class="wp-block-group <?php echo esc_attr( $imet_ss_cls ); ?>"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"ss-case-photo"} -->
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
<!-- /wp:group -->

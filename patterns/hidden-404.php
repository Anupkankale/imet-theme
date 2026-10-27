<?php
/**
 * Title: 404 content
 * Slug: imet-theme/hidden-404
 * Description: 404 pattern content.
 * Categories:
 * Keywords: 404, 404 error
 * Viewport Width: 1280
 * Block Types:
 * Post Types:
 * Inserter: false
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|24"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
	<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"display"} -->
	<h1 class="wp-block-heading has-text-align-center has-display-font-size"><?php echo esc_html( _x( '404', 'Error code for a webpage that is not found.', 'imet-theme' ) ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center"><?php esc_html_e( 'This page could not be found. Maybe try a search?', 'imet-theme' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:search {"label":"<?php esc_html_e( 'Search', 'imet-theme' ); ?>","showLabel":false,"buttonText":"<?php esc_html_e( 'Search', 'imet-theme' ); ?>","buttonUseIcon":true} /-->
</div>
<!-- /wp:group -->

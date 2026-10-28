<?php
/**
 * Title: Video section
 * Slug: imet-theme/video-section
 * Description: A large framed video with a list of thumbnails beside it.
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
<!-- wp:group {"align":"full","className":"imet-section-band","layout":{"type":"constrained","contentSize":"var(--wp--style--global--wide-size)"}} -->
<div class="wp-block-group alignfull imet-section-band">
<!-- wp:group {"className":"imet-section-head","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"var(--wp--style--global--content-size)"}} -->
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

<!-- wp:group {"className":"is-style-group-video-gallery","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-group-video-gallery">
<!-- wp:embed {"url":"https://www.youtube.com/watch?v=aqz-KE-bpKQ","type":"video","providerNameSlug":"youtube","responsive":true,"className":"wp-embed-aspect-16-9 wp-has-aspect-ratio is-style-embed-video-frame"} -->
<figure class="wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio is-style-embed-video-frame"><div class="wp-block-embed__wrapper">
https://www.youtube.com/watch?v=aqz-KE-bpKQ
</div></figure>
<!-- /wp:embed -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|12"}},"layout":{"type":"default"}} -->
<div class="wp-block-group">
<!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"is-style-image-video-thumb"} -->
<figure class="wp-block-image size-large is-style-image-video-thumb"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/video-placeholder.svg' ) ); ?>" alt="Video 1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"is-style-image-video-thumb"} -->
<figure class="wp-block-image size-large is-style-image-video-thumb"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/video-placeholder.svg' ) ); ?>" alt="Video 2"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"is-style-image-video-thumb"} -->
<figure class="wp-block-image size-large is-style-image-video-thumb"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/video-placeholder.svg' ) ); ?>" alt="Video 3"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

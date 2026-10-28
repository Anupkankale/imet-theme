<?php
/**
 * Image loading hints.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Media;

use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class Images
 *
 * The graduate cards in the hero are visible as soon as the page loads, so they
 * must not be lazy-loaded; the images of the sections below (logos, emblems, tab
 * and card photos, banners, testimonials, map) are always further down, so they
 * are. WordPress adds its own loading attribute later, and only to images that
 * have none yet.
 *
 * @since 1.0.0
 */
class Images implements Registrable {

	/**
	 * Register hooks.
	 *
	 * @since 1.0.0
	 */
	public function register_hooks(): void {
		add_filter( 'render_block_core/image', [ $this, 'add_loading_hint' ], 20, 2 );
	}

	/**
	 * Add `loading="eager"` or `loading="lazy"` to an image by its class.
	 *
	 * @param string               $html  Block markup.
	 * @param array<string, mixed> $block Parsed block.
	 *
	 * @return string Block markup.
	 */
	public function add_loading_hint( string $html, array $block ): string {
		$class = (string) ( $block['attrs']['className'] ?? '' );

		if ( preg_match( '/(^|\s)h-grad(\s|$)/', $class ) ) {
			$loading = 'eager';
		} elseif ( preg_match( '/(^|\s)(emblem|tab-photo|sc-photo|cta-bulb|cta-photo|cert-p|cert-wide|testi-photo|testi-avatar|centres-map|video-tile)(\s|$)/', $class ) ) {
			$loading = 'lazy';
		} else {
			return $html;
		}

		return (string) preg_replace( '#<img\b(?![^>]*\bloading=)#', '<img loading="' . $loading . '"', $html );
	}
}

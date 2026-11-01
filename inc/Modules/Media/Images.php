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
 * Image loading by position on the page, not by class name. Every page opens with the `imet/hero` section, so the
 * images inside it are visible as soon as the page loads: they load eagerly. No image gets `fetchpriority`: measured on
 * every page pattern, the Largest Contentful Paint element is the hero text (or, on the Home hero at phone width, the
 * section's CSS background), never an image, so a high priority would only compete with the fonts. Images in every other IMET section are further
 * down and load lazily. Images outside IMET sections, and any image that already has a `loading` attribute, are left
 * alone. WordPress adds its own loading attribute later, and only to images that have none yet.
 *
 * @since 1.0.0
 */
class Images implements Registrable {

	/**
	 * The section that opens every page.
	 */
	private const HERO = 'imet/hero';

	/**
	 * How many IMET section blocks are being rendered around the current block.
	 *
	 * @var int
	 */
	private int $section_depth = 0;

	/**
	 * How many hero blocks are being rendered around the current block.
	 *
	 * @var int
	 */
	private int $hero_depth = 0;

	/**
	 * Register hooks.
	 *
	 * @since 1.0.0
	 */
	public function register_hooks(): void {
		add_filter( 'render_block_data', [ $this, 'enter' ] );
		add_filter( 'render_block', [ $this, 'leave' ], 10, 2 );
		add_filter( 'render_block_core/image', [ $this, 'add_loading_hint' ], 20, 2 );
	}

	/**
	 * Note that rendering entered an IMET section (fires before the block's inner blocks render).
	 *
	 * @since 1.2.1
	 *
	 * @param array<string, mixed> $parsed_block Parsed block.
	 *
	 * @return array<string, mixed> The block, unchanged.
	 */
	public function enter( array $parsed_block ): array {
		$this->count( (string) ( $parsed_block['blockName'] ?? '' ), 1 );

		return $parsed_block;
	}

	/**
	 * Note that rendering left an IMET section (fires after its inner blocks rendered).
	 *
	 * @since 1.2.1
	 *
	 * @param string               $content Rendered block HTML.
	 * @param array<string, mixed> $block   Parsed block.
	 *
	 * @return string The HTML, unchanged.
	 */
	public function leave( string $content, array $block ): string {
		$this->count( (string) ( $block['blockName'] ?? '' ), -1 );

		return $content;
	}

	/**
	 * Add `loading` to an image by the section it is in.
	 *
	 * @param string               $html  Block markup.
	 * @param array<string, mixed> $block Parsed block.
	 *
	 * @return string Block markup.
	 */
	public function add_loading_hint( string $html, array $block ): string {
		unset( $block ); // Part of the filter's signature; the section counters already know where the image is.

		if ( $this->section_depth < 1 ) {
			return $html;
		}

		$loading = $this->hero_depth > 0 ? 'eager' : 'lazy';

		return (string) preg_replace( '#<img\b(?![^>]*\bloading=)#', '<img loading="' . $loading . '"', $html, 1 );
	}

	/**
	 * Move the section counters for a block entering (+1) or leaving (-1).
	 *
	 * @param string $name  Block name.
	 * @param int    $delta 1 or -1.
	 */
	private function count( string $name, int $delta ): void {
		if ( ! str_starts_with( $name, 'imet/' ) ) {
			return;
		}

		$this->section_depth = max( 0, $this->section_depth + $delta );

		if ( self::HERO === $name ) {
			$this->hero_depth = max( 0, $this->hero_depth + $delta );
		}
	}
}

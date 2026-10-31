<?php
/**
 * Soft line breaks in headings and lead text.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Typography;

use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class LineBreaks
 *
 * Editors add a `<br>` inside a heading to balance it on desktop. On a phone that forced break leaves a lone word on a line.
 * This marks those breaks (`<br class="imet-br">`) and keeps a space before each one, so the theme CSS can hide the break on
 * small screens without gluing two words together. Headings, and paragraphs styled as section lead text, are covered.
 *
 * @since 1.1.1
 */
class LineBreaks implements Registrable {

	/**
	 * Paragraph classes that are lead text under a heading.
	 *
	 * @since 1.1.1
	 *
	 * @var string[]
	 */
	private const LEAD_CLASSES = [ 'sub', 'hero-lead', 'cta-sub', 'cert-sub' ];

	/**
	 * Register hooks.
	 *
	 * @since 1.1.1
	 */
	public function register_hooks(): void {
		add_filter( 'render_block', [ $this, 'mark_breaks' ], 10, 2 );
	}

	/**
	 * Mark the line breaks of a heading or lead paragraph.
	 *
	 * @since 1.1.1
	 *
	 * @param string               $content Rendered block HTML.
	 * @param array<string, mixed> $block   Parsed block.
	 *
	 * @return string The block HTML with marked breaks.
	 */
	public function mark_breaks( string $content, array $block ): string {
		if ( ! str_contains( $content, '<br' ) ) {
			return $content;
		}

		$name = (string) ( $block['blockName'] ?? '' );

		if ( 'core/heading' !== $name && ! ( 'core/paragraph' === $name && $this->is_lead( $block ) ) ) {
			return $content;
		}

		$marked = preg_replace( '/\s*<br\s*\/?>/i', ' <br class="imet-br">', $content );

		return is_string( $marked ) ? $marked : $content;
	}

	/**
	 * Whether a paragraph block is lead text.
	 *
	 * @since 1.1.1
	 *
	 * @param array<string, mixed> $block Parsed block.
	 *
	 * @return bool True for lead paragraphs.
	 */
	private function is_lead( array $block ): bool {
		$classes = preg_split( '/\s+/', (string) ( $block['attrs']['className'] ?? '' ), -1, PREG_SPLIT_NO_EMPTY );

		return is_array( $classes ) && [] !== array_intersect( self::LEAD_CLASSES, $classes );
	}
}

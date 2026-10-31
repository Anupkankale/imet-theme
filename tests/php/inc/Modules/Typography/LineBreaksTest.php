<?php
/**
 * Tests for LineBreaks.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Tests\Modules\Typography;

use IMET\Theme\Modules\Typography\LineBreaks;
use WP_UnitTestCase;

/**
 * Class LineBreaksTest
 *
 * @since 1.1.1
 */
class LineBreaksTest extends WP_UnitTestCase {

	/**
	 * A heading break is marked and keeps a space before it.
	 *
	 * @since 1.1.1
	 */
	public function test_heading_break_is_marked(): void {
		$out = ( new LineBreaks() )->mark_breaks( '<h2>Validated Doctorate<br>Programs</h2>', [ 'blockName' => 'core/heading' ] );

		$this->assertSame( '<h2>Validated Doctorate <br class="imet-br">Programs</h2>', $out );
	}

	/**
	 * A plain paragraph (an address, for example) is left alone.
	 *
	 * @since 1.1.1
	 */
	public function test_plain_paragraph_is_untouched(): void {
		$html = '<p>Street<br>City</p>';

		$this->assertSame( $html, ( new LineBreaks() )->mark_breaks( $html, [ 'blockName' => 'core/paragraph' ] ) );
	}

	/**
	 * A lead paragraph is covered.
	 *
	 * @since 1.1.1
	 */
	public function test_lead_paragraph_is_marked(): void {
		$out = ( new LineBreaks() )->mark_breaks(
			'<p class="sub">One<br>Two</p>',
			[
				'blockName' => 'core/paragraph',
				'attrs'     => [ 'className' => 'sub' ],
			]
		);

		$this->assertSame( '<p class="sub">One <br class="imet-br">Two</p>', $out );
	}
}

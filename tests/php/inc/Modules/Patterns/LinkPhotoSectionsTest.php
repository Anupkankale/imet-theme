<?php
/**
 * Test LinkPhotoSections class.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

use IMET\Theme\Modules\Patterns\LinkPhotoSections;
use IMET\Theme\Tests\TestCase;

/**
 * Class LinkPhotoSectionsTest
 *
 * @since 1.1.11
 */
class LinkPhotoSectionsTest extends TestCase {

	/**
	 * Synced pattern IDs the tests link to.
	 *
	 * @var array<string, int>
	 */
	private const IDS = [
		'photo-dba-requirements' => 11,
		'photo-dba-benefits'     => 12,
		'photo-mba-highlights'   => 13,
		'photo-home-mba'         => 14,
		'photo-why-1'            => 15,
	];

	/**
	 * An image block as the page patterns saved it.
	 *
	 * @param string $slot Wrapper class.
	 * @param string $file Image file in assets/images/imet.
	 *
	 * @return string Block markup.
	 */
	private function image( string $slot, string $file ): string {
		return '<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"' . $slot . '"} -->' . "\n"
			. '<figure class="wp-block-image size-full ' . $slot . '"><img src="https://example.com/wp-content/themes/imet-theme/assets/images/imet/' . $file . '" alt="x"/></figure>' . "\n"
			. '<!-- /wp:image -->';
	}

	/**
	 * Test the class implements Registrable.
	 */
	public function test_implements_registrable(): void {
		$this->assertInstanceOf( 'rtCamp\WPPrimitives\Contracts\Interfaces\Registrable', new LinkPhotoSections() );
	}

	/**
	 * Test an old labelled photo becomes a reference to its synced section, and nothing else on the page changes.
	 */
	public function test_links_an_old_photo_and_keeps_the_rest(): void {
		$before  = '<!-- wp:paragraph --><p>Team text</p><!-- /wp:paragraph -->';
		$after   = '<!-- wp:heading --><h2 class="wp-block-heading">Kept</h2><!-- /wp:heading -->';
		$content = $before . "\n" . $this->image( 'join-photo', 'course-requirements.webp' ) . "\n" . $after;

		$result = LinkPhotoSections::link( $content, self::IDS );

		$this->assertSame( [ 'photo-dba-requirements' ], $result['linked'] );
		$this->assertSame( $before . "\n" . '<!-- wp:block {"ref":11} /-->' . "\n" . $after, $result['content'] );
	}

	/**
	 * Test the MBA highlights photo maps by where it sits: a Home tab, or a highlights section.
	 */
	public function test_maps_the_same_photo_by_its_slot(): void {
		$this->assertSame( [ 'photo-home-mba' ], LinkPhotoSections::link( $this->image( 'tab-photo', 'mba-highlights.jpg' ), self::IDS )['linked'] );
		$this->assertSame( [ 'photo-mba-highlights' ], LinkPhotoSections::link( $this->image( 'hl-visual', 'mba-highlights.jpg' ), self::IDS )['linked'] );
	}

	/**
	 * Test a labelled section already on the page (from a 1.1.10 page pattern) is linked too.
	 */
	public function test_links_an_inline_photo_section(): void {
		$group = '<!-- wp:group {"className":"sc-photo photo-chips is-pc-why-1","layout":{"type":"default"}} -->' . "\n"
			. '<div class="wp-block-group sc-photo photo-chips is-pc-why-1"><!-- wp:paragraph {"className":"pc-chip pc-1 is-white"} -->' . "\n"
			. '<p class="pc-chip pc-1 is-white">Research-Driven</p>' . "\n<!-- /wp:paragraph --></div>\n<!-- /wp:group -->";

		$result = LinkPhotoSections::link( $group, self::IDS );

		$this->assertSame( [ 'photo-why-1' ], $result['linked'] );
		$this->assertSame( '<!-- wp:block {"ref":15} /-->', $result['content'] );
	}

	/**
	 * Test a real photo is not swapped for a section that still shows the placeholder (that would replace a photo with
	 * a grey box); an inline copy, which already shows the placeholder, is still linked.
	 */
	public function test_keeps_a_real_photo_while_the_section_has_the_placeholder(): void {
		$content = $this->image( 'join-photo', 'course-requirements.webp' );
		$result  = LinkPhotoSections::link( $content, self::IDS, [ 'photo-dba-requirements' ] );

		$this->assertSame( [], $result['linked'] );
		$this->assertSame( [ 'photo-dba-requirements' ], $result['waiting'] );
		$this->assertSame( $content, $result['content'] );

		$group = '<!-- wp:group {"className":"sc-photo photo-chips is-pc-why-1","layout":{"type":"default"}} -->' . "\n"
			. '<div class="wp-block-group sc-photo photo-chips is-pc-why-1"></div>' . "\n<!-- /wp:group -->";

		$this->assertSame( [ 'photo-why-1' ], LinkPhotoSections::link( $group, self::IDS, [ 'photo-why-1' ] )['linked'] );
	}

	/**
	 * Test other images, unknown sections and already linked pages are left alone (running twice is safe).
	 */
	public function test_leaves_other_content_alone(): void {
		$content = $this->image( 'hl-visual', 'team-upload.jpg' ) . "\n" . $this->image( 'ov-visual', 'mba-usp.jpg' ) . "\n" . '<!-- wp:block {"ref":11} /-->';

		$result = LinkPhotoSections::link( $content, self::IDS ); // No synced pattern for mba-usp in these IDs.

		$this->assertSame( [], $result['linked'] );
		$this->assertSame( $content, $result['content'] );
	}
}

<?php
/**
 * Tests for NavWalker.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Tests\Modules\Menus;

use IMET\Theme\Modules\Menus\NavWalker;
use WP_UnitTestCase;

/**
 * Class NavWalkerTest
 *
 * @since 1.2.1
 */
class NavWalkerTest extends WP_UnitTestCase {

	/**
	 * Render one item with the walker.
	 *
	 * @param array<string, mixed> $fields Menu item fields.
	 *
	 * @return string The `<li>` markup.
	 */
	private function item( array $fields ): string {
		$item = (object) array_merge(
			[
				'classes'    => [ 'menu-item' ],
				'title'      => 'Item',
				'url'        => 'https://example.org/item/',
				'target'     => '',
				'xfn'        => '',
				'attr_title' => '',
			],
			$fields
		);

		$output = '';
		( new NavWalker() )->start_el( $output, $item );

		return $output;
	}

	/**
	 * "Open link in a new tab" and the title attribute set in Appearance > Menus are printed, with rel="noopener".
	 *
	 * @since 1.2.1
	 */
	public function test_link_keeps_target_title_and_noopener(): void {
		$html = $this->item(
			[
				'target'     => '_blank',
				'attr_title' => 'Opens in a new tab',
			]
		);

		$this->assertStringContainsString( 'target="_blank"', $html );
		$this->assertStringContainsString( 'rel="noopener"', $html );
		$this->assertStringContainsString( 'title="Opens in a new tab"', $html );
	}

	/**
	 * The XFN field is the link's rel.
	 *
	 * @since 1.2.1
	 */
	public function test_xfn_is_the_rel(): void {
		$html = $this->item( [ 'xfn' => 'nofollow' ] );

		$this->assertStringContainsString( 'rel="nofollow"', $html );
		$this->assertStringNotContainsString( 'target=', $html );
	}

	/**
	 * The current-page classes stay, so a parent of the current page can be styled as active.
	 *
	 * @since 1.2.1
	 */
	public function test_current_classes_are_kept(): void {
		$html = $this->item( [ 'classes' => [ 'menu-item', 'menu-item-123', 'current-menu-ancestor', 'current-menu-parent' ] ] );

		$this->assertStringContainsString( 'current-menu-ancestor', $html );
		$this->assertStringContainsString( 'current-menu-parent', $html );
		$this->assertStringNotContainsString( 'menu-item-123', $html );
	}
}

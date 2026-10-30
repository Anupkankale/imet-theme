<?php
/**
 * Test CurrentYear class.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

use IMET\Theme\Modules\Shortcodes\CurrentYear;
use IMET\Theme\Tests\TestCase;

/**
 * Class CurrentYearTest
 *
 * @since 1.1.0
 */
class CurrentYearTest extends TestCase {

	/**
	 * Test class implements Registrable.
	 */
	public function test_implements_registrable(): void {
		$this->assertInstanceOf( 'rtCamp\WPPrimitives\Contracts\Interfaces\Registrable', new CurrentYear() );
	}

	/**
	 * Test the shortcode is registered.
	 */
	public function test_registers_the_shortcode(): void {
		( new CurrentYear() )->register_hooks();

		$this->assertTrue( shortcode_exists( 'imet_year' ) );
	}

	/**
	 * Test the shortcode prints the current year.
	 */
	public function test_renders_the_current_year(): void {
		$this->assertSame( gmdate( 'Y' ), ( new CurrentYear() )->render() );
		$this->assertSame( gmdate( 'Y' ), do_shortcode( '[imet_year]' ) );
	}
}

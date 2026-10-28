<?php
/**
 * Test the Video and Images modules.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

use IMET\Theme\Modules\Media\Images;
use IMET\Theme\Modules\Media\Video;
use IMET\Theme\Tests\TestCase;

/**
 * Class MediaTest
 *
 * @since 1.0.0
 */
class MediaTest extends TestCase {

	/**
	 * YouTube URLs and the video id each one holds.
	 *
	 * @return array<string, array{0: mixed, 1: string}>
	 */
	public static function youtube_urls(): array {
		return [
			'watch'        => [ 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'dQw4w9WgXcQ' ],
			'watch + list' => [ 'https://www.youtube.com/watch?list=PL1&v=dQw4w9WgXcQ', 'dQw4w9WgXcQ' ],
			'short link'   => [ 'https://youtu.be/dQw4w9WgXcQ?t=10', 'dQw4w9WgXcQ' ],
			'embed'        => [ 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'dQw4w9WgXcQ' ],
			'shorts'       => [ 'https://www.youtube.com/shorts/dQw4w9WgXcQ', 'dQw4w9WgXcQ' ],
			'live'         => [ 'https://www.youtube.com/live/dQw4w9WgXcQ', 'dQw4w9WgXcQ' ],
			'id with - _'  => [ 'https://youtu.be/a-b_c1D2e3F', 'a-b_c1D2e3F' ],
			'not a video'  => [ 'https://example.com/page', '' ],
			'empty'        => [ '', '' ],
			'null'         => [ null, '' ],
		];
	}

	/**
	 * Test the video id is extracted from every YouTube URL shape.
	 *
	 * @dataProvider youtube_urls
	 *
	 * @param mixed  $url      URL.
	 * @param string $expected Video id.
	 */
	public function test_extracts_the_video_id( $url, string $expected ): void {
		$this->assertSame( $expected, ( new Video() )->youtube_id( $url ) );
	}

	/**
	 * Test a yt-auto image shows the YouTube thumbnail.
	 */
	public function test_yt_auto_image_gets_thumbnail(): void {
		$html = ( new Video() )->swap_thumbnail(
			'<figure><a href="https://youtu.be/dQw4w9WgXcQ"><img src="a.jpg" srcset="x" width="1" height="1"/></a></figure>',
			[ 'attrs' => [ 'className' => 'video-item yt-auto' ] ]
		);

		$this->assertStringContainsString( 'https://i.ytimg.com/vi/dQw4w9WgXcQ/hqdefault.jpg', $html );
		$this->assertStringNotContainsString( 'srcset', $html );
	}

	/**
	 * Test images without yt-auto are untouched.
	 */
	public function test_plain_image_is_untouched(): void {
		$html = '<figure><a href="https://youtu.be/dQw4w9WgXcQ"><img src="a.jpg"/></a></figure>';

		$this->assertSame( $html, ( new Video() )->swap_thumbnail( $html, [ 'attrs' => [ 'className' => 'x' ] ] ) );
	}

	/**
	 * Test hero images load eagerly and below-the-fold images lazily.
	 */
	public function test_loading_hints(): void {
		$images = new Images();

		$this->assertStringContainsString(
			'loading="eager"',
			$images->add_loading_hint( '<img src="a.jpg"/>', [ 'attrs' => [ 'className' => 'h-grad' ] ] )
		);
		$this->assertStringContainsString(
			'loading="lazy"',
			$images->add_loading_hint( '<img src="a.jpg"/>', [ 'attrs' => [ 'className' => 'sc-photo' ] ] )
		);
		$this->assertStringNotContainsString(
			'loading=',
			$images->add_loading_hint( '<img src="a.jpg"/>', [ 'attrs' => [ 'className' => 'other' ] ] )
		);
	}
}

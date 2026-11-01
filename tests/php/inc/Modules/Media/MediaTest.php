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
	 * The main player asks for the large thumbnail and names the standard one as its fallback, without inline script
	 * (an onerror attribute breaks under a Content-Security-Policy and does not fire for YouTube's placeholder).
	 */
	public function test_main_player_has_a_fallback_without_inline_script(): void {
		$html = ( new Video() )->swap_thumbnail(
			'<figure><a href="https://youtu.be/dQw4w9WgXcQ"><img src="a.jpg"/></a></figure>',
			[ 'attrs' => [ 'className' => 'video-main yt-auto' ] ]
		);

		$this->assertStringContainsString( 'src="https://i.ytimg.com/vi/dQw4w9WgXcQ/maxresdefault.jpg"', $html );
		$this->assertStringContainsString( 'data-fallback-src="https://i.ytimg.com/vi/dQw4w9WgXcQ/hqdefault.jpg"', $html );
		$this->assertStringNotContainsString( 'onerror', $html );
	}

	/**
	 * Test images without yt-auto are untouched.
	 */
	public function test_plain_image_is_untouched(): void {
		$html = '<figure><a href="https://youtu.be/dQw4w9WgXcQ"><img src="a.jpg"/></a></figure>';

		$this->assertSame( $html, ( new Video() )->swap_thumbnail( $html, [ 'attrs' => [ 'className' => 'x' ] ] ) );
	}

	/**
	 * Loading is decided by position, not by class: every page opens with imet/hero, so its images load eagerly (the
	 * first non-logo one with fetchpriority="high", the page's likely LCP image); images in any later IMET section load lazily;
	 * images outside IMET sections are left to WordPress. A new section needs no list update.
	 */
	public function test_loading_follows_the_section(): void {
		global $wp_filter;

		// Use a fresh instance (fresh fetchpriority state), not the one the theme registered at boot.
		foreach ( [ 'render_block_data', 'render_block', 'render_block_core/image' ] as $hook ) {
			foreach ( $wp_filter[ $hook ]->callbacks ?? [] as $priority => $callbacks ) {
				foreach ( $callbacks as $callback ) {
					if ( is_array( $callback['function'] ) && $callback['function'][0] instanceof Images ) {
						remove_filter( $hook, $callback['function'], $priority );
					}
				}
			}
		}
		( new Images() )->register_hooks();

		$image = static fn ( string $src, string $attrs = '', string $class_name = '' ): string => '' === $class_name
			? '<!-- wp:image --><figure class="wp-block-image"><img src="' . $src . '" alt=""' . $attrs . '/></figure><!-- /wp:image -->'
			: '<!-- wp:image {"className":"' . $class_name . '"} --><figure class="wp-block-image ' . $class_name . '"><img src="' . $src . '" alt=""' . $attrs . '/></figure><!-- /wp:image -->';
		$html  = do_blocks(
			'<!-- wp:imet/hero --><div class="hero">' . $image( 'logo.png', '', 'ac-logo' ) . $image( 'hero-1.jpg' ) . $image( 'hero-2.jpg' ) . $image( 'hero-3.jpg', ' loading="lazy"' ) . '</div><!-- /wp:imet/hero -->'
			. '<!-- wp:imet/highlights --><div>' . $image( 'section.jpg' ) . '</div><!-- /wp:imet/highlights -->'
			. $image( 'outside.jpg' )
		);

		$tag = static function ( string $src ) use ( $html ): string {
			preg_match( '#<img\b[^>]*src="' . preg_quote( $src, '#' ) . '"[^>]*>#', $html, $match );

			return $match[0] ?? '';
		};

		$this->assertStringContainsString( 'loading="eager"', $tag( 'logo.png' ) );
		$this->assertStringNotContainsString( 'fetchpriority', $tag( 'logo.png' ), 'The small accreditation logo is not the LCP image.' );
		$this->assertStringContainsString( 'loading="eager"', $tag( 'hero-1.jpg' ) );
		$this->assertStringContainsString( 'fetchpriority="high"', $tag( 'hero-1.jpg' ) );
		$this->assertStringContainsString( 'loading="eager"', $tag( 'hero-2.jpg' ) );
		$this->assertStringNotContainsString( 'fetchpriority', $tag( 'hero-2.jpg' ) );
		$this->assertStringContainsString( 'loading="lazy"', $tag( 'hero-3.jpg' ), 'An explicit loading attribute is kept.' );
		$this->assertStringContainsString( 'loading="lazy"', $tag( 'section.jpg' ) );
		$this->assertStringNotContainsString( 'fetchpriority', $tag( 'section.jpg' ) );
		$this->assertStringNotContainsString( 'loading="eager"', $tag( 'outside.jpg' ) );
		$this->assertStringNotContainsString( 'fetchpriority', $tag( 'outside.jpg' ) );
	}
}

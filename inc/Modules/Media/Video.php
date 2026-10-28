<?php
/**
 * YouTube thumbnails for the video gallery.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Media;

use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class Video
 *
 * An Image block with the class "yt-auto" that links to a YouTube video shows
 * that video's thumbnail from YouTube, so editors only paste the link (IMET
 * Video gallery). Without a YouTube link, or without "yt-auto", the image chosen
 * in the editor is shown.
 *
 * @since 1.0.0
 */
class Video implements Registrable {

	/**
	 * Register hooks.
	 *
	 * @since 1.0.0
	 */
	public function register_hooks(): void {
		add_filter( 'render_block_core/image', [ $this, 'swap_thumbnail' ], 10, 2 );
	}

	/**
	 * The 11-character video ID from any YouTube URL (watch, youtu.be, embed, shorts, live).
	 *
	 * @param mixed $url URL.
	 *
	 * @return string Video id, or an empty string.
	 */
	public function youtube_id( $url ): string {
		return 1 === preg_match( '#(?:youtu\.be/|[?&]v=|/embed/|/shorts/|/live/)([\w-]{11})#', (string) $url, $match ) ? $match[1] : '';
	}

	/**
	 * Swap the image of a "yt-auto" block for the video's YouTube thumbnail.
	 *
	 * @param string               $html  Block markup.
	 * @param array<string, mixed> $block Parsed block.
	 *
	 * @return string Block markup.
	 */
	public function swap_thumbnail( string $html, array $block ): string {
		$class = (string) ( $block['attrs']['className'] ?? '' );

		if ( ! preg_match( '/(^|\s)yt-auto(\s|$)/', $class ) || ! preg_match( '#<a\b[^>]*\bhref="([^"]+)"#', $html, $link ) ) {
			return $html;
		}

		$id = $this->youtube_id( html_entity_decode( $link[1] ) );

		if ( '' === $id ) {
			return $html;
		}

		// Main player: the largest thumbnail (not every video has one) with the standard one as fallback.
		$base  = 'https://i.ytimg.com/vi/' . $id . '/';
		$large = 1 === preg_match( '/(^|\s)video-main(\s|$)/', $class );
		$src   = $base . ( $large ? 'maxresdefault.jpg' : 'hqdefault.jpg' );

		return (string) preg_replace_callback(
			'#<img\b[^>]*>#',
			static function ( array $img ) use ( $src, $base, $large ): string {
				$tag = (string) preg_replace( '#\s(?:srcset|sizes|width|height)="[^"]*"#', '', $img[0] );
				$tag = (string) preg_replace( '#\ssrc="[^"]*"#', ' src="' . esc_url( $src ) . '"', $tag );
				// The thumbnail's real size, so the browser reserves the space before it loads (maxresdefault is 1280 x 720, hqdefault 480 x 360).
				$tag = str_replace( '<img', '<img width="' . ( $large ? 1280 : 480 ) . '" height="' . ( $large ? 720 : 360 ) . '"', $tag );

				if ( $large ) {
					$tag = str_replace( '<img', '<img onerror="this.onerror=null;this.src=\'' . esc_url( $base . 'hqdefault.jpg' ) . '\'"', $tag );
				}

				return $tag;
			},
			$html,
			1
		);
	}
}

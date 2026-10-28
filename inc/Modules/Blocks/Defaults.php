<?php
/**
 * Default inner content of the IMET section blocks.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Blocks;

/**
 * Class Defaults
 *
 * Reads each block's `default.html` (copied next to its built block.json) and
 * points its images at the theme's copies. The editor inserts this content when
 * a section block is first added.
 *
 * @since 1.0.0
 */
class Defaults {

	/**
	 * Built blocks directory.
	 *
	 * @var string
	 */
	private string $blocks_dir;

	/**
	 * Constructor.
	 *
	 * @param string|null $blocks_dir Built blocks directory; defaults to the theme's assets/build/blocks.
	 */
	public function __construct( ?string $blocks_dir = null ) {
		$this->blocks_dir = $blocks_dir ?? IMET_PATH . '/assets/build/blocks/';
	}

	/**
	 * Default content of one block.
	 *
	 * @param string $block_name Block name, e.g. `imet/hero`.
	 *
	 * @return string Block markup, or an empty string when the block has none.
	 */
	public function get( string $block_name ): string {
		$file = $this->blocks_dir . substr( $block_name, strlen( 'imet/' ) ) . '/default.html';

		if ( ! is_readable( $file ) ) {
			return '';
		}

		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents, WordPressVIPMinimum.Performance.FetchingRemoteData.FileGetContentsUnknown -- Local theme file.
		return $this->resolve_tokens( (string) file_get_contents( $file ) );
	}

	/**
	 * Default content of every block that has some.
	 *
	 * @param string[] $block_names Block names.
	 *
	 * @return array<string, string> Block name => markup.
	 */
	public function all( array $block_names ): array {
		$defaults = [];

		foreach ( $block_names as $name ) {
			$defaults[ $name ] = $this->get( $name );
		}

		return $defaults;
	}

	/**
	 * Replace `{{URL:file}}` with the theme image URL and drop `{{ID:file}}`.
	 *
	 * The images are theme files, not Media Library items, so there is no
	 * attachment id: the image block's `id` attribute and `wp-image-` class go.
	 *
	 * @param string $html Block markup with tokens.
	 *
	 * @return string Block markup.
	 */
	public function resolve_tokens( string $html ): string {
		$html = (string) preg_replace( '/"id":\{\{ID:[^}]*\}\},/', '', $html );
		$html = (string) preg_replace( '/,"id":\{\{ID:[^}]*\}\}/', '', $html );
		$html = (string) preg_replace( '/ class="wp-image-\{\{ID:[^}]*\}\}"/', '', $html );
		$html = (string) preg_replace( '/ ?wp-image-\{\{ID:[^}]*\}\}/', '', $html );

		return (string) preg_replace_callback(
			'/\{\{URL:([^}]*)\}\}/',
			static fn ( array $token ): string => esc_url( get_theme_file_uri( 'assets/images/imet/' . $token[1] ) ),
			$html
		);
	}
}

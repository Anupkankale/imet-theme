<?php
/**
 * IMET section blocks.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Blocks;

use rtCamp\WPPrimitives\AssetLoader;
use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class Blocks
 *
 * Registers the `imet/*` section blocks from the built manifest
 * (assets/build/blocks/blocks-manifest.php, made by `npm run build:blocks`).
 * They are static InnerBlocks wrappers: the saved markup is the content, so
 * there is nothing to render in PHP.
 *
 * @since 1.0.0
 */
class Blocks implements Registrable {

	/**
	 * Built blocks directory, relative to the theme root.
	 */
	private const BLOCKS_PATH = 'blocks';

	/**
	 * Register hooks.
	 *
	 * @since 1.0.0
	 */
	public function register_hooks(): void {
		add_action( 'init', [ $this, 'register_blocks' ] );
		add_filter( 'block_categories_all', [ $this, 'add_category' ] );
		add_filter( 'render_block', [ $this, 'add_alignfull' ], 10, 2 );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_editor_assets' ] );
	}

	/**
	 * Register the shared stylesheet and every block in the manifest.
	 *
	 * @since 1.0.0
	 */
	public function register_blocks(): void {
		$file = IMET_PATH . '/assets/build/blocks/shared/base.css';

		// Shared section styles: a dependency of every block's style, so it loads once and only on pages that use an IMET block.
		wp_register_style(
			'imet-base',
			get_theme_file_uri( 'assets/build/blocks/shared/base.css' ),
			[],
			file_exists( $file ) ? (string) filemtime( $file ) : null
		);
		wp_style_add_data( 'imet-base', 'path', $file );

		$loader = new AssetLoader( IMET_PATH, get_template_directory_uri(), 'assets/build' );
		$loader->register_block_manifest( 'assets/build/' . self::BLOCKS_PATH, 'assets/build/blocks/blocks-manifest.php' );
	}

	/**
	 * Add the "IMET" inserter category, first in the list.
	 *
	 * @param array<int, array<string, mixed>> $categories Block categories.
	 *
	 * @return array<int, array<string, mixed>> Block categories.
	 */
	public function add_category( array $categories ): array {
		array_unshift(
			$categories,
			[
				'slug'  => 'imet',
				'title' => __( 'IMET', 'imet-theme' ),
				'icon'  => null,
			]
		);

		return $categories;
	}

	/**
	 * Add `alignfull` to sections saved before the blocks supported full width.
	 *
	 * Their stored markup has no `alignfull` class, so inside the theme's
	 * constrained page layout they would stay at content width until someone
	 * edits and saves the page (the editor upgrades the markup on save).
	 *
	 * @param string               $html  Block markup.
	 * @param array<string, mixed> $block Parsed block.
	 *
	 * @return string Block markup.
	 */
	public function add_alignfull( string $html, array $block ): string {
		$name = (string) ( $block['blockName'] ?? '' );

		if ( ! str_starts_with( $name, 'imet/' ) || ! empty( $block['attrs']['align'] ) ) {
			return $html;
		}

		$registered = \WP_Block_Type_Registry::get_instance()->get_registered( $name );
		$supports   = $registered->supports['align'] ?? null;

		// Only blocks that support full width; the boxed ones keep their own width. Unregistered (tests) falls back to the name check above.
		if ( null !== $registered && empty( $supports ) ) {
			return $html;
		}

		$tags = new \WP_HTML_Tag_Processor( $html );

		if ( $tags->next_tag() ) {
			$tags->add_class( 'alignfull' );
		}

		return $tags->get_updated_html();
	}

	/**
	 * Editor: the "IMET button" panel and the default content for newly inserted blocks.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_editor_assets(): void {
		$asset_file = IMET_PATH . '/assets/build/blocks/editor/index.asset.php';

		if ( file_exists( $asset_file ) ) {
			$asset = require $asset_file; // phpcs:ignore WordPressVIPMinimum.Files.IncludingFile.UsingVariable -- Built file.

			wp_enqueue_script(
				'imet-blocks-editor',
				get_theme_file_uri( 'assets/build/blocks/editor/index.js' ),
				$asset['dependencies'],
				$asset['version'],
				true
			);
		}

		$names = array_filter(
			array_keys( \WP_Block_Type_Registry::get_instance()->get_all_registered() ),
			static fn ( string $name ): bool => str_starts_with( $name, 'imet/' )
		);

		wp_add_inline_script(
			'wp-blocks',
			'window.imetBlocks = ' . wp_json_encode( [ 'defaults' => ( new Defaults() )->all( $names ) ] ) . ';',
			'before'
		);
	}
}

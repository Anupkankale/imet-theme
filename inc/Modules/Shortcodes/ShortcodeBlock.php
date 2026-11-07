<?php
/**
 * Shortcodes inside Shortcode blocks, wherever the block renders.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Shortcodes;

use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class ShortcodeBlock
 *
 * A template runs its shortcodes before it renders its blocks, so a Shortcode block that only appears once a Pattern
 * block is rendered (the IMET page templates show their page pattern this way) would print `[imet_advisor_form]` as
 * text. Running the shortcode when the block renders fixes that; in post content the later `the_content` pass then
 * finds nothing left to do.
 *
 * @since 1.1.4
 */
class ShortcodeBlock implements Registrable {

	/**
	 * Register hooks.
	 *
	 * @since 1.1.4
	 */
	public function register_hooks(): void {
		add_filter( 'render_block_core/shortcode', [ $this, 'run' ] );
	}

	/**
	 * Run the shortcodes in a Shortcode block's output.
	 *
	 * @since 1.1.4
	 *
	 * @param string $content Block output.
	 *
	 * @return string Block output with its shortcodes run.
	 */
	public function run( string $content ): string {
		return false === strpos( $content, '[' ) ? $content : do_shortcode( $content );
	}
}

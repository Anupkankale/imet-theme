<?php
/**
 * Current year shortcode.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Modules\Shortcodes;

use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

/**
 * Class CurrentYear
 *
 * `[imet_year]` prints the current year, so the footer's copyright line (editable in the Site Editor) never goes stale.
 *
 * @since 1.1.0
 */
class CurrentYear implements Registrable {

	/**
	 * Register hooks.
	 *
	 * @since 1.1.0
	 */
	public function register_hooks(): void {
		add_shortcode( 'imet_year', [ $this, 'render' ] );
	}

	/**
	 * Shortcode output.
	 *
	 * @since 1.1.0
	 *
	 * @return string The current year.
	 */
	public function render(): string {
		return esc_html( gmdate( 'Y' ) );
	}
}

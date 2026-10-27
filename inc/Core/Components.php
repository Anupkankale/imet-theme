<?php
/**
 * Theme component loader.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme\Core;

use IMET\Theme\Main;
use rtCamp\WPPrimitives\AssetLoader;
use rtCamp\WPPrimitives\ComponentLoader;
use rtCamp\WPPrimitives\Contracts\Interfaces\Shareable;

/**
 * Class Components
 *
 * The theme's component loader: namespaces its components/handles under the
 * theme context and registers their assets through the theme's shared Assets
 * instance (its AssetLoader).
 *
 * @since 1.0.0
 */
class Components extends ComponentLoader implements Shareable {

	/**
	 * Context slug used to namespace the theme's component asset handles.
	 */
	protected function get_context(): string {
		return 'elementary';
	}

	/**
	 * Resolve the theme's shared asset loader (its Assets instance).
	 *
	 * @return AssetLoader Shared theme asset loader.
	 */
	protected function get_asset_loader(): AssetLoader {
		/**
		 * Shared theme asset loader.
		 *
		 * @var Assets $assets
		 */
		$assets = Main::get_instance()->get_shared( Assets::class );

		return $assets;
	}
}

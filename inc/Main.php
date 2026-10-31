<?php
/**
 * Theme bootstrap file.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

namespace IMET\Theme;

use rtCamp\WPPrimitives\Contracts\Traits\{Singleton, Loader};
use IMET\Theme\Core\{Assets, Components, FeatureRegistry, Logger, Menu, Templates, ThemeSetup};

use IMET\Theme\Modules\Blocks\Blocks;

use IMET\Theme\Modules\Media\{Images, Video};

/**
 * Class Main
 *
 * @since 1.0.0
 */
class Main {

	use Singleton;
	use Loader;

	/**
	 * List of classes to load.
	 */
	public const CLASSES = [
		Assets::class,
		Menu::class,
		ThemeSetup::class,
		Components::class,
		Templates::class,
		FeatureRegistry::class,
		Logger::class,
		Blocks::class,
		Images::class,
		Video::class,
		Modules\Shortcodes\CurrentYear::class,
	];

	/**
	 * Constructor.
	 */
	protected function __construct() {
		static::$instance = $this;
		$this->load( self::CLASSES );
	}
}

<?php
/**
 * Theme feature base class.
 *
 * @package IMET\Theme\Abstracts
 */

declare( strict_types = 1 );

namespace IMET\Theme\Abstracts;

use IMET\Theme\Core\FeatureRegistry;
use IMET\Theme\Main;
use rtCamp\WPPrimitives\Contracts\Abstracts\AbstractFeature;
use rtCamp\WPPrimitives\Utils\FeatureSelector;

/**
 * Class AbstractThemeFeature
 *
 * Abstract base for all theme features. Wires AbstractFeature to the theme's
 * shared FeatureRegistry via Main::get_shared().
 *
 * @since 1.0.0
 */
abstract class AbstractThemeFeature extends AbstractFeature {

	/**
	 * {@inheritDoc}
	 */
	protected function get_feature_registry(): FeatureSelector {
		return Main::get_instance()->get_shared( FeatureRegistry::class );
	}
}

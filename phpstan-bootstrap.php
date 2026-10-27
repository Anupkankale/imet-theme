<?php
/**
 * PHPStan Bootstrap file.
 *
 * This is just for the constants defined in the theme. This file is used by PHPStan to bootstrap the analysis.
 *
 * @package IMET\Theme
 */

declare(strict_types = 1);

define( 'IMET_VERSION', '1.0.0' );
define( 'IMET_PATH', __DIR__ );
define( 'IMET_BUILD_DIR', __DIR__ . '/assets/build' );
define( 'IMET_BUILD_URI', 'https://example.com/wp-content/themes/imet-theme/assets/build' );
define( 'IMET_ENABLE_TAILWIND', false );

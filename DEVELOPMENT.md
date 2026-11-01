# Development guide

This guide shows how to extend the theme by hand: where new code belongs, which framework base class to start from, and a worked example of adding a class. Use it after [Getting Started](docs/getting-started.md). Run the commands from the theme directory (the directory containing `composer.json` and `package.json`). The theme's namespace is `IMET\Theme\` and its text domain is `imet-theme`.

The theme sits on two layers: `vendor/rtcamp/wp-primitives/` is the upstream framework — reusable scaffolding (the loader and abstract base classes) installed as a Composer dependency — and `inc/` is everything theme-specific, extending those framework abstracts and registering theme services. The `vendor/` boundary is enforced by convention, not code: anything edited there is overwritten on the next `composer install`.

## Before adding code

The theme has a small set of locations with distinct responsibilities:

| Location | Purpose |
| --- | --- |
| `inc/` | Theme PHP classes, loaded through Composer's PSR-4 autoloader. |
| `inc/Main.php` | Theme bootstrap and the `Main::CLASSES` registration list. |
| `tests/php/` | PHPUnit tests that mirror the `inc/` class path. |
| `src/` | Editable JavaScript, CSS, component, and block sources. |
| `assets/build/` | Generated asset output; never edit it by hand. |
| `templates/`, `parts/`, `patterns/`, `styles/`, `theme.json` | Block-theme markup and configuration. |
| `vendor/` | Framework code, Composer-managed. Do not edit — `composer install` overwrites it; changes belong in the framework repository. |

Read the `autoload.psr-4` entry in `composer.json` before creating a namespace. This theme uses `IMET\Theme\`, mapped to `inc/`. Keep directory segments and class names aligned with that mapping, and do not use `classmap` autoloading for namespaced classes — it works against this PSR-4 mapping. Keep the working tree clean enough to review the generated changes, and install dependencies before adding a class:

```bash
composer install
```

Theme classes are registered by `Main::CLASSES`. The framework `Loader` creates each listed class and calls its `register_hooks()` method when it implements `Registrable`. A class that is not in this list does not run, even when its file autoloads successfully. Read the framework's short [registration and loader overview](https://github.com/rtCamp/wp-primitives/blob/v2.0.0/docs/architecture.md) for the lifecycle details.

## Picking a base

| Feature | Extends / implements |
| --- | --- |
| Settings page | `AbstractSettingsPage` |
| Admin (non-settings) page | `AbstractAdminPage` |
| Dynamic block (server-side render) | `AbstractBlock` |
| REST controller | `AbstractRESTController` |
| Shortcode | `AbstractShortcode` |
| Anything else that just wires hooks | `Registrable` interface |
| Same, but registration is conditional | `ConditionallyRegistrable` interface — `Loader` checks `can_register()` before calling `register_hooks()` |

### Conditional registration

A class can opt out of registration at runtime by implementing `ConditionallyRegistrable` instead of `Registrable`:

```php
final class DevToolbarExtension implements ConditionallyRegistrable {
	public function can_register(): bool {
		return defined( 'WP_DEBUG' ) && WP_DEBUG;
	}

	public function register_hooks(): void {
		// Wire dev-only hooks here.
	}
}
```

The `Loader` calls `can_register()` first and skips `register_hooks()` when it returns false.

## Adding a new class

The following small feature appends a notice to post content. It shows the four pieces every theme feature needs: a destination, behavior, registration, and a check.

Start with `tests/php/inc/Modules/ReadingTimeTest.php`, extending the theme's `TestCase`. The test namespace follows the project's `autoload-dev.psr-4` mapping:

```php
<?php

declare( strict_types = 1 );

namespace IMET\Theme\Tests\inc\Modules;

use IMET\Theme\Modules\ReadingTime;
use IMET\Theme\Tests\TestCase;

final class ReadingTimeTest extends TestCase {
	public function test_appends_the_notice(): void {
		$this->assertSame(
			'Article body<p class="imet-reading-time">Reading time: about one minute</p>',
			( new ReadingTime() )->append_notice( 'Article body' )
		);
	}

	public function test_leaves_empty_content_unchanged(): void {
		$this->assertSame( '', ( new ReadingTime() )->append_notice( '' ) );
	}
}
```

Next create `inc/Modules/ReadingTime.php` from the class below, initially using only `return $content;` as the body of `append_notice()`. Run the focused PHP command from [Local development](docs/local-development.md#check-a-change) with `--filter ReadingTimeTest`: the notice assertion should fail. Then implement the method as shown and rerun the test to confirm both assertions pass.

```php
<?php

declare( strict_types = 1 );

namespace IMET\Theme\Modules;

use rtCamp\WPPrimitives\Contracts\Interfaces\Registrable;

final class ReadingTime implements Registrable {
	public function register_hooks(): void {
		add_filter( 'the_content', [ $this, 'append_notice' ] );
	}

	public function append_notice( string $content ): string {
		if ( '' === trim( $content ) ) {
			return $content;
		}

		return $content . '<p class="imet-reading-time">'
			. esc_html__( 'Reading time: about one minute', 'imet-theme' )
			. '</p>';
	}
}
```

Add the class to the existing registration list without replacing any entries:

```php
// inc/Main.php
use IMET\Theme\Modules\ReadingTime;

public const CLASSES = [
	// Keep every existing entry here.
	ReadingTime::class,
];
```

The real list already contains the core services and retained examples; the snippet shows only the new import and entry. Run `composer dump-autoload`, then run the focused test and open a post on the active site. The notice should appear after the post content. To generate a class and its test stub instead, run `npx wp-tooling add` (or the `/scaffold` skill).

The framework supplies the `Registrable` contract and loader. Its [contracts reference](https://github.com/rtCamp/wp-primitives/blob/v2.0.0/docs/contracts.md) and [abstract-class cookbook](https://github.com/rtCamp/wp-primitives/blob/v2.0.0/docs/abstracts.md) cover inherited methods and lifecycle behavior.

## Content that outlives the theme

Post types, taxonomies, structured data and anything else that must survive a theme switch belong in the companion
plugin [`imet-core`](https://github.com/Anupkankale/imet-core), not in this theme or its `Main::CLASSES`. The framework's
[post-type and taxonomy reference](https://github.com/rtCamp/wp-primitives/blob/v2.0.0/docs/abstracts.md#content-registration)
documents the base classes the plugin uses.

## Troubleshooting

Check the failure at the first boundary that can explain it:

| Symptom | Check and next action |
| --- | --- |
| PHP class is found but no behavior runs | Confirm the namespace matches the `composer.json` PSR-4 prefix, the file path mirrors it, and the class is in the correct `Main::CLASSES` list (or companion-plugin module). Run `composer dump-autoload` and reload WordPress. |
| Shortcode or hook is missing | Confirm the class implements `Registrable`, its `register_hooks()` method adds the expected hook, and the active theme/plugin is the one you edited. Run the focused PHPUnit test. |
| A block or script is missing | Check the editable source under `src/`, run `npm run build:dev`, and confirm the matching file exists under `assets/build/`. Do not edit generated output. |
| The page shows a PHP error | Check the WordPress debug log and the first file/line in the error. Run the focused test and `composer phpcs`; fix the namespace, hook signature, or escaping issue reported there. |
| Companion content type is absent | Confirm the plugin is active, the concrete class is returned by its owning module's `get_classes()`, and `Main::CLASSES` contains that module. Run `wp post-type list` or `wp taxonomy list` again. |
| Composer dependencies aren't installed | Not a hard crash — `inc/Autoloader.php` shows an admin notice instead of fataling; run `composer install` and reload. |

Finish a change with the full checks and browser review in [Local development](docs/local-development.md#check-a-change). Keep the detailed framework API in its upstream documentation.

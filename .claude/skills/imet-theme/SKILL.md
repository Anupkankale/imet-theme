---
name: imet-theme
description: Architecture, rules and recipes for the IMET block theme (theme owns blocks, patterns, styles; imet-core plugin only for functionality; rtCamp theme-elementary conventions + WordPress best practice). Use when adding or changing a section block, pattern, block style, token, template, or feature class in this theme, or when deciding whether code belongs in the theme or the plugin.
---

# imet-theme: how the IMET theme is built

The architecture, rules and recipes for this theme, for people and for AI agents. **North star: rtCamp's
[theme-elementary](https://github.com/rtCamp/theme-elementary) conventions, plus WordPress best practice.** If this file and
`AGENTS.md` disagree, `AGENTS.md` (the rtCamp source of truth) wins; fix this file.

This file is the Claude Code skill body; the root `SKILLS.md` carries the same text. Keep both in step.

---

## 1. The one rule: the theme owns presentation

| Belongs in the **theme** (`themes/imet-theme`) | Belongs in the **plugin** (`plugins/imet-core`) |
| --- | --- |
| Blocks (`imet/*`), block styles, patterns, templates, template parts | FAQ structured data (JSON-LD) |
| `theme.json` (colour, type, spacing, radius, shadow, widths) | WP-CLI commands (`wp imet migrate`) |
| All CSS and front-end JS for the above | Custom post types, taxonomies, REST routes, cron, stored data |
| Images the design uses (`assets/images/imet/`) | Anything that must survive switching themes |

Test: *"If the theme were switched off, should this still work?"* Yes → plugin. No → theme.

The old `imet-blocks` plugin is **retired** (it is kept on disk for one release as the rollback, then deleted).
Block names stay `imet/*` so saved pages stay valid.

## 2. Folder map

```
theme.json                  single source of every token (colours, spacing, type, radius, shadow, widths)
style.css                   theme header only
functions.php               boots IMET\Theme\Main
inc/Main.php                Main::CLASSES: every feature class is listed here (Registrable / Shareable / Loader)
inc/Core/                   Assets, Menu, ThemeSetup, Templates, Components, FeatureRegistry, Logger
inc/Modules/Blocks/         Blocks (registers imet/*, category, alignfull fallback, editor assets) + Defaults (default.html)
inc/Modules/Media/          Images (loading hints) + Video (YouTube thumbnails)
src/blocks/<name>/          one section block: block.json, index.js, style.scss, view.js?, default.html
src/blocks-shared/          section-block.js (registerSectionBlock), view-helpers.js, button-panel.js, base/buttons/utilities SCSS, editor.js
src/css/                    theme-wide SCSS (design-system, components, header-footer, breakpoints)
src/js/                     theme-wide JS (e.g. footer accordion)
templates/ parts/           block templates and template parts (HTML, tokens only)
patterns/                   PHP patterns, auto-registered (Title / Slug / Categories header)
styles/blocks/              block style variations (JSON; slug = filename, class is-style-<slug>)
assets/images/imet/         the design's images (use get_theme_file_uri)
assets/build/               build output, gitignored (CI builds it)
bin/                        audit-tokens.js, verify-blocks.js, shoot.js
tests/php/ tests/js/        PHPUnit (mirrors inc/) and Jest
docs/design-system.md       token table and the documented exceptions
```

## 3. rtCamp rules to follow (details in AGENTS.md)

- **TDD**: failing PHPUnit test first (`tests/php/` mirrors `inc/`), then the class.
- A feature = a class implementing `Registrable` (hooks in `register_hooks()`), added to `Main::CLASSES`. No `Singleton` except `Main`;
  `Shareable` only when an instance must be fetched later.
- Prefer `theme.json`, patterns and template parts over markup or styling in PHP.
- `declare( strict_types = 1 );`, full types, `@package IMET\Theme`, `@since`, PSR-4 (namespace = directory).
- Security: escape late, sanitize input, nonce + `current_user_can()` before writes, `$wpdb->prepare()`, a real REST `permission_callback`.
- Quality gates before every commit: `composer phpcs`, `composer phpstan`, `npm run lint:all`, `npm run test:js`.

Note: `IMET_PATH` has **no trailing slash**: write `IMET_PATH . '/assets/...'`.

## 4. WordPress best practice we hold ourselves to

- `theme.json` is the single source; CSS reads `var(--wp--preset--…)` / `var(--wp--custom--…)`. No second palette in SCSS.
- Blocks are registered from `block.json` through the built manifest (`wp-scripts build --blocks-manifest`); assets load **per block, only when the block is on the page**.
- Patterns are plain files in `patterns/` (no registration code). Keep text translatable (`imet-theme`) and escape output.
- Accessibility: semantic landmarks, visible focus (gold ring), `prefers-reduced-motion` honoured in every animation, real `<button>`/`<details>` controls.
- Core Web Vitals: self-hosted fonts, no render-blocking third-party CSS/JS, `loading` hints on images (`Images` module), explicit image sizes, one small shared stylesheet.
- Never edit `vendor/`, `node_modules/` or `assets/build/` by hand.

## 5. Token rules (no magic numbers)

- Sizes, colours, radii, shadows come from `theme.json`. Spacing/radius/size slugs are **pure digits named after pixels**
  (`--wp--preset--spacing--20` = 20px) because WordPress kebab-cases keys (`s28` would become `s-28`).
- The palette slug for body text is `body-text` (`text` collides with core's `has-text-color`).
- Allowed raw values: `0`, `1px` borders, comments, media queries (breakpoints live in `src/css/shared/_breakpoints.scss`), SVG data URIs.
- `npm run lint:tokens` enforces this. The section blocks ported from the old plugin are on a **ratchet**: `bin/audit-tokens-baseline.json`
  holds the allowed count per file and may only go down. After converting values, run `node bin/audit-tokens.js --update-baseline`.
  A line may carry `/* token-ok: reason */` for a genuine one-off.
- New token = add it to `theme.json` first, then use it. An undefined token silently does nothing; the audit catches that.

## 6. Recipes

### Add or change a section block
1. `src/blocks/<name>/` with `block.json` (`name: imet/<name>`, `category: imet`, `style: ["imet-base","file:./style-index.css"]`, `imet: {tagName, className, anchor}`), `index.js`
   (`registerSectionBlock( metadata )`), `style.scss`, optional `view.js`, `default.html`.
2. **Never change `save()` output or `block.json` attributes/supports of an existing block without adding a `deprecated` entry.** Saved pages store the markup.
3. `npm run build:blocks`, then `node bin/verify-blocks.js <page ids>` (every `imet/*` block must be valid).

### Add a pattern
A file in `patterns/` with a header (`Title`, `Slug: imet-theme/<name>`, `Categories: imet-sections`, `Viewport Width`). Images:
`<?php echo esc_url( get_theme_file_uri( 'assets/images/imet/<file>' ) ); ?>`. Tokens only.

### The Home pattern and the advisor form
`patterns/home.php` ("Home (IMET)") is the Home page: `imet/hero` `is-style-home` (badge, H1, lead, button, `.h-grads` cards), `imet/highlights`
`is-style-home` ("Why choose": eyebrow, title, lead, `hl-list hl-pills`, `.hl-form#advisor-form`) and `imet/cost-banner` (the global offer banner).
Its Home styles are tokens only. `[imet_advisor_form]` is rendered by the **imet-core** plugin (`AdvisorForm`); the theme only styles
`.imet-advisor-form` (`src/blocks-shared/_advisor-form.scss`). Changing the form's markup means changing both sides. The form has no nonce
on purpose (page cache would expire it): honeypot + same-origin check + rate limit; leads are stored as private `imet_lead` posts.
Cached pattern list: WordPress keeps a theme's pattern list until the theme `Version` changes, so **bump the version in `style.css` when you add a
pattern** (the deploy also clears it).

### Header, footer, menu and the offer bar
All three are template parts edited in the block editor (**Appearance → Editor → Patterns → Template parts**): `parts/header.html` (logo + the Navigation block with the menu items), `parts/footer.html` (real blocks, copyright year via `[imet_year]`) and `parts/promo-bar.html` ("Offer Bar (global)": edit it once and it changes on every page; it can also be dropped into any page with the Template Part block). Editing in the Site Editor saves a copy in the database that overrides the theme file; use "Clear customizations" to go back to the file. Images in a part use root-relative paths (`/wp-content/themes/imet-theme/assets/...`) because parts are plain HTML.

### Add a block style variation
`styles/blocks/<slug>.json` (the slug is the filename; class `is-style-<slug>`). The `css` field can't hold media queries or comma selectors; put responsive CSS in SCSS.

### Add a feature class
Test in `tests/php/inc/<Path>Test.php`, class in `inc/<Path>.php`, `::class` in `Main::CLASSES`. Use `npx wp-tooling add` (the `/scaffold` skill) for a standard shape.

### Add a design token
Edit `theme.json`, use `var(--wp--preset--…)`, run `npm run lint:tokens`, and note any deliberate exception in `docs/design-system.md`.

## 7. Commands

```bash
npm run build:prod        # assets, then blocks (build:assets cleans assets/build, so blocks must come second)
npm run build:blocks      # blocks only (after build:assets)
npm run lint:all          # css, js, php, package.json, tokens
npm run lint:tokens       # token audit (+ ratchet)
npm run test:js           # Jest (uses a silent reporter: add --reporters=default to see names)
composer phpcs && composer phpstan
node bin/verify-blocks.js [--playwright <path>] [page ids]   # editor validity of imet/* blocks (needs WP-CLI + Playwright)
node bin/shoot.js <dir> <page ids>   &&   node bin/shoot.js --compare <dirA> <dirB>   # visual before/after
node bin/audit-layout.js <page id>      # spacing, gutters, heading sizes, fonts, tap targets at 1440/1024/768/390
wp imet migrate <id> --dry-run       # (imet-core) convert Group sections into imet/* blocks
```

## 8. Checklists

**Before a commit:** phpcs, phpstan, `lint:all`, `test:js` green; new PHP has a test; no raw sizes/colours; `save()` untouched or deprecated;
`node bin/verify-blocks.js` for pages that use the changed blocks; screenshots compared if CSS changed.

**Before a release:** `npm run build:prod` clean; CHANGELOG updated; version bumped (`style.css`, `package.json`); CI green; header/footer parity unchanged.

## 9. Don't

- Don't put presentation (blocks, patterns, styles, front-end JS) in a plugin, and don't put data/CLI/cron/CPTs in the theme.
- Don't change `imet/*` block names or `save()` output without a `deprecated` entry.
- Don't hard-code colours, sizes or radii, and don't add a second token source.
- Don't use `!important` or exclusion selectors (`:not(.x *)`) to fight another layer; fix the layer.
- Don't edit `vendor/`, `assets/build/` or generated files; don't commit secrets.
- Don't skip the quality gates or push with a red check.

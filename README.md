# ImetBlocktheme

Block theme for **IMET Worldwide** (Online Doctorate DBA and Master's MBA pages). It holds the design system, the IMET
section blocks (`imet/*`), the page patterns, the templates and every style. Functionality that must outlive the theme
(FAQ structured data, the migration command) lives in the companion plugin
[`imet-core`](https://github.com/Anupkankale/imet-core).

- **Author:** [Anup Kankale](https://anupkankale.com)
- **Requires:** WordPress 6.6+, PHP 8.2+
- **License:** [GPL-2.0-or-later](LICENSE)
- **Based on:** [rtCamp theme-elementary](https://github.com/rtCamp/theme-elementary) (GPL-2.0-or-later)

## Credits and how this was built

This theme started from rtCamp's open-source starter
[theme-elementary](https://github.com/rtCamp/theme-elementary). The starter provided the build tooling (webpack, Babel),
linting (PHPCS, PHPStan, ESLint, Stylelint), the PHPUnit/Jest scaffolding, the CI workflows (via
`rtCamp/wp-shared-workflows`) and the `inc/` class structure built on `rtcamp/wp-primitives`. Thanks to rtCamp for
publishing it.

Built on top of the starter for IMET:

- The IMET design system in `theme.json` and the 25 `imet/*` section blocks in `src/blocks/`.
- The page patterns: Home, MBA category, Location, DBA course, DBA landing, testimonials, video, 404 and others.
- The Figma match and the phone and tablet layouts.
- A header and footer editable from Menus and the block editor.
- The deploy pipeline (`.github/workflows/deploy.yml`, [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md)).

**AI assistance.** This theme was built with AI coding assistants (Claude Code), and commits made with one say so in a
`Co-Authored-By` trailer. I set the architecture, matched the Figma designs, and reviewed, tested and deployed every
change. `AGENTS.md`, `CLAUDE.md` and `.claude/skills/` are the instructions those assistants work from.

## How it is organised

| Path | What it is |
| --- | --- |
| `theme.json` | Every design token (colours, type, spacing, radius, shadow, widths). The single source. |
| `src/blocks/` | The 25 `imet/*` section blocks (`block.json`, `index.js`, `style.scss`, `view.js`, `default.html`). |
| `src/blocks-shared/` | Shared block code: `registerSectionBlock`, view helpers, the "IMET button" panel, base styles. |
| `src/css/`, `src/js/` | Theme-wide styles and scripts (design system, header, footer, breakpoints). |
| `patterns/` | Page and section patterns (DBA category page, DBA course page, testimonials, video, footer…). |
| `templates/`, `parts/` | Block templates and template parts (header, footer). |
| `styles/blocks/` | Block style variations. |
| `inc/` | PHP (`IMET\Theme\`): `Core/` (assets, menu, setup), `Modules/Blocks`, `Modules/Media`. |
| `assets/images/imet/` | The design's images. |
| `bin/` | `audit-tokens.js`, `verify-blocks.js`, `shoot.js`. |
| `tests/` | PHPUnit (`tests/php`, mirrors `inc/`) and Jest (`tests/js`). |

Architecture, rules and recipes: **[SKILLS.md](SKILLS.md)**. Token table and documented exceptions:
[docs/design-system.md](docs/design-system.md). Deployment: [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md).

## Develop

```bash
npm ci && composer install      # dependencies
npm run build:prod              # assets, then blocks (assets/build is gitignored)
npm run lint:all                # css, js, php, package.json, design tokens
npm run test:js                 # Jest
composer phpcs && composer phpstan
```

## Deploy

`develop` deploys to staging and `main` to production (only when enabled) over SSH. See
[docs/DEPLOYMENT.md](docs/DEPLOYMENT.md).

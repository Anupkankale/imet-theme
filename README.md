# ImetBlocktheme

Block theme for **IMET Worldwide** (Online Doctorate DBA and Master's MBA pages). It holds the design system, the IMET
section blocks (`imet/*`), the page patterns, the templates and every style. Functionality that must outlive the theme
(FAQ structured data, the migration command) lives in the companion plugin
[`imet-core`](https://github.com/Anupkankale/imet-core).

- **Author:** [Anup Kankale](https://anupkankale.com)
- **Requires:** WordPress 6.6+, PHP 8.2+
- **License:** [GPL-2.0-or-later](LICENSE)

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

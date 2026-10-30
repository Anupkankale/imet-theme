# Changelog

All notable changes to this project are documented in this file. The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 1.1.0 - 2026-10-29

### Added

- Pattern **Home (IMET)** (`patterns/home.php`): the Home hero (badge, heading, lead, button, graduate cards), the "Why choose IMET Worldwide?" section with the advisor form, and the fee / scholarship offer banner.
- `[imet_advisor_form]` styles (`src/blocks-shared/_advisor-form.scss`); the form itself ships in the `imet-core` plugin.
- Palette colour `danger` for form errors.

### Changed

- Home styles of `imet/hero` and `imet/highlights` re-skinned to the new Home design (tokens only; saved markup unchanged, so existing pages stay valid but look like the new design).
- Deploys clear WordPress's cached pattern list, so new patterns appear right after a release.
- Home page layout rhythm (`src/blocks-shared/_home-rhythm.scss`, scoped to a page that starts with the Home hero): every content section has the same top and bottom padding (48px desktop, 40px laptop and tablet, 32px phone), one section-title size (35px easing to 26px, semi-bold) and one lead size; the "Why choose IMET" header and card track share one left edge on tablet and phone; the alumni videos form a three-column grid down to 700px; video captions keep one size on every device; the testimonial cards sit 20px from the screen edge like every other section.
- "Top Featured programs" cards scroll: all five cards (AI/ML included) in a row that glides sideways, four in view on desktop, two on tablets, one with a peek on phones, with a 20px gap (16px on tablets and phones) between cards; it pauses on hover, focus and touch, and swiping works. No card is highlighted by default: hovering or focusing a card turns it brand navy.
- The fee banner is centred at every width (it was 20px off at laptop and tablet widths); the advisor form's Submit button and text links are 44px tap targets on touch screens.
- `bin/audit-layout.js`: measures a page at 1440 / 1024 / 768 / 390 px (overflow, section padding, gutters, heading sizes, font usage, tap targets).
- Built block CSS and JS are versioned by file time (they used the fixed `1.0.0` from `block.json`, so the CDN and browsers kept serving old block styles after a deploy).
- "Top Featured Doctorate (DBA) & Masters (MBA) Programs" (`imet/specializations` Home style) rebuilt to the Figma, measured to the pixel on the 1440 frame: "Our Programs" eyebrow, four 271 × 135 cards on a yellow-to-lavender band, navy first card, brand-colour hover and focus, "View More" button. New tokens: gradient `programs` and sizes 44, 65, 88, 135, 255, 1102.


### Changed

- The theme now owns the 25 `imet/*` section blocks, their shared code and styles, the two DBA page patterns and their images (moved from the `imet-blocks` plugin, which is retired). Block names and saved markup are unchanged: the rendered HTML of every page is byte-identical, and every page still opens valid in the editor.
- Section buttons use the theme's button rules (the `.imet-section` exclusion is gone).
- `npm run build:blocks` builds with `--blocks-manifest`; `lint:css` lints only `.css`/`.scss`.
- `.wp-env.json` no longer loads a plugin, which fixes the PHPUnit CI job.

### Added

- `inc/Modules/Blocks` (block registration, default content), `inc/Modules/Media` (image loading hints, YouTube thumbnails).
- `SKILLS.md` and the `imet-theme` Claude skill: architecture, rules and recipes.
- `bin/verify-blocks.js` (editor validity of `imet/*` blocks), `bin/shoot.js` (before/after screenshots) and a token ratchet (`bin/audit-tokens-baseline.json`).
- Companion plugin `imet-core` (FAQ schema, `wp imet migrate`).

## 1.0.0

First IMET release: the design system in `theme.json`, the IMET section blocks, the DBA page patterns, header, footer and templates.

# Changelog

All notable changes to this project are documented in this file. The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

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

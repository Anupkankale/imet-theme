# Graph Report - imet-theme  (2026-11-13)

## Corpus Check
- cluster-only mode — file stats not available

## Summary
- 2265 nodes · 2913 edges · 203 communities (108 shown, 95 thin omitted)
- Extraction: 97% EXTRACTED · 3% INFERRED · 0% AMBIGUOUS · INFERRED: 85 edges (avg confidence: 0.87)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `545d3779`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- fontSize
- composer.json
- webpack.config.js
- button-panel.js
- scripts
- rtlcss
- settings
- Development guide
- LinkPhotoSectionsTest
- SplitTestimonials
- AssetsHmrTest
- Assets
- Util
- view-helpers.js
- text
- FeatureRegistry
- Live reload and block refresh
- AbstractThemeFeatureTest.php
- Main
- SyncedSections
- install.sh script
- Asset Building Process
- padding
- blocks
- subnav/index.js
- typography
- getPluginName
- Templates
- align
- size
- imet
- BlocksTest
- devDependencies
- index.md
- imet
- ref_fs
- alumni-video/block.json
- faq/block.json
- testimonials/block.json
- hero/block.json
- graphify install scripts
- webpack.blocks.config.js
- Getting started
- LoggerTest
- ThemeSetup
- supports
- section/block.json
- .stylelintrc.json
- specializations/block.json
- step-cards/block.json
- getCopyPlugin
- browserslist@4.29.3
- dotenv@18.0.4
- @wordpress/babel-preset-default
- @rtcamp/eslint-config
- tabs/block.json
- who-can-join/block.json
- eslint@10.11.0
- uninstall.sh
- career-table/block.json
- cta/block.json
- package.json
- browser-sync-webpack-plugin
- certificate/block.json
- highlights/block.json
- subnav/block.json
- shared/README.md
- eslint-import-resolver-typescript@4.4.5
- about-card/block.json
- dba-vs-phd/block.json
- float-contact/block.json
- process/block.json
- usp-bento/block.json
- button
- group-spec-card.json
- quote-testimonial.json
- overrides
- repository
- globals@17.6.0
- achievements/block.json
- cost-banner/block.json
- overview/block.json
- group-band-navy.json
- group-card.json
- cyber-banner/block.json
- SinglePostTest
- AuthorProfile
- MenuRenderer
- analytics/block.json
- embassy/block.json
- jest-environment-jsdom@30.5.2
- jest-silent-reporter@0.6.0
- npm-run-all@4.1.5
- @rtcamp/stylelint-config@^1.1.0
- AGENTS.md — ImetBlocktheme
- @rtcamp/wp-tooling@^2.0.0
- TestCase
- paragraph-section-sub.json
- button
- custom
- SuccessStories
- Video
- section-block.js
- heading-eyebrow.json
- paragraph-eyebrow.json
- svgo
- ShortcodeBlock
- embed-video-frame.json
- group-band-gradient.json
- webpack-remove-empty-scripts
- Knowledge graph
- webpack-config.test.js
- button-gold.json
- button-light.json
- button-link.json
- button-outline.json
- button-outline-light.json
- button-white.json
- image-video-thumb.json
- @wordpress/browserslist-config@6.56.0
- Menu
- @wordpress/env@11.16.0
- @wordpress/eslint-plugin@27.0.0
- CleanBuildPlugin
- CssAssetMetadataPlugin
- CssAssetRtlPlugin
- Deployment: GitHub → Hostinger
- rtCamp\WPPrimitives\Contracts\Interfaces\Registrable
- group-scroller.json
- group-testimonial-grid.json
- group-video-gallery.json
- SKILLS.md: how the IMET theme is built
- 6. Recipes
- eyebrow
- header
- IMET design system
- Contributing to ImetBlocktheme
- table-compare.json
- lineHeight
- ImetBlocktheme
- borderWidth
- scroller
- spacing
- ImetBlocktheme
- Tailwind CSS
- supports
- footer-accordion.js
- header-scroll.js

## God Nodes (most connected - your core abstractions)
1. `TestCase` - 49 edges
2. `size` - 47 edges
3. `scripts` - 35 edges
4. `Assets` - 31 edges
5. `registerSectionBlock()` - 30 edges
6. `SyncedSections` - 26 edges
7. `Video` - 24 edges
8. `AssetsEnqueueTest` - 20 edges
9. `MenuRenderer` - 17 edges
10. `FeatureRegistry` - 16 edges

## Surprising Connections (you probably didn't know these)
- `Key principles (full detail in the files above)` --references--> `Main`  [INFERRED]
  AGENTS.md → inc/Main.php
- `3. rtCamp rules to follow (details in AGENTS.md)` --references--> `Main`  [INFERRED]
  SKILLS.md → inc/Main.php
- `Adding a new class` --references--> `TestCase`  [INFERRED]
  DEVELOPMENT.md → tests/php/TestCase.php
- `How it is organised` --references--> `registerSectionBlock()`  [INFERRED]
  README.md → src/blocks-shared/section-block.js
- `Structure` --references--> `Assets`  [INFERRED]
  AGENTS.md → inc/Core/Assets.php

## Import Cycles
- None detected.

## Communities (203 total, 95 thin omitted)

### Community 0 - "fontSize"
Cohesion: 0.14
Nodes (23): core/post-navigation-link, core/query-pagination, core/site-title, elements, typography, typography, typography, h1 (+15 more)

### Community 1 - "composer.json"
Cohesion: 0.05
Nodes (43): dealerdirect/phpcodesniffer-composer-installer, phpstan/extension-installer, authors, autoload, autoload-dev, psr-4, psr-4, config (+35 more)

### Community 2 - "webpack.config.js"
Cohesion: 0.06
Nodes (29): ASSETS_BUILD_DIR, BROWSER_SYNC_FILES, bsPort, COMPONENTS_DIR, componentScripts, componentStyles, configs, CONTEXT_DIRS (+21 more)

### Community 3 - "button-panel.js"
Cohesion: 0.10
Nodes (11): ALIASES, COLOURS, current(), SIZES, tokens(), withButtonPanel, withClass(), PlaceholderCheck() (+3 more)

### Community 4 - "scripts"
Cohesion: 0.06
Nodes (35): scripts, build:assets, build:assets:dev, build:blocks, build:blocks:dev, build:dev, build:prod, init (+27 more)

### Community 6 - "settings"
Cohesion: 0.05
Nodes (37): custom, customDuotone, customGradient, defaultDuotone, defaultGradients, defaultPalette, duotone, gradients (+29 more)

### Community 7 - "Development guide"
Cohesion: 0.29
Nodes (7): Adding a new class, Before adding code, Conditional registration, Content that outlives the theme, Development guide, Picking a base, Troubleshooting

### Community 11 - "Assets"
Cohesion: 0.07
Nodes (4): Assets, AssetsEnqueueTest, AssetsTailwindTest, AssetsTest

### Community 13 - "view-helpers.js"
Cohesion: 0.11
Nodes (15): @wordpress/i18n@6.29.0, @wordpress/i18n, animate(), io, load(), play(), FLAGS, accordion() (+7 more)

### Community 14 - "text"
Cohesion: 0.18
Nodes (15): color, color, :visited, color, typography, background, text, caption (+7 more)

### Community 16 - "Live reload and block refresh"
Cohesion: 0.12
Nodes (17): Advanced, Block dev server port, Blocks (`start:blocks` + Fast Refresh), Configuration, Disabling the BrowserSync client only, Enabling / disabling HMR, How It Works, HTTPS (+9 more)

### Community 18 - "Main"
Cohesion: 0.14
Nodes (3): Components, Main, MainTest

### Community 20 - "install.sh script"
Cohesion: 0.27
Nodes (14): err(), install_pip(), install_pipx(), install_uv(), log(), resolve_method(), install.sh script, have() (+6 more)

### Community 21 - "Asset Building Process"
Cohesion: 0.18
Nodes (12): Adding a New Module, Adding a New Script, Adding New Scripts or Modules, Asset Building Process, Avoid Bundling Specific Files, Components and blocks, Directory Structure, How to Exclude Files (+4 more)

### Community 22 - "padding"
Cohesion: 0.13
Nodes (15): core/post-comments, core/pullquote, core/quote, spacing, typography, border, spacing, border (+7 more)

### Community 23 - "blocks"
Cohesion: 0.18
Nodes (13): core/buttons, core/navigation, core/post-content, core/separator, spacing, typography, spacing, color (+5 more)

### Community 24 - "subnav/index.js"
Cohesion: 0.33
Nodes (4): default, type, attributes, align

### Community 25 - "typography"
Cohesion: 0.22
Nodes (11): typography, typography, heading, color, typography, typography, typography, fontFamily (+3 more)

### Community 26 - "getPluginName"
Cohesion: 0.33
Nodes (6): getPluginName(), isNotOneOfPlugins(), isNotPlugin(), isPlugin(), setCssOutputPath(), withoutFastRefresh()

### Community 28 - "align"
Cohesion: 0.50
Nodes (4): default, type, attributes, align

### Community 29 - "size"
Cohesion: 0.04
Nodes (47): size, 1012, 102, 103, 110, 1102, 1186, 12-5 (+39 more)

### Community 30 - "imet"
Cohesion: 0.50
Nodes (4): imet, anchor, className, tagName

### Community 31 - "BlocksTest"
Cohesion: 0.11
Nodes (3): Blocks, Defaults, BlocksTest

### Community 32 - "devDependencies"
Cohesion: 0.11
Nodes (19): devDependencies, @babel/core@7.29.7, browser-sync@3.0.4, css-minimizer-webpack-plugin@8.0.0, @eslint-community/eslint-plugin-eslint-comments@4.8.1, eslint-plugin-jest@29.16.6, eslint-plugin-react-hooks@7.1.1, jest@30.5.2 (+11 more)

### Community 34 - "imet"
Cohesion: 0.50
Nodes (4): imet, anchor, className, tagName

### Community 35 - "ref_fs"
Cohesion: 0.25
Nodes (4): fs, path, { spawnSync }, wrapper

### Community 36 - "alumni-video/block.json"
Cohesion: 0.07
Nodes (26): default, type, apiVersion, attributes, align, category, description, editorScript (+18 more)

### Community 37 - "faq/block.json"
Cohesion: 0.07
Nodes (26): default, type, apiVersion, attributes, align, category, description, editorScript (+18 more)

### Community 38 - "testimonials/block.json"
Cohesion: 0.07
Nodes (26): default, type, apiVersion, attributes, align, category, description, editorScript (+18 more)

### Community 39 - "hero/block.json"
Cohesion: 0.07
Nodes (26): default, type, apiVersion, attributes, align, category, description, editorScript (+18 more)

### Community 40 - "graphify install scripts"
Cohesion: 0.25
Nodes (8): After installing, Files, graphify install scripts, macOS / Linux, Manual install (no scripts), Quick start, What the installer does, Windows (PowerShell)

### Community 41 - "webpack.blocks.config.js"
Cohesion: 0.20
Nodes (8): copy-webpack-plugin@14.0.0, @wordpress/scripts@36.0.0, copy-webpack-plugin, @wordpress/scripts, config, CopyWebpackPlugin, devServerPort, withImetBlocks()

### Community 42 - "Getting started"
Cohesion: 0.33
Nodes (6): 1. Get the theme, 2. Install dependencies, 3. Start WordPress and activate the theme, 4. Make a visible edit, Getting started, Prerequisites

### Community 45 - "supports"
Cohesion: 0.50
Nodes (4): supports, align, anchor, html

### Community 46 - "section/block.json"
Cohesion: 0.07
Nodes (26): default, type, apiVersion, attributes, align, category, description, editorScript (+18 more)

### Community 47 - ".stylelintrc.json"
Cohesion: 0.29
Nodes (6): extends, ignoreFiles, @rtcamp/stylelint-config, overrides, rules, scss/at-rule-no-unknown

### Community 48 - "specializations/block.json"
Cohesion: 0.07
Nodes (26): default, type, apiVersion, attributes, align, category, description, editorScript (+18 more)

### Community 49 - "step-cards/block.json"
Cohesion: 0.07
Nodes (26): default, type, apiVersion, attributes, align, category, description, editorScript (+18 more)

### Community 50 - "getCopyPlugin"
Cohesion: 0.67
Nodes (3): CopyWebpackPlugin, getCopyPlugin(), rootPath()

### Community 53 - "@wordpress/babel-preset-default"
Cohesion: 0.50
Nodes (3): defaultConfig, @wordpress/babel-preset-default@8.56.0, @wordpress/babel-preset-default

### Community 58 - "tabs/block.json"
Cohesion: 0.07
Nodes (26): default, type, apiVersion, attributes, align, category, description, editorScript (+18 more)

### Community 59 - "who-can-join/block.json"
Cohesion: 0.07
Nodes (26): default, type, apiVersion, attributes, align, category, description, editorScript (+18 more)

### Community 61 - "uninstall.sh"
Cohesion: 0.83
Nodes (3): have(), log(), uninstall.sh script

### Community 62 - "career-table/block.json"
Cohesion: 0.07
Nodes (25): default, type, apiVersion, attributes, align, category, description, editorScript (+17 more)

### Community 63 - "cta/block.json"
Cohesion: 0.07
Nodes (25): default, type, apiVersion, attributes, align, category, description, editorScript (+17 more)

### Community 64 - "package.json"
Cohesion: 0.13
Nodes (15): author, bugs, url, dependencies, @wordpress/interactivity@6.56.0, description, engines, node (+7 more)

### Community 65 - "browser-sync-webpack-plugin"
Cohesion: 0.67
Nodes (3): browser-sync-webpack-plugin@2.4.0, browser-sync-webpack-plugin, getBrowserSyncPlugins()

### Community 68 - "certificate/block.json"
Cohesion: 0.07
Nodes (25): default, type, apiVersion, attributes, align, category, description, editorScript (+17 more)

### Community 70 - "highlights/block.json"
Cohesion: 0.07
Nodes (25): default, type, apiVersion, attributes, align, category, description, editorScript (+17 more)

### Community 71 - "subnav/block.json"
Cohesion: 0.14
Nodes (13): apiVersion, category, description, editorScript, icon, keywords, name, $schema (+5 more)

### Community 75 - "about-card/block.json"
Cohesion: 0.08
Nodes (24): default, type, apiVersion, attributes, align, category, description, editorScript (+16 more)

### Community 76 - "dba-vs-phd/block.json"
Cohesion: 0.08
Nodes (24): default, type, apiVersion, attributes, align, category, description, editorScript (+16 more)

### Community 77 - "float-contact/block.json"
Cohesion: 0.08
Nodes (24): default, type, apiVersion, attributes, align, category, description, editorScript (+16 more)

### Community 78 - "process/block.json"
Cohesion: 0.08
Nodes (24): default, type, apiVersion, attributes, align, category, description, editorScript (+16 more)

### Community 81 - "usp-bento/block.json"
Cohesion: 0.08
Nodes (24): default, type, apiVersion, attributes, align, category, description, editorScript (+16 more)

### Community 82 - "button"
Cohesion: 0.07
Nodes (27): large, largeMobile, medium, mediumMobile, radius, small, smallMobile, weight (+19 more)

### Community 83 - "group-spec-card.json"
Cohesion: 0.09
Nodes (22): blockTypes, radius, background, text, bottom, left, right, top (+14 more)

### Community 84 - "quote-testimonial.json"
Cohesion: 0.09
Nodes (22): blockTypes, radius, width, gradient, text, bottom, left, right (+14 more)

### Community 85 - "overrides"
Cohesion: 0.17
Nodes (12): serialize-javascript, qs, js-yaml, overrides, copy-webpack-plugin, express, markdownlint-cli, sockjs (+4 more)

### Community 86 - "repository"
Cohesion: 0.67
Nodes (3): repository, type, url

### Community 88 - "achievements/block.json"
Cohesion: 0.10
Nodes (20): apiVersion, category, description, editorScript, icon, imet, anchor, className (+12 more)

### Community 89 - "cost-banner/block.json"
Cohesion: 0.10
Nodes (20): apiVersion, category, description, editorScript, icon, imet, anchor, className (+12 more)

### Community 90 - "overview/block.json"
Cohesion: 0.07
Nodes (26): default, type, apiVersion, attributes, align, category, description, editorScript (+18 more)

### Community 91 - "group-band-navy.json"
Cohesion: 0.10
Nodes (20): blockTypes, radius, background, text, heading, color, bottom, left (+12 more)

### Community 92 - "group-card.json"
Cohesion: 0.10
Nodes (20): blockTypes, color, radius, style, width, background, bottom, left (+12 more)

### Community 93 - "cyber-banner/block.json"
Cohesion: 0.12
Nodes (15): apiVersion, category, description, editorScript, icon, keywords, name, $schema (+7 more)

### Community 95 - "AuthorProfile"
Cohesion: 0.21
Nodes (3): AuthorProfile, AuthorProfileTest, TestCase

### Community 96 - "MenuRenderer"
Cohesion: 0.05
Nodes (10): DefaultMenus, MenuRenderer, MenuSeeder, NavWalker, LineBreaks, Menu links (header and footer), MenuRendererTest, MenuSeederTest (+2 more)

### Community 97 - "analytics/block.json"
Cohesion: 0.12
Nodes (16): apiVersion, category, description, editorScript, icon, imet, anchor, className (+8 more)

### Community 98 - "embassy/block.json"
Cohesion: 0.07
Nodes (26): default, type, apiVersion, attributes, align, category, description, editorScript (+18 more)

### Community 103 - "AGENTS.md — ImetBlocktheme"
Cohesion: 0.22
Nodes (7): AGENTS.md — ImetBlocktheme, AI tooling, Authoritative rules, Guardrails (all AI tools) - BASE, non-negotiable, Key principles (full detail in the files above), Knowledge graph (graphify), Structure

### Community 106 - "paragraph-section-sub.json"
Cohesion: 0.12
Nodes (15): blockTypes, text, bottom, $schema, slug, margin, styles, color (+7 more)

### Community 107 - "button"
Cohesion: 0.17
Nodes (16): border, color, defaultRadiusSizes, radius, radiusSizes, style, width, :active (+8 more)

### Community 108 - "custom"
Cohesion: 0.12
Nodes (16): gradient, letterSpacing, motion, radius, section, hero, programs, specs (+8 more)

### Community 110 - "Video"
Cohesion: 0.10
Nodes (4): Images, Video, 4. WordPress best practice we hold ourselves to, MediaTest

### Community 112 - "heading-eyebrow.json"
Cohesion: 0.14
Nodes (13): blockTypes, text, $schema, slug, styles, color, typography, title (+5 more)

### Community 113 - "paragraph-eyebrow.json"
Cohesion: 0.14
Nodes (13): blockTypes, text, $schema, slug, styles, color, typography, title (+5 more)

### Community 116 - "embed-video-frame.json"
Cohesion: 0.15
Nodes (12): blockTypes, color, radius, style, width, $schema, slug, styles (+4 more)

### Community 117 - "group-band-gradient.json"
Cohesion: 0.15
Nodes (12): blockTypes, gradient, bottom, top, $schema, slug, padding, styles (+4 more)

### Community 119 - "Knowledge graph"
Cohesion: 0.20
Nodes (7): Knowledge graph (Graphify), Rules for using the graph, Install (one time), Knowledge graph, Optional: semantic layer, Refresh locally, Use the graph

### Community 120 - "webpack-config.test.js"
Cohesion: 0.25
Nodes (5): fs, os, path, getComponentEntries(), toPort()

### Community 121 - "button-gold.json"
Cohesion: 0.17
Nodes (11): blockTypes, color, background, text, $schema, slug, styles, border (+3 more)

### Community 122 - "button-light.json"
Cohesion: 0.17
Nodes (11): blockTypes, color, background, text, $schema, slug, styles, border (+3 more)

### Community 123 - "button-link.json"
Cohesion: 0.17
Nodes (11): blockTypes, color, background, text, $schema, slug, styles, border (+3 more)

### Community 124 - "button-outline.json"
Cohesion: 0.17
Nodes (11): blockTypes, color, background, text, $schema, slug, styles, border (+3 more)

### Community 125 - "button-outline-light.json"
Cohesion: 0.17
Nodes (11): blockTypes, color, background, text, $schema, slug, styles, border (+3 more)

### Community 126 - "button-white.json"
Cohesion: 0.17
Nodes (11): blockTypes, color, background, text, $schema, slug, styles, border (+3 more)

### Community 127 - "image-video-thumb.json"
Cohesion: 0.17
Nodes (11): blockTypes, color, radius, style, width, $schema, slug, styles (+3 more)

### Community 129 - "Menu"
Cohesion: 0.14
Nodes (9): Automatic frontend reload, Build for delivery, Check a change, Edit source and see the result, Local development, Start and stop WordPress, Troubleshooting, Menu (+1 more)

### Community 136 - "Deployment: GitHub → Hostinger"
Cohesion: 0.22
Nodes (9): a. Hostinger: turn on SSH, b. Laptop: create a dedicated deploy key, c. Test the login and collect the values, d. Where staging lives, Deployment: GitHub → Hostinger, e. GitHub setup (per repository), f. First deploy, g. Rollback (+1 more)

### Community 140 - "group-scroller.json"
Cohesion: 0.22
Nodes (8): blockTypes, $schema, slug, blockGap, styles, spacing, title, version

### Community 141 - "group-testimonial-grid.json"
Cohesion: 0.22
Nodes (8): blockTypes, $schema, slug, blockGap, styles, spacing, title, version

### Community 142 - "group-video-gallery.json"
Cohesion: 0.22
Nodes (8): blockTypes, $schema, slug, blockGap, styles, spacing, title, version

### Community 147 - "SKILLS.md: how the IMET theme is built"
Cohesion: 0.25
Nodes (8): 1. The one rule: the theme owns presentation, 2. Folder map, 3. rtCamp rules to follow (details in AGENTS.md), 5. Token rules (no magic numbers), 7. Commands, 8. Checklists, 9. Don't, SKILLS.md: how the IMET theme is built

### Community 148 - "6. Recipes"
Cohesion: 0.25
Nodes (8): 6. Recipes, Add a block style variation, Add a design token, Add a feature class, Add a pattern, Add or change a section block, Header, footer, menu and the offer bar, The Home pattern and the advisor form

### Community 150 - "eyebrow"
Cohesion: 0.25
Nodes (8): eyebrow, color, fontFamily, fontSize, fontSizeMobile, fontWeight, gap, lineHeight

### Community 151 - "header"
Cohesion: 0.25
Nodes (8): header, clearance, clearancePhone, mainClearance, navOffset, pillHeight, pillWidth, promoHeight

### Community 152 - "IMET design system"
Cohesion: 0.29
Nodes (7): Block styles, Changing a token, Deliberate exceptions, Home pattern, IMET design system, Scales (mirror `base.scss`), Tokens only (no magic numbers)

### Community 154 - "Contributing to ImetBlocktheme"
Cohesion: 0.33
Nodes (6): Before you open a PR, Building assets, Contributing to ImetBlocktheme, Development setup, License, Pull request checklist

### Community 155 - "table-compare.json"
Cohesion: 0.33
Nodes (5): blockTypes, $schema, slug, title, version

### Community 156 - "lineHeight"
Cohesion: 0.33
Nodes (6): lineHeight, 18, 21, 22-4, 28, 35

### Community 159 - "ImetBlocktheme"
Cohesion: 0.40
Nodes (5): Credits and how this was built, Deploy, Develop, How it is organised, ImetBlocktheme

### Community 160 - "borderWidth"
Cohesion: 0.40
Nodes (5): 0, 3, 4, 9, borderWidth

### Community 161 - "scroller"
Cohesion: 0.40
Nodes (5): scroller, gap, gapMobile, perView, perViewMobile

### Community 162 - "spacing"
Cohesion: 0.40
Nodes (5): spacing, large, medium, outer, small

### Community 164 - "ImetBlocktheme"
Cohesion: 0.50
Nodes (4): Command reference, Further reading, ImetBlocktheme, Shared dependencies

### Community 165 - "Tailwind CSS"
Cohesion: 0.50
Nodes (4): Setup, Tailwind CSS, Verify a change, What to edit

### Community 168 - "supports"
Cohesion: 0.50
Nodes (4): supports, align, anchor, html

## Knowledge Gaps
- **1 isolated node(s):** `@rtcamp/stylelint-config`
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 1252 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **95 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `registerSectionBlock()` connect `section-block.js` to `subnav/index.js`, `ImetBlocktheme`, `alumni-video/block.json`, `faq/block.json`, `testimonials/block.json`, `hero/block.json`, `section/block.json`, `specializations/block.json`, `step-cards/block.json`, `tabs/block.json`, `who-can-join/block.json`, `career-table/block.json`, `cta/block.json`, `certificate/block.json`, `highlights/block.json`, `about-card/block.json`, `dba-vs-phd/block.json`, `float-contact/block.json`, `process/block.json`, `usp-bento/block.json`, `overview/block.json`, `embassy/block.json`?**
  _High betweenness centrality (0.205) - this node is a cross-community bridge._
- **What connects `@rtcamp/stylelint-config` to the rest of the system?**
  _1 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `fontSize` be split into smaller, more focused modules?**
  _Cohesion score 0.1422924901185771 - nodes in this community are weakly interconnected._
- **Why does `ImetBlocktheme` connect `ImetBlocktheme` to `index.md`?**
  _High betweenness centrality (0.173) - this node is a cross-community bridge._
- **Should `composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.045454545454545456 - nodes in this community are weakly interconnected._
- **Why does `How it is organised` connect `ImetBlocktheme` to `section-block.js`?**
  _High betweenness centrality (0.168) - this node is a cross-community bridge._
- **Should `webpack.config.js` be split into smaller, more focused modules?**
  _Cohesion score 0.06451612903225806 - nodes in this community are weakly interconnected._
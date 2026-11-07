# Changelog

All notable changes to this project are documented in this file. The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 1.1.5 - 2026-11-07

### Added

- **Shared sections are synced patterns: fix once, shown everywhere.** Offer Banner, Clients Testimonials, CTA: Step Into Your Next Chapter, Our Achievements and Career Table live in WordPress (Patterns > My patterns). The first time an administrator opens wp-admin, the theme creates each one from its hidden source pattern (`SyncedSections`); after that the team owns them and theme updates never overwrite or duplicate them. The Home, DBA Category, DBA Course, MBA and Location page patterns place them by reference. Pages saved earlier keep their own copies until each copy is swapped for the synced pattern once.

### Removed

- The seven IMET page templates from 1.1.4. A page on one of them ignored what the team wrote in the page; synced patterns share sections without that. No live page used them.

## 1.1.4 - 2026-11-07

### Added

- **Auto-updating page templates**: IMET: Home, IMET: DBA Category, IMET: DBA Course, IMET: MBA Category, IMET: Location, IMET: Alumni and IMET: Blog (Page → Template in the editor). A page that uses one shows its page pattern straight from the theme on every visit, so every theme update reaches it with no editor step; the page's own saved content is not shown. Pick the template once per page. Editing the template in the Site Editor saves a copy that stops the updates until "Clear customizations".
- Shortcode blocks run their shortcode wherever they render (`ShortcodeBlock`), so the advisor form also appears inside a pattern shown by a template.
- The page spacing, header clearance and content styles that looked for the page content now also apply to the templates' content area (`.imet-page-content`).

## 1.1.3 - 2026-11-06

### Added

- **Blog Page** pattern (`imet-theme/blog-page`), also used by the posts page template (`templates/home.html`): a hero with breadcrumbs and a "Read Latest Article" button (the newest post), the six newest articles of the Doctorate (`doctorate-blogs`) and MBA (`mba`) categories under two tabs with View More to each category, short card excerpts, and a sidebar with the advisor form, article search and the tag cloud. The categories are found by slug, so it works on any site that has them; without one, its tab lists every article. The hero photo is an Image block (swap it in the editor).

## 1.1.2 - 2026-11-06

### Added

- **Alumni Page** pattern (`imet-theme/alumni-page`): a navy hero with three graduate portraits and laurel stats; alumni podcasts (played in place after the YouTube consent notice) and success stories, filtered by topic chips (Doctorate Journey, Leadership Insights, Life After Doctorate); a sidebar with the advisor form, program links and community stats that stays in view on desktop; "More Ways to Explore" link cards; and a closing "Join a Community of Change-Makers" banner. Styles in `src/blocks-shared/_alumni-page.scss`, behaviour in the blank section block's `view.js`.
- The YouTube consent notice styles moved from the video gallery block to the shared base (`_video-consent.scss`), so any block that plays a video can use them.

## 1.1.1 - 2026-11-06

### Changed

- Eyebrow labels look the same on every page: their font, size (18px, 16px on phones), weight, colour and the 4px gap to the heading come from theme.json (`settings.custom.eyebrow`), used by both the `.eyebrow-line` class and the editor's **Eyebrow** block style. The per-page and per-section eyebrow overrides are gone.
- DBA Course Page: the Program Highlights chips ("AI Ethics & Security", "+30% Salary Growth Potential") are real text over a plain photo instead of being part of the image.
- "What Our Clients Say" is one pattern, **Clients Testimonials** (`imet-theme/clients-testimonials`), used by the Home, DBA Category, DBA Course and MBA page patterns, and insertable on its own from the IMET sections. Existing pages keep their saved copy until the pattern is inserted.

## 1.1.0 - 2026-10-29

### Added

- Removed 10 theme images that nothing used (alumni-video, avatar-1..3, bento-clock, bento-flex, bento-mentor, certificate, join-photo, video-thumb) and the "Verify Accreditations & Global Standing" button, which is not in the Home Figma.
- Home page matched to the new Home Figma (file 4): the "Internationally Validated" row shows the six embassy emblems with captions (UAE, Bahrain, United States, Qatar, New Zealand, Singapore), the "Why choose" header is centred with Personalized Research Guidance first, the alumni videos use the main-video-plus-thumbnails gallery under "What Our Clients Say", the hero lead and photo cards fill the 1186px row, and the publish banner and world map are wider. Existing pages keep their old blocks until the **Home (IMET)** pattern is inserted again.
- The header hides when scrolling down and returns on any scroll up (`header-scroll.js`); it stays visible near the top, while a menu is open and while focus is inside it, and respects reduced motion. Also fixes the header's sticky offset, which was an invalid `calc()` without an admin bar (so the header never stuck for visitors).
- Menus are managed in **Appearance > Menus**: six locations (Header menu, and the five footer link columns) with starting menus created from the original links the first time an administrator opens wp-admin (`MenuSeeder`, never replaces an assigned menu). The header Navigation block and the footer lists carry an `imet-menu-<location>` class and print the assigned menu (`MenuRenderer`, `NavWalker` keeps the core Navigation markup, dropdowns and mobile overlay); with no menu assigned they print as saved. The same menus are available over the REST API (`/wp/v2/menus`, `/menu-items`, `/menu-locations`). Footer text, contact blocks and the offer bar stay editable in the Site Editor.
- The gold underline below section eyebrow labels is removed on every page (the `::after` line under `.eyebrow-line` and `.alumni-eyebrow`).
- Phone spacing on every page: one 32px room above and below each content section (course, MBA, location and landing pages were 48px or mixed), one header-to-content gap, one gap for stacked cards, highlight lists share one text size and gap, more room above the fee banner heading.
- Location Page: the "Institutional Recognition & Credential Evaluation" card now sits under the dark hero, overlapping its bottom edge as in the Figma.
- Phone and tablet consistency on every page: section titles share one weight (600) and size, eyebrows one weight, forced line breaks in headings and lead text no longer leave a lone word (new `LineBreaks` module marks them, CSS hides them on phones), FAQ rows and "View More" links are 44px tall, and the "Publish your research" banner is centred. New `_responsive.scss`.
- New pattern **Location Page** (`imet-theme/location-page`): the DBA city/country page from the Figma, built from existing blocks plus four opt-in variants: FAQ card (`is-card`), pale achievements (`is-light`), navy About band (`is-band`) and an edge-to-edge publish banner (`is-wide`). Replace `[City]` in the heading with the place. New image `loc-highlights.jpg`.
- MBA Category Page matched closer to the Figma: six specialization cards in one row (`is-style-six`), the overview section as one photo (`is-visual`), a narrower four-column table, the real Highlights and Qatar-logo images, a compact advisor form, two alumni thumbnails without on-image captions, semi-bold eyebrows (scope class `is-style-mba` on the hero).
- New pattern **MBA Category Page** (`imet-theme/mba-category-page`): the Online Master's (MBA) category page from the Figma, built entirely from existing blocks (hero, subnav, highlights, specializations, cost banner, overview, achievements, who-can-join, embassy, career table, analytics, alumni video, cyber banner, testimonials, certificate, FAQ, CTA). The career table gets a four-column variant (`is-four`). New images `mba-usp.jpg`, `mba-certificate.jpg`.
- Pattern **Home (IMET)** (`patterns/home.php`): the Home hero (badge, heading, lead, button, graduate cards), the "Why choose IMET Worldwide?" section with the advisor form, and the fee / scholarship offer banner.
- `[imet_advisor_form]` styles (`src/blocks-shared/_advisor-form.scss`); the form itself ships in the `imet-core` plugin.
- Palette colour `danger` for form errors.

### Changed

- Home styles of `imet/hero` and `imet/highlights` re-skinned to the new Home design (tokens only; saved markup unchanged, so existing pages stay valid but look like the new design).
- Deploys clear WordPress's cached pattern list, so new patterns appear right after a release.
- Home page layout rhythm (`src/blocks-shared/_home-rhythm.scss`, scoped to a page that starts with the Home hero): every content section has the same top and bottom padding (48px desktop, 40px laptop and tablet, 32px phone), one section-title size (35px easing to 26px, semi-bold) and one lead size; the "Why choose IMET" header and card track share one left edge on tablet and phone; the alumni videos form a three-column grid down to 700px; video captions keep one size on every device; the testimonial cards sit 20px from the screen edge like every other section.
- "Top Featured programs" cards scroll: all five cards (AI/ML included) in a row that glides sideways, four in view on desktop, two on tablets, one with a peek on phones, with a 20px gap (16px on tablets and phones) between cards; it pauses on hover, focus and touch, and swiping works. No card is highlighted by default: hovering or focusing a card turns it brand navy.
- Less empty space under the advisor form: the "Why choose" section's bottom padding is 24px (was 54px), so the form sits about 38px above the fee banner's ribbon as in the Figma, and the banner hands over to the next section's own padding (about 50px instead of 68px); stacked on tablets and phones the gap is 40px.
- Scrolling card rows (hero graduates, programs, logos, testimonials) no longer show a repeated card: the loop copies the helper adds are hidden while the cards fit in the row and only appear while it scrolls (`is-static`).
- "Our Success Stories" redesigned to the Figma: eyebrow, title and lead, then four pastel portrait cards (new photos `home-success-1…4.jpg`, cropped from the Figma) that flip on hover or keyboard focus to a navy back with the story, the LinkedIn link and "Read More"; a tap flips them on touch screens. Two columns on tablets, one on phones.
- Header, footer and the top offer bar are all edited in the block editor (Appearance → Editor → Patterns → Template parts): the offer bar ("Refer a Friend… earn up to $500") is its own global part, **Offer Bar (global)** (`parts/promo-bar.html`), used by the header and insertable anywhere with the Template Part block; the footer (`parts/footer.html`) is real blocks (lists, accordions, images, social links) instead of a locked pattern, and the old `imet-theme/footer` pattern is gone; the menu is the header's Navigation block (25 editable items). The front end is pixel-identical. `[imet_year]` keeps the footer's copyright year current.
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

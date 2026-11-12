# Changelog

All notable changes to this project are documented in this file. The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 1.1.36 - 2026-11-12

### Added

- Success Stories page (pattern "Success Stories Page", IMET: Full Pages), from the design: hero with the convocation photo under the blog's gradient wash and "Read Latest Article"; story cards (posts in the "Success Stories" category, every post until that category exists) with the author in gold ("by: …"), beside the sticky advisor form; a "Related Programs" band with links to the DBA and MBA programs; three more stories and View More; a "Case Studies of our Alumni" box with three alumni cards (photos cropped from the design, `ss-case-1..3.webp`). Built on the Blog page's layout (`_success-stories.scss` adds only the new parts).

## 1.1.35 - 2026-11-12

### Fixed

- DBA Course page (live): the Program Highlights picture was broken. The page was saved before 1.0.x replaced `course-highlights-v3.webp` with a photo plus text chips, and still points at the old file, which had been deleted; the file is back in the theme, so pages saved earlier show it again.

## 1.1.34 - 2026-11-12

### Changed

- About Us, Main USP: the cards are one row that glides sideways and loops (three in view on desktop, two on tablets, one and a bit on phones; hover, focus or touch pauses it), with a fourth card, "17 years institute", as in the Figma. The editor keeps the grid.
- About Us hero: the new graduates picture with the "18+" circle built in (`about-hero-avatars-18.webp`, from the design); the separate 18+ circle is hidden where the new picture is used.

## 1.1.33 - 2026-11-12

### Changed

- Blog page: the sidebar (advisor form, search, tags) stays in view while the articles scroll, just below the header (desktop, from 1101px). Each tab shows up to 12 articles (was 6) so the sidebar has room to stay pinned; "View More" still opens the full category.

## 1.1.32 - 2026-11-11

### Changed

- Blog page banner, from the Figma: the new photo (colleagues at a sticky-note wall, `blog-hero-bg.webp`, 1920px, 121 KB) under the design's gradient wash, warm peach on the left to light blue on the right, light enough that the people stay visible, with a soft white lift behind the text.

## 1.1.31 - 2026-11-11

### Changed

- Every hero has a "Download Brochure" button with the download icon (it goes to the advisor form, as on the program pages): Home and DBA Category swap their advisor button for it; About Us and the Alumni page get one under the hero text (white on the dark Alumni hero), with 30px above it (`hero-brochure`). Page patterns updated; saved pages are updated separately.

## 1.1.30 - 2026-11-11

### Fixed

- USP bento grid (DBA pages), from the design review: the badge on the alumni avatars says **500+** (was 50+), matching the big number (new file `bento-avatars-500.webp` so browsers don't keep showing the cached 50+; the old file name holds the same picture for pages saved earlier); the Global Accreditation map sits in the card's lower right with its pins clear of the title and text, which no longer runs under it.

## 1.1.29 - 2026-11-11

### Fixed

- MBA course pages (Cybersecurity, PMP, Data Analytics), Benefits section: 40px between the benefit cards and the photo on desktop (it was 0, so the cards touched the photo frame; that 0 suited the first artwork, which had white space at its left edge).

## 1.1.28 - 2026-11-11

### Changed

- The small gold labels above section headings ("eyebrows") no longer have a gold line under them: removed on the MBA course pages (MBA Cybersecurity, PMP, Data Analytics) and from the Location publish banner, with the space that held the line. The labels themselves stay.

## 1.1.27 - 2026-11-11

### Changed

- "Our USPs" benefit list (Overview block, default style; DBA and MBA pages): more breathing space, as in the Figma reference. Cards have 12px above and below the text (was 5px), 8px between the title and the description (was 2px), description line height 1.6 (was 1.45), 12px between cards (was 10px). The "Photo" style is unchanged. Token ratchet baseline lowered.

## 1.1.26 - 2026-11-11

### Changed

- Blog articles: the "Talk to an Advisor" form stays in view while the article scrolls (the whole sidebar is sticky, 110px from the top so it clears the floating header). The sidebar never gets taller than the screen: the form keeps its size and the table of contents list shrinks (to about three items on short screens) and scrolls inside. Below 1100px, where the sidebar sits under the article, nothing changes.

## 1.1.25 - 2026-11-11

### Fixed

- "Talk to an Advisor" form: even 10px spacing between every field. The Shortcode block's auto-paragraphs wrapped some fields in `<p>` (extra space above the phone and the checkbox, none between Email, LinkedIn URL and Message or before Submit); they no longer affect the layout. Applies wherever the form is used.

## 1.1.24 - 2026-11-11

### Changed

- Blog articles: headings inside the article are smaller: H2 25px at every width (new font size `25`), H3 20px, H4 18px. Only the article body of blog posts; the article title and other pages are unchanged.

## 1.1.23 - 2026-11-11

### Changed

- New footer from the design ("IMET Worldwide Main file (12)"): darker navy band (new colour `navy-night`); five page tabs left-aligned with Accreditation in gold (adds Success Stories); the about column with Follow Us + the LinkedIn logo and Refer & Earn; link columns Main Menu · Courses by Category + Master's (MBA) Programs · Doctorate (DBA) Programs with a Popular badge and underlined links; the four offices with phone numbers over a faint world map (`world-map.svg`, public domain); doctorate programs grouped by country (USA, UK, Canada, UAE, West Africa) with a heading each. The "Book Free Mentorship Session" block is gone, as in the design.
- Footer on phones follows the phone design: logo beside the name, about text, Follow Us; "Quick Links" as boxed rows (Main Menu, Courses by Category, Doctorate (DBA), Master's (MBA), Doctorate Programs by Country); "Our Presence" as boxed rows with round flags; the referral centred; the page tabs as a list with Accreditation as a gold bar; the copyright on navy over one row of recognition logos. Same content as desktop, reordered in CSS.
- Menus: "Footer: Doctorate Programs by Country" becomes five locations, one per country heading (`footer-usa`, `footer-uk`, `footer-canada`, `footer-uae`, `footer-west-africa`), seeded on the next wp-admin visit (MenuSeeder version 3).

## 1.1.22 - 2026-11-11

### Changed

- Blog addresses follow the old site: articles at `/blogs/<article>/` (Settings > Permalinks: `/blogs/%postname%/`), categories at `/blogs/category/<category>/`. The IMET BLOG bar's built-in links and the seeded "Blog Categories" menu point to `/blogs/category/…`.

## 1.1.21 - 2026-11-11

### Added

- Blog author box: two fields in Users > Profile ("Blog author box"): **Job title**, shown under the author's name, and **Author photo** (an image address, used instead of the Gravatar picture). Bio and LinkedIn stay WordPress's own Biographical Info and Website fields (`AuthorProfile`).

### Fixed

- "Our Related Blogs" no longer disappears when an article is the only one in its category: it then shows the latest articles.
- Author box: the name is centred beside the photo when there is no job title, and an empty bio takes no space.

## 1.1.20 - 2026-11-10

### Changed

- LinkedIn testimonials ("What Our Clients Say") come in three shared versions that writers edit separately in Patterns > My patterns (IMET: Shared Sections): **Testimonials – Global** (the old "Clients Testimonials", renamed; used on Home), **Testimonials – MBA** and **Testimonials – DBA**. The MBA and DBA ones start as a copy of the Global one as it is today (the MBA intro says "online MBA experience"); after that each changes only its own pages. A title the team already changed is kept.
- The MBA page patterns (MBA category, MBA course) place the MBA version, the DBA page patterns (DBA landing, DBA course) the DBA version.
- Existing pages switch once, automatically, the first time an administrator opens wp-admin after the update (`SplitTestimonials`): pages whose address has "mba" in it move to the MBA version, "dba" or "doctorate" to the DBA version, every other page (Home) keeps the Global one. Only that block changes, and each page gets a revision.

## 1.1.19 - 2026-11-10

### Fixed

- Blog article without a featured image: the title, byline and share now take the width of the article column (they were squeezed into the image's half, leaving the right side empty).

## 1.1.18 - 2026-11-10

### Added

- Blog article template (`templates/single.html`), from the "DBA file 16/10" design: a navy "IMET BLOG" category bar (new menu location "Blog: Category bar", seeded with Cybersecurity, AI & Data, Doctorate, MBA, Career Growth and Leadership; the article's own categories are underlined), breadcrumbs and "Back to all Blogs", the featured image beside the title, byline, "Share this Resource" on LinkedIn and coloured tag chips; then the article beside the advisor form, a table of contents built from the article's H2 headings (the one being read is marked) and Follow Us; under the article an author box (avatar, name, bio, and their LinkedIn when the Website field of their profile is a LinkedIn address) and "Our Related Blogs" (three articles from the same categories).
- Article parts for editors (patterns in IMET: Sections): Blog: TL;DR box, Blog: Program card, Blog: Contact banner, Blog: Recommended reading; a "Comparison" style for tables; quotes and tables in articles follow the design.
- `SinglePost` (`[imet_share_linkedin]`, `[imet_author_linkedin]`, related-articles query).
- Design review (Figma notes): larger featured image (603×290 beside a 485px title column), byline and tags on the left with "Share this Resource" over the LinkedIn logo on the right, the official LinkedIn logo (`linkedin-logo.svg`), a table of contents with a slim always-visible scrollbar that fades out while more items wait below.
- Responsive: from 1100px down the title block stacks its byline, tags and share, the table of contents moves above the article and the advisor form follows it; "Back to all Blogs" has a 44px tap area. Checked at 1440, 1280, 1100, 1024, 900, 768, 640, 390 and 320px with no horizontal overflow.

## 1.1.17 - 2026-11-09

### Fixed

- MBA course pages (MBA Cybersecurity, Project Management, Data Analytics): the fee banner has the same 40px above and below (it was 85px below, with an extra divider line), and the hero's three stats sit on one row (the third wrapped; the hero no longer has extra side padding, so it lines up with the sections below, as on the DBA pages).

## 1.1.16 - 2026-11-09

### Fixed

- About Us spacing: the hero clears the floating header (its label sat 22px under it) and the logo card has room around the logo and its labels; Mission and Vision boxes, partner centre cards and the gallery box have more inner padding; the lead mentor's name tag no longer hangs into the next section.

## 1.1.15 - 2026-11-09

### Added

- New pattern **About Us Page** (`imet-theme/about-page`, under IMET: Full Pages), from the design: hero with logo card and labels as text, main USPs, mission and vision, what you gain, partner centres with the world map, six photo cards, the Dubai convocation gallery, mentors and FAQs. Built from IMET Section blocks and the FAQ block; styles in `_about-page.scss`, scoped to its own section classes. 25 photos cut from the design (`about-*.webp`).

## 1.1.14 - 2026-11-09

### Fixed

- MBA Course Page spacing: every section has the same room above and below (40px, it ranged from 8px to 106px) and every section header sits 32px above its content (it ranged from 10px to 45px), as on the other pages. The opened requirements answer no longer overlaps its question, and no photo is pulled up into the element above.

## 1.1.13 - 2026-11-08

### Fixed

- DBA Eligibility Criteria photo: "AI Ethics & Security" and "Cyber Resilience" each sit on one line with a clear gap between them (they touched when the first wrapped to two lines).

## 1.1.12 - 2026-11-08

### Added

- Before publishing, the editor lists any photo on the page that is still the placeholder, including inside shared photo sections (it only warns; publishing is not blocked).
- `bin/photo-chips.js` + `bin/photo-chips.json`: the label positions of the photo sections come from one committed spec (`npm run photo-chips`; `npm run lint:photo-chips` fails when the SCSS is out of date, and is part of `lint:all`).
- `bin/verify-blocks.js`, `bin/shoot.js` and `bin/audit-layout.js` take `--channel chrome` to use the installed Chrome instead of Playwright's own browser.

### Changed

- The photo section labels and alt text are translatable (`imet-theme`); the English output is unchanged.
- `wp imet-theme link-photo-sections` reports a section it found but could not match as saved, instead of skipping it silently.
- No specificity hacks left in the photo and MBA Course styles: each conflict is settled in the block that owns the slot (highlights, tabs, overview, who-can-join). The Home tab photo now fills its cell on desktop and keeps the tabs block's 370px / 207px size on tablets and phones; on very narrow photos only the short labels show.
- MBA Course styles use the theme's tokens wherever one matches (77 values); the remaining raw values are design-only sizes.
- AGENTS.md: AI tools may commit to a feature branch, push it and open a PR when the developer explicitly asks; merging to `main` stays a developer action.

## 1.1.11 - 2026-11-08

### Changed

- **Photo sections are synced patterns: change once, every page follows.** The 16 photos with labels (DBA Course eligibility and benefits, DBA Category, MBA Category, MBA Course, Location, Home tabs and "Why choose" cards) are synced patterns under "IMET: Shared Sections (reusable)", created on the next administrator visit. Their layout and design are shared; each page can still swap the photo and the label text (pattern overrides). The page patterns place them by reference.
- New command `wp imet-theme link-photo-sections` links pages saved earlier to these synced sections: it swaps only the old photo block (everything else on the page stays), reports by default and saves with `--yes` (one revision per page).
- The link command never swaps a real photo for a section that still shows the placeholder: it keeps the page's photo, lists the section as waiting, and links it once the synced pattern has a real photo.

### Fixed

- MBA Course Page: no horizontal scroll between 1101 and 1299px (the highlights, requirements and benefits photos had fixed widths); they keep their design size at 1440 and narrow with their column.

## 1.1.10 - 2026-11-08

### Changed

- Every photo that had labels drawn into it now carries them as real text (a new "photo with chips" component, `_photo-chips.scss`): Home (doctorate tab, MBA tab, the four "Why choose" cards), DBA Category (highlights, graduate), MBA Category (highlights, USP), MBA Course (highlights, requirements, benefits), Location and DBA USA (highlights). Each uses one shared placeholder photo (`photo-placeholder.webp`) to be replaced in the editor; the frame keeps the original artwork's shape, and the labels are placed and sized with the photo at every width. New colour token `pink`. On narrow photos (phones) the career-path and ROI cards step aside so the short labels stay readable; the step-card text style no longer applies to these labels. Pages saved earlier keep their old images until the section is re-inserted.
- DBA Course Page: the labels on the Eligibility Criteria photo (AI Ethics & Security, Cyber Resilience, C-Suite Reporting) and the Benefits photo (3.5M+ job openings, Immediate ROI +85%, the career path to CISO) are real text over clean photos (`course-requirements-clean.webp`, `course-benefits-clean.webp`), placed in container units so they keep their place at every width. Pages saved earlier keep their old images until the section is re-inserted.
- MBA Course Page matched to its 1440 design: Montserrat copy, 22px eyebrows with a gold line, 38px titles, thin rules between sections, the hero, form, highlights, fee banner, requirements, benefits, tabs, process and CTA at the design's sizes and spacing. Scoped to the MBA hero's `is-mba-course` class (`_mba-course.scss`) and to desktop widths, so no other page changes. The pattern's logo card has no title and the highlights list four points, as in the design.

## 1.1.9 - 2026-11-08

### Added

- New pattern **MBA Course Page** (`imet-theme/mba-course-page`): the Online MBA in Cybersecurity course page from the design, built from existing IMET blocks on the light hero, with four new photos (`mba-course-*.webp`).

### Fixed

- The hero's star rating and breadcrumb hover are readable on the light hero too (they were white); the dark hero is unchanged.

## 1.1.8 - 2026-11-07

### Added

- New pattern **DBA Location Page UI Doctorate Cybersecurity in USA** (`imet-theme/dba-location-usa`), built from existing IMET blocks to the 1440 design. Its design details are scoped to the pattern (`is-dba-usa`), so other pages keep their look. FAQ cards can now start with one question and a "+" that shows the rest (`is-peek`).
## 1.1.7 - 2026-11-07

### Changed

- Testimonials glide on their own on every page: "What Our Clients Say" everywhere, and Home's "Our Success Stories" flip cards now move in one row too (four in view, two on tablets, one on phones; hover flips a card and pauses the row).
- Program cards (Related Programs / Other Doctorate Concentrations, Our Programs) glide on their own at every width in every style, also when all the cards fit on desktop (the five- and six-per-row styles stood still). Hover, focus or the pause button stops them.
- A new **IMET Testimonials** block (Blocks tab) starts with the real client quotes of "What Our Clients Say" (names, roles, LinkedIn) instead of the old placeholder text. To show the same testimonials on every page, insert the synced **Clients Testimonials** from Patterns > IMET: Shared Sections (reusable).

## 1.1.6 - 2026-11-07

### Changed

- Patterns are filed in three categories in the inserter and in Patterns: **IMET: Full Pages** (Home, DBA Category, DBA Course, MBA, Location, Alumni, Blog), **IMET: Sections** (single sections, a separate copy on each page) and **IMET: Shared Sections (reusable)** (the synced Offer Banner, Clients Testimonials, CTA, Achievements and Career Table; edit once, shown everywhere). Synced sections made before this get the category on the next administrator visit to wp-admin.

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

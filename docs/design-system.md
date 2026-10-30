# IMET design system

The theme owns the design of the IMET section blocks (`src/blocks/`) and the finished pages built from them (DBA category
page, DBA course page), so core blocks and the `imet/*` sections look the same. Home-page-only styles are not included.

**Where things live**

| What | Where |
|---|---|
| Colours, type scale, spacing, radii, shadows, button sizes, gradients | `theme.json` (`settings`, exposed as `--wp--preset--…` and `--wp--custom--…`) |
| Heading, link, button, quote and FAQ defaults | `theme.json` → `styles` |
| Editor "Styles" options for blocks (tokens only) | `styles/blocks/*.json` (file name = slug, class `is-style-<slug>`) |
| Layout and responsive behaviour of the components, button sizes, glass flash | `src/css/shared/_design-system.scss`, `_components.scss` |
| Header and footer | `parts/header.html`, `patterns/footer.php`, `src/css/shared/_header-footer.scss` |
| Ready-made sections (category **IMET Sections**) | `patterns/section-header.php`, `testimonials.php`, `video-section.php`, `scrolling-section.php` |

WordPress's variation CSS cannot hold media queries or comma selectors, so a block style's JSON holds only tokens; anything
responsive goes in `_components.scss` under the same `is-style-…` class.

## Scales (mirror `base.scss`)

- **Type:** caption 13 · small 15 · normal 16 · body 17 · medium 18 · large 20 · card title 22→28 · eyebrow 18→22 · **section
  title (h2, `x-large`) 26→35** · **hero title (h1, `xx-large`) 28→38** · banner title (`huge`) 28→40. Headings are 600
  (h1 700) with line height 1.3.
- **Spacing:** 6 · 10 · 16 · 24 · 36 · 48 (section padding) · 70.
- **Radius:** 6 button · 8 tile · 10 card · 12 spec card · 14 IMET · 24 band. **Shadows:** soft, card, raised (video), offset.
- **Buttons:** Inter 600, 6px radius, 2px border. Sizes `btn-sm` 48 / `btn-md` 60 (default) / `btn-lg` 72 px high (44 / 54 / 62 on
  phones). Colours are block styles: default Navy, White, Gold, Outline, Outline (on dark), Light grey, Text link. Extras:
  `btn-block`, `btn-icon-download`, `stack-mobile` (on the Buttons block).

## Block styles

| Block | Styles |
|---|---|
| Button | White · Gold · Outline · Outline (on dark) · Light grey · Text link |
| Heading / Paragraph | Eyebrow (gold, underlined) · Section subtitle |
| Group | Card · Navy band · Gradient band · Link card (offset shadow) · Scrolling row · Testimonial grid · Video gallery |
| Quote | Testimonial card |
| Embed / Image | Video frame · Video thumbnail |

Scrolling row: set `--imet-per-view` (phones, default 2) and `--imet-per-view-desktop` (default 4) in the block's CSS to change how
many cards show.

## Changing a token

Edit `theme.json` once; every component, the editor and the patterns follow. The section blocks' own `.imet-section` rules use
the same values, so they stay visually identical to core blocks. The ported block SCSS still holds raw values that are being
converted to tokens; `bin/audit-tokens-baseline.json` is the ratchet (counts only go down).

## Tokens only (no magic numbers)

Templates, parts, patterns, block-style partials and the SCSS contain no raw `px`/`rem`/`em` values and no hard-coded colours.
Everything resolves to a token defined once in `theme.json`:

| Token | Name | Example |
|---|---|---|
| Spacing presets | named by pixels | `--wp--preset--spacing--20` = 20px; in markup `var:preset|spacing|20` |
| Radius presets | named by pixels | `--wp--preset--border-radius--6`; `pill` |
| Type presets | semantic, plus pixel-named extras | `--wp--preset--font-size--medium`, `--14`, `--29` |
| Colours, shadows | semantic | `--wp--preset--color--navy`, `--wp--preset--shadow--pill` |
| Dimensions, line heights, border widths, letter spacing | `custom`, named by pixels | `--wp--custom--size--84`, `--wp--custom--line-height--28` |
| Component values | `custom`, semantic | `--wp--custom--header--pill-height`, `--wp--custom--header--clearance` |

Slugs are pure digits on purpose: WordPress kebab-cases names and would turn `s28` into `s-28`.

**Adding a value:** put it in `theme.json` first, then reference it. Run `npm run lint:tokens`; it fails on any raw size or
colour, and on any `var(--wp--preset--…)` / `var(--wp--custom--…)` that is not defined (an undefined token silently does
nothing). It is part of `npm run lint:all`.

### Deliberate exceptions

The theme is pixel-matched to the live site and the IMET sections, so a few things differ from a generic 8px scale:

- **Pixel-named steps, not an 8px scale.** Spacing steps are the live site's values (4, 5, 6, 8, 10, 12 … 80).
- **Unequal padding where the live design is unequal:** the footer tabs (80 top / 0 bottom) and inner block (32 / 20), the
  testimonial card (24 left / 18 right), the link card (54 right, room for the arrow), and the header clearance
  (`--wp--custom--header--main-clearance` above page content, so the floating pill never covers it).
- **Breakpoints** are raw values in `src/css/shared/_breakpoints.scss`, the only file allowed to hold them (media queries
  cannot use variables): 480, 640, 768, 1000, 1024, 1060.
- **Font weights 400/500/600/700:** 500 is the live nav and eyebrow weight.
- **Button colours:** the seven-colour system is kept (six block styles plus the default), not two variants.
- **Content widths** are 1020px (text) and 1200px (wide), the sections' containers, not 720px.

## Home pattern

`patterns/home.php` ("Home (IMET)") reuses the Home block styles of `imet/hero`, `imet/highlights` and the global `imet/cost-banner`. Their Home
rules and the advisor form (`_advisor-form.scss`) are tokens only. New token: palette colour `danger` (`#b3261e`) for form errors; everything else is
an existing preset. Gold pill icons are inline SVG data URIs (the only place a hex colour is allowed in CSS).


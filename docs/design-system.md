# IMET design system

The theme carries the design of the IMET Blocks plugin's finished pages (DBA category page, DBA course page) so core
blocks look the same as the plugin's sections. Home-page-only styles are not included.

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

Edit `theme.json` once; every component, the editor and the patterns follow. The plugin's `.imet-section` rules still win inside
plugin sections (they use the same values), so the two stay visually identical.

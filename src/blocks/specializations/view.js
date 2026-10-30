/* Program cards scroll like a marquee (shared helper: see src/blocks-shared/view-helpers.js). The Home style scrolls too:
   its five cards are wider than the four-card window, so the row glides and pauses on hover, focus or touch. */
import { each, marquee } from '../../blocks-shared/view-helpers';

each('.wp-block-imet-specializations .spec-grid', (grid) =>
	marquee(grid, [...grid.querySelectorAll('.spec-card')], { speed: 40 })
);

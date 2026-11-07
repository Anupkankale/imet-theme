/* Program cards scroll like a marquee (shared helper: see src/blocks-shared/view-helpers.js). They glide on their own at
   every width, even when every card fits in the row (UI review: "Related Programs" sat still on desktop), and pause on
   hover, focus or touch, or with the pause button. */
import { each, marquee } from '../../../blocks-shared/view-helpers';

each('.wp-block-imet-specializations .spec-grid', (grid) =>
	marquee(grid, [...grid.querySelectorAll('.spec-card')], {
		speed: 40,
		alwaysMove: true,
	})
);

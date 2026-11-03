import { each, marquee } from '../../../blocks-shared/view-helpers';

/* Home page: the row of cards glides sideways on its own (no arrows), like the other card rows. It only moves while the
   cards are wider than the row, pauses on hover and focus, and stays still for people who ask for less motion. */
each(
	'.wp-block-imet-step-cards.is-style-home:not(.is-cases) .step-grid',
	(grid) =>
		marquee(grid, [...grid.querySelectorAll('.step-card')], { speed: 30 })
);

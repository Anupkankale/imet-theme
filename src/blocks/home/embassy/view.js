import {
	each,
	marquee,
	pauseButton,
} from '../../../blocks-shared/view-helpers';

/* Home page, alumni employer logos: each row glides sideways (only while it overflows); one pause button stops every
   row of the section. */
each('.wp-block-imet-embassy.is-employers', (section) => {
	const rows = [...section.querySelectorAll('.emblem-row')];
	const moving = rows
		.map((row) => [
			row,
			marquee(row, [...row.querySelectorAll('.emblem')], {
				speed: 30,
				control: false,
			}),
		])
		.filter(([, controller]) => controller);
	if (!moving.length) {
		return;
	}
	const movingRows = moving.map(([row]) => row);
	pauseButton(
		movingRows[movingRows.length - 1],
		(stop) =>
			moving.forEach(([, controller]) => controller.setStopped(stop)),
		{ rows: movingRows }
	);
});

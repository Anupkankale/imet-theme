import {
	each,
	marquee,
	pauseButton,
} from '../../../blocks-shared/view-helpers';

/* Home page, alumni employer logos: each row glides sideways (only while it overflows), every other row the opposite
   way (1st left, 2nd right, ...); one pause button stops every row of the section. */
each('.wp-block-imet-embassy.is-employers', (section) => {
	const rows = [...section.querySelectorAll('.emblem-row')];
	const moving = rows
		.map((row, index) => [
			row,
			marquee(row, [...row.querySelectorAll('.emblem')], {
				speed: 30,
				control: false,
				reverse: index % 2 === 1,
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

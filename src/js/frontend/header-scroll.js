/**
 * Header: slides away when scrolling down and comes back as soon as the visitor scrolls up.
 *
 * It stays in view near the top of the page, while a menu is open (dropdown, mobile overlay) and while focus is inside it,
 * so keyboard and touch users never lose the navigation. Without JavaScript the header simply stays sticky.
 */
const HEADER = document.querySelector(
	'.wp-site-blocks > header.wp-block-template-part'
);
const TOP_ZONE = 120; // px from the top where the header always shows
const TOLERANCE = 8; // px of scrolling that counts as a direction change

if (HEADER) {
	let lastY = window.scrollY;
	let ticking = false;

	const menuIsOpen = () =>
		document.documentElement.classList.contains('has-modal-open') ||
		HEADER.matches(':focus-within') ||
		!!HEADER.querySelector('[aria-expanded="true"]');

	const update = () => {
		ticking = false;
		const y = window.scrollY;
		const delta = y - lastY;

		if (y < TOP_ZONE || menuIsOpen()) {
			HEADER.classList.remove('is-hidden');
		} else if (delta > TOLERANCE) {
			HEADER.classList.add('is-hidden');
		} else if (delta < -TOLERANCE) {
			HEADER.classList.remove('is-hidden');
		} else {
			return; // a tiny movement: keep the state and the reference point
		}

		lastY = y;
	};

	window.addEventListener(
		'scroll',
		() => {
			if (!ticking) {
				ticking = true;
				window.requestAnimationFrame(update);
			}
		},
		{ passive: true }
	);

	// Tabbing into the header (or opening a submenu) shows it.
	HEADER.addEventListener('focusin', () =>
		HEADER.classList.remove('is-hidden')
	);
}

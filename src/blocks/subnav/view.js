/* Sticky section bar: highlights the link of the section in view, and in-page links land below the bar. */
import { each, reduceMotion } from '../../blocks-shared/view-helpers';

const find = (hash) => {
	try {
		return hash.length > 1 ? document.querySelector(hash) : null;
	} catch {
		return null; // not a valid selector
	}
};

each('.wp-block-imet-subnav', (subnav) => {
	const links = subnav.querySelectorAll('.subnav-links a');
	if (links[0]) {
		links[0].classList.add('active');
	}

	// When the links are wider than the bar it scrolls sideways: fade the edge that has more links behind it, and keep
	// the active link in view.
	const bar = subnav.querySelector('.subnav-inner');
	const edges = () => {
		if (!bar) {
			return;
		}
		const more = bar.scrollWidth - bar.clientWidth;
		subnav.classList.toggle('has-more-right', bar.scrollLeft < more - 2);
		subnav.classList.toggle('has-more-left', bar.scrollLeft > 2);
	};
	if (bar) {
		bar.addEventListener('scroll', edges, { passive: true });
		window.addEventListener('resize', edges);
		edges();
	}
	const reveal = (a) => {
		if (!bar || bar.scrollWidth <= bar.clientWidth) {
			return;
		}
		const left = a.offsetLeft - (bar.clientWidth - a.offsetWidth) / 2;
		bar.scrollTo({
			left: Math.max(0, left),
			behavior: reduceMotion() ? 'auto' : 'smooth',
		});
	};
	const spy = new window.IntersectionObserver(
		(entries) =>
			entries.forEach((e) => {
				if (e.isIntersecting) {
					// Two links can point at the same section (e.g. "Our Programs" and "Specializations" on the
					// location pages): only the first one lights up.
					const match = [...links].find(
						(a) => a.getAttribute('href') === '#' + e.target.id
					);
					links.forEach((a) =>
						a.classList.toggle('active', a === match)
					);
					if (match) {
						reveal(match);
					}
				}
			}),
		{ rootMargin: '-45% 0px -50% 0px' }
	);
	links.forEach((a) => {
		const target = find(a.getAttribute('href'));
		if (target) {
			spy.observe(target);
		}
	});

	// Every in-page link inside the IMET sections scrolls to just below the bar (and the admin bar when logged in).
	document.querySelectorAll('.imet-section a[href^="#"]').forEach((a) => {
		a.addEventListener('click', (e) => {
			const target = find(a.getAttribute('href'));
			if (!target) {
				return;
			}
			e.preventDefault();
			const adminBar = document.getElementById('wpadminbar');
			const offset =
				subnav.offsetHeight +
				(adminBar ? adminBar.offsetHeight : 0) +
				10;
			window.scrollTo({
				top:
					target.getBoundingClientRect().top +
					window.scrollY -
					offset,
				behavior: reduceMotion() ? 'auto' : 'smooth',
			});
		});
	});
});

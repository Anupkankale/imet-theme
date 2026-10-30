/* Helpers for the blocks' front-end scripts (each block's view.js only touches its own blocks). */
export const reduceMotion = () =>
	window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/**
 * Run fn for every element matching selector once the DOM is ready.
 * @param {string}                     selector CSS selector.
 * @param {(element: Element) => void} fn       Called with each matching element.
 */
export function each(selector, fn) {
	const run = () => document.querySelectorAll(selector).forEach(fn);
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', run);
	} else {
		run();
	}
}

/**
 * Accordion of core/details blocks: one item open at a time, opening and closing with a smooth height animation
 * (instant for "reduce motion"). Each item's content is wrapped in .acc-body; .is-closing marks an item while it
 * animates shut (it is still [open] until the animation ends).
 * @param {Element} group             Element holding the details blocks.
 * @param {Object}  options           Options.
 * @param {boolean} options.openFirst Open the first item initially.
 * @param {number}  options.duration  Animation length in ms.
 */
export function accordion(group, { openFirst = false, duration = 320 } = {}) {
	const items = [...group.querySelectorAll('details')]; // also inside .wp-block-group__inner-container (classic themes)
	const still = reduceMotion();
	items.forEach((d) => {
		const body = document.createElement('div');
		body.className = 'acc-body';
		[...d.children]
			.filter((c) => c.tagName !== 'SUMMARY')
			.forEach((c) => body.appendChild(c));
		d.appendChild(body);
	});
	if (openFirst && items[0] && !items.some((d) => d.open)) {
		items[0].open = true;
	}

	const running = new Map();
	const animate = (d, opening) => {
		const body = d.querySelector(':scope > .acc-body');
		running.get(d)?.cancel();
		if (still || !body.animate) {
			d.open = opening;
			return;
		}
		const from = d.open ? body.offsetHeight : 0;
		if (opening) {
			d.open = true;
		}
		d.classList.toggle('is-closing', !opening);
		const to = opening ? body.scrollHeight : 0;
		const anim = body.animate(
			[
				{ height: from + 'px', opacity: opening ? 0 : 1 },
				{ height: to + 'px', opacity: opening ? 1 : 0 },
			],
			{ duration, easing: 'cubic-bezier(.4, 0, .2, 1)' }
		);
		running.set(d, anim);
		anim.onfinish = () => {
			running.delete(d);
			d.classList.remove('is-closing');
			if (!opening) {
				d.open = false;
			}
		};
	};

	items.forEach((d) =>
		d.querySelector('summary').addEventListener('click', (e) => {
			e.preventDefault();
			const opening = !d.open || d.classList.contains('is-closing');
			if (opening) {
				items.forEach(
					(o) =>
						o !== d &&
						o.open &&
						!o.classList.contains('is-closing') &&
						animate(o, false)
				);
			}
			animate(d, opening);
		})
	);
}

/**
 * Marquee: the row glides left at `speed` px/s and loops without a jump (the items are repeated once,
 * marked .is-clone and hidden from screen readers and the tab order). It only moves while the row actually
 * overflows (so CSS decides per screen size), is on screen and isn't hovered, focused or touched; swiping still
 * works. Off for "reduce motion". `alwaysMove` keeps it gliding even when the items exactly fit the row (the copies
 * fill in behind them), for rows that should never sit still.
 * @param {Element}   row                Row that glides.
 * @param {Element[]} items              Items in the row.
 * @param {Object}    options            Options.
 * @param {number}    options.speed      Pixels per second.
 * @param {boolean}   options.alwaysMove Keep gliding when the items exactly fit.
 */
export function marquee(row, items, { speed = 40, alwaysMove = false } = {}) {
	if (reduceMotion() || items.length < 2) {
		return;
	}
	items.forEach((item) => {
		const copy = item.cloneNode(true);
		copy.classList.add('is-clone');
		copy.setAttribute('aria-hidden', 'true');
		copy.querySelectorAll('a').forEach((a) =>
			a.setAttribute('tabindex', '-1')
		);
		row.appendChild(copy);
	});
	row.classList.add('is-marquee');

	const firstCopy = row.children[items.length];
	const loopWidth = () => firstCopy.offsetLeft - items[0].offsetLeft;
	// The original items alone are wider than the row (the copies don't count, or it would always "overflow")
	const overflows = () => {
		if (alwaysMove) {
			return true;
		}
		const lastItem = items[items.length - 1];
		return (
			lastItem.offsetLeft + lastItem.offsetWidth - items[0].offsetLeft >
			row.clientWidth + 2
		);
	};
	// While the originals fit in the row nothing scrolls, so the copies would only show as repeated items: hide them.
	const syncStatic = () => row.classList.toggle('is-static', !overflows());
	syncStatic();
	let pos = 0;
	let last = 0;
	let paused = false;
	let visible = false;
	const tick = (now) => {
		window.requestAnimationFrame(tick);
		syncStatic();
		const dt = last ? Math.min(now - last, 100) : 0;
		last = now;
		const w = loopWidth();
		if (paused || !visible || w <= 0 || !overflows()) {
			if (!paused && w > 0 && !overflows() && row.scrollLeft) {
				row.scrollLeft = pos = 0; // fits again (e.g. after a resize): back to the start
			}
			return;
		}
		pos += (speed * dt) / 1000;
		if (pos >= w) {
			pos -= w;
		}
		row.scrollLeft = pos;
	};
	const pause = () => {
		paused = true;
	};
	const resume = () => {
		const w = loopWidth();
		pos = w > 0 ? row.scrollLeft % w : 0; // continue from where a swipe left it
		paused = false;
	};
	row.addEventListener('mouseenter', pause);
	row.addEventListener('mouseleave', resume);
	row.addEventListener('touchstart', pause, { passive: true });
	row.addEventListener('touchend', () => setTimeout(resume, 1500));
	row.addEventListener('focusin', pause);
	row.addEventListener('focusout', resume);
	new window.IntersectionObserver(([e]) => {
		visible = e.isIntersecting;
		last = 0;
	}).observe(row);
	window.requestAnimationFrame(tick);
}

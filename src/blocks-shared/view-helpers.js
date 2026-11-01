/* Helpers for the blocks' front-end scripts (each block's view.js only touches its own blocks). */
import { __ } from '@wordpress/i18n';
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

const VIDEO_CONSENT = 'imet-video-consent';

const remembered = () => {
	try {
		return window.localStorage.getItem(VIDEO_CONSENT) === 'yes';
	} catch {
		return false; // storage blocked (private mode, site data off): ask every time
	}
};

/**
 * Ask before loading a YouTube player: nothing is requested from YouTube until the visitor presses "Play video"
 * (GDPR). "Remember my choice" stores the answer in this browser so later videos start straight away. Clicks inside the
 * notice never reach a surrounding link.
 * @param {Element}    container Element the notice covers (positioned by the block's CSS, or made relative here).
 * @param {() => void} start     Loads and plays the video.
 */
export function videoConsent(container, start) {
	if (remembered()) {
		start();
		return;
	}
	container.querySelector(':scope > .imet-video-consent')?.remove();

	const notice = document.createElement('div');
	notice.className = 'imet-video-consent';
	notice.setAttribute('role', 'group');
	notice.setAttribute('aria-label', __('YouTube video', 'imet-theme'));

	const text = document.createElement('p');
	text.textContent = __(
		'This video is hosted on YouTube. Playing it loads content from YouTube (Google), which can set cookies and receives your IP address.',
		'imet-theme'
	);

	const label = document.createElement('label');
	const remember = document.createElement('input');
	remember.type = 'checkbox';
	label.append(remember, ' ', __('Remember my choice', 'imet-theme'));

	const play = document.createElement('button');
	play.type = 'button';
	play.className = 'imet-video-consent-play';
	play.textContent = __('Play video', 'imet-theme');

	const cancel = document.createElement('button');
	cancel.type = 'button';
	cancel.className = 'imet-video-consent-cancel';
	cancel.textContent = __('Cancel', 'imet-theme');

	notice.append(text, label, play, cancel);
	notice.addEventListener('click', (event) => event.stopPropagation());
	play.addEventListener('click', (event) => {
		event.preventDefault();
		if (remember.checked) {
			try {
				window.localStorage.setItem(VIDEO_CONSENT, 'yes');
			} catch {
				// Not stored: the notice shows again next time.
			}
		}
		notice.remove();
		start();
	});
	cancel.addEventListener('click', (event) => {
		event.preventDefault();
		notice.remove();
	});

	if (window.getComputedStyle(container).position === 'static') {
		container.style.position = 'relative';
	}
	container.appendChild(notice);
	play.focus();
}

/* Room the pause button needs next to a row: the 32px button plus a 6px gap each side. */
const CONTROL_ROOM = 44;
const CONTROL_GAP = 6;

/**
 * Free space between a box and the nearest content (text, image, link, control) on one side of it, within the
 * IMET section, over the right-hand strip where the pause button sits. Section backgrounds do not count as content.
 * @param {Element}         anchor The row.
 * @param {'above'|'below'} side   Which side.
 * @return {number} Pixels.
 */
function freeSpace(anchor, side) {
	const section = anchor.closest('.imet-section');
	if (!section) {
		return 0;
	}
	const a = anchor.getBoundingClientRect();
	const s = section.getBoundingClientRect();
	const left = a.right - 48;
	let free = side === 'below' ? s.bottom - a.bottom : a.top - s.top;
	section.querySelectorAll('*').forEach((el) => {
		if (
			anchor.contains(el) ||
			el.contains(anchor) ||
			el.closest('.imet-motion-control')
		) {
			return;
		}
		const content =
			['IMG', 'svg', 'BUTTON', 'INPUT', 'A', 'VIDEO', 'IFRAME'].includes(
				el.tagName
			) ||
			[...el.childNodes].some(
				(n) => n.nodeType === 3 && n.textContent.trim()
			);
		const r = el.getBoundingClientRect();
		if (
			!content ||
			!r.width ||
			!r.height ||
			r.left >= a.right ||
			r.right <= left
		) {
			return;
		}
		if (side === 'below' && r.top >= a.bottom - 1) {
			free = Math.min(free, r.top - a.bottom);
		} else if (side === 'above' && r.bottom <= a.top + 1) {
			free = Math.min(free, a.top - r.bottom);
		}
	});
	return free;
}

/**
 * A button that stops and restarts moving content. WCAG 2.2.2 (Pause, Stop, Hide) asks for one on anything that moves
 * for more than five seconds; pausing on hover or focus alone does not count.
 *
 * Its box is an empty, zero-height block right after the (last) row, so the page layout is exactly what it is without
 * the button. The button then sits where it covers nothing: below the rows when the space under them is free of
 * content, otherwise above them, and only when neither side has room does it float over the rows' bottom-right
 * corner. The choice is made again when the window is resized. It hides while none of the rows moves (all .is-static).
 * @param {Element}                    anchor       The moving element; the button's box goes right after it.
 * @param {(stopped: boolean) => void} onChange     Called with true when the visitor stops the motion, false when they restart it.
 * @param {Object}                     options      Options.
 * @param {Element[]}                  options.rows Every row the button controls, in order (default: the anchor).
 * @return {HTMLButtonElement} The button.
 */
export function pauseButton(anchor, onChange, { rows = [anchor] } = {}) {
	const button = document.createElement('button');
	button.type = 'button';
	button.className = 'imet-motion-toggle';
	button.setAttribute('aria-label', __('Pause animation', 'imet-theme'));
	button.setAttribute('aria-pressed', 'false');
	button.addEventListener('click', () => {
		const stopped = button.getAttribute('aria-pressed') !== 'true';
		button.setAttribute('aria-pressed', stopped ? 'true' : 'false');
		onChange(stopped);
	});
	const control = document.createElement('div');
	control.className = 'imet-motion-control';
	control.appendChild(button);
	anchor.after(control);

	const first = rows[0];
	const last = rows[rows.length - 1];
	const place = () => {
		control.classList.remove('is-below', 'is-above', 'is-overlay');
		button.style.bottom = '';
		if (freeSpace(last, 'below') >= CONTROL_ROOM) {
			control.classList.add('is-below');
		} else if (freeSpace(first, 'above') >= CONTROL_ROOM) {
			control.classList.add('is-above');
			// The box sits after the last row: lift the button over every row to just above the first one.
			const lift =
				control.getBoundingClientRect().top -
				first.getBoundingClientRect().top;
			button.style.bottom = lift + CONTROL_GAP + 'px';
		} else {
			control.classList.add('is-overlay');
		}
	};
	const sync = () => {
		control.hidden = rows.every((row) =>
			row.classList.contains('is-static')
		);
	};
	sync();
	place();
	new window.MutationObserver(sync).observe(control.parentElement, {
		attributes: true,
		attributeFilter: ['class'],
		subtree: true,
	});
	let pending = 0;
	window.addEventListener('resize', () => {
		window.clearTimeout(pending);
		pending = window.setTimeout(place, 150);
	});
	return button;
}

/**
 * Marquee: the row glides left at `speed` px/s and loops without a jump (the items are repeated once,
 * marked .is-clone and hidden from screen readers and the tab order). It only moves while the row actually
 * overflows (so CSS decides per screen size), is on screen and isn't hovered, focused or touched; swiping still
 * works. A pause button after the row stops it until pressed again. Off for "reduce motion". `alwaysMove` keeps it gliding even when the items exactly fit the row (the copies
 * fill in behind them), for rows that should never sit still.
 * @param {Element}   row                Row that glides.
 * @param {Element[]} items              Items in the row.
 * @param {Object}    options            Options.
 * @param {number}    options.speed      Pixels per second.
 * @param {boolean}   options.alwaysMove Keep gliding when the items exactly fit.
 * @param {boolean}   options.control    Add the row's own pause button; false when one button controls several rows.
 * @return {{setStopped: (stop: boolean) => void}|null} Stops and restarts the row; null when nothing moves.
 */
export function marquee(
	row,
	items,
	{ speed = 40, alwaysMove = false, control = true } = {}
) {
	if (reduceMotion() || items.length < 2) {
		return null;
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
	let stopped = false;
	let visible = false;
	const tick = (now) => {
		window.requestAnimationFrame(tick);
		syncStatic();
		const dt = last ? Math.min(now - last, 100) : 0;
		last = now;
		const w = loopWidth();
		if (paused || stopped || !visible || w <= 0 || !overflows()) {
			if (
				!paused &&
				!stopped &&
				w > 0 &&
				!overflows() &&
				row.scrollLeft
			) {
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
	const setStopped = (stop) => {
		stopped = stop;
		row.classList.toggle('is-stopped', stop);
		if (!stop) {
			resume();
		}
	};
	if (control) {
		pauseButton(row, setStopped);
	}
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
	return { setStopped };
}

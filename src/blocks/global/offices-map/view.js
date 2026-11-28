/*
 * IMET Offices Map: turns the editable office list (.om-office.om-<key>: heading = tab name, paragraph = address) into
 * tabs, a world map and an address card. The map (map.svg, made by bin/build-world-map.mjs) loads only when the
 * section comes near the screen; its pins, arcs and countries carry data-office="<key>" to match the list.
 * Without JavaScript the list itself shows as cards.
 */
import { each, reduceMotion } from '../../../blocks-shared/view-helpers';

const CYCLE_MS = 4500;
let uid = 0;

function setup(section) {
	const offices = [...section.querySelectorAll('.om-office')]
		.map((el) => ({
			key: (
				[...el.classList].find((c) => /^om-[a-z]{2}$/.test(c)) || ''
			).slice(3),
			name:
				el
					.querySelector('h1, h2, h3, h4, h5, h6')
					?.textContent.trim() || '',
			address: el.querySelector('p')?.textContent.trim() || '',
		}))
		.filter((o) => o.key && o.name);
	const list = section.querySelector('.om-offices');
	if (!offices.length || !list) {
		return;
	}

	const id = `om-${++uid}`;
	const frame = document.createElement('div');
	frame.className = 'om-frame';

	const tabs = document.createElement('div');
	tabs.className = 'om-tabs';
	tabs.setAttribute('role', 'tablist');
	tabs.setAttribute(
		'aria-label',
		list.closest('section')?.querySelector('h2')?.textContent.trim() ||
			'Offices'
	);

	const stage = document.createElement('div');
	stage.className = 'om-stage';

	const card = document.createElement('div');
	card.className = 'om-card';
	card.id = `${id}-panel`;
	card.setAttribute('role', 'tabpanel');
	card.innerHTML =
		'<p class="om-card-kicker"></p><p class="om-card-title"></p>';
	const [kicker, title] = card.children;

	const buttons = offices.map((o, i) => {
		const b = document.createElement('button');
		b.type = 'button';
		b.className = 'om-tab';
		b.id = `${id}-tab-${i}`;
		b.textContent = o.name;
		b.setAttribute('role', 'tab');
		b.setAttribute('aria-controls', card.id);
		b.addEventListener('click', () => select(i, true));
		tabs.appendChild(b);
		return b;
	});

	stage.appendChild(card);
	frame.append(tabs, stage);
	list.after(frame);
	section.classList.add('is-enhanced');

	let current = -1;
	let stopped = reduceMotion();
	let visible = false;

	function select(i, byUser = false) {
		if (byUser) {
			stopped = true;
		}
		current = (i + offices.length) % offices.length;
		const o = offices[current];
		buttons.forEach((b, n) => {
			const on = n === current;
			b.classList.toggle('is-active', on);
			b.setAttribute('aria-selected', on ? 'true' : 'false');
			b.tabIndex = on ? 0 : -1;
		});
		card.setAttribute('aria-labelledby', buttons[current].id);
		// Keep the chosen tab in view when the tabs scroll sideways (phones), without moving the page.
		const b = buttons[current];
		if (
			b.offsetLeft < tabs.scrollLeft ||
			b.offsetLeft + b.offsetWidth > tabs.scrollLeft + tabs.clientWidth
		) {
			tabs.scrollTo({
				left: b.offsetLeft - 10,
				behavior: reduceMotion() ? 'auto' : 'smooth',
			});
		}
		kicker.textContent = `${String(current + 1).padStart(2, '0')} · ${o.name}`;
		title.textContent = o.address;
		stage
			.querySelectorAll('[data-office]')
			.forEach((el) =>
				el.classList.toggle('is-active', el.dataset.office === o.key)
			);
	}

	// Arrow keys move between tabs (WAI-ARIA tabs pattern, automatic activation).
	tabs.addEventListener('keydown', (e) => {
		const moves = {
			ArrowRight: 1,
			ArrowDown: 1,
			ArrowLeft: -1,
			ArrowUp: -1,
		};
		let next;
		if (e.key in moves) {
			next = current + moves[e.key];
		} else if (e.key === 'Home') {
			next = 0;
		} else if (e.key === 'End') {
			next = offices.length - 1;
		} else {
			return;
		}
		e.preventDefault();
		select(next, true);
		buttons[current].focus();
	});

	// Any interaction stops the gentle auto-tour.
	frame.addEventListener('pointerdown', () => (stopped = true));
	frame.addEventListener('focusin', () => (stopped = true));

	async function loadMap() {
		const url = section.dataset.map;
		if (!url) {
			return;
		}
		try {
			const res = await window.fetch(url);
			if (!res.ok) {
				return;
			}
			stage.insertAdjacentHTML('afterbegin', await res.text()); // the theme's own file
		} catch {
			return; // tabs and card still work without the map
		}
		stage.querySelectorAll('svg [data-office]').forEach((el) => {
			const i = offices.findIndex((o) => o.key === el.dataset.office);
			if (i < 0) {
				return;
			}
			el.classList.add('is-office');
			el.addEventListener('click', () => select(i, true));
		});
		stage.classList.add('is-loaded');
		select(current);
	}

	select(0);

	const io = new window.IntersectionObserver(
		(entries) => {
			entries.forEach((e) => {
				visible = e.isIntersecting;
				if (visible && !stage.classList.contains('is-loading')) {
					stage.classList.add('is-loading');
					loadMap();
				}
			});
		},
		{ rootMargin: '300px 0px' }
	);
	io.observe(frame);

	window.setInterval(() => {
		if (!stopped && visible && !document.hidden) {
			select(current + 1);
		}
	}, CYCLE_MS);
}

each('.wp-block-imet-offices-map', setup);

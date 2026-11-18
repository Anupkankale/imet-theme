/**
 * About Us, "What you gain with IMET": an interactive orbit (as on leadershipprograms.ca/about).
 *
 * The markup is core blocks: a group of six panels (.ab-gain-panel, each a heading and a paragraph) and an empty orbit
 * (.ab-orbit) holding the site logo. This script adds a numbered card, a row of chips and six icons on a ring around the
 * logo; hovering, focusing or clicking a chip or an icon shows its panel. It also steps through the panels every few
 * seconds until someone interacts (not with reduced motion). Without JavaScript every panel simply shows, one under another.
 */

const SECTION = '.ab-gain-intro';
const STEP_MS = 4000;

// Icons, in the panels' order around the ring (top, then clockwise). Stroke icons on a 24px grid, drawn in currentColor.
const ICONS = {
	doctorate:
		'<path d="M22 10 12 5 2 10l10 5 10-5Z"/><path d="M6 12v5c3 2 9 2 12 0v-5"/><path d="M22 10v6"/>',
	research:
		'<path d="M3 3v18h18"/><path d="M7 17v-4M11 17v-7"/><circle cx="16.5" cy="8.5" r="3.5"/><path d="m21 13-2-2"/>',
	speaking:
		'<rect x="9" y="2" width="6" height="12" rx="3"/><path d="M5 10a7 7 0 0 0 14 0M12 17v5M8 22h8"/>',
	flexible: '<circle cx="12" cy="12" r="9"/><path d="m8 12 3 3 5-6"/>',
	scholarship:
		'<circle cx="14" cy="12" r="8"/><path d="M16.5 9.2c-.6-.7-1.5-1-2.5-1-1.4 0-2.5.7-2.5 1.8 0 2.4 5 1.2 5 3.6 0 1.1-1.1 1.8-2.5 1.8-1 0-2-.4-2.6-1.1M14 6.5v1.7M14 15.8v1.7M1 9h3M1 12h2M1 15h3"/>',
	branding:
		'<path d="m3 11 15-6v14L3 13v-2Z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/>',
};

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

/**
 * The panel's icon key, from its class (ab-gain-doctorate, ab-gain-research, ...).
 *
 * @param {HTMLElement} panel Panel.
 * @return {string} Icon key, or an empty string.
 */
const iconKey = (panel) =>
	[...panel.classList]
		.find((name) => name.startsWith('ab-gain-') && name !== 'ab-gain-panel')
		?.replace('ab-gain-', '') ?? '';

/**
 * An inline SVG icon.
 *
 * @param {string} key Icon key.
 * @return {string} SVG markup.
 */
const svg = (key) =>
	`<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">${ICONS[key] || ICONS.doctorate}</svg>`;

document.querySelectorAll(SECTION).forEach((section, s) => {
	const wrap = section.querySelector('.ab-gain-panels');
	const panels = [...section.querySelectorAll('.ab-gain-panel')];
	if (!wrap || panels.length < 2) {
		return;
	}
	const orbit = section.querySelector('.ab-orbit');

	// Chips: the accessible controls (a tab list).
	const chips = document.createElement('div');
	chips.className = 'ab-gain-chips';
	chips.setAttribute('role', 'tablist');
	chips.setAttribute('aria-label', 'What you gain with IMET');

	const tabs = panels.map((panel, i) => {
		const id = `ab-gain-${s}-${i}`;
		const title = panel.querySelector('h3, h4')?.textContent.trim() || '';

		panel.id = `${id}-panel`;
		panel.setAttribute('role', 'tabpanel');
		panel.setAttribute('aria-labelledby', `${id}-tab`);

		const num = document.createElement('span');
		num.className = 'ab-gain-num';
		num.setAttribute('aria-hidden', 'true');
		num.textContent = String(i + 1).padStart(2, '0');
		panel.prepend(num);

		const tab = document.createElement('button');
		tab.type = 'button';
		tab.id = `${id}-tab`;
		tab.className = 'ab-gain-chip';
		tab.setAttribute('role', 'tab');
		tab.setAttribute('aria-controls', panel.id);
		tab.textContent = title;
		chips.append(tab);
		return tab;
	});

	wrap.after(chips);

	// Icons on the ring: pointer targets only (the chips carry the keyboard and screen-reader controls).
	const nodes = [];
	if (orbit) {
		const ring = document.createElement('div');
		ring.className = 'ab-orbit-ring';
		ring.setAttribute('aria-hidden', 'true');
		panels.forEach((panel, i) => {
			const node = document.createElement('span');
			node.className = 'ab-orbit-node';
			node.style.setProperty(
				'--angle',
				`${-90 + (360 / panels.length) * i}deg`
			);
			node.innerHTML = svg(iconKey(panel));
			ring.append(node);
			nodes.push(node);
		});
		orbit.append(ring);
	}

	let active = 0;
	let timer = null;
	let stopped = false;

	const show = (index) => {
		active = (index + panels.length) % panels.length;
		panels.forEach((panel, i) => {
			const on = i === active;
			// The panels share one grid cell (the card keeps the tallest one's height, so nothing below jumps); the
			// others are faded out and taken out of reach.
			panel.inert = !on;
			panel.setAttribute('aria-hidden', on ? 'false' : 'true');
			panel.classList.toggle('is-active', on);
			tabs[i].classList.toggle('is-active', on);
			tabs[i].setAttribute('aria-selected', on ? 'true' : 'false');
			tabs[i].tabIndex = on ? 0 : -1;
			nodes[i]?.classList.toggle('is-active', on);
		});
	};

	const pause = () => {
		clearInterval(timer);
		timer = null;
	};

	const play = () => {
		if (stopped || timer || reduceMotion.matches) {
			return;
		}
		timer = setInterval(() => show(active + 1), STEP_MS);
	};

	// Hover or focus shows a panel; a click (or a key) also stops the automatic stepping for good.
	const bind = (el, i) => {
		el.addEventListener('mouseenter', () => show(i));
		el.addEventListener('focus', () => show(i));
		el.addEventListener('click', () => {
			stopped = true;
			pause();
			show(i);
		});
	};
	tabs.forEach(bind);
	nodes.forEach(bind);

	// Arrow keys, Home and End move between chips (the usual tab-list keys).
	chips.addEventListener('keydown', (event) => {
		const keys = {
			ArrowRight: active + 1,
			ArrowDown: active + 1,
			ArrowLeft: active - 1,
			ArrowUp: active - 1,
			Home: 0,
			End: panels.length - 1,
		};
		if (!(event.key in keys)) {
			return;
		}
		event.preventDefault();
		stopped = true;
		pause();
		show(keys[event.key]);
		tabs[active].focus();
	});

	section.addEventListener('mouseenter', pause);
	section.addEventListener('mouseleave', play);
	section.addEventListener('focusin', pause);
	section.addEventListener('focusout', (event) => {
		if (!section.contains(event.relatedTarget)) {
			play();
		}
	});
	reduceMotion.addEventListener('change', () =>
		reduceMotion.matches ? pause() : play()
	);

	show(0);
	section.classList.add('is-ready');
	play();
});

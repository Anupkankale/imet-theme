/**
 * About Us, "Study from anywhere": an interactive map of the partner centres (as on leadershipprograms.ca).
 *
 * The markup is core blocks: the partner-centre cards (.ab-loc) and a map picture (.ab-map-img). This script swaps the
 * picture for the theme's world map (assets/images/imet/world-map.svg, loaded next to the picture), with a pin for every
 * centre and dashed routes from Dubai. Hovering, focusing or clicking a pin or a partner-centre card selects its region:
 * its countries turn navy and its pins are labelled. The map also steps through the regions every few seconds until
 * someone interacts (not with reduced motion). Without JavaScript, or if the map can't load, the picture stays.
 */

const SECTION = '.ab-map';
const STEP_MS = 4500;
const SVG_NS = 'http://www.w3.org/2000/svg';

// Shown part of the 950 x 620 map: no Antarctica, so the inhabited world fills the card.
const VIEW = '40 45 880 450';

// Where the routes start: IMET's Dubai office.
const HUB = [604, 262];

/*
 * Partner centres. "shapes" are the countries' indexes in world-map.svg (its paths have no ids); "pin" is the centre in
 * the map's own units; "match" finds the centre's card in the page by its country name.
 */
const CENTRES = {
	canada: {
		label: 'Canada',
		partner: 'Agile School',
		match: 'canada',
		shapes: [226],
		pin: [258, 190],
	},
	netherlands: {
		label: 'Netherlands',
		partner: 'Anima Academy',
		match: 'netherlands',
		shapes: [310],
		pin: [467, 172],
	},
	uae: {
		label: 'UAE',
		partner: 'MBA4Managers, Dubai',
		match: 'dubai',
		shapes: [282],
		pin: HUB,
	},
	singapore: {
		label: 'Singapore',
		partner: 'ZOC Learnings',
		match: 'singapore',
		shapes: [],
		pin: [745, 333],
	},
	australia: {
		label: 'Australia',
		partner: 'Hobnobglobal, Melbourne',
		match: 'australia',
		shapes: [71],
		pin: [843, 468],
	},
};

const REGIONS = [
	{ name: 'North America', centres: ['canada'] },
	{ name: 'Europe', centres: ['netherlands'] },
	{ name: 'Middle East', centres: ['uae'] },
	{ name: 'Asia Pacific', centres: ['singapore', 'australia'] },
];

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

/**
 * Create an SVG element.
 *
 * @param {string}                 tag   Tag name.
 * @param {Object<string, string>} attrs Attributes.
 * @return {SVGElement} Element.
 */
const el = (tag, attrs = {}) => {
	const node = document.createElementNS(SVG_NS, tag);
	Object.entries(attrs).forEach(([key, value]) =>
		node.setAttribute(key, String(value))
	);
	return node;
};

/**
 * A curved route from the hub to a pin, bowing upward.
 *
 * @param {number[]} to Pin.
 * @return {string} Path data.
 */
const route = ([x2, y2]) => {
	const [x1, y1] = HUB;
	const lift = Math.hypot(x2 - x1, y2 - y1) * 0.3;
	const cx = (x1 + x2) / 2;
	const cy = Math.min(y1, y2) - lift;
	return `M${x1} ${y1} Q${cx} ${cy} ${x2} ${y2}`;
};

/**
 * Build the interactive map for one section.
 *
 * @param {HTMLElement} section Section.
 * @param {HTMLElement} figure  The map picture's figure.
 * @param {string}      source  The world map's SVG markup.
 */
const build = (section, figure, source) => {
	const parsed = new window.DOMParser().parseFromString(
		source,
		'image/svg+xml'
	);
	const svg = parsed.documentElement;
	if (svg.nodeName !== 'svg') {
		return;
	}
	const shapes = [...svg.querySelectorAll('path')];

	svg.removeAttribute('width');
	svg.removeAttribute('height');
	svg.setAttribute('viewBox', VIEW);
	svg.setAttribute('class', 'pm-svg');
	svg.setAttribute('aria-hidden', 'true');
	svg.setAttribute('focusable', 'false');

	const routes = el('g', { class: 'pm-routes' });
	const pins = el('g', { class: 'pm-pins' });
	svg.append(routes, pins);

	// Countries, routes and pins per centre.
	const parts = {};
	Object.entries(CENTRES).forEach(([key, centre]) => {
		const countries = centre.shapes.map((i) => shapes[i]).filter(Boolean);
		countries.forEach((shape) => shape.classList.add('pm-partner'));

		let line = null;
		if (centre.pin !== HUB) {
			line = el('path', { class: 'pm-route', d: route(centre.pin) });
			routes.append(line);
		}

		const [x, y] = centre.pin;
		const pin = el('g', {
			class: 'pm-pin',
			transform: `translate(${x} ${y})`,
		});
		// A country too small to see on this map (Singapore) gets a disc instead, which turns navy like a country.
		if (!countries.length) {
			pin.append(el('circle', { class: 'pm-spot', r: 15 }));
		}
		pin.append(
			el('circle', { class: 'pm-halo', r: 13 }),
			el('circle', { class: 'pm-dot', r: 5.5 })
		);
		const text = el('text', { class: 'pm-label', y: -12 });
		text.textContent = centre.label;
		pin.append(text);
		pins.append(pin);

		parts[key] = { countries, line, pin };
	});

	// The card holding the map.
	const card = document.createElement('div');
	card.className = 'pm-card';

	const stage = document.createElement('div');
	stage.className = 'pm-stage';
	stage.append(svg);

	card.append(stage);
	figure.replaceWith(card);

	// The partner-centre cards beside the map select their region too.
	const cards = [...section.querySelectorAll('.ab-loc')];
	const regionOf = (key) => REGIONS.findIndex((r) => r.centres.includes(key));
	const cardRegions = cards.map((item) => {
		const name =
			item.querySelector('.ab-loc-country')?.textContent.toLowerCase() ||
			'';
		const key = Object.keys(CENTRES).find((k) =>
			name.includes(CENTRES[k].match)
		);
		return key ? regionOf(key) : -1;
	});

	let active = -1;
	let timer = null;
	let stopped = false;

	const show = (index) => {
		active = (index + REGIONS.length) % REGIONS.length;
		const region = REGIONS[active];

		Object.entries(parts).forEach(([key, part]) => {
			const on = region.centres.includes(key);
			part.countries.forEach((shape) =>
				shape.classList.toggle('pm-on', on)
			);
			part.line?.classList.toggle('pm-on', on);
			part.pin.classList.toggle('pm-on', on);
		});
		cards.forEach((item, i) =>
			item.classList.toggle('is-active', cardRegions[i] === active)
		);
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

	const stop = () => {
		stopped = true;
		pause();
	};

	// Hover or focus selects a region; a click also stops the automatic stepping for good.
	const bind = (target, region) => {
		if (region < 0) {
			return;
		}
		target.addEventListener('mouseenter', () => show(region));
		target.addEventListener('focusin', () => show(region));
		target.addEventListener('click', () => {
			stop();
			show(region);
		});
	};
	cards.forEach((item, i) => bind(item, cardRegions[i]));
	Object.entries(parts).forEach(([key, part]) =>
		bind(part.pin, regionOf(key))
	);

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
};

document.querySelectorAll(SECTION).forEach((section) => {
	const figure = section.querySelector('.ab-map-img');
	const img = figure?.querySelector('img');
	if (!img) {
		return;
	}
	// The world map sits next to the picture in the theme's images folder.
	const url = img.src.replace(/[^/]+$/, 'world-map.svg');

	fetch(url, { credentials: 'same-origin' })
		.then((response) => (response.ok ? response.text() : ''))
		.then((source) => source && build(section, figure, source))
		.catch(() => {}); // keep the picture
});

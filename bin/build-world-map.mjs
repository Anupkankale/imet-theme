/**
 * Builds src/blocks/global/offices-map/map.svg: the world map of the IMET Offices Map block
 * (country shapes, the office countries tagged, a pin per office and an arc from the hub to each one).
 *
 * The map data is a one-off input, so its libraries are not theme dependencies. To rebuild (e.g. a new office):
 *   mkdir -p /tmp/mapgen && npm i --prefix /tmp/mapgen d3-geo@3.1.1 topojson-client@3.1.0 world-atlas@2.0.2
 *   MAPGEN_MODULES=/tmp/mapgen node bin/build-world-map.mjs
 *
 * Office keys (`ae`, `in`…) match the `om-office om-<key>` classes of the block's editable office list.
 */
import { createRequire } from 'node:module';
import { writeFileSync } from 'node:fs';
import { resolve } from 'node:path';

const require = createRequire(
	resolve(process.env.MAPGEN_MODULES || '.', 'package.json')
);
const { geoMercator, geoPath } = require('d3-geo');
const { feature } = require('topojson-client');
const world = require('world-atlas/countries-110m.json');

const OFFICES = [
	// key, ISO 3166 numeric country id, label on the map, [lon, lat]
	['ae', '784', 'Dubai', [55.3, 25.26]],
	['in', '356', 'Navi Mumbai', [73.0, 19.08]],
	['us', '840', 'New Jersey', [-74.4, 40.43]],
	['gb', '826', 'London', [-0.14, 51.52]],
	['de', '276', 'Düsseldorf', [6.78, 51.23]],
];
const HUB = 'ae';
const WIDTH = 1000;

const countries = feature(world, world.objects.countries).features.filter(
	(f) => f.id !== '010' // Antarctica
);
const projection = geoMercator()
	.rotate([-10, 0])
	.fitWidth(WIDTH, { type: 'FeatureCollection', features: countries });
const path = geoPath(projection).digits(0);

// Crop the far north and south (Greenland's tip, Southern Ocean islands).
const [, top] = projection([0, 75]);
const [, bottom] = projection([0, -52]);
const round = (n) => Math.round(n * 10) / 10;
const viewBox = `0 ${round(top)} ${WIDTH} ${round(bottom - top)}`;

const tagged = Object.fromEntries(OFFICES.map(([key, id]) => [id, key]));
const shapes = countries
	.map((f) => {
		const d = path(f);
		if (!d) {
			return '';
		}
		const key = tagged[f.id];
		return key
			? `<path class="om-land om-land-${key}" data-office="${key}" d="${d}"/>`
			: `<path class="om-land" d="${d}"/>`;
	})
	.join('');

const points = Object.fromEntries(
	OFFICES.map(([key, , , lonLat]) => [key, projection(lonLat).map(round)])
);
const [hx, hy] = points[HUB];

// Arcs bow upwards (north), like flight paths on a flat map.
const arcs = OFFICES.filter(([key]) => key !== HUB)
	.map(([key]) => {
		const [x, y] = points[key];
		const dist = Math.hypot(x - hx, y - hy);
		const cx = round((x + hx) / 2);
		const cy = round(Math.min(y, hy) - dist * 0.32);
		return `<path class="om-arc" data-office="${key}" d="M${hx} ${hy}Q${cx} ${cy} ${x} ${y}"/>`;
	})
	.join('');

const pins = OFFICES.map(([key, , label]) => {
	const [x, y] = points[key];
	return (
		`<g class="om-pin${key === HUB ? ' is-hub' : ''}" data-office="${key}" transform="translate(${x} ${y})">` +
		`<circle class="om-pin-halo" r="9"/><circle class="om-pin-ring" r="5.5"/><circle class="om-pin-dot" r="3"/>` +
		`<text class="om-pin-label" y="-14" text-anchor="middle">${label}</text></g>`
	);
}).join('');

const svg =
	`<svg class="om-svg" xmlns="http://www.w3.org/2000/svg" viewBox="${viewBox}" role="img" aria-hidden="true" focusable="false" preserveAspectRatio="xMidYMid meet">` +
	`<g class="om-lands">${shapes}</g><g class="om-arcs">${arcs}</g><g class="om-pins">${pins}</g></svg>\n`;

const out = resolve('src/blocks/global/offices-map/map.svg');
writeFileSync(out, svg);
// eslint-disable-next-line no-console
console.log(
	`Wrote ${out} (${(svg.length / 1024).toFixed(1)} KB), viewBox ${viewBox}`
);

#!/usr/bin/env node
/* eslint no-console: 0 */

/**
 * Design-token audit: no raw sizes or colours outside theme.json.
 *
 * Fails (exit 1) when templates, parts, patterns, block-style partials or the SCSS contain a raw px/rem/em value
 * or a hard-coded colour. Allowed: 0, 1px borders, comments, media queries (CSS can't use variables there; see
 * src/css/shared/_breakpoints.scss), SVG data URIs. Also lists padding pairs whose sides differ, for review.
 *
 * The section blocks ported from the old plugin (src/blocks, src/blocks-shared) are on a ratchet: the count of raw
 * values per file is stored in bin/audit-tokens-baseline.json and may only go down. Convert a value to a token, then
 * run `node bin/audit-tokens.js --update-baseline` to lower the count. A line with `token-ok: reason` is skipped.
 */
const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');
const targets = [
	['templates', ['.html']],
	['parts', ['.html']],
	['patterns', ['.php']],
	['styles/blocks', ['.json']],
	['src/css', ['.scss']],
];
const ratchetTargets = [
	['src/blocks', ['.scss']],
	['src/blocks-shared', ['.scss']],
];
const baselineFile = path.join(__dirname, 'audit-tokens-baseline.json');
const baseline = fs.existsSync(baselineFile)
	? JSON.parse(fs.readFileSync(baselineFile, 'utf8'))
	: {};
const counts = {};
const skipFiles = ['_breakpoints.scss'];

const walk = (dir, exts) =>
	fs.readdirSync(dir, { withFileTypes: true }).flatMap((e) => {
		const full = path.join(dir, e.name);
		if (e.isDirectory()) {
			return walk(full, exts);
		}
		return exts.includes(path.extname(e.name)) &&
			!skipFiles.includes(e.name)
			? [full]
			: [];
	});

const RAW = /(?<![\w.#-])-?\d*\.?\d+(?:px|rem|em)\b/g;
const COLOR = /#[0-9a-fA-F]{3,8}\b|\brgba?\(/g;
const hits = [];
const asymmetric = [];

// Every preset/custom variable the code uses must exist in theme.json (WordPress kebab-cases keys, so s28 would be s-28).
const theme = JSON.parse(
	fs.readFileSync(path.join(root, 'theme.json'), 'utf8')
).settings;
const kebab = (k) => k.replace(/([a-z])([A-Z])/g, '$1-$2').toLowerCase();
const defined = new Set();
const preset = (group, list) =>
	list.forEach((x) => defined.add(`--wp--preset--${group}--${x.slug}`));
preset('spacing', theme.spacing.spacingSizes);
preset('font-size', theme.typography.fontSizes);
preset('font-family', theme.typography.fontFamilies);
preset('border-radius', theme.border.radiusSizes);
preset('color', theme.color.palette);
preset('shadow', theme.shadow.presets);
const addCustom = (obj, prefix) =>
	Object.entries(obj).forEach(([k, v]) =>
		typeof v === 'object'
			? addCustom(v, `${prefix}--${kebab(k)}`)
			: defined.add(`${prefix}--${kebab(k)}`)
	);
addCustom(theme.custom, '--wp--custom');
const undefinedVars = new Set();

for (const [dir, exts, ratchet] of [
	...targets,
	...ratchetTargets.map((t) => [...t, true]),
]) {
	const base = path.join(root, dir);
	if (!fs.existsSync(base)) {
		continue;
	}
	for (const file of walk(base, exts)) {
		const rel = path.relative(root, file);
		fs.readFileSync(file, 'utf8')
			.split('\n')
			.forEach((line, i) => {
				let text = line
					.replace(/url\(\s*["']?data:[^)]*\)/g, 'url()')
					.replace(/href="#[^"]*"/g, 'href=""')
					.replace(/\/\/.*$/, '');
				if (
					/^\s*(@media|\*|\/\*)/.test(text) ||
					/\*\/\s*$/.test(text)
				) {
					return;
				}
				text = text.replace(/\/\*.*?\*\//g, '');
				const raw = (text.match(RAW) || []).filter(
					(v) => !/^1px$/.test(v) && !/^0(px|rem|em)$/.test(v)
				);
				const colors = text.match(COLOR) || [];
				for (const m of text.matchAll(
					/var\((--wp--(?:preset|custom)--[a-z0-9-]+)/g
				)) {
					if (
						!defined.has(m[1]) &&
						!m[1].startsWith('--wp--preset--gradient')
					) {
						undefinedVars.add(`${rel}:${i + 1}  ${m[1]}`);
					}
				}
				if ((raw.length || colors.length) && ratchet) {
					if (!/token-ok:/.test(line)) {
						counts[rel] =
							(counts[rel] ?? 0) + raw.length + colors.length;
					}
				} else if (raw.length || colors.length) {
					hits.push(
						`${rel}:${i + 1}  ${[...raw, ...colors].join(' ')}`
					);
				}
				const pad = text.match(/"padding":\{([^}]*)\}/);
				if (pad) {
					const sides = Object.fromEntries(
						[
							...pad[1].matchAll(
								/"(top|bottom|left|right)":"([^"]*)"/g
							),
						].map((m) => [m[1], m[2]])
					);
					if (
						(sides.top ?? sides.bottom) !==
							(sides.bottom ?? sides.top) ||
						(sides.left ?? sides.right) !==
							(sides.right ?? sides.left)
					) {
						asymmetric.push(`${rel}:${i + 1}  ${pad[1]}`);
					}
				}
			});
	}
}

if (process.argv.includes('--update-baseline')) {
	fs.writeFileSync(baselineFile, `${JSON.stringify(counts, null, '\t')}\n`);
	console.log(`Baseline written for ${Object.keys(counts).length} file(s).`);
	process.exit(0);
}
for (const [file, count] of Object.entries(counts)) {
	if (count > (baseline[file] ?? 0)) {
		hits.push(
			`${file}  ${count} raw value(s), baseline allows ${baseline[file] ?? 0}`
		);
	}
}
if (asymmetric.length) {
	console.log(
		`Review: ${asymmetric.length} padding set(s) with unequal sides:\n  ${asymmetric.join('\n  ')}\n`
	);
}
if (undefinedVars.size) {
	console.error(
		`Undefined token(s): not in theme.json, so the declaration silently does nothing.\n  ${[...undefinedVars].join('\n  ')}`
	);
	process.exitCode = 1;
}
if (hits.length) {
	console.error(
		`Token audit failed: ${hits.length} raw value(s). Add a token to theme.json and use it instead.\n  ${hits.join('\n  ')}`
	);
	process.exit(1);
}
if (!process.exitCode) {
	console.log(
		'Token audit passed: no raw sizes or colours outside theme.json, every token defined.'
	);
}

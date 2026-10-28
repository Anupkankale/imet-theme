#!/usr/bin/env node
/* eslint no-console: 0 */

/**
 * Full-page screenshots of published pages at 1440 and 390 px, for before/after comparison.
 *
 *   node bin/shoot.js <out-dir> [--playwright /path] [--url http://imetworld.local] <page ids...>
 *
 * Compare two runs with `node bin/shoot.js --compare <dir-a> <dir-b>` (byte-identical PNGs = no visual change).
 */
const fs = require('fs');
const path = require('path');

const args = process.argv.slice(2);
const option = (name, fallback) => {
	const i = args.indexOf(`--${name}`);
	return i >= 0 ? args[i + 1] : fallback;
};

if (args[0] === '--compare') {
	const [a, b] = [args[1], args[2]];
	let diff = 0;
	for (const f of fs.readdirSync(a)) {
		const same =
			fs.existsSync(path.join(b, f)) &&
			fs.readFileSync(path.join(a, f)).equals(fs.readFileSync(path.join(b, f)));
		console.log(`${same ? 'same' : 'DIFF'}  ${f}`);
		diff += same ? 0 : 1;
	}
	process.exit(diff ? 1 : 0);
}

const { chromium } = require(
	option('playwright', path.resolve(__dirname, '../node_modules/playwright'))
);
const base = option('url', 'http://imetworld.local');
const out = args[0];
const ids = args.filter((a, i) => /^\d+$/.test(a) && !args[i - 1]?.startsWith('--'));

(async () => {
	fs.mkdirSync(out, { recursive: true });
	const browser = await chromium.launch();
	for (const [name, width] of [['desktop', 1440], ['phone', 390]]) {
		const page = await (await browser.newContext({ viewport: { width, height: 900 } })).newPage();
		for (const id of ids) {
			await page.goto(`${base}/?page_id=${id}`, { waitUntil: 'networkidle' });
			// Freeze moving parts (marquees, smooth scroll) so two runs can match byte for byte.
			await page.addStyleTag({ content: '*,*::before,*::after{animation:none!important;transition:none!important;scroll-behavior:auto!important}' });
			await page.evaluate(() => document.querySelectorAll('[class*="is-clone"]').forEach((e) => e.remove()));
			await page.waitForTimeout(400);
			await page.screenshot({ path: path.join(out, `${id}-${name}.png`), fullPage: true });
		}
	}
	await browser.close();
})();

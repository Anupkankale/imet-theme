#!/usr/bin/env node
/* eslint no-console: 0 */

/**
 * Layout audit: opens a page at desktop, laptop, tablet and phone widths and reports what breaks the layout rhythm.
 *
 *   node bin/audit-layout.js <page id or url> [--playwright /path] [--url http://imetworld.local] [--json out.json]
 *
 * Per viewport it reports: horizontal overflow, each section's padding, height and side gutters, heading sizes,
 * the font sizes / families in use per tag, text boxes that overflow their parent, and tap targets under 44 px.
 */
const fs = require('fs');
const path = require('path');

const args = process.argv.slice(2);
const option = (name, fallback) => {
	const i = args.indexOf(`--${name}`);
	return i >= 0 ? args[i + 1] : fallback;
};
const { chromium } = require(
	option('playwright', path.resolve(__dirname, '../node_modules/playwright'))
);
const base = option('url', 'http://imetworld.local');
const target = args.find(
	(a, i) => !a.startsWith('--') && !args[i - 1]?.startsWith('--')
);
const pageUrl = /^\d+$/.test(target) ? `${base}/?page_id=${target}` : target;
const viewports = [
	['desktop', 1440, 900],
	['laptop', 1024, 768],
	['tablet', 768, 1024],
	['phone', 390, 844],
];

/* Runs in the browser. */
const measure = () => {
	const px = (v) => Math.round(parseFloat(v) * 10) / 10;
	const vw = document.documentElement.clientWidth;
	const label = (el) =>
		[...el.classList]
			.filter((c) => !c.startsWith('wp-'))
			.slice(0, 4)
			.join('.') || el.tagName.toLowerCase();
	const sections = [
		...document.querySelectorAll('.wp-block-post-content > .imet-section'),
	].map((s) => {
		const cs = window.getComputedStyle(s);
		const r = s.getBoundingClientRect();
		let left = Infinity;
		let right = -Infinity;
		s.querySelectorAll('*').forEach((el) => {
			const b = el.getBoundingClientRect();
			if (
				b.width > 0 &&
				b.height > 0 &&
				window.getComputedStyle(el).position !== 'fixed' &&
				!el.closest('.is-clone, [aria-hidden="true"]')
			) {
				left = Math.min(left, b.left);
				right = Math.max(right, b.right);
			}
		});
		const h = s.querySelector('h1, h2');
		const hs = h && window.getComputedStyle(h);
		return {
			section: label(s),
			padTop: px(cs.paddingTop),
			padBottom: px(cs.paddingBottom),
			height: Math.round(r.height),
			gutterL: Math.round(left),
			gutterR: Math.round(vw - right),
			heading: h
				? `${h.tagName} ${px(hs.fontSize)}px/${hs.fontWeight}/${px(hs.lineHeight)}`
				: '-',
		};
	});
	const fonts = {};
	document
		.querySelectorAll(
			'.wp-block-post-content :is(h1,h2,h3,h4,p,li,a,button,span,summary)'
		)
		.forEach((el) => {
			if (
				!el.textContent.trim() ||
				el.closest('[aria-hidden="true"], .is-clone')
			) {
				return;
			}
			const cs = window.getComputedStyle(el);
			const fam = cs.fontFamily.split(',')[0].replace(/["']/g, '').trim();
			const key = `${el.tagName.toLowerCase()} ${px(cs.fontSize)}px ${cs.fontWeight}`;
			fonts[key] = fonts[key] || { n: 0, fam: new Set() };
			fonts[key].n += 1;
			fonts[key].fam.add(fam);
		});
	const families = {};
	Object.values(fonts).forEach((f) =>
		f.fam.forEach((x) => (families[x] = (families[x] || 0) + f.n))
	);
	const overflow = [];
	document.querySelectorAll('.wp-block-post-content *').forEach((el) => {
		const cs = window.getComputedStyle(el);
		if (
			el.closest(
				'.h-grads, .spec-grid.is-marquee, [class*="marquee"], .is-clone, [aria-hidden="true"]'
			) ||
			cs.display === 'none'
		) {
			return;
		}
		if (
			el.scrollWidth > el.clientWidth + 2 &&
			el.clientWidth > 0 &&
			cs.overflowX === 'visible'
		) {
			overflow.push(`${label(el)} (${el.scrollWidth}>${el.clientWidth})`);
		}
	});
	const small = [];
	document
		.querySelectorAll('.wp-block-post-content :is(a, button, summary)')
		.forEach((el) => {
			const r = el.getBoundingClientRect();
			if (
				r.width > 0 &&
				r.height > 0 &&
				r.height < 44 &&
				el.textContent.trim() &&
				!el.closest('p, li, h1, h2, h3, .is-clone')
			) {
				small.push(
					`${label(el)} "${el.textContent.trim().slice(0, 24)}" ${Math.round(r.width)}x${Math.round(r.height)}`
				);
			}
		});
	return {
		pageOverflow: document.documentElement.scrollWidth - vw,
		sections,
		families,
		fonts: Object.entries(fonts).map(
			([k, v]) => `${k} ×${v.n} [${[...v.fam].join('|')}]`
		),
		overflow: overflow.slice(0, 12),
		small: small.slice(0, 12),
	};
};

(async () => {
	const browser = await chromium.launch();
	const report = {};
	for (const [name, width, height] of viewports) {
		const page = await (
			await browser.newContext({ viewport: { width, height } })
		).newPage();
		await page.goto(pageUrl, { waitUntil: 'networkidle' });
		await page.addStyleTag({
			content: '*{animation:none!important;transition:none!important}',
		});
		await page.evaluate(async () => {
			for (let y = 0; y < document.body.scrollHeight; y += 600) {
				window.scrollTo(0, y);
				await new Promise((resolve) => window.setTimeout(resolve, 60));
			}
			window.scrollTo(0, 0);
		});
		await page.waitForTimeout(300);
		report[name] = await page.evaluate(measure);
		await page.close();
	}
	await browser.close();
	const out = option('json', '');
	if (out) {
		fs.writeFileSync(out, JSON.stringify(report, null, 2));
	}
	for (const [name, r] of Object.entries(report)) {
		console.log(
			`\n=== ${name} ===  page overflow: ${r.pageOverflow}px  families: ${JSON.stringify(r.families)}`
		);
		r.sections.forEach((s) =>
			console.log(
				`${s.section.padEnd(34)} pad ${String(s.padTop).padStart(5)}/${String(s.padBottom).padEnd(5)} h ${String(s.height).padStart(5)}  gutter ${String(s.gutterL).padStart(4)}|${String(s.gutterR).padEnd(4)} ${s.heading}`
			)
		);
		if (r.overflow.length) {
			console.log('overflowing:', r.overflow.join('; '));
		}
		if (r.small.length) {
			console.log('small tap targets:', r.small.join('; '));
		}
	}
})();

#!/usr/bin/env node
/* eslint no-console: 0 */

/**
 * Editor check for the IMET section blocks: opens pages in the block editor and fails when any `imet/*` block is
 * invalid ("unexpected or invalid content"), or when a block is missing or became a Classic block.
 *
 * Needs Playwright and WP-CLI (the site is the one WP-CLI points at). A temporary administrator is created for the
 * run and always deleted afterwards.
 *
 *   node bin/verify-blocks.js [--url http://imetworld.local] [--wp "wp --path=/path/to/site"]
 *                             [--playwright /path/to/node_modules/playwright] [page ids...]
 *
 * Without ids it checks every page and post that contains an `imet/` block.
 */
const { execSync } = require('child_process');
const path = require('path');

const args = process.argv.slice(2);
const option = (name, fallback) => {
	const i = args.indexOf(`--${name}`);
	return i >= 0 ? args[i + 1] : fallback;
};
const baseUrl = option('url', 'http://imetworld.local');
const wp = option('wp', 'wp');
const ids = args.filter(
	(a, i) => /^\d+$/.test(a) && !args[i - 1]?.startsWith('--')
);

// --playwright points at a Playwright whose browsers are installed (the theme's own may need `npx playwright install`).
const { chromium } = require(
	option('playwright', path.resolve(__dirname, '../node_modules/playwright'))
);

const sh = (cmd) => execSync(cmd, { encoding: 'utf8' }).trim();
const user = `e2e-tmp-${Date.now()}`;
const pass = `Pw-${Math.random().toString(36).slice(2)}-x9!`;

(async () => {
	const targets = ids.length
		? ids
		: sh(
				`${wp} post list --post_type=page,post --post_status=any --s="wp:imet/" --field=ID`
			)
				.split('\n')
				.filter(Boolean);

	sh(
		`${wp} user create ${user} ${user}@example.com --role=administrator --user_pass='${pass}'`
	);
	const browser = await chromium.launch();
	let failed = 0;
	try {
		const page = await (
			await browser.newContext({ viewport: { width: 1440, height: 900 } })
		).newPage();
		await page.goto(`${baseUrl}/wp-login.php`);
		await page.fill('#user_login', user);
		await page.fill('#user_pass', pass);
		await page.click('#wp-submit');
		await page.waitForURL(/wp-admin/);

		for (const id of targets) {
			await page.goto(
				`${baseUrl}/wp-admin/post.php?post=${id}&action=edit`
			);
			try {
				await page.waitForFunction(
					() =>
						window.wp?.data
							?.select('core/block-editor')
							?.getBlockCount() > 0,
					null,
					{ timeout: 60000 }
				);
			} catch {
				console.log(`#${id}  FAIL  editor did not load any blocks`);
				failed++;
				continue;
			}
			await page.waitForTimeout(1500); // validation runs as the blocks mount
			const report = await page.evaluate(() => {
				const all = [];
				const walk = (list) =>
					list.forEach((b) => {
						all.push(b);
						walk(b.innerBlocks);
					});
				walk(window.wp.data.select('core/block-editor').getBlocks());
				return {
					total: all.length,
					imet: all.filter((b) => b.name.startsWith('imet/')).length,
					bad: all
						.filter(
							(b) =>
								!b.isValid ||
								['core/freeform', 'core/missing'].includes(
									b.name
								)
						)
						.map(
							(b) => `${b.name}${b.isValid ? '' : ' (invalid)'}`
						),
				};
			});
			const ok = report.bad.length === 0;
			console.log(
				`#${id}  ${ok ? 'ok  ' : 'FAIL'}  ${report.imet} imet blocks of ${report.total}${ok ? '' : `  → ${report.bad.join(', ')}`}`
			);
			failed += ok ? 0 : 1;
		}
	} finally {
		await browser.close();
		sh(`${wp} user delete ${user} --yes`);
	}
	console.log(failed ? `${failed} page(s) failed` : 'All pages valid.');
	process.exit(failed ? 1 : 0);
})().catch((e) => {
	console.error(e);
	try {
		sh(`${wp} user delete ${user} --yes`);
	} catch {
		// already deleted
	}
	process.exit(1);
});

/**
 * Sections that had layout bugs: the fee banner and the Home page's success-story cards.
 */

/* global getComputedStyle */ // Used inside page.evaluate(), which runs in the browser.

const { test, expect } = require('@playwright/test'); // eslint-disable-line import/no-extraneous-dependencies -- installed with @wordpress/scripts (npm run test:e2e)
const { openFully } = require('./helpers');

test.describe('fee banner', () => {
	for (const path of [
		'/',
		'/online-doctorate-dba-generative-ai/',
		'/online-masters-mba-cybersecurity-program/',
	]) {
		test(`${path}: the cap picture stays in the card, the scholarship side is centred`, async ({
			page,
		}, testInfo) => {
			test.skip(
				['tablet', 'phone'].includes(testInfo.project.name),
				'side-by-side layout only (wider than 900px)'
			);

			await openFully(page, path);
			const banner = page.locator('.cost-banner').first();
			await banner.scrollIntoViewIfNeeded();

			const result = await banner.evaluate((node) => {
				const left = node.querySelector('.cost-left');
				const right = node.querySelector('.cost-right');
				const box = right.getBoundingClientRect();
				const kids = [...right.children].filter(
					(kid) => kid.getBoundingClientRect().height
				);
				const first = kids[0].getBoundingClientRect();
				const last = kids[kids.length - 1].getBoundingClientRect();

				return {
					clips: getComputedStyle(left).overflow,
					above: first.top - box.top,
					below: box.bottom - last.bottom,
					edge:
						box.right -
						Math.max(
							...kids.map(
								(kid) => kid.getBoundingClientRect().right
							)
						),
				};
			});

			// The fee side clips its decoration, so the picture can't rise above the card or show on the other side.
			expect(result.clips).toMatch(/hidden|clip/);
			// Centred top to bottom (within a few pixels) and clear of the card's right edge.
			expect(Math.abs(result.above - result.below)).toBeLessThanOrEqual(
				6
			);
			expect(result.edge).toBeGreaterThanOrEqual(16);
		});
	}
});

test.describe('Home success stories', () => {
	test('each card back fits its story and links', async ({ page }) => {
		await openFully(page, '/');

		const cards = await page.locator('.story-back').evaluateAll((nodes) =>
			nodes.map((node) => ({
				name: node.querySelector('.story-name')?.textContent.trim(),
				cut: node.scrollHeight - node.clientHeight,
			}))
		);

		expect(cards.length).toBeGreaterThan(0);

		for (const card of cards) {
			expect(
				card.cut,
				`${card.name}: text cut off by`
			).toBeLessThanOrEqual(1);
		}
	});

	test('a card turns over and its links are clickable', async ({
		page,
	}, testInfo) => {
		await openFully(page, '/');
		const card = page.locator('.story-card').first();
		await card.scrollIntoViewIfNeeded();

		if (testInfo.project.use.hasTouch) {
			await card.tap();
		} else {
			await card.hover();
		}

		await expect
			.poll(() =>
				card
					.locator('.story-inner')
					.evaluate((node) => getComputedStyle(node).transform)
			)
			.not.toBe('none');

		for (const link of [
			card.locator('.story-linkedin a'),
			card.locator('.story-more a'),
		]) {
			if (await link.count()) {
				const href = await link.getAttribute('href');
				expect(href).toMatch(/^(https?:\/\/|\/)/);
			}
		}
	});
});

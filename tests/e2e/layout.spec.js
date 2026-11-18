/**
 * Every page, every screen size: nothing runs off the side of the screen and every image loads.
 */

/* global getComputedStyle */ // Used inside page.evaluate(), which runs in the browser.

const { test, expect } = require('@playwright/test'); // eslint-disable-line import/no-extraneous-dependencies -- installed with @wordpress/scripts (npm run test:e2e)
const { PAGES, openFully } = require('./helpers');

for (const path of PAGES) {
	test.describe(`page ${path}`, () => {
		test('has no sideways scroll and nothing past the screen edge', async ({
			page,
		}) => {
			await openFully(page, path);

			const result = await page.evaluate(() => {
				const width = document.documentElement.clientWidth;

				// An element is fine when an ancestor clips or scrolls it (carousels, marquees, rounded cards).
				const clipped = (node) => {
					for (
						let parent = node.parentElement;
						parent && parent !== document.body;
						parent = parent.parentElement
					) {
						if (
							/(hidden|clip|auto|scroll)/.test(
								getComputedStyle(parent).overflowX
							)
						) {
							return true;
						}
					}
					return false;
				};

				const outside = [];

				for (const node of document.querySelectorAll('body *')) {
					const box = node.getBoundingClientRect();
					const style = getComputedStyle(node);

					if (
						!box.width ||
						!box.height ||
						style.position === 'fixed' ||
						style.visibility === 'hidden'
					) {
						continue;
					}

					if (
						(box.right > width + 1 || box.left < -1) &&
						!clipped(node)
					) {
						outside.push(
							`${node.tagName.toLowerCase()}.${String(node.className).split(' ').slice(0, 2).join('.')}`
						);
					}
				}

				return {
					sideways: document.documentElement.scrollWidth - width,
					outside: [...new Set(outside)].slice(0, 5),
				};
			});

			expect(
				result.sideways,
				'page scrolls sideways'
			).toBeLessThanOrEqual(0);
			expect(result.outside, 'elements past the screen edge').toEqual([]);
		});

		test('loads every image', async ({ page }) => {
			await openFully(page, path);

			const broken = await page.evaluate(() =>
				[...document.images]
					.filter(
						(img) =>
							img.getAttribute('src') &&
							img.complete &&
							img.naturalWidth === 0
					)
					.map((img) => img.getAttribute('src'))
			);

			expect(broken, 'broken images').toEqual([]);
		});
	});
}

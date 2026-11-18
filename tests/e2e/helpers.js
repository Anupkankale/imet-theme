/**
 * Shared helpers for the browser tests.
 */

/**
 * Pages to check: one of each page type, plus the pages with their own layouts.
 */
const PAGES = [
	'/',
	'/online-doctorate-business-administration-dba-programs/',
	'/online-doctorate-dba-generative-ai/',
	'/online-doctorate-dba-project-management-usa/',
	'/online-doctorate-business-administration-dba-programs-usa/',
	'/online-masters-mba-degree-programs/',
	'/online-masters-mba-cybersecurity-program/',
	'/online-doctorate-programs-lp/',
	'/locations/',
	'/about-us/',
	'/accreditation-and-recognition/',
	'/alumni-speak/',
	'/success-stories/',
	'/case-studies/',
	'/testimonials/',
	'/convocation-ceremony/',
	'/blog/',
	'/contact/',
	'/resources/',
	'/assessment/',
	'/refer-and-earn/',
	'/why-choose-imet/',
];

/**
 * Open a page and scroll through it, so lazy images and scroll-triggered sections load.
 *
 * @param {import('@playwright/test').Page} page Page.
 * @param {string}                          path Path to open.
 */
async function openFully(page, path) {
	await page.goto(path, { waitUntil: 'load' });
	await page.evaluate(async () => {
		for (let y = 0; y < document.body.scrollHeight; y += 600) {
			window.scrollTo(0, y);
			await new Promise((resolve) => setTimeout(resolve, 40));
		}
		window.scrollTo(0, 0);
	});
	await page.waitForLoadState('networkidle').catch(() => {});
}

module.exports = { PAGES, openFully };

/**
 * Playwright browser tests: layout and UI checks against a running site.
 *
 * Run: npm run test:e2e
 * Another site: BASE_URL=http://imetworld.local npm run test:e2e
 *
 * Uses the installed Google Chrome (channel "chrome"), so no Playwright browser download is needed.
 */

const { defineConfig } = require('@playwright/test'); // eslint-disable-line import/no-extraneous-dependencies -- installed with @wordpress/scripts (npm run test:e2e)

module.exports = defineConfig({
	testDir: __dirname,
	testMatch: '**/*.spec.js',
	outputDir: '../../artifacts/e2e/results',
	timeout: 90_000,
	expect: { timeout: 10_000 },
	fullyParallel: true,
	workers: process.env.CI ? 2 : 4,
	retries: process.env.CI ? 1 : 0,
	reporter: [
		['list'],
		['html', { outputFolder: '../../artifacts/e2e/report', open: 'never' }],
	],
	use: {
		baseURL:
			process.env.BASE_URL ||
			'https://papayawhip-rook-726183.hostingersite.com',
		channel: 'chrome',
		screenshot: 'only-on-failure',
		trace: 'retain-on-failure',
	},
	projects: [
		{ name: 'desktop', use: { viewport: { width: 1440, height: 900 } } },
		{ name: 'laptop', use: { viewport: { width: 1024, height: 768 } } },
		{
			name: 'tablet',
			use: { viewport: { width: 768, height: 1024 }, hasTouch: true },
		},
		{
			name: 'phone',
			use: {
				viewport: { width: 390, height: 844 },
				hasTouch: true,
				isMobile: true,
			},
		},
	],
});

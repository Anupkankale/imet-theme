/**
 * Header menu: the same items as imetworldwide.com; on desktop, the gold hover line and solid carets; on smaller
 * screens, the hamburger opens the menu.
 */

/* global getComputedStyle */ // Used inside page.evaluate(), which runs in the browser.

const { test, expect } = require('@playwright/test'); // eslint-disable-line import/no-extraneous-dependencies -- installed with @wordpress/scripts (npm run test:e2e)

const TOP_ITEMS = [
	'Online Doctorate (DBA)',
	'Online Master’s (MBA)',
	'Discover',
	'Resources',
];

const SUB_ITEMS = {
	'Online Doctorate (DBA)': [
		'DBA in Cybersecurity',
		'DBA in Artificial Intelligence (AI/ML)',
		'DBA in Digital Transformation',
		'DBA in Project Management',
		'DBA in Generative AI',
		'DBA in IT Governance',
	],
	'Online Master’s (MBA)': [
		'MBA in Cybersecurity',
		'MBA in Project Management',
		'MBA in Data Analytics',
	],
	Discover: [
		'About Us',
		'Accreditation',
		'Convocation',
		'Success story',
		'Alumni video',
		'Case Studies',
		'Testimonials',
	],
	Resources: [
		'Certificate Validation',
		'Assessment',
		'Download Resources',
		'Blogs',
	],
};

const GOLD = 'rgb(207, 145, 35)';

/**
 * The top-level menu items (desktop).
 *
 * @param {import('@playwright/test').Page} page Page.
 */
const topItems = (page) =>
	page.locator(
		'nav.imet-nav .wp-block-navigation__responsive-container-content > .wp-block-navigation__container > .wp-block-navigation-item'
	);

test.describe('header menu', () => {
	test.beforeEach(async ({ page }) => {
		await page.goto('/');
	});

	test('has the same items as imetworldwide.com', async ({ page }) => {
		const items = await topItems(page).evaluateAll((nodes) =>
			nodes.map((li) => ({
				label: li
					.querySelector(
						':scope > .wp-block-navigation-item__content'
					)
					?.textContent.trim(),
				children: [
					...li.querySelectorAll(
						'.wp-block-navigation__submenu-container .wp-block-navigation-item__content'
					),
				].map((a) => a.textContent.trim()),
			}))
		);

		// "Contact Us" sits in the menu too, for the phone overlay only.
		const menu = items.filter((item) => item.label !== 'Contact Us');

		expect(menu.map((item) => item.label)).toEqual(TOP_ITEMS);

		for (const item of menu) {
			expect(item.children, `${item.label} dropdown`).toEqual(
				SUB_ITEMS[item.label]
			);
		}
	});

	test('desktop: hover shows the gold line and black text', async ({
		page,
	}, testInfo) => {
		test.skip(
			testInfo.project.name !== 'desktop',
			'desktop menu only (1200px and wider)'
		);

		const item = topItems(page).nth(1);
		const line = () =>
			item.evaluate((li) => {
				const after = getComputedStyle(li, '::after');
				return {
					opacity: after.opacity,
					height: after.height,
					color: after.backgroundColor,
				};
			});

		expect((await line()).opacity).toBe('0');

		await item.hover();
		await expect.poll(async () => (await line()).opacity).toBe('1');

		const hovered = await line();
		expect(hovered.height).toBe('3px');
		expect(hovered.color).toBe(GOLD);
		await expect(
			item.locator(':scope > .wp-block-navigation-item__content')
		).toHaveCSS('color', 'rgb(0, 0, 0)');

		// The line runs along the bottom of the white bar, 6px or less above its edge.
		const gap = await page.evaluate(() => {
			const li = document.querySelectorAll(
				'nav.imet-nav .wp-block-navigation__responsive-container-content > .wp-block-navigation__container > .wp-block-navigation-item'
			)[1];
			return (
				document.querySelector('.imet-pill').getBoundingClientRect()
					.bottom - li.getBoundingClientRect().bottom
			);
		});
		expect(gap).toBeGreaterThanOrEqual(0);
		expect(gap).toBeLessThanOrEqual(8);

		// The dropdown opens under the line.
		await expect(
			item.locator('.wp-block-navigation__submenu-container')
		).toBeVisible();
	});

	test('desktop: dropdown arrows are solid carets', async ({
		page,
	}, testInfo) => {
		test.skip(
			testInfo.project.name !== 'desktop',
			'desktop menu only (1200px and wider)'
		);

		const icon = topItems(page)
			.first()
			.locator('.wp-block-navigation__submenu-icon');
		const style = await icon.evaluate((node) => {
			const css = getComputedStyle(node);
			return {
				mask: css.maskImage || css.webkitMaskImage,
				svg: getComputedStyle(node.querySelector('svg')).display,
			};
		});

		expect(style.mask).toContain('svg');
		expect(style.svg).toBe('none');
	});

	test('smaller screens: the hamburger opens the menu', async ({
		page,
	}, testInfo) => {
		test.skip(
			testInfo.project.name === 'desktop',
			'the hamburger shows below 1200px'
		);

		await page
			.locator('.wp-block-navigation__responsive-container-open')
			.first()
			.click();

		const overlay = page.locator(
			'.wp-block-navigation__responsive-container.is-menu-open'
		);
		await expect(overlay).toBeVisible();

		for (const label of TOP_ITEMS) {
			await expect(
				overlay.getByText(label, { exact: true }).first()
			).toBeVisible();
		}

		// Logo row, close button and the Contact Us button.
		await expect(
			overlay.locator('.imet-nav-head .imet-nav-logo')
		).toBeVisible();
		await expect(
			overlay.locator('.wp-block-navigation__responsive-container-close')
		).toBeVisible();
		await expect(overlay.locator('.imet-nav-cta')).toHaveAttribute(
			'href',
			/\/contact\/$/
		);
	});

	test('smaller screens: menu groups open one at a time', async ({
		page,
	}, testInfo) => {
		test.skip(
			testInfo.project.name === 'desktop',
			'the hamburger shows below 1200px'
		);

		await page
			.locator('.wp-block-navigation__responsive-container-open')
			.first()
			.click();
		const overlay = page.locator(
			'.wp-block-navigation__responsive-container.is-menu-open'
		);
		const groups = overlay.locator(
			'.wp-block-navigation__container > .has-child'
		);
		const lists = overlay.locator(
			'.wp-block-navigation__container > .has-child > .wp-block-navigation__submenu-container'
		);

		// On the home page no group holds the current page: all closed.
		await expect(lists.filter({ visible: true })).toHaveCount(0);

		// The arrow opens a group.
		await groups
			.nth(0)
			.locator(':scope > .wp-block-navigation-submenu__toggle')
			.click();
		await expect(lists.nth(0)).toBeVisible();
		await expect(
			lists.nth(0).getByText('DBA in Cybersecurity')
		).toBeVisible();

		// "Discover" has no page of its own: its label opens it, and the first group closes.
		await groups
			.nth(2)
			.locator(':scope > .wp-block-navigation-item__content')
			.click();
		await expect(lists.nth(2)).toBeVisible();
		await expect(lists.nth(0)).toBeHidden();
		await expect(
			groups
				.nth(2)
				.locator(':scope > .wp-block-navigation-submenu__toggle')
		).toHaveAttribute('aria-expanded', 'true');

		// From 640px the menu is a panel: a tap on the dimmed page beside it closes the menu.
		if (testInfo.project.name !== 'phone') {
			await page.mouse.click(10, 300);
			await expect(overlay).toHaveCount(0);
		}
	});
});

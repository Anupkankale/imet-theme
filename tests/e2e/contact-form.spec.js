/**
 * Contact Us page: the Contact Form 7 form renders with its fields and rejects an empty submission. It never sends a
 * real message (a sent message is emailed), so it only presses Submit with the required fields empty.
 */

const { test, expect } = require('@playwright/test'); // eslint-disable-line import/no-extraneous-dependencies -- installed with @wordpress/scripts (npm run test:e2e)

test('/contact/: Contact Form 7 form renders and requires its fields', async ({
	page,
}) => {
	await page.goto('/contact/');

	const form = page.locator('form.wpcf7-form').first();
	await form.scrollIntoViewIfNeeded();
	await expect(form).toBeVisible();

	for (const name of [
		'your-name',
		'your-code',
		'your-phone',
		'your-email',
		'your-linkedin',
		'your-message',
	]) {
		await expect(form.locator(`[name="${name}"]`)).toBeVisible();
	}
	await expect(form.locator('[name="your-consent[]"]')).toBeVisible();

	// Every field has a label for screen readers (the placeholder is only a hint).
	await expect(form.getByLabel('Full Name')).toBeVisible();
	await expect(form.getByLabel('Phone Number')).toBeVisible();
	await expect(form.getByLabel('Email')).toBeVisible();

	// Empty: the plugin rejects it, marks the three required fields and sends nothing.
	await form.locator('.wpcf7-submit').click();
	await expect(form).toHaveAttribute('data-status', 'invalid');
	await expect(form.locator('.wpcf7-not-valid-tip')).toHaveCount(3);
	await expect(form.locator('.wpcf7-response-output')).toBeVisible();
});

test('/contact/: offices, email and phone cards; on phones the form follows the header', async ({
	page,
}, testInfo) => {
	await page.goto('/contact/');

	await expect(page.locator('.ct-office')).toHaveCount(4);
	await expect(
		page.locator('.ct-quick a[href^="mailto:"]').first()
	).toBeVisible();
	await expect(
		page.locator('.ct-quick a[href^="tel:"]').first()
	).toBeVisible();

	// Each office card shows its flag (a background image that loaded).
	const flags = await page.locator('.ct-office').evaluateAll((cards) =>
		cards.map(
			(card) =>
				// eslint-disable-next-line no-undef -- runs in the browser
				getComputedStyle(card, '::before').backgroundImage
		)
	);
	for (const flag of flags) {
		expect(flag).toContain('flag-');
	}

	// One column below 900px: header, then the form, then the cards.
	if (['tablet', 'phone'].includes(testInfo.project.name)) {
		const top = (selector) =>
			page
				.locator(selector)
				.first()
				.evaluate((el) => el.getBoundingClientRect().top);
		expect(await top('.ct-form')).toBeLessThan(await top('.ct-quick'));
		expect(await top('.ct-intro')).toBeLessThan(await top('.ct-form'));
	}
});

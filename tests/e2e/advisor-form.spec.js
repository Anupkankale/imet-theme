/**
 * "Talk to an Advisor" form: it renders, and the browser stops an incomplete submission. It never sends a real lead
 * (a lead is stored and emailed), so it only presses Submit with required fields empty.
 */

const { test, expect } = require('@playwright/test'); // eslint-disable-line import/no-extraneous-dependencies -- installed with @wordpress/scripts (npm run test:e2e)

for (const path of [
	'/online-doctorate-dba-generative-ai/',
	'/online-masters-mba-cybersecurity-program/',
]) {
	test(`${path}: advisor form renders and requires its fields`, async ({
		page,
	}) => {
		await page.goto(path);

		const form = page.locator('form.imet-advisor-form__form').first();
		await form.scrollIntoViewIfNeeded();
		await expect(form).toBeVisible();

		for (const name of ['imet_name', 'imet_phone', 'imet_email']) {
			await expect(form.locator(`[name="${name}"]`)).toBeVisible();
		}

		// The honeypot is there but hidden from people: a clipped 1px box, out of the accessibility tree.
		const honeypot = form.locator('.imet-advisor-form__hp');
		await expect(honeypot.locator('[name="imet_website"]')).toHaveCount(1);
		await expect(honeypot).toHaveAttribute('aria-hidden', 'true');
		const box = await honeypot.boundingBox();
		expect(box.width <= 1 && box.height <= 1).toBe(true);

		const url = page.url();
		await form.locator('[type="submit"]').first().click();

		// Required fields block the submission: still on the same page, and the name field reports the problem.
		await expect(page).toHaveURL(url);
		expect(
			await form
				.locator('[name="imet_name"]')
				.evaluate((input) => input.validity.valid)
		).toBe(false);
	});
}

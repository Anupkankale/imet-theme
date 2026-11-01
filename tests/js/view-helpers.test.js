import {
	each,
	accordion,
	marquee,
	pauseButton,
	reduceMotion,
	videoConsent,
} from '../../src/blocks-shared/view-helpers';

const FAQ = `
<div class="faq-acc">
	<details><summary>One</summary><p>A1</p></details>
	<details><summary>Two</summary><p>A2</p></details>
	<details><summary>Three</summary><p>A3</p></details>
</div>`;

beforeEach(() => {
	document.body.innerHTML = FAQ;
	// jsdom has no matchMedia and no Element.animate: "reduce motion" makes the accordion toggle instantly.
	window.matchMedia = jest.fn().mockReturnValue({ matches: true });
});

describe('each', () => {
	it('runs for every match when the DOM is ready', () => {
		const seen = [];
		each('details', (d) => seen.push(d.textContent));
		expect(seen).toHaveLength(3);
	});
});

describe('reduceMotion', () => {
	it('reads prefers-reduced-motion', () => {
		expect(reduceMotion()).toBe(true);
		expect(window.matchMedia).toHaveBeenCalledWith(
			'(prefers-reduced-motion: reduce)'
		);
	});
});

describe('accordion', () => {
	const setup = (opts) => {
		const group = document.querySelector('.faq-acc');
		accordion(group, opts);
		return [...group.querySelectorAll('details')];
	};

	it('wraps each answer in .acc-body and leaves the summary alone', () => {
		const [first] = setup();
		expect(first.querySelector(':scope > summary').textContent).toBe('One');
		expect(first.querySelector(':scope > .acc-body p').textContent).toBe(
			'A1'
		);
	});

	it('opens the first item only when asked', () => {
		expect(setup().map((d) => d.open)).toEqual([false, false, false]);
		document.body.innerHTML = FAQ;
		expect(setup({ openFirst: true }).map((d) => d.open)).toEqual([
			true,
			false,
			false,
		]);
	});

	it('keeps one item open at a time', () => {
		const items = setup({ openFirst: true });
		items[1].querySelector('summary').click();
		expect(items.map((d) => d.open)).toEqual([false, true, false]);
	});

	it('closes an open item when its question is clicked again', () => {
		const items = setup({ openFirst: true });
		items[0].querySelector('summary').click();
		expect(items[0].open).toBe(false);
	});

	it('prevents the native details toggle', () => {
		const [first] = setup();
		const event = new window.MouseEvent('click', {
			bubbles: true,
			cancelable: true,
		});
		first.querySelector('summary').dispatchEvent(event);
		expect(event.defaultPrevented).toBe(true);
	});
});

describe('marquee', () => {
	beforeEach(() => {
		window.matchMedia = jest.fn(() => ({ matches: false }));
		window.IntersectionObserver = class {
			observe() {}
		};
		window.requestAnimationFrame = jest.fn();
		document.body.innerHTML =
			'<div class="row"><a class="item" href="#a">a</a><a class="item" href="#b">b</a></div>';
	});

	const build = (options) => {
		const row = document.querySelector('.row');
		marquee(row, [...row.querySelectorAll('.item')], options);
		return row;
	};

	test('adds a hidden-from-assistive-tech copy of every item', () => {
		const row = build();
		const copies = row.querySelectorAll('.is-clone');

		expect(copies).toHaveLength(2);
		copies.forEach((copy) => {
			expect(copy.getAttribute('aria-hidden')).toBe('true');
			expect(copy.getAttribute('tabindex')).toBeNull();
			expect(copy.getAttribute('href')).toBe(
				copy.textContent === 'a' ? '#a' : '#b'
			);
		});
		expect(row.classList.contains('is-marquee')).toBe(true);
	});

	test('a row whose items fit is static, so the copies stay hidden', () => {
		expect(build().classList.contains('is-static')).toBe(true);
	});

	test('a row that always moves is never static', () => {
		expect(
			build({ alwaysMove: true }).classList.contains('is-static')
		).toBe(false);
	});

	test('adds a pause button after the row (WCAG 2.2.2)', () => {
		const row = build({ alwaysMove: true });
		const control = row.nextElementSibling;
		const button = control.firstElementChild;

		expect(control.classList.contains('imet-motion-control')).toBe(true);
		expect(button.tagName).toBe('BUTTON');
		expect(button.type).toBe('button');
		expect(button.getAttribute('aria-pressed')).toBe('false');
		expect(button.getAttribute('aria-label')).toBe('Pause animation');
	});

	test('the pause button stops the row until it is pressed again, whatever the pointer does', () => {
		const row = build({ alwaysMove: true });
		const button = row.nextElementSibling.querySelector('button');

		button.click();
		expect(button.getAttribute('aria-pressed')).toBe('true');
		expect(row.classList.contains('is-stopped')).toBe(true);

		// Hover and focus ending must not restart a row the visitor stopped.
		row.dispatchEvent(new window.MouseEvent('mouseenter'));
		row.dispatchEvent(new window.MouseEvent('mouseleave'));
		row.dispatchEvent(new window.FocusEvent('focusout'));
		expect(row.classList.contains('is-stopped')).toBe(true);

		button.click();
		expect(button.getAttribute('aria-pressed')).toBe('false');
		expect(row.classList.contains('is-stopped')).toBe(false);
	});

	test('control: false leaves the button to the caller and returns a controller', () => {
		const row = document.querySelector('.row');
		const controller = marquee(row, [...row.querySelectorAll('.item')], {
			alwaysMove: true,
			control: false,
		});

		expect(row.nextElementSibling).toBeNull();
		controller.setStopped(true);
		expect(row.classList.contains('is-stopped')).toBe(true);
		controller.setStopped(false);
		expect(row.classList.contains('is-stopped')).toBe(false);
	});

	test('does nothing for reduced motion or a single item', () => {
		window.matchMedia = jest.fn(() => ({ matches: true }));

		const row = build();
		expect(row.querySelectorAll('.is-clone')).toHaveLength(0);
		expect(row.nextElementSibling).toBeNull();
	});
});

describe('pauseButton', () => {
	beforeEach(() => {
		document.body.innerHTML = '<div class="moving"></div>';
	});

	// jsdom has no layout: give elements the boxes a browser would.
	const box = (el, top, bottom, left = 0, right = 390) => {
		el.getBoundingClientRect = () => ({
			top,
			bottom,
			left,
			right,
			width: right - left,
			height: bottom - top,
		});
	};
	const section = (below, above = '') => {
		document.body.innerHTML = `<div class="imet-section">${above}<div class="row"></div>${below}</div>`;
		const root = document.querySelector('.imet-section');
		box(root, 0, 1000);
		box(root.querySelector('.row'), 300, 500);
		return root;
	};

	test('goes below the row when the space under it is free of content', () => {
		const root = section('<p class="next">Text</p>');
		box(root.querySelector('.next'), 600, 640);
		const button = pauseButton(root.querySelector('.row'), () => {});

		expect(button.parentElement.classList.contains('is-below')).toBe(true);
		expect(root.querySelector('.row').nextElementSibling).toBe(
			button.parentElement
		);
	});

	test('goes above the row when content sits right under it', () => {
		const root = section(
			'<p class="next">Text</p>',
			'<h2 class="title">Title</h2>'
		);
		box(root.querySelector('.next'), 510, 540);
		box(root.querySelector('.title'), 100, 150);
		const button = pauseButton(root.querySelector('.row'), () => {});

		expect(button.parentElement.classList.contains('is-above')).toBe(true);
		// Still after the row in the DOM, so sibling selectors before the row are untouched.
		expect(root.querySelector('.row').nextElementSibling).toBe(
			button.parentElement
		);
	});

	test('floats over the row only when there is no room above or below', () => {
		const root = section(
			'<p class="next">Text</p>',
			'<h2 class="title">Title</h2>'
		);
		box(root.querySelector('.next'), 510, 540);
		box(root.querySelector('.title'), 260, 290);
		const button = pauseButton(root.querySelector('.row'), () => {});

		expect(button.parentElement.classList.contains('is-overlay')).toBe(
			true
		);
	});

	test('one button for several rows hides only when none of them moves', async () => {
		document.body.innerHTML =
			'<div class="r is-marquee"></div><div class="r is-marquee"></div>';
		const rows = [...document.querySelectorAll('.r')];
		const button = pauseButton(rows[1], () => {}, { rows });
		const control = button.parentElement;

		rows[0].classList.add('is-static');
		await new Promise((resolve) => setTimeout(resolve));
		expect(control.hidden).toBe(false);

		rows[1].classList.add('is-static');
		await new Promise((resolve) => setTimeout(resolve));
		expect(control.hidden).toBe(true);
	});

	test('reports each press and keeps aria-pressed in step', () => {
		const calls = [];
		const button = pauseButton(document.querySelector('.moving'), (s) =>
			calls.push(s)
		);

		button.click();
		button.click();

		expect(calls).toEqual([true, false]);
		expect(button.getAttribute('aria-pressed')).toBe('false');
		expect(button.classList.contains('imet-motion-toggle')).toBe(true);
	});
});

describe('videoConsent', () => {
	beforeEach(() => {
		window.localStorage.clear();
		document.body.innerHTML = '<div class="player"></div>';
	});
	const player = () => document.querySelector('.player');

	test('asks before anything loads from YouTube', () => {
		const start = jest.fn();
		videoConsent(player(), start);

		const notice = player().querySelector('.imet-video-consent');
		expect(start).not.toHaveBeenCalled();
		expect(notice).not.toBeNull();
		expect(notice.textContent).toContain('YouTube');
		expect(document.activeElement.textContent).toBe('Play video');
	});

	test('"Play video" starts the video and removes the notice', () => {
		const start = jest.fn();
		videoConsent(player(), start);
		player().querySelector('.imet-video-consent-play').click();

		expect(start).toHaveBeenCalledTimes(1);
		expect(player().querySelector('.imet-video-consent')).toBeNull();
		expect(window.localStorage.getItem('imet-video-consent')).toBeNull();
	});

	test('"Remember my choice" skips the notice next time', () => {
		videoConsent(player(), jest.fn());
		player().querySelector('input[type="checkbox"]').click();
		player().querySelector('.imet-video-consent-play').click();

		const start = jest.fn();
		videoConsent(player(), start);
		expect(start).toHaveBeenCalledTimes(1);
		expect(player().querySelector('.imet-video-consent')).toBeNull();
	});

	test('"Cancel" closes the notice without loading the video', () => {
		const start = jest.fn();
		videoConsent(player(), start);
		player().querySelector('.imet-video-consent-cancel').click();

		expect(start).not.toHaveBeenCalled();
		expect(player().querySelector('.imet-video-consent')).toBeNull();
	});

	test('clicks inside the notice do not reach a surrounding link', () => {
		document.body.innerHTML = '<a href="#v" class="player"></a>';
		const outer = jest.fn();
		player().addEventListener('click', outer);

		videoConsent(player(), jest.fn());
		player().querySelector('.imet-video-consent-cancel').click();

		expect(outer).not.toHaveBeenCalled();
	});
});

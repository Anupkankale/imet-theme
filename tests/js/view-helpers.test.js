import {
	each,
	accordion,
	marquee,
	reduceMotion,
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

	test('does nothing for reduced motion or a single item', () => {
		window.matchMedia = jest.fn(() => ({ matches: true }));

		expect(build().querySelectorAll('.is-clone')).toHaveLength(0);
	});
});

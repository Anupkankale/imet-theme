/* Pages built from blank sections:
   - Alumni Page stories (.al-stories): the topic chips show the cards of one topic (a card's al-cat-<topic> class; "#all"
     shows every card), and a podcast card plays its YouTube video in place once the visitor agrees (videoConsent, shown
     over the whole card).
   - Blog Page (.bl-main): the Doctorate / MBA chips show their own panel of articles (.bl-panel-<slug>). Without
     JavaScript every panel shows.
   - Blog article (templates/single.html): the category bar underlines the article's categories (.bp-nav), and the
     sidebar's table of contents lists the article's H2 headings, marking the one being read (.bp-main). Without
     JavaScript the table of contents stays hidden.
   Other blank sections have none of these, so nothing runs for them. */
import { __ } from '@wordpress/i18n';
import {
	each,
	reduceMotion,
	videoConsent,
} from '../../../blocks-shared/view-helpers';

const youtubeId = (url) =>
	((url || '').match(
		/(?:youtu\.be\/|[?&]v=|\/embed\/|\/shorts\/|\/live\/)([\w-]{11})/
	) || [])[1];

/**
 * Chips that act as toggle buttons: the chip links ("#topic") get the button role and aria-pressed, and a click marks the
 * chip active and calls onSelect with its topic.
 * @param {Element[]}               chips    The chips (.wp-block-button), the active one has .is-active.
 * @param {(topic: string) => void} onSelect Called with the topic (the link's hash without "#").
 */
function chipToggle(chips, onSelect) {
	chips.forEach((chip) => {
		const link = chip.querySelector('a');
		const topic = (link?.getAttribute('href') || '').replace('#', '');
		if (!link || !topic) {
			return;
		}
		link.setAttribute('role', 'button');
		link.setAttribute(
			'aria-pressed',
			String(chip.classList.contains('is-active'))
		);
		link.addEventListener('click', (e) => {
			e.preventDefault();
			chips.forEach((c) => {
				c.classList.toggle('is-active', c === chip);
				c.querySelector('a')?.setAttribute(
					'aria-pressed',
					String(c === chip)
				);
			});
			onSelect(topic);
		});
	});
}

each('.imet-section.bl-main', (section) => {
	const chips = [...section.querySelectorAll('.bl-tabs .wp-block-button')];
	const panels = [...section.querySelectorAll('.bl-panel')];
	const show = (topic) =>
		panels.forEach((panel) => {
			panel.hidden = !panel.classList.contains('bl-panel-' + topic);
		});
	const first = chips[0]?.querySelector('a')?.getAttribute('href');
	if (first) {
		show(first.replace('#', ''));
	}
	chipToggle(chips, show);
});

each('.imet-section.al-stories', (section) => {
	const cards = [...section.querySelectorAll('.al-card')];
	chipToggle(
		[...section.querySelectorAll('.al-chips .wp-block-button')],
		(topic) =>
			cards.forEach((card) => {
				card.hidden =
					topic !== 'all' &&
					!card.classList.contains('al-cat-' + topic);
			})
	);

	section.querySelectorAll('.al-thumb').forEach((thumb) => {
		const link = thumb.querySelector('a');
		const id = youtubeId(link?.href);
		if (!id) {
			return; // a story card: the link opens the story
		}
		thumb.classList.add('is-video');
		link.addEventListener('click', (e) => {
			e.preventDefault();
			videoConsent(thumb.closest('.al-card') || thumb, () => {
				thumb.querySelector('iframe')?.remove();
				const frame = document.createElement('iframe');
				frame.src =
					'https://www.youtube-nocookie.com/embed/' +
					id +
					'?autoplay=1&rel=0';
				frame.title =
					link.querySelector('img')?.alt || __('Video', 'imet-theme');
				frame.allow =
					'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
				frame.allowFullscreen = true;
				thumb.classList.add('is-playing');
				thumb.appendChild(frame);
			});
		});
	});
});

const path = (href) => {
	try {
		return new URL(href, window.location.href).pathname.replace(
			/\/?$/,
			'/'
		);
	} catch {
		return '';
	}
};

each('.imet-section.bp-nav', (nav) => {
	const current = new Set(
		[
			...document.querySelectorAll(
				'.bp-crumbs .wp-block-post-terms a[href]'
			),
		].map((a) => path(a.href))
	);
	nav.querySelectorAll('.bp-cats a[href]').forEach((link) => {
		if (current.has(path(link.href))) {
			link.classList.add('is-current');
		}
	});
});

const slug = (text) =>
	text
		.toLowerCase()
		.normalize('NFKD')
		.replace(/[\u0300-\u036f]/g, '')
		.replace(/[^a-z0-9]+/g, '-')
		.replace(/^-+|-+$/g, '') || 'section';

each('.imet-section.bp-main', (section) => {
	const toc = section.querySelector('.bp-toc');
	const heads = [...section.querySelectorAll('.bp-content h2')].filter((h) =>
		h.textContent.trim()
	);
	if (!toc || !heads.length) {
		return;
	}

	const list = document.createElement('ol');
	list.className = 'bp-toc-list';
	const links = heads.map((head) => {
		if (!head.id) {
			let id = slug(head.textContent);
			for (let n = 2; document.getElementById(id); n++) {
				id = slug(head.textContent) + '-' + n;
			}
			head.id = id;
		}
		const item = document.createElement('li');
		const link = document.createElement('a');
		link.href = '#' + head.id;
		link.textContent = head.textContent.trim();
		item.appendChild(link);
		list.appendChild(item);
		return link;
	});
	toc.appendChild(list);
	toc.classList.add('is-ready');

	// Fade the bottom of the list while more items are hidden below (design).
	const fade = () =>
		list.classList.toggle(
			'is-more',
			list.scrollTop + list.clientHeight < list.scrollHeight - 2
		);
	list.addEventListener('scroll', fade, { passive: true });
	window.addEventListener('resize', fade, { passive: true });
	fade();

	// The heading being read is the last one that has passed the top fifth of the screen.
	let active = null;
	const mark = () => {
		const line = window.innerHeight / 5;
		let index = 0;
		heads.forEach((head, i) => {
			if (head.getBoundingClientRect().top <= line) {
				index = i;
			}
		});
		const link = links[index];
		if (link === active) {
			return;
		}
		active?.classList.remove('is-active');
		active?.removeAttribute('aria-current');
		link.classList.add('is-active');
		link.setAttribute('aria-current', 'location');
		active = link;
		// Keep the marked item visible inside the list without scrolling the page.
		const top = link.offsetTop - list.offsetTop;
		if (
			top < list.scrollTop ||
			top > list.scrollTop + list.clientHeight - link.offsetHeight
		) {
			list.scrollTo({
				top: top - list.clientHeight / 3,
				behavior: reduceMotion() ? 'auto' : 'smooth',
			});
		}
	};
	let queued = false;
	const onScroll = () => {
		if (!queued) {
			queued = true;
			window.requestAnimationFrame(() => {
				queued = false;
				mark();
			});
		}
	};
	window.addEventListener('scroll', onScroll, { passive: true });
	window.addEventListener('resize', onScroll, { passive: true });
	mark();
});

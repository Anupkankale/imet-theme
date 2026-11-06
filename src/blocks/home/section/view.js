/* Pages built from blank sections:
   - Alumni Page stories (.al-stories): the topic chips show the cards of one topic (a card's al-cat-<topic> class; "#all"
     shows every card), and a podcast card plays its YouTube video in place once the visitor agrees (videoConsent, shown
     over the whole card).
   - Blog Page (.bl-main): the Doctorate / MBA chips show their own panel of articles (.bl-panel-<slug>). Without
     JavaScript every panel shows.
   Other blank sections have none of these, so nothing runs for them. */
import { __ } from '@wordpress/i18n';
import { each, videoConsent } from '../../../blocks-shared/view-helpers';

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

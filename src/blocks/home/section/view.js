/* Alumni Page stories (.al-stories, pattern "Alumni Page"): the topic chips show the cards of one topic (a card's
   al-cat-<topic> class; "#all" shows every card), and a podcast card plays its YouTube video in place once the visitor
   agrees (videoConsent, shown over the whole card). Other blank sections have neither, so nothing runs for them. */
import { __ } from '@wordpress/i18n';
import { each, videoConsent } from '../../../blocks-shared/view-helpers';

const youtubeId = (url) =>
	((url || '').match(
		/(?:youtu\.be\/|[?&]v=|\/embed\/|\/shorts\/|\/live\/)([\w-]{11})/
	) || [])[1];

each('.imet-section.al-stories', (section) => {
	const chips = [...section.querySelectorAll('.al-chips .wp-block-button')];
	const cards = [...section.querySelectorAll('.al-card')];

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
			cards.forEach((card) => {
				card.hidden =
					topic !== 'all' &&
					!card.classList.contains('al-cat-' + topic);
			});
		});
	});

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

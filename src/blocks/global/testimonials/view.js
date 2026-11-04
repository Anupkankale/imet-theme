/* Testimonial slider: auto-advances every 4s; pauses on hover, touch and focus, and stops for good with the pause
   button (WCAG 2.2.2); swipe/scroll by hand. */
import {
	each,
	marquee,
	pauseButton,
	reduceMotion,
} from '../../../blocks-shared/view-helpers';

each('.wp-block-imet-testimonials .slider-track', (track) => {
	if (!track.querySelector('.t-card')) {
		return;
	}
	const still = reduceMotion();
	const cardWidth = () => track.querySelector('.t-card').offsetWidth + 12;
	if (track.clientWidth > 900) {
		track.scrollLeft = cardWidth() - 62;
	}
	const next = () => {
		const atEnd =
			track.scrollLeft + track.clientWidth >= track.scrollWidth - 5;
		track.scrollTo({
			left: atEnd ? 0 : track.scrollLeft + cardWidth(),
			behavior: still ? 'auto' : 'smooth',
		});
	};
	let stopped = false;
	let timer = still ? null : setInterval(next, 4000);
	const pause = () => clearInterval(timer);
	const resume = () => {
		clearInterval(timer);
		if (!still && !stopped) {
			timer = setInterval(next, 4000);
		}
	};
	if (!still) {
		pauseButton(track, (stop) => {
			stopped = stop;
			if (stop) {
				pause();
			} else {
				resume();
			}
		});
	}
	track.addEventListener('mouseenter', pause);
	track.addEventListener('mouseleave', resume);
	track.addEventListener('touchstart', pause, { passive: true });
	track.addEventListener('touchend', resume);
	track.addEventListener('focusin', pause);
	track.addEventListener('focusout', resume);
});

/* Client testimonials (DBA pages): the cards glide sideways like a marquee and loop without a jump; hover, focus or touch pauses it. */
each('.wp-block-imet-testimonials:not(.is-style-home) .testi-grid', (grid) =>
	marquee(grid, [...grid.querySelectorAll('.testi-card')], {
		speed: 30,
		alwaysMove: true,
	})
);

/* Home page: the client testimonials and the success stories glide sideways on their own (no arrows). */
each(
	'.wp-block-imet-testimonials.is-style-home:is(.is-clients, .is-stories) .testi-grid',
	(grid) =>
		marquee(grid, [...grid.querySelectorAll('.testi-card')], { speed: 30 })
);

// Success stories: touch screens have no hover, so a tap flips the card (taps on its links still follow them).
each('.wp-block-imet-testimonials .story-card', (card) => {
	card.addEventListener('click', (event) => {
		if (
			!window.matchMedia('(hover: none)').matches ||
			event.target.closest('a')
		) {
			return;
		}
		card.classList.toggle('is-flipped');
	});
});

// Success stories on touch screens: with no hover to turn them, each card turns on its own, a few seconds after it comes
// into view, then turns back, so the story on the back is seen without a tap. Skipped for people who ask for less motion.
each('.wp-block-imet-testimonials.is-stories .story-card', (card) => {
	if (
		reduceMotion() ||
		!window.matchMedia('(hover: none)').matches ||
		!('IntersectionObserver' in window)
	) {
		return;
	}
	let timer = 0;
	new window.IntersectionObserver(
		([entry]) => {
			window.clearInterval(timer);
			if (entry.isIntersecting) {
				timer = window.setInterval(
					() => card.classList.toggle('is-flipped'),
					3500
				);
			}
		},
		{ threshold: 0.6 }
	).observe(card);
});

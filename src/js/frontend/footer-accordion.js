/**
 * Footer link groups: collapsed accordions on phones, plain headings with open lists from 768px up.
 *
 * The markup is core Details blocks, open by default, so without JavaScript every group simply shows its links.
 */
const GROUPS = '.imet-footer-acc';
const PHONE = window.matchMedia('(max-width: 767px)');

const groups = document.querySelectorAll(GROUPS);

// Phones start collapsed; wider screens keep every group open.
const sync = () => {
	groups.forEach((group) => {
		group.open = !PHONE.matches;
	});
};

// On wider screens the heading is not a toggle: put back whatever the keyboard closed.
groups.forEach((group) => {
	group.addEventListener('toggle', () => {
		if (!PHONE.matches && !group.open) {
			group.open = true;
		}
	});
});

sync();
PHONE.addEventListener('change', sync);

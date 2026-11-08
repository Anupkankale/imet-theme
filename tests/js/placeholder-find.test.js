import {
	findPlaceholders,
	PLACEHOLDER,
} from '../../src/blocks-shared/placeholder-find';

const ph = `https://example.com/wp-content/themes/imet-theme/assets/images/imet/${PLACEHOLDER}`;
const synced = {
	7: { html: `<img src="${ph}"/>`, name: 'Photo: MBA USP' },
	8: { html: '<img src="real.jpg"/>', name: 'Photo: Location Highlights' },
};
const html = (ref) => synced[ref]?.html || '';
const name = (ref) => synced[ref]?.name || '';

describe('findPlaceholders', () => {
	it('finds a placeholder image, also nested', () => {
		const blocks = [
			{
				name: 'core/group',
				innerBlocks: [{ name: 'core/image', attributes: { url: ph } }],
			},
			{ name: 'core/image', attributes: { url: 'real.jpg' } },
		];
		expect(findPlaceholders(blocks, html, name)).toEqual(['Image']);
	});

	it('finds a synced section that still has the placeholder', () => {
		const blocks = [
			{ name: 'core/block', attributes: { ref: 7 } },
			{ name: 'core/block', attributes: { ref: 8 } },
		];
		expect(findPlaceholders(blocks, html, name)).toEqual([
			'Photo: MBA USP',
		]);
	});

	it('skips a synced section whose page overrides the photo', () => {
		const blocks = [
			{
				name: 'core/block',
				attributes: {
					ref: 7,
					content: { Photo: { url: 'own-photo.jpg' } },
				},
			},
		];
		expect(findPlaceholders(blocks, html, name)).toEqual([]);
	});

	it('returns nothing for a page without placeholders', () => {
		expect(findPlaceholders([], html, name)).toEqual([]);
	});
});

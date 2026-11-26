/**
 * Where the site puts the blog article's automatic parts, worked out from the editor's blocks the same way
 * IMET\Theme\Modules\Blog\SinglePost does it on the page:
 * - the TL;DR box: the "Blog: TL;DR box" pattern, or a "TL;DR"/"TLDR" heading with a list right under it;
 * - the program card, the "Build job-ready skills" banner and "Recommended Blog/Reading" before the 2nd, 4th and
 *   6th H2 (the TL;DR heading not counted), at the end when the post has fewer.
 */

/** The parts and the H2 each one goes before. */
export const PARTS = [
	{ key: 'cta', heading: 2, label: 'Program card' },
	{ key: 'banner', heading: 4, label: '"Build job-ready skills" banner' },
	{ key: 'reading', heading: 6, label: '"Recommended Blog/Reading"' },
];

/**
 * Plain text of a block's rich text attribute (a string, or RichTextData in recent WordPress).
 *
 * @param {string|Object|undefined} value Attribute value.
 * @return {string} Text without tags.
 */
export const plainText = (value) =>
	String(value ?? '')
		.replace(/<[^>]*>/g, '')
		.replace(/&nbsp;|&#160;/g, ' ')
		.replace(/&amp;/g, '&')
		.trim();

/**
 * Whether a heading reads "TL;DR" (also "TLDR", "TL DR", "TL:DR").
 *
 * @param {string} text Heading text.
 * @return {boolean} True for a TL;DR heading.
 */
export const isTldrText = (text) => /^\W*TL\W{0,2}DR\b/i.test(text);

const hasClass = (block, name) =>
	(block.attributes?.className || '').split(/\s+/).includes(name);

/**
 * The layout of a post's blocks.
 *
 * @param {Array} blocks The editor's top-level blocks.
 * @return {{tldr: {ids: string[], pattern: boolean}|null, headings: Array<{id: string, text: string}>, parts: Object}}
 *         The TL;DR blocks, the H2s that count, and for each part the H2 it goes before (null: at the end).
 */
export const findBlogLayout = (blocks) => {
	let box = null; // The pattern's box: it wins, as on the site.
	let section = null; // A TL;DR heading with its list.
	const h2s = [];

	const walk = (list) => {
		list.forEach((block, index) => {
			if (block.name === 'core/group' && hasClass(block, 'bp-tldr')) {
				box = box || { ids: [block.clientId], pattern: true };
				return; // Its contents aren't article headings.
			}

			if (block.name === 'core/heading') {
				const text = plainText(block.attributes.content);
				const next = list[index + 1];
				const level = block.attributes.level ?? 2;

				if (
					!section &&
					level >= 2 &&
					level <= 4 &&
					isTldrText(text) &&
					next?.name === 'core/list'
				) {
					section = {
						ids: [block.clientId, next.clientId],
						pattern: false,
					};
				}

				if (level === 2) {
					h2s.push({ id: block.clientId, text });
				}
			}

			if (block.innerBlocks?.length) {
				walk(block.innerBlocks);
			}
		});
	};

	walk(blocks);

	const tldr = box || section;
	// The site takes the TL;DR section out before counting, so its heading doesn't count (unless the box won).
	const headings = h2s.filter(
		(h) => box || !section || h.id !== section.ids[0]
	);

	const parts = {};
	PARTS.forEach((part) => {
		parts[part.key] = headings[part.heading - 1] || null;
	});

	return { tldr, headings, parts };
};

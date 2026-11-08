/**
 * Find the photos on a page that are still the theme's placeholder (photo-placeholder.webp): plain Image blocks, and
 * synced photo sections whose pattern still has it and whose page does not override the photo.
 * No WordPress imports, so it can be unit tested (tests/js/placeholder-find.test.js).
 */
export const PLACEHOLDER = 'photo-placeholder.webp';

/**
 * @param {Array}                   blocks     Blocks as the block editor holds them ({ name, attributes, innerBlocks }).
 * @param {(ref: number) => string} syncedHtml (ref) => the synced pattern's saved content, or '' while it loads.
 * @param {(ref: number) => string} syncedName (ref) => the synced pattern's title.
 * @return {string[]} One entry per placeholder photo: the synced section's title, or "Image".
 */
export function findPlaceholders(blocks, syncedHtml, syncedName) {
	const found = [];

	const walk = (list) =>
		(list || []).forEach((block) => {
			const { name, attributes = {}, innerBlocks } = block;

			if (
				name === 'core/image' &&
				String(attributes.url || '').includes(PLACEHOLDER)
			) {
				found.push('Image');
			} else if (name === 'core/block' && attributes.ref) {
				const overridden = attributes.content?.Photo?.url; // the page swapped the photo (pattern override)
				const own =
					overridden && !String(overridden).includes(PLACEHOLDER);

				if (
					!own &&
					String(syncedHtml(attributes.ref) || '').includes(
						PLACEHOLDER
					)
				) {
					found.push(syncedName(attributes.ref) || 'Synced section');
				}
				return; // the synced pattern's own blocks are covered by its content
			}

			walk(innerBlocks);
		});

	walk(blocks);

	return found;
}

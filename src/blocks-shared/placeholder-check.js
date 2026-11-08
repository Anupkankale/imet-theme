/**
 * Before publishing: a notice listing the photos on the page that are still the theme's placeholder, so a page does
 * not go live with grey boxes. It only informs; publishing is not blocked.
 */
import { registerPlugin } from '@wordpress/plugins';
import { PluginPrePublishPanel } from '@wordpress/editor';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import { Notice } from '@wordpress/components';
import { __, sprintf } from '@wordpress/i18n';
import { findPlaceholders } from './placeholder-find';

const PlaceholderCheck = () => {
	const found = useSelect((select) => {
		const blocks = select('core/block-editor').getBlocks();
		const core = select(coreStore);
		const record = (ref) =>
			core.getEditedEntityRecord('postType', 'wp_block', ref) || {};
		const html = (ref) => {
			const content = record(ref).content;
			return typeof content === 'function'
				? content(record(ref))
				: content || '';
		};
		const title = (ref) => {
			const t = record(ref).title;
			return typeof t === 'string' ? t : t?.raw || '';
		};

		return findPlaceholders(blocks, html, title);
	}, []);

	if (!found.length) {
		return null;
	}

	return (
		<PluginPrePublishPanel
			title={__('Placeholder photos', 'imet-theme')}
			initialOpen
		>
			<Notice status="warning" isDismissible={false}>
				{sprintf(
					/* translators: %d: number of placeholder photos. */
					__(
						'%d photo(s) on this page are still the placeholder. Replace them first (click the photo, then Replace), or in Patterns for a shared section:',
						'imet-theme'
					),
					found.length
				)}
			</Notice>
			<ul>
				{found.map((name, i) => (
					<li key={i}>{name}</li>
				))}
			</ul>
		</PluginPrePublishPanel>
	);
};

registerPlugin('imet-placeholder-check', { render: PlaceholderCheck });

/**
 * Blog posts in the editor: shows writers what the site adds around their text, which the editor otherwise doesn't
 * show (IMET\Theme\Modules\Blog\SinglePost adds it when the page is viewed).
 * - A "Blog layout" panel in the Post sidebar: the top image is the Featured image, the TL;DR (found or not, with a
 *   button to add one), where the program card, banner and recommended reading land, and what the excerpt is for.
 * - In the text: the TL;DR heading and list look like the box, and the headings the parts go before are marked.
 *   Editor-only classes and labels (editor.BlockListBlock): nothing is saved into the post.
 */
import { registerPlugin } from '@wordpress/plugins';
import {
	PluginDocumentSettingPanel,
	store as editorStore,
} from '@wordpress/editor';
import { store as blockEditorStore } from '@wordpress/block-editor';
import { createBlock } from '@wordpress/blocks';
import { useSelect, useDispatch } from '@wordpress/data';
import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';
import { Button, Notice } from '@wordpress/components';
import { useEffect } from '@wordpress/element';
import { __, sprintf } from '@wordpress/i18n';
import { findBlogLayout, PARTS } from './blog-layout-find';

const PANEL = 'imet-blog-layout';
const OPENED_ONCE = 'imetBlogLayoutOpened';

const useLayout = () =>
	useSelect((sel) => findBlogLayout(sel(blockEditorStore).getBlocks()), []);

const BlogLayoutPanel = () => {
	const postType = useSelect(
		(sel) => sel(editorStore).getCurrentPostType(),
		[]
	);
	const featured = useSelect(
		(sel) => sel(editorStore).getEditedPostAttribute('featured_media'),
		[]
	);
	const excerpt = useSelect(
		(sel) =>
			(sel(editorStore).getEditedPostAttribute('excerpt') || '').trim(),
		[]
	);
	const layout = useLayout();
	const { insertBlocks } = useDispatch(blockEditorStore);
	const { toggleEditorPanelOpened } = useDispatch(editorStore);
	const opened = useSelect(
		(sel) => sel(editorStore).isEditorPanelOpened(`${PANEL}/${PANEL}`),
		[]
	);

	// Open the panel the first time a writer edits a post; after that it stays as they leave it.
	useEffect(() => {
		if (postType !== 'post') {
			return;
		}
		try {
			if (!opened && !window.localStorage.getItem(OPENED_ONCE)) {
				toggleEditorPanelOpened(`${PANEL}/${PANEL}`);
			}
			window.localStorage.setItem(OPENED_ONCE, '1');
		} catch {
			// Storage blocked: the panel just starts closed.
		}
		// eslint-disable-next-line react-hooks/exhaustive-deps -- once per post type, not on every open/close.
	}, [postType]);

	if (postType !== 'post') {
		return null;
	}

	const addTldr = () =>
		insertBlocks(
			[
				createBlock('core/heading', { level: 2, content: 'TL;DR' }),
				createBlock('core/list', {}, [
					createBlock('core/list-item', { content: '' }),
				]),
			],
			0
		);

	return (
		<PluginDocumentSettingPanel
			name={PANEL}
			title={__('Blog layout', 'imet-theme')}
			className="imet-blog-layout"
		>
			<p>
				<strong>{__('Top image', 'imet-theme')}</strong>
				<br />
				{featured
					? __(
							'The big image at the top of the article is the Featured image (the picture at the top of this sidebar). Click it to replace it. Images inside the text never change it.',
							'imet-theme'
						)
					: ''}
			</p>
			{!featured && (
				<Notice status="warning" isDismissible={false}>
					{__(
						'No Featured image: the article will have no top image. Set one with "Set featured image" at the top of this sidebar.',
						'imet-theme'
					)}
				</Notice>
			)}

			<p>
				<strong>{__('TL;DR box', 'imet-theme')}</strong>
				<br />
				{layout.tldr &&
					__(
						'Your TL;DR is used: on the site it shows as the box at the top of the article (wherever it is in the text).',
						'imet-theme'
					)}
				{!layout.tldr &&
					excerpt &&
					__(
						'The box at the top of the article shows the Excerpt, one point per sentence. To write your own points instead, add a heading "TL;DR" with a list right under it.',
						'imet-theme'
					)}
				{!layout.tldr &&
					!excerpt &&
					__(
						'None: the article has no TL;DR box. Add a heading "TL;DR" with a list right under it, or write an Excerpt.',
						'imet-theme'
					)}
			</p>
			{!layout.tldr && (
				<p>
					<Button variant="secondary" onClick={addTldr}>
						{__('Add TL;DR at the top', 'imet-theme')}
					</Button>
				</p>
			)}

			<p>
				<strong>
					{__('Added automatically on the site', 'imet-theme')}
				</strong>
			</p>
			<ul className="imet-blog-layout__parts">
				{PARTS.map((part) => {
					const heading = layout.parts[part.key];
					return (
						<li key={part.key}>
							{heading
								? sprintf(
										/* translators: 1: part name, 2: heading text. */
										__(
											'%1$s: before the heading "%2$s"',
											'imet-theme'
										),
										part.label,
										heading.text ||
											__('(empty heading)', 'imet-theme')
									)
								: sprintf(
										/* translators: %s: part name. */
										__(
											'%s: at the end of the article',
											'imet-theme'
										),
										part.label
									)}
						</li>
					);
				})}
			</ul>
			<p className="imet-blog-layout__note">
				{__(
					'They are marked with dashed labels in the text. They follow your H2 headings: they move when headings are added or removed.',
					'imet-theme'
				)}
			</p>

			<p>
				<strong>{__('Excerpt', 'imet-theme')}</strong>
				<br />
				{__(
					'Used for Google (SEO description) and the blog listing cards, and as the TL;DR box when the text has no TL;DR of its own.',
					'imet-theme'
				)}
			</p>
		</PluginDocumentSettingPanel>
	);
};

registerPlugin(PANEL, { render: BlogLayoutPanel });

// Marks in the text (editor only).
const withBlogMarks = createHigherOrderComponent(
	(BlockListBlock) => (props) => {
		const { name, clientId } = props;
		const relevant = ['core/heading', 'core/list', 'core/group'].includes(
			name
		);
		const mark = useSelect(
			(sel) => {
				if (
					!relevant ||
					sel(editorStore).getCurrentPostType() !== 'post'
				) {
					return null;
				}
				const layout = findBlogLayout(
					sel(blockEditorStore).getBlocks()
				);

				if (layout.tldr?.ids.includes(clientId)) {
					if (layout.tldr.pattern) {
						return { className: 'imet-bl-tldr-box' };
					}
					return {
						className:
							layout.tldr.ids[0] === clientId
								? 'imet-bl-tldr-head'
								: 'imet-bl-tldr-list',
					};
				}

				const part = PARTS.find(
					(p) => layout.parts[p.key]?.id === clientId
				);
				return part
					? {
							className: 'imet-bl-part',
							label: sprintf(
								/* translators: %s: part name. */
								__('%s appears here on the site', 'imet-theme'),
								part.label
							),
						}
					: null;
			},
			[relevant, clientId]
		);

		if (!mark) {
			return <BlockListBlock {...props} />;
		}

		const className = [props.className, mark.className]
			.filter(Boolean)
			.join(' ');
		const wrapperProps = mark.label
			? { ...props.wrapperProps, 'data-imet-part': mark.label }
			: props.wrapperProps;

		return (
			<BlockListBlock
				{...props}
				className={className}
				wrapperProps={wrapperProps}
			/>
		);
	},
	'withBlogMarks'
);

addFilter('editor.BlockListBlock', 'imet-theme/blog-marks', withBlogMarks);

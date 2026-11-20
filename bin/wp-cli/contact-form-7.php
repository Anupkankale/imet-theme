<?php
/**
 * WP-CLI: create or update the theme's Contact Form 7 forms: "Contact Us" (the Contact page; the same fields as the
 * theme's advisor form) and "Newsletter" (the footer's "Get tech news": an email field and Submit).
 *
 * Usage (Contact Form 7 active): wp eval 'require "wp-content/themes/imet-theme/bin/wp-cli/contact-form-7.php";'
 * (not `wp eval-file`, which rejects the strict_types declaration). Contact Form 7 6.2+ needs PHP 8.3: where the
 * command line's PHP is older (Hostinger: 8.2), run WP-CLI with /opt/alt/php83/usr/bin/php.
 * Running it again updates the same forms. It prints their shortcodes (the theme places them by title, so the ids
 * don't matter). The styles are in src/blocks-shared/_contact-form-7.scss, keyed to the imet-cf7-* classes used here;
 * the footer's colours for the newsletter in _header-footer.scss.
 *
 * @package IMET\Theme
 */

declare( strict_types = 1 );

if ( ! defined( 'WP_CLI' ) || ! class_exists( 'WPCF7_ContactForm' ) ) {
	return;
}

/**
 * Create or update a form by title and print its shortcode.
 *
 * @param string                $title Form title.
 * @param string                $form  Form template.
 * @param array<string, mixed>  $mail     Mail settings (merged over the plugin's defaults).
 * @param array<string, string> $messages Messages to replace (e.g. mail_sent_ok), merged over the plugin's.
 */
function imet_theme_cli_cf7_save( string $title, string $form, array $mail, array $messages = [] ): void {
	$existing = get_posts(
		[
			'post_type'   => 'wpcf7_contact_form',
			'title'       => $title,
			'numberposts' => 1,
			'post_status' => 'any',
		]
	);

	$form_object = $existing ? WPCF7_ContactForm::get_instance( $existing[0]->ID ) : WPCF7_ContactForm::get_template( [ 'title' => $title ] );

	$props         = $form_object->get_properties();
	$props['form'] = $form;
	$props['mail'] = array_merge(
		$props['mail'],
		[
			'use_html'      => false,
			'exclude_blank' => false,
		],
		$mail
	);

	$props['mail_2']['active'] = false;
	$props['messages']         = array_merge( (array) $props['messages'], $messages );

	$form_object->set_properties( $props );
	$form_object->set_title( $title );
	$form_object->save();

	// Reload: the short id in the shortcode comes from a hash written when the form is first saved.
	$form_object = WPCF7_ContactForm::get_instance( $form_object->id() );

	WP_CLI::log( ( $existing ? 'Updated' : 'Created' ) . " form {$title} (#" . $form_object->id() . ')' );
	WP_CLI::log( 'Sender: ' . $props['mail']['sender'] );
	WP_CLI::log( 'SHORTCODE ' . $form_object->shortcode( [ 'use_old_format' => false ] ) );
}

/**
 * The Contact Us form.
 *
 * @param string $recipient Where messages are emailed.
 */
function imet_theme_cli_contact_form_7( string $recipient ): void {
	$codes        = [
		'🇦🇪 +971|+971',
		'🇮🇳 +91|+91',
		'🇸🇦 +966|+966',
		'🇶🇦 +974|+974',
		'🇰🇼 +965|+965',
		'🇴🇲 +968|+968',
		'🇧🇭 +973|+973',
		'🇬🇧 +44|+44',
		'🇺🇸 +1|+1',
		'🇸🇬 +65|+65',
		'🇲🇾 +60|+60',
		'🇵🇰 +92|+92',
		'🇳🇬 +234|+234',
		'🇰🇪 +254|+254',
		'🇿🇦 +27|+27',
		'🇦🇺 +61|+61',
	];
	$code_options = implode( ' ', array_map( static fn ( $c ) => '"' . $c . '"', $codes ) );

	// One field per line: Contact Form 7 wraps lines in paragraphs, which the theme's styles flatten into one grid.
	$form = implode(
		"\n",
		[
			'<label class="imet-cf7-field"><span class="imet-cf7-label">Full Name</span>[text* your-name autocomplete:name placeholder "Full Name"]</label>',
			'<div class="imet-cf7-phone"><label class="imet-cf7-code"><span class="imet-cf7-label">Country code</span>[select your-code autocomplete:tel-country-code ' . $code_options . ']</label><label class="imet-cf7-field"><span class="imet-cf7-label">Phone Number</span>[tel* your-phone autocomplete:tel-national placeholder "Phone Number"]</label></div>',
			'<label class="imet-cf7-field"><span class="imet-cf7-label">Email</span>[email* your-email autocomplete:email placeholder "Email"]</label>',
			'<label class="imet-cf7-field"><span class="imet-cf7-label">LinkedIn URL</span>[url your-linkedin placeholder "LinkedIn URL"]</label>',
			'<label class="imet-cf7-field"><span class="imet-cf7-label">Message</span>[textarea your-message x3 placeholder "Message"]</label>',
			'<div class="imet-cf7-consent">[checkbox your-consent use_label_element "I signup to receive promotional notification on WhatsApp & messages|yes"]</div>',
			'<div class="imet-cf7-actions">[submit "Submit"]</div>',
		]
	);

	$body = implode(
		"\n",
		[
			'Name: [your-name]',
			'Phone: [your-code] [your-phone]',
			'Email: [your-email]',
			'LinkedIn: [your-linkedin]',
			'WhatsApp / promotional messages: [your-consent]',
			'',
			'[your-message]',
			'',
			'--',
			'Sent from the Contact Us form on [_site_title] ([_url])',
		]
	);

	imet_theme_cli_cf7_save(
		'Contact Us',
		$form,
		[
			'subject'            => '[_site_title] Contact form: [your-name]',
			'recipient'          => $recipient,
			'body'               => $body,
			'additional_headers' => 'Reply-To: [your-email]',
		]
	);
}

/**
 * The footer's newsletter sign-up ("Get tech news"): one email field and Submit.
 *
 * @param string $recipient Where sign-ups are emailed.
 */
function imet_theme_cli_newsletter_form( string $recipient ): void {
	imet_theme_cli_cf7_save(
		'Newsletter',
		implode(
			"\n",
			[
				'<label class="imet-cf7-field"><span class="imet-cf7-label">Email</span>[email* your-email autocomplete:email placeholder "Your email address"]</label>',
				'<div class="imet-cf7-actions">[submit "Submit"]</div>',
			]
		),
		[
			'subject'            => '[_site_title] Newsletter sign-up: [your-email]',
			'recipient'          => $recipient,
			'body'               => "New newsletter sign-up: [your-email]\n\n--\nSent from the footer's Get tech news form on [_site_title] ([_url])",
			'additional_headers' => 'Reply-To: [your-email]',
		],
		[ 'mail_sent_ok' => 'Thanks for subscribing! We’ll send you the latest industry news.' ]
	);
}

imet_theme_cli_contact_form_7( 'zocdeveloper@gmail.com' );
imet_theme_cli_newsletter_form( 'zocdeveloper@gmail.com' );

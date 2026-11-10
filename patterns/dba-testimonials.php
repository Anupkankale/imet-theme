<?php
/**
 * Title: Testimonials – DBA
 * Slug: imet-theme/dba-testimonials
 * Description: "What Our Clients Say" for the DBA (doctorate) pages. The source of the synced pattern "Testimonials – DBA" (Patterns > My patterns), which the theme creates once as a copy of the Global one; edit that one and it changes on every DBA page. Hidden from the inserter so no unsynced copy is added by mistake.
 * Categories: imet-sections
 * Keywords: imet, section, testimonials, clients, reviews, linkedin, dba, doctorate, shared
 * Inserter: no
 * Viewport Width: 1440
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Same section as the Global one.
require __DIR__ . '/clients-testimonials.php';

<?php
/**
 * Title: MBA – LinkedIn Testimonials
 * Slug: imet-theme/mba-testimonials
 * Description: "What Our Clients Say" for the MBA pages. The source of the synced pattern "MBA – LinkedIn Testimonials" (Patterns > My patterns), which the theme creates once as a copy of the Global one; edit that one and it changes on every MBA page. Hidden from the inserter so no unsynced copy is added by mistake.
 * Categories: imet-sections
 * Keywords: imet, section, testimonials, clients, reviews, linkedin, mba, shared
 * Inserter: no
 * Viewport Width: 1440
 *
 * @package IMET\Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Same section as the Global one, with the MBA wording in its intro.
ob_start();
require __DIR__ . '/clients-testimonials.php';
echo str_replace( 'during their DBA doctor of business administration online experience', 'during their online MBA experience', (string) ob_get_clean() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- the theme's own pattern markup.

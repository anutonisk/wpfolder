<?php
/**
 * Sets all of our theme defaults.
 *
 * @package Neel
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'neel_get_defaults' ) ) {
	/**
	 * Set default options
	 *
	 * @since 1.0
	 */
	function neel_get_defaults() {
		$customizer_defaults= 	array(
		'site_header_text_color'			=> 'ffffff',
		'post_display_type'					=>	'post-excerpt',
		'body_bg_color'						=>	'#f8f8f8',
		'accent_color'						=>	'#009688',
		'post_excerpt_length'				=>	30,
		'body_font'							=>  'IBM Plex Sans',
		'heading_font'						=> 	'DM Sans',
		'container_layout'					=>	'bordered-box',
		'banner_headtext_style'				=>	'headtext-style1',
		'post_display_type_option'			=> 	'post-excerpt',
		);
		return $customizer_defaults;
	}
}
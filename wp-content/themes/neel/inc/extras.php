<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Neel
 * @since 1.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function neel_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if( get_theme_mod( 'neel_set_dark_mode_as_default', false ) ) {
		$classes[] = 'neel-dark-theme';
	}

	$defaults = neel_get_defaults();
	$container_layout = get_theme_mod( 'neel_container_layout', $defaults['container_layout'] );
	$classes[] = $container_layout;

	return $classes;
}
add_filter( 'body_class', 'neel_body_classes' );

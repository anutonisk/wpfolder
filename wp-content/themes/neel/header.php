<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Neel
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'neel' ); ?></a>

	
	<header id="masthead" class="site-header" role="banner">
		<?php get_template_part( 'components/navigation/navigation', 'primary' ); ?>
		<?php 
		$banner_display_on = get_theme_mod( 'neel_banner_display_on', 'only-front' );
		$display_on_all_pages = 'all' === $banner_display_on ? true:false;
		$display_on_front_pages = 'front-page' === $banner_display_on ? true:false;
		$display_on_front_post = 'front-post' === $banner_display_on ? true:false;

		if( (is_front_page() || is_home() || $display_on_all_pages ) || (is_page() && $display_on_front_pages ) || (is_single() && $display_on_front_post ) ) : 
			get_template_part( 'components/header/banner','section' ); 
		endif;
		?>
	</header>

	<div class="neel-popup-search-form">
        <div class="container">            
                <?php get_search_form(); ?>
        </div>
        <button class="neel-close-popup"><span class="screen-reader-text"><?php esc_html_e( 'Close Search','neel' ); ?></span><i class="fas fa-times"></i></button>
    </div>
	
	<div id="content" class="site-content">

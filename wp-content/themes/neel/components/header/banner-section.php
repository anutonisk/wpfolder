<?php
/**
 * Template-part for displaying site banner.
 * @package Neel
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$banner_type = get_theme_mod( 'neel_banner_type', 'image' );
$banner_title = get_theme_mod( 'neel_banner_title', '' );
$banner_subtitle = get_theme_mod( 'neel_banner_subtitle', '' );
?>
<?php if( 'image' === $banner_type && has_header_image() ): ?>
	<div class="container">
		<div class="site-banner-image" >
		      <?php get_template_part( 'components/header/header', 'text' ); ?>
		</div>
	</div><!-- container -->
<?php endif; ?>
<?php if( 'color' === $banner_type ) { ?>
	<div class="container">
		<div class="site-color-banner" >
		    <?php get_template_part( 'components/header/header', 'text' ); ?>
		</div>
	</div><!-- container -->
<?php } ?>
<?php if( 'slider' === $banner_type ) { ?>
	<div class="container">
		<div class="site-slider-banner" >
		    <?php get_template_part( 'components/header/slider', 'posts' ); ?>
		</div>
	</div><!-- container -->
<?php } ?>
<?php
/**
 * Template-part for displaying navbar.
 * @package Neel
 * @since 1.0
 */

	$dark_mod_on = get_theme_mod( 'neel_add_dark_mode_support', true );
	$default_dark_on = get_theme_mod( 'neel_set_dark_mode_as_default', false );
	$show_serchbox = get_theme_mod( 'neel_searchbox_display_setting', true );
	$hide_search_on_mobile = get_theme_mod( 'neel_hide_search_icon_on_mobile', false );
	$hide_dark_icon_on_mobile = get_theme_mod( 'neel_hide_dark_mode_switch_on_mobile', false );
	$hide_search_class = '';
	$hide_dark_icon_class = '';
	if( $hide_search_on_mobile ) {
		$hide_search_class = 'hide-m-search';
	}
	if( $hide_dark_icon_on_mobile ) {
		$hide_dark_icon_class = 'hide-m-dark-icon';
	}
?>
<nav id="site-navigation" class="main-navigation" role="navigation">
	<div class="container">
		<div class="site-branding">
			<?php get_template_part( 'components/header/site', 'branding' ); ?>
		</div><!-- site-branding -->

		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="menu-button">
			<?php esc_html_e( 'Menu', 'neel' ); ?></span>
		</button>

		<div class="primary-menu-list">

			<?php wp_nav_menu( array( 'theme_location' => 'menu-primary', 'menu_id' => 'primary-menu', 'menu_class' => 'primary-menu', 'container' => false  ) ); ?>

			<?php if( true === get_theme_mod( 'neel_social_media_menu_enable', false ) ): ?>
				<?php echo neel_return_social_media_menu( 'header-social-menu' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>
			<?php endif; ?>

		</div><!-- primary-menu-list -->

		<?php if( $dark_mod_on && !$default_dark_on ) { ?>
			<div class="dark-mode-switcher <?php echo esc_attr( $hide_dark_icon_class ); ?>"><a class="dark" href="#"><i class="far fa-moon"></i></a><a class="bright" href="#"><i class="fas fa-sun"></i></a></div><!-- dark-mode-switcher -->
		<?php } ?>

		<?php if( true === $show_serchbox  ) { ?>
			<?php $search_icons_html = '<div class="search-icon-box '.esc_attr( $hide_search_class ).'" id="nav-search"><a class="link-search-icon" href="#" aria-label="Search"><i class="fas fa-search"></i></a><div id="navbar-search-box">'.get_search_form( false ).'</div></div>'; 
				echo wp_kses_post( $search_icons_html ); ?>
	    <?php } ?>
	   
	</div><!-- container -->
</nav>

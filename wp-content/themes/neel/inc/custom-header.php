<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Neel
 * 
 * @since 1.0
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses neel_header_style()
 */
function neel_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'neel_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/assets/images/header.jpg',
		'header-text'           =>  true,
		'default-text-color'    =>	'000000',
		'width'                 => 	2000,
		'height'                => 	700,
		'flex-height'           => 	true,
		'wp-head-callback'      => 	'neel_header_style',
	) ) );

	register_default_headers(
		array(
			'default-image' => array(
				'url'           => '%s/assets/images/header.jpg',
				'thumbnail_url' => '%s/assets/images/header.jpg',
				'description'   => esc_html__( 'Default Header Image', 'neel' ),
			),
		)
	);
}
add_action( 'after_setup_theme', 'neel_custom_header_setup' );

/** 
 * Customizer setting to dispaly full screen header video/image on the front page.
 *
 * @since 1.0.0
 */
function neel_custom_banner_image_height_setup( $wp_customize ) {

	$defaults = neel_get_defaults();

	$wp_customize->add_panel( 'neel_banner_section_panel', array(
	    'priority'       	=> 	41,
	    'capability'     	=> 	'edit_theme_options',
	    'theme_supports' 	=> 	'',
	    'title'          	=> 	esc_html__( 'Banner Section', 'neel'),
	    'description'    	=> 	'',
	) );

	//  ==================================================
    //  = Banner Options  
    //  ==================================================
	$wp_customize->add_section( 'neel_frontpage_banner_section', array(
	  'title' 		=> 	esc_html__( 'Banner Options', 'neel' ),
	  'panel' 		=> 	'neel_banner_section_panel', 
	  'priority' 	=> 	61,
	) );

    //neel_banner_display_on
    $atts = array(
    	'only-front'	=> 	esc_html__( 'Only on frontpage', 'neel'),
    	'front-page'	=> 	esc_html__( 'On frontpage and other pages', 'neel'),
    	'front-post'	=> 	esc_html__( 'On frontpage and blog posts', 'neel'),
    	'all'			=>	esc_html__( 'All pages and posts', 'neel'),
    );
    neel_select_control( 'banner_display_on',  'frontpage_banner_section', esc_html__( 'Banner Display On','neel' ), '', $atts, 'refresh', 1, 'only-front', '' );

    //neel_banner_type
    $atts = array(
    	'none'	=> 	esc_html__( 'None', 'neel'),
    	'color'	=> 	esc_html__( 'Color', 'neel'),
    	'image'	=> 	esc_html__( 'Image', 'neel'),
    	'slider'=> 	esc_html__( 'Posts Slider', 'neel'),
    );
    neel_select_control( 'banner_type',  'frontpage_banner_section', esc_html__( 'Banner Type', 'neel' ), '', $atts, 'refresh', 2, 'image', '' );

    //neel_banner_headtext_style
    $atts = array(
    	'headtext-style1'	=> 	esc_html__( 'Style 1(No background)', 'neel'),
    	'headtext-style2'	=> 	esc_html__( 'Style 2(Light background)', 'neel'),
    	'headtext-style3'	=> 	esc_html__( 'Style 3(Dark background)', 'neel'),
    );
    neel_select_control( 'banner_headtext_style',  'frontpage_banner_section', esc_html__( 'Banner Head Text Style', 'neel' ), '', $atts, 'refresh', 3, $defaults['banner_headtext_style'], 'neel_banner_type_not_color' );

    $slider_cats = array();
    $categories = get_categories();
    $first_cat_id = $categories[0]->term_id;
	foreach (  $categories as $category ) {
	    $slider_cats[$category->term_id] = $category->name;
	}
	
	// Category
	neel_select_control( 'featured_slider_posts_cat',  'frontpage_banner_section', esc_html__( 'Slider Posts Category', 'neel' ), 'Slider will display any 4 posts from the selectd category.', $slider_cats, 'refresh', 7, $first_cat_id, 'neel_banner_type_slider' );

    //neel_banner_bg_color
    neel_color_control(  'banner_bg_color', 'frontpage_banner_section', esc_html__( 'Banner Background Color', 'neel' ), '', 'refresh', 5, '#123456', 'neel_banner_type_color' );

    //neel_banner_text_color
    neel_color_control(  'banner_text_color', 'frontpage_banner_section', esc_html__( 'Banner Text Color', 'neel' ), esc_html__( 'Banner text color value applies only when header text style is set to Style1', 'neel'), 'refresh', 6, '#ffffff', 'neel_headtext_is_style1' );

    //neel_banner_title
    neel_text_control( 'banner_title',  'frontpage_banner_section', esc_html__( 'Banner Title', 'neel' ), '', 'refresh', 7, '','neel_banner_type_not_slider' );

    //neel_banner_subtitle
    neel_text_control( 'banner_subtitle',  'frontpage_banner_section', esc_html__( 'Banner Subtitle', 'neel' ), '', 'refresh', 8, '','neel_banner_type_not_slider' );

    //neel_banner_button_text
	neel_text_control( 'banner_button_text',  'frontpage_banner_section', 	esc_html__( 'Button text', 'neel' ), '', 'refresh', 9, '','neel_banner_type_not_slider' );

	//neel_banner_button_url
	neel_url_control( 'banner_button_url',  'frontpage_banner_section', esc_html__( 'Button URL', 'neel' ), '', 'refresh', 10, '', 'neel_banner_type_not_slider' );

}
add_action( 'customize_register', 'neel_custom_banner_image_height_setup' );

if ( ! function_exists( 'neel_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see neel_custom_header_setup().
 */
function neel_header_style() {
	$defaults = neel_get_defaults();
	$header_text_color = get_header_textcolor();
	$body_font = get_theme_mod( 'neel_body_font_select', $defaults['body_font'] );
	$heading_font = get_theme_mod( 'neel_heading_font_select', $defaults['heading_font'] );
	$background_color = get_background_color();

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
		.site-title a, .site-title a:visited, .site-title a:hover, .site-title a:focus, .site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
		body {
			font-family: '<?php echo esc_attr($body_font);?>',sans-serif;
		}
		h1,h2,h3,h4,h5,h6 {
			font-family: '<?php echo esc_attr($heading_font);?>',serif;
			font-weight: 700;
		}
		@media all and (max-width:  991px) {
			.one-container .main-navigation .primary-menu-list {
				background-color:  #<?php echo esc_attr($background_color);?>;
			}
		}
		.one-container .main-navigation ul ul {
			background-color:  #<?php echo esc_attr($background_color);?>;
		}
	</style>
	<?php
}
endif; // neel_header_style

/**
* This will output the custom WordPress settings to the live theme's WP head.
*
* Used by hook: 'wp_head'
*
* @see add_action('wp_head',$func)
* @since 1.0
*/
function neel_accent_color_css() {
	
	$css1 = '';
	$defaults = neel_get_defaults();
	$accent_color = get_theme_mod( 'neel_accent_color', $defaults['accent_color'] );
	$accent_color_rgb = neel_hex2rgb( $accent_color );
	$accent_color_rgba = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $accent_color_rgb );
	
	// Don't do anything if the current color is the default.
	if ( $accent_color !== $defaults['accent_color'] ) {
		
		$css1 ='
			a, a:hover {
				color: %1$s;
			}
			.post .posted-on, .search .page .posted-on, .single-post .post .entry-footer i {
				color: %1$s;}
			.post .entry-meta > span:not(:first-child):before, .search .page .entry-meta > span:not(:first-child):before {
				background-color: %1$s;
			}
			button, input[type=button], input[type=reset], input[type=submit] {
				border: 1px solid %1$s;
				background: %1$s;
			}
			.widget-title:after {
				background: %1$s;
			}
			blockquote:before {
				color: %1$s;
			}
			.post .posted-on a, .post .posted-on a:visited, .post .posted-on a:hover, .post .posted-on a:focus, .search .page .posted-on a, .search .page .posted-on a:visited, .search .page .posted-on a:hover, .search .page .posted-on a:focus,.type-attachment .posted-on a {
				border: 1px solid %1$s;
				color: %1$s;
			}
			.archive .archived-post-count span, .search .archived-post-count span {
				background: %1$s;
				border: 1px solid %1$s;
			}
			.main-navigation a:hover, .main-navigation a.focus, .main-navigation a:visited:hover, .main-navigation a:visited.focus {
				color: %1$s;
			}
			.main-navigation li:hover > a, .main-navigation li.focus > a, .main-navigation ul ul :hover > a, .main-navigation ul ul .focus > a {
				color: %1$s;
			}
			.main-navigation .primary-menu-list a:before {
				background: %1$s;
			}
			.pagination .current {
				background-color: %1$s;
    			border: 1px solid %1$s;
			}
			.site-banner-image button {
				background: %1$s;
				color: #ffffff;
			}
			.sticky-post-tag {
				background: %2$s;
			}
			.slider-post .headtext-style2 .slider-top-cat a, .slider-post .headtext-style2 .slider-top-cat a:visited, .slider-post .headtext-style2 .slider-top-cat a:hover {
				color: %1$s;
			}
			.headtext-style2 .read-more .read-more-link {
				background: %2$s;
				border-color: %2$s;
			}
			.comment-respond button, .comment-respond input[type=button], .comment-respond input[type=reset], .comment-respond input[type=submit] {
				color:  %1$s;
			}';
		wp_add_inline_style( 'neel-style', sprintf( $css1, esc_attr( $accent_color ), esc_attr( $accent_color_rgba ) ) );
	}
}
// Output custom CSS to live site
add_action( 'wp_enqueue_scripts', 'neel_accent_color_css', 11 );

/**
* This will output the custom WordPress settings to the live theme's WP head.
*
* Used by hook: 'wp_head'
*
* @see add_action('wp_head',$func)
* @since 1.0
*/
function neel_banner_output() {
	?>
	<!--Customizer CSS-->
	<style type="text/css">
		<?php
		$header_image = get_header_image();
		$banner_type = get_theme_mod( 'neel_banner_type', 'image' );
		$banner_bg_color = get_theme_mod( 'neel_banner_bg_color', '#123456');
		$banner_text_color = get_theme_mod( 'neel_banner_text_color', '#ffffff' );
		$header_text_color = get_header_textcolor();
		$headtext_style = get_theme_mod( 'neel_banner_headtext_style', 'headtext-style1' );

		if ( 'color' === $banner_type ) { ?>
			.site-color-banner {
				background: <?php echo esc_attr($banner_bg_color); ?>;
				color: <?php echo esc_attr($banner_text_color); ?>;
			}
		<?php }

		if ( ! empty( $header_image && 'image' === $banner_type) ) :
			$header_width = get_custom_header()->width;
			$header_height = get_custom_header()->height;
			
			$header_height320 = ( $header_height / $header_width * 320 );
			$header_height360 = ( $header_height / $header_width * 360 );
			$header_height768 = ( $header_height / $header_width * 768 );
			$header_height980 = ( $header_height / $header_width * 980 );
			$header_height1280 = ( $header_height / $header_width * 1280 );
			$header_height1366 = ( $header_height / $header_width * 1366 );
			$header_height1440 = ( $header_height / $header_width * 1440 );
			$header_height1600 = ( $header_height / $header_width * 1600 );
			$header_height1920 = ( $header_height / $header_width * 1920 );
			$header_height2560 = ( $header_height / $header_width * 2560 );
			$header_height2880 = ( $header_height / $header_width * 2880 );
			?>
			.site-banner-image {
				background: url(<?php echo esc_url($header_image); ?>) no-repeat scroll top;
				background-size: cover;
				background-position: center;
				height: <?php echo esc_attr( $header_height ); ?>px;
			}
			@media (min-width: 300px) and (max-width: 359px ) {
				.site-banner-image {
					height: <?php echo absint( $header_height320 );?>px;
				}
			}
			@media (min-width: 360px) and (max-width: 767px ) {
				.site-banner-image {
					height: <?php echo absint( $header_height360 );?>px;
				}
			}
			@media (min-width: 768px) and (max-width: 979px ) {
				.site-banner-image {
					height: <?php echo absint( $header_height768 );?>px;
				}
			}
			@media (min-width: 980px) and (max-width: 1279px ){
				.site-banner-image {
					height: <?php echo absint( $header_height980 );?>px;
				}
			}
			@media (min-width: 1280px) and (max-width: 1365px ){
				.site-banner-image {
					height: <?php echo absint( $header_height1280 );?>px;
				}
			}
				@media (min-width: 1366px) and (max-width: 1439px ){
				.site-banner-image {
					height: <?php echo absint( $header_height1366 );?>px;
				}
			}
				@media (min-width: 1440px) and (max-width: 1599px ) {
				.site-banner-image {
					height: <?php echo absint( $header_height1440 );?>px;
				}
			}
			@media (min-width: 1600px) and (max-width: 1919px ) {
				.site-banner-image {
					height: <?php echo absint( $header_height1600 );?>px;
				}
			}
			@media (min-width: 1920px) and (max-width: 2559px ) {
				.site-banner-image {
					height: <?php echo absint( $header_height1920 );?>px;
				}
			}
			@media (min-width: 2560px)  and (max-width: 2879px ) {
				.site-banner-image {
					height: <?php echo absint( $header_height2560 );?>px;
				}
			}
			@media (min-width: 2880px) {
				.site-banner-image {
					height: <?php echo absint( $header_height2880 );?>px;
				}
			}
			.site-banner-image {
				-webkit-box-shadow: 0px 0px 2px 1px rgba(182,182,182,0.3);
		    	-moz-box-shadow: 0px 0px 2px 1px rgba(182,182,182,0.3);
		    	-o-box-shadow: 0px 0px 2px 1px rgba(182,182,182,0.3);
		    	box-shadow: 0px 0px 2px 1px rgba(182,182,182,0.3);
			}
		<?php else : ?>
			.site-banner-image {
				-webkit-box-shadow: 0px 0px 1px 1px rgba(182,182,182,0.3);
		    	-moz-box-shadow: 0px 0px 1px 1px rgba(182,182,182,0.3);
		    	-o-box-shadow: 0px 0px 1px 1px rgba(182,182,182,0.3);
		    	box-shadow: 0px 0px 1px 1px rgba(182,182,182,0.3);
			}
			.site-banner-image {
				height: 300px;
			}
			@media (max-width: 767px) {
				.site-banner-image  {
					height: 200px;
				}
			}
			@media (max-width: 359px) {
				.site-banner-image {
					height: 150px;
				}
			}
		<?php endif; ?>
		
		<?php if (  ( ( 'headtext-style1' === $headtext_style ) ) ) { ?>
			.banner-title,
			.banner-subtitle,
			.neel-dark-theme .banner-title,
			.neel-dark-theme .banner-subtitle {
				color: <?php echo esc_attr( $banner_text_color ); ?>;
			}
			.slider-post .headtext-style1,.site-slider-banner .slider-post .slider-top-cat a, .site-slider-banner .slider-post .slider-top-cat a:visited,
			.slider-post .headtext-style1 a, .slider-post .headtext-style1 a:visited, .slider-post .headtext-style1 a:hover, .slider-post .headtext-style1 .slider-top-cat .top-cat-links,.slider-post .headtext-style1 a, .slider-post .headtext-style1 a:visited, .slider-post .headtext-style1 a:hover, .slider-post .headtext-style1 .slider-top-cat .top-cat-links,.headtext-style1 .read-more .read-more-link {
				color: <?php echo esc_attr( $banner_text_color ); ?>;
			}
			.headtext-style1 .read-more .read-more-link {
				border-color: <?php echo esc_attr( $banner_text_color ); ?>;
			}
		<?php } ?>
		<?php if ( 'color' === $banner_type ) { ?>
			.banner-title,
			.banner-subtitle,
			.neel-dark-theme .banner-title,
			.neel-dark-theme .banner-subtitle  {
				color: <?php echo esc_attr( $banner_text_color ); ?>;
			}
		<?php } ?>
	</style>
	<!--/Customizer CSS-->
<?php
}
// Output custom CSS to live site
add_action( 'wp_head' , 'neel_banner_output' );

/**
 * Banner type is color.
 */
function neel_banner_type_color( $control ) {
    if ( 'color' === $control->manager->get_setting( 'neel_banner_type' )->value() && 'none' !== $control->manager->get_setting( 'neel_banner_type' )->value() ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Banner type is not color.
 */
function neel_banner_type_not_color( $control ) {
    if ( 'color' !== $control->manager->get_setting( 'neel_banner_type' )->value() && 'none' !== $control->manager->get_setting( 'neel_banner_type' )->value() ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Banner type is image.
 */
function neel_banner_type_image( $control ) {
    if ( 'image' === $control->manager->get_setting( 'neel_banner_type' )->value() && 'none' !== $control->manager->get_setting( 'neel_banner_type' )->value() ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Banner type is not slider.
 */
function neel_banner_type_slider( $control ) {
    if ( 'slider' === $control->manager->get_setting( 'neel_banner_type' )->value() ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Banner type is not slider.
 */
function neel_banner_type_not_slider( $control ) {
    if ( 'slider' !== $control->manager->get_setting( 'neel_banner_type' )->value() && 'none' !== $control->manager->get_setting( 'neel_banner_type' )->value() ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Banner header text style is style1 and banner type not none.
 */
function neel_headtext_is_style1( $control ) {
    if(  ('headtext-style1' === $control->manager->get_setting( 'neel_banner_headtext_style' )->value() || 'color' === $control->manager->get_setting( 'neel_banner_type' )->value()) && 'none' !== $control->manager->get_setting( 'neel_banner_type' )->value() ) {
    	return true;
    } else {
    	return false;
    }
}
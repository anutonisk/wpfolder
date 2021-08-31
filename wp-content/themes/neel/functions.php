<?php
/**
 * Neel functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Neel
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! function_exists( 'neel_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function neel_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'neel' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'neel', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'neel-featured-image', 640, 9999 );
	add_image_size( 'neel-list-thumbnail', 400, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-primary' => esc_html__( 'Primary Menu', 'neel' ),
		) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'neel_custom_background_args', array(
		'default-color' => 'f8f8f8',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'neel_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function neel_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'neel_content_width', 640 );
}
add_action( 'after_setup_theme', 'neel_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function neel_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'neel' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	//Regsiger fotter widget area left
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area - Left', 'neel' ),
		'id'            => 'neel-footer-widget-area-left',
		'description'   => esc_html__( 'Add widgets here.', 'neel' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	//Regsiger fotter widget area center
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area - Center', 'neel' ),
		'id'            => 'neel-footer-widget-area-center',
		'description'   => esc_html__( 'Add widgets here.', 'neel' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	//Regsiger fotter widget area Right
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area - Right', 'neel' ),
		'id'            => 'neel-footer-widget-area-right',
		'description'   => esc_html__( 'Add widgets here.', 'neel' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '<span></h2>',
	) );
}
add_action( 'widgets_init', 'neel_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function neel_scripts() {
	//Enqueue fontawesome style
	wp_enqueue_style( 'neel-fontawesome-style',  get_template_directory_uri().'/assets/font-awesome/css/all.min.css' );
	//Enqueue v4 compatibility fontawesome style 
	wp_enqueue_style( 'neel-fontawesome-style',  get_template_directory_uri().'/assets/font-awesome/css/v4-shims.min.css' );
	wp_enqueue_style( 'neel-slick-slider-css', get_template_directory_uri() . '/assets/slick/slick.css' );

	wp_enqueue_style( 'neel-style', get_stylesheet_uri() );

	wp_enqueue_script( 'neel-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), false, true );
	wp_enqueue_script( 'neel-slick-slider-js', get_template_directory_uri() . '/assets/slick/slick.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'neel-js', get_template_directory_uri() . '/assets/js/neel.js', array(), false, true );

	wp_enqueue_script( 'neel-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), false, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script(
		'neel-navigation',
		'neel_screenReaderText',
		array(
			'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'neel' ) . '</span>',
			'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'neel' ) . '</span>',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'neel_scripts' );

/**
 * Load google fornts selected by user.
 * @since 1.0
 *
 */
function neel_google_fonts() {

	$defaults = neel_get_defaults();
	
	$body_font = get_theme_mod( 'neel_body_font_select', $defaults['body_font'] );
	$heading_font = get_theme_mod( 'neel_heading_font_select', $defaults['heading_font'] );	
	
	$fonts_url = '';
	
	if ( '' !== $body_font ) {
		$body_font = esc_html( $body_font );
	} 
	if ( '' !== $heading_font ) {
		$heading_font = esc_html( $heading_font );
	}

	/** Translators: If there are characters in your language that are not
	 * supported by Lora, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$body_font_on = _x( 'on', 'Google font for body text: on or off', 'neel' );

	/* Translators: If there are characters in your language that are not
	* supported by heading font, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$heading_font_on = _x( 'on', ' Gogle font for heading text: on or off', 'neel' );

	// Construct url query based on chosen fonts
	if ( 'off' !== $body_font_on || 'off' !== $heading_font_on ) {
		$font_families = array();
		if ( 'off' !== $body_font_on ) {
			$font_families[] = $body_font;
		}
		if ( 'off' !== $heading_font_on ) {
			$font_families[] = $heading_font.':400,700';
		}
		
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'greek,cyrillic,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	wp_register_style( 'neel-google-fonts', $fonts_url, array(), null );
	wp_enqueue_style( 'neel-google-fonts' );
}

add_action( 'wp_enqueue_scripts', 'neel_google_fonts' );

/**
 * Function which returns social media menu.
 * @since 1.0
 */
if ( ! function_exists( 'neel_return_social_media_menu' ) ) {

	function neel_return_social_media_menu( $social_class='' ) {

		$social_media_icons_html = '';
		
		//array of focial media icons which uses 'fas' class
		$fas_elements = array('envelope','envelope-open','envelope-square','shopping-cart','credit-card','gamepad','map-marker','heart','rss','rss-square','info-circle','info','film');

		if( true === get_theme_mod( 'neel_social_media_menu_enable', false) ) {
			$social_media_icons_html .= '<div id="socialMenuResponsive" class="'.esc_attr( $social_class ).'">';
			$social_media_icons_html .= '<ul>';
			
			for($i=1; $i<=4; $i++ ){
				$social_media_icon[$i] = get_theme_mod( 'neel_social_media_icon_'.$i, 'facebook-f' );
				$social_media_url[$i] = get_theme_mod( 'neel_social_media_url_'.$i, '' );

				//find the fontawesome icon class
				if( in_array( $social_media_icon[$i], $fas_elements ) ){
					$icon_class[$i] = 'fas';	
				} else {
					$icon_class[$i] = 'fab';
				}
				
				if ( '' !== $social_media_url[$i]  ) :
					$social_media_icons_html .= '<li class="menu-item page-item"><a href="'.esc_url( $social_media_url[$i] ).'" target="_blank">
					<i class="'.esc_attr( $icon_class[$i] ).' fa-'.esc_attr( $social_media_icon[$i] ).'"></i></a></li>';
				endif;
			} //for loop end
			$social_media_icons_html.= '</ul></div>';
		}
		return wp_kses_post( $social_media_icons_html );
	} 
}

if ( ! function_exists( 'neel_excerpt' ) ) {

	function neel_excerpt( $limit = 54 ) {
	    echo '<p>'. wp_kses_post( wp_trim_words( get_the_excerpt(), $limit) ) .'</p>';
	}

}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Default valudes for customizer options.
 */
require get_template_directory() . '/inc/defaults.php';

/**
 * Custom Header Addition.
 */
require get_template_directory() . '/inc/custom-header.php';

require get_template_directory() . '/inc/sanitize-functions.php';
require get_template_directory() . '/inc/customizer-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer Upgrade to Pro Section.
 */
require get_template_directory() . '/inc/upsell/class-customize.php';

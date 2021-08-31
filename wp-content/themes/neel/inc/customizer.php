<?php
/**
 * Neel Theme Customizer
 *
 * @package Neel
 * @since 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function neel_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'header_image' )->panel = 'neel_banner_section_panel';
	$wp_customize->get_section( 'header_image' )->title = 'Banner/Header Image';
	$wp_customize->remove_control('display_header_text');
	$defaults = neel_get_defaults();

	//  =============================================================
    //  = Accent color =
    //  =============================================================
	// Accent color setting
	$wp_customize->add_setting( 'neel_accent_color', array(
		'default'           =>	$defaults['accent_color'],
		'sanitize_callback' => 	'sanitize_hex_color',
		'transport'         => 	'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'neel_accent_color', array(
		'label'       		=> 	esc_html__( 'Accent Color', 'neel' ),
		'section'     		=> 	'colors',
		'settings'    		=> 	'neel_accent_color',
		'description' 		=> 	esc_html__( 'Applied to some of the elements on Page and Post.', 'neel' ),
	) ) );

	//  =============================================================
    //  = Add Theme Options Panel =
    //  =============================================================
	
	$wp_customize->add_panel( 'neel_options_panel', array(
		'priority'       => 180,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Other Options', 'neel' ),
		'description'    => '',
	) );
	//  =============================================================
    //  = Blog Page Section         =
    //  =============================================================
	$wp_customize->add_section( 'neel_blog_page_options_section', array(
	  'title' 		=> 	esc_html__( 'Blog Page Settings', 'neel' ),
	  'priority' 	=> 	1,
	  'panel' 		=> 	'neel_options_panel',
	) );

	//  =============================================================
    //  Post content display option: Post Excerpt/Full Post          
    //  =============================================================
	$choices  =		array(
		        'post-excerpt'	=>	esc_html__( 'Post Excerpt', 'neel' ),
		        'full-content'		=>	esc_html__( 'Full Content', 'neel' ),
			);
	neel_radio_control( 'post_display_type_option',  'blog_page_options_section', esc_html__( 'How would you like to display post content on Blog posts index page?', 'neel' ), '', $choices, 'refresh', 1, $defaults['post_display_type_option'], '' );
	$atts = array(
		'min'	=> 0,
		'max'	=>	54,
	);
	neel_number_control('post_excerpt_length',  'blog_page_options_section', esc_html__( 'Post Excerpt Length','neel'), esc_html__( 'Default length is 30 characters. Min. 0 and Max. 54 characters.', 'neel' ), $atts, 'refresh', 2, 30, 'absint', 'neel_post_excerpt_length_callback' );

	
	//================================================================
    //Social Media Options: Select any four social media services to display on home page  =
    //================================================================
	$wp_customize->add_section( 'neel_social_media_settings_section', array(
	  'title' 		=> 	__( 'Social Menu Section', 'neel' ),
	  'priority' 	=> 	4,
	  'capability' 	=> 	'edit_theme_options',
	  'panel' 		=> 	'neel_options_panel',
	) );
	$wp_customize->add_setting( 'neel_social_media_menu_enable', array(
	  'capability' 	=> 	'edit_theme_options',
	  'default' 	=> 	false,
	  'transport' 	=> 	'refresh', 
	  'sanitize_callback' => 'neel_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'neel_social_media_menu_enable', array(
	  'type' 		=> 	'checkbox',
	  'priority' 	=> 	1, 
	  'section' 	=> 	'neel_social_media_settings_section', 
	  'label' 		=> 	__( 'Enable Social Media Icons in top Navigation.', 'neel' ),
	  'settings'   	=> 	'neel_social_media_menu_enable',
	) );

	// Social Icons Array
	$social_media_names = array(
		'facebook-f' 			=> 'Facebook',
		'facebook-square' 		=> 'Facebook Square',
		'twitter' 				=> 'Twitter',
		'twitter-square' 		=> 'Twitter Square',
		'google' 				=> 'Google',
		'linkedin'				=> 'Linkedin Square',
		'linkedin-in' 			=> 'LinkedIn',
		'pinterest' 			=> 'Pinterest',
		'pinterest-square'		=> 'Pinterest Square',
		'behance' 				=> 'Behance',
		'behance-square'		=> 'Behance Square',
		'tumblr' 				=> 'Tumblr',
		'tumblr-square' 		=> 'Tumblr Square',
		'reddit' 				=> 'Reddit',
		'reddit-square' 		=> 'Reddit Square',
		'dribbble' 				=> 'Dribbble',
		'vk' 					=> 'vKontakte',
		'skype' 				=> 'Skype',
		'film' 					=> 'Film',
		'youtube' 				=> 'Youtube',
		'youtube-square' 		=> 'Youtube Square',
		'vimeo-v'				=> 'Vimeo',
		'vimeo'					=> 'Vimeo Square 1',
		'vimeo-square' 			=> 'Vimeo Square 2',
		'soundcloud' 			=> 'Soundcloud',
		'instagram' 			=> 'Instagram',
		'info' 					=> 'Info',
		'info-circle' 			=> 'Info Circle',
		'flickr' 				=> 'Flickr',
		'rss' 					=> 'RSS',
		'rss-square' 			=> 'RSS Square',
		'heart' 				=> 'Heart',
		'github' 				=> 'Github',
		'github-alt' 			=> 'Github Alt',
		'github-square' 		=> 'Github Square',
		'stack-overflow' 		=> 'Stack Overflow',
		'qq' 					=> 'QQ',
		'weibo' 				=> 'Weibo',
		'weixin' 				=> 'Weixin',
		'xing' 					=> 'Xing',
		'xing-square' 			=> 'Xing Square',
		'gamepad' 				=> 'Gamepad',
		'medium' 				=> 'Medium',
		'map-marker' 			=> 'Map Marker',
		'envelope' 				=> 'Envelope',
		'envelope-open' 		=> 'Envelope Open',
		'envelope-square' 		=> 'Envelope Square',
		'spotify'				=> 'Spotify',
		'shopping-cart'			=> __( 'Cart', 'neel' ),
		'cc-paypal' 			=> 'PayPal',
		'credit-card' 			=> __( 'Credit Card', 'neel' ), 
	);
	
	for( $count=1; $count<=4; $count++ ) {
		
		$wp_customize->add_setting( 'neel_social_media_icon_'.$count, array(
			'default'	 		=> 	'facebook-f',
			'transport'	 		=> 	'refresh',
			'capability' 		=> 	'edit_theme_options',
			'sanitize_callback' => 	'neel_sanitize_select'
		) );
		$wp_customize->add_control( 'neel_social_media_icon_'.$count, 
			array(
				'label'			=> 	__( 'Social Media Name', 'neel' ),
				'settings'		=> 	'neel_social_media_icon_'.$count,
				'section'		=> 	'neel_social_media_settings_section',
				'type'			=> 	'select',
				'choices' 		=> 	$social_media_names,
				'priority'		=> 	$count+1,
		) );
		$wp_customize->add_setting( 'neel_social_media_url_'.$count, array(
			'default'	 		=> 	'',
			'transport'	 		=> 	'refresh',
			'capability' 		=> 	'edit_theme_options',
			'sanitize_callback' => 	'esc_url_raw',
		) );
		$wp_customize->add_control( 'neel_social_media_url_'.$count, 
			array(
				'label'			=> 	__( 'Social Media URL', 'neel' ),
				'settings'		=> 	'neel_social_media_url_'.$count,
				'section'		=> 	'neel_social_media_settings_section',
				'type'			=> 	'text',
				'priority'		=> 	$count+1,
		) );
	}
	//  ================================================================
    //  = Searchbox Section           =
    //  ================================================================
	$wp_customize->add_section( 'neel_searchbox_section', 
		array(
			'title'		=> 	__( 'Search Box', 'neel' ),
			'panel'		=> 	'neel_options_panel',
			'priority' 	=> 	5,
		)
	);
	//Add setting for diplaying search box to primary navigation menu.
	neel_checkbox_control( 'searchbox_display_setting',  'searchbox_section', esc_html__( 'Add Search button to the Top Navigation.', 'neel' ), '', 'refresh', 1, true );
	//Hide search icon on mobile.
	neel_checkbox_control( 'hide_search_icon_on_mobile',  'searchbox_section', esc_html__( 'Hide search button on small devices.', 'neel' ), '', 'refresh', 2, false );

	//  =============================================================
    //  = Dark Color Mode Section       =
    //  =============================================================
	$wp_customize->add_section( 'neel_dark_color_scheme_section', array(
	  'title' 		=> 	esc_html__( 'Dark Color Mode', 'neel' ),
	  'priority' 	=> 	10,
	  'panel' 		=> 	'neel_options_panel',
	) );
	//Dark Color Mode Setting
	neel_checkbox_control( 'add_dark_mode_support',  'dark_color_scheme_section', esc_html__( 'Add Dark/Bright Mode Button in the primary menu.', 'neel' ), esc_html__('If dark mode is set as default mode then dark/bright mode switch will not be added to the primary menu.','neel'), 'refresh', 1, true, $active_callback = '' );

	//Default Dark Color Mode Setting
	neel_checkbox_control( 'set_dark_mode_as_default',  'dark_color_scheme_section', esc_html__( 'Set Dark Mode as default color scheme.', 'neel' ), '', 'refresh', 2, false, $active_callback = '' );

	//Hide dark mode switch on mobile
	neel_checkbox_control( 'hide_dark_mode_switch_on_mobile',  'dark_color_scheme_section', esc_html__( 'Hide dark mode switch on small devices.', 'neel' ), '', 'refresh', 3, false, $active_callback = '' );
	//  =============================================================
    //  = Layout Options       =
    //  =============================================================
	$wp_customize->add_section( 'neel_layout_section', array(
	  'title' 		=> 	esc_html__( 'Layout', 'neel' ),
	  'priority' 	=> 	40,
	  //'panel' 		=> 	'neel_options_panel',
	) );
	$atts = array(
		'bordered-box' 	=> esc_html__( 'Bordered Box(Default)', 'neel' ),
		'simple-box' 	=> esc_html__( 'Simple Box', 'neel' ),
		'shadowed-box' 	=> esc_html__( 'Shadowed Box', 'neel' ),
		'one-container'	=> esc_html__( 'One Container', 'neel' ),
	);
	neel_select_control( 'container_layout',  'layout_section', esc_html__( 'Container', 'neel' ), '', $atts, 'refresh', 1, $defaults['container_layout'] );

	//  ================================================================
    //  = Typography Section        =
    //  ================================================================
	$wp_customize->add_section( 'neel_font_family_section', array(
		'title' 		=> 	__( 'Typography', 'neel' ),
		'priority' 	=> 	1,
		'capability' 	=> 	'edit_theme_options',
		'priority'       => 42,
	) );
	//Set recomended fonts array for body and heading
	$font_family = array(
		'DM Sans'		 =>	'DM Sans',
		'Merriweather'	 => 'Merriweather',
		'IBM Plex Sans'  => 'IBM Plex Sans',
		'Libre Franklin' => 'Libre Franklin',
		'Playfair Display' => 'Playfair Display',
	);
	//  =============================================================
    //  = Heading Font Settings         =
    //  =============================================================
    neel_select_control( 'heading_font_select', 'font_family_section', esc_html__( 'Heading Font Family', 'neel' ), '', $font_family, 'refresh', 1, $defaults['heading_font'] );
	//  =============================================================
    //  = Body Font Settings         =
    //  =============================================================
	neel_select_control( 'body_font_select', 'font_family_section', esc_html__( 'Body Font Family', 'neel' ), '', $font_family, 'refresh', 2, $defaults['body_font'] );

	// Add Section for Theme Information.
	$wp_customize->add_section( 'neel_section_theme_info', array(
		'title'    => esc_html__( 'Theme Info', 'neel' ),
		'priority' => 200,
		'panel'    => 'neel_options_panel',
	) );

	// Add Theme Info Control.
	$wp_customize->add_control( new Neel_Customize_Theme_Info_Control(
		$wp_customize, 'neel_theme_info_links', array(
			'section'  => 'neel_section_theme_info',
			'settings' => array(),
			'priority' => 100,
		)
	) );
}
add_action( 'customize_register', 'neel_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function neel_customize_preview_js() {
	wp_enqueue_script( 'neel_customizer_preview', get_template_directory_uri() . '/assets/js/customizer-preview.js', array( 'customize-preview' ), false, true );
}
add_action( 'customize_preview_init', 'neel_customize_preview_js' );

/**
 * Post Excerpt Length callback function
 */
function neel_post_excerpt_length_callback( $control ) {
    if ( 'post-excerpt' === $control->manager->get_setting( 'neel_post_display_type_option' )->value() ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays the theme links in the Customizer.
	 */
	class Neel_Customize_Theme_Info_Control extends WP_Customize_Control {
		/**
		 * Render Control
		 */
		public function render_content() {
			?>

			<div class="theme-info-links">

				<span class="customize-control-title"><?php esc_html_e( 'Theme Information Links', 'neel' ); ?></span>

				<p>
					<a href="<?php echo esc_url( 'https://www.falgunithemes.com/downloads/neel/' ); ?>" target="_blank">
						<?php esc_html_e( 'Theme Homepage', 'neel' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( 'https://www.falgunithemes.com/neel-user-guide/' ); ?>" target="_blank">
						<?php esc_html_e( 'Theme Documentation', 'neel' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( 'https://wordpress.org/support/theme/neel/reviews/' ); ?>" target="_blank">
						<?php esc_html_e( 'Rate this theme', 'neel' ); ?>
					</a>
				</p>

			</div>

			<?php
		}
	}

endif;


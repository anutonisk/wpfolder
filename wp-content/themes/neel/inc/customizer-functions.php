<?php 
/**
 * Customizer controls reusable functions
 * @package Neel
 * @since 1.0
 */

	// checkbox
	function neel_checkbox_control( $id,  $section, $label, $description, $transport, $priority, $default, $active_callback = '' ) {
		global $wp_customize;

		$wp_customize->add_setting( 'neel_'. $id , array(
			'default'	 		=> 	$default,
			'transport'	 		=> 	$transport,
			'sanitize_callback' => 	'neel_sanitize_checkbox'
		) );
		$wp_customize->add_control( 'neel_'. $id, array(
			'label'				=> 	$label,
			'description'		=>	$description,
			'section'			=> 	'neel_'.$section,
			'settings'  		=> 	'neel_'. $id,
			'type'				=> 	'checkbox',
			'priority'			=> 	$priority,
			'active_callback' 	=> 	$active_callback,
		) );
	}
	// text
	function neel_text_control( $id,  $section, $label, $description, $transport, $priority, $default, $active_callback  = '' ) {
		global $wp_customize;
		$wp_customize->add_setting( 'neel_'. $id, array(
			'default'	 		=> 	$default,
			'transport'	 		=> 	$transport,
			'sanitize_callback' => 	'wp_kses_post',
		) );
		$wp_customize->add_control( 'neel_'. $id, array(
			'label'				=> 	$label,
			'description'		=>	$description,
			'section'			=> 	'neel_'. $section,
			'settings'  		=> 	'neel_'. $id,
			'type'				=> 	'text',
			'priority'			=> 	$priority,
			'active_callback' 	=> 	$active_callback,
		) );
	}

	// color
	function neel_color_control(  $id, $section, $label, $description, $transport, $priority, $default, $active_callback  = '' ) {
		global $wp_customize;
		$wp_customize->add_setting( 'neel_'. $id, array(
			'default'	 		=> 	$default,
			'transport'	 		=> 	$transport,
			'sanitize_callback' => 	'sanitize_hex_color'
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'neel_'. $id, array(
			'label' 			=>  $label,
			'description'		=>	$description,
			'section'			=> 	'neel_'. $section,
			'settings'  		=> 	'neel_'. $id,
			'priority'			=> 	$priority,
			'active_callback' 	=> 	$active_callback,
		) ) );
	}

	// textarea
	function neel_textarea_control( $id,  $section, $label, $description, $transport, $priority, $default, $active_callback = ''   ) {
		global $wp_customize;
		$wp_customize->add_setting( 'neel_'. $id, array(
			'default'	 		=>	$default,
			'transport'	 		=> 	$transport,
			'sanitize_callback' => 	'wp_kses_post',
		) );
		$wp_customize->add_control( 'neel_'. $id, array(
			'label'				=> 	$label, 
			'description'		=> 	$description,
			'section'			=> 	'neel_'. $section,
			'settings'  		=> 	'neel_'. $id,
			'type'				=> 	'textarea',
			'priority'			=> 	$priority,
			'active_callback' 	=> 	$active_callback,
		) );
	}

	// url
	function neel_url_control( $id,  $section, $label, $description, $transport, $priority, $default, $active_callback  = '' ) {
		global $wp_customize;
		$wp_customize->add_setting( 'neel_'. $id, array(
			'default'	 		=> 	$default,
			'transport'	 		=> 	$transport,
			'sanitize_callback' => 	'esc_url_raw',
		) );
		$wp_customize->add_control( 'neel_'. $id, array(
			'label'				=>	$label,
			'description'		=>	$description,
			'section'			=> 	'neel_'. $section,
			'settings'  		=> 	'neel_'. $id,
			'type'				=> 	'text',
			'priority'			=> 	$priority,
			'active_callback' 	=> 	$active_callback,
		) );
	}

	// number absint
	function neel_number_control($id,  $section, $label, $description, $atts, $transport, $priority, $default, $sanitize_fun, $active_callback = '' ) {
		global $wp_customize;

		$wp_customize->add_setting( 'neel_'. $id, array(
			'default'	 		=> 	$default,
			'transport'	 		=> 	$transport,
			'sanitize_callback' => 	$sanitize_fun,
		) );
		$wp_customize->add_control( 'neel_'. $id, array(
			'label'				=> 	$label, 
			'description'		=>	$description,
			'section'			=> 	'neel_'. $section,
			'settings'  		=> 	'neel_'. $id,
			'type'				=> 	'number',
			'input_attrs' 		=> 	$atts,
			'priority'			=> 	$priority,
			'active_callback' 	=> 	$active_callback,
		) );
	}


	// select
	function neel_select_control( $id,  $section, $label, $description, $atts, $transport, $priority, $default, $active_callback  = '' ) {
		global $wp_customize;
		$wp_customize->add_setting( 'neel_'. $id, array(
			'default'	 		=> 	$default,
			'transport'	 		=> 	$transport,
			'sanitize_callback' => 	'neel_sanitize_select'
		) );
		$wp_customize->add_control( 'neel_'. $id, array(
			'label'				=> 	$label, 
			'description'		=>	$description,
			'section'			=> 	'neel_'. $section,
			'settings'  		=> 	'neel_'. $id,
			'type'				=> 	'select',
			'choices' 			=> 	$atts,
			'priority'			=> 	$priority,
			'active_callback' 	=> 	$active_callback,
		) );
	}

	// radio
	function neel_radio_control( $id,  $section, $label, $description, $atts, $transport, $priority, $default, $active_callback  = '' ) {
		global $wp_customize;

		$wp_customize->add_setting( 'neel_'. $id, array(
			'default'	 		=> 	$default,
			'transport'	 		=> 	$transport,
			'sanitize_callback' => 	'neel_sanitize_radio',
		) );
		$wp_customize->add_control( 'neel_'. $id, array(
			'label'				=> 	$label,
			'description'		=>	$description,
			'section'			=> 	'neel_'. $section,
			'settings'  		=> 	'neel_'. $id,
			'type'				=> 	'radio',
			'choices' 			=> 	$atts,
			'priority'			=> 	$priority,
			'active_callback' 	=> 	$active_callback,
		) );
	}

	// image
	function neel_image_control( $id,  $section, $label, $transport, $priority, $default, $active_callback  = '' ) {
		global $wp_customize;
		$wp_customize->add_setting( 'neel_'. $id, array(
		    'default' 				=> 	$default,
		    'transport' 			=> 	$transport,
		    'sanitize_callback' 	=> 	'esc_url_raw'
		) );
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'neel_'. $id, array(
				'label'    			=>  $label,
				'section'			=> 	'neel_'. $section,
				'settings'  		=> 	'neel_'. $id,
				'priority' 			=>  $priority,
				'active_callback' 	=> 	$active_callback,
			)
		) );
	}

	// image crop
	function neel_image_crop_control( $id,  $section, $label, $width, $height, $transport, $priority, $default, $active_callback  = '' ) {
		global $wp_customize;
		$wp_customize->add_setting( 'neel_'. $id, array(
			'transport' 			=> 	$transport,
			'sanitize_callback' 	=> 	'absint',
		) );
		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control( $wp_customize, 'neel_'. $id, array(
				'label'    			=> 	$label,
				'section'			=> 	'neel_'. $section,
				'settings'  		=> 	'neel_'. $id,
				'flex_width'  		=> 	true,
				'flex_height' 		=> 	true,
				'width'       		=> 	$width,
				'height'      		=> 	$height,
				'priority' 			=> 	$priority,
				'active_callback' 	=> 	$active_callback,
			)
		) );
	}
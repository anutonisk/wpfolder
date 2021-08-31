<?php 
/**
 * Sanitize Functions
 *
 * Used to validate the user input of the theme settings
 * Based on https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 *
 * @package Neel
 * @since 1.0
 */
 
/**
 * Sanitize Radio Control Setting
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function neel_sanitize_radio( $input, $setting ) {
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);
 
    //get the list of possible radio box options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
                     
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
  
}

/**
 * Sanitize Checkbox Control Setting
 * @since 1.0.0
 */
function neel_sanitize_checkbox( $input ){
     
    // Boolean check.
	return ( ( isset( $input ) && true === $input ) ? true : false );
}

/**
 * Sanitize Select Control Setting
 * @since 1.0.0
 */
function neel_sanitize_select( $input, $setting ) {
	
	// get all select options
	$options = $setting->manager->get_control( $setting->id )->choices;
	
	// return default if not valid
	return ( array_key_exists( $input, $options ) ? $input : $setting->default );
}
/**
 * Integer sanitization
 *
 * @param  string       Input value to check
 * @return integer  Returned positive integer value
 */
if ( ! function_exists( 'neel_sanitize_unsigned_integer' ) ) {
    function neel_sanitize_unsigned_integer( $input ) {
        return absint( $input );
    }
}

/**
 * Integer sanitization
 *
 * @param  string       Input value to check
 * @return integer  Returned integer value
 */
if ( ! function_exists( 'neel_sanitize_integer' ) ) {
    function neel_sanitize_integer( $input ) {
        return intval( $input );
    }
}

if ( ! function_exists( 'neel_sanitize_unsigned_floatval' ) ) {
    /**
     * Sanitize integers that can use decimals.
     *
     */
    function neel_sanitize_unsigned_floatval( $input ) {
        return abs( floatval( $input ) );
    }
}

if ( ! function_exists( 'neel_sanitize_floatval' ) ) {
    /**
     * Sanitize integers that can use decimals.
     *
     */
    function neel_sanitize_floatval( $input ) {
        return floatval( $input );
    }
}
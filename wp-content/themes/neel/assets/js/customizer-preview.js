/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a,.site-description' ).css( {
				'color': to
			} );
		} );
	} );

	// Banner text color.
	wp.customize( 'neel_banner_text_color', function( value ) {
		value.bind( function( to ) {
			$( '.banner-title,.banner-subtitle' ).css( {
				'color': to
			} );
		} );
	} );


	// Accent color.
	wp.customize( 'neel_accent_color', function( value ) {
		value.bind( function( to ) {
			$( '.post .posted-on, .search .page .posted-on, .single-post .post .entry-footer i' ).css( {
				'color': to
			});
			$( '.post .entry-meta > span:not(:first-child):before, .search .page .entry-meta > span:not(:first-child):before' ).css( {
				'background-color': to
			});
			$( '.page-numbers.current' ).css({
				'background-color': to,
				'border-color': to,
			});
			$( 'button, input[type=button], input[type=reset], input[type=submit]' ).css( {
				'background-color': to,
				'border': '1px solid' + to,
			});
			$( '.woocommerce #payment #place_order, .woocommerce-page #payment #place_order, .woocommerce #respond input#submit.alt' ).css( {
				'border-radius': '3px',
				'background': to,
				'color': '#fff'
			} );
			$( '.woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, #infinite-handle span' ).css( {
				'border-radius': '3px',
				'background': to,
				'color': '#fff'
			} );
			$( '#secondary .widget-title:after' ).css( {
				'background-color': to,
			});
			$( '.post .posted-on a, .post .posted-on a:visited, .post .posted-on a:hover, .post .posted-on a:focus, .search .page .posted-on a, .search .page .posted-on a:visited, .search .page .posted-on a:hover, .search .page .posted-on a:focus' ).css( {
				'border': '1px solid' + to,
				'color': to
			} );
			$( '.archive .archived-post-count span, .search .archived-post-count span' ).css({
				'background': to,
				'border': '1px solid' + to,
			});
			$( '.main-navigation a:hover, .main-navigation a.focus, .main-navigation a:visited:hover, .main-navigation a:visited.focus' ).css( {
				'color': to
			});
			$(' .slider-post .headtext-style2 .slider-top-cat a, .slider-post .headtext-style2 .slider-top-cat a:visited, .slider-post .headtext-style2 .slider-top-cat a:hover').css({
				'color': to
			});
		} );
	} );
} )( jQuery );
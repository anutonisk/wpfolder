<?php

function bosa_wedding_default_styles(){

	// Begin Style
	$css = '<style>';

	$feature_posts_height = get_theme_mod( 'feature_posts_height', 450 );
	$css .= '
		.feature-posts-layout-one .feature-posts-image,
		.feature-posts-content-wrap .feature-posts-image {
			height: '. esc_attr( $feature_posts_height ) .'px;
			overflow: hidden;
		}
	';

	#Border Radius Featured Posts
	$feature_posts_radius = get_theme_mod( 'feature_posts_radius', 5 );
	$css .= '
		.feature-posts-content-wrap .feature-posts-image {
    		border-radius: '. esc_attr( $feature_posts_radius ) .'px;
    		overflow: hidden;
    	}
	';

	#Blog Page Radius
	$latest_posts_radius = get_theme_mod( 'latest_posts_radius', 5 );
	$css .= '
		#primary article .featured-image a {
			border-radius: '. esc_attr( $latest_posts_radius ) .'px;
		}
		#primary article.sticky .featured-image a { 
			border-radius: 0px;
		}
		article.sticky {
			border-radius: '. esc_attr( $latest_posts_radius ) .'px;
		}
	';

	# Highlight Posts Border Radius
	$highlight_posts_radius = get_theme_mod( 'highlight_posts_radius', 5 );
	$css .= '
		.section-highlight-post .featured-image a {
			border-radius: '. esc_attr( $highlight_posts_radius ) .'px;
			overflow: hidden;
		}
	';
	
	// End Style
	$css .= '</style>';

	// return generated & compressed CSS
	echo str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css); 
}
add_action( 'wp_head', 'bosa_wedding_default_styles', 99 );
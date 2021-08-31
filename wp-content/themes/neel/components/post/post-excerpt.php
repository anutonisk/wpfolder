<?php
/**
 * Entry summary/excerpt part of an article.
 *
 * @package Neel
 * @since 1.0
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$excerpt_length = get_theme_mod( 'neel_post_excerpt_length', 30 );
if( $excerpt_length > 54 ) {
	$excerpt_length = 54;
}
?>
<div class="entry-summary">
	<?php 
		neel_excerpt( $excerpt_length );
	 ?>
</div><!-- .entry-summary -->

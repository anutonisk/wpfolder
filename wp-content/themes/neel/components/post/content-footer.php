<?php
/**
 * Template-part for displaying post footer.
 * @package Neel
 * @since 1.0
 */
?>
<footer class="entry-footer">

	<?php if( !is_single() ):
		neel_post_read_more( 'Continue Reading' ); 
	 	neel_print_author_name();
	endif; ?>

	<?php if( is_single() ):
	 	neel_single_post_footer();
	endif; ?>

</footer><!-- .entry-footer -->

<?php neel_print_edit_link(); ?>
<?php
/**
 * Template-part for displaying post meta.
 * @package Neel
 * @since 1.0
 */
?>
<div class="entry-meta">
	<?php if( !is_single() ): neel_category_list(); endif; ?>
	<?php if( is_single()): neel_print_author_name(); endif; ?>
	<?php neel_print_comments_link(); ?>
</div><!-- .entry-meta -->
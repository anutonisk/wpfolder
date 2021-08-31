<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Neel
 * @since 1.0
 */

if ( ! function_exists( 'neel_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function neel_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		'%s',
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		'%s',
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}
endif;

if ( ! function_exists( 'neel_print_author_name' ) ) :
/**
 * Prints HTML with meta information for the current author.
 */
function neel_print_author_name() {

	$display_author_avatar_img = true;

	$byline = '';
	$byline .= ' by ';

	$byline .= sprintf(
		'%s',
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}
endif;



if ( ! function_exists( 'neel_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function neel_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'neel' ) );
		if ( $categories_list && neel_categorized_blog() ) {
			printf( '<span class="cat-links">' . ' %1$s ' . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'neel' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . '%1$s' . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="far fa-comment-alt"></i>';
		comments_popup_link( esc_html__( ' Leave a comment', 'neel' ), esc_html__( ' 1 Comment', 'neel' ), esc_html__( ' % Comments', 'neel' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'neel' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'neel_post_categories' ) ) :
	/**
	 * Displays post categories.
	 * @since 1.0.0
	 *
	 */
	function neel_post_categories() {
		// Hide category text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'neel' ) );
			
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"><i class="fas fa-folder-open"></i>&nbsp;' . esc_html( '%1$s' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

if ( ! function_exists( 'neel_post_tags' ) ) :
	/**
	 * Displays post tags.
	 * @since 1.0.0
	 *
	 */
	function neel_post_tags() {
		// Hide tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'neel' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links"><i class="fas fa-tags"></i>' . esc_html( ' %1$s' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

if ( ! function_exists( 'neel_category_list' ) ) :
/**
 * Prints HTML with meta information for the categories.
 */
function neel_category_list() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'neel' ) );
		if ( $categories_list && neel_categorized_blog() ) {
			printf( '<span class="cat-links"><i class="far fa-folder-open"></i>' . ' %1$s ' . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}
endif;

if ( ! function_exists( 'neel_print_date' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function neel_print_date() {
	// Hide category and tag text for pages.
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'M j, Y' ) ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		'%s',
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
endif;

if ( ! function_exists( 'neel_get_date' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function neel_get_date() {
	// Hide category and tag text for pages.
	$time_string = '<time class="post-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="post-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'M j, Y' ) ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		'%s',
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
	return $posted_on;
}
endif;

if ( ! function_exists( 'neel_print_comments_link' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function neel_print_comments_link() {
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		if( !is_single()) {
			echo '<span class="comments-link"><i class="far fa-comment-alt"></i>';
		} else {
			echo '<span class="comments-link">';
		}
		if( is_single() ) {
			comments_popup_link( ' Leave Comment', ' 1 Comment', ' % Comments' );
		} else {
			comments_popup_link( ' 0', ' 1', ' %' );
		}
		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'neel_print_edit_link' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function neel_print_edit_link() {
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'neel' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<div class="edit-link">',
		'</div>'
	);
}
endif;

/**
 * Print Read more label.
 * @since 1.0.0
 *
 */
function neel_post_read_more( $read_more_text ) {

	$read_more_text = esc_html__( 'Read More', 'neel' );
	echo '<span class="read-more" ><a href="'. esc_url( get_permalink( get_the_ID() ) ) . '">' .$read_more_text. '<span class="screen-reader-text"> '. esc_html__( 'Read More', 'neel' ).'</span></a></span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}



/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function neel_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'neel_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'neel_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so neel_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so neel_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'neel_single_post_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 * @since 1.0.0
	 */
	function neel_single_post_footer() {
	?>
		<div class="row single-post-entry-footer">

			<div id="single-cat-links" class="footer-category-links">
			<?php 
			//Display Categories
			neel_post_categories();
			?>
			</div><!-- comments-link -->

			<div id="single-tag-links" class="footer-tag-links">
				<?php
				//Display tags
				neel_post_tags(); ?>
			</div><!-- footer-tag-links -->

		</div><!-- row -->

		<?php
	}
endif;

if ( ! function_exists( 'neel_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since 1.0.0
 */
function neel_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	$previous_post = get_previous_post();
	if ( ! empty( $previous_post ) ) {
		$previous_thumb = get_the_post_thumbnail( $previous_post->ID, 'neel-prevnext-thumbnail' );
	}
	$next_post = get_next_post();
	if ( ! empty( $next_post ) ) {
		$next_thumb     = get_the_post_thumbnail( $next_post->ID, 'neel-prevnext-thumbnail' );
	}

	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'neel' ); ?></h2>
		<div class="nav-links">
			<?php if ( ! empty( $previous_post ) ) : ?>
				<div class="nav-previous">
					<?php previous_post_link( '%link', ' ' . $previous_thumb . '<div class="nav-innner"><span class="screen-reader-text">' . esc_html_x( 'Previous Post: ', 'post navigation', 'neel' ) . '%title</span><span>' . esc_html__( 'Previous Post', 'neel' ) . '</span> <div>%title</div></div>' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $next_post ) ) : ?>
				<div class="nav-next">
					<?php next_post_link( '%link', '<div class="nav-innner"><span class="screen-reader-text">' . esc_html_x( 'Next Post: ', 'post navigation', 'neel' ) . '%title</span><span>' . esc_html__( 'Next Post', 'neel' ) . '</span><div>%title</div></div>' . $next_thumb . ' ' ); ?>
				</div>
			<?php endif; ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation-->
	<?php
}
endif;

//display_top_category_setting
if ( ! function_exists( 'neel_get_rand_category' ) ) :
	/**
	 * Prints HTML with meta information for the category
	 * @since 1.0
	 */
	function neel_get_rand_category() {

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			
			$cat = get_the_category();
			$total_categories = count( $cat );
			$rand_cat_index = 0;
			if( 0 !== $total_categories ) {
				$rand_cat_index = rand( 0, $total_categories-1 );
			}

			if ( ! empty( $cat ) ) {
	    		/* translators: 1: category link, 2: list of categories.  */
			    printf( '<a class="top-cat-links" href="'.'%1$s'.'" >' . esc_html( '%2$s' ) . '</a>', esc_url( get_category_link( $cat[$rand_cat_index]->term_id ) ), $cat[$rand_cat_index]->name); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

/**
 * Convert HEX to RGB.
 *
 * @since 1.0.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function neel_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) == 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) == 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		$r = hexdec( '12' );
		$g = hexdec( '34' );
		$b = hexdec( '56' );
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}

/**
 * Flush out the transients used in neel_categorized_blog.
 */
function neel_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'neel_categories' );
}
add_action( 'edit_category', 'neel_category_transient_flusher' );
add_action( 'save_post',     'neel_category_transient_flusher' );

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backward compatibility to support pre-5.2.0 WordPress versions.
	 *
	 * @since 1.0
	 */
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 *
		 */
		do_action( 'wp_body_open' );
	}
endif;

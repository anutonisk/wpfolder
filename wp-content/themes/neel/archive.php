<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Neel
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header(); ?>
<div class="container">
	<div class="site-content-wrapper row">
		<div id="primary" class="content-area">
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
				<div class="archived-post-count"><span>
					<?php 
					$count = $GLOBALS['wp_query']->post_count;
					if( $count > 1 ) {
						$post_text = 'Posts';
					} else {
						$post_text = 'Post';
					}
					echo esc_html( $count ).' '. esc_html( $post_text ); ?></span></div>
			</header>
			<main id="main" class="site-main " role="main">

				<?php
				if ( have_posts() ) : ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'components/post/content', get_post_format() );

					endwhile;

					
					if ( have_posts() ) :
						the_posts_pagination( array( 
							'mid_size' => 1, 
							'prev_text' => esc_html__( 'Prev', 'neel' ),
		    				'next_text' => esc_html__( 'Next', 'neel' ), 
		    			) );
					endif;
					

				else :

					get_template_part( 'components/post/content', 'none' );

				endif; ?>

			</main>
		</div>	
		<?php get_sidebar(); ?>
	</div>
<?php 
get_footer();

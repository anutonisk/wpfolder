<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
			<main id="main" class="site-main" role="main">
				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
					<?php
					endif; ?>

					
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
					?>
					

				<?php
				else :

					get_template_part( 'components/post/content', 'none' );

				endif; ?>
			</main>
		</div>	
		<?php get_sidebar(); ?>
	</div>
<?php 
get_footer();

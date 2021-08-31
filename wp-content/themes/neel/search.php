<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
				<h1 class="page-title">
					<?php 
					/* translators: %s: Search Query. */ 
					printf( esc_html__( 'Search Results for: %s', 'neel' ), '<span>' . get_search_query() . '</span>' ); 
					?>	
				</h1>
				<div class="archived-post-count"><span>
					<?php 
					$count = $GLOBALS['wp_query']->post_count;
					if( $count > 1 ) {
						$post_text = 'Posts';
					} else {
						$post_text = 'Post';
					}
					echo esc_html( $count ).' '.esc_html( $post_text ); ?></span></div>
			</header>
			<main id="main" class="site-main" role="main">

				<?php
				if ( have_posts() ) : ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'components/post/content', 'search' );

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

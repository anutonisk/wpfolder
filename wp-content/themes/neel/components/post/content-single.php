<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Neel
 * @since 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="post-date">
			<?php neel_print_date(); ?>
		</div><!-- entry-ctegories-->
		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
			if ( 'post' === get_post_type() ) : 
				get_template_part( 'components/post/content', 'meta' ); 
			endif; 
		?>
	</header><!-- entry-header -->

	<?php if ( '' != get_the_post_thumbnail() && is_single() ) : ?>
		<div class="featured-image">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'neel-featured-image' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="single-content-wrapper">
		
		<?php
			get_template_part( 'components/post/post', 'full-content' );
			
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'neel' ),
				'after'  => '</div>',
			) );
		?>
	
		<?php get_template_part( 'components/post/content', 'footer' ); ?>
		
	</div><!-- entry-content-wrapper -->

</article><!-- #post-## -->
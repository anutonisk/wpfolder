<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Neel
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( '' != get_the_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'neel-featured-image' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry-content-wrapper">
		<header class="entry-header">
			
			<div class="post-date">
				<?php neel_print_date(); ?>
			</div><!-- post-date-->
			<?php
				if ( is_single() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}

			if ( 'post' === get_post_type() ) : ?>
			<?php get_template_part( 'components/post/content', 'meta' ); ?>
			<?php
			endif; ?>
		</header><!-- entry-header -->

		<?php
			if ( is_search()  || is_archive() || !is_single() ) {
				get_template_part( 'components/post/post','excerpt' );
			} else {
				get_template_part( 'components/post/post', 'full-content' );
			}

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'neel' ),
				'after'  => '</div>',
			) );
		?>
	
		<?php get_template_part( 'components/post/content', 'footer' ); ?>
	</div><!-- entry-content-wrapper -->
</article><!-- #post-## -->
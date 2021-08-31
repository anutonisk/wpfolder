<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Neel
 * @since 1.0
 */

$post_content_length = get_theme_mod( 'neel_post_display_type_option', 'post-excerpt' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr( $post_content_length ) ); ?>>
	<?php if ( '' != get_the_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'neel-featured-image' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry-content-wrapper">
		<header class="entry-header">
			<?php
				if ( is_sticky() && is_home() && ! is_paged() ) {
					printf( '<div class="sticky-post"><span class="sticky-post-tag">%s</span></div>', esc_html__( 'Featured', 'neel' ) );
				} 
			?>
			
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
			if ( ( is_search()  || is_archive() || !is_single() ) && 'post-excerpt' === $post_content_length ) {
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
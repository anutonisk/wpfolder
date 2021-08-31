<?php
/**
 * Get all categorized posts for display in slider banner.
 * @package Neel
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$defaults = neel_get_defaults();
$headtext_style = get_theme_mod( 'neel_banner_headtext_style', $defaults['banner_headtext_style'] );

// Grab the first cat id in the list.
$categories = get_categories();
$first_cat_id = $categories[0]->term_id;
$post_cat = get_theme_mod( 'neel_featured_slider_posts_cat', $first_cat_id );

$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'category__in' => $post_cat,
    'posts_per_page' => 4,
    'orderby' => 'rand'
);
$arr_posts = new WP_Query( $args );
  
if ( $arr_posts->have_posts() ) :
  
    while ( $arr_posts->have_posts() ) :
        $arr_posts->the_post();
        if ( has_post_thumbnail() ) {
            /* grab the url for the full size featured image */
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
        } else {
            $featured_img_url = '';
        }
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('slider-post'); ?> style="background-image: url(<?php echo esc_url( $featured_img_url ); ?>)">

            <div class="slider-post-content <?php echo esc_attr( $headtext_style ); ?>">
                <div class="slider-top-cat">
                    <?php neel_get_rand_category(); ?>
                </div><!-- slider-top-cat -->
                <?php the_title( '<h2 class="slider-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                <div class="slider-post-meta">
                    <?php echo neel_get_date(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </div>
                <div class="slider-post-excerpt">
                    <?php neel_excerpt(24); ?>
                </div>
                <div class="read-more">
                <a href="<?php the_permalink(); ?>" class="read-more-link" rel="bookmark"><?php esc_html_e( 'Read More', 'neel' ); ?></a>
                </div>
            </div><!-- slider-post-content -->
            <?php if( 'headtext-style1' === $headtext_style ) { ?>
            <div class="site-banner-overlay"></div>
            <?php } ?>
        </article>
        <?php
    endwhile;
endif;
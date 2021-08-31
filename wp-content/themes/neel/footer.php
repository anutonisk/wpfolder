<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Neel
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
	</div><!-- container -->
	</div>
	<footer id="colophon" class="site-footer" role="contentinfo">
        <?php if ( is_active_sidebar( 'neel-footer-widget-area-left' ) || is_active_sidebar( 'neel-footer-widget-area-center' ) || is_active_sidebar( 'neel-footer-widget-area-right' ) ) : ?>
        <div id="footer" class="footer-widget-area">
            <div class="container">
                <div class="row">
                    <div class="widget-area-col"><?php dynamic_sidebar( 'neel-footer-widget-area-left' ); ?></div>
                    <div class="widget-area-col"><?php dynamic_sidebar( 'neel-footer-widget-area-center' ); ?></div>
                    <div class="widget-area-col"><?php dynamic_sidebar( 'neel-footer-widget-area-right' ); ?></div>
                </div><!-- row -->
            </div><!-- container -->
        </div><!-- footer-widget-area -->
        <?php endif; ?>
		<?php get_template_part( 'components/footer/site', 'info' ); ?>
	</footer>
</div>
<?php wp_footer(); ?>

</body>
</html>

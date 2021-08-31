<?php
/**
 * Template-part for displaying site footer info.
 * @package Neel
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
<div class="site-info">
	<div class="container">
		<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'neel' ) ); ?>"><?php /* translators: %s: WordPress. */printf( esc_html__( 'Proudly powered by %s', 'neel' ), 'WordPress' ); ?></a>
		<span class="sep"> | </span>
		<?php printf( /* translators: %1$s: Theme Name %2$s: Theme Developer. */esc_html__( 'Theme: %1$s by %2$s.', 'neel' ), 'Neel', '<a href="https://falgunithemes.com/" rel="author">FalguniThemes</a>' ); ?>
	</div><!-- container -->
</div><!-- .site-info -->
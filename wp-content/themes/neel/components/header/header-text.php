<?php
/**
 * Template-part for displaying Banner Title and Subtitle.
 * @package Neel
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$defaults = neel_get_defaults();
$banner_title = get_theme_mod( 'neel_banner_title', '' );
$banner_subtitle = get_theme_mod( 'neel_banner_subtitle', '' );
$banner_button_text = get_theme_mod( 'neel_banner_button_text', '');
$banner_btn_url = get_theme_mod( 'neel_banner_button_url', '' );
$header_image = get_header_image();
$banner_type = get_theme_mod( 'neel_banner_type', 'image' );
$headtext_style = get_theme_mod( 'neel_banner_headtext_style', $defaults['banner_headtext_style'] );

if( 'color' === $banner_type ) {
    $headtext_style = '';
}
?>

<div class="custom-heading <?php echo esc_attr( $headtext_style ); ?>">
    <div class="container-inner-text">
        <h2 class="banner-title"><?php echo wp_kses_post( $banner_title ); ?></h2>
        <p class="banner-subtitle"><?php echo wp_kses_post( $banner_subtitle ); ?></p>
        
        <?php if( '' !== $banner_button_text ) {?>
        <div class="buttons-wrapper">
        <?php } ?>

            <?php if( '' !== $banner_button_text ) { ?>
            <a href="<?php echo esc_url( $banner_btn_url ); ?>" target="_blank"><button id="banner-section-btn" class="button banner-section-btn"><?php echo esc_html( $banner_button_text ); ?></button></a>
            <?php } ?>

        <?php if( '' !== $banner_button_text ) { ?>    
        </div><!-- buttons-wrapper -->
        <?php } ?>
    </div><!-- container-inner-text -->
</div><!-- custom-heading -->

<?php if( ( $banner_title || $banner_subtitle ) && 'headtext-style1' === $headtext_style && 'color' !== $banner_type ) { ?>
    <div class="site-banner-overlay"></div>
<?php }

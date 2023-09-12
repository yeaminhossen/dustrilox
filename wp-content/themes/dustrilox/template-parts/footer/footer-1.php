<?php 

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dustrilox
*/

$footer_bg_img = get_theme_mod( 'dustrilox_footer_bg' );
$dustrilox_footer_social_switch = get_theme_mod( 'dustrilox_footer_social_switch' , false );
$dustrilox_footer_top_space = function_exists('get_field') ? get_field('dustrilox_footer_top_space') : '0';
$dustrilox_footer_bg_url_from_page = function_exists( 'get_field' ) ? get_field( 'dustrilox_footer_bg' ) : '';
$dustrilox_footer_bg_color_from_page = function_exists( 'get_field' ) ? get_field( 'dustrilox_footer_bg_color' ) : '';
$footer_bg_color = get_theme_mod( 'dustrilox_footer_bg_color' );

// bg image
$bg_img = !empty( $dustrilox_footer_bg_url_from_page['url'] ) ? $dustrilox_footer_bg_url_from_page['url'] : $footer_bg_img;

// bg color
$bg_color = !empty( $dustrilox_footer_bg_color_from_page ) ? $dustrilox_footer_bg_color_from_page : $footer_bg_color;


// footer_columns
$footer_columns = 0;
$footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

for ( $num = 1; $num <= $footer_widgets; $num++ ) {
    if ( is_active_sidebar( 'footer-' . $num ) ) {
        $footer_columns++;
    }
}

switch ( $footer_columns ) {
case '1':
    $footer_class[1] = 'col-lg-12';
    break;
case '2':
    $footer_class[1] = 'col-lg-6 col-md-6';
    $footer_class[2] = 'col-lg-6 col-md-6';
    break;
case '3':
    $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
    $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
    $footer_class[3] = 'col-xl-4 col-lg-6';
    break;
case '4':
    $footer_class[1] = 'col-xl-3 col-lg-6 col-md-12 col-sm-12';
    $footer_class[2] = 'col-xl-3 col-lg-6 col-md-6 col-sm-6';
    $footer_class[3] = 'col-xl-3 col-lg-6 col-md-6 col-sm-6';
    $footer_class[4] = 'col-xl-3 col-lg-6 col-md-8 col-sm-12';
    break;
default:
    $footer_class = 'col-xl-3 col-lg-3 col-md-6';
    break;
}

?>

<!-- footer area start --> 

<footer> 
 <div class="footer__area-2 black-bg-2">
    <?php if ( is_active_sidebar('footer-1') OR is_active_sidebar('footer-2') OR is_active_sidebar('footer-3') OR is_active_sidebar('footer-4') ): ?>
    <div class="pt-100"  data-bg-color="<?php print esc_attr( $bg_color );?>"  data-background="<?php print esc_url( $bg_img );?>">
        <div class="container">
           <div class="row">
                <?php
                    if ( $footer_columns < 4 ) {
                    print '<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12">';
                    dynamic_sidebar( 'footer-1' );
                    print '</div>';

                    print '<div class=col-xl-3 col-lg-6 col-md-6 col-sm-6">';
                    dynamic_sidebar( 'footer-2' );
                    print '</div>';

                    print '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">';
                    dynamic_sidebar( 'footer-3' );
                    print '</div>';

                    print '<div class="col-xl-3 col-lg-6 col-md-8 col-sm-12">';
                    dynamic_sidebar( 'footer-4' );
                    print '</div>';
                    } else {
                        for ( $num = 1; $num <= $footer_columns; $num++ ) {
                            if ( !is_active_sidebar( 'footer-' . $num ) ) {
                                continue;
                            }
                            print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                            dynamic_sidebar( 'footer-' . $num );
                            print '</div>';
                        }
                    }
                ?>
           </div>
        </div>
    </div>
    <?php endif; ?>


    <div class="footer__copyright-2 black-bg pt-25 pb-25 mt-50">
       <div class="container">
          <div class="row">
             <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                <div class="footer__copyright-text">
                   <p><?php print dustrilox_copyright_text(); ?></p>
                </div>
             </div>
             <?php if(!empty($dustrilox_footer_social_switch)) : ?>
             <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                <div class="footer__copyright-links text-sm-end">
                   <?php dustrilox_footer_social_profiles(); ?>
                </div>
             </div>
            <?php endif; ?>
          </div>
       </div>
    </div>
 </div>
</footer>
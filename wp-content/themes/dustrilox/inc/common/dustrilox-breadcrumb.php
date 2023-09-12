<?php
/**
 * Breadcrumbs for dustrilox theme.
 *
 * @package     dustrilox
 * @author      Theme_Pure
 * @copyright   Copyright (c) 2022, Theme_Pure
 * @link        https://www.weblearnbd.net
 * @since       dustrilox 1.0.0
 */


function dustrilox_breadcrumb_func() {
    global $post;  
    $breadcrumb_class = '';
    $breadcrumb_show = 1;

    if ( is_front_page() && is_home() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','dustrilox'));
        $breadcrumb_class = 'home_front_page';
    }
    elseif ( is_front_page() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','dustrilox'));
        $breadcrumb_show = 0;
    }
    elseif ( is_home() ) {
        if ( get_option( 'page_for_posts' ) ) {
            $title = get_the_title( get_option( 'page_for_posts') );
        }
    }
    elseif ( is_single() && 'post' == get_post_type() ) {
      $title = get_the_title();
    } 
    elseif ( is_single() && 'product' == get_post_type() ) {
        $title = get_theme_mod( 'breadcrumb_product_details', __( 'Shop', 'dustrilox' ) );
    } 
    elseif ( is_single() && 'courses' == get_post_type() ) {
      $title = esc_html__( 'Course Details', 'dustrilox' );
    } 
    elseif ( is_search() ) {
        $title = esc_html__( 'Search Results for : ', 'dustrilox' ) . get_search_query();
    } 
    elseif ( is_404() ) {
        $title = esc_html__( 'Page not Found', 'dustrilox' );
    } 
    elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
        $title = get_theme_mod( 'breadcrumb_shop', __( 'Shop', 'dustrilox' ) );
    } 
    elseif ( is_archive() ) {
        $title = get_the_archive_title();
    } 
    else {
        $title = get_the_title();
    }
 


    $_id = get_the_ID();

    if ( is_single() && 'product' == get_post_type() ) { 
        $_id = $post->ID;
    } 
    elseif ( function_exists("is_shop") AND is_shop()  ) { 
        $_id = wc_get_page_id('shop');
    } 
    elseif ( is_home() && get_option( 'page_for_posts' ) ) {
        $_id = get_option( 'page_for_posts' );
    }

    $is_breadcrumb = function_exists( 'get_field' ) ? get_field( 'is_it_invisible_breadcrumb', $_id ) : '';
    if( !empty($_GET['s']) ) {
      $is_breadcrumb = null;
    }

      if ( empty( $is_breadcrumb ) && $breadcrumb_show == 1 ) {

        $bg_img_from_page = function_exists('get_field') ? get_field('breadcrumb_background_image',$_id) : '';
        $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image',$_id) : '';

        // get_theme_mod
        $bg_img = get_theme_mod( 'breadcrumb_bg_img' );
        $breadcrumb_info_switch = get_theme_mod( 'breadcrumb_info_switch', true );

        if ( $hide_bg_img ) {
            $bg_img = '';
        } else {
            $bg_main_img = !empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $bg_img;
        }?>

        <!-- page title area start -->

      <section class="page__title-area page__title-height page__title-overlay d-flex align-items-center <?php print esc_attr( $breadcrumb_class );?>" data-background="<?php print esc_attr($bg_main_img);?>">
         <div class="container">
            <div class="row">
                <?php if(!empty($breadcrumb_info_switch)) : ?>
               <div class="col-xxl-12">
                  <div class="page__title-wrapper mt-100">                  
                     <div class="breadcrumb-menu">
                        <?php if(function_exists('bcn_display')) {
                               bcn_display();
                        } ?>
                    </div>
                     <h3 class="page__title mt-20"><?php echo dustrilox_kses( $title ); ?></h3>      
                  </div>
               </div>
                <?php endif; ?>
            </div>
         </div>
      </section>
         <!-- page title area end -->
        <?php
      }
}

add_action( 'dustrilox_before_main_content', 'dustrilox_breadcrumb_func' );

// dustrilox_search_form
function dustrilox_search_form() {
    ?>
      <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
         </button>
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <form method="get" action="<?php print esc_url( home_url( '/' ) );?>">
                     <input type="search" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr__( 'Enter Your Keyword', 'dustrilox' );?>" >
                     <button type="submit">
                        <i class="fa fa-search"></i>
                     </button>
               </form>
            </div>
         </div>
      </div>
   <?php
}
add_action( 'dustrilox_before_main_content', 'dustrilox_search_form' );
<?php 

	/**
	 * Template part for displaying header layout three
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package dustrilox
	*/

   // info
   $dustrilox_topbar_switch = get_theme_mod( 'dustrilox_topbar_switch', false );
   $dustrilox_phone_num = get_theme_mod( 'dustrilox_phone_num', __( '+(088)234567899', 'dustrilox' ) );
   $dustrilox_mail_id = get_theme_mod( 'dustrilox_mail_id', __( 'info@dustrilox.com', 'dustrilox' ) );
   $dustrilox_address = get_theme_mod( 'dustrilox_address', __( 'Moon ave, New York, 2020 NY US', 'dustrilox' ) );
   $dustrilox_address_url = get_theme_mod( 'dustrilox_address_url', __( 'https://goo.gl/maps/qzqY2PAcQwUz1BYN9', 'dustrilox' ) );

   // contact button
   $dustrilox_button_text = get_theme_mod( 'dustrilox_button_text', __( 'Make Request', 'dustrilox' ) );
   $dustrilox_button_link = get_theme_mod( 'dustrilox_button_link', __( '#', 'dustrilox' ) );

   // acc button
   $dustrilox_acc_button_text = get_theme_mod( 'dustrilox_acc_button_text', __( 'Login', 'dustrilox' ) );
   $dustrilox_acc_button_link = get_theme_mod( 'dustrilox_acc_button_link', __( '#', 'dustrilox' ) );

   // header right
   $dustrilox_search = get_theme_mod( 'dustrilox_search', false );
   $dustrilox_header_right = get_theme_mod( 'dustrilox_header_right', false );
   $dustrilox_menu_col = $dustrilox_header_right ? 'col-xxl-7 col-xl-7 col-lg-8 d-none d-lg-block' : 'col-xxl-10 col-xl-10 col-lg-9 d-none d-lg-block text-end';

?>

<!-- header-area-start -->
<header id="header-sticky" class="header__area-3 pt-40 pb-40">
   <div class="container custom-container">
      <div class="row">
         <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 col-12">
            <div class="header__side">
               <div class="header__side-icon info-toggle-btn sidebar-toggle-btn">
                  <span class="bar1"></span>
                  <span class="bar2"></span>
                  <span class="bar3"></span>
               </div>
               <div class="header__side-logo">
                  <?php dustrilox_header_logo();?>
               </div>
            </div>
         </div>
         <div class="col-xl-7 col-lg-2 col-md-1 col-sm-1 d-none d-xl-block">
            <div class="main-menu-3 menu-counter">
               <nav id="mobile-menu-2">
                  <?php dustrilox_header_menu();?>
               </nav>
            </div>
         </div>

         <?php if(!empty($dustrilox_button_text)) : ?> 
         <div class="col-xl-2 col-lg-8 col-md-7 col-sm-5">
            <div class="header__smcontact-list header__smcontact-list-3">
               <div class="sm-clist__text sm-clist__text-2">
                  <span><?php echo esc_html__('Get A Quote','dustrilox'); ?></span>
                  <h4><a href="<?php echo esc_url($dustrilox_button_link); ?>"><?php echo esc_html($dustrilox_button_text); ?></a></h4>
               </div>
               <div class="sm-clist__icon sm-clist__icon-2">
                 <a href="<?php echo esc_url($dustrilox_button_link); ?>"> <i class="fal fa-long-arrow-right"></i></a>
               </div>
            </div>
         </div>
         <?php endif; ?>
      </div>
   </div>
</header>
<!-- header-area-end -->


<?php get_template_part( 'template-parts/header/header-side-info-header-3' ); ?>
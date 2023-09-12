<?php 

	/**
	 * Template part for displaying header layout two
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package dustrilox
	*/

	 // info
    $dustrilox_topbar_switch = get_theme_mod( 'dustrilox_topbar_switch', false );

    $dustrilox_feed = get_theme_mod( 'dustrilox_feed', __( 'Our company is one of the', 'dustrilox' ) );
    $dustrilox_delivery = get_theme_mod( 'dustrilox_delivery', __( 'Deliver the sustainable success', 'dustrilox' ) );
    $dustrilox_delivery_url = get_theme_mod( 'dustrilox_delivery_url', __( '#', 'dustrilox' ) );
    $dustrilox_top_menu = get_theme_mod( 'dustrilox_top_menu', __( 'Top menu set', 'dustrilox' ) );
    $dustrilox_address = get_theme_mod( 'dustrilox_address', __( '16/A, New York, US', 'dustrilox' ) );
    $dustrilox_address_url = get_theme_mod( 'dustrilox_address_url', __( 'https://goo.gl/maps/qzqY2PAcQwUz1BYN9', 'dustrilox' ) );

    $dustrilox_phone_num = get_theme_mod( 'dustrilox_phone_num', __( '8668635036', 'dustrilox' ) );

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


    $dustrilox_site_logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/img/logo/logo-white.png' );

?>


<header class="header__area">
   <?php if(!empty($dustrilox_topbar_switch)) : ?>
   <div class="header__top theme-bg d-none d-lg-block">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-xl-7 col-lg-7 col-md-7">
               <div class="header__top-info">
                  <?php if(!empty($dustrilox_feed)) : ?>   
                  <p class="header__top-info-text"><span><?php echo esc_html__('Feed:','dustrilox'); ?></span> <?php echo esc_html($dustrilox_feed); ?></p>
                  <?php endif; ?>   

                  <?php if(!empty($dustrilox_delivery)) : ?> 
                  <p><a href="<?php echo esc_html($dustrilox_delivery_url); ?>"><?php echo esc_html($dustrilox_delivery); ?></a></p>
                  <?php endif; ?>  

               </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-5">
               <div class="header__top-right">
                  <?php if(!empty($dustrilox_top_menu)) : ?> 
                  <div class="header__sm-links">
                     <?php echo dustrilox_kses($dustrilox_top_menu); ?>
                  </div>
                  <?php endif; ?> 
                  <div class="header__lang">
                     <?php dustrilox_header_lang_defualt(); ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php endif; ?>

   <div class="header__inner grey-bg-5 p-relative z-index-1 d-none d-lg-block">
      <div class="container">
         <div class="row">
            <div class="col-xl-4 col-lg-3">
               <div class="header__logo-overlay">
                  <?php dustrilox_header_logo(); ?>
               </div>
            </div>
            <div class="col-xl-8 col-lg-9">
               <div class="header__smcontact">

                  <?php if(!empty($dustrilox_address)) : ?> 
                  <div class="header__smcontact-list">
                     <div class="sm-clist__icon">
                        <i class="flaticon-location-pin"></i>
                     </div>
                     <div class="sm-clist__text">
                        <h4><a href="<?php echo esc_html($dustrilox_address_url); ?>" target="_blank"><?php echo esc_html($dustrilox_address); ?></a></h4>
                        <span><?php echo esc_html__('Contact Us','dustrilox'); ?></span>
                     </div>
                  </div>
                  <?php endif; ?>

                  <?php if(!empty($dustrilox_phone_num)) : ?> 
                  <div class="header__smcontact-list">
                     <div class="sm-clist__icon">
                        <i class="flaticon-telephone-call"></i>
                     </div>
                     <div class="sm-clist__text">
                        <h4><a href="tel:<?php echo esc_attr($dustrilox_phone_num); ?>"><?php echo esc_html($dustrilox_phone_num); ?></a></h4>
                        <span><?php echo esc_html__('Get Support','dustrilox'); ?></span>
                     </div>
                  </div>
                  <?php endif; ?>

                  <?php if(!empty($dustrilox_button_text)) : ?> 
                  <div class="header__smcontact-list header__smcontact-list-df">
                     <div class="sm-clist__text sm-clist__text-2">
                        <span><?php echo esc_html__('Get A Quote','dustrilox'); ?></span>
                        <h4><a href="<?php echo esc_url($dustrilox_button_link); ?>"><?php echo esc_html($dustrilox_button_text); ?></a></h4>
                     </div>
                     <div class="sm-clist__icon sm-clist__icon-2">
                       <a href="<?php echo esc_url($dustrilox_button_link); ?>"> <i class="fal fa-long-arrow-right"></i></a>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="header-sticky" class="header__bottom-2 black-bg-2">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-xl-10 col-lg-10 col-md-6 col-6">
               <div class="main-menu main-menu-2">
                  <nav id="mobile-menu-2">
                     <?php dustrilox_header_menu(); ?>
                  </nav>
               </div>
               <div class="mobile-logo d-lg-none">
                  <a href="<?php print esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url($dustrilox_site_logo); ?>" alt="<?php echo esc_attr__('logo','dustrilox'); ?>"></a>
               </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-6">
               <div class="header__sm-action">
                  <div class="header__sm-action-item right-border">
                     <a href="javascript:void(0)" class="info-toggle-btn f-right sidebar-toggle-btn"><i class="fal fa-bars"></i></a>
                  </div>
                  <div class="header__sm-action-item m-0">
                     <a href="javascript:void(0)" data-bs-toggle="modal" class="search" data-bs-target="#search-modal"><i class="fal fa-search"></i></a>
                  </div>
                  <div class="header__sm-action-item d-none">
                     <a href="#"><i class="fa-light fa-user"></i></a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</header>




<?php get_template_part( 'template-parts/header/header-side-info-header-2' ); ?>
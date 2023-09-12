<?php 

	/**
	 * Template part for displaying header layout one
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package dustrilox
	*/

	// info
    $dustrilox_topbar_switch = get_theme_mod( 'dustrilox_topbar_switch', false );

    $dustrilox_phone_num = get_theme_mod( 'dustrilox_phone_num', __( '8668635036', 'dustrilox' ) );

    $dustrilox_mail_id = get_theme_mod( 'dustrilox_mail_id', __( 'info@webmail.com', 'dustrilox' ) );
    
    $dustrilox_address = get_theme_mod( 'dustrilox_address', __( 'Moon ave, New York, 2020 NY US', 'dustrilox' ) );
    $dustrilox_address_url = get_theme_mod( 'dustrilox_address_url', __( 'https://goo.gl/maps/qzqY2PAcQwUz1BYN9', 'dustrilox' ) );

    // contact button
	$dustrilox_button_text = get_theme_mod( 'dustrilox_button_text', __( 'Contact Us', 'dustrilox' ) );
    $dustrilox_button_link = get_theme_mod( 'dustrilox_button_link', __( '#', 'dustrilox' ) );

    // acc button
	$dustrilox_acc_button_text = get_theme_mod( 'dustrilox_acc_button_text', __( 'Login', 'dustrilox' ) );
    $dustrilox_acc_button_link = get_theme_mod( 'dustrilox_acc_button_link', __( '#', 'dustrilox' ) );

    // header right
    $dustrilox_header_right = get_theme_mod( 'dustrilox_header_right', false );

    $dustrilox_menu_col = $dustrilox_header_right ? 'col-xl-7 col-lg-6 col-md-6 col-6' : 'col-xl-10 col-lg-10 col-md-6 col-6 text-end';

?>

<!-- header-area-start -->
<header id="header-sticky" class="header-area">
   <div class="container">
         <div class="row align-items-center">
            <div class="col-xl-2 col-lg-2 col-md-6 col-6">
               <div class="logo-area">
                  <div class="logo">
                     <?php dustrilox_header_logo(); ?>
                  </div>
               </div>
            </div>
            <div class="<?php echo esc_attr($dustrilox_menu_col); ?>">
               <div class="menu-area menu-padding">
                     <div class="main-menu">
                        <nav id="mobile-menu">
                           <?php dustrilox_header_menu(); ?>
                        </nav>
                     </div>
               </div>
               <div class="side-menu-icon d-lg-none text-end">
                  <a href="javascript:void(0)" class="info-toggle-btn f-right sidebar-toggle-btn"><i class="fal fa-bars"></i></a>
               </div>
            </div>
            <?php if(!empty($dustrilox_header_right)) : ?>
            <div class="col-xl-3 col-lg-4 d-none d-lg-block">
               <div class="header-info f-right">
                     <?php if(!empty($dustrilox_phone_num)) : ?>
                     <div class="info-item info-item-right">
                        <span><?php echo esc_html__('Phone Number','dustrilox'); ?></span>
                        <h5><a href="tel:<?php echo esc_attr($dustrilox_phone_num); ?>"><?php echo esc_html($dustrilox_phone_num); ?></a></h5>
                     </div>
                     <?php endif; ?>

                     <?php if(!empty($dustrilox_mail_id)) : ?>
                     <div class="info-item">
                        <span><?php echo esc_html__('Free Consultancy','dustrilox'); ?> </span>
                        <h5><a href="mailto:<?php echo esc_attr('$dustrilox_mail_id','dustrilox'); ?>"><?php echo esc_html($dustrilox_mail_id); ?></a></h5>
                     </div>
                     <?php endif; ?>
               </div>
            </div>
            <?php endif; ?>
         </div>
   </div>
</header>
<!-- header-area-end -->

<?php get_template_part( 'template-parts/header/header-side-info' ); ?>
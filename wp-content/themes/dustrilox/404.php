<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package dustrilox
 */

get_header();
?>

<section class="error__area pt-200 pb-200">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-6">
            <?php 
               $dustrilox_error_title = get_theme_mod('dustrilox_error_title', __('Page not found', 'dustrilox'));
               $dustrilox_error_link_text = get_theme_mod('dustrilox_error_link_text', __('Back To Home', 'dustrilox'));
               $dustrilox_error_desc = get_theme_mod('dustrilox_error_desc', __('Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'dustrilox'));
            ?>
            <div class="error__item text-center">
               <div class="error__thumb mb-20">
                  <h2 class="error-404-title"><?php echo esc_html__('404','dustrilox'); ?></h2>
               </div>
               <div class="error__content">
                  <h3 class="error__title"><?php print esc_html($dustrilox_error_title);?></h3>
                  <p><?php print esc_html($dustrilox_error_desc);?></p>
                  <a href="<?php print esc_url(home_url('/'));?>" class="tp-btn"><?php print esc_html($dustrilox_error_link_text);?></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<?php
get_footer();

<?php 
/** 
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header(); 

$post_column = is_active_sidebar( 'portfolio-sidebar' ) ? 8 : 10;
$post_column_center = is_active_sidebar( 'portfolio-sidebar' ) ? '' : 'justify-content-center';

?>

<div class="portfoilo__area pt-110 pb-30">
   <div class="container">
      <?php 
          if( have_posts() ):
          while( have_posts() ): the_post();
              $project_details_thumb = function_exists('get_field') ? get_field('project_details_thumb') : '';
              $project_info_title = function_exists('get_field') ? get_field('project_info_title') : '';
              $project_button = function_exists('get_field') ? get_field('project_button') : '';
              $project_button_url = function_exists('get_field') ? get_field('project_button_url') : '';
      ?> 
      <div class="row">
         <div class="col-xxl-8 col-xl-7 col-lg-7">
            <div class="portfolio__details mb-50">
               <?php if(!empty($project_details_thumb['url'])) : ?>
               <img class="mb-30" src="<?php echo esc_url($project_details_thumb['url']); ?> ?>" alt="<?php the_title(); ?>">
               <?php endif; ?>

               <?php the_content(); ?>
            </div>
         </div>
         <div class="col-xxl-4 col-xl-5 col-lg-5">
            <div class="portfolio__sidebar mb-50">
               <div class="ps__item mb-40">
                  <div class="ps__item-info">
                     <?php if(!empty($project_info_title)) : ?>
                     <h5 class="ps__title"><?php echo esc_html($project_info_title); ?></h5>
                     <?php endif; ?>

                     <div class="ps-list">
                        <ul>
                             <?php 
                             if( have_rows('project_info_list') ):
                                 while( have_rows('project_info_list') ) : the_row(); 
                                 $info_label = get_sub_field('info_label');    
                                 $info_name = get_sub_field('info_name'); 
                             ?>

                                 <li><span><?php echo esc_html($info_label); ?></span> <?php echo esc_html($info_name); ?></li>

                                 <?php endwhile; ?>

                             <?php else : ?>
                                 <p>Please add your project info list from project post.</p>
                             <?php endif; ?>
                        </ul>
                     </div>
                  </div>
                  <?php if(!empty($project_button)) : ?>
                  <div class="ps-button">
                     <a href="<?php echo esc_url($project_button_url); ?>" class="tp-btn-ps w-100"><?php echo esc_html($project_button); ?> <i class="fa-light fa-arrow-right-long"></i></a>
                  </div>
                  <?php endif; ?>
               </div>
               <?php if ( is_active_sidebar('portfolio-sidebar') ): ?> 
                  <?php dynamic_sidebar( 'portfolio-sidebar' ); ?>
               <?php endif; ?>  
            </div>
         </div>
      </div>
      <?php 
          endwhile; wp_reset_query();
      endif; 
      ?>
   </div>
</div>



      <section class="services__details d-none">
         <div class="container">
			   <?php 
                if( have_posts() ):
                while( have_posts() ): the_post();
                    $project_details_image = function_exists('get_field') ? get_field('project_details_image') : '';
                    $project_info_repeater = function_exists('get_field') ? get_field('project_info_repeater') : '';
            ?> 
            <div class="row <?php echo esc_attr($post_column_center); ?>">
                  <div class="col-lg-<?php echo esc_attr($post_column); ?>">
                  	<?php if ( !empty($project_details_image['url']) ) : ?>
                     <div class="services__details__thumb">
                        <img src="<?php echo esc_url($project_details_image['url']); ?>" alt="<?php echo esc_attr($project_details_image['alt']); ?>" title="<?php echo esc_attr($project_details_image['title']); ?>" title="<?php echo esc_attr($project_details_image['title']); ?>">
                     </div>
                     <?php endif; ?>
                     <div class="services__details__content">
                        <?php the_content(); ?>
                     </div>
                  </div>
                  <?php if ( is_active_sidebar('portfolio-sidebar') ): ?> 
                  <div class="col-lg-4">
                     <aside class="services__sidebar">
                     	<?php dynamic_sidebar( 'portfolio-sidebar' ); ?>
                     </aside>
                  </div>
                  <?php endif; ?>
            </div>
            <?php 
                endwhile; wp_reset_query();
            endif; 
            ?>
         </div>
      </section>



<?php get_footer();  ?>
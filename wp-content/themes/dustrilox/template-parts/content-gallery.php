<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dustrilox
 */

$gallery_images = function_exists('get_field') ? get_field('gallery_images') : '';
if ( is_single() ): ?>

<article id="post-<?php the_ID();?>" <?php post_class( 'ddd tp-blog format-gallery mb-50' );?>>
    <?php if ( !empty( $gallery_images ) ): ?>
    <div class="tp-blog__thumb m-img mb-35">
       <div class="tp-blog__slider swiper-container p-relative">
          <div class="swiper-wrapper">
            <?php foreach ( $gallery_images as $key => $image ): ?>
             <div class="tp-blog__slider-item swiper-slide">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
             </div>
             <?php endforeach;?>
          </div>
          <div class="tp-blog-nav">
             <button class="tp-blog-button-next"><i class="fal fa-arrow-right"></i></button>
             <button class="tp-blog-button-prev"><i class="fal fa-arrow-left"></i></button>
          </div>
       </div>
    </div>
    <?php endif;?>

    <!-- blog meta -->
    <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

    <div class="postbox__text">
       <?php the_content();?>
        <?php
            wp_link_pages( [
                'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'dustrilox' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ] );
        ?>
    </div>

    <div class="tp-blog-details-tag">
        <?php echo dustrilox_get_tag(); ?>
    </div>
</article>


<?php else: ?>

<article id="post-<?php the_ID();?>" <?php post_class( 'tp-blog mb-60 format-gallery' );?>>
    <?php if ( !empty( $gallery_images ) ): ?>
    <div class="tp-blog__thumb m-img mb-35">
       <div class="tp-blog__slider swiper-container p-relative">
          <div class="swiper-wrapper">
            <?php foreach ( $gallery_images as $key => $image ): ?>
             <div class="tp-blog__slider-item swiper-slide">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
             </div>
             <?php endforeach;?>
          </div>
          <div class="tp-blog-nav">
             <button class="tp-blog-button-next"><i class="fal fa-arrow-right"></i></button>
             <button class="tp-blog-button-prev"><i class="fal fa-arrow-left"></i></button>
          </div>
       </div>
    </div>
    <?php endif;?>

    <div class="tp-blog__content">
        <!-- blog meta -->
        <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

       <h3 class="tp-blog__title mb-15"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>

       <?php the_excerpt();?>

       <!-- blog btn -->
       <?php get_template_part( 'template-parts/blog/blog-btn' ); ?>
    </div>
</article>

<?php
endif;?>



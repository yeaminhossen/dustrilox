<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dustrilox
 */

$dustrilox_video_url = function_exists( 'get_field' ) ? get_field( 'post_format_style' ) : NULL;

if ( is_single() ): 
?>

<article id="post-<?php the_ID();?>" <?php post_class( 'ddd tp-blog format-video mb-50' );?>>
    <?php if ( has_post_thumbnail() ): ?> 
    <div class="tp-blog__thumb m-img mb-35">
        <a href="<?php the_permalink();?>">
            <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
        </a>
        <?php if ( !empty($dustrilox_video_url) ): ?> 
       <div class="vide-button vide-button-3">
          <a href="<?php echo esc_url($dustrilox_video_url); ?>" class="popup-video"><i class="fa-solid fa-play"></i></a>
       </div>
       <?php endif; ?>
    </div>
    <?php endif; ?>

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

<article id="post-<?php the_ID();?>" <?php post_class( 'tp-blog mb-60 format-video' );?>>
    <?php if ( has_post_thumbnail() ): ?> 
    <div class="tp-blog__thumb m-img mb-35">
        <a href="<?php the_permalink();?>">
            <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
        </a>
        <?php if ( !empty($dustrilox_video_url) ): ?> 
       <div class="vide-button vide-button-3">
          <a href="<?php echo esc_url($dustrilox_video_url); ?>" class="popup-video"><i class="fa-solid fa-play"></i></a>
       </div>
       <?php endif; ?>
    </div>
    <?php endif; ?>

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



<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dustrilox
 */

$dustrilox_blog_btn = get_theme_mod( 'dustrilox_blog_btn', 'Read More' );
$dustrilox_blog_btn_switch = get_theme_mod( 'dustrilox_blog_btn_switch', true );

?>

<?php if ( !empty( $dustrilox_blog_btn_switch ) ): ?>
<div class="tp-blog-btn mt-25">
    <a href="<?php the_permalink();?>" class="tp-btn"><?php print esc_html( $dustrilox_blog_btn );?></a>
</div>
<?php endif;?>
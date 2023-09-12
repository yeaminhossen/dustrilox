<?php

/**
 * dustrilox_scripts description
 * @return [type] [description]
 */
function dustrilox_scripts() {

    /**
     * all css files
    */

    wp_enqueue_style( 'dustrilox-fonts', dustrilox_fonts_url(), array(), '1.0.0' );
    if( is_rtl() ){
        wp_enqueue_style( 'bootstrap-rtl', DUSTRILOX_THEME_CSS_DIR.'bootstrap.rtl.min.css', array() );
    }else{
        wp_enqueue_style( 'bootstrap', DUSTRILOX_THEME_CSS_DIR.'bootstrap.css', array() );
    }
    wp_enqueue_style( 'meanmenu', DUSTRILOX_THEME_CSS_DIR . 'meanmenu.css', [] );
    wp_enqueue_style( 'animate', DUSTRILOX_THEME_CSS_DIR . 'animate.css', [] );
    wp_enqueue_style( 'owl-carousel', DUSTRILOX_THEME_CSS_DIR . 'owl-carousel.css', [] );
    wp_enqueue_style( 'swiper-bundle', DUSTRILOX_THEME_CSS_DIR . 'swiper-bundle.css', [] );
    wp_enqueue_style( 'magnific-popup', DUSTRILOX_THEME_CSS_DIR . 'magnific-popup.css', [] );
    wp_enqueue_style( 'nice-select', DUSTRILOX_THEME_CSS_DIR . 'nice-select.css', [] );
    wp_enqueue_style( 'font-awesome-pro', DUSTRILOX_THEME_CSS_DIR . 'font-awesome-pro.css', [] );
    wp_enqueue_style( 'flaticon', DUSTRILOX_THEME_CSS_DIR . 'flaticon.css', [] );
    wp_enqueue_style( 'spacing', DUSTRILOX_THEME_CSS_DIR . 'spacing.css', [] );
    wp_enqueue_style( 'backtotop', DUSTRILOX_THEME_CSS_DIR . 'backtotop.css', [] );
    wp_enqueue_style( 'dustrilox-core', DUSTRILOX_THEME_CSS_DIR . 'dustrilox-core.css', [], time() );
    wp_enqueue_style( 'dustrilox-unit', DUSTRILOX_THEME_CSS_DIR . 'dustrilox-unit.css', [], time() );
    wp_enqueue_style( 'dustrilox-custom', DUSTRILOX_THEME_CSS_DIR . 'dustrilox-custom.css', [] );
    wp_enqueue_style( 'dustrilox-style', get_stylesheet_uri() );


    // all js
    wp_enqueue_script( 'bootstrap-bundle', DUSTRILOX_THEME_JS_DIR . 'bootstrap-bundle.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'waypoints', DUSTRILOX_THEME_JS_DIR . 'waypoints.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'meanmenu', DUSTRILOX_THEME_JS_DIR . 'meanmenu.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'swiper-bundle', DUSTRILOX_THEME_JS_DIR . 'swiper-bundle.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'owl-carousel', DUSTRILOX_THEME_JS_DIR . 'owl-carousel.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'magnific-popup', DUSTRILOX_THEME_JS_DIR . 'magnific-popup.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'parallax', DUSTRILOX_THEME_JS_DIR . 'parallax.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-nice-select', DUSTRILOX_THEME_JS_DIR . 'nice-select.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'counterup', DUSTRILOX_THEME_JS_DIR . 'counterup.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'wow', DUSTRILOX_THEME_JS_DIR . 'wow.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'backtotop', DUSTRILOX_THEME_JS_DIR . 'backtotop.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'isotope-pkgd', DUSTRILOX_THEME_JS_DIR . 'isotope-pkgd.js', [ 'imagesloaded' ], false, true );
    wp_enqueue_script( 'jquery-appear', DUSTRILOX_THEME_JS_DIR . 'jquery.appear.js', [ 'imagesloaded' ], false, true );
    wp_enqueue_script( 'jquery-knob', DUSTRILOX_THEME_JS_DIR . 'jquery.knob.js', [ 'imagesloaded' ], false, true );
    wp_enqueue_script( 'dustrilox-main', DUSTRILOX_THEME_JS_DIR . 'main.js', [ 'jquery' ], false, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'dustrilox_scripts' );

/*
Register Fonts
 */
function dustrilox_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'dustrilox' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap';
    }
    return $font_url;
}
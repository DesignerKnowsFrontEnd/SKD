<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * Remove styles and scripts from parent theme
 */
function remove_styles() {
    wp_dequeue_script('jquery');
    wp_dequeue_script('jquery-js');
}
add_action( 'wp_print_scripts', 'remove_styles', 10 );

/*
 * Add javascript and css
 */
function add_theme_scripts()
{
    /*Javascript*/
    wp_deregister_script( 'jquery-core' );
    wp_enqueue_script( 'jquery-core', "https://code.jquery.com/jquery-3.4.1.min.js", '', '3.4.1', true);
    wp_deregister_script( 'jquery-migrate' );
    // wp_enqueue_script( 'jquery-migrate', "https://code.jquery.com/jquery-migrate-3.1.0.min.js", '', '3.1.0', true );
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.js',  '6.2.0', true);
    wp_enqueue_script('swiper-min-js', 'https://unpkg.com/swiper/swiper-bundle.min.js',  '6.2.0', true);
    wp_enqueue_script('main-js', STYLESHEET_PATH . '/assets/js/app.js', '', '1.0.0', true);


    /* CSS */
    
    
    wp_enqueue_style('main-styles', STYLESHEET_PATH .'/assets/css/styles.css', '1.0.0');
    wp_enqueue_style('bootstrap-icons',  'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css', '1.4.0');
    wp_enqueue_style('swiper-styles',  'https://unpkg.com/swiper/swiper-bundle.css', '6.2.0');
    wp_enqueue_style('swiper-styles-min',  'https://unpkg.com/swiper/swiper-bundle.min.css', '6.2.0');

   
    

}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );
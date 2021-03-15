<?php

//ENVIRONMENT Constant
if(!defined('ENVIRONMENT')){
    $env = getenv('ENVIRONMENT');
    define('ENVIRONMENT', $env);
}

//Theme's directory
if (!defined('THEME_DIR')) {
    define('THEME_DIR', __DIR__ . DIRECTORY_SEPARATOR);
}

//Theme's styles path
if (!defined('STYLESHEET_PATH')) {
    define('STYLESHEET_PATH', get_stylesheet_directory_uri());
}

//Theme's images URI
if (!defined('IMAGES_URI')) {
    define('IMAGES_URI', get_stylesheet_directory_uri() . 'assets/images/');
}

//Theme's images directory
if (!defined('THEME_IMAGES_DIR')) {
    define('THEME_IMAGES_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR);
}

//Theme's functions directory
if (!defined('THEME_LIB_DIR')) {
    define('THEME_LIB_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR);
}

//Theme's css directory
if (!defined('THEME_CSS_DIR')) {
    define('THEME_CSS_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR);
}

//Theme's js directory
if (!defined('THEME_JS_DIR')) {
    define('THEME_JS_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR);
}

if(!defined('TRANSIENT_EXP_LONG')){
    define('TRANSIENT_EXP_LONG', 24 * HOUR_IN_SECONDS);
}

if(!defined('TRANSIENT_EXP_MEDIUM')){
    define('TRANSIENT_EXP_MED', 6 * HOUR_IN_SECONDS);
}

if(!defined('TRANSIENT_EXP')){
    define('TRANSIENT_EXP', 1 * HOUR_IN_SECONDS);
}

if(!defined('CACHE_EXP_LONG')){
    define('CACHE_EXP_LONG', 24 * HOUR_IN_SECONDS);
}

if(!defined('CACHE_EXP_MEDIUM')){
    define('CACHE_EXP_MED', 6 * HOUR_IN_SECONDS);
}

if(!defined('CACHE_EXP')){
    define('CACHE_EXP', 1 * HOUR_IN_SECONDS);
}

if (!defined('DEFAULT_LANG')) {
    define('DEFAULT_LANG', 'en');
}


if( class_exists('acf') ) {
    //Theme's blocks directory
    if (!defined('THEME_BLOCKS_DIR')) {
        define('THEME_BLOCKS_DIR', THEME_DIR . 'blocks' . DIRECTORY_SEPARATOR);
    }
}

/**
 * Load all functions which are placed in theme's lib folder
 *
 * @return void
 */
function loadIncludes($dir){
    $it = new RecursiveDirectoryIterator($dir);
    $it = new RecursiveIteratorIterator($it);
    $it = new RegexIterator($it, '#.php$#');
    foreach ($it as $include) {
        if ($include->isReadable()) {
            require_once($include->getPathname());
        }
    }
}
loadIncludes(THEME_LIB_DIR);

/*-----------------------------------------------------------------------------------*/
/*  Remove generator meta tag
/*-----------------------------------------------------------------------------------*/
remove_action('wp_head', 'wp_generator');
global $sitepress;
remove_action( 'wp_head', array( $sitepress, 'meta_generator_tag' ) );

add_action( 'init', 'allow_origin' );
function allow_origin() {
    header("Access-Control-Allow-Origin: *");
}

// Remove dns-prefetch
remove_action( 'wp_head', 'wp_resource_hints', 2 );

remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version

if ( !function_exists( 'redirect_attachment_page' ) ){
    add_action( 'after_theme_support', 'remove_feed' );
    
    function remove_feed() {
        remove_theme_support( 'automatic-feed-links' );
    }   
}



// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

if ( !function_exists( 'redirect_attachment_page' ) ){
    /**
     * Redirects attachment pages to homepage
     */
    function redirect_attachment_page() {
        if ( is_attachment() ) {
            global $post;
            if ( $post && $post->post_parent ) {
                wp_redirect( esc_url( get_permalink( $post->post_parent ) ), 301 );
                exit;
            } else {
                wp_redirect( esc_url( home_url( '/' ) ), 301 );
                exit;
            }
        }
    }
    add_action( 'template   _redirect', 'redirect_attachment_page' );
}

if ( !function_exists( 'remove_type_attr' ) ){
    function remove_type_attr($tag, $handle)
    {
        return preg_replace("/type=['\"]text\/(javascript|css)['\"]/", '', $tag);
    }

    add_filter('style_loader_tag', 'remove_type_attr', 10, 2);
    add_filter('script_loader_tag', 'remove_type_attr', 10, 2);
}

// Filter the output of logo to fix Googles Error about itemprop logo
if ( !function_exists( 'my_custom_logo' ) ) {
    add_filter('get_custom_logo', 'my_custom_logo');
    function my_custom_logo()
    {
        $custom_logo_id = get_theme_mod('custom_logo');
        $html = sprintf('<a href="%1$s" class="navbar-logo" rel="home">%2$s</a>',
            esc_url(home_url('/')),
            wp_get_attachment_image($custom_logo_id, 'full', false, array(
                'class' => 'logo',
            ))
        );
        return $html;
    }
}

function theme_prefix_setup() {
    add_theme_support( 'custom-logo', array(
       'height'      => 100,
       'width'       => 400,
       'flex-width' => true,
    ) );
 }
 //add_action( 'after_setup_theme', 'theme_prefix_setup' );

//add_theme_support( 'custom-logo' );

function maglootheme_custom_logo_setup() {
 $defaults = array(
 'height'      => 100,
 'width'       => 400,
 'flex-width'  => true,
 );
 add_theme_support( 'custom-logo', $defaults );
}
//add_action( 'after_setup_theme', 'maglootheme_custom_logo_setup' );

 function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

/*-----------------------------------------------------------------------------------*/
/*  Widgets
/*-----------------------------------------------------------------------------------*/
function theme_widgets_init() {
    register_sidebar ( array (
        'id' => 'footer-1',
        'name' => __ ( 'Sidebar Footer 1', 'theme' ),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ) );

    register_sidebar ( array (
        'id' => 'footer-2',
        'name' => __ ( 'Sidebar Footer 2', 'theme' ),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ) );

    register_sidebar ( array (
        'id' => 'footer-3',
        'name' => __ ( 'Sidebar Footer 3', 'theme' ),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ) );
}



add_action ( 'widgets_init', 'theme_widgets_init' );


function theme_register_menus() {
  register_nav_menu( 'primary', __( 'Primary Menu', 'theme' ) );
}

function register_footer_menu() {
    register_nav_menu( 'footer', __( 'Footer Menu', 'theme' ) );
}

function register_sub_nav_menu() {
    register_nav_menu( 'sub-nav', __( 'Sub Nav Menu', 'theme' ) );
}


add_action( 'after_setup_theme', 'theme_register_menus' );
add_action( 'after_setup_theme', 'register_footer_menu' );
add_action( 'after_setup_theme', 'register_sub_nav_menu' );


add_theme_support( 'post-thumbnails' );

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
        'page_title' 	=> 'Website Settings',
		'menu_title'	=> 'Website Settings',
		'menu_slug' 	=> 'website-settings',
		'capability'	=> 'edit_posts'
    ));
	
}

// EXCERPT LENGTH

function maglootheme_excerpt_length($length){
    return 40;
}
add_filter('excerpt_length', 'maglootheme_excerpt_length', 999);


add_filter('wpcf7_autop_or_not', '__return_false');

// add_filter( 'widget_title', 'wpse_widget_title', 10, 3 );
// function wpse_widget_title( $title, $instance, $id_base ) {
//     if ( 'recent-posts' === $id_base && __( 'Recent Posts', 'text_domain' ) === $title ) {
//         $title = '';    
//     }
//     return $title;
// }
<?php

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.1' );
}

@ini_set( 'upload_max_size' , '128M' );

@ini_set( 'post_max_size', '128M');

@ini_set( 'max_execution_time', '300' );

/**
 * include constants
 */
require_once 'inc/constants.php';

/**
 * include CPTs'
 */
require_once 'inc/testimonials-cpt.php';
require_once 'inc/faq-cpt.php';
require_once 'inc/gallery-cpt.php';

/**
 * include acf import (ACF Blocks)
 */
require_once 'inc/setup-custom-fields.php';

/**
 * include acf blocks
 */
require_once 'inc/acf_blocks.php';

/**
 * include custom Polylang strings
 */
require_once 'inc/translations.php';

/**
 * Add theme support
 */
function alokin_add_theme_support() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );

    register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'nougatine' ),
		)
	);

    $args = array(
        'height'               => 50,
        'width'                => 200,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $args );
    
}
add_action( 'after_setup_theme', 'alokin_add_theme_support' );

function alokin_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'nougatine' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'nougatine' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
    register_sidebar(
        array(
            'name' => esc_html__('Language Switcher', 'nougatine'),
            'id' => 'language_switcher_widget_area',
            'description' => esc_html__('Add widgets here to display language switcher.', 'nougatine'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
    register_sidebar(
        array(
            'name' => esc_html__('WooCommerce Cart', 'nougatine'),
            'id' => 'woocommerce_cart_widget_area',
            'description' => esc_html__('Add WooCommerce cart widget here.', 'nougatine'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
    register_sidebar(
        array(
            'name' => esc_html__('Search', 'nougatine'),
            'id' => 'search_widget_area',
            'description' => esc_html__('Add search widget here.', 'nougatine'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'alokin_widgets_init' );

/**
 * Remove Feeds
 */
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
function remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' );
}
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_classic_theme_styles' );

function alokin_enqueue_assets() {
    wp_register_style('swiper_style', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_style('swiper_style');

    wp_register_style('slick_theme_style', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css');
    wp_enqueue_style('slick_theme_style');
    wp_register_style('slick_style', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css');
    wp_enqueue_style('slick_style');
    
    wp_enqueue_style('lightbox-style', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css');

    wp_register_style('aos_style', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css');
    wp_enqueue_style('aos_style');

    wp_register_style('main_style', get_template_directory_uri() . '/assets/css/theme.min.css', array(), _S_VERSION, 'all');
    wp_enqueue_style('main_style');

    wp_register_script('swiper_script', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
    wp_enqueue_script('swiper_script');

    wp_register_script('slick_script', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js');
    wp_enqueue_script('slick_script');

    wp_register_script('aos_script', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js');
    wp_enqueue_script('aos_script');

    wp_enqueue_script('lightbox-script', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', array('jquery'), '', true);

    wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/js/script.min.js', array('jquery'), _S_VERSION, true );
    wp_localize_script( 'main-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ) );
}
add_action( 'wp_enqueue_scripts', 'alokin_enqueue_assets' );

function add_active_class_to_menu_item($classes, $item) {
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_active_class_to_menu_item', 10, 2);
<?php

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

/**
 * include constants
 */
require_once 'inc/constants.php';

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
    wp_register_style('main_style', get_template_directory_uri() . '/assets/css/theme.min.css', array(), _S_VERSION, 'all');
    wp_enqueue_style('main_style');

    wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/js/script.min.js', array('jquery'), _S_VERSION, true );
    wp_localize_script( 'main-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ) );
}
add_action( 'wp_enqueue_scripts', 'alokin_enqueue_assets' );
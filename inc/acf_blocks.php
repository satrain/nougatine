<?php

/************ PREVIEW CSS **************/

function nougatine_setup() {
    // Add support for editor styles.
    add_theme_support( 'editor-styles' );

    // Enqueue editor styles
    add_editor_style( 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' );
    add_editor_style( 'assets/css/theme.min.css' );

}
add_action('after_setup_theme', 'nougatine_setup');

/************ Gutenberg Block Custom Category **************/

function custom_category( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'custom',
                'title' => __('Custom', 'alokin'),
            ),
        ),
    );
}
add_filter('block_categories', 'custom_category', 10, 2);

/************ Render Callback **************/

function nougatine_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from within the 'template-parts/blocks' folder
    if( file_exists(get_theme_file_path("/template-parts/blocks/{$slug}.php")) ) {
        include( get_theme_file_path("/template-parts/blocks/{$slug}.php") );
    }

}

/************ Register ACF Blocks **************/

add_action('acf/init', 'nougatine_acf_init');
function nougatine_acf_init() {
    // check if function exists
    if( function_exists('acf_register_block') ) {

        acf_register_block(array(
            'name' => 'homepage-hero',
            'title' => __('Homepage Hero'),
            'Description' => __('Block for homepage hero'),
            'render_callback' => 'nougatine_acf_block_render_callback',
            'category'        => 'custom',
            'icon'            => 'slides',
            'keywords'        => array('page'),
        ));

        acf_register_block(array(
            'name' => 'benefits',
            'title' => __('Benefits'),
            'Description' => __('Block for Benefits'),
            'render_callback' => 'nougatine_acf_block_render_callback',
            'category'        => 'custom',
            'icon'            => 'slides',
            'keywords'        => array('page'),
        ));

        acf_register_block(array(
            'name' => 'about-us',
            'title' => __('About us Homepage'),
            'Description' => __('Block for About us on Homepage'),
            'render_callback' => 'nougatine_acf_block_render_callback',
            'category'        => 'custom',
            'icon'            => 'slides',
            'keywords'        => array('page'),
        ));

        acf_register_block(array(
            'name' => 'nougatine-products-slider',
            'title' => __('Nougatine Products Slider'),
            'Description' => __('Block for custom products slider'),
            'render_callback' => 'nougatine_acf_block_render_callback',
            'category'        => 'custom',
            'icon'            => 'slides',
            'keywords'        => array('page'),
        ));

        acf_register_block(array(
            'name' => 'nougatine-events',
            'title' => __('Nougatine Events'),
            'Description' => __('Block for Nougatine at your events'),
            'render_callback' => 'nougatine_acf_block_render_callback',
            'category'        => 'custom',
            'icon'            => 'slides',
            'keywords'        => array('page'),
        ));

        acf_register_block(array(
            'name' => 'clients',
            'title' => __('Clients Slider'),
            'Description' => __('Block for clients images slider'),
            'render_callback' => 'nougatine_acf_block_render_callback',
            'category'        => 'custom',
            'icon'            => 'slides',
            'keywords'        => array('page'),
        ));

        acf_register_block(array(
            'name' => 'testimonials',
            'title' => __('Testimonials Slider'),
            'Description' => __('Block for testimonials slider'),
            'render_callback' => 'nougatine_acf_block_render_callback',
            'category'        => 'custom',
            'icon'            => 'slides',
            'keywords'        => array('page'),
        ));

	    acf_register_block(array(
		    'name' => 'kosher',
		    'title' => __('Kosher'),
		    'Description' => __('Block for kosher section'),
		    'render_callback' => 'nougatine_acf_block_render_callback',
		    'category'        => 'custom',
		    'icon'            => 'slides',
		    'keywords'        => array('page'),
	    ));

        acf_register_block(array(
            'name' => 'cta-mid-box',
            'title' => __('CTA Mid Box'),
            'Description' => __('Block for CTA mid box sections'),
            'render_callback' => 'nougatine_acf_block_render_callback',
            'category'        => 'custom',
            'icon'            => 'slides',
            'keywords'        => array('page'),
        ));

        acf_register_block(array(
            'name' => 'faq',
            'title' => __('FAQ'),
            'Description' => __('Block for FAQs'),
            'render_callback' => 'nougatine_acf_block_render_callback',
            'category'        => 'custom',
            'icon'            => 'slides',
            'keywords'        => array('page'),
        ));

        acf_register_block(array(
            'name' => 'customers-gallery',
            'title' => __("Customer's Gallery"),
            'Description' => __("Block for Customer's Gallery Images"),
            'render_callback' => 'nougatine_acf_block_render_callback',
            'category'        => 'custom',
            'icon'            => 'slides',
            'keywords'        => array('page'),
        ));

        acf_register_block(array(
            'name' => 'four-items-grid',
            'title' => __("Four Items Grid"),
            'Description' => __("Four items grid block"),
            'render_callback' => 'nougatine_acf_block_render_callback',
            'category'        => 'custom',
            'icon'            => 'slides',
            'keywords'        => array('page'),
        ));

        acf_register_block(array(
            'name' => 'video-with-title',
            'title' => __("Video with Title"),
            'Description' => __("Video with title block"),
            'render_callback' => 'nougatine_acf_block_render_callback',
            'category'        => 'custom',
            'icon'            => 'slides',
            'keywords'        => array('page'),
        ));

        acf_register_block(array(
            'name' => 'need-a-quote',
            'title' => __("Need a Quote"),
            'Description' => __("Export a quote as PDF"),
            'render_callback' => 'nougatine_acf_block_render_callback',
            'category'        => 'custom',
            'icon'            => 'slides',
            'keywords'        => array('page'),
        ));

    }
}

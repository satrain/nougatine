<?php

/*
* Creating a function to create CPT Email Submission
*/
  
function nougatine_email_subimission_cpt() {
  
    $labels = array(
        'name'                => _x( 'Testimonials', 'Post Type General Name', 'alokin' ),
        'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'alokin' ),
        'menu_name'           => __( 'Testimonials', 'alokin' ),
        'parent_item_colon'   => __( 'Parent Testimonial', 'alokin' ),
        'all_items'           => __( 'All Testimonials', 'alokin' ),
        'view_item'           => __( 'View Testimonial', 'alokin' ),
        'add_new_item'        => __( 'Add New Testimonial', 'alokin' ),
        'add_new'             => __( 'Add New Testimonial', 'alokin' ),
        'edit_item'           => __( 'Edit Testimonial', 'alokin' ),
        'update_item'         => __( 'Update Testimonial', 'alokin' ),
        'search_items'        => __( 'Search Testimonial', 'alokin' ),
        'not_found'           => __( 'Not Found', 'alokin' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'alokin' ),
    );
          
    $args = array(
        'label'               => __( 'Testimonials', 'twentytwentyone' ),
        'description'         => __( 'Client reviews', 'twentytwentyone' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'       => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    
    );
        
    register_post_type( 'testimonials', $args );
} 

add_action( 'init', 'nougatine_email_subimission_cpt', 0 );

?>
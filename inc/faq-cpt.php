<?php

/*
* Creating a function to create CPT Email Submission
*/
  
function nougatine_faq_cpt() {
  
    $labels = array(
        'name'                => _x( 'FAQs', 'Post Type General Name', 'alokin' ),
        'singular_name'       => _x( 'FAQ', 'Post Type Singular Name', 'alokin' ),
        'menu_name'           => __( 'FAQs', 'alokin' ),
        'parent_item_colon'   => __( 'Parent FAQ', 'alokin' ),
        'all_items'           => __( 'All FAQs', 'alokin' ),
        'view_item'           => __( 'View FAQ', 'alokin' ),
        'add_new_item'        => __( 'Add New FAQ', 'alokin' ),
        'add_new'             => __( 'Add New FAQ', 'alokin' ),
        'edit_item'           => __( 'Edit FAQ', 'alokin' ),
        'update_item'         => __( 'Update FAQ', 'alokin' ),
        'search_items'        => __( 'Search FAQ', 'alokin' ),
        'not_found'           => __( 'Not Found', 'alokin' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'alokin' ),
    );
          
    $args = array(
        'label'               => __( 'FAQ', 'alokin' ),
        'description'         => __( 'Frequently asked questions', 'alokin' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
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
        
    register_post_type( 'faqs', $args );
} 

add_action( 'init', 'nougatine_faq_cpt', 0 );

?>
<?php

/*
* Creating a function to create CPT Gallery
*/
  
function nougatine_gallery_cpt() {
  
    $labels = array(
        'name'                => _x( 'Gallery', 'Post Type General Name', 'alokin' ),
        'singular_name'       => _x( 'Gallery', 'Post Type Singular Name', 'alokin' ),
        'menu_name'           => __( 'Gallery', 'alokin' ),
        'parent_item_colon'   => __( 'Parent Image', 'alokin' ),
        'all_items'           => __( 'All Images', 'alokin' ),
        'view_item'           => __( 'View Image', 'alokin' ),
        'add_new_item'        => __( 'Add New Image', 'alokin' ),
        'add_new'             => __( 'Add New Image', 'alokin' ),
        'edit_item'           => __( 'Edit Image', 'alokin' ),
        'update_item'         => __( 'Update Image', 'alokin' ),
        'search_items'        => __( 'Search Image', 'alokin' ),
        'not_found'           => __( 'Not Found', 'alokin' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'alokin' ),
    );
          
    $args = array(
        'label'               => __( 'Gallery', 'alokin' ),
        'description'         => __( 'Images Gallery', 'alokin' ),
        'labels'              => $labels,
        'supports'            => array( 'author', 'thumbnail', 'revisions', 'custom-fields', ),
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
        
    register_post_type( 'customers_gallery', $args );
} 

add_action( 'init', 'nougatine_gallery_cpt', 0 );

add_filter( 'save_post_customers_gallery', 'nougatine_practitioner_set_title', 10, 3 );
function nougatine_practitioner_set_title ( $post_id, $post, $update ){
//This temporarily removes filter to prevent infinite loops
remove_filter( 'save_post_customers_gallery', __FUNCTION__ );

$title = 'Image ' . $post_id;

//update title
wp_update_post( array( 'ID'=>$post_id, 'post_title'=>$title ) );

//redo filter
add_filter( 'save_post_customers_gallery', __FUNCTION__, 10, 3 );
}

?>
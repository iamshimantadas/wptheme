<?php 

/**
 * Responsible for registering custom post types.
 * 
 * @since 1.0.1
 */

/**
 * registering cpt(our_service)
 */
function wptheme_wp_cpt__services() {
    $supports = array(
    'title', 
    'editor', 
    'author',
    'thumbnail', 
    'excerpt', 
    'custom-fields', 
    'comments',
    'revisions', 
    'post-formats',
    );
    $labels = array(
    'name' => _x('Services', 'plural'),
    'singular_name' => _x('Services', 'singular'),
    'menu_name' => _x('Services', 'admin menu'),
    'name_admin_bar' => _x('Services', 'admin bar'),
    'add_new' => _x('Add New Service', 'add new'),
    'add_new_item' => __('Add New Service'),
    'new_item' => __('New Service'),
    'edit_item' => __('Edit Services'),
    'view_item' => __('View Services'),
    'all_items' => __('All Services'),
    'search_items' => __('Search Services'),
    'not_found' => __('No Services found.'),
    );
    $args = array(
    'supports' => $supports,
    'labels' => $labels,
    'public' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'service'),
    'has_archive' => true,
    'hierarchical' => false,
    'show_in_menu' => true,
    'menu_icon' => 'dashicons-media-text',  
    );
    register_post_type('our_service', $args);
    } 
//  add_action('init', 'wptheme_wp_cpt__services');


/**adding taxonomy to post type ~ our_service */
function wptheme_wp_cpt_service_custom_taxonomy() {
    // Add new "Category" taxonomy to Posts
    register_taxonomy('service_category', 'our_service', array(
      // Hierarchical taxonomy (like categories)
      'hierarchical' => true,
      'show_ui' => true,
      'show_admin_column' => true,

      // This array of options controls the labels displayed in the WordPress Admin UI
      'labels' => array(
        'name' => _x( 'Service Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Service Categories', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Service Categories' ),
        'all_items' => __("All Service's Categories"),
        'parent_item' => __( 'Parent Service Category' ),
        'parent_item_colon' => __( 'Parent Service Category:' ),
        'edit_item' => __( 'Edit Service Category' ),
        'update_item' => __( 'Update Service Category' ),
        'add_new_item' => __( 'Add New Service Category' ),
        'new_item_name' => __( 'New Service Category Name' ),
        'menu_name' => __( 'Service Category' ),
      ),
      // Control the slugs used for this taxonomy
      'rewrite' => array(
        'slug' => 'services',
        'with_front' => false,
        'hierarchical' => true
      ),
    ));
  }
// add_action( 'init', 'wptheme_wp_cpt_service_custom_taxonomy', 0 );


?>
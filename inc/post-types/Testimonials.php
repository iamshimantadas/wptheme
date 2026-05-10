<?php

/**
 * Register Testimonials Custom Post Type
 */
function mc_register_testimonials_cpt() {

    $supports = array(
        'title',
        'editor',
        'thumbnail',
        'excerpt',
        'revisions'
    );

    $labels = array(
        'name'               => _x('Testimonials', 'plural'),
        'singular_name'      => _x('Testimonial', 'singular'),
        'menu_name'          => _x('Testimonials', 'admin menu'),
        'name_admin_bar'     => _x('Testimonial', 'admin bar'),
        'add_new'            => _x('Add New', 'testimonial'),
        'add_new_item'       => __('Add New Testimonial'),
        'new_item'           => __('New Testimonial'),
        'edit_item'          => __('Edit Testimonial'),
        'view_item'          => __('View Testimonial'),
        'all_items'          => __('All Testimonials'),
        'search_items'       => __('Search Testimonials'),
        'not_found'          => __('No testimonials found'),
    );

    $args = array(
        'supports'           => $supports,
        'labels'             => $labels,
        'public'             => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'testimonial'),
        'has_archive'        => true,
        'hierarchical'       => false,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-testimonial',
        'show_in_rest'       => false,
    );

    register_post_type('mc_testimonial', $args);
}
// add_action('init', 'mc_register_testimonials_cpt');


/**
 * Register Testimonial Category Taxonomy
 */
function mc_register_testimonial_taxonomy() {

    register_taxonomy('testimonial_category', 'mc_testimonial', array(
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,

        'labels' => array(
            'name'              => _x('Testimonial Categories', 'taxonomy general name'),
            'singular_name'     => _x('Testimonial Category', 'taxonomy singular name'),
            'search_items'      => __('Search Categories'),
            'all_items'         => __('All Categories'),
            'parent_item'       => __('Parent Category'),
            'parent_item_colon' => __('Parent Category:'),
            'edit_item'         => __('Edit Category'),
            'update_item'       => __('Update Category'),
            'add_new_item'      => __('Add New Category'),
            'new_item_name'     => __('New Category Name'),
            'menu_name'         => __('Categories'),
        ),

        'rewrite' => array(
            'slug'         => 'testimonial-category',
            'with_front'   => false,
            'hierarchical' => true,
        ),
        'show_in_rest' => false,
    ));
}
// add_action('init', 'mc_register_testimonial_taxonomy');
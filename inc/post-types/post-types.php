<?php
/**
||-> CPT - [storyfi]
*/

function storyfi_cpt() {
    register_post_type('storyfi', array(
        'label' => esc_html__('Storyficator','storyfi'),
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array('slug' => 'storyfi', 'with_front' => false),
        'query_var' => true,
        'publicly_queryable' => false,
        'menu_position' => '1',
        'menu_icon' => 'dashicons-businessman',
        'supports' => array('title'),
        'labels' => array (
            'name' => esc_html__('Storyficator','storyfi'),
            'singular_name' => esc_html__('Story','storyfi'),
            'menu_name' => esc_html__('Storyficator','storyfi'),
            'add_new' => esc_html__('Add New','storyfi'),
            'add_new_item' => esc_html__('Add New','storyfi'),
            'edit' => esc_html__('Edit','storyfi'),
            'edit_item' => esc_html__('Edit','storyfi'),
            'new_item' => esc_html__('New','storyfi'),
            'view' => esc_html__('View','storyfi'),
            'view_item' => esc_html__('View','storyfi'),
            'search_items' => esc_html__('Search','storyfi'),
            'not_found' => esc_html__('No Stories Found','storyfi'),
            'not_found_in_trash' => esc_html__('No Stories Found in Trash','storyfi'),
            'parent' => esc_html__('Parent','storyfi'),
        )
    )); 
}
add_action('init', 'storyfi_cpt');

?>
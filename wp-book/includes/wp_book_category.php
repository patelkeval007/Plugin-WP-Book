<?php

function wp_book_category_init()
{
    $labels = array(
        'name'              => __('Book Category', 'wp_book_plugin'),
        'singular_name'     => __('Book Category', 'wp_book_plugin'),
        'search_items'      => __('Search Book Categories', 'wp_book_plugin'),
        'all_items'         => __('All Book Categories', 'wp_book_plugin'),
        'parent_item'       => __('Parent Book Category', 'wp_book_plugin'),
        'parent_item_colon' => __('Parent Book Category:', 'wp_book_plugin'),
        'edit_item'         => __('Edit Book Category', 'wp_book_plugin'),
        'update_item'       => __('Update Book Category', 'wp_book_plugin'),
        'add_new_item'      => __('Add New Book Category', 'wp_book_plugin'),
        'new_item_name'     => __('New Book Category Name', 'wp_book_plugin'),
        'menu_name'         => __('Book Category', 'wp_book_plugin'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'wp_book_category'),
    );

    register_taxonomy('wp_book_category', array('book'), $args);
}

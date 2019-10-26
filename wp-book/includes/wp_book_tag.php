<?php

function wp_book_tag_init()
{
    $labels = array(
        'name'                       => __('Book Tag', 'wp_book_plugin'),
        'singular_name'              => __('Book', 'wp_book_plugin'),
        'search_items'               => __('Search Book Tag', 'wp_book_plugin'),
        'popular_items'              => __('Popular Book Tag', 'wp_book_plugin'),
        'all_items'                  => __('All Book Tag', 'wp_book_plugin'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Book', 'wp_book_plugin'),
        'update_item'                => __('Update Book', 'wp_book_plugin'),
        'add_new_item'               => __('Add New Book', 'wp_book_plugin'),
        'new_item_name'              => __('New Book Name', 'wp_book_plugin'),
        'separate_items_with_commas' => __('Separate Book Tag with commas', 'wp_book_plugin'),
        'add_or_remove_items'        => __('Add or remove Book Tag', 'wp_book_plugin'),
        'choose_from_most_used'      => __('Choose from the most used Book Tag', 'wp_book_plugin'),
        'not_found'                  => __('No Book Tag found.', 'wp_book_plugin'),
        'menu_name'                  => __('Book Tag', 'wp_book_plugin'),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array('slug' => 'wp_book_tag'),
    );

    register_taxonomy('wp_book_tag', array('book'), $args);
}

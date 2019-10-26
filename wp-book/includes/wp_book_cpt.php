<?php
function wp_book_cpt_init()
{
    $labels = array(
        'name'               => __('Books',  'wp_book_plugin'),
        'singular_name'      => __('Book', 'wp_book_plugin'),
        'menu_name'          => __('Books', 'wp_book_plugin'),
        'name_admin_bar'     => __('Book', 'wp_book_plugin'),
        'add_new'            => __('Add New', 'wp_book_plugin'),
        'add_new_item'       => __('Add New Book', 'wp_book_plugin'),
        'new_item'           => __('New Book', 'wp_book_plugin'),
        'edit_item'          => __('Edit Book', 'wp_book_plugin'),
        'view_item'          => __('View Book', 'wp_book_plugin'),
        'all_items'          => __('All Books', 'wp_book_plugin'),
        'search_items'       => __('Search Books', 'wp_book_plugin'),
        'parent_item_colon'  => __('Parent Books:', 'wp_book_plugin'),
        'not_found'          => __('No books found.', 'wp_book_plugin'),
        'not_found_in_trash' => __('No books found in Trash.', 'wp_book_plugin')
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __('Description.', 'wp_book_plugin'),
        'public'             => true,
        'menu_icon'          => 'dashicons-book',
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'book'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
    );

    register_post_type('book', $args);
}

<?php

/**
 * Register Custom Post Type-Book for wp-book plugin.
 *
 * @author  keval patel <pk.patelkeval2110@gmail.com>
 * @license GPL v2 or later
 */


/**
 * Create book post type.
 *
 * @return void.
 */
function wp_book_cpt_init()
{
    $labels = [
        'name'               => __('Books',  'wp-book'),
        'singular_name'      => __('Book', 'wp-book'),
        'menu_name'          => __('Books', 'wp-book'),
        'name_admin_bar'     => __('Book', 'wp-book'),
        'add_new'            => __('Add New', 'wp-book'),
        'add_new_item'       => __('Add New Book', 'wp-book'),
        'new_item'           => __('New Book', 'wp-book'),
        'edit_item'          => __('Edit Book', 'wp-book'),
        'view_item'          => __('View Book', 'wp-book'),
        'all_items'          => __('All Books', 'wp-book'),
        'search_items'       => __('Search Books', 'wp-book'),
        'parent_item_colon'  => __('Parent Books:', 'wp-book'),
        'not_found'          => __('No books found.', 'wp-book'),
        'not_found_in_trash' => __('No books found in Trash.', 'wp-book'),
    ];

    $args = [
        'labels'             => $labels,
        'description'        => __('Description.', 'wp-book'),
        'public'             => true,
        'menu_icon'          => 'dashicons-book',
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'book'],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => [
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'comments',
        ],
    ];

    register_post_type('book', $args);

}//end wp_book_cpt_init()

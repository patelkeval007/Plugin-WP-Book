<?php

/**
 * Register category for wp-book plugin.
 *
 * @author  keval patel <pk.patelkeval2110@gmail.com>
 * @license GPL v2 or later
 */


/**
 * Create book category.
 *
 * @return void.
 */
function wp_book_category_init()
{
    $labels = [
        'name'              => __('Book Category', 'wp-book'),
        'singular_name'     => __('Book Category', 'wp-book'),
        'search_items'      => __('Search Book Categories', 'wp-book'),
        'all_items'         => __('All Book Categories', 'wp-book'),
        'parent_item'       => __('Parent Book Category', 'wp-book'),
        'parent_item_colon' => __('Parent Book Category:', 'wp-book'),
        'edit_item'         => __('Edit Book Category', 'wp-book'),
        'update_item'       => __('Update Book Category', 'wp-book'),
        'add_new_item'      => __('Add New Book Category', 'wp-book'),
        'new_item_name'     => __('New Book Category Name', 'wp-book'),
        'menu_name'         => __('Book Category', 'wp-book'),
    ];

    $args = [
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'wp_book_category'],
    ];

    register_taxonomy('wp_book_category', ['book'], $args);

}//end wp_book_category_init()

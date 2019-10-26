<?php

/**
 * Create custom non-hierarchical taxonomy Book Tag.
 *
 * @author  keval patel <pk.patelkeval2110@gmail.com>
 * @license GPL v2 or later
 */


/**
 * Create book Tag.
 *
 * @return void.
 */
function wp_book_tag_init()
{
    $labels = [
        'name'                       => __('Book Tag', 'wp-book'),
        'singular_name'              => __('Book', 'wp-book'),
        'search_items'               => __('Search Book Tag', 'wp-book'),
        'popular_items'              => __('Popular Book Tag', 'wp-book'),
        'all_items'                  => __('All Book Tag', 'wp-book'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Book', 'wp-book'),
        'update_item'                => __('Update Book', 'wp-book'),
        'add_new_item'               => __('Add New Book', 'wp-book'),
        'new_item_name'              => __('New Book Name', 'wp-book'),
        'separate_items_with_commas' => __('Separate Book Tag with commas', 'wp-book'),
        'add_or_remove_items'        => __('Add or remove Book Tag', 'wp-book'),
        'choose_from_most_used'      => __('Choose from the most used Book Tag', 'wp-book'),
        'not_found'                  => __('No Book Tag found.', 'wp-book'),
        'menu_name'                  => __('Book Tag', 'wp-book'),
    ];

    $args = [
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => ['slug' => 'wp_book_tag'],
    ];

    register_taxonomy('wp_book_tag', ['book'], $args);

}//end wp_book_tag_init()

<?php

/**
 * Create custom dashboard widget which shows the top 5 book categories (based on count).
 *
 * @author  keval patel <pk.patelkeval2110@gmail.com>
 * @license GPL v2 or later
 */


/**
 * Add custom widget.
 *
 * @return void.
 */
function wp_book_dash_cat_widget_init()
{
    wp_add_dashboard_widget(
        'wp_book_dash_cat_widget',
        __('Top 5 book categories', 'wp-book'),
        'wp_book_dash_cat_widget_cb'
    );

}//end wp_book_dash_cat_widget_init()


/**
 * Display the HTML list of categories.
 *
 * @return void.
 */
function wp_book_dash_cat_widget_cb()
{
    $args = [
        'orderby'    => 'count',
        'order'      => 'DESC',
        'number'     => 5,
        'show_count' => 1,
        'style'      => 'none',
    ];
    wp_list_categories($args);

}//end wp_book_dash_cat_widget_cb()

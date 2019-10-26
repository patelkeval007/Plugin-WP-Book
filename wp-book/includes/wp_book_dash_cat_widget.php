<?php

function wp_book_dash_cat_widget_init()
{
    wp_add_dashboard_widget(
        'wp_book_dash_cat_widget',
        __('Top 5 book categories', 'wp_book_plugin'),
        'wp_book_dash_cat_widget_cb'
    );
}

function wp_book_dash_cat_widget_cb()
{
    $args = array(
        'orderby' => 'count',
        'order' => 'DESC',
        'number' => 5,
        'show_count' => 1,
        'style' => 'none'
    );
    wp_list_categories($args);
}

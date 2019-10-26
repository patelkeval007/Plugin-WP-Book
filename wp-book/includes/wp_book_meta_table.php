<?php
function wp_book_meta_table_init()
{
    global $wpdb;
    $wpdb->bookmeta = $wpdb->prefix . 'bookmeta';
}

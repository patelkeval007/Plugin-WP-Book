<?php

/**
 * For database table create and drop.
 *
 * @author  keval patel <pk.patelkeval2110@gmail.com>
 * @license GPL v2 or later
 */


/**
 * Create wp_bookmeta table to database.
 *
 * @return void.
 */
function wp_bookmeta_table_create()
{
    global $wpdb;
    $collate = $wpdb->get_charset_collate();
    $sql     = "CREATE TABLE `wp_bookmeta` (
        `meta_id` bigint(20) NOT NULL AUTO_INCREMENT,
        `book_id` bigint(20) NOT NULL DEFAULT '0',
        `meta_key` varchar(255) DEFAULT NULL,
        `meta_value` longtext,
        PRIMARY KEY (`meta_id`),
        KEY `book_id` (`book_id`),
        KEY `meta_key` (`meta_key`)
    ) {$collate}";
    include_once ABSPATH.'wp-admin/includes/upgrade.php';
    dbDelta($sql);

}//end wp_bookmeta_table_create()


/**
 * Drop wp_bookmeta table from database.
 *
 * @return void.
 */
function wp_bookmeta_table_drop()
{
    global $wpdb;
    $prefix = $wpdb->prefix;
    $sql    = "DROP TABLE IF EXISTS {$prefix}bookmeta";
    $wpdb->query($sql);

}//end wp_bookmeta_table_drop()

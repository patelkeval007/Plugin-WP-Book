<?php

/**
 * Plugin wp-book root file.
 *
 * @author  keval patel <pk.patelkeval2110@gmail.com>
 * @license GPL v2 or later
 *
 * Plugin Name:       WP Book
 * Plugin URI:        https://github.com/patelkeval007/Plugin-WP-Book
 * Description:       To manage all book related functionalities.
 * Version:           1.0.0
 * Author:            keval patel
 * Author URI:        https://wpbypk.wordpress.com/
 * License:           GPL v2 or later
 * Text Domain:       wp-book
 * Domain Path:       /languages/
 */

defined('ABSPATH') || die('Denied Direct Access.');

defined('WP_BOOK_PLUGIN_DIR_PATH') || define('WP_BOOK_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
defined('WP_BOOK_PLUGIN_URL') || define('WP_BOOK_PLUGIN_URL', plugins_url().'/wp-book');

register_activation_hook(
    __FILE__,
    function () {
        wp_bookmeta_table_create();
    }
);

register_deactivation_hook(
    __FILE__,
    function () {
    }
);

register_uninstall_hook(
    __FILE__,
    'wp_book_uninstall_cb'
);


/**
 * Things to do at plugin delete/uninstall.
 *
 * @return void.
 */
function Wp_Book_Uninstall_cb()
{
        unregister_post_type('book');
        wp_bookmeta_table_drop();

}//end Wp_Book_Uninstall_cb()


// All DB operations.
require WP_BOOK_PLUGIN_DIR_PATH.'includes/db.php';

// Custom post type Book.
require WP_BOOK_PLUGIN_DIR_PATH.'includes/wp_book_cpt.php';
add_action('init', 'wp_book_cpt_init');

// Custom hierarchical taxonomy Book Category.
require WP_BOOK_PLUGIN_DIR_PATH.'includes/wp_book_category.php';
add_action('init', 'wp_book_category_init');

// Custom non-hierarchical taxonomy Book Tag.
require WP_BOOK_PLUGIN_DIR_PATH.'includes/wp_book_tag.php';
add_action('init', 'wp_book_tag_init');

// Custom meta box book to save book meta information.
require WP_BOOK_PLUGIN_DIR_PATH.'includes/wp_book_metabox.php';
add_action('add_meta_boxes', 'wp_book_metabox_init');
add_action('save_post', 'wp_book_metabox_save_post');

/*
 * Custom meta table(wp_bookmeta) and save all book meta information in that table.
 * wp_bookmeta creted at plugin activation.
 * wp_bookmeta droped at plugin deactivation.
 * below is for register the wp_bookmeta in wordpress.
 */

require WP_BOOK_PLUGIN_DIR_PATH.'includes/wp_book_meta_table.php';
add_action('plugins_loaded', 'wp_book_meta_table_init');

// Custom admin settings page for Book.(In :- WP Book > Book Settings).
require WP_BOOK_PLUGIN_DIR_PATH.'includes/wp_book_admin_setting.php';
add_action('admin_menu', 'wp_book_settings_menu_init');
add_action('admin_init', 'wp_book_admin_settings_init');

/*
 * Shortcode [book] to display the book(s) information.
 * Shortcode attributes should be id, author_name, year, category, tag, and publisher.
 * [book category="c1" tag="t1,t2"]
 * [book author_name="a1" publisher="p1,p2" year="2009"]
 * [book]
 */

require WP_BOOK_PLUGIN_DIR_PATH.'includes/wp_book_shortcode.php';
add_action('init', 'wp_book_shortcode_init');

// Custom widget to display books of selected category in the sidebar.
require WP_BOOK_PLUGIN_DIR_PATH.'includes/wp_book_cust_widget.php';
add_action('widgets_init', 'wp_book_cust_widget_init');

// Custom dashboard widget which shows the top 5 book categories (based on count).
require WP_BOOK_PLUGIN_DIR_PATH.'includes/wp_book_dash_cat_widget.php';
add_action('wp_dashboard_setup', 'wp_book_dash_cat_widget_init');

// Internationalize wp_book plugin.
add_action(
    'plugins_loaded',
    function () {
        load_plugin_textdomain('wp-book', false, dirname(plugin_basename(__FILE__)).'/languages/');
    }
);

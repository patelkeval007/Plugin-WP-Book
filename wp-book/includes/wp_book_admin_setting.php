<?php

function wp_book_admin_settings_init()
{
    add_settings_section(
        'wp_book_section',
        __(' ', 'wp_book_plugin'),
        'wp_book_section_cb',
        'wp_book_options'
    );
    add_settings_field(
        'wp_book_nop',
        __('Number of books displayed per page', 'wp_book_plugin'),
        'wp_book_nop_cb',
        'wp_book_options',
        'wp_book_section'
    );
    add_settings_field(
        'wp_book_currency',
        __('Currency', 'wp_book_plugin'),
        'wp_book_currency_cb',
        'wp_book_options',
        'wp_book_section',
        [
            // use $args' label_for to populate the id inside the callback
            'label_for' => 'wp_book_nop',
            'wp_book_custom_data' => 'custom',
        ]
    );
    register_setting('wp_book_section', 'wp_book_nop');
    register_setting('wp_book_section', 'wp_book_currency');
}

function wp_book_section_cb()
{
    // <? esc_html_e('', 'wp_book_plugin');
}
function wp_book_nop_cb()
{
    ?>
    <input type="number" id="wp_book_nop" name="wp_book_nop" value="<?php if (get_option('wp_book_nop') == "") {
                                                                            echo '10';
                                                                        } else {
                                                                            echo get_option('wp_book_nop');
                                                                        } ?>">
<?php
}
function wp_book_currency_cb()
{
    $options = get_option('wp_book_currency');
    ?>
    <select name='wp_book_currency[wp_book_currency]'>
        <option value='₹' <?php selected($options['wp_book_currency'], '₹'); ?>><?php esc_html_e('Indian Rupee (INR - ₹)', 'wp_book_plugin'); ?></option>
        <option value='$' <?php selected($options['wp_book_currency'], '$'); ?>><?php esc_html_e('US Dollar (USD - $)', 'wp_book_plugin'); ?></option>
        <option value='€' <?php selected($options['wp_book_currency'], '€'); ?>><?php esc_html_e('Euro (EUR - €)', 'wp_book_plugin'); ?></option>
    </select>
<?php
}

function wp_book_settings_menu_init()
{
    add_submenu_page(
        'edit.php?post_type=book',
        __('Settings', 'wp_book_plugin'),
        __('Book Settings', 'wp_book_plugin'),
        'manage_options',
        'wp_book_setting',
        'wp_book_setting_html'
    );
}

function wp_book_setting_html()
{
    if (!current_user_can('manage_options')) {
        return;
    }
    if (isset($_GET['settings-updated'])) {
        add_settings_error(
            'wp_book_messages',
            'wp_book_message',
            __('Settings Saved', 'wp_book_plugin'),
            'updated'
        );
    }
    settings_errors('wp_book_messages');
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
                settings_fields('wp_book_section');
                do_settings_sections('wp_book_options');
                submit_button(__('Save Settings', 'wp_book_plugin'));
                ?>
        </form>
    </div>
<?php
}

<?php
function wp_book_metabox_init()
{
    add_meta_box('wp_book_metabox', __('About Book', 'wp_book_plugin'), 'wp_book_metabox_info', ['book'], 'side', 'high');
}
function wp_book_metabox_info($post)
{

    $_author_name_meta = get_metadata('book', $post->ID, '_author_name_meta', true) ? get_metadata('book', $post->ID, '_author_name_meta', true) : '';
    $_price_meta = get_metadata('book', $post->ID, '_price_meta', true) ? get_metadata('book', $post->ID, '_price_meta', true) : 0;
    $_publisher_meta = get_metadata('book', $post->ID, '_publisher_meta', true) ? get_metadata('book', $post->ID, '_publisher_meta', true) : '';
    $_year_meta = get_metadata('book', $post->ID, '_year_meta', true) ? get_metadata('book', $post->ID, '_year_meta', true) : 2000;
    $_edition_meta = get_metadata('book', $post->ID, '_edition_meta', true) ? get_metadata('book', $post->ID, '_edition_meta', true) : 1;
    $_url_meta = get_metadata('book', $post->ID, '_url_meta', true) ? get_metadata('book', $post->ID, '_url_meta', true) : '';

    ?>
    Author Name:<br><input type="text" name="a_name" value="<?php echo $_author_name_meta ?>">
    <br>Price:<br><input type="number" name="price" min="0" step="1" value="<?php echo $_price_meta ?>">
    <br>Publisher:<br><input type="text" name="publisher" value="<?php echo $_publisher_meta ?>">
    <br>Year:<br><input type="number" name="year" step="1" value="<?php echo $_year_meta ?>" />
    <br>Edition:<br><input type="number" name="edition" value="<?php echo $_edition_meta ?>">
    <br>URL:<br><input type="url" name="url" value="<?php echo $_url_meta ?>">
<?php
}

function wp_book_metabox_save_post($post_id)
{
    if (
        array_key_exists('a_name', $_POST) &&
        array_key_exists('price', $_POST) &&
        array_key_exists('publisher', $_POST) &&
        array_key_exists('year', $_POST) &&
        array_key_exists('edition', $_POST) &&
        array_key_exists('url', $_POST)
    ) {
        update_metadata('book', $post_id, '_author_name_meta', $_POST['a_name']);
        update_metadata('book', $post_id, '_price_meta', $_POST['price']);
        update_metadata('book', $post_id, '_publisher_meta', $_POST['publisher']);
        update_metadata('book', $post_id, '_year_meta', $_POST['year']);
        update_metadata('book', $post_id, '_edition_meta', $_POST['edition']);
        update_metadata('book', $post_id, '_url_meta', $_POST['url']);

        update_post_meta($post_id, '_author_name_meta', $_POST['a_name']);
        update_post_meta($post_id, '_publisher_meta', $_POST['publisher']);
        update_post_meta($post_id, '_year_meta', $_POST['year']);
    }
}

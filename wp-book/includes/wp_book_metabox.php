<?php

/**
 * Create custom meta box book to save book meta information.
 *
 * @author  keval patel <pk.patelkeval2110@gmail.com>
 * @license GPL v2 or later
 */


/**
 * Add wp_book metabox in wordpress.
 *
 * @return void.
 */
function wp_book_metabox_init()
{
    add_meta_box('wp_book_metabox', __('About Book', 'wp-book'), 'wp_book_metabox_info', ['book'], 'side', 'high');

}//end wp_book_metabox_init()


/**
 * Display wp_book metabox layout with data.
 *
 * @param mixed $post Post data.
 *
 * @return void.
 */
function wp_book_metabox_info($post)
{

    $authorNameMeta = '';
    if (get_metadata('book', $post->ID, '_author_name_meta', true) == true) {
        $authorNameMeta = get_metadata('book', $post->ID, '_author_name_meta', true);
    }

    $priceMeta = 0;
    if (get_metadata('book', $post->ID, '_price_meta', true) == true) {
        $priceMeta = get_metadata('book', $post->ID, '_price_meta', true);
    }

    $publisherMeta = true;
    if (get_metadata('book', $post->ID, '_publisher_meta', true) == true) {
        $publisherMeta = get_metadata('book', $post->ID, '_publisher_meta', true);
    }

    $yearMeta = 2000;
    if (get_metadata('book', $post->ID, '_year_meta', true) == true) {
        $yearMeta = get_metadata('book', $post->ID, '_year_meta', true);
    }

    $editionMeta = 1;
    if (get_metadata('book', $post->ID, '_edition_meta', true) == true) {
        $editionMeta = get_metadata('book', $post->ID, '_edition_meta', true);
    }

    $urlMeta = '';
    if (get_metadata('book', $post->ID, '_url_meta', true) == true) {
        $urlMeta = get_metadata('book', $post->ID, '_url_meta', true);
    }

    ?>
    Author Name:<br><input type="text" name="a_name" value="<?php echo $authorNameMeta ?>">
    <br>Price:<br><input type="number" name="price" min="0" step="1" value="<?php echo $priceMeta ?>">
    <br>Publisher:<br><input type="text" name="publisher" value="<?php echo $publisherMeta ?>">
    <br>Year:<br><input type="number" name="year" step="1" value="<?php echo $yearMeta ?>" />
    <br>Edition:<br><input type="number" name="edition" value="<?php echo $editionMeta ?>">
    <br>URL:<br><input type="url" name="url" value="<?php echo $urlMeta ?>">
    <?php

}//end wp_book_metabox_info()


/**
 * Add/Update wp_book metabox data.
 *
 * @param mixed $postID Post ID.
 *
 * @return void.
 */
function wp_book_metabox_save_post($postID)
{
    if (array_key_exists('a_name', $_POST) == true
        && array_key_exists('price', $_POST) == true
        && array_key_exists('publisher', $_POST) == true
        && array_key_exists('year', $_POST) == true
        && array_key_exists('edition', $_POST) == true
        && array_key_exists('url', $_POST) == true
    ) {
        update_metadata('book', $postID, '_author_name_meta', $_POST['a_name']);
        update_metadata('book', $postID, '_price_meta', $_POST['price']);
        update_metadata('book', $postID, '_publisher_meta', $_POST['publisher']);
        update_metadata('book', $postID, '_year_meta', $_POST['year']);
        update_metadata('book', $postID, '_edition_meta', $_POST['edition']);
        update_metadata('book', $postID, '_url_meta', $_POST['url']);

        update_post_meta($postID, '_author_name_meta', $_POST['a_name']);
        update_post_meta($postID, '_publisher_meta', $_POST['publisher']);
        update_post_meta($postID, '_year_meta', $_POST['year']);
    }

}//end wp_book_metabox_save_post()


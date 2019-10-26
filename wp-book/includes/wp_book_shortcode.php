<?php
function wp_book_shortcode_init()
{
    add_shortcode('book', 'wp_book_shortcode');
}
function wp_book_shortcode($attributes, $content)
{
    $attributes = shortcode_atts(
        array(
            'id' => 0,
            'author_name' => '',
            'publisher' => '',
            'year' => 0000,
            'tag' => '',
            'category' => ''
        ),
        $attributes,
        'book'
    );

    //For :- [book category="c1" tag="t1,t2"]
    if ($attributes['category'] != "" || $attributes["tag"] != "") {
        $args = array(
            'p' => $attributes['id'],
            'post_type' => 'book',
            'post_status' => 'publish',
            'posts_per_page' => get_option('wp_book_nop'),
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'wp_book_category',
                    'field'    => 'slug',
                    'terms'    => explode(',', $attributes['category']),
                    'include_children' => true,
                    'operator' => 'IN'
                ),
                array(
                    'taxonomy' => 'wp_book_tag',
                    'field'    => 'slug',
                    'terms'    => explode(',', $attributes['tag']),
                    'include_children' => false,
                    'operator' => 'IN'
                ),
            ),
        );
    }
    //For :- [book author_name="a1" publisher="p1,p2" year="2009"]
    else if ($attributes['author_name'] != "" || $attributes["publisher"] != "" || $attributes["year"] != "") {
        $args = array(
            'post_type' => 'book',
            'post_status' => 'publish',
            'posts_per_page' => get_option('wp_book_nop'),
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => '_author_name_meta',
                    'value' => explode(',', $attributes['author_name']),
                    'compare'   => 'IN',
                ),
                array(
                    'key' => '_publisher_meta',
                    'value' => explode(',', $attributes['publisher']),
                    'compare'   => 'IN',
                ),
                array(
                    'key' => '_year_meta',
                    'value' => explode(',', $attributes['year']),
                    'compare'   => 'IN',
                ),
            ),
        );
    } else {
        $args = array(
            'p' => $attributes['id'],
            'post_type' => 'book',
            'post_status' => 'publish',
            'posts_per_page' => get_option('wp_book_nop'),
        );
    }
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $curr_symbol = get_option('wp_book_currency');
            $price = get_metadata('book', get_the_ID(), '_price_meta', true);
            //Refer Online Convertor also
            // $result = @file_get_contents("https://api.exchangeratesapi.io/latest?base=USD");
            if ($curr_symbol['wp_book_currency'] == '₹') {
                //do something...
            } else if ($curr_symbol['wp_book_currency'] == '$') {
                $price = $price / 71;
            } else if ($curr_symbol['wp_book_currency'] == '€') {
                $price = $price / 78;
            }
            //iterate post index in loop
            $content .= '<article id="book-' . get_the_ID() . '">';
            $content .= '<center><h3 style="color: maroon;">' . get_the_title() . '</h3></center>';
            $content .= '<p>' . get_the_content() . '</p>';
            $content .= '<p>Author :- ' . get_metadata('book', get_the_ID(), '_author_name_meta', true);
            $content .= '<br> publisher :- ' . get_metadata('book', get_the_ID(), '_publisher_meta', true);
            $content .= '<br> year :- ' . get_metadata('book', get_the_ID(), '_year_meta', true);
            $content .= '<br> price :- ' . $price . ' ' . $curr_symbol['wp_book_currency'];
            $content .= '<br> URL :- <a href=' . get_metadata('book', get_the_ID(), '_url_meta', true) . '>' . get_metadata('book', get_the_ID(), '_url_meta', true) . '</a>';
            $content .= '</article>';
        }
    } else {
        $content .= "No Book Found....";
    }
    return $content;
}

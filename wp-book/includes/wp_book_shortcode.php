<?php

/**
 * Create shortcode [book] to display the book(s) information.
 *
 * @author  keval patel <pk.patelkeval2110@gmail.com>
 * @license GPL v2 or later
 */


/**
 * Add shortcode to wordpress.
 *
 * @return void.
 */
function wp_book_shortcode_init()
{
    add_shortcode('book', 'wp_book_shortcode');

}//end wp_book_shortcode_init()


/**
 * For filtering and getting html content as result.
 *
 * @param mixed $attributes shortcode attributes for filter informations.
 * @param mixed $content    html string content which is display as result of shortcode.
 *
 * @return string.
 */
function wp_book_shortcode($attributes, $content)
{
    $attributes = shortcode_atts(
        [
            'id'          => 0,
            'author_name' => '',
            'publisher'   => '',
            'year'        => 0000,
            'tag'         => '',
            'category'    => '',
        ],
        $attributes,
        'book'
    );

    // For :- [book category="c1" tag="t1,t2"].
    if ($attributes['category'] != "" || $attributes["tag"] != "") {
        $args = [
            'p'              => $attributes['id'],
            'post_type'      => 'book',
            'post_status'    => 'publish',
            'posts_per_page' => get_option('wp_book_nop'),
            'tax_query'      => [
                'relation' => 'OR',
                [
                    'taxonomy'         => 'wp_book_category',
                    'field'            => 'slug',
                    'terms'            => explode(',', $attributes['category']),
                    'include_children' => true,
                    'operator'         => 'IN',
                ],
                [
                    'taxonomy'         => 'wp_book_tag',
                    'field'            => 'slug',
                    'terms'            => explode(',', $attributes['tag']),
                    'include_children' => false,
                    'operator'         => 'IN',
                ],
            ],
        ];
    } else if ($attributes['author_name'] != "" || $attributes["publisher"] != "" || $attributes["year"] != "") {
        // For :- [book author_name="a1" publisher="p1,p2" year="2009"].
        $args = [
            'post_type'      => 'book',
            'post_status'    => 'publish',
            'posts_per_page' => get_option('wp_book_nop'),
            'meta_query'     => [
                'relation' => 'OR',
                [
                    'key'     => '_author_name_meta',
                    'value'   => explode(',', $attributes['author_name']),
                    'compare' => 'IN',
                ],
                [
                    'key'     => '_publisher_meta',
                    'value'   => explode(',', $attributes['publisher']),
                    'compare' => 'IN',
                ],
                [
                    'key'     => '_year_meta',
                    'value'   => explode(',', $attributes['year']),
                    'compare' => 'IN',
                ],
            ],
        ];
    } else {
        $args = [
            'p'              => $attributes['id'],
            'post_type'      => 'book',
            'post_status'    => 'publish',
            'posts_per_page' => get_option('wp_book_nop'),
        ];
    }//end if

    $query = new WP_Query($args);
    if ($query->have_posts() == true) {
        while ($query->have_posts() == true) {
            $query->the_post();
            $currSymbol = get_option('wp_book_currency');
            $price      = get_metadata('book', get_the_ID(), '_price_meta', true);
            // Refer Online Convertor also.
            // $result = @file_get_contents("https://api.exchangeratesapi.io/latest?base=USD");.
            if ($currSymbol['wp_book_currency'] == '₹') {
                // Do something...
            } else if ($currSymbol['wp_book_currency'] == '$') {
                $price = ((int) $price / 71);
            } else if ($currSymbol['wp_book_currency'] == '€') {
                $price = ((int) $price / 78);
            }

            // Iterate post index in loop.
            $content .= '<article id="book-'.get_the_ID().'">';
            $content .= '<center><h3 style="color: maroon;">'.get_the_title().'</h3></center>';
            $content .= '<p>'.get_the_content().'</p>';
            $content .= '<p>Author :- '.get_metadata('book', get_the_ID(), '_author_name_meta', true);
            $content .= '<br> publisher :- '.get_metadata('book', get_the_ID(), '_publisher_meta', true);
            $content .= '<br> year :- '.get_metadata('book', get_the_ID(), '_year_meta', true);
            $content .= '<br> price :- '.$price.' '.$currSymbol['wp_book_currency'];
            $content .= '<br> URL :- <a href='.get_metadata('book', get_the_ID(), '_url_meta', true).'>'.get_metadata('book', get_the_ID(), '_url_meta', true).'</a>';
            $content .= '</article>';
        }//end while
    } else {
        $content .= "No Book Found....";
    }//end if

    return $content;

}//end wp_book_shortcode()

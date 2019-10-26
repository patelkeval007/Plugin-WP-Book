<?php

function wp_book_cust_widget_init()
{
    register_widget('WP_BOOK_CUST_Widget');
}

class WP_BOOK_CUST_Widget extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'wp_book_cust_widget',
            'description' => 'To display books of selected category.',
            'customize_selective_refresh' => true,
        );
        parent::__construct('wp_book_widget', __('WP Book Widget', 'wp_book_plugin'), $widget_ops);
    }

    // The widget form (for the backend )
    public function form($instance)
    {
        // Set widget defaults
        $defaults = array(
            'title'    => '',
            'text'     => '',
            'select'   => '',
        );
        // Parse current settings with defaults
        extract(wp_parse_args((array) $instance, $defaults)); ?>
        
        <?php // Text Field ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php __('Text:', 'wp_book_plugin'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>" type="text" value="<?php echo esc_attr($text); ?>" />
        </p>

        <?php // Dropdown ?>
        <p>
            <label for="<?php echo $this->get_field_id('select'); ?>"><?php __('Select', 'wp_book_plugin'); ?></label>
            <select name="<?php echo $this->get_field_name('select'); ?>" id="<?php echo $this->get_field_id('select'); ?>" class="widefat">
                <?php 
                        $categories = get_categories();
                        foreach ($categories as $category) {
                            echo '<option value="' . esc_attr($category->name) . '" id="' . esc_attr($category->name) . '" ' . selected($select, $category->name, false) . '>' . $category->name . '</option>';
                        }
                        ?>
            </select>
            </ul>
        </p>
        <?php 
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title']    = isset($new_instance['title']) ? wp_strip_all_tags($new_instance['title']) : '';
        $instance['text']     = isset($new_instance['text']) ? wp_strip_all_tags($new_instance['text']) : '';
        $instance['select']   = isset($new_instance['select']) ? wp_strip_all_tags($new_instance['select']) : '';
        return $instance;
    }

    public function widget($args, $instance)
    {
        extract($args);

        // Check the widget options
        $text     = isset($instance['text']) ? $instance['text'] : '';
        $select   = isset($instance['select']) ? $instance['select'] : '';

        // Display text field
        if ($text) {
            echo $args['before_widget'] . $args['before_title'] . $text . $args['after_title'];
        }
        // Display select field
        $idx = 0;
        if ($select) {
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms'    => $select,
                    ),
                ),
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) { ?>
                <?php
                while ($query->have_posts()) {
                    $query->the_post(); 
                    $idx++;?>
                    <h5><a href="<?php the_permalink(); ?>"><?php echo $idx.'.'.get_the_title(); ?></a></h5>
                <?php
                }
            }
            // Added this now 
            wp_reset_query();
        }
        // WordPress core after_widget hook (always include )
        echo $args['after_widget'];
    }
}

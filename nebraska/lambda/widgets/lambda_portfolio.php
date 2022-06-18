<?php

/**
 * Portfolio Widget
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since framework v 2.1
 */

class WP_Widget_Portfolio extends WP_Widget
{

    function __construct()
    {
        $widget_ops = array('classname' => 'lambda_widget_portfolio', 'description' => __('Displays your latest Portfolio Work!', UT_THEME_NAME));
        parent::__construct('lw_portfolio', __('Lambda - Recent Portfolio', UT_THEME_NAME), $widget_ops);
        $this->alt_option_name = 'lambda_widget_portfolio';
    }

    function form($instance)
    {
        ?>

        <label><?php _e('Title', UT_THEME_NAME); ?>: <input type="text" style="width:100%;"
                                                            id="<?php echo $this->get_field_id('title'); ?>"
                                                            name="<?php echo $this->get_field_name('title'); ?>"
                                                            value="<?php echo esc_attr($instance['title']); ?>"/></label>
        <label><?php _e('Number of Items', UT_THEME_NAME); ?>: <input type="text" style="width:100%;"
                                                                      id="<?php echo $this->get_field_id('number'); ?>"
                                                                      name="<?php echo $this->get_field_name('number'); ?>"
                                                                      value="<?php echo esc_attr($instance['number']); ?>"/></label>

        <?php
    }

    function update($new_instance, $old_instance)
    {
        return $new_instance;
    }

    function widget($args, $instance)
    {
        extract($args);
        extract($instance);

        if ($title)
            $title = $before_title . do_shortcode($title) . $after_title;

        $posts = &get_posts(array('post_type' => UT_PORTFOLIO_SLUG, 'numberposts' => $number, 'orderby' => 'date', 'order' => 'DESC'));
        if ($posts) {
            $count = 0;
            $text = '<ul>';
            foreach ($posts as $post) {

                $text .= '<li>';
                $text .= '<a href="' . get_permalink($post->ID) . '" title="' . get_the_title($post->ID) . '">' . get_the_title($post->ID) . '</a>';
                $text .= '</li>';

                $count++;
            }
            $text .= '</ul>';
        }

        echo "$before_widget
		  $title $text
		  $after_widget";
    }

}

add_action('widgets_init', function() {return register_widget("wp_widget_portfolio");});

?>
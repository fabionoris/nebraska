<?php class WP_Widget_Contact extends WP_Widget
{

    function __construct()
    {
        $widget_ops = array('classname' => 'lambda_widget_contact', 'lambda_widget_contact_description' => __('Insert your contact data in here!', UT_THEME_NAME));
        parent::__construct('lw_contact', __('Lambda - Contact', UT_THEME_NAME), $widget_ops);
        $this->alt_option_name = 'lambda_widget_contact';
    }

    function form($instance)
    {
        $title = (isset($instance['title'])) ? esc_attr($instance['title']) : '';
        $address = (isset($instance['address'])) ? esc_attr($instance['address']) : '';
        $phone = (isset($instance['phone'])) ? esc_attr($instance['phone']) : '';
        $fax = (isset($instance['fax'])) ? esc_attr($instance['fax']) : '';
        $email = (isset($instance['email'])) ? esc_attr($instance['email']) : '';
        $internet = (isset($instance['internet'])) ? esc_attr($instance['internet']) : '';

        ?>

        <label><?php _e('Title', UT_THEME_NAME); ?>: <input type="text" style="width:100%;"
                                                            id="<?php echo $this->get_field_id('title'); ?>"
                                                            name="<?php echo $this->get_field_name('title'); ?>"
                                                            value="<?php echo $title; ?>"/></label>

        <label><?php _e('Address', UT_THEME_NAME); ?>: <textarea class="widefat" rows="16" cols="20"
                                                                 id="<?php echo $this->get_field_id('address'); ?>"
                                                                 name="<?php echo $this->get_field_name('address'); ?>"><?php echo $address; ?></textarea></label>

        <label><?php _e('Phone', UT_THEME_NAME); ?>: <input type="text" style="width:100%;"
                                                            id="<?php echo $this->get_field_id('phone'); ?>"
                                                            name="<?php echo $this->get_field_name('phone'); ?>"
                                                            value="<?php echo $phone; ?>"/></label>

        <label><?php _e('Fax', UT_THEME_NAME); ?>: <input type="text" style="width:100%;"
                                                          id="<?php echo $this->get_field_id('fax'); ?>"
                                                          name="<?php echo $this->get_field_name('fax'); ?>"
                                                          value="<?php echo $fax; ?>"/></label>

        <label><?php _e('Email', UT_THEME_NAME); ?>: <input type="text" style="width:100%;"
                                                            id="<?php echo $this->get_field_id('email'); ?>"
                                                            name="<?php echo $this->get_field_name('email'); ?>"
                                                            value="<?php echo $email; ?>"/></label>

        <label><?php _e('Internet', UT_THEME_NAME); ?>: <input type="text" style="width:100%;"
                                                               id="<?php echo $this->get_field_id('internet'); ?>"
                                                               name="<?php echo $this->get_field_name('internet'); ?>"
                                                               value="<?php echo $internet; ?>"/></label>

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

        $text = (isset($text)) ? do_shortcode($text) : '';
        $text .= '<ul>';

        if (!empty($address)) {
            $text .= '<li class="lambda-address clearfix">';
            $text .= $address . '</li>';
        }

        if (!empty($phone)) {
            $text .= '<li class="lambda-phone clearfix">';
            $text .= $phone . '</li>';
        }

        if (!empty($fax)) {
            $text .= '<li class="lambda-fax clearfix">';
            $text .= $fax . '</li>';
        }

        if (!empty($email)) {
            $text .= '<li class="lambda-email clearfix">';
            $text .= $email . '</li>';
        }

        if (!empty($internet)) {
            $text .= '<li class="lambda-internet clearfix">';
            $text .= $internet . '</li>';
        }

        $text .= '</ul>';

        echo "$before_widget
	    	$title
			$text
		  $after_widget";
    }
}

add_action('widgets_init', function() {return register_widget("wp_widget_contact");});

?>

<?php


#-----------------------------------------------------------------
# Hook for adding admin menus
#-----------------------------------------------------------------
add_action('admin_menu', 'lambda_table_admin_menu');

function lambda_table_admin_menu()
{
    global $theme_path;

    add_submenu_page('option_tree', 'Manage Tables', 'Manage Tables', 'publish_posts', 'view_tables', 'lambda_table_admin_page');
}


#-----------------------------------------------------------------
# Sample Table
#-----------------------------------------------------------------
function lambda_table_item_array()
{
    global $theme_path;

    $default = array(

        'column_1' => array('column_active' => 'on',
            'column_head' => 'Basic',
            'column_content' => array('12 Themes', 'Free Updates', 'Free Support', '30-day Money Back Guarantee!'),
            'column_price' => '39',
            'column_curr' => '$',
            'column_time' => 'month',
            'featured' => 'yes',
            'column_buttontext' => 'Sign up!',
            'column_url' => 'http://www.example.com'),

        'column_2' => array('column_active' => 'on',
            'column_head' => 'Pro',
            'column_content' => array('30 Themes', 'Free Updates', 'Free Support', '30-day Money Back Guarantee!'),
            'column_price' => '49',
            'column_curr' => '$',
            'column_time' => 'month',
            'featured' => 'no',
            'column_buttontext' => 'Sign up!',
            'column_url' => 'http://www.example.com'),

        'column_3' => array('column_active' => 'on',
            'column_head' => 'Premium',
            'column_content' => array('Unlimited Themes', 'Free Updates', 'Free Support', '30-day Money Back Guarantee!'),
            'column_price' => '79',
            'column_curr' => '$',
            'column_time' => 'month',
            'featured' => 'no',
            'column_buttontext' => 'Sign up!',
            'column_url' => 'http://www.example.com'),

        'column_4' => array('column_active' => 'on',
            'column_head' => 'Premium 2',
            'column_content' => array('Unlimited Themes', 'Free Updates', 'Free Support', '30-day Money Back Guarantee!'),
            'column_price' => '99',
            'column_curr' => '$',
            'column_time' => 'month',
            'featured' => 'no',
            'column_buttontext' => 'Sign up!',
            'column_url' => 'http://www.example.com')
    );

    return $default;
}
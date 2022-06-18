<?php

if (!function_exists('lambda_theme_activate')) {
    function lambda_theme_activate()
    {
        global $wpdb;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        //creating the slider manager table on activating the theme
        $table_lambda_sliders = $wpdb->base_prefix . "lambda_sliders";
        if ($wpdb->get_var("show tables like '$table_lambda_sliders'") != $table_lambda_sliders) {
            $sql = "CREATE TABLE " . $table_lambda_sliders . " (
				  id mediumint(9) NOT NULL AUTO_INCREMENT,
				  option_name VARCHAR(255) NOT NULL DEFAULT  'lambda_slider_options',
				  slidertype VARCHAR(255) NOT NULL DEFAULT  'lambda_slider_type',
				  active tinyint(1) NOT NULL DEFAULT  '0',
				  PRIMARY KEY (`id`),
				  UNIQUE ( `option_name` )
			)";
            dbDelta($sql);
        }

        //creating the table manager table on activating the theme
        $table_lambda_tables = $wpdb->base_prefix . "lambda_tables";
        if ($wpdb->get_var("show tables like '$table_lambda_tables'") != $table_lambda_tables) {
            $sql = "CREATE TABLE " . $table_lambda_tables . " (
				  id mediumint(9) NOT NULL AUTO_INCREMENT,
				  table_name VARCHAR(255) NOT NULL DEFAULT  'lambda_table_options',
				  PRIMARY KEY (`id`),
				  UNIQUE ( `table_name` )
			)";
            dbDelta($sql);
        }

        //create a few needed options
        add_option('lambda_media_counter');
        add_option('lambda_version');
        add_option('lambdacopyright');
        add_option('lambdacopyrightlink');

        //insert values for the created options
        update_option('lambda_version', '2.1');
        update_option('lambdacopyright', 'UnitedThemes');
        update_option('lambdacopyrightlink', 'http://www.unitedthemes.com/');
    }

    wp_register_theme_activation_hook(UT_THEME_NAME, 'lambda_theme_activate');
}

/**
 * @desc registers a theme activation hook
 * @param string $code : Code of the theme. This can be the base folder of your theme. Eg if your theme is in folder 'mytheme' then code will be 'mytheme'
 * @param callback $function : Function to call when theme gets activated.
 */
function wp_register_theme_activation_hook($code, $function)
{
    $optionKey = "theme_is_activated_" . $code;
    if (!get_option($optionKey)) {
        call_user_func($function);
        update_option($optionKey, 1);
    }
}

#-----------------------------------------------------------------
# Include the TGM_Plugin_Activation class
#-----------------------------------------------------------------
require_once('plugin-activation.php');

#-----------------------------------------------------------------
# Run plugin requirements
#-----------------------------------------------------------------
add_action('tgmpa_register', 'lambda_register_required_plugins');

function lambda_register_required_plugins()
{
    $plugins = array(
        array(
            'name' => 'Revolution Slider',
            'slug' => 'revslider',
            'source' => get_template_directory_uri() . '/functions/lib/revslider.zip',
            'required' => true,
            'version' => '3.0.95',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => ''
        ),
        array(
            'name' => 'UnitedThemes Twitter',
            'slug' => 'ut-twitter',
            'source' => get_template_directory_uri() . '/functions/lib/ut-twitter.zip',
            'required' => true,
            'version' => '1.2',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => ''
        ),
        array(
            'name' => 'Image Carousel',
            'slug' => 'carousel-without-jetpack',
            'required' => false
        ),
        array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => false
        ),
    );

    $config = array(
        'default_path' => '',                            // Default absolute path to pre-packaged plugins
        'parent_menu_slug' => 'themes.php',                // Default parent menu slug
        'parent_url_slug' => 'themes.php',                // Default parent URL slug
        'menu' => 'install-required-plugins',    // Menu slug
        'has_notices' => true,                        // Show admin notices or not
        'is_automatic' => true,                        // Automatically activate plugins after installation or not
        'message' => '',                            // Message to output right before the plugins table
        'strings' => array(
            'page_title' => __('Install Required Plugins', UT_THEME_INITIAL),
            'menu_title' => __('Install Plugins', UT_THEME_INITIAL),
            'installing' => __('Installing Plugin: %s', UT_THEME_INITIAL), // %1$s = plugin name
            'oops' => __('Something went wrong with the plugin API.', UT_THEME_INITIAL),
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), // %1$s = plugin name(s)
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), // %1$s = plugin name(s)
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), // %1$s = plugin name(s)
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s)
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins'),
            'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins'),
            'return' => __('Return to Required Plugins Installer', UT_THEME_INITIAL),
            'plugin_activated' => __('Plugin activated successfully.', UT_THEME_INITIAL),
            'complete' => __('All plugins installed and activated successfully. %s', UT_THEME_INITIAL), // %1$s = dashboard link
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );
    tgmpa($plugins, $config);
}

#-----------------------------------------------------------------
# Include the plugin update class
#-----------------------------------------------------------------
if (is_admin()) {
    require_once('plugin-update.php');
    $RevsliderPluginUpdateCheck = new PluginUpdateChecker(get_template_directory_uri() . '/functions/lib/revslider.php', 'revslider/revslider.php', 'revslider', 0);
    $RevsliderPluginUpdateCheck = new PluginUpdateChecker(get_template_directory_uri() . '/functions/lib/ut-twitter.php', 'ut-twitter/ut.twitter.php', 'ut-twitter', 0);
}
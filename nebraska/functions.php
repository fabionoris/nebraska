<?php

/**
 * Basic Functions
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since framework v 1.0
 * based on Skeleton theme
 */

global $theme_options, $theme_path, $content_width;

define('UT_THEME_INITIAL', 'nebraska_'); // DO NOT CHANGE THIS VALUE!


#-----------------------------------------------------------------
# Default theme constants & repeating variables - do not change!
#-----------------------------------------------------------------
define('UT_THEME_NAME', 'Nebraska');
define('UT_THEME_VERSION', '1.3.2');
define('UT_LAMBDA_VERSION', get_option('lambda_version'));
define('FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/lambda/');
define('UT_PORTFOLIO_SLUG', 'portfolio'); //This Constant is changeable
define('UT_PORTFOLIO_ITEM', 'project'); //This Constant is changeable


#-----------------------------------------------------------------
# Theme Activation Hook
#-----------------------------------------------------------------
require_once(get_template_directory() . '/functions/theme-activation-hook.php');

$theme_path = get_template_directory_uri();
$theme_options = get_option('option_tree');
$content_width = '940';


#-----------------------------------------------------------------
# Check IE
#-----------------------------------------------------------------
$browser = (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) ? true : false;


#-----------------------------------------------------------------
# Meta Box Management
#-----------------------------------------------------------------
require_once(get_template_directory() . '/lambda/lambda.meta.box.php');
require_once(get_template_directory() . '/lambda/lambda.media.access.php');
require_once(get_template_directory() . '/lambda/lambda.taxonomy.class.php');
require_once(get_template_directory() . '/lambda/lambda.callmetaboxes.php');


#-----------------------------------------------------------------
# Meta Box Access
#-----------------------------------------------------------------
$wpalchemy_media_access = new WPAlchemy_MediaAccess();


#-----------------------------------------------------------------
# Check if Option Tree / Moover Plugin has been already installed,
# if not use our Theme Option Panel
#-----------------------------------------------------------------
if (!function_exists('lambda_is_plugin_active')) {
    function lambda_is_plugin_active($plugin)
    {
        return in_array($plugin, (array)get_option('active_plugins', array()));
    }

    if (!lambda_is_plugin_active('option-tree/index.php') && !lambda_is_plugin_active('option-tree/ot-loader.php')) {
        require_once(get_template_directory() . '/lambda/index.php');
    }

    if (!lambda_is_plugin_active('soundcloud-shortcode/soundcloud-shortcode.php')) {
        require_once(get_template_directory() . '/functions/soundcloud.php');
    }

    if (lambda_is_plugin_active('qtranslate/qtranslate.php')) {
        add_filter('post_type_link', 'qtrans_convertURL');
        require_once(get_template_directory() . '/functions/lambda.qtranslate.php');
    }

    if (!lambda_is_plugin_active('qtranslate/qtranslate.php')) {
        require_once(get_template_directory() . '/functions/lambda.parsecontent.php');
    }
}


#-----------------------------------------------------------------
# Admin Stuff
#-----------------------------------------------------------------
if (is_admin()) {
    require_once('lambda/lambda.admin.functions.php');
}
require_once('lambda/tinymce/lambda.tinymce.class.php');


#-----------------------------------------------------------------
# Needed Functions for Front and Backend
#-----------------------------------------------------------------
require_once(get_stylesheet_directory() . '/functions/theme-portfolio-init.php');
require_once(get_template_directory() . '/functions/aquaresizer.php');

require_once(get_stylesheet_directory() . '/functions/theme-menuwalker.php');
require_once(get_stylesheet_directory() . '/functions/theme-functions.php');
require_once(get_stylesheet_directory() . '/functions/theme-shortcodes.php');
require_once(get_stylesheet_directory() . '/functions/theme-post-formats.php');
require_once(get_stylesheet_directory() . '/functions/theme-slider-shortcodes.php');
require_once(get_stylesheet_directory() . '/functions/pagecreator-functions.php');

require_once(get_template_directory() . '/lambda/lambda.register.widgets.php');
require_once(get_template_directory() . '/lambda/slidermanager/index.php');


#-----------------------------------------------------------------
# Layout and Misc Functions
#-----------------------------------------------------------------
require_once(get_stylesheet_directory() . '/functions/theme-layout-functions.php');
require_once(get_stylesheet_directory() . '/functions/theme-custom-css.php');
require_once(get_stylesheet_directory() . '/functions/theme-java-functions.php');


#-----------------------------------------------------------------
# Register Core Stylesheets and set loading Filters
#-----------------------------------------------------------------
if (!function_exists('lambda_registerstyles')) {

    function lambda_registerstyles()
    {
        $custom_font = get_option('option_tree');

        global $lambda_meta_data, $theme_options;
        $portfoliometa = $lambda_meta_data->the_meta();

        //Main CSS files
        wp_enqueue_style('theme', get_stylesheet_directory_uri() . '/style.css', array(), UT_THEME_VERSION, 'screen, projection');
        wp_enqueue_style('layout', get_template_directory_uri() . '/layout.css', array('theme'), UT_THEME_VERSION, 'screen, projection');

        //Check if responsive is active or not
        if (isset($theme_options['responsive']) && $theme_options['responsive'] == 'on') {
            wp_enqueue_style('responsive', get_template_directory_uri() . '/responsive.css', 'theme', UT_THEME_VERSION, 'screen, projection');
        }

        wp_enqueue_style('superfish', get_template_directory_uri() . '/superfish.css', 'theme', UT_THEME_VERSION, 'screen, projection');
        wp_enqueue_style('prettyphoto', get_template_directory_uri() . '/css/prettyPhoto.css', 'theme', UT_THEME_VERSION, 'screen, projection');
        wp_enqueue_style('nonverblaster', get_template_directory_uri() . '/css/nonverblaster.css', 'theme', UT_THEME_VERSION, 'screen, projection');

        wp_enqueue_style('flexslider', get_template_directory_uri() . '/css/flexslider.css', 'theme', '1.0');

        #-----------------------------------------------------------------
        # Exceptions to reduce script loading
        #-----------------------------------------------------------------
        if (isset($theme_options['headline_font_face_type']) && $theme_options['headline_font_face_type'] == 'headline_font_face_google') {
            wp_enqueue_style('google_font', 'http://fonts.googleapis.com/css?family=' . $custom_font['headline_font_face_google']['font-family'], 'theme', UT_THEME_VERSION);
        }

        if (lambda_is_plugin_active('woocommerce/woocommerce.php')) {
            wp_enqueue_style('woocommerce', get_template_directory_uri() . '/css/woocommerce.css', 'theme', UT_THEME_VERSION, 'screen, projection');
        }
    }

    add_action('get_header', 'lambda_registerstyles');
}


#-----------------------------------------------------------------
# Footer Scripts
#-----------------------------------------------------------------
if (!function_exists('lambda_header_scripts')) {

    function lambda_header_scripts()
    {
        global $theme_options, $lambda_meta_data;

        $portfoliometa = $lambda_meta_data->the_meta();

        if (!is_admin()) {

            $javascripts = wp_enqueue_script('jquery');

            //Core scripts
            wp_enqueue_script('superfish', get_template_directory_uri() . "/javascripts/superfish.js", array('jquery'), '1.2.3', true);
            wp_enqueue_script('carousellite', get_template_directory_uri() . "/javascripts/jquery.jcarousellite.js", array('jquery'), '1.3', true);
            wp_enqueue_script('fitvid', get_template_directory_uri() . "/javascripts/jquery.fitvids.js", array('jquery'), '1.3', true);

            //Only for portfolio
            wp_enqueue_script('isotope', get_template_directory_uri() . "/javascripts/jquery.isotope.min.js", array('jquery'), '1.5.09', true);
            wp_enqueue_script('formalize', get_template_directory_uri() . "/javascripts/jquery.formalize.min.js", array('jquery'), '1.2.3', true);

            //Only when player is available
            wp_enqueue_script('nonverbla', get_template_directory_uri() . "/javascripts/nonverblaster.js", array('jquery'), '1.0', true);

            /* Shockwave Flash Disabled */
            //wp_enqueue_script('swfobject');

            //Custom Javascript
            wp_enqueue_script('custom', get_template_directory_uri() . "/javascripts/app.js", array('jquery'), '1.2.3', true);

            //Flexslider Gallery
            wp_enqueue_script('flexslider', get_template_directory_uri() . "/javascripts/jquery.flexslider.min.js", array('jquery'), '1.8', true);

            //Special scripts for widgets
            if (is_active_widget(false, false, 'lw_twitter', true)) {
                wp_enqueue_script('twitter', get_template_directory_uri() . "/javascripts/jquery.tweet.js", array('jquery'), '1.0', true);
            }

            //PrettyPhoto load if it has been enabled inside the theme options panels
            if (isset($theme_options['activate_prettyphoto']) && $theme_options['activate_prettyphoto'] == 'on') {
                wp_enqueue_script('prettyphoto', get_template_directory_uri() . "/javascripts/jquery.prettyPhoto.js", array('jquery'), '1.3', true);
            }
        }
    }

    add_action('wp_enqueue_scripts', 'lambda_header_scripts');
}


#-----------------------------------------------------------------
# Load Lambda Setup
#-----------------------------------------------------------------
add_action('after_setup_theme', 'lambda_setup');

if (!function_exists('lambda_setup')):

    function lambda_setup()
    {
        #-----------------------------------------------------------------
        # Post Formats
        #-----------------------------------------------------------------
        $pformats = array(
            'audio',
            'gallery',
            'link',
            'quote',
            'video');

        add_theme_support('post-formats', $pformats);

        #-----------------------------------------------------------------
        # Activate Post Thumbnails & Set Image Sizes
        #-----------------------------------------------------------------
        add_theme_support('post-thumbnails');
        add_image_size('1col-image', '940', '', true);
        add_image_size('2col-image', '460', '230', true);
        add_image_size('3col-image', '420', '300', true);
        add_image_size('4col-image', '420', '300', true);

        #-----------------------------------------------------------------
        # Add default posts and comments RSS feed links to head
        #-----------------------------------------------------------------
        add_theme_support('automatic-feed-links');

        #-----------------------------------------------------------------
        # Make theme available for translation
        #-----------------------------------------------------------------
        load_theme_textdomain(UT_THEME_NAME, get_template_directory() . '/languages');

        $locale = get_locale();
        $locale_file = get_template_directory() . "/languages/$locale.php";
        if (is_readable($locale_file))
            require_once($locale_file);

        // No support for text inside the header image.
        if (!defined('NO_HEADER_TEXT'))
            define('NO_HEADER_TEXT', true);

        if (!defined('HEADER_IMAGE_WIDTH'))
            define('HEADER_IMAGE_WIDTH', apply_filters('lambda_header_image_width', 960));


        if (!defined('HEADER_IMAGE_HEIGHT'))
            define('HEADER_IMAGE_HEIGHT', apply_filters('lambda_header_image_height', 185));
    }
endif;


#-----------------------------------------------------------------
# Register widgetized areas, including two sidebars and four widget-ready
# columns in the footer and all created Sidebars in Admin Panel
#-----------------------------------------------------------------
if (!function_exists('st_widgets_init')) {

    function st_widgets_init()
    {
        // The Default Sidebar
        register_sidebar(array(
            'name' => __('Main Sidebar', UT_THEME_NAME),
            'id' => UT_THEME_INITIAL . 'sidebar_default',
            'description' => __('The Default Sidebar', UT_THEME_NAME),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));

        // Register Custom Sidebars
        if (function_exists('get_option_tree')) {
            $sidebars = get_option_tree('sidebars', '', false, true, -1);
            if (!empty($sidebars) && is_array($sidebars)) {
                $i = 1;
                foreach ($sidebars as $num => $sidebar_options) {
                    register_sidebar(array(
                        'name' => $sidebar_options['title'],
                        'id' => UT_THEME_INITIAL . 'sidebar_' . $num,
                        'description' => $sidebar_options['sidebardesc'],
                        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
                        'after_widget' => '</li>',
                        'before_title' => '<h3 class="widget-title"><span>',
                        'after_title' => '</span></h3>',
                    ));
                    $i++;
                }
            }
        }
        // Area 3, located in the footer. Empty by default.
        register_sidebar(array(
            'name' => __('First Footer Widget Area', UT_THEME_NAME),
            'id' => 'first-footer-widget-area',
            'description' => __('The first footer widget area', UT_THEME_NAME),
            'before_widget' => '<div class="%1$s %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));

        // Area 4, located in the footer. Empty by default.
        register_sidebar(array(
            'name' => __('Second Footer Widget Area', UT_THEME_NAME),
            'id' => 'second-footer-widget-area',
            'description' => __('The second footer widget area', UT_THEME_NAME),
            'before_widget' => '<div class="%1$s %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));

        // Area 5, located in the footer. Empty by default.
        register_sidebar(array(
            'name' => __('Third Footer Widget Area', UT_THEME_NAME),
            'id' => 'third-footer-widget-area',
            'description' => __('The third footer widget area', UT_THEME_NAME),
            'before_widget' => '<div class="%1$s %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));

        // Area 6, located in the footer. Empty by default.
        register_sidebar(array(
            'name' => __('Fourth Footer Widget Area', UT_THEME_NAME),
            'id' => 'fourth-footer-widget-area',
            'description' => __('The fourth footer widget area', UT_THEME_NAME),
            'before_widget' => '<div class="%1$s %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));

    }

    /** Register sidebars by running lambda_widgets_init() on the widgets_init hook. */
    add_action('widgets_init', 'st_widgets_init');
}



#-----------------------------------------------------------------
# Prints HTML with meta information for the current
# post-date/time and author.
#-----------------------------------------------------------------
if (!function_exists('lambda_posted_on')) :
    function lambda_posted_on()
    {
        return sprintf(__('%2$s', UT_THEME_NAME),
            'meta-prep meta-prep-author',
            sprintf('<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                get_permalink(),
                esc_attr(get_the_time()),
                get_the_date()
            ),
            sprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
                get_author_posts_url(get_the_author_meta('ID')),
                sprintf(esc_attr__('View all posts by %s', UT_THEME_NAME), get_the_author()),
                get_the_author()
            )
        );
    }
endif;


#-----------------------------------------------------------------
# Prints HTML with meta information for the current post
# (category, tags and permalink).
#-----------------------------------------------------------------
if (!function_exists('lambda_posted_in')) :
    function lambda_posted_in()
    {
        // Retrieves tag list of current post, separated by commas.
        $tag_list = get_the_tag_list('', ', ');
        if ($tag_list) {
            $posted_in = __('This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', UT_THEME_NAME);
        } elseif (is_object_in_taxonomy(get_post_type(), 'category')) {
            $posted_in = __('This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', UT_THEME_NAME);
        } else {
            $posted_in = __('Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', UT_THEME_NAME);
        }
        // Prints the string, replacing the placeholders.
        printf(
            $posted_in,
            get_the_category_list(', '),
            $tag_list,
            get_permalink(),
            the_title_attribute('echo=0')
        );
    }
endif;


#-----------------------------------------------------------------
# Enable Shortcodes in excerpts and widgets
#-----------------------------------------------------------------
add_filter('widget_text', 'do_shortcode');
add_filter('the_excerpt', 'do_shortcode');
add_filter('get_the_excerpt', 'do_shortcode');


#-----------------------------------------------------------------
# Override default filter for 'textarea' sanitization
#-----------------------------------------------------------------
add_action('admin_init', 'optionscheck_change_santiziation', 100);

function optionscheck_change_santiziation()
{
    remove_filter('of_sanitize_textarea', 'of_sanitize_textarea');
    add_filter('of_sanitize_textarea', 'st_custom_sanitize_textarea');
}

function st_custom_sanitize_textarea($input)
{
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
        "src" => array(),
        "type" => array(),
        "allowfullscreen" => array(),
        "allowscriptaccess" => array(),
        "height" => array(),
        "width" => array()
    );
    $custom_allowedtags["script"] = array();
    $custom_allowedtags["a"] = array('href' => array(), 'title' => array());
    $custom_allowedtags["img"] = array('src' => array(), 'title' => array(), 'alt' => array());
    $custom_allowedtags["br"] = array();
    $custom_allowedtags["em"] = array();
    $custom_allowedtags["strong"] = array();
    $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
    $output = wp_kses($input, $custom_allowedtags);
    return $output;
}


#-----------------------------------------------------------------
# Woo Commerce Integration
#-----------------------------------------------------------------
if (lambda_is_plugin_active('woocommerce/woocommerce.php')) {

    require_once(get_template_directory() . '/functions/theme-woocommerce-support.php');

    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

    add_action('woocommerce_before_main_content', 'lambda_woo_before_content', 10);
    add_action('woocommerce_after_main_content', 'lambda_woo_after_content', 10);

    define('WOOCOMMERCE_USE_CSS', false);

}

add_filter('postmeta_form_limit', 'customfield_limit_increase');

function customfield_limit_increase($limit)
{
    $limit = 100;
    return $limit;
}
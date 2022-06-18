<?php

#-----------------------------------------------------------------
# Load scripts UI base
#-----------------------------------------------------------------
function load_lambda_jquery_ui_core()
{
    wp_enqueue_script('jquery-ui');
    wp_enqueue_script('jquery-ui-widget');
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('jquery-ui-selectable');
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('jquery-ui-dialog');
}

#-----------------------------------------------------------------
# Load scripts for meta panel only when needed
#-----------------------------------------------------------------
function load_lambda_meta_panel_scripts()
{
    wp_register_script('bootstrap', FRAMEWORK_DIRECTORY . 'assets/js/bootstrap.js', array('jquery'), '2.0.3', true);
    wp_enqueue_script('bootstrap');

    wp_register_script('ut-meta', FRAMEWORK_DIRECTORY . 'assets/js/lambda.meta.js', array('jquery'), '2.0', true);
    wp_enqueue_script('ut-meta');

    wp_enqueue_script('jquery-color-picker', OT_PLUGIN_URL . '/assets/js/jquery.color.picker.js', array('jquery'), '1.0', true);
}

#-----------------------------------------------------------------
# Dynamic admin CSS
#-----------------------------------------------------------------
function lambda_theme_related_admin_css()
{
    echo '<style type="text/css">
		
		#' . UT_THEME_INITIAL . 'slider_metabox {
			display:none !important;
		}
		
		#' . UT_THEME_INITIAL . 'metapanel_metabox .handlediv,
		#' . UT_THEME_INITIAL . 'metapanel_metabox .hndle {
			display:none !important;
		}
			
	</style>';
}

#-----------------------------------------------------------------
# Load page creator tool tiny mce
#-----------------------------------------------------------------
function lambda_pttiny_init()
{
    wp_register_script('pagetoolmce', FRAMEWORK_DIRECTORY . 'assets/js/lambda.pttiny.js', array('jquery'));
    add_action('after_wp_tiny_mce', 'lambda_pttiny_scripts', 999);
}

function lambda_pttiny_scripts()
{
    wp_print_scripts('pagetoolmce');
}

#-----------------------------------------------------------------
# Meta panel CSS
#-----------------------------------------------------------------
function load_lambda_meta_panel_styles()
{
    wp_enqueue_style('ut-metabox', FRAMEWORK_DIRECTORY . 'assets/css/lambda.ui.css');
    wp_enqueue_style('ut-metabox', FRAMEWORK_DIRECTORY . 'assets/css/colorpicker.css');
    wp_enqueue_style('ut-uiselect', FRAMEWORK_DIRECTORY . 'assets/css/lambdamod/jquery.ui.selectmenu.css');
}

#-----------------------------------------------------------------
# Return installed sidebars
#-----------------------------------------------------------------
function get_sidebars_array()
{
    $sidebars = (get_option_tree('sidebars', '', false, true, -1));
    $_sidebars = array('default' => __('Default Sidebar', UT_THEME_NAME), 'none' => __('No Sidebar', UT_THEME_NAME));

    if (is_array($sidebars)) {
        foreach ($sidebars as $num => $sidebar) {
            $_sidebars[$num] = $sidebar['title'];
        }
        return $_sidebars;
    }
}

#-----------------------------------------------------------------
# Highlight custom widgets
#-----------------------------------------------------------------
function ut_custom_widget_style()
{
    echo '<style type="text/css">
			div.widget[id*="_lw_recent-comments"] .widget-title,
			div.widget[id*="_lw_recent-post"] .widget-title,
			div.widget[id*="_lw_portfolio"] .widget-title,
			div.widget[id*="_lw_contact"] .widget-title,
			div.widget[id*="_lw_twitter"] .widget-title,
			div.widget[id*="_lw_mostlikesposts"] .widget-title,
			div.widget[id*="_lw_flickr"] .widget-title,
			div.widget[id*="_lw_social"] .widget-title,
			div.widget[id*="_lw_video"] .widget-title {
    			color: #2191bf !important;
			}
		</style>';
}

#-----------------------------------------------------------------
# Move Meta Panel
#-----------------------------------------------------------------
function lambda_meta_panel_move()
{
    ?>
    <script type="text/javascript">
        jQuery('#nebraska_metapanel_metabox').insertBefore('#postdivrich');
    </script>
    <?php
}

#-----------------------------------------------------------------
# Custom mimes
#-----------------------------------------------------------------
function lambda_extended_mime_types($existing_mimes = array())
{
    $existing_mimes['extension'] = 'mime/type';
    $existing_mimes['eot'] = 'fontface';
    $existing_mimes['ttf'] = 'fontface';
    $existing_mimes['svg'] = 'fontface';
    $existing_mimes['woff'] = 'fontface';
    return $existing_mimes;
}


#-----------------------------------------------------------------
# Gallery Types
#-----------------------------------------------------------------
function lambda_gallery_types($types)
{
    $types['rectangular'] = __('Tiles', UT_THEME_INITIAL);
    $types['slideshow'] = __('Slideshow', UT_THEME_INITIAL);
    return $types;
}

#-----------------------------------------------------------------
# Admin init
#-----------------------------------------------------------------
function adminInit()
{
    add_filter('upload_mimes', 'lambda_extended_mime_types');

    add_action('admin_head-post.php', 'lambda_theme_related_admin_css');
    add_action('admin_head-post-new.php', 'lambda_theme_related_admin_css');
    add_action('admin_print_styles-widgets.php', 'ut_custom_widget_style');

    /* Meta Panel */
    add_action('admin_print_styles-post.php', 'load_lambda_meta_panel_styles');
    add_action('admin_print_styles-post-new.php', 'load_lambda_meta_panel_styles');

    add_action('admin_print_scripts-post.php', 'load_lambda_meta_panel_scripts');
    add_action('admin_print_scripts-post-new.php', 'load_lambda_meta_panel_scripts');

    add_action('admin_footer', 'lambda_meta_panel_move');
}

#-----------------------------------------------------------------
# Add Action for Admin Init
#-----------------------------------------------------------------
if (is_admin()) {
    add_action('admin_menu', 'adminInit');
    add_action('admin_enqueue_scripts', 'load_lambda_jquery_ui_core');
}

?>
<?php

/**
 * The Header for our theme.
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
 *
 * Author: Marcel Moerkens
 * Author: Matthew Nettekoven
 */

global $lambda_meta_data, $theme_options, $slider_meta_data;

?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>

    <title>
        <?php
        // Detect Yoast SEO Plugin
        if (defined('WPSEO_VERSION')) {
            wp_title('');
        } else {
            /*
             * Print the <title> tag based on what is being viewed.
             */
            global $page, $paged;

            wp_title('|', true, 'right');

            // Add the blog name.
            bloginfo('name');

            // Add the blog description for the home/front page.
            $site_description = get_bloginfo('description', 'display');
            if ($site_description && (is_home() || is_front_page()))
                echo " | $site_description";

            // Add a page number if necessary:
            if ($paged >= 2 || $page >= 2)
                echo ' | ' . sprintf(__('Page %s', UT_THEME_NAME), max($paged, $page));
        }
        ?>
    </title>


    <!--[if lte IE 8]>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" media="screen" />
    <![endif]-->

    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--[if IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <!--[if gte IE 9]>
    <style type="text/css">
        .gradient {
            filter: none;
        }
    </style>
    <![endif]-->


    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="<?php echo get_option_tree('favicon'); ?>">

    <link rel="apple-touch-icon" href="<?php echo get_option_tree('apple_touch_icon_small'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_option_tree('apple_touch_icon_mid'); ?>"/>
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_option_tree('apple_touch_icon'); ?>"/>

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>

    <?php

    // Enqueue threaded comments support.
    if (is_singular() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');

    wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<!-- to top button -->
<div id="toTop">Go to Top</div>
<!-- /to top button -->

<?php $custom_wrap = get_option_tree('sitelayout');
$wrapclass = (isset($custom_wrap) && $custom_wrap == 'boxed') ? ' boxed' : ' fullwidth'; ?>

<div id="wrap" class="clearfix<?php echo $wrapclass; ?>" data-role="page">

    <header id="header"
            class="fluid<?php echo (isset($header_settings['sliderstyle_type']) && !empty($header_settings['sliderstyle_type'])) ? '' : 'header-border'; ?>"
            data-role="header"><!-- header -->
        <div class="container">

            <?php
            #-----------------------------------------------------------------
            # Plugin Notification
            #-----------------------------------------------------------------
            if (lambda_is_plugin_active('option-tree/index.php') || lambda_is_plugin_active('option-tree/ot-loader.php')) {
                echo '<div class="alert red">' . __('Option Tree Plugin has been detected! Please deactivate this Plugin to prevent themecrashes and failures!', UT_THEME_NAME) . '</div>';
            }
            if (lambda_is_plugin_active('soundcloud-shortcode/soundcloud-shortcode.php')) {
                echo '<div class="alert red">' . __('Soundcloud Plugin has been detected! Please deactivate this Plugin to prevent themecrashes and failures!', UT_THEME_NAME) . '</div>';
            }

            ?>

            <div class="sixteen columns clearfix">

                <?php
                // Build the logo or text
                if (get_option_tree('textorlogo') == 'Logo') {

                    $lambda_logo = '<div id="logo">			
								<div class="top-header"><span class="top-tagline">' . get_bloginfo('description') . '</span></div> 
								<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name', 'display')) . '"><img id="sitelogo" src="' . get_option_tree('header_logo') . '"></a>
							</div>';
                } else {
                    $lambda_logo = '<div id="logo">			
								<div class="top-header">
									<span class="top-tagline">
										' . get_bloginfo('description') . '
									</span>
								</div>
								<h1>	 
									<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name', 'display')) . '">' . get_bloginfo('name') . '</a>
								</h1>
							</div>';
                }
                echo apply_filters('child_logo', $lambda_logo);
                ?>

                <div class="lambda-header-widget clearfix">

                    <div class="top-header">
                        <?php

                        if (isset($theme_options['top_phonenumber']) && !empty($theme_options['top_phonenumber'])) echo '<span class="header-phone">' . $theme_options['top_phonenumber'] . '</span>';
                        if (isset($theme_options['top_email']) && !empty($theme_options['top_email'])) echo '<span class="header-email">' . $theme_options['top_email'] . '</span>';

                        ?>
                    </div>

                    <?php if (isset($theme_options['social_links']) && is_array($theme_options['social_links'])) {

                        echo '<ul class="lambda-sociallinks clearfix">';

                        $target = (isset($theme_options['new_browser_tab']) && $theme_options['new_browser_tab'] == 'yes') ? 'target="_blank"' : '';

                        foreach ($theme_options['social_links'] as $social => $link) {

                            if (isset($link) && !empty($link))
                                echo '<li><a href="' . $link . '" class="' . $social . '" title="' . ucfirst($social) . '" ' . $target . '>' . ucfirst($social) . '</a></li>';

                        }

                        echo '</ul>';

                    } ?>

                </div>


            </div>
        </div>
    </header><!-- /header -->

    <div class="clear"></div>

    <div class="nav-wrap clearfix"><!-- nav wrap -->
        <div class="container">
            <div class="sixteen columns clearfix">

                <?php
                //Navigation

                //Main navigation
                wp_nav_menu(array('container' => 'nav',
                        'container_id' => 'navigation',
                        'theme_location' => 'primary-menu',
                        'fallback_cb' => 'default_menu',
                        'menu_class' => 'menu clearfix',
                        'container_class' => 'clearfix',
                        'walker' => new lambda_description_walker())
                );
                ?>

                <?php if (has_nav_menu('mobile-menu')) {

                    echo '<div class="mm-trigger">' . get_bloginfo('name') . '<button class="mm-button"></button></div>';

                    wp_nav_menu(array('theme_location' => 'mobile-menu',
                        'container_id' => 'mobile-menu',
                        'container' => 'nav',
                        'menu_class' => 'mm-menu clearfix',
                        'depth' => 1));

                } ?>

                <?php lambda_header_searchform(); ?>

            </div>
        </div>
    </div><!-- /nav-wrap -->
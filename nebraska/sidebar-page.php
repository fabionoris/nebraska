<?php

/**
 * The Sidebar
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
 */

global $lambda_meta_data;

if (is_home()) {

    $homeid = get_option('page_for_posts');
    $sidebar = get_post_meta($homeid, $lambda_meta_data->get_the_id(), TRUE);

} else {

    $sidebar = $lambda_meta_data->the_meta();

}

do_action('st_before_sidebar');

echo '<ul class="sidebar">';

if (!isset($sidebar['sidebar']) || (isset($sidebar['sidebar']) && $sidebar['sidebar'] == UT_THEME_INITIAL . "sidebar_default")) {

    dynamic_sidebar(get_option_tree('select_sidebar'));

} elseif (isset($sidebar['sidebar'])) {

    dynamic_sidebar($sidebar['sidebar']);

}

echo '</ul>';

do_action('st_after_sidebar');
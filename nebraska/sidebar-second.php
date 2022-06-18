<?php

/**
 * The Sidebar containing the primary blog sidebar
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

do_action('st_before_sidebar_second');

echo '<ul class="sidebar">';

if (!isset($sidebar['sidebar_second']) || (isset($sidebar['sidebar_second']) && $sidebar['sidebar_second'] == UT_THEME_INITIAL . "sidebar_default")) {

    dynamic_sidebar(get_option_tree('select_sidebar_second'));

} elseif (isset($sidebar['sidebar_second'])) {

    dynamic_sidebar($sidebar['sidebar_second']);

}

echo '</ul>';

do_action('st_after_sidebar_second');
<?php

/**
 * The template for displaying Tag Archive pages.
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 */

//Includes the header.php
get_header();

//Includes the template-part-slider.php
get_template_part('template-part', 'slider');

//Includes the template-part-teaser.php
get_template_part('template-part', 'teaser');

lambda_before_content($columns = '');

?>

    <p class="tag-title"><?php printf(__('Tag Archives: %s', UT_THEME_NAME), '<span class="themecolor">' . single_tag_title('', false) . '</span>'); ?></p>

<?php

//The content loop
get_template_part('loop', 'tag');

//Content closer - this function can be found in functions/theme-layout-functions.php line 56-61
lambda_after_content();

//Include the sidebar-page.php
get_sidebar('page');

//Includes the footer.php
get_footer();

?>
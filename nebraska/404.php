<?php

/**
 * The template for displaying 404 pages (Not Found).
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

    <p>
        <?php _e('Apologies, but the page you requested could not be found. Perhaps searching will help.', UT_THEME_NAME); ?>
    </p>
    <div class="row">
        <?php get_search_form(); ?>
    </div>
    <script type="text/javascript">
        //Focus on search field after it has loaded
        document.getElementById('s') && document.getElementById('s').focus();
    </script>

<?php

//Content closer - this function can be found in functions/theme-layout-functions.php line 56-61
lambda_after_content();

//Include the sidebar-page.php
get_sidebar();

//Includes the footer.php
get_footer();

?>
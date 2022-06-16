<?php

/**
 * Template Name: Archive
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
 */

global $lambda_meta_data;

$meta_sidebar = get_post_meta(get_the_ID(), $lambda_meta_data->get_the_id(), TRUE);
$meta_sidebar = (!empty($meta_sidebar['sidebar'])) ? $meta_sidebar['sidebar'] : get_option_tree('select_sidebar');

//Includes the header.php
get_header();

//Includes the template-part-slider.php
get_template_part('template-part', 'slider');

//Includes the template-part-teaser.php
get_template_part('template-part', 'teaser');

//Set column layout depending if user wants to display a sidebar
if ($meta_sidebar != UT_THEME_INITIAL . 'sidebar_none') {

    lambda_before_content($columns = '');

} elseif ($meta_sidebar == UT_THEME_INITIAL . 'sidebar_none') {

    lambda_before_content($columns = 'sixteen');

}

?>

<?php if (have_posts()) while (have_posts()) : the_post(); ?>

    <section>
        <article>
            <?php the_content(); ?>
        </article>
    </section>

<?php endwhile; // end of the loop. ?>

<section class="one_third">
    <article>
        <ul class="archive">

            <h3 class="archiv-title"><?php _e('Last 30 Posts', UT_THEME_NAME) ?></h3>
            <ul>
                <?php
                $archive = get_posts('numberposts=30');
                foreach ($archive as $post) : ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </ul>
    </article>
</section>

<section class="one_third">
    <article>
        <ul class="archive">

            <h3 class="archiv-title"><?php _e('Archives by Subject:', UT_THEME_NAME) ?></h3>
            <ul>
                <?php wp_list_categories('title_li='); ?>
            </ul>

        </ul>
    </article>
</section>

<section class="one_third last">
    <article>
        <ul class="archive">

            <h3 class="archiv-title"><?php _e('Archives by Month:', UT_THEME_NAME) ?></h3>

            <ul>
                <?php wp_get_archives('type=monthly'); ?>
            </ul>

        </ul>
    </article>
</section>

<?php

//Content closer - this function can be found in functions/theme-layout-functions.php line 56-61
lambda_after_content();

//Include the sidebar.php
if (empty($columns))
    get_sidebar();

//Includes the footer.php
get_footer();

?>
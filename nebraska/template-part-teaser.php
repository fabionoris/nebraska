<?php

/**
 * Template Part for Teaser
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 2.0
 */

#-----------------------------------------------------------------
# Conditional Tags for displaying Site Titles and Teaser
#-----------------------------------------------------------------
global $lambda_meta_data, $slider_meta_data;

if (is_home()) {

    $homeid = get_option('page_for_posts');
    $featuredheader = get_post_meta($homeid, $slider_meta_data->get_the_id(), TRUE);

} else {

    $featuredheader = $slider_meta_data->the_meta();

}

$meta_data = $lambda_meta_data->the_meta();

$title = "";
$searchteaser = "";

if (get_option_tree('blog_title') && is_home()) {
    //Set Title
    $title = (isset($featuredheader['teaser_text']) && !empty($featuredheader['teaser_text'])) ? $featuredheader['teaser_text'] : get_option_tree('blog_title');

} elseif (is_page() || is_single()) {

    $title = (isset($featuredheader['teaser_text']) && !empty($featuredheader['teaser_text'])) ? $featuredheader['teaser_text'] : get_the_title();

} elseif (is_404()) {
    //Set Title
    $title = __('404 Error', UT_THEME_NAME);


} else { // For all other especially Archives

    if (is_day()) :
        $title = sprintf(__('%s', UT_THEME_NAME), get_the_date());

    elseif (is_month()) :
        $title = sprintf(__('%s', UT_THEME_NAME), get_the_date('F Y'));

    elseif (is_year()) :
        $title = sprintf(__('%s', UT_THEME_NAME), get_the_date('Y'));

    elseif (is_category()) :
        $title = sprintf(__('%s', UT_THEME_NAME), single_cat_title('', false));

    elseif (is_search() && !have_posts()) :

        $title = __('Nothing Found', UT_THEME_NAME);
        $searchteaser = __('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', UT_THEME_NAME);

    elseif (is_search()) :

        $title = __('Search Results', UT_THEME_NAME);
        $searchteaser = sprintf('%s', '' . get_search_query() . '');

    elseif (!is_page() && (!is_home() && !is_front_page())) :

        $title = __('Archives', UT_THEME_NAME);

    endif;
}

#-----------------------------------------------------------------
# Start Output
#----------------------------------------------------------------- ?>

<?php

$hideteaser = (isset($featuredheader['hide_teaser'])) ? $featuredheader['hide_teaser'] : 'teaseron';

if (is_search()) {
    $hideteaser = 'teaseron';
}

?>

<div class="clear"></div>

<section id="teaser"
         class="fluid clearfix" <?php echo ($hideteaser != 'teaseroff') ? '' : 'style="display:none !important;"'; ?>>

    <div class="container">

        <?php if (!is_singular(UT_PORTFOLIO_SLUG)) { ?>

            <div id="teaser-content" class="sixteen columns">

                <h1 id="page-title">
                    <span><?php echo $title; ?></span>
                </h1>

                <?php echo (isset($featuredheader['teaser_content'])) ? '<p class="teaser-text">' . $featuredheader['teaser_content'] . '</p>' : ''; ?>
                <?php echo (isset($searchteaser) && !empty($searchteaser)) ? '<p class="teaser-text">' . $searchteaser . '</p>' : ''; ?>

            </div><!-- /#teaser-content -->

        <?php } else { ?>

            <div id="teaser-content-portfolio-single" class="sixteen columns">

                <div class="eleven columns alpha">
                    <h1 id="page-title">
                        <span><?php echo $title; ?></span>
                    </h1>
                </div>

                <div id="nav-portfolio" class="five columns omega navigation clearfix">

                    <?php $args = array(
                        'sort_order' => 'ASC',
                        'sort_column' => 'post_date',
                        'post_type' => UT_PORTFOLIO_SLUG,
                        'post_status' => 'publish'
                    );

                    $portfolio_first_item = '';
                    $portfolio_last_item = '';

                    $pages = get_pages($args);
                    if (is_array($pages)) {

                        foreach ($pages as $pageID => $singlepage) {

                            if ($pageID == "0")
                                $portfolio_first_item = get_permalink($singlepage->ID);

                            if ($pageID == count($pages) - 1)
                                $portfolio_last_item = get_permalink($singlepage->ID);
                        }

                    } ?>

                    <div class="nav-next"><?php next_post_link('%link', _x('Next', UT_THEME_NAME)); ?></div>
                    <?php if (!get_adjacent_post(false, '', false)) {
                        echo '<div class="nav-next"><a href="' . $portfolio_first_item . '" >' . __('Next', UT_THEME_INITIAL) . '</a></div>';
                    } ?>

                    <div class="nav-previous"><?php previous_post_link('%link', _x('Previous', UT_THEME_NAME)); ?></div>
                    <?php if (!get_adjacent_post(false, '', true)) {
                        echo '<div class="nav-previous"><a href="' . $portfolio_last_item . '" >' . __('Previous', UT_THEME_INITIAL) . '</a></div>';
                    } ?>

                </div><!-- #nav-portfolio -->


            </div><!-- /#teaser-content -->

        <?php } ?>

    </div>

</section><!-- /#teaser -->

<div class="clear"></div>
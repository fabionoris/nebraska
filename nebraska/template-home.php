<?php

/**
 * Template Name: Home Template
 *
 * lambda framework v 1.0
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 */

global $lambda_meta_data, $theme_options;
$metadata = $lambda_meta_data->the_meta();

//Includes the header.php
get_header();

//Includes the template-part-slider.php
get_template_part('template-part', 'slider');

//Includes the template-part-teaser.php
get_template_part('template-part', 'teaser');

//Content opener - this function can be found in functions/theme-layout-functions.php line 5-50
lambda_before_content($columns = 'sixteen'); ?>

<?php if (post_password_required($post)) { ?>

    <?php if (have_posts()) while (have_posts()) : the_post(); ?>

        <section>
            <article>
                <?php the_content(); ?>
            </article>
        </section>

    <?php endwhile; // end of the loop. ?>

<?php } else { ?>

    <div id="home-template">

        <?php
        #-----------------------------------------------------------------
        # Service Boxes
        #-----------------------------------------------------------------
        if (!function_exists('home_service_boxes')) {
            function home_service_boxes($count, $lastborder = false)
            {

                global $lambda_meta_data, $theme_options;
                $metadata = $lambda_meta_data->the_meta();

                if (isset($metadata['activate_service_boxes']) && $metadata['activate_service_boxes'] == 'on') {

                    $col1 = (isset($metadata['activate_col_1']) && $metadata['activate_col_1'] == 'on' ? '1' : false);
                    $col2 = (isset($metadata['activate_col_2']) && $metadata['activate_col_2'] == 'on' ? '1' : false);
                    $col3 = (isset($metadata['activate_col_3']) && $metadata['activate_col_3'] == 'on' ? '1' : false);
                    $col4 = (isset($metadata['activate_col_4']) && $metadata['activate_col_4'] == 'on' ? '1' : false);

                    $servicecolumns = $col1 + $col2 + $col3 + $col4;
                    $colcounter = NULL;

                    // default grid value
                    $servicegrid = "one_fourth";

                    // if only one
                    if ($servicecolumns == "1") {

                        $servicegrid = "sixteen columns alpha omega row";

                        // if two, split in half
                    } elseif ($servicecolumns == "2") {

                        $servicegrid = "one_half";

                        // if three, divide in thirds
                    } elseif ($servicecolumns == "3") {

                        $servicegrid = "one_third";

                        // if four, split in fourths
                    } elseif ($servicecolumns == "4") {

                        $servicegrid = "one_fourth";

                    } ?>

                    <section class="service-columns clearfix<?php echo ($count == 1) ? ' padding-top' : '';
                    echo ($lastborder) ? ' last-border' : ''; ?>">

                        <?php if (isset($metadata['service_headline']) && !empty($metadata['service_headline'])) : ?>

                            <div class="title-wrap clearfix">

                                <h3 class="home-title">
                                    <span><?php echo lambda_translate_meta($metadata['service_headline']); ?></span>
                                </h3>

                            </div>

                        <?php endif; ?>

                        <?php if ($col1) {
                            $colcounter++;
                            $last = ($colcounter == $servicecolumns) ? ' last' : '';

                            render_service_box($metadata, $servicegrid, $last, true, 1);

                        } ?>

                        <?php if ($col2) {
                            $colcounter++;
                            $last = ($colcounter == $servicecolumns) ? ' last' : '';

                            render_service_box($metadata, $servicegrid, $last, true, 2);

                        } ?>

                        <?php if ($col3) {
                            $colcounter++;
                            $last = ($colcounter == $servicecolumns) ? ' last' : '';

                            render_service_box($metadata, $servicegrid, $last, true, 3);

                        } ?>

                        <?php if ($col4) {
                            $colcounter++;
                            $last = ($colcounter == $servicecolumns) ? ' last' : '';

                            render_service_box($metadata, $servicegrid, $last, true, 4);

                        } ?>

                        <div class="clear"></div>

                    </section>

                <?php } // end service columns
            }
        } ?>


        <?php
        #-----------------------------------------------------------------
        # Service Columns
        #-----------------------------------------------------------------
        if (!function_exists('home_service_columns')) {
            function home_service_columns($count)
            {
                global $lambda_meta_data, $theme_options;
                $metadata = $lambda_meta_data->the_meta();

                if (isset($metadata['activate_service_columns']) && $metadata['activate_service_columns'] == 'on') {

                    $col1 = (isset($metadata['activate_cols_1']) && $metadata['activate_cols_1'] == 'on' ? '1' : false);
                    $col2 = (isset($metadata['activate_cols_2']) && $metadata['activate_cols_2'] == 'on' ? '1' : false);
                    $col3 = (isset($metadata['activate_cols_3']) && $metadata['activate_cols_3'] == 'on' ? '1' : false);
                    $col4 = (isset($metadata['activate_cols_4']) && $metadata['activate_cols_4'] == 'on' ? '1' : false);

                    $servicecolumns = $col1 + $col2 + $col3 + $col4;
                    $colcounter = NULL;

                    // Default grid value
                    $servicegrid = "one_fourth";

                    // If only one
                    if ($servicecolumns == "1") {

                        $servicegrid = "sixteen columns alpha omega row";

                    // If two, split in half
                    } elseif ($servicecolumns == "2") {

                        $servicegrid = "one_half";

                    // If three, divide in thirds
                    } elseif ($servicecolumns == "3") {

                        $servicegrid = "one_third";

                    // If four, split in fourths
                    } elseif ($servicecolumns == "4") {

                        $servicegrid = "one_fourth";

                    } ?>

                    <section
                            class="service-columns remove-bottom clearfix<?php echo ($count == 1) ? ' home-border' : ''; ?>">

                        <?php if (isset($metadata['services_headline']) && !empty($metadata['services_headline'])) : ?>

                            <div class="title-wrap clearfix">

                                <h3 class="home-title">
                                    <span><?php echo lambda_translate_meta($metadata['services_headline']); ?></span>
                                </h3>

                            </div>

                        <?php endif; ?>

                        <?php if ($col1) {
                            $colcounter++;
                            $last = ($colcounter == $servicecolumns) ? ' last' : '';

                            render_service_column($metadata, $servicegrid, $last, true, 1);

                        } ?>

                        <?php if ($col2) {
                            $colcounter++;
                            $last = ($colcounter == $servicecolumns) ? ' last' : '';

                            render_service_column($metadata, $servicegrid, $last, true, 2);

                        } ?>

                        <?php if ($col3) {
                            $colcounter++;
                            $last = ($colcounter == $servicecolumns) ? ' last' : '';

                            render_service_column($metadata, $servicegrid, $last, true, 3);

                        } ?>

                        <?php if ($col4) {
                            $colcounter++;
                            $last = ($colcounter == $servicecolumns) ? ' last' : '';

                            render_service_column($metadata, $servicegrid, $last, true, 4);

                        } ?>


                        <div class="clear"></div>

                    </section>

                <?php } // end service columns
            }
        } ?>


        <?php
        #-----------------------------------------------------------------
        # Latest Posts
        #-----------------------------------------------------------------
        if (!function_exists('home_blog_columns')) {
            function home_blog_columns($count, $lastborder = false)
            {
                global $lambda_meta_data, $post, $theme_options;

                $metadata = $lambda_meta_data->the_meta();

                if ($metadata['activate_latest_blog'] == 'on') { ?>

                    <section class="recent-post clearfix<?php echo ($count == 1) ? ' padding-top' : '';
                    echo ($lastborder) ? ' last-border' : ''; ?>">

                        <?php if (isset($metadata['blog_headline']) && !empty($metadata['blog_headline'])) : ?>

                            <div class="title-wrap clearfix">

                                <h3 class="home-title">
                                    <span><?php echo lambda_translate_meta($metadata['blog_headline']); ?></span></h3>

                                <?php if (isset($metadata['blog_link']) && !empty($metadata['blog_link'])) : ?>

                                    <span class="home-title-link">
                                        <a href="<?php echo $metadata['blog_link']; ?>"><?php echo $metadata['blog_link_text']; ?></a>
                                    </span>

                                <?php endif; ?>

                            </div>

                        <?php endif; ?>

                        <?php render_lambda_blog($metadata, true); ?>

                    </section>

                <?php } // End blog
            }
        }
        ?>


        <?php
        #-----------------------------------------------------------------
        # Testimonials
        #-----------------------------------------------------------------
        if (!function_exists('home_testimonials')) {
            function home_testimonials($count, $lastborder = false)
            {
                global $lambda_meta_data, $theme_path;

                //Receive standard meta
                $metadata = $lambda_meta_data->the_meta();

                //Default "own"
                $testimonials = (isset($metadata[UT_THEME_INITIAL . 'home_testimonials'])) ? $metadata[UT_THEME_INITIAL . 'home_testimonials'] : '';
                $tab_items = $metadata[UT_THEME_INITIAL . 'home_verticaltabs'];

                if ($metadata['activate_testimonials'] == 'on') {

                    if ($metadata['testimonial_type'] == 'page') {
                        //Get page meta data
                        $pagemetadata = get_post_meta($metadata['home_testimonial_page'], $lambda_meta_data->get_the_id(), TRUE);
                        $testimonials = $pagemetadata[UT_THEME_INITIAL . 'testimonial_items'];
                    }

                    if ($metadata['toggle_type'] == 'page') {
                        //Get page meta data
                        $pagemetadata = get_post_meta($metadata['home_service_page'], $lambda_meta_data->get_the_id(), TRUE);
                        $tab_items = $pagemetadata[UT_THEME_INITIAL . 'verticaltabs'];
                    }

                    ?>

                    <section class="home-service clearfix<?php echo ($count == 1) ? ' padding-top' : '';
                    echo ($lastborder) ? ' last-border' : ''; ?>">

                        <div class="lambda-service-excerpt one_half">

                            <?php if (isset($metadata['toggle_headline'])) : ?>

                                <div class="title-wrap clearfix">
                                    <h3 class="home-title">
                                        <span><?php echo lambda_translate_meta($metadata['toggle_headline']); ?></span>
                                    </h3>
                                </div>

                            <?php endif; ?>

                            <div class="clearfix">

                                <?php
                                $z = 1;

                                $maxservice = (isset($metadata['service_load_last']) && $metadata['service_load_last']) ? $metadata['service_load_last'] : 999;

                                if (is_array($tab_items)) {

                                    foreach ($tab_items as $tab) {

                                        if ($z <= $maxservice) { ?>

                                            <article class="list"><h3 class="trigger"><span class="faq-marker"></span><a
                                                            href="#"><?php echo (isset($tab['tab_name'])) ? lambda_translate_meta($tab['tab_name']) : ''; ?></a>
                                                </h3>
                                                <div class="toggle_container">
                                                    <div class="block clearfix"><?php echo (isset($tab['tab_content'])) ? do_shortcode(apply_filters('the_content', $tab['tab_content'])) : ''; ?></div>
                                                </div>
                                            </article>

                                        <?php }
                                        $z++;
                                    }
                                } ?>

                            </div>
                            <div class="clear"></div>

                        </div>

                        <section class="recent-testimonials one_half last" style="overflow:hidden;">

                            <?php render_testimonial_carousel($metadata, $testimonials, $count, 'home'); ?>

                        </section>

                    </section>


                    <div class="clear"></div>
                <?php } // End testimonials

            }
        }
        ?>

        <?php
        #-----------------------------------------------------------------
        # Clients
        #-----------------------------------------------------------------
        if (!function_exists('home_clients')) {
            function home_clients($count, $lastborder = false)
            {
                global $lambda_meta_data, $theme_path, $columnset;

                //Receive standard meta
                $metadata = $lambda_meta_data->the_meta();

                $clients = (isset($metadata[UT_THEME_INITIAL . 'home_clients']) && !empty($metadata[UT_THEME_INITIAL . 'home_clients'])) ? $metadata[UT_THEME_INITIAL . 'home_clients'] : '';;

                if (isset($metadata['client_type']) && $metadata['client_type'] == 'page') {
                    //Get page meta data
                    $pagemetadata = get_post_meta($metadata['home_client_page'], $lambda_meta_data->get_the_id(), TRUE);
                    $clients = $pagemetadata[UT_THEME_INITIAL . 'client_images'];
                }

                if (isset($metadata[UT_THEME_INITIAL . 'home_client_layout'])) {

                    switch ($metadata[UT_THEME_INITIAL . 'home_client_layout']) {

                        case 4:
                            $grid = "four columns";
                            $columnset = 4;
                            break;

                        case 5:
                            $grid = "one_fifth";
                            $columnset = 5;
                            break;
                    }
                }
                ?>

                <section class="client-wrap remove-bottom clearfix<?php echo ($count == 1) ? ' padding-top' : '';
                echo ($lastborder) ? ' last-border' : ''; ?>">

                    <?php if (isset($metadata['client_headline']) && !empty($metadata['client_headline'])) : ?>

                        <div class="title-wrap clearfix">
                            <h3 class="home-title">
                                <span><?php echo lambda_translate_meta($metadata['client_headline']); ?></span></h3>
                        </div>

                    <?php endif; ?>

                    <ul class="clients clearfix">

                        <?php

                        $z = 0;
                        $loadmax = (isset($metadata['client_load_last'])) ? $metadata['client_load_last'] : $columnset;

                        if (isset($clients) && is_array($clients)) {

                            shuffle($clients);
                            foreach ($clients as $client) {

                                if ($z + 1 <= $loadmax) {
                                    $itemposition = '';    //reset position

                                    //fallback
                                    $url = (isset($client['url'])) ? $client['url'] : '#';
                                    $title = (isset($client['title'])) ? $client['title'] : '';
                                    $src = (isset($client['imgurl'])) ? $client['imgurl'] : '';
                                    $name = (isset($client['name'])) ? $client['name'] : '';

                                    if ($columnset == 4) {
                                        (($z % 4) == 3) ? $itemposition = ' last' : $itemposition = '';
                                    }
                                    if ($columnset == 5) {
                                        (($z % 5) == 4) ? $itemposition = ' last' : $itemposition = '';
                                    }
                                    if ($columnset == 6) {
                                        (($z % 6) == 5) ? $itemposition = ' last' : $itemposition = '';
                                    }

                                    //Output client
                                    echo '<li class="overflow-hidden imagepost ' . $grid . $itemposition . '">';

                                    echo '<div class="client-holder">
								<a href="' . $url . '">
								<span class="client-img"><img alt="' . $title . '" src="' . $src . '" /></span>
									<div class="hover-overlay">
										<span class="client-title"><strong>' . $name . '</strong></span>
									</div>	
								</a></div>';

                                    echo '</li>';

                                }

                                $z++;
                            }
                        }
                        ?>
                    </ul>

                </section><!-- end client-wrap -->

                <?php
            }
        }
        ?>

        <?php
        #-----------------------------------------------------------------
        # Loop Home Items
        #-----------------------------------------------------------------
        if (isset($metadata['home_item']) && is_array($metadata['home_item'])) {

            $last = '';

            foreach ($metadata['home_item'] as $home_item) {

                switch ($home_item) {

                    case "service":
                        if (isset($metadata['activate_service_boxes']) && $metadata['activate_service_boxes'] == 'on') {
                            $last = $home_item;
                        }
                        break;

                    case "portfolio":
                        if (isset($metadata['activate_portfolio']) && $metadata['activate_portfolio'] == 'on') {
                            $last = $home_item;
                        }
                        break;

                    case "blog":
                        if (isset($metadata['activate_latest_blog']) && $metadata['activate_latest_blog'] == 'on') {
                            $last = $home_item;
                        }
                        break;

                    case "testimonials":
                        if (isset($metadata['activate_testimonials']) && $metadata['activate_testimonials'] == 'on') {
                            $last = $home_item;
                        }
                        break;

                    case "clients":
                        if (isset($metadata['activate_clients']) && $metadata['activate_clients'] == 'on') {
                            $last = $home_item;
                        }
                        break;

                    case "cta":
                        if (isset($metadata['activate_cta']) && $metadata['activate_cta'] == 'on') {
                            $last = $home_item;
                        }
                        break;
                }
            }

            $count = 1;

            foreach ($metadata['home_item'] as $home_item) {

                switch ($home_item) {

                    case "serviceboxes":
                        if (isset($metadata['activate_service_boxes']) && $metadata['activate_service_boxes'] == 'on') {

                            //Check if item is last item
                            $lastborder = ($home_item == $last) ? true : false;

                            home_service_boxes($count, $lastborder);
                            $count++;
                        }
                        break;

                    case "servicecolumns":
                        if (isset($metadata['activate_service_columns']) && $metadata['activate_service_columns'] == 'on') {

                            //Check if item is last item
                            $lastborder = ($home_item == $last) ? true : false;

                            home_service_columns($count, $lastborder);
                            $count++;
                        }
                        break;

                    case "portfolio":
                        if (isset($metadata['activate_portfolio']) && $metadata['activate_portfolio'] == 'on') {

                            //Check if item is last item
                            $lastborder = ($home_item == $last) ? true : false;

                            lambda_portfolio_columns($metadata, $count, false, 'latest-portfolio', $lastborder);
                            $count++;
                        }
                        break;

                    case "blog":
                        if (isset($metadata['activate_latest_blog']) && $metadata['activate_latest_blog'] == 'on') {

                            //Check if item is last item
                            $lastborder = ($home_item == $last) ? true : false;

                            home_blog_columns($count, $lastborder);
                            $count++;
                        }
                        break;

                    case "testimonials":
                        if (isset($metadata['activate_testimonials']) && $metadata['activate_testimonials'] == 'on') {

                            //Check if item is last item
                            $lastborder = ($home_item == $last) ? true : false;

                            home_testimonials($count, $lastborder);
                            $count++;
                        }
                        break;

                    case "clients":
                        if (isset($metadata['activate_clients']) && $metadata['activate_clients'] == 'on') {

                            //Check if item is last item
                            $lastborder = ($home_item == $last) ? true : false;

                            home_clients($count, $lastborder);
                            $count++;
                        }
                        break;

                    case "cta":
                        if (isset($metadata['activate_cta']) && $metadata['activate_cta'] == 'on') {

                            $buttonlink = (isset($metadata['cta_buttonlink'])) ? $metadata['cta_buttonlink'] : '';
                            $buttontext = (isset($metadata['cta_buttontext'])) ? $metadata['cta_buttontext'] : '';

                            if (isset($metadata['cta_main_headline']) && !empty($metadata['cta_main_headline'])) :?>

                                <div class="title-wrap clearfix">
                                    <h3 class="home-title">
                                        <span><?php echo lambda_translate_meta($metadata['cta_main_headline']); ?></span>
                                    </h3>
                                </div>

                            <?php endif;

                            echo do_shortcode('[cta ctaclass="margin-40" headline="' . lambda_translate_meta($metadata['cta_headline']) . '" buttonlink="' . $buttonlink . '" buttontext="' . lambda_translate_meta($buttontext) . '"] ' . lambda_translate_meta($metadata['cta_content']) . ' [/cta]');

                            $count++;
                        }
                        break;
                }
            }
        } ?>

    </div>

<?php

//Content closer - this function can be found in functions/theme-layout-functions.php line 56-61
    lambda_after_content();

//End password protection
}

//Includes the footer.php
get_footer();

?>
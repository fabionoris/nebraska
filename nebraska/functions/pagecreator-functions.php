<?php

#-----------------------------------------------------------------
# Grid related values
#-----------------------------------------------------------------
global $gridvalues;
$gridvalues = array('220' => 'one_fourth',
    '300' => 'one_third',
    '460' => 'one_half',
    '620' => 'two_thirds',
    '700' => 'three_fourths',
    '940' => 'full-width',
    '960' => 'full-width'
);

#-----------------------------------------------------------------
# Dynamic grid builder
#-----------------------------------------------------------------
if (!function_exists('build_grid_opener')) {

    function build_grid_opener($gridsize, $last, $boxtitle = 'lnotitle', $overflow = false, $entrycontent = false, $singlebox, $sidebar = false)
    {
        global $gridvalues;
        $activate_desktop = (isset($singlebox['activate_desktop']) && $singlebox['activate_desktop'] == 'on') ? ' lambda-hide-desktop ' : '';
        $activate_landscape = (isset($singlebox['activate_landscape']) && $singlebox['activate_landscape'] == 'on') ? ' lambda-hide-tablet ' : '';
        $activate_mobile = (isset($singlebox['activate_mobile']) && $singlebox['activate_mobile'] == 'on') ? ' lambda-hide-mobile ' : '';
        $removebottom = ($sidebar) ? ' remove-bottom ' : '';
        if ($overflow)
            $overflow = 'style="overflow:hidden;"';
        $entrycontent = ($entrycontent) ? ' entry-content' : '';
        $last = ($last == "960") ? ' last' : '';
        $gridopener = '<div class="' . $gridvalues[$gridsize] . $last . $entrycontent . $activate_desktop . $activate_landscape . $activate_mobile . $removebottom . '  clearfix" ' . $overflow . '>';
        if ($boxtitle) {

            $gridopener .= '<div class="title-wrap clearfix"><h3 class="home-title"><span>' . lambda_translate_meta($boxtitle) . '</span></h3></div>';

        }
        echo $gridopener;
    }
}

#-----------------------------------------------------------------
# Dynamic article builder
#-----------------------------------------------------------------
if (!function_exists('build_article_opener')) {
    function build_article_opener($gridsize, $last, $boxtitle = 'lnotitle', $overflow = false, $entrycontent = false)
    {
        global $gridvalues;
        $activate_desktop = (isset($singlebox['activate_desktop']) && $singlebox['activate_desktop'] == 'on') ? ' lambda-hide-desktop ' : '';
        $activate_landscape = (isset($singlebox['activate_landscape']) && $singlebox['activate_landscape'] == 'on') ? ' lambda-hide-tablet ' : '';
        $activate_mobile = (isset($singlebox['activate_mobile']) && $singlebox['activate_mobile'] == 'on') ? ' lambda-hide-mobile ' : '';
        if ($overflow)
            $overflow = 'style="overflow:hidden;';
        $entrycontent = ($entrycontent) ? ' entry-content' : '';
        $last = ($last == "960") ? ' last' : '';
        $gridopener = '<section class="' . $gridvalues[$gridsize] . $last . $entrycontent . $activate_desktop . $activate_landscape . $activate_mobile . ' service clearfix" ' . $overflow . '>';
        if ($boxtitle) {
            $gridopener .= '<div class="title-wrap clearfix"><h3 class="home-title"><span>' . lambda_translate_meta($boxtitle) . '</span></h3></div>';
        }
        echo $gridopener;
    }
}

#-----------------------------------------------------------------
# Simple text box with shortcodes
#-----------------------------------------------------------------
if (!function_exists('render_simple_textbox')) {
    function render_simple_textbox($content)
    {
        $final_simple_textbox = do_shortcode(apply_filters('the_content', $content));
        echo $final_simple_textbox;
    }
}

#-----------------------------------------------------------------
# Simple quote box
#-----------------------------------------------------------------
if (!function_exists('render_simple_quote')) {
    function render_simple_quote($quote, $quote_cite)
    {
        $final_simple_quote = '<div class="quote"><div class="quote-border">';
        $final_simple_quote .= '<h2 class="quote-title">' . do_shortcode(lambda_translate_meta($quote)) . '</h2>';
        $final_simple_quote .= '<cite>&#8722;' . do_shortcode($quote_cite) . '</cite>';
        echo $final_simple_quote . '</div></div>';
    }
}

#-----------------------------------------------------------------
# Revolution Slider
#-----------------------------------------------------------------
if (!function_exists('render_rev_slider')) {
    function render_rev_slider($sliderid)
    {
        $revslider = '<div class="lambda-pc">' . do_shortcode('[rev_slider ' . $sliderid . ']') . '</div>';
        echo $revslider;
    }
}

#-----------------------------------------------------------------
# Call to Action
#-----------------------------------------------------------------
if (!function_exists('render_cta_box')) {
    function render_cta_box($cta_headline = '', $cta_content = '', $cta_link = '', $cta_button_text = '')
    {
        echo do_shortcode('[cta headline="' . lambda_translate_meta($cta_headline) . '" buttonlink="' . $cta_link . '" buttontext="' . $cta_button_text . '"] ' . lambda_translate_meta($cta_content) . ' [/cta]');
    }
}

#-----------------------------------------------------------------
# Standard slider
#-----------------------------------------------------------------
if (!function_exists('render_standard_slider')) {
    function render_standard_slider($sliderid)
    {
        $standardslider = '<div class="lambda-pc">' . do_shortcode('[lambdaslider id="' . $sliderid . '"]') . '</div>';
        echo $standardslider;
    }
}

#-----------------------------------------------------------------
# SoundCloud
#-----------------------------------------------------------------
if (!function_exists('render_soundcloud')) {
    function render_soundcloud($soundcloud)
    {
        $soundcloud = '<div class="post_player">' . do_shortcode('[soundcloud url=' . $soundcloud['soundcloud_url'] . '/]') . '</div>';
        echo $soundcloud;
    }
}

#-----------------------------------------------------------------
# Horizontal row
#-----------------------------------------------------------------
if (!function_exists('render_row')) {
    function render_row($hrdata)
    {
        $row = '<hr style="margin-top:0px !important;" />';
        echo $row;
    }
}

#-----------------------------------------------------------------
# Pricing table
#-----------------------------------------------------------------
if (!function_exists('render_pricing_table')) {
    function render_pricing_table($tableid)
    {
        $table = do_shortcode('[lambdatable id="' . $tableid . '"]');
        echo $table;
    }
}

#-----------------------------------------------------------------
# Portfolio
#-----------------------------------------------------------------
if (!function_exists('lambda_portfolio_columns')) {
    function lambda_portfolio_columns($portfolio, $count, $pagebuilder = false, $containerID = 'none', $lastborder = false)
    {
        global $theme_options, $lambda_meta_data;
        //Class change for home and PageBuilder
        $portfoliowidth = ($pagebuilder) ? 'fullwidth' : 'sixteen columns alpha omega';
        $removebottom = ($pagebuilder) ? 'remove-bottom' : '';
        $container = ($containerID != 'none') ? 'id="' . $containerID . '"' : '';
        if ((isset($portfolio['activate_portfolio']) && $portfolio['activate_portfolio'] == 'on') || $pagebuilder = true) { ?>
            <script type="text/javascript">
                (function ($) {
                    $(document).ready(function () {
                        $(".portfolio-excerpt-<?php echo $count; ?> > li > .thumb").stop().hover(function () {
                            $(this).find('.hover-overlay').fadeIn(550);
                        }, function () {
                            $(this).find('.hover-overlay').stop().fadeOut(50);
                        });
                    });
                })(jQuery);
            </script>
            <section class="list_portfolio clearfix<?php echo ($count == 1) ? ' padding-top' : '';
            echo ($lastborder) ? ' last-border' : ''; ?>">
                <?php if (isset($portfolio['portfolio_headline']) && !empty($portfolio['portfolio_headline'])) : ?>
                    <div class="title-wrap clearfix">
                        <h3 class="home-title">
                            <span><?php echo lambda_translate_meta($portfolio['portfolio_headline']); ?></span></h3>
                        <?php if (isset($portfolio['portfolio_link']) && !empty($portfolio['portfolio_link'])) : ?>
                            <span class="home-title-link"><a
                                        href="<?php echo $portfolio['portfolio_link']; ?>"><?php echo $portfolio['portfolio_link_text']; ?></a></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <ul <?php echo $container; ?>
                        class="clearfix portfolio-excerpt-<?php echo $count; ?> <?php echo $removebottom; ?>">

                    <?php
                    #-----------------------------------------------------------------
                    # Custom project types for portfolio query
                    #-----------------------------------------------------------------
                    $project_types = '';
                    $preview = '';
                    $unkown = '';
                    if (isset($portfolio['project_type'])) {

                        if (is_array($portfolio['project_type'])) {

                            $project_types = "&project-type=";
                            foreach ($portfolio['project_type'] as $type) {

                                $project_types .= $type . ',';

                            }
                            $project_types = substr($project_types, 0, -1);

                        }

                    }
                    $posts_per_page = (isset($portfolio['portfolio_count'])) ? $portfolio['portfolio_count'] : '12';
                    $portfoliogrid = (isset($portfolio['portfolio_grid'])) ? $portfolio['portfolio_grid'] : 'one_fourth';
                    $gridcount = array('full-width' => '1',
                        'one_third' => '3',
                        'portfolio-item four columns' => '4',
                        'portfolio-item fivep columns' => '3',
                        'portfolio-item eight columns' => '2',
                        'one_half' => '2',
                        'one_fourth' => '4',
                        'four columns' => '4');
                    $portfoliogrid = (!$pagebuilder && $gridcount[$portfoliogrid] == 4) ? 'four columns' : $portfoliogrid;
                    $counter = 1;
                    //start query
                    query_posts('post_type=' . UT_PORTFOLIO_SLUG . '&posts_per_page=' . $posts_per_page . '&project_types=' . $project_types);
                    if (have_posts()) : while (have_posts()) : the_post();
                        $lambda_meta_data->the_meta();
                        #-----------------------------------------------------------------
                        # Get all project-types for this item
                        #-----------------------------------------------------------------
                        $projecttypeclean = NULL;
                        $project_cats = wp_get_object_terms(get_the_ID(), 'project-type');
                        if (is_array($project_cats)) {


                            $i = '0';
                            foreach ($project_cats as $types) {


                                if ($types->parent > 0)
                                    $projecttypeclean .= $types->name . ', ';
                                $i++;


                            }

                        }
                        //Cut last whitespace and comma
                        $projecttypeclean = substr($projecttypeclean, 0, -2);
                        //Fallback for self hosted videos
                        $unkown = $preview; //We need to keep the variable value
                        $title = str_ireplace('"', '', trim(get_the_title()));
                        $url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                        $image = $url;
                        ?>

                        <li style="margin-left:0px !important;"
                            class="<?php echo $portfoliogrid; ?> <?php echo ($counter % $gridcount[$portfoliogrid] == 0) ? 'last' : ''; ?> clearfix">
                            <div class="thumb <?php echo $removebottom; ?>">
                                <div class="overflow-hidden">
                                    <?php the_post_thumbnail($gridcount[$portfoliogrid] . 'col-image', array('class' => 'hovereffect wp-post-image')); ?>
                                    <a href="<?php echo get_permalink(); ?>">
                                        <div class="hover-overlay">
                                            <?php if (isset($portfolio['portfolio_item_title']) && $portfolio['portfolio_item_title'] != 'on') { ?>
                                                <h1 class="portfolio-title"><?php echo lambda_translate_meta($title); ?></h1>
                                            <?php } else { ?>
                                                <span class="circle-hover"><img
                                                            src="<?php echo get_template_directory_uri(); ?>/images/circle-hover.png"
                                                            alt="<?php _e('link icon', UT_THEME_INITIAL); ?>"/></span>
                                            <?php } ?>
                                        </div>
                                    </a>
                                </div>

                                <?php
                                #-----------------------------------------------------------------
                                # Display title or not
                                #-----------------------------------------------------------------
                                if (isset($portfolio['portfolio_item_title']) && $portfolio['portfolio_item_title'] == 'on') { ?>
                                    <div class="portfolio-title-below-wrap">
                                        <a href="<?php the_permalink(); ?>">
                                            <h1 class="portfolio-title-below">
                                                <?php echo lambda_translate_meta($title); ?>
                                                <span><?php echo lambda_translate_meta($projecttypeclean); ?></span>
                                            </h1>
                                        </a>
                                    </div>
                                <?php } //endif ?>
                            </div>
                        </li>
                        <?php $counter++; endwhile; endif; ?>
                    <?php wp_reset_query(); ?>
                </ul>
            </section>
            <div class="clear"></div>
            <?php
        } // End portfolio
    }
}

#-----------------------------------------------------------------
# Testimonial
#-----------------------------------------------------------------
if (!function_exists('render_testimonial')) {

    function render_testimonial($metadata, $async = 2)
    { ?>
        <?php global $theme_path;
        if (isset($metadata['author_image'])) {
            $authorimage = aq_resize($metadata['author_image'], 50, 50, true);
        } ?>
        <?php if (empty($metadata['author_image'])) {
        $authorimage = $theme_path . '/images/default-avatar.jpg';
    } ?>

        <article class="testimonial-entry <?php echo ($async % 2 == 0) ? 'dark' : 'white'; ?>">
            <?php echo do_shortcode(lambda_translate_meta($metadata['author_comment'])); ?>
        </article>

        <figure class="testimonial-photo">
            <img class="testimonial-img" src="<?php echo $authorimage; ?>">
        </figure>

        <p class="testimonial-name"><?php echo (isset($metadata['author_name'])) ? $metadata['author_name'] : ''; ?><?php echo (isset($metadata['author_company'])) ? ', <span>' . $metadata['author_company'] . '</span>' : ''; ?></p>

    <?php }
}

#-----------------------------------------------------------------
# Service Boxes
#-----------------------------------------------------------------
if (!function_exists('render_service_box')) {
    function render_service_box($metadata, $servicegrid = 'one_fourth', $last = '', $home = false, $colnumber = 1)
    {
        if ($home) {
            $metadata['col_box_icon'] = isset($metadata['col_' . $colnumber . '_icon']) ? $metadata['col_' . $colnumber . '_icon'] : '';
            $metadata['col_box_alt'] = isset($metadata['col_' . $colnumber . '_icon_alt']) ? $metadata['col_' . $colnumber . '_icon_alt'] : '';
            $metadata['col_box_headline'] = isset($metadata['col_' . $colnumber . '_headline']) ? $metadata['col_' . $colnumber . '_headline'] : '';
            $metadata['col_box_content'] = isset($metadata['col_' . $colnumber . '_content']) ? $metadata['col_' . $colnumber . '_content'] : '';
            $metadata['col_box_buttontext'] = isset($metadata['col_' . $colnumber . '_buttontext']) ? $metadata['col_' . $colnumber . '_buttontext'] : '';
            $metadata['col_box_link'] = isset($metadata['col_' . $colnumber . '_link']) ? $metadata['col_' . $colnumber . '_link'] : '';
            $metadata['col_box_bgcolor'] = isset($metadata['col_' . $colnumber . '_bgcolor']) ? $metadata['col_' . $colnumber . '_bgcolor'] : '#222';
            $metadata['col_box_textcolor'] = isset($metadata['col_' . $colnumber . '_textcolor']) ? $metadata['col_' . $colnumber . '_textcolor'] : '#FFF';
            $metadata['col_box_texthovercolor'] = isset($metadata['col_' . $colnumber . '_texthovercolor']) ? $metadata['col_' . $colnumber . '_texthovercolor'] : '#FFF';
            $metadata['col_box_hovercolor'] = isset($metadata['col_' . $colnumber . '_hovercolor']) ? $metadata['col_' . $colnumber . '_hovercolor'] : get_option_tree('color_scheme');
        } ?>

        <?php if ($home) { ?>

        <section class="<?php echo $servicegrid . $last; ?> service">

    <?php } ?>

        <a style="color:<?php echo $metadata['col_box_textcolor']; ?>"
           data-textcolor="<?php echo $metadata['col_box_textcolor']; ?>"
           data-texthovercolor="<?php echo $metadata['col_box_texthovercolor']; ?>"
           href="<?php echo lambda_translate_meta($metadata['col_box_link']); ?>" target="_self">

            <article class="service-box" style="background:<?php echo $metadata['col_box_bgcolor']; ?>;"
                     data-bgcolor="<?php echo $metadata['col_box_bgcolor']; ?>"
                     data-hovercolor="<?php echo $metadata['col_box_hovercolor']; ?>">

                <h3 style="color:<?php echo $metadata['col_box_textcolor']; ?>">
                    <?php echo (isset($metadata['col_box_headline'])) ? lambda_translate_meta($metadata['col_box_headline']) : ''; ?>
                </h3>

                <?php if (isset($metadata['col_box_icon']) && !empty($metadata['col_box_icon'])) :
                    $parsed_url = parse_url($metadata['col_box_icon']);
                    $path = $parsed_url['path'];
                    $filename = basename($path);
                    ?>

                    <figure class="service-box-icon">
                        <img src="<?php echo $metadata['col_box_icon']; ?>"
                             alt="<?php echo (!empty($metadata['col_box_alt'])) ? $metadata['col_box_alt'] : $filename; ?>"/>
                    </figure>

                <?php endif; ?>

                <?php if (isset($metadata['col_box_content'])) : ?>
                    <p><?php echo do_shortcode(lambda_translate_meta($metadata['col_box_content'])); ?></p>
                <?php endif; ?>

            </article>
        </a>

        <?php if ($home) { ?>

        </section>

    <?php } ?>

    <?php }

}

#-----------------------------------------------------------------
# Service Column
#-----------------------------------------------------------------
if (!function_exists('render_service_column')) {

    function render_service_column($metadata, $servicegrid = 'one_fourth', $last = '', $home = false, $colnumber = 1)
    {
        if ($home) {
            $metadata['col_icon'] = (isset($metadata['cols_' . $colnumber . '_icon'])) ? $metadata['cols_' . $colnumber . '_icon'] : '';
            $metadata['col_alt'] = (isset($metadata['cols_' . $colnumber . '_icon_alt'])) ? $metadata['cols_' . $colnumber . '_icon_alt'] : '';
            $metadata['col_headline'] = (isset($metadata['cols_' . $colnumber . '_headline'])) ? $metadata['cols_' . $colnumber . '_headline'] : '';
            $metadata['col_content'] = (isset($metadata['cols_' . $colnumber . '_content'])) ? $metadata['cols_' . $colnumber . '_content'] : '';
            $metadata['col_buttontext'] = (isset($metadata['cols_' . $colnumber . '_buttontext'])) ? $metadata['cols_' . $colnumber . '_buttontext'] : '';
            $metadata['col_link'] = (isset($metadata['cols_' . $colnumber . '_link'])) ? $metadata['cols_' . $colnumber . '_link'] : '';
        } ?>

        <?php if ($home) { ?>

        <section class="<?php echo $servicegrid . $last; ?> service clearfix">

    <?php } ?>

        <?php if (isset($metadata['col_icon']) && !empty($metadata['col_icon'])) : ?>

        <figure class="service-icon">
            <img src="<?php echo $metadata['col_icon']; ?>"
                 alt="<?php echo (isset($metadata['col_alt'])) ? $metadata['col_alt'] : ''; ?>"/>
        </figure>

    <?php endif; ?>

        <article class="service">

            <h3>
                <?php echo (isset($metadata['col_headline'])) ? lambda_translate_meta($metadata['col_headline']) : ''; ?>
            </h3>

            <?php if (isset($metadata['col_content'])) : ?>
                <p><?php echo do_shortcode(lambda_translate_meta($metadata['col_content'])); ?></p>
            <?php endif; ?>

            <?php if (isset($metadata['col_buttontext']) && !empty($metadata['col_buttontext'])) { ?>

                <a href="<?php echo lambda_translate_meta($metadata['col_link']); ?>" class="excerpt"
                   target="_self"><?php echo lambda_translate_meta($metadata['col_buttontext']); ?></a>

            <?php } ?>

        </article>

        <?php if ($home) { ?>

        </section>

    <?php } ?>

    <?php }

}

#-----------------------------------------------------------------
# Testimonial Carousel
#-----------------------------------------------------------------
if (!function_exists('render_testimonial_carousel')) {

    function render_testimonial_carousel($metadata, $testimonials = '', $ID = 1, $type)
    {
        global $lambda_meta_data, $theme_path;

        if ($type == 'page') {
            //Get page meta data
            $pagemetadata = get_post_meta($metadata['testimonialcarousel'], $lambda_meta_data->get_the_id(), TRUE);
            $testimonials = $pagemetadata[UT_THEME_INITIAL . 'testimonial_items'];
        }

        if (isset($metadata['testimonial_headline'])) : ?>

            <div class="title-wrap clearfix">
                <h3 class="home-title">
                    <span><?php echo lambda_translate_meta($metadata['testimonial_headline']); ?></span></h3>

                <?php if ($type == 'home') { ?>

                    <div class="carousel-navi clearfix">
                        <a class="tnext gon_<?php echo $ID; ?>" href="#">next</a>
                        <a class="tprev pon_<?php echo $ID; ?>" href="#">prev</a>
                    </div>

                <?php } ?>

            </div>

        <?php endif; ?>

        <?php if (isset($metadata['box_type'])) : ?>

        <div class="title-wrap clearfix">

            <h3 class="home-title">
                <span><?php echo (isset($metadata['box_title']) && !empty($metadata['box_title'])) ? $metadata['box_title'] : ''; ?></span>
            </h3>

            <div class="carousel-navi clearfix">
                <a class="tnext gon_<?php echo $ID; ?>" href="#">next</a>
                <a class="tprev pon_<?php echo $ID; ?>" href="#">prev</a>
            </div>

        </div>

    <?php endif; ?>

        <?php if (is_array($testimonials)) { ?>

        <script type="text/javascript">
            (function ($) {
                $(document).ready(function () {

                    var testimonials = $(".single-testimonial_<?php echo $ID; ?>").find('ul').children().length;

                    $(".single-testimonial_<?php echo $ID; ?>").jCarouselLite({
                        btnNext: ".gon_<?php echo $ID; ?>",
                        btnPrev: ".pon_<?php echo $ID; ?>",

                        <?php
                        if (isset($metadata['testimonials_autoplay']) && $metadata['testimonials_autoplay'] == 'on')
                            echo (isset($metadata['testimonial_time'])) ? 'auto:' . $metadata['testimonial_time'] . ',' : 'auto:1000,';
                        ?>

                        visible: testimonials
                    });
                });
            })(jQuery);
        </script>

    <?php } ?>

        <div class="single-testimonial_<?php echo $ID; ?>">

            <ul class="clearfix">

                <?php
                if (is_array($testimonials)) {

                    $z = 1;
                    foreach ($testimonials as $testimonial) { ?>

                        <li style="margin-bottom:0px !important; margin-left:0px !important; padding:0 1px;">

                            <?php
                            if (isset($testimonial['author_image'])) {
                                $authorimage = aq_resize($testimonial['author_image'], 50, 50, true);
                            } ?>


                            <?php if (empty($testimonial['author_image'])) {
                                $authorimage = $theme_path . '/images/default-avatar.jpg';
                            }
                            ?>

                            <article class="testimonial-entry">
                                <?php echo do_shortcode(lambda_translate_meta($testimonial['author_comment'])); ?>
                            </article>

                            <figure class="testimonial-photo">
                                <img alt="<?php _e('customer photo', UT_THEME_INITIAL); ?>" class="testimonial-img"
                                     src="<?php echo $authorimage; ?>">
                            </figure>

                            <p class="testimonial-name"><?php echo $testimonial['author_name']; ?><?php echo ($testimonial['author_company']) ? ', <span>' . $testimonial['author_company'] . '</span>' : ''; ?></p>

                        </li>

                        <?php $z++;
                    }
                } ?>

            </ul>

        </div>

        <?php
    }
}

#-----------------------------------------------------------------
# Blog
#-----------------------------------------------------------------
if (!function_exists('render_lambda_blog')) {

    function render_lambda_blog($metadata, $homeblog = false)
    {
        global $lambda_meta_data, $post, $theme_options;
        $numberpost = (isset($metadata['blog_length'])) ? $metadata['blog_length'] : 3;
        $blogcats = (isset($metadata['only_category']) && is_array($metadata['only_category'])) ? implode(",", $metadata['only_category']) : '';
        $post_not_in = (isset($metadata['post_not_in']) && is_array($metadata['post_not_in'])) ? $metadata['post_not_in'] : '';
        $z = 1;
        $args = array(
            'posts_per_page' => $numberpost,
            'post__not_in' => $post_not_in,
            'cat' => $blogcats,
            'paged' => (get_query_var('paged') ? get_query_var('paged') : 1)
        );
        query_posts($args);
        if (have_posts()) : while (have_posts()) : the_post();
            $lambda_meta_data->the_meta();
            global $more;
            $more = ($metadata['activate_blog_excerpt'] == 'on') ? 1 : 0;
            $bloggrid = (isset($metadata['blog_grid'])) ? $metadata['blog_grid'] : 'one_third';
            $gridcount = array('full-width' => '1',
                'one_third' => '3',
                'one_half' => '2',
                'one_fourth' => '4');
            $removebottom = ($homeblog) ? 'remove-bottom' : '';
            ?>

            <section
                    class="post <?php echo $removebottom; ?> <?php echo $bloggrid; ?> <?php if ($z % $gridcount[$bloggrid] == 0) {
                        echo 'last';
                    } ?>" id="post-<?php the_ID(); ?>">

                <article class="entry-post clearfix">

                    <?php
                    $pformat = get_post_format();
                    $postformat = (!empty($pformat)) ? $pformat : 'standard';
                    ?>

                    <?php
                    $post_format = get_post_format();
                    $post_format = (isset($postformat['portfolio_type']) && $postformat['portfolio_type'] == 'image_portfolio') ? 'gallery' : $post_format;
                    if ($metadata['activate_blog_images'] == 'on' || $postformat == 'link' || $postformat == 'quote')
                        get_template_part('post-formats/' . $post_format);
                    ?>

                    <?php
                    if (has_post_thumbnail(get_the_ID()) && $metadata['activate_blog_images'] == 'on' && $post_format != 'video' && $post_format != 'gallery') :
                        $imgID = get_post_thumbnail_id($post->ID);
                        $url = wp_get_attachment_url($imgID);
                        $alt = get_post_meta($imgID, '_wp_attachment_image_alt', true);
                        echo '<div class="thumb"><div class="post-image"><div class="overflow-hidden imagepost">';
                        echo '<img class="wp-post-image" alt="' . trim(strip_tags($alt)) . '" src="' . $url . '" />';
                        echo '<a title="' . get_the_title() . '" href="' . get_permalink() . '"><div class="hover-overlay"><span class="circle-hover"><img src="' . get_template_directory_uri() . '/images/circle-hover.png" alt="' . __('link icon', UT_THEME_INITIAL) . '" /></span></div></a>';
                        echo '</div></div></div>';
                    endif;
                    ?>

                    <?php if ($postformat != 'link') : ?>

                        <header class="entry-header clearfix">

                            <?php if ($postformat != 'quote') : ?>

                                <h1 class="entry-title <?php echo $postformat; ?>-post-title">
                                    <a href="<?php the_permalink(); ?>"
                                       title="<?php printf(esc_attr__('Permalink to %s', UT_THEME_NAME), the_title_attribute('echo=0')); ?>"
                                       rel="bookmark"><?php the_title(); ?></a>
                                </h1>

                            <?php endif; ?>

                            <div class="entry-meta clearfix">

                                <div class="post-ut">
                                    <?php echo lambda_posted_on(); ?>
                                </div> <!-- post date -->

                                <div class="post-ut">
                                    <span class="comments-link"><?php comments_popup_link(__('0 Comments', UT_THEME_NAME), __('1 Comment', UT_THEME_NAME), __('% Comments', UT_THEME_NAME)); ?></span>
                                </div><!-- post comments -->

                            </div><!-- .entry-meta -->

                        </header>

                    <?php endif; ?>

                    <div class="entry-summary">

                        <?php
                        if ($numberpost != 0 && $pformat != 'link') {
                            if ($metadata['activate_blog_excerpt'] == 'on') :
                                $excerptlength = (isset($metadata['blog_excerpt_length'])) ? $metadata['blog_excerpt_length'] : $theme_options['excerpt_blog_length'];
                                echo excerpt_by_id($post->ID, $excerptlength, '', lambda_continue_reading_link(), $homeblog);
                            else :
                                the_content(__('Read more', UT_THEME_NAME));
                            endif;
                        }
                        ?>

                    </div>

                </article>

            </section>

            <?php if (($z % $gridcount[$bloggrid] == 0) && $bloggrid != 'full-width') { ?>
                <div class="clear"></div>
            <?php } ?>

            <?php $z++; endwhile; endif; ?>

        <?php if (!$homeblog) : ?>


        <div id="nav-below" class="navigation clearfix">
            <div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&#8656;</span> Older posts', UT_THEME_NAME)); ?></div>
            <div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&#8658;</span>', UT_THEME_NAME)); ?></div>
        </div><!-- #nav-below -->

    <?php endif; ?>

        <?php wp_reset_query(); ?>

        <?php
    }
}

#-----------------------------------------------------------------
# Google Map
#-----------------------------------------------------------------
if (!function_exists('render_googlemap')) {
    function render_googlemap($mapdata)
    {
        $map = do_shortcode('[googlemap address="' . $mapdata['map_address'] . '" zoom="' . $mapdata['map_zoom'] . '" height="' . $mapdata['map_height'] . '"]');
        echo $map;
    }
}

#-----------------------------------------------------------------
# Sidebar
#-----------------------------------------------------------------
if (!function_exists('render_simple_sidebar')) {
    function render_simple_sidebar($content)
    {
        do_action('st_before_sidebar', 'widget-sidebar');
        echo '<ul>';
        dynamic_sidebar($content['sidebar']);
        echo '</ul>';
        do_action('st_after_sidebar');
    }
}

#-----------------------------------------------------------------
# Client Box
#-----------------------------------------------------------------
if (!function_exists('render_clientbox')) {
    function render_clientbox($clientdata)
    {
        global $lambda_meta_data, $theme_path;
        $pagemetadata = get_post_meta($clientdata['home_client_page'], $lambda_meta_data->get_the_id(), TRUE);
        $clients = $pagemetadata[UT_THEME_INITIAL . 'client_images'];
        $grid = "one_fourth";
        $columnset = 4;
        $z = 0;
        $loadmax = (isset($clientdata['client_load_last'])) ? $clientdata['client_load_last'] : $columnset;
        echo '<ul class="clientspc clearfix">';
        if (is_array($clients)) {

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
                    echo '<li class="overflow-hidden imagepost ' . $grid . $itemposition . '"><div class="client-holder">';
                    echo '<a href="' . $url . '">

								<span class="client-img"><img alt="' . $title . '" src="' . $src . '" /></span>

								<div class="hover-overlay">

									<span class="client-title"><strong>' . $name . '</strong></span>

								</div>

							  </a>';
                    echo '</div>';
                    echo '</li>';
                }
                $z++;
            }
        }
        echo '</ul>';
    }
}
?>
<?php

/**
 * Templatepart for Slideroutput
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 2.0
 */

global $slider_meta_data, $lambda_meta_data, $wpdb;

if (is_home()) {

    $homeid = get_option('page_for_posts');
    $slides = get_post_meta($homeid, $slider_meta_data->get_the_id(), TRUE);

} else {

    $slides = $slider_meta_data->the_meta();

}

if (isset($slides['sliderstyle_type']) && !(is_archive() || is_search())) {

    if ($slides['sliderstyle_type'] == 'static_image') {

        $margintop = (isset($slides['static_image_size']) && $slides['static_image_size'] == 'on') ? 'style="margin-top:40px;"' : '';

        echo '<div id="lambda-featured-header-wrap" ' . $margintop . '><div id="lambda-featured-header">
					<figure class="lambda-featured-header-image">';

        //Optional URL
        $url = (isset($slides['static_image_url'])) ? lambda_translate_meta($slides['static_image_url']) : '#';

        echo (isset($slides['static_image'])) ? '<a href="' . $url . '"><img src="' . lambda_translate_meta($slides['static_image']) . '" /></a>' : '';

        //Optional Caption
        echo (isset($slides['static_image_caption'])) ? '<figcaption class="lambda-featured-header-caption"><span>' . lambda_translate_meta($slides['static_image_caption']) . '</span></figcaption>' : '';

        echo '</figure></div></div>';
    }

    if ($slides['sliderstyle_type'] == 'static_video') {
        echo '<div id="lambda-featured-header-wrap" style="margin-top:40px;"><div class="container clearfix"><div class="sixteen columns clearfix">';
        post_format_video($slides, "fh1");
        echo '</div></div></div>';

    }

    if ($slides['sliderstyle_type'] == 'static_textvideo') {
        echo '<div id="lambda-featured-header-wrap">
					<div class="container clearfix">
						<div class="sixteen columns clearfix" style="padding:40px 0;">';

        $headlinecolor = (isset($slides['featured_headline_color']) && !empty($slides['featured_headline_color'])) ? $slides['featured_headline_color'] : '';
        $featuredtextcolor = (isset($slides['featured_text_color']) && !empty($slides['featured_text_color'])) ? $slides['featured_text_color'] : '';

        echo '<div class="lambda-featured-header-content one_half">
								<h1 class="featured-header-title" style="color:' . $headlinecolor . ';">' . do_shortcode($slides['featured_headline']) . '</h1>
								<p style="color:' . $featuredtextcolor . ';">' . do_shortcode($slides['featured_text']) . '</p>';

        if ($slides['featured_buttontext'])
            echo '<a class="button themebutton medium" href="' . $slides['featured_link'] . '">' . $slides['featured_buttontext'] . '</a>';

        echo '</div><div class="lambda-featured-header-video one_half last"><div class="video-frame">';
        post_format_video($slides, "fh1");
        echo '</div></div>
					</div>
					</div>
			</div>';
    }

    if ($slides['sliderstyle_type'] == 'static_slider' && !empty($slides['main_slider'])) {

        $sliderinfo = explode('_', $slides['main_slider']);

        //Add exception for supersized this one needs to be called in another place
        $table_lambda_sliders = $wpdb->base_prefix . "lambda_sliders";
        $supersized = $wpdb->get_var("SELECT slidertype FROM $table_lambda_sliders WHERE id = $sliderinfo[1]");

        if ($supersized != 'supersized' || $sliderinfo[0] == 'revslider')
            lambda_main_slider($slides); // this function can be found in theme-functions.php around line 198
    }

}

?>
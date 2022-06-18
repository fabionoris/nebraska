<?php

#-----------------------------------------------------------------
# Audio Output
#-----------------------------------------------------------------

global $lambda_meta_data;

$audiometa = $lambda_meta_data->the_meta();

if (isset($audiometa['soundcloud_url']) && !is_single())
    echo '<div class="post_player">' . do_shortcode('[soundcloud url=' . $audiometa['soundcloud_url'] . '/]') . '</div>';

if (isset($audiometa['soundcloud_url']) && is_single() && !isset($audiometa['mp3_url']))
    echo '<div class="post_player">' . do_shortcode('[soundcloud url=' . $audiometa['soundcloud_url'] . '/]') . '</div>';

if (isset($audiometa['mp3_url']))
    lambda_audioplayer_java($audiometa, $post->ID);

if (isset($audiometa['portfolio_mp3_url']))
    lambda_audioplayer_java($audiometa, $post->ID);

if (isset($audiometa['portfolio_soundcloud_url']) && !isset($audiometa['portfolio_mp3_url']))
    echo '<div class="post_player"><div class="portfolio_audio">' . do_shortcode('[soundcloud url=' . $audiometa['portfolio_soundcloud_url'] . '/]') . '</div></div>';
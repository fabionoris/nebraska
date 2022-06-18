<?php

#-----------------------------------------------------------------
# Post Format Video Output
#-----------------------------------------------------------------
if (!function_exists('post_format_video')) {
    function post_format_video($videometa, $id)
    {
        global $columns;

        if (isset($videometa['single_embedded_code'])) {
            $videometa['embedded_code'] = $videometa['single_embedded_code'];
        }

        //Embedded Code will overwrite hosted videos!
        if ($videometa['embedded_code']) { ?>

            <?php $removebottom = ($id == 'fh1') ? 'remove-bottom' : ''; ?>

            <div class="lambda-video <?php echo $removebottom; ?>">
                <?php echo $videometa['embedded_code']; ?>
            </div>

        <?php }

        if (!isset($videometa['embedded_code']) && (isset($videometa['nonverbla_url']) || isset($videometa['nonverbla_hd_url']))) {
            //Load Video Player
            nonverbla_video_player($videometa, get_the_ID(), $columns);
        }
    }
}

#-----------------------------------------------------------------
# Post Format Audio Output
#-----------------------------------------------------------------
if (!function_exists('post_format_audio')) {
    function post_format_audio($audiometa)
    {
        if ($audiometa['soundcloud_url'] && !is_single())
            echo '<div class="frame">' . do_shortcode('[soundcloud url=' . $audiometa['soundcloud_url'] . '/]') . '</div>';

        if ($audiometa['soundcloud_url'] && is_single())
            echo '<div class="post_player"><div class="frame">' . do_shortcode('[soundcloud url=' . $audiometa['soundcloud_url'] . '/]') . '</div></div>';

        if ($audiometa['portfolio_soundcloud_url'])
            echo '<div class="portfolio_audio"><div class="frame">' . do_shortcode('[soundcloud url=' . $audiometa['portfolio_soundcloud_url'] . '/]') . '</div></div>';
    }
}

#-----------------------------------------------------------------
# Post Format Gallery Output
#-----------------------------------------------------------------
if (!function_exists('post_format_gallery')) {
    function post_format_gallery($id)
    { ?>

        <?php if (post_password_required()) : ?>
        <?php the_content(); ?>
    <?php else : ?>

        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery("#post-slider-<?php the_ID(); ?>").flexslider({
                    animation: "fade",
                    slideshow: true,
                    slideshowSpeed: 4000
                });
            });
        </script>

        <?php $images = get_children(array('post_parent' => $post->ID,
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'numberposts' => 999)); ?>

        <div id="post-slider-<?php the_ID(); ?>" class="flexslider">
            <div class="frame">
                <ul class="slides">
                    <?php foreach ($images as $singleimage) {
                        echo '<li><a href="' . get_permalink() . '"><img src="' . $singleimage->guid . '" alt="' . $singleimage->post_title . '" /></a></li>';
                    } ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <?php }
}

#-----------------------------------------------------------------
# Post Format Link Output
#-----------------------------------------------------------------
if (!function_exists('post_format_link')) {
    function post_format_link($linkmeta)
    { ?>
        <div class="written_link">
            <h2 class="entry-title">
                <?php $linkmeta = $lambda_meta_data->the_meta(); ?>

                <a href="<?php echo $linkmeta['post_format_link']; ?>"
                   title="<?php printf(esc_attr__('Permalink to %s', UT_THEME_NAME), the_title_attribute('echo=0')); ?>"
                   rel="bookmark">
                    <?php the_title(); ?>
                </a>
            </h2>
            <br/>
            <span><?php echo $linkmeta['post_format_link']; ?></span>
        </div>
    <?php }
}

?>
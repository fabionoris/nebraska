<?php

#-----------------------------------------------------------------
# Link Output
#-----------------------------------------------------------------

global $lambda_meta_data;

$linkmeta = $lambda_meta_data->the_meta()

?>

<div class="link-post row">
    <h2 class="link-post-title">

        <?php $linkmeta = $lambda_meta_data->the_meta();

        if (isset($linkmeta['post_format_link'])) { ?>

            <a href="<?php echo $linkmeta['post_format_link']; ?>"
               title="<?php printf(esc_attr__('Permalink to %s', UT_THEME_NAME), the_title_attribute('echo=0')); ?>"
               rel="bookmark">
                <?php the_title(); ?>
            </a>

        <?php } ?>
    </h2>
    <span><?php echo $linkmeta['post_format_link']; ?></span>

</div>
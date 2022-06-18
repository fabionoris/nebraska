<?php
/**
 * The loop that displays a page.
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
 */
?>

<?php if (have_posts()) while (have_posts()) : the_post(); ?>

    <section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <article>

            <div class="entry-content">
                <?php the_content(); ?>
                <?php wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', UT_THEME_NAME), 'after' => '</div>')); ?>
            </div><!-- .entry-content -->

            <div class="edit-link-wrap">
                <?php edit_post_link(__('Edit', UT_THEME_NAME), '<span class="edit-link">', '</span>'); ?>
            </div><!-- .edit-link-wrap -->

        </article>
    </section><!-- #post-## -->

    <?php if (comments_open()) { ?>
        <div class="loop-single-divider"></div>
    <?php } ?>

    <?php comments_template('', true); ?>

<?php endwhile; // End of the loop. ?>
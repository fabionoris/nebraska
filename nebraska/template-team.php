<?php

/**
 * Template Name: Team Template
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
 */

global $lambda_meta_data;

$meta_sidebar = $lambda_meta_data->get_the_value('sidebar');
$meta_sidebar = (!empty($meta_sidebar)) ? $meta_sidebar : get_option_tree('select_sidebar');

//Includes the header.php
get_header();

//Includes the template-part-slider.php
get_template_part('template-part', 'slider');

//Includes the template-part-teaser.php
get_template_part('template-part', 'teaser');

//Content opener - this function can be found in functions/theme-layout-functions.php line 5-50
lambda_before_content($columns = 'sixteen');

?>

<?php if (have_posts()) while (have_posts()) : the_post(); ?>

    <section>
        <article>
            <?php the_content(); ?>
        </article>
    </section>

<?php endwhile; // end of the loop. ?>


<?php
#-----------------------------------------------------------------
# Team
#-----------------------------------------------------------------
?>

<?php if (!post_password_required($post)) : ?>

    <section class="member-wrap clearfix entry-content">
        <?php

        //Retrieve FAQ items
        $memberitems = $lambda_meta_data->get_the_value(UT_THEME_INITIAL . 'team_member');

        $z = 1;
        $count = count($memberitems);

        if (is_array($memberitems)) {
            foreach ($memberitems as $member) { ?>


                <div class="one_third <?php echo ($z % 3 == 0) ? 'last' : ''; ?>">

                    <section class="member-details clearfix">

                        <figure class="member-photo">

                            <?php
                            if (empty($member['member_pic'])) {
                                $member_pic['url'] = $theme_path . '/images/default-avatar.jpg';
                            } else {
                                $member_pic['url'] = $member['member_pic'];
                            }
                            ?>

                            <img class="member-img" src="<?php echo $member_pic['url']; ?>">

                        </figure>

                        <div class="member-info">

                            <h3 class="member-name"><?php echo $member['member_name']; ?></h3>

                            <?php if (isset($member['member_title']) && !empty($member['member_title'])) { ?>
                            <span class="member-title">
				                <?php echo lambda_translate_meta($member['member_title']); ?>
			                </span>
                            <?php } ?>

                        </div>

                        <?php echo do_shortcode(apply_filters('the_content', $member['member_text'])); ?>

                        <div class="member-contact">
                            <ul class="lambda-sociallinks clearfix">

                                <?php if (isset($member['member_email']) && !empty($member['member_email'])) { ?>
                                    <li><a class="email" href="mailto:<?php echo $member['member_email']; ?>"></a>
                                    </li><?php } ?>

                                <?php if (isset($member['member_website']) && !empty($member['member_website'])) { ?>
                                    <li><a class="link" href="<?php echo $member['member_website']; ?>"></a>
                                    </li><?php } ?>

                                <?php if (isset($member['member_twitter']) && !empty($member['member_twitter'])) { ?>
                                    <li><a class="twitter" href="<?php echo $member['member_twitter']; ?>"></a>
                                    </li><?php } ?>

                                <?php if (isset($member['member_facebook']) && !empty($member['member_facebook'])) { ?>
                                    <li><a class="facebook" href="<?php echo $member['member_facebook']; ?>"></a>
                                    </li><?php } ?>

                                <?php if (isset($member['member_google']) && !empty($member['member_google'])) { ?>
                                    <li><a class="googleplus" href="<?php echo $member['member_google']; ?>"></a>
                                    </li><?php } ?>

                            </ul>
                        </div>

                        <div class="clear"></div>

                    </section><?php echo '<!-- end member ' . $z . '-->'; ?>

                </div>

                <?php echo ($z % 3 == 0) ? '<div class="clear"></div>' : ''; ?>

                <?php $z++;
            }
        } ?>

    </section><!-- end member-wrap -->

<?php

//Content closer - this function can be found in functions/theme-layout-functions.php line 56-61
lambda_after_content();

//End password protection
endif;

//Includes the footer.php
get_footer();

?>
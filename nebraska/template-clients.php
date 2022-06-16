<?php
/**
 * Template Name: Client Template
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 */

global $lambda_meta_data;

//Retrieve meta data
$metadata = $lambda_meta_data->the_meta();

$clientlayout = (isset($metadata[UT_THEME_INITIAL . 'client_layout'])) ? $metadata[UT_THEME_INITIAL . 'client_layout'] : '4';

switch ($clientlayout) {

    case 4:
        $grid = "four columns";
        $columnset = 4;
        $removebottom = '';
        break;

    case 5:
        $grid = "one_fifth";
        $columnset = 5;
        $removebottom = 'remove-bottom';
        break;
}

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
# Clients
#-----------------------------------------------------------------
?>

<?php if (!post_password_required($post)) : ?>

    <section class="client-wrap clearfix <?php echo $removebottom; ?>">

        <ul class="clients clearfix">

            <?php

            $z = 0;
            if (isset($metadata[UT_THEME_INITIAL . 'client_images']) && is_array($metadata[UT_THEME_INITIAL . 'client_images'])) {

                foreach ($metadata[UT_THEME_INITIAL . 'client_images'] as $client) {

                    //Reset position
                    $itemposition = '';

                    //Fallback
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
						<a href="' . $client['url'] . '">
						<span class="client-img"><img alt="' . $title . '" src="' . $src . '" /></span>
							<div class="hover-overlay">
								<span class="client-title"><strong>' . $name . '</strong></span>
							</div>	
					    </a></div>';

                    echo '</li>';

                    $z++;
                }
            }
            ?>
        </ul>

    </section><!-- end member-wrap -->

<?php

//Content closer - this function can be found in functions/theme-layout-functions.php line 56-61
lambda_after_content();

//End password protection
endif;

//Includes the footer.php
get_footer();

?>
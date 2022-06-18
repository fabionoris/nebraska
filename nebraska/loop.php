<?php

/**
 * The loop that displays posts.
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
 */

global $lambda_meta_data, $lambda_content_column, $theme_options;

#-----------------------------------------------------------------
# Define Image Width
#-----------------------------------------------------------------
if($lambda_content_column == 'sixteen') {

	$lambda_image_width = '940';

} elseif($lambda_content_column == 'eleven') {

	$lambda_image_width = '640';

} else {

	$lambda_image_width = '460';
}

?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<section id="post-0" class="post error404 not-found">
    	<article class="entry-post clearfix">
			<h1 class="entry-title"><span><?php _e( 'Not Found', UT_THEME_NAME ); ?></span></h1>
			<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', UT_THEME_NAME ); ?></p>
			<?php get_search_form(); ?>
			</div><!-- .entry-content -->
        </article>
	</section><!-- #post-0 -->
<?php endif; ?>


<?php
#-----------------------------------------------------------------
# Start the Loop
#-----------------------------------------------------------------
?>

<?php while ( have_posts() ) : the_post(); $lambda_meta_data->the_meta();

$postformat = $lambda_meta_data->the_meta();
$sticky = get_option( 'sticky_posts' );

?>

	<?php
	#-----------------------------------------------------------------
	# Gallery Format
	#-----------------------------------------------------------------
	?>

	<?php if (  ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) )
				|| isset($postformat['portfolio_type']) && $postformat['portfolio_type'] == 'image_portfolio'
				|| in_category( _x( 'gallery', 'gallery category slug', UT_THEME_NAME ) ) ) : ?>


			<?php if ( is_search() && $postformat['portfolio_type'] == 'image_portfolio' ) { ?>

			<section id="post-<?php the_ID(); ?>" class="post">


			<?php } else { ?>

			<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php } ?>

            <article class="entry-post clearfix">

                <header class="entry-header clearfix">

                   	<?php if(in_array($post->ID,$sticky)) { echo '<span class="sticky-title">Sticky Post</span>'; } ?>
					<h1 class="entry-title gallery-post-title">
                        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', UT_THEME_NAME ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                    </h1>

                    <div class="entry-meta row clearfix">

					<div class="post-ut">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
							<span class="author-link"><?php the_author(); ?></span>
						</a>
                    </div> <!-- post by -->

                    <div class="post-ut">
                        <?php echo lambda_posted_on(); ?>
                    </div> <!-- post date -->

                    <div class="post-ut">
                       <span class="comments-link">
					   		<?php comments_popup_link( __( '0 Comments', UT_THEME_NAME ), __( '1 Comment', UT_THEME_NAME ), __( '% Comments', UT_THEME_NAME ) ); ?>
                       </span>
                    </div><!-- post comments -->

				</div><!-- .entry-meta -->

            	</header>

				<?php $post_format = get_post_format();
				if(isset($postformat['portfolio_type']) && $postformat['portfolio_type'] == 'image_portfolio') { $post_format = 'gallery'; }
				get_template_part( 'post-formats/' . $post_format ); ?>

        	<div class="entry-content clearfix">

                <div class="entry-summary">

                <?php if ( is_archive() || is_search() || get_option_tree('excerpt_blog') == 'yes') :

                    the_excerpt();

                else :

                    the_content( __( 'Read more', UT_THEME_NAME ) );

                endif; ?>

                </div><!-- entry-summary -->

           </div><!-- .entry-content -->

           <footer class="entry-footer clearfix">

           </footer>

			<div class="edit-link-wrap">
				<?php edit_post_link( __( 'Edit', UT_THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .edit-link-wrap -->

          </article>

		</section><!-- #post-## -->

	<?php
    #-----------------------------------------------------------------
    # Video Format
    #-----------------------------------------------------------------
    ?>

	<?php elseif ( ( function_exists( 'get_post_format' ) && 'video' == get_post_format( $post->ID ) )
					|| isset($postformat['portfolio_type']) && $postformat['portfolio_type'] == 'video_portfolio'
					|| in_category( _x( 'videos', 'video category slug', UT_THEME_NAME ) )  ) : ?>

		<?php if ( is_search() && (isset($postformat['portfolio_type']) && $postformat['portfolio_type'] == 'video_portfolio' )) { ?>

		<section id="post-<?php the_ID(); ?>" class="post">

		<?php } else { ?>

		<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php } ?>

        <article class="entry-post clearfix">

        <header class="entry-header clearfix">

                   	<?php if(in_array($post->ID,$sticky)) { echo '<span class="sticky-title">Sticky Post</span>'; } ?>
					<h1 class="entry-title video-post-title">
                        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', UT_THEME_NAME ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>

                    </h1>

                    <div class="entry-meta row clearfix">

					<div class="post-ut">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
							<span class="author-link"><?php the_author(); ?></span>
						</a>
                    </div> <!-- post by -->

                    <div class="post-ut">
                        <?php echo lambda_posted_on(); ?>
                    </div> <!-- post date -->

                    <div class="post-ut">
                       <span class="comments-link"><?php comments_popup_link( __( '0 Comments', UT_THEME_NAME ), __( '1 Comment', UT_THEME_NAME ), __( '% Comments', UT_THEME_NAME ) ); ?></span>
                    </div><!-- post comments -->

                </div><!-- .entry-meta -->

            	</header>

					 <?php 	//include player
					 $post_format = get_post_format();
 					 if(isset($postformat['portfolio_type']) && $postformat['portfolio_type'] == 'video_portfolio') { $post_format = 'video'; }
					 get_template_part( 'post-formats/' . $post_format );
					 ?>

        <div class="entry-content clearfix">

        <div class="entry-summary">
		<?php if ( is_archive() || is_search() || get_option_tree('excerpt_blog') == 'yes') :

			the_excerpt();

		else :

			the_content( __( 'Read more', UT_THEME_NAME ) );

		endif; ?>
		</div><!-- entry-summary -->

        </div><!-- .entry-content -->

        <footer class="entry-footer clearfix"></footer>

			<div class="edit-link-wrap">
				<?php edit_post_link( __( 'Edit', UT_THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .edit-link-wrap -->

          </article>
		</section><!-- #post-## -->


    <?php
    #-----------------------------------------------------------------
    # Audio Format
    #-----------------------------------------------------------------
    ?>

	<?php elseif (  ( function_exists( 'get_post_format' ) && 'audio' == get_post_format( $post->ID ) )
					|| isset($postformat['portfolio_type']) && $postformat['portfolio_type'] == 'audio_portfolio'
					|| in_category( _x( 'audio', 'audio category slug', UT_THEME_NAME ) )  ) : ?>

		<?php if ( is_search() && $postformat['portfolio_type'] == 'audio_portfolio' ) { ?>

		<section id="post-<?php the_ID(); ?>" class="post">

		<?php } else { ?>

		<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php } ?>

        <article class="entry-post clearfix">

        <header class="entry-header clearfix">

                   	<?php if(in_array($post->ID,$sticky)) { echo '<span class="sticky-title">Sticky Post</span>'; } ?>
					<h1 class="entry-title audio-post-title">
                        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', UT_THEME_NAME ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>

                    </h1>

                    <div class="entry-meta row clearfix">

					<div class="post-ut">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
							<span class="author-link"><?php the_author(); ?></span>
						</a>
                    </div> <!-- post by -->

                    <div class="post-ut">
                        <?php echo lambda_posted_on(); ?>
                    </div> <!-- post date -->

                    <div class="post-ut">
                       <span class="comments-link"><?php comments_popup_link( __( '0 Comments', UT_THEME_NAME ), __( '1 Comment', UT_THEME_NAME ), __( '% Comments', UT_THEME_NAME ) ); ?></span>
                    </div><!-- post comments -->

                </div><!-- .entry-meta -->

            	</header>

				<?php

				$audiometa = $lambda_meta_data->the_meta();
				$audiopref = get_option_tree('soundcloud_player_iframe');
				($audiopref == 'HTML5') ? $iframe = true : false;

				if(isset($audiometa['soundcloud_url']) && $audiometa['soundcloud_url'] && empty($audiometa['mp3_url'])) {

					echo '<div class="post_player">'.do_shortcode('[soundcloud url="'.$audiometa['soundcloud_url'].'" /]').'</div>';

				} else {

					lambda_audioplayer_java($audiometa, $post->ID);

				}

				?>

        	<div class="entry-content clearfix">

        <div class="entry-summary">
		<?php if ( is_archive() || is_search() || get_option_tree('excerpt_blog') == 'yes') :

			the_excerpt();

		else :

			the_content( __( 'Read more', UT_THEME_NAME ) );

		endif; ?>
		</div><!-- entry-summary -->
        </div><!-- .entry-content -->

         <footer class="entry-footer clearfix"></footer>

			<div class="edit-link-wrap">
				<?php edit_post_link( __( 'Edit', UT_THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .edit-link-wrap -->

          </article>
		</section><!-- #post-## -->


	<?php
    #-----------------------------------------------------------------
    # Link Format
    #-----------------------------------------------------------------
    ?>

	<?php elseif ( ( function_exists( 'get_post_format' ) && 'link' == get_post_format( $post->ID ) ) || in_category( _x( 'links', 'link category slug', UT_THEME_NAME ) )  ) : ?>

        <section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <article class="entry-post clearfix">

        <header class="entry-header clearfix">

           	<?php if(in_array($post->ID,$sticky)) { echo '<span class="sticky-title">Sticky Post</span>'; } ?>

			<?php
			$post_format = get_post_format();
			$post_format = ( isset($postformat['portfolio_type']) && $postformat['portfolio_type'] == 'image_portfolio') ? 'gallery' : $post_format;

			get_template_part( 'post-formats/' . $post_format );

			?>

        </header>

        <div class="clear"></div>

        <div class="edit-link-wrap">
				<?php edit_post_link( __( 'Edit', UT_THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .edit-link-wrap -->
          </article>
		</section><!-- #post-## -->


    <?php
    #-----------------------------------------------------------------
    # Quote Format
    #-----------------------------------------------------------------
    ?>

	<?php elseif ( ( function_exists( 'get_post_format' ) && 'quote' == get_post_format( $post->ID ) ) || in_category( _x( 'quotes', 'quote category slug', UT_THEME_NAME ) )  ) : ?>

        <section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <article class="entry-post clearfix">

       <header class="entry-header clearfix">

                   	<?php if(in_array($post->ID,$sticky)) { echo '<span class="sticky-title">Sticky Post</span>'; } ?>
                    <div class="entry-meta row clearfix">

 					<div class="post-ut">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
							<span class="author-link"><?php the_author(); ?></span>
						</a>
                    </div> <!-- post by -->

                    <div class="post-ut">
                        <?php echo lambda_posted_on(); ?>
                    </div> <!-- post date -->

                    <div class="post-ut">
                       <span class="comments-link"><?php comments_popup_link( __( '0 Comments', UT_THEME_NAME ), __( '1 Comment', UT_THEME_NAME ), __( '% Comments', UT_THEME_NAME ) ); ?></span>
                    </div><!-- post comments -->

                </div><!-- .entry-meta -->

            	</header>

        <header class="quote">
        	<div class="quote-border">

                <a href="<?php the_permalink(); ?>">
                    <h2 class="quote-title">
                        <?php $linkmeta = $lambda_meta_data->the_meta(); ?>
                        <?php echo $linkmeta['post_format_quote']; ?>
                    </h2>
                </a>
                <cite>&#8722;<?php the_title(); ?></cite>

            </div>
        </header>

		<footer class="entry-footer clearfix"></footer>

        <div class="clear"></div>

		<div class="entry-summary">
        <?php if ( is_archive() || is_search() || get_option_tree('excerpt_blog') == 'yes') :

			the_excerpt();

		else :

			the_content( __( 'Read more', UT_THEME_NAME ) );

		endif; ?>
		</div><!-- .entry-content -->

        <div class="edit-link-wrap">
				<?php edit_post_link( __( 'Edit', UT_THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .edit-link-wrap -->
          </article>
		</section><!-- #post-## -->


	<?php
    #-----------------------------------------------------------------
    # All other Posts
    #-----------------------------------------------------------------
    ?>

	<?php else : ?>

        <section id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

           	<article class="entry-post clearfix">

            <header class="entry-header clearfix">

                   	<?php if(in_array($post->ID,$sticky)) { echo '<span class="sticky-title">Sticky Post</span>'; } ?>
					<h1 class="entry-title standard-post-title">
                        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', UT_THEME_NAME ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                    </h1>

                    <div class="entry-meta row clearfix">

					<div class="post-ut">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
							<span class="author-link"><?php the_author(); ?></span>
						</a>
                    </div> <!-- post by -->

                    <div class="post-ut">
                        <?php echo lambda_posted_on(); ?>
                    </div> <!-- post date -->

                    <div class="post-ut">
                       <span class="comments-link"><?php comments_popup_link( __( '0 Comments', UT_THEME_NAME ), __( '1 Comment', UT_THEME_NAME ), __( '% Comments', UT_THEME_NAME ) ); ?></span>
                    </div><!-- post comments -->

                </div><!-- .entry-meta -->
            	</header>

            <?php
			//only show picture if it has been set in the article
			if(has_post_thumbnail(get_the_ID())) :

				$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

				//cropping if customer has backend option to yes
				if(isset($theme_options['activate_image_cropping']) && $theme_options['activate_image_cropping'] == 'yes') {
					$url = aq_resize( $url, $lambda_image_width , get_option_tree('blog_preview_height'), true );
				}

				echo '<div class="thumb"><div class="post-image"><div class="overflow-hidden imagepost">';
				echo '<img class="wp-post-image" src="'.$url.'" />';
				echo '<a title="'.get_the_title().'" href="'.get_permalink().'"><div class="hover-overlay"><span class="circle-hover"><img src="'.get_template_directory_uri().'/images/circle-hover.png" alt="'.__('link icon',UT_THEME_INITIAL).'" /></span></div></a>';
				echo '</div></div></div>';

			endif; ?>

            <div class="entry-content clearfix">

			<div class="entry-summary">

				<?php if ( is_archive() || is_search() || get_option_tree('excerpt_blog') == 'yes') :

                    the_excerpt();

                else :

                    the_content( __( 'Read more', UT_THEME_NAME ) );

                endif; ?>

			</div><!-- .entry-summary -->

            </div><!-- .entry-content -->

            <footer class="entry-footer clearfix"></footer>

			<div class="clear"></div>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', UT_THEME_NAME ), 'after' => '</div>' ) ); ?>


            <div class="edit-link-wrap">
				<?php edit_post_link( __( 'Edit', UT_THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .edit-link-wrap -->
			</article>

		</section><!-- #post-## -->

        <div class="clear"></div>

		<?php comments_template( '', true ); ?>

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. Whew.  ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation clearfix">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&#8656;</span> Older posts', UT_THEME_NAME ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&#8658;</span>', UT_THEME_NAME ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>
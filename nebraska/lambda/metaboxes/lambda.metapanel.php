<div class="bootstrap-wpadmin">
    <?php

    /**
     * Meta Page Panel
     * Update to Page Tool
     * lambda framework v 2.1
     * by www.unitedthemes.com
     * since lambda framework v 1.0
    */

    global $wpalchemy_media_access, $theme_path, $wpdb, $wp_registered_sidebars, $theme_options;

    $gridvalues = array('220' => '1/4',
        '300' => '1/3',
        '460' => '1/2',
        '620' => '2/3',
        '700' => '3/4',
        '940' => 'Full Width');

    $wp_registered_sidebars[UT_THEME_INITIAL . 'sidebar_none'] = array('name' => __('No Sidebar', UT_THEME_NAME)); ?>

    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">

                <button type="submit" class="btn btn-success save-meta right" name="update"
                        id="update"><?php _e('Save', UT_THEME_NAME); ?></button>

                <ul class="options_tabs nav">

                    <li><a href="#lambdaeditor" class="lambdaeditor_menu" data-toggle="tab"><i
                                    class="icon-font icon-white"></i><?php _e('Editor', UT_THEME_NAME); ?></a></li>

                    <?php if (get_post_type($post->ID) == 'post') { ?>
                        <li><a href="#postformat-settings" data-toggle="tab"><i
                                        class="icon-file icon-white"></i><?php _e('Post Format Settings', UT_THEME_NAME); ?>
                            </a></li>
                    <?php } ?>

                    <?php if (get_post_type($post->ID) != UT_PORTFOLIO_SLUG && get_post_type($post->ID) != 'post' && get_post_type($post->ID) != 'product') { ?>
                        <li><a href="#pagetool-wrap" class="pagetool_menu" data-toggle="tab"><i
                                        class="icon-th icon-white"></i><?php _e('Page Creator', UT_THEME_NAME); ?></a>
                        </li>
                    <?php } ?>

                    <li><a href="#slider-settings" data-toggle="tab"><i
                                    class="icon-picture icon-white"></i><?php _e('Featured Header', UT_THEME_NAME); ?>
                        </a></li>
                    <li><a href="#page-settings" class="page-settings_menu" data-toggle="tab"><i
                                    class="icon-wrench icon-white"></i><?php _e('Page Settings', UT_THEME_NAME); ?></a>
                    </li>

                    <?php if (get_post_type($post->ID) == 'page') { ?>
                        <li><a href="#portfolio-settings" class="portfolio-settings_menu" data-toggle="tab"><i
                                        class="icon-camera icon-white"></i><?php _e('Portfolio Overview Settings', UT_THEME_NAME); ?>
                            </a></li>
                    <?php } ?>

                    <?php if (get_post_type($post->ID) == UT_PORTFOLIO_SLUG) { ?>
                        <li><a href="#portfolio-items" class="portfolio-items_menu" data-toggle="tab"><i
                                        class="icon-folder-open icon-white"></i><?php _e('Portfolio Items', UT_THEME_NAME); ?>
                            </a></li>
                    <?php } ?>

                    <?php if (get_post_type($post->ID) != UT_PORTFOLIO_SLUG && get_post_type($post->ID) != 'post' && get_post_type($post->ID) != 'product') { ?>

                        <li><a href="#home-settings" class="home-settings_menu" data-toggle="tab"><i
                                        class="icon-home icon-white"></i><?php _e('Home Settings', UT_THEME_NAME); ?>
                            </a></li>
                        <li><a href="#team-settings" class="team-settings_menu" data-toggle="tab"><i
                                        class="icon-user icon-white"></i><?php _e('Team Settings', UT_THEME_NAME); ?>
                            </a></li>
                        <li><a href="#faq-settings" class="faq-settings_menu" data-toggle="tab"><i
                                        class="icon-question-sign icon-white"></i><?php _e('FAQ Settings', UT_THEME_NAME); ?>
                            </a></li>
                        <li><a href="#testimonials-settings" class="testimonials-settings_menu" data-toggle="tab"><i
                                        class="icon-book icon-white"></i><?php _e('Testimonials', UT_THEME_NAME); ?></a>
                        </li>
                        <li><a href="#verticaltabs-settings" class="verticaltabs-settings_menu" data-toggle="tab"><i
                                        class="icon-book icon-white"></i><?php _e('Service', UT_THEME_NAME); ?></a></li>
                        <li><a href="#client-settings" class="client-settings_menu" data-toggle="tab"><i
                                        class="icon-book icon-white"></i><?php _e('Clients', UT_THEME_NAME); ?></a></li>
                        <li><a href="#infiniteblog-settings" class="infiniteblog_menu" data-toggle="tab"><i
                                        class="icon-book icon-white"></i><?php _e('Infinite Blog Settings', UT_THEME_NAME); ?>
                            </a></li>

                    <?php } ?>

                </ul>

            </div>
        </div>
    </div>


    <?php
    #-----------------------------------------------------------------
    # Start Tabs
    #-----------------------------------------------------------------
    ?>

    <div class="tab-content">

        <?php // Placeholder for Editor ?>
        <div id="lambdaeditor" class="tab-pane active"></div>

        <?php // Placeholder for Slidetab ?>
        <div id="slider-settings" class="tab-pane"></div>

        <?php if (get_post_type($post->ID) != UT_PORTFOLIO_SLUG && get_post_type($post->ID) != 'post' && get_post_type($post->ID) != 'product') : ?>

            <div id="pagetool-wrap" class="overflowx pagetool tab-pane">
                <div id="pagetool">

                    <button type="button" class="btn btn-success openpc">
                        <?php _e('Expand Page Creator', UT_THEME_NAME); ?>
                    </button>
                    <button type="button" class="btn btn-warning closepc">
                        <?php _e('Shrink Page Creator', UT_THEME_NAME); ?>
                    </button>

                    <div class="lambda_overlay"></div>

                    <button type="button" class="btn btn-inverse addnew docopy-<?php echo 'lambda_page_item'; ?>">
                        <i class="icon-share icon-white"></i><?php _e('Add New Box', UT_THEME_NAME); ?>
                    </button>

                    <div class="hr"></div>
                    <div id="pagetool-inner">

                        <?php while ($mb->have_fields_and_multi('lambda_page_item')): ?>
                            <?php $mb->the_group_open(); ?>

                            <?php $grid = $mb->get_the_value('grid_size'); ?>
                            <?php $grid = empty($grid) ? '220' : $grid; ?>

                            <?php $boxname = $mb->get_the_value('boxname'); ?>
                            <?php $boxname = empty($boxname) ? __('New box', UT_THEME_NAME) : $boxname; ?>

                            <div class="grid_item" style="width:<?php echo $grid; ?>px;">

                                <?php $mb->the_field('grid_size'); ?>
                                <input class="grid" type="hidden" name="<?php $mb->the_name(); ?>"
                                       value="<?php $mb->the_value(); ?>"/>

                                <div class="itemscale">
                                    <button type="button" class="btn btn-mini resizeup">+</button>
                                    <button type="button" class="btn btn-mini resizedown">-</button>
                                </div>

                                <span class="ui-widget-header"><?php echo $boxname; ?></span>

                                <span class="currentgrid"><?php echo $gridvalues[$grid]; ?></span>

                                <div class="itemedit">
                                    <button type="button" class="doedit btn btn-mini btn-success"
                                            href="#itemtools"><?php _e('edit', UT_THEME_NAME); ?></button>
                                    <button type="button" class="dodelete btn btn-mini btn-danger">x</button>
                                </div>

                            </div>


                            <?php
                            #-----------------------------------------------------------------
                            # Start Modal for Options
                            #-----------------------------------------------------------------
                            ?>
                            <div class="itembox">

                                <div class="modal-header" style="position:relative;">
                                    <h2><?php echo $boxname; ?></h2>
                                    <button type="button" class="doclose btn btn-mini btn-success right" style="position:absolute; right:0; top:0;">
                                        <i class="icon-ok icon-white"></i>
                                    </button>
                                </div>

                                <div class="modal-body well">

                                    <div class="one_half">
                                        <label><?php _e('Enter Boxname', UT_THEME_NAME); ?></label>
                                        <?php $mb->the_field('boxname'); ?>
                                        <input class="boxname" type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/>
                                        <br/>
                                        <span class="info badge badge-info"><?php _e('only for internal use', UT_THEME_NAME); ?></span>
                                    </div>


                                    <div class="one_half last" style="margin-top:15px;">

                                        <?php if (isset($theme_options['responsive']) && $theme_options['responsive'] == 'on') { ?>

                                            <div class="one_third" style="margin-bottom:0px;">
                                                <img style="float:right;" src="<?php echo $theme_path; ?>/lambda/assets/images/responsive.png"></span>
                                            </div>

                                            <div class="two_thirds last" style="margin-bottom:0px;">

                                                <div class="btn-group">

                                                    <label><?php _e('Hide on Desktop', UT_THEME_NAME); ?></label>
                                                    <?php $mb->the_field('activate_desktop'); ?>

                                                    <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                                    <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                                    <button data-state="activate_desktop_on"
                                                            class="btn <?php echo $activestate; ?> radio_active"
                                                            type="button"
                                                            value="on"><?php _e('yes', UT_THEME_NAME); ?></button>
                                                    <input id="activate_desktop_on" type="radio" value="on"
                                                           name="<?php $mb->the_name(); ?>" style="display:none;"
                                                           class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>

                                                    <button data-state="activate_desktop_off"
                                                            class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                            type="button"
                                                            value="off"><?php _e('no', UT_THEME_NAME); ?></button>
                                                    <input id="activate_desktop_off" type="radio" value="off"
                                                           name="<?php $mb->the_name(); ?>" style="display:none;"
                                                           class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                                </div>


                                                <div class="btn-group">

                                                    <label><?php _e('Hide on Tablet', UT_THEME_NAME); ?></label>
                                                    <?php $mb->the_field('activate_landscape'); ?>

                                                    <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                                    <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                                    <button data-state="activate_landscape_on"
                                                            class="btn <?php echo $activestate; ?> radio_active"
                                                            type="button"
                                                            value="on"><?php _e('yes', UT_THEME_NAME); ?></button>
                                                    <input id="activate_landscape_on" type="radio" value="on"
                                                           name="<?php $mb->the_name(); ?>" style="display:none;"
                                                           class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>

                                                    <button data-state="activate_landscape_off"
                                                            class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                            type="button"
                                                            value="off"><?php _e('no', UT_THEME_NAME); ?></button>
                                                    <input id="activate_landscape_off" type="radio" value="off"
                                                           name="<?php $mb->the_name(); ?>" style="display:none;"
                                                           class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                                </div>


                                                <div class="btn-group">

                                                    <label><?php _e('Hide on Mobile', UT_THEME_NAME); ?></label>
                                                    <?php $mb->the_field('activate_mobile'); ?>

                                                    <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                                    <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                                    <button data-state="activate_mobile_on"
                                                            class="btn <?php echo $activestate; ?> radio_active"
                                                            type="button"
                                                            value="on"><?php _e('yes', UT_THEME_NAME); ?></button>
                                                    <input id="activate_mobile_on" type="radio" value="on"
                                                           name="<?php $mb->the_name(); ?>" style="display:none;"
                                                           class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>

                                                    <button data-state="activate_mobile_off"
                                                            class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                            type="button"
                                                            value="off"><?php _e('no', UT_THEME_NAME); ?></button>
                                                    <input id="activate_mobile_off" type="radio" value="off"
                                                           name="<?php $mb->the_name(); ?>" style="display:none;"
                                                           class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                                </div>

                                            </div>

                                        <?php } ?>

                                    </div>

                                    <hr/>

                                    <?php $mb->the_field('box_type'); ?>
                                    <label><?php _e('Choose Boxtype', UT_THEME_NAME); ?></label>
                                    <select name="<?php $mb->the_name(); ?>" id="box_type" class="box_type">
                                        <option value=""><?php _e('Choose Box Type', UT_THEME_NAME); ?></option>
                                        <option value="simple_textbox" <?php $mb->the_select_state('simple_textbox'); ?>> <?php _e('Textbox (with Editor)', UT_THEME_NAME); ?> </option>
                                        <option value="simple_quote" <?php $mb->the_select_state('simple_quote'); ?>> <?php _e('Quote', UT_THEME_NAME); ?> </option>
                                        <option value="rev_slider" <?php $mb->the_select_state('rev_slider'); ?>> <?php _e('Revolution Slider', UT_THEME_NAME); ?> </option>
                                        <option value="standard_slider" <?php $mb->the_select_state('standard_slider'); ?>> <?php _e('Standard Slider', UT_THEME_NAME); ?> </option>
                                        <option value="soundcloud" <?php $mb->the_select_state('soundcloud'); ?>> <?php _e('Soundcloud', UT_THEME_NAME); ?> </option>
                                        <option value="row" <?php $mb->the_select_state('row'); ?>> <?php _e('Horizontal Row', UT_THEME_NAME); ?> </option>
                                        <option value="simple_video" <?php $mb->the_select_state('simple_video'); ?>> <?php _e('Video', UT_THEME_NAME); ?> </option>
                                        <option value="service_column" <?php $mb->the_select_state('service_column'); ?>> <?php _e('Service Column', UT_THEME_NAME); ?> </option>
                                        <?php /*<option value="service_box" <?php $mb->the_select_state('service_box'); ?>> <?php _e( 'Service Box', UT_THEME_NAME ); ?> </option>*/ ?>
                                        <option value="testimonial" <?php $mb->the_select_state('testimonial'); ?>> <?php _e('Single Testimonial', UT_THEME_NAME); ?> </option>
                                        <option value="testimonialcarousel" <?php $mb->the_select_state('testimonialcarousel'); ?>> <?php _e('Testimonial Carousel', UT_THEME_NAME); ?> </option>
                                        <option value="pricing_table" <?php $mb->the_select_state('pricing_table'); ?>> <?php _e('Pricing Table', UT_THEME_NAME); ?> </option>
                                        <option value="portfolio_excerpt" <?php $mb->the_select_state('portfolio_excerpt'); ?>> <?php _e('Portfolio', UT_THEME_NAME); ?> </option>
                                        <option value="blog_excerpt" <?php $mb->the_select_state('blog_excerpt'); ?>> <?php _e('Blog', UT_THEME_NAME); ?> </option>
                                        <option value="google_map" <?php $mb->the_select_state('google_map'); ?>> <?php _e('Google Map', UT_THEME_NAME); ?> </option>
                                        <option value="call_to_action" <?php $mb->the_select_state('call_to_action'); ?>> <?php _e('Call to Action', UT_THEME_NAME); ?> </option>
                                        <option value="sidebarwidget" <?php $mb->the_select_state('sidebarwidget'); ?>> <?php _e('Sidebar', UT_THEME_NAME); ?> </option>
                                        <option value="clientbox" <?php $mb->the_select_state('clientbox'); ?>> <?php _e('Clients', UT_THEME_NAME); ?> </option>
                                    </select>

                                    <hr/>

                                    <p>
                                        <label><?php _e('Title', UT_THEME_NAME); ?></label>
                                        <?php $mb->the_field('box_title'); ?>
                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/>
                                        <br/><span class="info badge badge-info">(<?php _e('this will create a designed headline above the box, leave empty to hide', UT_THEME_NAME); ?>)</span>
                                    </p>

                                    <hr/>

                                    <?php
                                    #-----------------------------------------------------------------
                                    # Simple TextBox
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="simple_textbox single_item">

                                        <div class="customEditor">
                                            <?php $mb->the_field('extra_content'); ?>

                                            <div class="wp-editor-tools">
                                                <div class="custom_upload_buttons hide-if-no-js wp-media-buttons">
                                                    <?php do_action('media_buttons'); ?>
                                                </div>
                                            </div>

                                            <?php $editorcontent = $mb->get_the_value(); ?>

                                            <!-- Removed "echo wpautop()" before "esc_html" to avoid inserting <p></p> automatically. -->
                                            <!-- Number of columns increased from 50 to 111. -->
                                            <textarea id="<?php $mb->the_name(); ?>" rows="20" cols="111"
                                                      name="<?php $mb->the_name(); ?>"
                                                      class="lambdatextarea"><?php echo esc_html($mb->get_the_value()); ?></textarea>
                                        </div>

                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Simple Quote
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="simple_quote single_item">

                                        <p>
                                            <label><?php _e('Quote!', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('quote'); ?>
                                            <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="85"
                                                      class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                        </p>

                                        <p>
                                            <label><?php _e('Authorname', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('quote_cite'); ?>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </p>

                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Revolution Slider
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="rev_slider single_item">

                                        <label><?php _e('Choose Revolution Slider', UT_THEME_NAME); ?></label>
                                        <?php $mb->the_field('rev_slider'); ?>
                                        <select name="<?php $mb->the_name(); ?>">
                                            <option value=""><?php _e('Choose Slider', UT_THEME_NAME); ?></option>
                                            <?php

                                            global $wpdb, $blog_id;

                                            if ($blog_id != 1) {
                                                $table_prefix = $wpdb->base_prefix . $blog_id . "_";
                                            } else {
                                                $table_prefix = $wpdb->base_prefix;
                                            }

                                            $table_name = $table_prefix . "revslider_sliders";
                                            $slidedata = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");

                                            foreach ($slidedata as $singledata) {
                                                echo "<option value='" . $singledata->alias . "' name='" . $singledata->title . "' " . $mb->get_the_select_state($singledata->alias) . ">" . $singledata->title . "</option>";
                                            }

                                            ?>
                                        </select>

                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Standard Slider
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="standard_slider single_item">

                                        <label><?php _e('Choose Slider', UT_THEME_NAME); ?></label>
                                        <?php $mb->the_field('standard_slider'); ?>
                                        <select name="<?php $mb->the_name(); ?>">
                                            <option value=""><?php _e('Choose Slider', UT_THEME_NAME); ?></option>
                                            <?php

                                            global $wpdb;

                                            $table_name = $wpdb->base_prefix . "lambda_sliders";
                                            $slidedata = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");

                                            foreach ($slidedata as $singledata) {
                                                if ($singledata->slidertype != 'supersized')
                                                    echo "<option value='" . $singledata->id . "' name='" . $singledata->option_name . "' " . $mb->get_the_select_state($singledata->id) . ">" . $singledata->option_name . "</option>";
                                            }

                                            ?>
                                        </select>

                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Soundcloud
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="soundcloud single_item">
                                        <p>
                                            <label><?php _e('Soundcloud URL', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('soundcloud_url'); ?>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </p>
                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Simple Video
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="simple_video single_item">

                                        <?php $mb->the_field('nonverbla_url'); ?>
                                        <?php $wpalchemy_media_access->setGroupName('nonverbla_url_slider' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                        <label><?php _e('Upload Video', UT_THEME_NAME); ?></label>
                                        <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                        <br/>
                                        <span class="info badge badge-info">(<?php _e('can be .mov, .flv', UT_THEME_NAME); ?>)</span>
                                        <br/>
                                        <?php echo $wpalchemy_media_access->getButton(); ?>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('nonverbla_hd_url'); ?>
                                            <?php $wpalchemy_media_access->setGroupName('nonverbla_hd_url_slider' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                            <label><?php _e('Upload HD Video', UT_THEME_NAME); ?></label>
                                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('can be .mov, .flv', UT_THEME_NAME); ?>)</span>
                                            <br/>
                                            <?php echo $wpalchemy_media_access->getButton(); ?>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('poster_image'); ?>
                                            <?php $wpalchemy_media_access->setGroupName('poster_image' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                            <label><?php _e('Poster Image', UT_THEME_NAME); ?></label>
                                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('should be same size as Video', UT_THEME_NAME); ?>)</span>
                                            <br/>
                                            <?php echo $wpalchemy_media_access->getButton(); ?>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('mp4_url'); ?>
                                            <?php $wpalchemy_media_access->setGroupName('mp4_url_slider' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                            <label><?php _e('MP4 File URL', UT_THEME_NAME); ?></label>
                                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('The URL to .mp4 video file for Ipad', UT_THEME_NAME); ?>)</span>
                                            <br/>
                                            <?php echo $wpalchemy_media_access->getButton(); ?>
                                        </p>

                                        <p><h4>or</h4></p>

                                        <p>
                                            <label class="metalabel"><?php _e('Embedded Code', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('single_embedded_code'); ?>
                                            <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                                      class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                            <br/><span class="info badge badge-info">(<?php _e('Embedded Code', UT_THEME_NAME); ?>)</span>
                                        </p>

                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Design Element Row
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="hrow single_item">
                                        <p><?php _e('This is only a horizontal divider!', UT_THEME_NAME); ?></p>
                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Service Column
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="service_column single_item">

                                        <p>
                                            <?php $mb->the_field('col_icon'); ?>
                                            <?php $wpalchemy_media_access->setGroupName('img-ico' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

                                            <img class="frame" src="<?php if ($mb->get_the_value()) {
                                                echo aq_resize($mb->get_the_value(), 32, 32, true);
                                            } ?>"/>

                                            <label><?php _e('Icon URL', UT_THEME_NAME); ?></label>
                                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                            <br/><span
                                                    class="info badge badge-info">(<?php _e('Icon size should be 32x32', UT_THEME_NAME); ?>)</span><br/>
                                            <?php echo $wpalchemy_media_access->getButton(); ?>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('col_alt'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Icon alt', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('col_headline'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Headline', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </p>

                                        <p>
                                            <label><?php _e('Content', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('col_content'); ?>
                                            <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                                      class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('This field accepts shortcodes', UT_THEME_NAME); ?>)</span>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('col_link'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Link', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('col_buttontext'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Buttontext', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </p>

                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Service Box
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="service_box single_item">

                                        <p>
                                            <?php $mb->the_field('col_box_icon'); ?>
                                            <?php $wpalchemy_media_access->setGroupName('img-ico-box' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

                                        <div style="min-height:50px;">
                                            <img class="frame" src="<?php if ($mb->get_the_value()) {
                                                echo aq_resize($mb->get_the_value(), 32, 32, true);
                                            } ?>"/>
                                        </div>

                                        <label><?php _e('Icon URL', UT_THEME_NAME); ?></label>
                                        <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                        <br/>
                                        <span class="info badge badge-info">(<?php _e('Icon size should be 32x32', UT_THEME_NAME); ?>)</span>
                                        <br/>
                                        <?php echo $wpalchemy_media_access->getButton(); ?>
                                        </p>

                                        <p><?php $mb->the_field('col_box_icon_alt'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Icon alt', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/></p>

                                        <p><?php $mb->the_field('col_box_headline'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Headline', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/></p>

                                        <p><label><?php _e('Content', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('col_box_content'); ?>
                                            <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                                      class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                            <br/><span
                                                    class="info badge badge-info">(<?php _e('This field accepts shortcodes', UT_THEME_NAME); ?>)</span>
                                        </p>

                                        <p><?php $mb->the_field('col_box_link'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Link', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/></p>

                                        <script type="text/javascript">
                                            jQuery(document).ready(function ($) {

                                                $('#col_<?php echo $mb->get_the_index(); ?>_bgcolor').ColorPicker({

                                                    onSubmit: function (hsb, hex, rgb) {
                                                        $('#col_<?php echo $mb->get_the_index(); ?>_bgcolor').val('#' + hex);
                                                    },
                                                    onBeforeShow: function () {
                                                        $(this).ColorPickerSetColor(this.value);
                                                        return false;
                                                    },
                                                    onChange: function (hsb, hex, rgb) {
                                                        $('#col_<?php echo $mb->get_the_index(); ?>_bgcolor').val('#' + hex);
                                                        $('#cp_col_<?php echo $mb->get_the_index(); ?>_bgcolor div').css({'backgroundColor': '#' + hex});
                                                        $('#cp_col_<?php echo $mb->get_the_index(); ?>_bgcolor').prev('input').attr('value', '#' + hex);
                                                    }
                                                }).bind('keyup', function () {
                                                    $(this).ColorPickerSetColor(this.value);
                                                });

                                                $('#col_<?php echo $mb->get_the_index(); ?>_hovercolor').ColorPicker({

                                                    onSubmit: function (hsb, hex, rgb) {
                                                        $('#col_<?php echo $mb->get_the_index(); ?>_hovercolor').val('#' + hex);
                                                    },
                                                    onBeforeShow: function () {
                                                        $(this).ColorPickerSetColor(this.value);
                                                        return false;
                                                    },
                                                    onChange: function (hsb, hex, rgb) {
                                                        $('#col_<?php echo $mb->get_the_index(); ?>_hovercolor').val('#' + hex);
                                                        $('#cp_col_<?php echo $mb->get_the_index(); ?>_hovercolor div').css({'backgroundColor': '#' + hex});
                                                        $('#cp_col_<?php echo $mb->get_the_index(); ?>_hovercolor').prev('input').attr('value', '#' + hex);
                                                    }
                                                }).bind('keyup', function () {
                                                    $(this).ColorPickerSetColor(this.value);
                                                });

                                                $('#col_<?php echo $mb->get_the_index(); ?>_textcolor').ColorPicker({

                                                    onSubmit: function (hsb, hex, rgb) {
                                                        $('#col_<?php echo $mb->get_the_index(); ?>_textcolor').val('#' + hex);
                                                    },
                                                    onBeforeShow: function () {
                                                        $(this).ColorPickerSetColor(this.value);
                                                        return false;
                                                    },
                                                    onChange: function (hsb, hex, rgb) {
                                                        $('#col_<?php echo $mb->get_the_index(); ?>_textcolor').val('#' + hex);
                                                        $('#cp_col_<?php echo $mb->get_the_index(); ?>_textcolor div').css({'backgroundColor': '#' + hex});
                                                        $('#cp_col_<?php echo $mb->get_the_index(); ?>_textcolor').prev('input').attr('value', '#' + hex);
                                                    }
                                                }).bind('keyup', function () {
                                                    $(this).ColorPickerSetColor(this.value);
                                                });

                                                $('#col_<?php echo $mb->get_the_index(); ?>_texthovercolor').ColorPicker({

                                                    onSubmit: function (hsb, hex, rgb) {
                                                        $('#col_<?php echo $mb->get_the_index(); ?>_texthovercolor').val('#' + hex);
                                                    },
                                                    onBeforeShow: function () {
                                                        $(this).ColorPickerSetColor(this.value);
                                                        return false;
                                                    },
                                                    onChange: function (hsb, hex, rgb) {
                                                        $('#col_<?php echo $mb->get_the_index(); ?>_texthovercolor').val('#' + hex);
                                                        $('#cp_col_<?php echo $mb->get_the_index(); ?>_texthovercolor div').css({'backgroundColor': '#' + hex});
                                                        $('#cp_col_<?php echo $mb->get_the_index(); ?>_texthovercolor').prev('input').attr('value', '#' + hex);
                                                    }
                                                }).bind('keyup', function () {
                                                    $(this).ColorPickerSetColor(this.value);
                                                });

                                            });
                                        </script>

                                        <div class="colorform">
                                            <?php $mb->the_field('col_box_bgcolor'); ?>
                                            <label class="cp_box_label"><?php _e('Background Color', UT_THEME_NAME); ?></label>

                                            <div id="cp_col_<?php echo $mb->get_the_index(); ?>_bgcolor" class="cp_box">
                                                <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                </div>
                                            </div>

                                            <input id="col_<?php echo $mb->get_the_index(); ?>_bgcolor" type="text"
                                                   name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                                        </div>

                                        <div class="colorform">
                                            <?php $mb->the_field('col_box_hovercolor'); ?>
                                            <label class="cp_box_label"><?php _e('Background Hover Color', UT_THEME_NAME); ?></label>

                                            <div id="cp_col_<?php echo $mb->get_the_index(); ?>_hovercolor"
                                                 class="cp_box">
                                                <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                </div>
                                            </div>

                                            <input id="col_<?php echo $mb->get_the_index(); ?>_hovercolor" type="text"
                                                   name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                                        </div>

                                        <div class="colorform">
                                            <?php $mb->the_field('col_box_textcolor'); ?>
                                            <label class="cp_box_label"><?php _e('Text Color', UT_THEME_NAME); ?></label>

                                            <div id="cp_col_<?php echo $mb->get_the_index(); ?>_textcolor"
                                                 class="cp_box">
                                                <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                </div>
                                            </div>

                                            <input id="col_<?php echo $mb->get_the_index(); ?>_textcolor" type="text"
                                                   name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                                        </div>

                                        <div class="colorform">
                                            <?php $mb->the_field('col_box_texthovercolor'); ?>
                                            <label class="cp_box_label"><?php _e('Text Hover Color', UT_THEME_NAME); ?></label>

                                            <div id="cp_col_<?php echo $mb->get_the_index(); ?>_texthovercolor"
                                                 class="cp_box">
                                                <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                </div>
                                            </div>

                                            <input id="col_<?php echo $mb->get_the_index(); ?>_texthovercolor"
                                                   type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </div>

                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Testimonial
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="testimonial single_item">

                                        <p>
                                            <?php $mb->the_field('author_image'); ?>
                                            <?php $wpalchemy_media_access->setGroupName('img-auth' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

                                            <img class="frame" src="<?php if ($mb->get_the_value()) {
                                                echo aq_resize($mb->get_the_value(), 75, 75, true);
                                            } ?>"/>

                                            <label><?php _e('Author Image', UT_THEME_NAME); ?></label>
                                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('Image size should be 200x200', UT_THEME_NAME); ?>)</span>
                                            <br/>
                                            <?php echo $wpalchemy_media_access->getButton(); ?>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('author_name'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Author Name', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </p>

                                        <p>
                                            <label><?php _e('Comment', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('author_comment'); ?>
                                            <textarea name="<?php $mb->the_name(); ?>" rows="8"
                                                      cols="75"><?php $mb->the_value(); ?></textarea>
                                            <br/><span
                                                    class="info badge badge-info">(<?php _e('This field accepts shortcodes', UT_THEME_NAME); ?>)</span>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('author_company'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Testimonial Authors Company', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </p>

                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Testimonial Carousel
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="testimonialcarousel single_item">

                                        <p>
                                            <label><?php _e('Choose Testimonials Page', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('testimonialcarousel'); ?>
                                            <select name="<?php $mb->the_name(); ?>">

                                                <?php $pages = query_posts(array(
                                                    'post_type' => 'page',
                                                    'meta_key' => '_wp_page_template',
                                                    'meta_value' => 'template-testimonials.php',
                                                    'meta_compare' => '=='
                                                ));

                                                if ($pages) {
                                                    echo '<option value="">-- Choose One --</option>';
                                                    foreach ($pages as $page) {
                                                        //create option
                                                        echo '<option value="' . $page->ID . '" ' . $mb->get_the_select_state($page->ID) . '>' . $page->post_title . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="0">' . __('No Pages Available', UT_THEME_NAME) . '</option>';
                                                } ?>

                                            </select>
                                            <br/>
                                            <span class="info badge badge-info"><?php _e('Choose Testimonials from an existing <br /> Testimonials Template Page', UT_THEME_NAME); ?></span>
                                        </p>

                                        <div class="btn-group">

                                            <label><?php _e('Autoplay Testimonials', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('testimonials_autoplay'); ?>

                                            <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                            <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                            <button data-state="testimonials_autoplay_on"
                                                    class="btn <?php echo $activestate; ?> radio_active" type="button"
                                                    value="on"><?php _e('yes', UT_THEME_NAME); ?></button>
                                            <input id="testimonials_autoplay_on" type="radio" value="on"
                                                   name="<?php $mb->the_name(); ?>" style="display:none;"
                                                   class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>

                                            <button data-state="testimonials_autoplay_off"
                                                    class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                    type="button" value="off"><?php _e('no', UT_THEME_NAME); ?></button>
                                            <input id="testimonials_autoplay_off" type="radio" value="off"
                                                   name="<?php $mb->the_name(); ?>" style="display:none;"
                                                   class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                        </div>

                                        <p>
                                            <?php $mb->the_field('testimonial_time'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Playtime in miliseconds', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </p>

                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Pricing Table
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="pricing_table single_item">

                                        <p>
                                            <label><?php _e('Choose Pricing Table', UT_THEME_NAME); ?></label>

                                            <?php $mb->the_field('pricing_table'); ?>
                                            <select name="<?php $mb->the_name(); ?>">
                                                <option value=""><?php _e('Choose Pricing Table', UT_THEME_NAME); ?></option>
                                                <?php

                                                global $wpdb;

                                                $table_name = $wpdb->base_prefix . "lambda_tables";
                                                $slidedata = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");

                                                foreach ($slidedata as $singledata) {
                                                    echo "<option value='" . $singledata->id . "' name='" . $singledata->table_name . "' " . $mb->get_the_select_state($singledata->id) . ">" . $singledata->table_name . "</option>";
                                                }

                                                ?>
                                            </select>
                                        </p>

                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Portfolio Excerpt
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="portfolio_excerpt single_item">

                                        <p>
                                            <?php $mb->the_field('portfolio_headline'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Headline', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('portfolio_count'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Load the last x items out of the portfolio', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('portfolio_grid'); ?>
                                            <label><?php _e('Portfolio Column Layout', UT_THEME_NAME); ?></label>
                                            <select name="<?php $mb->the_name(); ?>" class="select_testimonial_color">
                                                <option value=""><?php _e('Select Column Layout ...', UT_THEME_NAME); ?></option>
                                                <option value="one_half"<?php $mb->the_select_state('one_half'); ?>><?php _e('2 Columns', UT_THEME_NAME); ?></option>
                                                <option value="one_third"<?php $mb->the_select_state('one_third'); ?>><?php _e('3 Columns', UT_THEME_NAME); ?></option>
                                                <option value="one_fourth"<?php $mb->the_select_state('one_fourth'); ?>><?php _e('4 Columns', UT_THEME_NAME); ?></option>
                                            </select>
                                        </p>

                                        <p>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Display items out of the following category', UT_THEME_NAME); ?></label>
                                            <?php

                                            $taxonomys = get_terms('project-type', array(
                                                'hide_empty' => 0,
                                            ));

                                            if (is_array($taxonomys) && !empty($taxonomys)) {
                                                foreach ($taxonomys as $key => $item): ?>

                                                    <?php $mb->the_field('project_type', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
                                                    <input type="checkbox" name="<?php $mb->the_name(); ?>"
                                                           value="<?php echo $taxonomys[$key]->slug; ?>"<?php $mb->the_checkbox_state($taxonomys[$key]->slug); ?>/>
                                                    <?php echo $taxonomys[$key]->name; ?><br/>

                                                <?php endforeach;
                                            } else {
                                                echo '<div class="alert">' . __('No Portfolio Categories created yet!', UT_THEME_NAME) . '</div>';
                                            } ?>
                                        </p>


                                        <div class="btn-group">

                                            <label><?php _e('Show Portfolio Item Title', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('portfolio_item_title'); ?>

                                            <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                            <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                            <button data-state="portfolio_item_title_pb_on"
                                                    class="btn <?php echo $activestate; ?> radio_active" type="button"
                                                    value="on"><?php _e('on', UT_THEME_NAME); ?></button>
                                            <input id="portfolio_item_title_pb_on" type="radio" value="on"
                                                   name="<?php $mb->the_name(); ?>" style="display:none;"
                                                   class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                            <button data-state="portfolio_item_title_pb_off"
                                                    class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                    type="button"
                                                    value="off"><?php _e('off', UT_THEME_NAME); ?></button>
                                            <input id="portfolio_item_title_pb_off" type="radio" value="off"
                                                   name="<?php $mb->the_name(); ?>" style="display:none;"
                                                   class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                        </div>

                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Blog
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="blog_excerpt single_item">

                                        <div class="btn-group">

                                            <label><?php _e('Activate featured Images?', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('activate_blog_images'); ?>

                                            <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                            <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                            <button data-state="activate_images_pb_on"
                                                    class="btn <?php echo $activestate; ?> radio_active" type="button"
                                                    value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                            <input id="activate_images_pb_on" type="radio" value="on"
                                                   name="<?php $mb->the_name(); ?>" style="display:none;"
                                                   class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                            <button data-state="activate_images_pb_off"
                                                    class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                    type="button"
                                                    value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                            <input id="activate_images_pb_off" type="radio" value="off"
                                                   name="<?php $mb->the_name(); ?>" style="display:none;"
                                                   class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                        </div>

                                        <hr/>

                                        <div class="btn-group">

                                            <label><?php _e('Activate Blog Excerpt', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('activate_blog_excerpt'); ?>

                                            <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                            <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                            <button data-state="activate_blog_excerpt_pb_on"
                                                    class="btn <?php echo $activestate; ?> radio_active" type="button"
                                                    value="on"><?php _e('on', UT_THEME_NAME); ?></button>
                                            <input id="activate_blog_excerpt_pb_on" type="radio" value="on"
                                                   name="<?php $mb->the_name(); ?>" style="display:none;"
                                                   class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                            <button data-state="activate_blog_excerpt_pb_off"
                                                    class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                    type="button"
                                                    value="off"><?php _e('off', UT_THEME_NAME); ?></button>
                                            <input id="activate_blog_excerpt_pb_off" type="radio" value="off"
                                                   name="<?php $mb->the_name(); ?>" style="display:none;"
                                                   class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                        </div>

                                        <hr/>

                                        <p>
                                            <?php $mb->the_field('blog_grid'); ?>
                                            <label><?php _e('Blog Column Layout', UT_THEME_NAME); ?></label>
                                            <select name="<?php $mb->the_name(); ?>" class="select_testimonial_color">
                                                <option value=""><?php _e('Select Column Layout ...', UT_THEME_NAME); ?></option>
                                                <option value="full-width"<?php $mb->the_select_state('full-width'); ?>><?php _e('Full Width', UT_THEME_NAME); ?></option>
                                                <option value="one_half"<?php $mb->the_select_state('one_half'); ?>><?php _e('2 Columns', UT_THEME_NAME); ?></option>
                                                <option value="one_third"<?php $mb->the_select_state('one_third'); ?>><?php _e('3 Columns', UT_THEME_NAME); ?></option>
                                                <option value="one_fourth"<?php $mb->the_select_state('one_fourth'); ?>><?php _e('4 Columns', UT_THEME_NAME); ?></option>
                                            </select>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('blog_excerpt_length'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Excerpt length', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('for example: 55', UT_THEME_NAME); ?>)</span>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('blog_length'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Blog length', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('how many items to display? for example: 6', UT_THEME_NAME); ?>)</span>
                                        </p>

                                        <hr/>

                                        <p>
                                            <?php $mb->the_field('post_not_in', WPALCHEMY_FIELD_HINT_SELECT_MULTI); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Exclude Post (optional)', UT_THEME_NAME); ?></label>
                                            <select name="<?php $mb->the_name(); ?>" class="select_post_not_in"
                                                    multiple="multiple">

                                                <?php $pcposts = &get_posts(array('numberposts' => -1, 'orderby' => 'date'));

                                                if ($pcposts) {
                                                    echo '<option value="">' . __('Choose posts to exclude', UT_THEME_NAME) . '</option>';
                                                    foreach ($pcposts as $pcpost) {
                                                        echo '<option value="' . $pcpost->ID . '" ' . $mb->get_the_select_state($pcpost->ID) . '>' . $pcpost->post_title . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="0">' . __('No Pages Available', UT_THEME_NAME) . '</option>';
                                                }

                                                ?>

                                            </select>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('use shift or control to select multiple items', UT_THEME_NAME); ?>)</span>
                                        </p>

                                        <hr/>

                                        <p>
                                            <?php $mb->the_field('only_category', WPALCHEMY_FIELD_HINT_SELECT_MULTI); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Show only Posts of this category (optional)', UT_THEME_NAME); ?></label>
                                            <select name="<?php $mb->the_name(); ?>" class="select_only_category" multiple="multiple">

                                                <?php $categories = &get_categories(array('hide_empty' => false));

                                                if ($categories) {
                                                    echo '<option value="">' . __('Choose', UT_THEME_NAME) . '</option>';
                                                    foreach ($categories as $category) {
                                                        echo '<option value="' . $category->term_id . '" ' . $mb->get_the_select_state($category->term_id) . '>' . $category->name . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="0">' . __('No Categories Available', UT_THEME_NAME) . '</option>';
                                                } ?>
                                            </select>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('use shift or control to select multiple items', UT_THEME_NAME); ?>)</span>
                                        </p>


                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Google Map
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="google_map single_item">

                                        <p>
                                            <?php $mb->the_field('map_address'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Address to display', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('for example: 100 Biscayne Blvd. Florida 33148', UT_THEME_NAME); ?>)</span>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('map_zoom'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Zoom', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                            <br/><span
                                                    class="info badge badge-info">(<?php _e('for example: 14', UT_THEME_NAME); ?>)</span>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('map_height'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Map height', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('for example: 300', UT_THEME_NAME); ?>)</span>
                                        </p>

                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Call to Action
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="call_to_action single_item">

                                        <p>
                                            <?php $mb->the_field('cta_headline'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('CTA Headline', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('Headline for CTA Field', UT_THEME_NAME); ?>)</span>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('cta_buttontext'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Buttontext', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('optional', UT_THEME_NAME); ?>)</span>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('cta_buttonlink'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Buttonlink', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('optional', UT_THEME_NAME); ?>)</span>
                                        </p>

                                        <p>
                                            <?php $mb->the_field('cta_content'); ?>
                                            <label><?php _e('Content', UT_THEME_NAME); ?></label>
                                            <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                                      class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                        </p>

                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Sidebar Widget
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="sidebarwidget single_item">

                                        <label class="metalabel"><?php _e('Choose Sidebar to display', UT_THEME_NAME); ?></label>
                                        <p>
                                            <?php $mb->the_field('sidebar'); ?>
                                            <select name="<?php $mb->the_name(); ?>">
                                                <?php
                                                if (is_array($wp_registered_sidebars)) {
                                                    foreach ($wp_registered_sidebars as $sidebarkey => $sidebardetails) { ?>
                                                        <option value="<?php echo $sidebarkey; ?>"<?php $mb->the_select_state($sidebarkey); ?>> <?php echo esc_html($sidebardetails['name']); ?> </option>
                                                        <?php
                                                    } //end foreach
                                                } //endif is array ?>
                                            </select>
                                        </p>

                                    </div>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Client Box
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="clientbox single_item">

                                        <p>
                                            <?php $mb->the_field('client_load_last'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Load last X client logos', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </p>

                                        <p>
                                            <label><?php _e('Choose Client Page', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('home_client_page'); ?>
                                            <select name="<?php $mb->the_name(); ?>">

                                                <?php $pages = query_posts(array(
                                                    'post_type' => 'page',
                                                    'meta_key' => '_wp_page_template',
                                                    'meta_value' => 'template-clients.php',
                                                    'meta_compare' => '=='
                                                ));

                                                if ($pages) {
                                                    echo '<option value="">-- Choose One --</option>';
                                                    foreach ($pages as $page) {
                                                        //create option
                                                        echo '<option value="' . $page->ID . '" ' . $mb->get_the_select_state($page->ID) . '>' . $page->post_title . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="0">No Pages Available</option>';
                                                } ?>

                                            </select>
                                            <br/>
                                            <span class="info badge badge-info"><?php _e('Choose Clients from an existing <br /> Client Template', UT_THEME_NAME); ?></span>
                                        </p>

                                    </div>

                                </div>

                                <button type="button" class="doclose btn btn-mini btn-success right">
                                    <i class="icon-ok icon-white"></i>
                                </button>

                            </div>

                            <?php $mb->the_group_close(); ?>
                            <?php endwhile; ?>

                        <div class="clear"></div>
                        <div class="backdrop"></div>

                    </div>
                </div><!-- /#pagetool -->
            </div><!-- /#pagetoolwrap -->
        <?php endif; //pagetool ?>


        <?php
        #-----------------------------------------------------------------
        # Page Settings
        #-----------------------------------------------------------------
        ?>
        <div id="page-settings" class="page-settings tab-pane">
            <div class="ui-panelcontent">

                <div class="container block">

                    <div class="meta-headline">
                        <h1><?php _e('Page Settings', UT_THEME_NAME); ?></h1>
                        <div class="clear"></div>
                    </div>

                    <div class="sixteen columns">

                        <?php if (get_post_type($post->ID) != UT_PORTFOLIO_SLUG) : ?>

                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <i class="icon-indent-right icon-black"></i>
                                    <?php _e('Sidebar Settings', UT_THEME_NAME); ?>
                                </div>
                            </div>

                            <div class="lambda-settings-pad">
                                <label class="metalabel"><?php _e('Choose Main Sidebar', UT_THEME_NAME); ?></label>
                                <p>
                                    <?php $mb->the_field('sidebar'); ?>
                                    <select name="<?php $mb->the_name(); ?>">
                                        <?php

                                        if (is_array($wp_registered_sidebars)) {
                                            foreach ($wp_registered_sidebars as $sidebarkey => $sidebardetails) { ?>

                                                <option value="<?php echo $sidebarkey; ?>"<?php $mb->the_select_state($sidebarkey); ?>> <?php echo esc_html($sidebardetails['name']); ?> </option>

                                                <?php
                                            } //end foreach
                                        } //endif is array ?>

                                    </select>
                                    <br/>
                                    <span class="info badge badge-info">(<?php _e('overwrites the default sidebar', UT_THEME_NAME); ?>)</span>
                                </p>


                                <label class="metalabel"><?php _e('Choose Second Sidebar', UT_THEME_NAME); ?></label>
                                <p>
                                    <?php $mb->the_field('sidebar_second'); ?>
                                    <select name="<?php $mb->the_name(); ?>">
                                        <?php

                                        if (is_array($wp_registered_sidebars)) {
                                            foreach ($wp_registered_sidebars as $sidebarkey => $sidebardetails) { ?>

                                                <option value="<?php echo $sidebarkey; ?>"<?php $mb->the_select_state($sidebarkey); ?>> <?php echo esc_html($sidebardetails['name']); ?> </option>

                                                <?php
                                            } //end foreach
                                        } //endif is array ?>

                                    </select>
                                    <br/>
                                    <span class="info badge badge-info">(<?php _e('only available when you choose <br /> Sidebar Alignment both', UT_THEME_NAME); ?>)</span>
                                </p>


                                <label class="metalabel"><?php _e('Sidebar Alignment', UT_THEME_NAME); ?></label>
                                <p>
                                    <?php $mb->the_field('sidebar_align'); ?>
                                    <select name="<?php $mb->the_name(); ?>">
                                        <option value="right" <?php $mb->the_select_state('right'); ?>> <?php _e('right', UT_THEME_NAME); ?> </option>
                                        <option value="left" <?php $mb->the_select_state('left'); ?>> <?php _e('left', UT_THEME_NAME); ?> </option>
                                        <option value="both" <?php $mb->the_select_state('both'); ?>> <?php _e('both', UT_THEME_NAME); ?> </option>
                                    </select>
                                    <br/>
                                    <span class="info badge badge-info">(<?php _e('optional - not available in all templates!', UT_THEME_NAME); ?>)</span>
                                </p>

                            </div>

                        <?php endif; ?>

                        <?php if (get_post_type($post->ID) == 'post') { ?>

                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <i class="icon-indent-left icon-black"></i>
                                    <?php _e('Show Hide Author Box', UT_THEME_NAME); ?>
                                </div>
                            </div>

                            <div class="lambda-settings-pad">
                                <div class="btn-group">

                                    <?php $mb->the_field('hide_authorbox'); ?>

                                    <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                    <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                    <button data-state="hide_authorbox_on"
                                            class="btn <?php echo $activestate; ?> radio_active" type="button"
                                            value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                    <input id="hide_authorbox_on" type="radio" value="on"
                                           name="<?php $mb->the_name(); ?>" style="display:none;"
                                           class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                    <button data-state="hide_authorbox_off"
                                            class="btn <?php echo $deactivestate; ?> radio_inactive" type="button"
                                            value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                    <input id="hide_authorbox_off" type="radio" value="off"
                                           name="<?php $mb->the_name(); ?>" style="display:none;"
                                           class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>

        <?php if (get_post_type($post->ID) == 'page') { ?>


            <?php
            #-----------------------------------------------------------------
            # Portfolio Settings
            #-----------------------------------------------------------------
            ?>
            <div id="portfolio-settings" class="portfolio-settings tab-pane">

                <div class="lambda_overlay"></div>

                <div class="ui-panelcontent">

                    <div class="container block">

                        <div class="meta-headline">
                            <h1><?php _e('Portfolio Settings', UT_THEME_NAME); ?></h1>
                            <div class="clear"></div>
                        </div>

                        <div class="sixteen columns">
                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <span class="miniicon">
                                        <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/tag_green.png">
                                    </span>
                                    <?php _e('Choose Project Types', UT_THEME_NAME); ?>
                                </div>
                            </div>
                            <div class="lambda-settings-pad">
                                <p>
                                    <?php

                                    $taxonomys = get_terms('project-type', array(
                                        'hide_empty' => 0,
                                    ));

                                    if (is_array($taxonomys) && !empty($taxonomys)) {
                                        foreach ($taxonomys as $key => $item): ?>

                                            <?php $mb->the_field('cb_project_type', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
                                            <input type="checkbox" name="<?php $mb->the_name(); ?>"
                                                   value="<?php echo $taxonomys[$key]->slug; ?>"<?php $mb->the_checkbox_state($taxonomys[$key]->slug); ?>/>
                                            <?php echo $taxonomys[$key]->name; ?><br/>

                                        <?php endforeach;
                                    } else {
                                        echo '<div class="alert">' . __('No Portfolio Categories created yet!', UT_THEME_NAME) . '</div>';
                                    } ?>
                                </p>

                                <small>(<?php _e('show only projects of the checked type in this portfolio page', UT_THEME_NAME); ?>)</small>
                            </div>


                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <span class="miniicon">
                                        <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/application_tile_horizontal.png">
                                    </span>
                                    <?php _e('Portfolio Column Layout', UT_THEME_NAME); ?>
                                </div>
                            </div>

                            <div class="lambda-settings-pad">
                                <?php $c_layouts = array('2column' => array('name' => __('Portfolio 2 Column', UT_THEME_NAME),
                                    'value' => '2',
                                    'id' => 'portfolio_two_column'),
                                    '3column' => array('name' => __('Portfolio 3 Column', UT_THEME_NAME),
                                        'value' => '3',
                                        'id' => 'portfolio_three_column'),
                                    '4column' => array('name' => __('Portfolio 4 Column', UT_THEME_NAME),
                                        'value' => '4',
                                        'id' => 'portfolio_four_column')); ?>

                                <p>
                                    <ul class="c_layouts">
                                        <?php foreach ($c_layouts as $i => $c_layout): ?>
                                            <?php $mb->the_field(UT_THEME_INITIAL . 'column_layout'); ?>
                                            <li>
                                                <label class="radioimage" for="<?php echo $c_layout['id']; ?>">
                                                    <img src="<?php echo $theme_path; ?>/lambda/assets/images/<?php echo $c_layout['id']; ?>.png"
                                                         alt="<?php echo $c_layout['id']; ?>">
                                                </label>
                                                <br/>
                                                <input style="margin-right:10px;" type="radio"
                                                       name="<?php $mb->the_name(); ?>" id="<?php echo $c_layout['id']; ?>"
                                                       value="<?php echo $c_layout['value']; ?>"<?php $mb->the_radio_state($c_layout['value']); ?>><?php echo $c_layout['name']; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </p>

                                <hr/>

                                <div class="btn-group">

                                    <label><?php _e('Show / Hide Filter', UT_THEME_NAME); ?></label>
                                    <?php $mb->the_field('activate_portfolio_filter'); ?>

                                    <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                    <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                    <button data-state="activate_portfolio_filter_on"
                                            class="btn <?php echo $activestate; ?> radio_active" type="button"
                                            value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                    <input id="activate_portfolio_filter_on" type="radio" value="on"
                                           name="<?php $mb->the_name(); ?>" style="display:none;"
                                           class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                    <button data-state="activate_portfolio_filter_off"
                                            class="btn <?php echo $deactivestate; ?> radio_inactive" type="button"
                                            value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                    <input id="activate_portfolio_filter_off" type="radio" value="off"
                                           name="<?php $mb->the_name(); ?>" style="display:none;"
                                           class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>
                                </div>

                                <p>
                                    <label><?php _e('Portfolio Items per Page', UT_THEME_NAME); ?></label>
                                    <?php $mb->the_field('posts_per_page'); ?>
                                    <input type="text" name="<?php $mb->the_name(); ?>"
                                           value="<?php $mb->the_value(); ?>"/>
                                    <br/>
                                    <span class="info badge badge-info">(<?php _e('default: 9', UT_THEME_NAME); ?>)</span>
                                </p>


                                <p>
                                    <label><?php _e('Pagination: previous text', UT_THEME_NAME); ?></label>
                                    <?php $mb->the_field('portfolio_pre_text'); ?>
                                    <input type="text" name="<?php $mb->the_name(); ?>"
                                           value="<?php $mb->the_value(); ?>"/>
                                    <br/>
                                    <span class="info badge badge-info">(<?php _e('Text for "prev works" link.', UT_THEME_NAME); ?>)</span>
                                </p>


                                <p>
                                    <label><?php _e('Pagination: next text', UT_THEME_NAME); ?></label>
                                    <?php $mb->the_field('portfolio_next_text'); ?>
                                    <input type="text" name="<?php $mb->the_name(); ?>"
                                           value="<?php $mb->the_value(); ?>"/>
                                    <br/>
                                    <span class="info badge badge-info">(<?php _e('Text for "next works" link.', UT_THEME_NAME); ?>)</span>
                                </p>

                            </div>

                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <span class="miniicon">
                                        <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/application_tile_horizontal.png">
                                    </span>
                                    <?php _e('Portfolio Item Title', UT_THEME_NAME); ?>
                                </div>
                            </div>

                            <div class="lambda-settings-pad">

                                <div class="btn-group">

                                    <label><?php _e('Show Portfolio Item Title', UT_THEME_NAME); ?></label>
                                    <?php $mb->the_field('portfolio_item_title'); ?>

                                    <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                    <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                    <button data-state="portfolio_item_title_on"
                                            class="btn <?php echo $activestate; ?> radio_active" type="button"
                                            value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                    <input id="portfolio_item_title_on" type="radio" value="on"
                                           name="<?php $mb->the_name(); ?>" style="display:none;"
                                           class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                    <button data-state="portfolio_item_title_off"
                                            class="btn <?php echo $deactivestate; ?> radio_inactive" type="button"
                                            value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                    <input id="portfolio_item_title_off" type="radio" value="off"
                                           name="<?php $mb->the_name(); ?>" style="display:none;"
                                           class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


        <?php
        #-----------------------------------------------------------------
        # Post Format Settings
        #-----------------------------------------------------------------
        ?>

        <?php if (get_post_type($post->ID) == 'post') { ?>
            <div id="postformat-settings" class="postformat-settings tab-pane">

                <div class="lambda_overlay"></div>

                <div class="ui-panelcontent">

                    <div class="container block">

                        <div class="meta-headline">
                            <h1><?php _e('Post Format Settings', UT_THEME_NAME); ?></h1>
                            <div class="clear"></div>
                        </div>

                        <div class="sixteen columns">

                            <div id="lambda-post-format-link" class="postf_box">


                                <?php
                                #-----------------------------------------------------------------
                                # Post Format: Link
                                #-----------------------------------------------------------------
                                ?>
                                <div class="post_format_link">
                                    <div class="lambda-opttitle">
                                        <div class="lambda-opttitle-pad">
                                            <span class="miniicon">
                                                <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/link.png">
                                            </span>
                                            <?php _e('Link', UT_THEME_NAME); ?>
                                        </div>
                                    </div>
                                    <div class="lambda-settings-pad">
                                        <p>
                                            <label><?php _e('Share a link!', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('post_format_link'); ?>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <?php
                            #-----------------------------------------------------------------
                            # Post Format: Quote
                            #-----------------------------------------------------------------
                            ?>
                            <div id="lambda-post-format-quote" class="postf_box">
                                <div class="post_format_quote">
                                    <div class="lambda-opttitle">
                                        <div class="lambda-opttitle-pad">
                                            <span class="miniicon">
                                                <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/text_dropcaps.png">
                                            </span>
                                            <?php _e('Quote', UT_THEME_NAME); ?>
                                        </div>
                                    </div>
                                    <div class="lambda-settings-pad">
                                        <p>
                                            <label><?php _e('Share a Quote!', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('post_format_quote'); ?>
                                            <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="85"
                                                      class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <?php
                            #-----------------------------------------------------------------
                            # Post Format: Video
                            #-----------------------------------------------------------------
                            ?>
                            <div id="lambda-post-format-video" class="postf_box">
                                <div class="post_format_video">
                                    <div class="lambda-opttitle">
                                        <div class="lambda-opttitle-pad">
                                            <span class="miniicon">
                                                <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/video.png">
                                            </span>
                                            <?php _e('Video Details', UT_THEME_NAME); ?>
                                        </div>
                                    </div>
                                    <div class="lambda-settings-pad">

                                        <p>
                                            <?php $mb->the_field('nonverbla_url'); ?>
                                            <?php $wpalchemy_media_access->setGroupName('nonverbla_url' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                            <label><?php _e('Upload Video', UT_THEME_NAME); ?></label>
                                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('can be .mov, .flv', UT_THEME_NAME); ?>)</span>
                                            <br/>
                                            <?php echo $wpalchemy_media_access->getButton(); ?>
                                        </p>


                                        <p>
                                            <?php $mb->the_field('nonverbla_hd_url'); ?>
                                            <?php $wpalchemy_media_access->setGroupName('nonverbla_hd_url' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                            <label><?php _e('Upload HD Video', UT_THEME_NAME); ?></label>
                                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('can be .mov, .flv', UT_THEME_NAME); ?>)</span>
                                            <br/>
                                            <?php echo $wpalchemy_media_access->getButton(); ?>
                                        </p>


                                        <p>
                                            <?php $mb->the_field('mp4_url'); ?>
                                            <?php $wpalchemy_media_access->setGroupName('mp4_url' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                            <label><?php _e('MP4 File URL', UT_THEME_NAME); ?></label>
                                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('The URL to .mp4 video file for Ipad', UT_THEME_NAME); ?>)</span>
                                            <br/>
                                            <?php echo $wpalchemy_media_access->getButton(); ?>
                                        </p>

                                        <p><h4>or</h4></p>

                                        <p>
                                            <label class="metalabel"><?php _e('Embedded Code', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('embedded_code'); ?>
                                            <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                                      class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('Embedded Code', UT_THEME_NAME); ?>)</span>
                                        </p>

                                    </div>
                                </div>
                            </div>


                            <?php
                            #-----------------------------------------------------------------
                            # Post Format: Audio
                            #-----------------------------------------------------------------
                            ?>
                            <div id="lambda-post-format-audio" class="postf_box">
                                <div class="post_format_video">
                                    <div class="lambda-opttitle">
                                        <div class="lambda-opttitle-pad">
                                            <span class="miniicon">
                                                <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/sound.png">
                                            </span>
                                            <?php _e('Audio Details', UT_THEME_NAME); ?>
                                        </div>
                                    </div>
                                    <div class="lambda-settings-pad">

                                        <p>
                                            <label class="metalabel"><?php _e('Soundcloud URL', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('soundcloud_url'); ?>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('The URL to Soundcloud', UT_THEME_NAME); ?>)</span>
                                        </p>

                                        <h4 style="padding-bottom:20px;"><?php _e('or', UT_THEME_NAME) ?></h4>

                                        <p>
                                            <label class="metalabel"><?php _e('MP3 URL', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('mp3_url'); ?>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                            <br/><span class="info badge badge-info">(<?php _e('URL to MP3 file', UT_THEME_NAME); ?>)</span>
                                        </p>

                                        <p>
                                            <label class="metalabel"><?php _e('OGG URL', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('ogg_url'); ?>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('URL to OGG file', UT_THEME_NAME); ?>)</span>
                                        </p>

                                    </div>
                                </div>
                            </div>


                            <?php
                            #-----------------------------------------------------------------
                            # Post Format : Gallery
                            #-----------------------------------------------------------------
                            ?>
                            <div id="lambda-post-format-gallery" class="postf_box no-post-format-options">
                                <div class="no-post-format-options">
                                    <p><?php $mb->the_field('gallery_type'); ?>
                                        <select name="<?php $mb->the_name(); ?>" id="gallery_type">
                                            <option value=""><?php _e('Choose Gallery Type', UT_THEME_NAME); ?></option>
                                            <option value="standard_gallery" <?php $mb->the_select_state('standard_gallery'); ?>> <?php _e('Standard Gallery', UT_THEME_NAME); ?> </option>
                                            <option value="slider_gallery" <?php $mb->the_select_state('slider_gallery'); ?>> <?php _e('Slider Gallery', UT_THEME_NAME); ?> </option>
                                        </select></p>
                                </div>
                            </div>


                            <?php
                            #-----------------------------------------------------------------
                            # All other formats with no additional options
                            #-----------------------------------------------------------------
                            ?>
                            <div id="lambda-post-format-0" class="postf_box no-post-format-options">
                                <div class="no-post-format-options">
                                    <span class="info badge badge-info">
                                        <?php _e('No Post Settings available for this Format!', UT_THEME_INITIAL); ?>
                                    </span>
                                </div>
                            </div>
                            <div id="lambda-post-format-aside" class="postf_box no-post-format-options">
                                <div class="no-post-format-options">
                                    <span class="info badge badge-info">
                                        <?php _e('No Post Settings available for this Format!', UT_THEME_INITIAL); ?>
                                    </span>
                                </div>
                            </div>
                            <div id="lambda-post-format-image" class="postf_box no-post-format-options">
                                <div class="no-post-format-options">
                                    <span class="info badge badge-info">
                                        <?php _e('No Post Settings available for this Format!', UT_THEME_INITIAL); ?>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


        <?php
        #-----------------------------------------------------------------
        # Portfolio Items
        #-----------------------------------------------------------------
        ?>
        <div id="portfolio-items" class="portfolio-items tab-pane">

            <div class="lambda_overlay"></div>

            <div class="ui-panelcontent">

                <div class="container block">

                    <div class="meta-headline">
                        <h1><?php _e('Project Items', UT_THEME_NAME); ?></h1>
                        <div class="clear"></div>
                    </div>

                    <div class="sixteen columns">

                        <div class="lambda-opttitle">
                            <div class="lambda-opttitle-pad">
                                <span class="miniicon">
                                    <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/pencil_go.png">
                                </span>
                                <?php _e('Project Type', UT_THEME_NAME); ?>
                            </div>
                        </div>

                        <div class="lambda-settings-pad">

                            <p>
                                <label class="metalabel"><?php _e('Portfolio Description Title', UT_THEME_NAME); ?></label>
                                <?php $mb->the_field('pcontent_title'); ?>
                                <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                                <br/>
                                <span class="info badge badge-info">(<?php _e('displayed above the portfolio description', UT_THEME_NAME); ?>)</span>
                            </p>

                            <p>
                                <label class="metalabel"><?php _e('Portfolio Type', UT_THEME_NAME); ?></label>
                                <?php $mb->the_field('portfolio_type'); ?>
                                <select name="<?php $mb->the_name(); ?>" id="portfolio_type">
                                    <option value=""><?php _e('Choose Portfolio Type', UT_THEME_NAME); ?></option>
                                    <option value="audio_portfolio" <?php $mb->the_select_state('audio_portfolio'); ?>> <?php _e('Audio', UT_THEME_NAME); ?> </option>
                                    <option value="video_portfolio" <?php $mb->the_select_state('video_portfolio'); ?>> <?php _e('Video', UT_THEME_NAME); ?> </option>
                                    <option value="image_portfolio" <?php $mb->the_select_state('image_portfolio'); ?>> <?php _e('Slider / Gallery', UT_THEME_NAME); ?> </option>
                                    <option value="single_image_portfolio" <?php $mb->the_select_state('single_image_portfolio'); ?>> <?php _e('Single Image', UT_THEME_NAME); ?> </option>
                                </select>
                            </p>
                        </div>


                        <?php
                        #-----------------------------------------------------------------
                        # Portfolio Audio
                        #-----------------------------------------------------------------
                        ?>
                        <div id="audio_portfolio" class="p_box"><!--#audio-->

                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <span class="miniicon">
                                        <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/sound.png">
                                    </span>
                                    <?php _e('Audio Details', UT_THEME_NAME); ?>
                                </div>
                            </div>
                            <div class="lambda-settings-pad">

                                <p>
                                    <label class="metalabel"><?php _e('Soundcloud URL', UT_THEME_NAME); ?></label>
                                    <?php $mb->the_field('portfolio_soundcloud_url'); ?>
                                    <input type="text" name="<?php $mb->the_name(); ?>"
                                           value="<?php $mb->the_value(); ?>"/>
                                    <br/>
                                    <span class="info badge badge-info">(<?php _e('The URL to Soundcloud', UT_THEME_NAME); ?>)</span>
                                </p>

                                <h4 style="padding-bottom:20px;"><?php _e('or', UT_THEME_NAME) ?></h4>

                                <p>
                                    <label class="metalabel"><?php _e('MP3 URL', UT_THEME_NAME); ?></label>
                                    <?php $mb->the_field('portfolio_mp3_url'); ?>
                                    <input type="text" name="<?php $mb->the_name(); ?>"
                                           value="<?php $mb->the_value(); ?>"/>
                                    <br/><span class="info badge badge-info">(<?php _e('URL to MP3 file', UT_THEME_NAME); ?>)</span>
                                </p>

                                <p>
                                    <label class="metalabel"><?php _e('OGG URL', UT_THEME_NAME); ?></label>
                                    <?php $mb->the_field('portfolio_ogg_url'); ?>
                                    <input type="text" name="<?php $mb->the_name(); ?>"
                                           value="<?php $mb->the_value(); ?>"/>
                                    <br/>
                                    <span class="info badge badge-info">(<?php _e('URL to OGG file', UT_THEME_NAME); ?>)</span>
                                </p>

                            </div>
                        </div><!--/#audio-->


                        <?php
                        #-----------------------------------------------------------------
                        # Portfolio Video
                        #-----------------------------------------------------------------
                        ?>
                        <div id="video_portfolio" class="p_box"><!--#video-->

                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <span class="miniicon">
                                        <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/image_add.png">
                                    </span>
                                    <?php _e('Manage your Video', UT_THEME_NAME); ?>
                                    <br/>
                                    <span><?php _e('to build up a video on the project page!', UT_THEME_NAME); ?></span>
                                    <div class="clear"></div>
                                </div>
                            </div>

                            <div class="lambda-settings-pad">

                                <p>
                                    <?php $mb->the_field('nonverbla_url'); ?>
                                    <?php $wpalchemy_media_access->setGroupName('nonverbla_url' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                    <label><?php _e('Upload Video', UT_THEME_NAME); ?></label>
                                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                    <br/>
                                    <span class="info badge badge-info">(<?php _e('can be .mov, .flv', UT_THEME_NAME); ?>)</span>
                                    <br/>
                                    <?php echo $wpalchemy_media_access->getButton(); ?>
                                </p>

                                <p>
                                    <?php $mb->the_field('nonverbla_hd_url'); ?>
                                    <?php $wpalchemy_media_access->setGroupName('nonverbla_hd_url' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                    <label><?php _e('Upload HD Video', UT_THEME_NAME); ?></label>
                                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                    <br/>
                                    <span class="info badge badge-info">(<?php _e('can be .mov, .flv', UT_THEME_NAME); ?>)</span>
                                    <br/>
                                    <?php echo $wpalchemy_media_access->getButton(); ?>
                                </p>

                                <p>
                                    <?php $mb->the_field('poster_image'); ?>
                                    <?php $wpalchemy_media_access->setGroupName('poster_image' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                    <label><?php _e('Poster Image', UT_THEME_NAME); ?></label>
                                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                    <br/>
                                    <span class="info badge badge-info">(<?php _e('should be same size as Video', UT_THEME_NAME); ?>)</span>
                                    <br/>
                                    <?php echo $wpalchemy_media_access->getButton(); ?>
                                </p>

                                <p>
                                    <?php $mb->the_field('mp4_url'); ?>
                                    <?php $wpalchemy_media_access->setGroupName('mp4_url' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                    <label><?php _e('MP4 File URL', UT_THEME_NAME); ?></label>
                                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                    <br/>
                                    <span class="info badge badge-info">(<?php _e('The URL to .mp4 video file for Ipad', UT_THEME_NAME); ?>)</span>
                                    <br/>
                                    <?php echo $wpalchemy_media_access->getButton(); ?>
                                </p>

                                <p><h4>or</h4></p>

                                <p>
                                    <label class="metalabel"><?php _e('Embedded Code', UT_THEME_NAME); ?></label>
                                    <?php $mb->the_field('portfolio_embedded_code'); ?>
                                    <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                              class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                    <br/><span class="info badge badge-info">(<?php _e('Embedded Code', UT_THEME_NAME); ?>)</span>
                                </p>

                            </div><!--/#video-->
                        </div>


                        <?php
                        #-----------------------------------------------------------------
                        # Image Presentation
                        #-----------------------------------------------------------------
                        ?>
                        <div id="image_portfolio" class="p_box"><!--#image-->

                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <span class="miniicon">
                                        <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/image_add.png">
                                    </span>
                                    <?php _e('Gallery Style', UT_THEME_NAME); ?>
                                    <br/>
                                    <span><?php _e('here you can choose the style of your wp gallery', UT_THEME_NAME); ?></span>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="lambda-settings-pad">

                                <p>
                                    <?php $mb->the_field('portfolio_gallery_type'); ?>
                                    <select name="<?php $mb->the_name(); ?>" id="gallery_type">
                                        <option value=""><?php _e('Choose Gallery Type', UT_THEME_NAME); ?></option>
                                        <option value="standard_gallery" <?php $mb->the_select_state('standard_gallery'); ?>> <?php _e('Standard Gallery', UT_THEME_NAME); ?> </option>
                                        <option value="slider_gallery" <?php $mb->the_select_state('slider_gallery'); ?>> <?php _e('Slider Gallery', UT_THEME_NAME); ?> </option>
                                    </select>
                                </p>

                                <p><?php _e('For further informations about how to setup a gallery please have a look here: <a href="http://codex.wordpress.org/Gallery_Shortcode" target="_blank">Gallery Codex</a>', UT_THEME_INITIAL); ?></p>

                            </div>

                        </div><!--/#image-->

                        <div class="lambda-opttitle">
                            <div class="lambda-opttitle-pad">
                                <span class="miniicon">
                                    <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/pencil_go.png">
                                </span>
                                <?php _e('Work Description', UT_THEME_NAME); ?>
                            </div>
                        </div>
                        <div class="lambda-settings-pad">

                            <p><label class="metalabel"><?php _e('Work Description Title', UT_THEME_NAME); ?></label>
                                <?php $mb->the_field('work_title'); ?>
                                <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                                <br/><span
                                        class="info badge badge-info">(<?php _e('displayed above the work description', UT_THEME_NAME); ?>)</span>
                            </p>


                            <label><?php _e('Add Work Description', UT_THEME_NAME); ?></label>

                            <?php while ($mb->have_fields_and_multi(UT_THEME_INITIAL . 'project_atts')): ?>
                                <?php $mb->the_group_open(); ?>

                                <?php $mb->the_field('work_title'); ?>
                                <div class="work_item_name">
                                    <?php if ($mb->get_the_value()) {
                                        $mb->the_value();
                                    } else {
                                        _e('new work description', UT_THEME_NAME);
                                    }; ?>
                                </div>

                                <div class="fancy_box work_item">

                                    <?php $mb->the_field('work_title'); ?>
                                    <label><?php _e('Title and Name / Description', UT_THEME_NAME); ?></label>
                                    <p><input type="text" name="<?php $mb->the_name(); ?>"
                                              value="<?php $mb->the_value(); ?>"/></p>

                                    <?php $mb->the_field('work_desc'); ?>
                                    <p><input type="text" name="<?php $mb->the_name(); ?>"
                                              value="<?php $mb->the_value(); ?>"/></p>

                                    <?php $mb->the_field('is_link'); ?>
                                    <p>
                                        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="disabled"<?php $mb->the_checkbox_state('disabled'); ?>/>
                                        <?php _e('Description is a link', UT_THEME_NAME); ?>
                                    </p>
                                    <a href="#" class="dodelete btn btn-danger">
                                        <?php _e('Remove', UT_THEME_NAME); ?>
                                    </a>

                                </div>

                                <?php $mb->the_group_close(); ?>
                            <?php endwhile; ?>

                            <div class="clear"></div>
                            <p style="margin-bottom:15px; padding-top:5px;">
                                <a href="#" class="docopy-<?php echo UT_THEME_INITIAL . 'project_atts'; ?> btn btn-inverse">
                                    <?php _e('Add Description', UT_THEME_NAME); ?>
                                </a>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (get_post_type($post->ID) != UT_PORTFOLIO_SLUG && get_post_type($post->ID) != 'post' && get_post_type($post->ID) != 'product') : ?>


            <?php
            #-----------------------------------------------------------------
            # Team
            #-----------------------------------------------------------------
            ?>
            <div id="team-settings" class="team-settings tab-pane">

                <div class="lambda_overlay"></div>

                <div class="ui-panelcontent">

                    <div class="container block">

                        <div class="meta-headline">
                            <h1><?php _e('Manage Template', UT_THEME_NAME); ?></h1>
                            <div class="clear"></div>
                        </div>

                        <div class="sixteen columns">

                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <span class="miniicon"><img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/user_add.png"></span>
                                    <?php _e('Add Team Member', UT_THEME_NAME); ?>
                                </div>
                            </div>
                            <div class="lambda-settings-pad">

                                <?php
                                while ($mb->have_fields_and_multi(UT_THEME_INITIAL . 'team_member')): ?>
                                    <?php $mb->the_group_open(); ?>

                                    <?php $mb->the_field('member_name'); ?>
                                    <div class="member_item_name"><?php if ($mb->get_the_value()) {
                                            $mb->the_value();
                                        } else {
                                            _e('new member', UT_THEME_NAME);
                                        }; ?></div>

                                    <div class="fancy_box member_item">

                                        <?php $mb->the_field('member_name'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Member Name', UT_THEME_NAME); ?></label>
                                        <p><input type="text" name="<?php $mb->the_name(); ?>"
                                                  value="<?php $mb->the_value(); ?>"/></p>

                                        <?php $mb->the_field('member_title'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Member Title', UT_THEME_NAME); ?></label>
                                        <p><input type="text" name="<?php $mb->the_name(); ?>"
                                                  value="<?php $mb->the_value(); ?>"/></p>

                                        <?php $mb->the_field('member_pic'); ?>
                                        <?php $wpalchemy_media_access->setGroupName('img-n' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                        <p>

                                            <img src="<?php if (!$mb->get_the_value()) {
                                                echo $theme_path . '/lambda/assets/images/nopic.jpg';
                                            } else {
                                                echo aq_resize($mb->get_the_value(), 140, 140, true);
                                            } ?>" class="image_box slider-n<?php echo $z; ?>"/>

                                            <span class="desc alert alert-neutral"><?php _e('Image Size should be 140x140', UT_THEME_NAME); ?></span>

                                            <label><?php _e('Image URL', UT_THEME_NAME); ?></label>
                                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                            <?php echo $wpalchemy_media_access->getButton(); ?>

                                        </p>

                                        <?php $mb->the_field('member_email'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Member Email', UT_THEME_NAME); ?></label>
                                        <p><input type="text" name="<?php $mb->the_name(); ?>"
                                                  value="<?php $mb->the_value(); ?>"/></p>

                                        <?php $mb->the_field('member_website'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Member Website', UT_THEME_NAME); ?></label>
                                        <p><input type="text" name="<?php $mb->the_name(); ?>"
                                                  value="<?php $mb->the_value(); ?>"/></p>

                                        <?php $mb->the_field('member_twitter'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Member Twitter Account', UT_THEME_NAME); ?></label>
                                        <p><input type="text" name="<?php $mb->the_name(); ?>"
                                                  value="<?php $mb->the_value(); ?>"/></p>

                                        <?php $mb->the_field('member_facebook'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Member Facebook Profile', UT_THEME_NAME); ?></label>
                                        <p><input type="text" name="<?php $mb->the_name(); ?>"
                                                  value="<?php $mb->the_value(); ?>"/></p>

                                        <?php $mb->the_field('member_google'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Member GogolePlus Account', UT_THEME_NAME); ?></label>
                                        <p><input type="text" name="<?php $mb->the_name(); ?>"
                                                  value="<?php $mb->the_value(); ?>"/></p>

                                        <div class="customEditor">
                                            <?php $mb->the_field('member_text'); ?>

                                            <div class="wp-editor-tools">
                                                <div class="custom_upload_buttons hide-if-no-js wp-media-buttons"><?php do_action('media_buttons'); ?></div>
                                            </div>
                                            <textarea id="<?php $mb->the_name(); ?>" cols="50"
                                                      name="<?php $mb->the_name(); ?>"
                                                      class="lambdatextarea"><?php echo wpautop(esc_html($mb->get_the_value())); ?></textarea>
                                        </div>

                                        <div class="clear"></div>

                                        <a href="#" class="dodelete btn btn-danger">
                                            <?php _e('Delete Member', UT_THEME_NAME); ?>
                                        </a>
                                    </div>

                                    <?php $mb->the_group_close(); ?>
                                <?php endwhile; ?>

                                <div class="clear"></div>
                                <p style="margin-bottom:15px; padding-top:5px;">
                                    <a href="#" class="docopy-<?php echo UT_THEME_INITIAL . 'team_member'; ?> btn btn-success">
                                        <?php _e('add new member', UT_THEME_NAME); ?>
                                    </a>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            #-----------------------------------------------------------------
            # FAQ
            #-----------------------------------------------------------------
            ?>
            <div id="faq-settings" class="faq-settings tab-pane">

                <div class="lambda_overlay"></div>

                <div class="ui-panelcontent">

                    <div class="container block">

                        <div class="meta-headline">

                            <h1><?php _e('Manage FAQ', UT_THEME_NAME); ?></h1>
                            <div class="clear"></div>

                        </div>

                        <div class="sixteen columns">

                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <span class="miniicon">
                                        <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/add.png">
                                    </span>
                                    <?php _e('Add FAQ Item', UT_THEME_NAME); ?>
                                </div>
                            </div>
                            <div class="lambda-settings-pad">

                                <?php while ($mb->have_fields_and_multi(UT_THEME_INITIAL . 'faq_items')): ?>
                                    <?php $mb->the_group_open(); ?>

                                    <?php $mb->the_field('faq_question'); ?>
                                    <div class="faq_item_name">
                                        <?php if ($mb->get_the_value()) {
                                            $mb->the_value();
                                        } else {
                                            _e('new question', UT_THEME_NAME);
                                        }; ?>
                                    </div>
                                    <div class="fancy_box faq_item">

                                        <?php $mb->the_field('faq_question'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Question', UT_THEME_NAME); ?></label>
                                        <p><input type="text" name="<?php $mb->the_name(); ?>"
                                                  value="<?php $mb->the_value(); ?>"/></p>

                                        <div class="customEditor">
                                            <?php $mb->the_field('faq_answer'); ?>

                                            <div class="wp-editor-tools">
                                                <div class="custom_upload_buttons hide-if-no-js wp-media-buttons"><?php do_action('media_buttons'); ?></div>
                                            </div>
                                            <textarea id="<?php $mb->the_name(); ?>" rows="10" cols="50"
                                                      name="<?php $mb->the_name(); ?>"
                                                      class="lambdatextarea"><?php echo wpautop(esc_html($mb->get_the_value())); ?></textarea>
                                            <a href="#" class="dodelete btn btn-danger"><?php _e('Delete FAQ', UT_THEME_NAME); ?></a>
                                        </div>

                                    </div>

                                    <?php $mb->the_group_close(); ?>
                                    <?php endwhile; ?>

                                <div class="clear"></div>
                                <p style="margin-bottom:15px; padding-top:5px;">
                                    <a href="#" class="docopy-<?php echo UT_THEME_INITIAL . 'faq_items'; ?> btn btn-success">
                                        <i class="icon-book icon-white"></i>
                                        <?php _e('add new question', UT_THEME_NAME); ?>
                                    </a>
                                </p>

                            </div>

                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <span class="miniicon"></span>
                                    <?php _e('Additional Content to display beneath the FAQ', UT_THEME_NAME); ?>
                                </div>
                            </div>
                            <div class="lambda-settings-pad">

                                <?php $mb->the_field('faq_additional_content');

                                $settings = array(
                                    'textarea_rows' => '20',
                                    'media_buttons' => 'true',
                                    'tabindex' => 2,
                                    'wpautop' => "false"
                                );

                                $val = html_entity_decode($mb->get_the_value());
                                $id = $mb->get_the_name();

                                wp_editor($val, $id, $settings);

                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            #-----------------------------------------------------------------
            # Home
            #-----------------------------------------------------------------
            ?>
            <div id="home-settings" class="home-settings tab-pane">

                <div class="lambda_overlay"></div>

                <div class="ui-panelcontent">

                    <div class="container block">

                        <div class="meta-headline">
                            <h1><?php _e('Manage Home Site', UT_THEME_NAME); ?></h1>
                            <div class="clear"></div>
                        </div>

                        <div class="four columns">

                            <script type="text/javascript">

                                jQuery(document).ready(function ($) {

                                    var $items = $('#home-tabs-titles li a');
                                    $items.click(function () {
                                        $items.removeClass('selected');
                                        $(this).addClass('selected');
                                        var index = $items.index($(this));
                                        $('#home-tabs-contents > div').hide().eq(index).fadeIn();
                                    }).eq(0).click();

                                });

                            </script>

                            <ul id="home-tabs-titles">
                                <li><a><?php _e('Service Boxes', UT_THEME_NAME); ?></a></li>
                                <li><a><?php _e('Service Columns', UT_THEME_NAME); ?></a></li>
                                <li><a><?php _e('Portfolio Items', UT_THEME_NAME); ?></a></li>
                                <li><a><?php _e('Blog Excerpt', UT_THEME_NAME); ?></a></li>
                                <li><a><?php _e('Toggles & Testimonials', UT_THEME_NAME); ?></a></li>
                                <li><a><?php _e('Clients', UT_THEME_NAME); ?></a></li>
                                <li><a><?php _e('Call to Action', UT_THEME_NAME); ?></a></li>
                                <li><a><?php _e('Element Order', UT_THEME_NAME); ?></a></li>
                            </ul>

                        </div><!--Sidebar content-->

                        <div id="home-tabs-contents" class="twelve columns">


                            <?php
                            #-----------------------------------------------------------------
                            # Service Boxes
                            #-----------------------------------------------------------------
                            ?>

                            <div id="home-service-columns" class="home-service-columns tab-pane">

                                <div class="lambda-opttitle">
                                    <div class="lambda-opttitle-pad">
                                        <span class="miniicon">
                                            <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/layout_add.png">
                                        </span>
                                        <?php _e('Service Boxes', UT_THEME_NAME); ?>
                                    </div>
                                </div>
                                <div class="lambda-settings-pad">

                                    <div class="btn-group">

                                        <label><?php _e('Activate Service Boxes', UT_THEME_NAME); ?></label>
                                        <?php $mb->the_field('activate_service_boxes'); ?>

                                        <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                        <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                        <button data-state="activate_service_boxes_on"
                                                class="btn <?php echo $activestate; ?> radio_active" type="button"
                                                value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                        <input id="activate_service_boxes_on" type="radio" value="on"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                        <button data-state="activate_service_boxes_off"
                                                class="btn <?php echo $deactivestate; ?> radio_inactive" type="button"
                                                value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                        <input id="activate_service_boxes_off" type="radio" value="off"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                    </div>

                                    <p><?php $mb->the_field('service_headline'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Service Boxes Headline', UT_THEME_NAME); ?></label>
                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/>
                                    </p>

                                    <hr/>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Service Box 1
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="one_half last">

                                        <div class="servicecolumn">
                                            <div class="navbar">
                                                <div class="navbar-inner">
                                                    <ul class="options_tabs nav">
                                                        <li class="active"><a href="#servicesettings1" data-toggle="tab"><?php _e('Icons and Description', UT_THEME_NAME); ?></a></li>
                                                        <li><a href="#servicestyling1" data-toggle="tab"><?php _e('Styling', UT_THEME_NAME); ?></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="tab-content">

                                                <div id="servicesettings1" class="tab-pane active">

                                                    <div class="btn-group">

                                                        <label><?php _e('Activate Service Column 1', UT_THEME_NAME); ?></label>
                                                        <?php $mb->the_field('activate_col_1'); ?>

                                                        <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                                        <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                                        <button data-state="activate_col_1_on"
                                                                class="btn <?php echo $activestate; ?> radio_active"
                                                                type="button"
                                                                value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                                        <input id="activate_col_1_on" type="radio" value="on"
                                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                                               class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                                        <button data-state="activate_col_1_off"
                                                                class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                                type="button"
                                                                value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                                        <input id="activate_col_1_off" type="radio" value="off"
                                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                                               class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                                    </div>

                                                    <p><?php $mb->the_field('col_1_icon'); ?>
                                                        <?php $wpalchemy_media_access->setGroupName('img-ico-1' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

                                                    <div style="min-height:50px;">
                                                        <img class="frame" src="<?php if ($mb->get_the_value()) {
                                                            echo aq_resize($mb->get_the_value(), 32, 32, true);
                                                        } ?>"/>
                                                    </div>

                                                    <label><?php _e('Icon URL', UT_THEME_NAME); ?></label>
                                                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                                    <br/>
                                                    <span class="info badge badge-info">(<?php _e('Icon size should be 32x32', UT_THEME_NAME); ?>)</span>
                                                    <br/>
                                                    <?php echo $wpalchemy_media_access->getButton(); ?>
                                                    </p>

                                                    <p>
                                                        <?php $mb->the_field('col_1_icon_alt'); ?>
                                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Icon alt', UT_THEME_NAME); ?></label>
                                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>
                                                    </p>

                                                    <p>
                                                        <?php $mb->the_field('col_1_headline'); ?>
                                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Headline', UT_THEME_NAME); ?></label>
                                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>
                                                    </p>

                                                    <p>
                                                        <label><?php _e('Content', UT_THEME_NAME); ?></label>
                                                        <?php $mb->the_field('col_1_content'); ?>
                                                        <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                                                  class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                                        <br/>
                                                        <span class="info badge badge-info">(<?php _e('This field accepts shortcodes', UT_THEME_NAME); ?>)</span>
                                                    </p>

                                                    <p>
                                                        <?php $mb->the_field('col_1_link'); ?>
                                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Link', UT_THEME_NAME); ?></label>
                                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>
                                                    </p>

                                                </div><!-- end servicesetting -->

                                                <div id="servicestyling1" class="tab-pane">

                                                    <script type="text/javascript">
                                                        jQuery(document).ready(function ($) {
                                                            $('#col_1_bgcolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_1_bgcolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_1_bgcolor').val('#' + hex);
                                                                    $('#cp_col_1_bgcolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_1_bgcolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                            $('#col_1_hovercolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_1_hovercolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_1_hovercolor').val('#' + hex);
                                                                    $('#cp_col_1_hovercolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_1_hovercolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                            $('#col_1_textcolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_1_textcolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_1_textcolor').val('#' + hex);
                                                                    $('#cp_col_1_textcolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_1_textcolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                            $('#col_1_texthovercolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_1_texthovercolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_1_texthovercolor').val('#' + hex);
                                                                    $('#cp_col_1_texthovercolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_1_texthovercolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                        });
                                                    </script>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_1_bgcolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Background Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_1_bgcolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                            </div>
                                                        </div>

                                                        <input id="col_1_bgcolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_1_hovercolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Background Hover Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_1_hovercolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                            </div>
                                                        </div>

                                                        <input id="col_1_hovercolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_1_textcolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Text Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_1_textcolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                            </div>
                                                        </div>

                                                        <input id="col_1_textcolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_1_texthovercolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Text Hover Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_1_texthovercolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                            </div>
                                                        </div>

                                                        <input id="col_1_texthovercolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                </div><!-- end servicestyling -->

                                            </div><!-- end tabs -->

                                        </div><!-- end service col -->

                                    </div><!-- end one_half -->


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Service Box 2
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="one_half last">

                                        <div class="servicecolumn">

                                            <div class="navbar">
                                                <div class="navbar-inner">
                                                    <ul class="options_tabs nav">
                                                        <li class="active"><a href="#servicesettings2" data-toggle="tab"><?php _e('Icons and Description', UT_THEME_NAME); ?></a></li>
                                                        <li><a href="#servicestyling2" data-toggle="tab"><?php _e('Styling', UT_THEME_NAME); ?></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="tab-content">

                                                <div id="servicesettings2" class="tab-pane active">

                                                    <div class="btn-group">

                                                        <label><?php _e('Activate Service Column 2', UT_THEME_NAME); ?></label>
                                                        <?php $mb->the_field('activate_col_2'); ?>

                                                        <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                                        <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                                        <button data-state="activate_col_2_on"
                                                                class="btn <?php echo $activestate; ?> radio_active"
                                                                type="button"
                                                                value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                                        <input id="activate_col_2_on" type="radio" value="on"
                                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                                               class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                                        <button data-state="activate_col_2_off"
                                                                class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                                type="button"
                                                                value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                                        <input id="activate_col_2_off" type="radio" value="off"
                                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                                               class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                                    </div>

                                                    <p><?php $mb->the_field('col_2_icon'); ?>
                                                        <?php $wpalchemy_media_access->setGroupName('img-ico-2' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

                                                    <div style="min-height:50px;">
                                                        <img class="frame" src="<?php if ($mb->get_the_value()) {
                                                            echo aq_resize($mb->get_the_value(), 32, 32, true);
                                                        } ?>"/>
                                                    </div>

                                                    <label><?php _e('Icon URL', UT_THEME_NAME); ?></label>
                                                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                                    <br/>
                                                    <span class="info badge badge-info">(<?php _e('Icon size should be 32x32', UT_THEME_NAME); ?>)</span>
                                                    <br/>
                                                    <?php echo $wpalchemy_media_access->getButton(); ?>
                                                    </p>

                                                    <p>
                                                        <?php $mb->the_field('col_2_icon_alt'); ?>
                                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Icon alt', UT_THEME_NAME); ?></label>
                                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>
                                                    </p>

                                                    <p>
                                                        <?php $mb->the_field('col_2_headline'); ?>
                                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Headline', UT_THEME_NAME); ?></label>
                                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>
                                                    </p>

                                                    <p>
                                                        <label><?php _e('Content', UT_THEME_NAME); ?></label>
                                                        <?php $mb->the_field('col_2_content'); ?>
                                                        <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                                                  class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                                        <br/>
                                                        <span class="info badge badge-info">(<?php _e('This field accepts shortcodes', UT_THEME_NAME); ?>)</span>
                                                    </p>

                                                    <p>
                                                        <?php $mb->the_field('col_2_link'); ?>
                                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Link', UT_THEME_NAME); ?></label>
                                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>
                                                    </p>

                                                </div><!-- end servicesetting -->

                                                <div id="servicestyling2" class="tab-pane">

                                                    <script type="text/javascript">
                                                        jQuery(document).ready(function ($) {
                                                            $('#col_2_bgcolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_2_bgcolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_2_bgcolor').val('#' + hex);
                                                                    $('#cp_col_2_bgcolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_2_bgcolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                            $('#col_2_hovercolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_2_hovercolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_2_hovercolor').val('#' + hex);
                                                                    $('#cp_col_2_hovercolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_2_hovercolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                            $('#col_2_textcolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_2_textcolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_2_textcolor').val('#' + hex);
                                                                    $('#cp_col_2_textcolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_2_textcolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                            $('#col_2_texthovercolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_2_texthovercolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_2_texthovercolor').val('#' + hex);
                                                                    $('#cp_col_2_texthovercolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_2_texthovercolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                        });
                                                    </script>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_2_bgcolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Background Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_2_bgcolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                            </div>
                                                        </div>

                                                        <input id="col_2_bgcolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_2_hovercolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Background Hover Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_2_hovercolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                            </div>
                                                        </div>

                                                        <input id="col_2_hovercolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_2_textcolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Text Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_2_textcolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                            </div>
                                                        </div>

                                                        <input id="col_2_textcolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_2_texthovercolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Text Hover Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_2_texthovercolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                            </div>
                                                        </div>

                                                        <input id="col_2_texthovercolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                </div><!-- end servicestyling -->

                                            </div><!-- end tabs -->

                                        </div><!-- end service col -->

                                    </div><!-- end one_half -->


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Service Box 3
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="one_half last">

                                        <div class="servicecolumn">

                                            <div class="navbar">
                                                <div class="navbar-inner">
                                                    <ul class="options_tabs nav">
                                                        <li class="active"><a href="#servicesettings3" data-toggle="tab"><?php _e('Icons and Description', UT_THEME_NAME); ?></a></li>
                                                        <li><a href="#servicestyling3" data-toggle="tab"><?php _e('Styling', UT_THEME_NAME); ?></a></li>
                                                    </ul>
                                                </div>
                                            </div>


                                            <div class="tab-content">

                                                <div id="servicesettings3" class="tab-pane active">

                                                    <div class="btn-group">

                                                        <label><?php _e('Activate Service Column 3', UT_THEME_NAME); ?></label>
                                                        <?php $mb->the_field('activate_col_3'); ?>

                                                        <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                                        <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                                        <button data-state="activate_col_3_on"
                                                                class="btn <?php echo $activestate; ?> radio_active"
                                                                type="button"
                                                                value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                                        <input id="activate_col_3_on" type="radio" value="on"
                                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                                               class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                                        <button data-state="activate_col_3_off"
                                                                class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                                type="button"
                                                                value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                                        <input id="activate_col_3_off" type="radio" value="off"
                                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                                               class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                                    </div>

                                                    <p><?php $mb->the_field('col_3_icon'); ?>
                                                        <?php $wpalchemy_media_access->setGroupName('img-ico-3' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

                                                    <div style="min-height:50px;">
                                                        <img class="frame" src="<?php if ($mb->get_the_value()) {
                                                            echo aq_resize($mb->get_the_value(), 32, 32, true);
                                                        } ?>"/>
                                                    </div>

                                                    <label><?php _e('Icon URL', UT_THEME_NAME); ?></label>
                                                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                                    <br/>
                                                    <span class="info badge badge-info">(<?php _e('Icon size should be 32x32', UT_THEME_NAME); ?>)</span>
                                                    <br/>
                                                    <?php echo $wpalchemy_media_access->getButton(); ?>
                                                    </p>

                                                    <p>
                                                        <?php $mb->the_field('col_3_icon_alt'); ?>
                                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Icon alt', UT_THEME_NAME); ?></label>
                                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>
                                                    </p>

                                                    <p>
                                                        <?php $mb->the_field('col_3_headline'); ?>
                                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Headline', UT_THEME_NAME); ?></label>
                                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>
                                                    </p>

                                                    <p>
                                                        <label><?php _e('Content', UT_THEME_NAME); ?></label>
                                                        <?php $mb->the_field('col_3_content'); ?>
                                                        <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                                                  class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                                        <br/>
                                                        <span class="info badge badge-info">(<?php _e('This field accepts shortcodes', UT_THEME_NAME); ?>)</span>
                                                    </p>

                                                    <p>
                                                        <?php $mb->the_field('col_3_link'); ?>
                                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Link', UT_THEME_NAME); ?></label>
                                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>
                                                    </p>

                                                </div><!-- end servicesetting -->

                                                <div id="servicestyling3" class="tab-pane">

                                                    <script type="text/javascript">
                                                        jQuery(document).ready(function ($) {
                                                            $('#col_3_bgcolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_3_bgcolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_3_bgcolor').val('#' + hex);
                                                                    $('#cp_col_3_bgcolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_3_bgcolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                            $('#col_3_hovercolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_3_hovercolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_3_hovercolor').val('#' + hex);
                                                                    $('#cp_col_3_hovercolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_3_hovercolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                            $('#col_3_textcolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_3_textcolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_3_textcolor').val('#' + hex);
                                                                    $('#cp_col_3_textcolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_3_textcolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                            $('#col_3_texthovercolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_3_texthovercolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_3_texthovercolor').val('#' + hex);
                                                                    $('#cp_col_3_texthovercolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_3_texthovercolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                        });
                                                    </script>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_3_bgcolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Background Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_3_bgcolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                            </div>
                                                        </div>

                                                        <input id="col_3_bgcolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_3_hovercolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Background Hover Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_3_hovercolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                            </div>
                                                        </div>

                                                        <input id="col_3_hovercolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_3_textcolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Text Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_3_textcolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                            </div>
                                                        </div>

                                                        <input id="col_3_textcolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_3_texthovercolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Text Hover Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_3_texthovercolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                            </div>
                                                        </div>

                                                        <input id="col_3_texthovercolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                </div><!-- end servicestyling -->

                                            </div><!-- end tabs -->

                                        </div><!-- end service col -->

                                    </div><!-- end one_half -->


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Service Box 4
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="one_half last">

                                        <div class="servicecolumn">

                                            <div class="navbar">
                                                <div class="navbar-inner">

                                                    <ul class="options_tabs nav">
                                                        <li class="active"><a href="#servicesettings4"
                                                                              data-toggle="tab"><?php _e('Icons and Description', UT_THEME_NAME); ?></a>
                                                        </li>
                                                        <li><a href="#servicestyling4"
                                                               data-toggle="tab"><?php _e('Styling', UT_THEME_NAME); ?></a>
                                                        </li>
                                                    </ul>

                                                </div>
                                            </div>

                                            <div class="tab-content">

                                                <div id="servicesettings4" class="tab-pane active">

                                                    <div class="btn-group">

                                                        <label><?php _e('Activate Service Column 4', UT_THEME_NAME); ?></label>
                                                        <?php $mb->the_field('activate_col_4'); ?>

                                                        <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                                        <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                                        <button data-state="activate_col_4_on"
                                                                class="btn <?php echo $activestate; ?> radio_active"
                                                                type="button"
                                                                value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                                        <input id="activate_col_4_on" type="radio" value="on"
                                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                                               class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                                        <button data-state="activate_col_4_off"
                                                                class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                                type="button"
                                                                value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                                        <input id="activate_col_4_off" type="radio" value="off"
                                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                                               class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                                    </div>

                                                    <p><?php $mb->the_field('col_4_icon'); ?>
                                                        <?php $wpalchemy_media_access->setGroupName('img-ico-4' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

                                                    <div style="min-height:50px;">
                                                        <img class="frame" src="<?php if ($mb->get_the_value()) {
                                                            echo aq_resize($mb->get_the_value(), 32, 32, true);
                                                        } ?>"/>
                                                    </div>

                                                    <label><?php _e('Icon URL', UT_THEME_NAME); ?></label>
                                                    <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                                    <br/><span
                                                            class="info badge badge-info">(<?php _e('Icon size should be 32x32', UT_THEME_NAME); ?>)</span><br/>
                                                    <?php echo $wpalchemy_media_access->getButton(); ?>
                                                    </p>

                                                    <p><?php $mb->the_field('col_4_icon_alt'); ?>
                                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Icon alt', UT_THEME_NAME); ?></label>
                                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/></p>

                                                    <p><?php $mb->the_field('col_4_headline'); ?>
                                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Headline', UT_THEME_NAME); ?></label>
                                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/></p>

                                                    <p><label><?php _e('Content', UT_THEME_NAME); ?></label>
                                                        <?php $mb->the_field('col_4_content'); ?>
                                                        <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                                                  class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                                        <br/><span
                                                                class="info badge badge-info">(<?php _e('This field accepts shortcodes', UT_THEME_NAME); ?>)</span>
                                                    </p>

                                                    <p><?php $mb->the_field('col_4_link'); ?>
                                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Link', UT_THEME_NAME); ?></label>
                                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/></p>

                                                </div><!-- end servicesetting -->

                                                <div id="servicestyling4" class="tab-pane">

                                                    <script type="text/javascript">
                                                        jQuery(document).ready(function ($) {
                                                            $('#col_4_bgcolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_4_bgcolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_4_bgcolor').val('#' + hex);
                                                                    $('#cp_col_4_bgcolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_4_bgcolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                            $('#col_4_hovercolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_4_hovercolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_4_hovercolor').val('#' + hex);
                                                                    $('#cp_col_4_hovercolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_4_hovercolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                            $('#col_4_textcolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_4_textcolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_4_textcolor').val('#' + hex);
                                                                    $('#cp_col_4_textcolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_4_textcolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                            $('#col_4_texthovercolor').ColorPicker({

                                                                onSubmit: function (hsb, hex, rgb) {
                                                                    $('#col_4_texthovercolor').val('#' + hex);
                                                                },
                                                                onBeforeShow: function () {
                                                                    $(this).ColorPickerSetColor(this.value);
                                                                    return false;
                                                                },
                                                                onChange: function (hsb, hex, rgb) {
                                                                    $('#col_4_texthovercolor').val('#' + hex);
                                                                    $('#cp_col_4_texthovercolor div').css({'backgroundColor': '#' + hex});
                                                                    $('#cp_col_4_texthovercolor').prev('input').attr('value', '#' + hex);
                                                                }
                                                            }).bind('keyup', function () {
                                                                $(this).ColorPickerSetColor(this.value);
                                                            });

                                                        });
                                                    </script>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_4_bgcolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Background Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_4_bgcolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                            </div>
                                                        </div>

                                                        <input id="col_4_bgcolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_4_hovercolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Background Hover Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_4_hovercolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                            </div>
                                                        </div>

                                                        <input id="col_4_hovercolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_4_textcolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Text Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_4_textcolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;"></div>
                                                        </div>

                                                        <input id="col_4_textcolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                    <div class="colorform">
                                                        <?php $mb->the_field('col_4_texthovercolor'); ?>
                                                        <label class="cp_box_label"><?php _e('Text Hover Color', UT_THEME_NAME); ?></label>

                                                        <div id="cp_col_4_texthovercolor" class="cp_box">
                                                            <div style="background-color:<?php echo (!is_null($mb->get_the_value())) ? $mb->get_the_value() : '#ffffff'; ?>;">
                                                            </div>
                                                        </div>

                                                        <input id="col_4_texthovercolor" type="text"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/>

                                                    </div>

                                                </div><!-- end servicestyling -->

                                            </div><!-- end tabs -->

                                        </div><!-- end service col -->

                                    </div><!-- end one_half -->

                                    <div class="clear"></div>

                                </div><!-- end option pad -->

                            </div><!-- end vertical tab service columns -->


                            <?php
                            #-----------------------------------------------------------------
                            # Service Columns
                            #-----------------------------------------------------------------
                            ?>

                            <div id="home-service-columns" class="home-service-columns tab-pane">

                                <div class="lambda-opttitle">
                                    <div class="lambda-opttitle-pad">
                                        <span class="miniicon"><img
                                                    src="<?php echo $theme_path; ?>/lambda/assets/images/icons/layout_add.png"></span><?php _e('Service Columns', UT_THEME_NAME); ?>
                                    </div>
                                </div>
                                <div class="lambda-settings-pad">

                                    <div class="btn-group">

                                        <label><?php _e('Activate Service Columns', UT_THEME_NAME); ?></label>
                                        <?php $mb->the_field('activate_service_columns'); ?>

                                        <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                        <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>

                                        <button data-state="activate_service_columns_on"
                                                class="btn <?php echo $activestate; ?> radio_active" type="button"
                                                value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                        <input id="activate_service_columns_on" type="radio" value="on"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                        <button data-state="activate_service_columns_off"
                                                class="btn <?php echo $deactivestate; ?> radio_inactive" type="button"
                                                value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                        <input id="activate_service_columns_off" type="radio" value="off"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                    </div>

                                    <p><?php $mb->the_field('services_headline'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Service Columns Headline', UT_THEME_NAME); ?></label>
                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/></p>

                                    <hr/>


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Service Column 1
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="one_half">

                                        <div class="servicecolumn">
                                            <div class="btn-group">

                                                <label><?php _e('Activate Service Column 1', UT_THEME_NAME); ?></label>
                                                <?php $mb->the_field('activate_cols_1'); ?>

                                                <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                                <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>

                                                <button data-state="activate_cols_1_on"
                                                        class="btn <?php echo $activestate; ?> radio_active"
                                                        type="button"
                                                        value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                                <input id="activate_cols_1_on" type="radio" value="on"
                                                       name="<?php $mb->the_name(); ?>" style="display:none;"
                                                       class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                                <button data-state="activate_cols_1_off"
                                                        class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                        type="button"
                                                        value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                                <input id="activate_cols_1_off" type="radio" value="off"
                                                       name="<?php $mb->the_name(); ?>" style="display:none;"
                                                       class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                            </div>

                                            <p>
                                                <?php $mb->the_field('cols_1_icon'); ?>
                                                <?php $wpalchemy_media_access->setGroupName('img-icos-1' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

                                            <div style="min-height:50px;">
                                                <img class="frame" src="<?php if ($mb->get_the_value()) {
                                                    echo aq_resize($mb->get_the_value(), 32, 32, true);
                                                } ?>"/>
                                            </div>

                                            <label><?php _e('Icon URL', UT_THEME_NAME); ?></label>
                                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('Icon size should be 32x32', UT_THEME_NAME); ?>)</span>
                                            <br/>
                                            <?php echo $wpalchemy_media_access->getButton(); ?>
                                            </p>

                                            <p>
                                                <?php $mb->the_field('cols_1_icon_alt'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Icon alt ( SEO )', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                            <p>
                                                <?php $mb->the_field('cols_1_headline'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Headline', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                            <p>
                                                <label><?php _e('Content', UT_THEME_NAME); ?></label>
                                                <?php $mb->the_field('cols_1_content'); ?>
                                                <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                                          class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                                <br/>
                                                <span class="info badge badge-info">(<?php _e('This field accepts shortcodes', UT_THEME_NAME); ?>)</span>
                                            </p>

                                            <p>
                                                <?php $mb->the_field('cols_1_link'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Link', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                            <p>
                                                <?php $mb->the_field('cols_1_buttontext'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Buttontext', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                        </div>

                                    </div><!-- end one_half -->


                                    <?php
                                    #-----------------------------------------------------------------
                                    # Service Column 2
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="one_half last">

                                        <div class="servicecolumn">
                                            <div class="btn-group">

                                                <label><?php _e('Activate Service Column 2', UT_THEME_NAME); ?></label>
                                                <?php $mb->the_field('activate_cols_2'); ?>

                                                <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                                <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>

                                                <button data-state="activate_cols_2_on"
                                                        class="btn <?php echo $activestate; ?> radio_active"
                                                        type="button"
                                                        value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                                <input id="activate_cols_2_on" type="radio" value="on"
                                                       name="<?php $mb->the_name(); ?>" style="display:none;"
                                                       class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                                <button data-state="activate_cols_1_off"
                                                        class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                        type="button"
                                                        value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                                <input id="activate_cols_2_off" type="radio" value="off"
                                                       name="<?php $mb->the_name(); ?>" style="display:none;"
                                                       class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                            </div>

                                            <p>
                                                <?php $mb->the_field('cols_2_icon'); ?>
                                                <?php $wpalchemy_media_access->setGroupName('img-icos-2' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

                                            <div style="min-height:50px;">
                                                <img class="frame" src="<?php if ($mb->get_the_value()) {
                                                    echo aq_resize($mb->get_the_value(), 32, 32, true);
                                                } ?>"/>
                                            </div>

                                            <label><?php _e('Icon URL', UT_THEME_NAME); ?></label>
                                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('Icon size should be 32x32', UT_THEME_NAME); ?>)</span>
                                            <br/>
                                            <?php echo $wpalchemy_media_access->getButton(); ?>
                                            </p>

                                            <p>
                                                <?php $mb->the_field('cols_2_icon_alt'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Icon alt ( SEO )', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                            <p>
                                                <?php $mb->the_field('cols_2_headline'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Headline', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                            <p>
                                                <label><?php _e('Content', UT_THEME_NAME); ?></label>
                                                <?php $mb->the_field('cols_2_content'); ?>
                                                <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                                          class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                                <br/>
                                                <span class="info badge badge-info">(<?php _e('This field accepts shortcodes', UT_THEME_NAME); ?>)</span>
                                            </p>

                                            <p>
                                                <?php $mb->the_field('cols_2_link'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Link', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                            <p>
                                                <?php $mb->the_field('cols_2_buttontext'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Buttontext', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                        </div>

                                    </div><!-- end one_half -->

                                    <?php
                                    #-----------------------------------------------------------------
                                    # Service Column 3
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="one_half">

                                        <div class="servicecolumn">
                                            <div class="btn-group">

                                                <label><?php _e('Activate Service Column 3', UT_THEME_NAME); ?></label>
                                                <?php $mb->the_field('activate_cols_3'); ?>

                                                <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                                <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>

                                                <button data-state="activate_cols_3_on"
                                                        class="btn <?php echo $activestate; ?> radio_active"
                                                        type="button"
                                                        value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                                <input id="activate_cols_3_on" type="radio" value="on"
                                                       name="<?php $mb->the_name(); ?>" style="display:none;"
                                                       class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                                <button data-state="activate_cols_3_off"
                                                        class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                        type="button"
                                                        value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                                <input id="activate_cols_3_off" type="radio" value="off"
                                                       name="<?php $mb->the_name(); ?>" style="display:none;"
                                                       class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                            </div>

                                            <p>
                                                <?php $mb->the_field('cols_3_icon'); ?>
                                                <?php $wpalchemy_media_access->setGroupName('img-icos-3' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

                                            <div style="min-height:50px;">
                                                <img class="frame" src="<?php if ($mb->get_the_value()) {
                                                    echo aq_resize($mb->get_the_value(), 32, 32, true);
                                                } ?>"/>
                                            </div>

                                            <label><?php _e('Icon URL', UT_THEME_NAME); ?></label>
                                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('Icon size should be 32x32', UT_THEME_NAME); ?>)</span>
                                            <br/>
                                            <?php echo $wpalchemy_media_access->getButton(); ?>
                                            </p>

                                            <p>
                                                <?php $mb->the_field('cols_3_icon_alt'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Icon alt ( SEO )', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                            <p>
                                                <?php $mb->the_field('cols_3_headline'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Headline', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                            <p>
                                                <label><?php _e('Content', UT_THEME_NAME); ?></label>
                                                <?php $mb->the_field('cols_3_content'); ?>
                                                <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                                          class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                                <br/>
                                                <span class="info badge badge-info">(<?php _e('This field accepts shortcodes', UT_THEME_NAME); ?>)</span>
                                            </p>

                                            <p><?php $mb->the_field('cols_3_link'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Link', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                            <p><?php $mb->the_field('cols_3_buttontext'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Buttontext', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                        </div>

                                    </div><!-- end one_half -->

                                    <?php
                                    #-----------------------------------------------------------------
                                    # Service Column 4
                                    #-----------------------------------------------------------------
                                    ?>
                                    <div class="one_half last">

                                        <div class="servicecolumn">
                                            <div class="btn-group">

                                                <label><?php _e('Activate Service Column 4', UT_THEME_NAME); ?></label>
                                                <?php $mb->the_field('activate_cols_4'); ?>

                                                <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                                <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-success' : 'inactive'; ?>

                                                <button data-state="activate_cols_4_on"
                                                        class="btn <?php echo $activestate; ?> radio_active"
                                                        type="button"
                                                        value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                                <input id="activate_cols_4_on" type="radio" value="on"
                                                       name="<?php $mb->the_name(); ?>" style="display:none;"
                                                       class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                                <button data-state="activate_cols_4_off"
                                                        class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                        type="button"
                                                        value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                                <input id="activate_cols_4_off" type="radio" value="off"
                                                       name="<?php $mb->the_name(); ?>" style="display:none;"
                                                       class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                            </div>

                                            <p>
                                                <?php $mb->the_field('cols_4_icon'); ?>
                                                <?php $wpalchemy_media_access->setGroupName('img-icos-4' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

                                            <div style="min-height:50px;">
                                                <img class="frame" src="<?php if ($mb->get_the_value()) {
                                                    echo aq_resize($mb->get_the_value(), 32, 32, true);
                                                } ?>"/>
                                            </div>

                                            <label><?php _e('Icon URL', UT_THEME_NAME); ?></label>
                                            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                            <br/>
                                            <span class="info badge badge-info">(<?php _e('Icon size should be 32x32', UT_THEME_NAME); ?>)</span>
                                            <br/>
                                            <?php echo $wpalchemy_media_access->getButton(); ?>
                                            </p>

                                            <p><?php $mb->the_field('cols_4_icon_alt'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Icon alt ( SEO )', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                            <p><?php $mb->the_field('cols_4_headline'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Headline', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                            <p><label><?php _e('Content', UT_THEME_NAME); ?></label>
                                                <?php $mb->the_field('cols_4_content'); ?>
                                                <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                                          class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                                <br/>
                                                <span class="info badge badge-info">(<?php _e('This field accepts shortcodes', UT_THEME_NAME); ?>)</span>
                                            </p>

                                            <p><?php $mb->the_field('cols_4_link'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Link', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                            <p><?php $mb->the_field('cols_4_buttontext'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Buttontext', UT_THEME_NAME); ?></label>
                                                <input type="text" name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/>
                                            </p>

                                        </div>

                                    </div><!-- end one_half -->

                                    <div class="clear"></div>

                                </div><!-- end option pad -->

                            </div><!-- end vertical tab service columns -->


                            <?php
                            #-----------------------------------------------------------------
                            # Portfolio Items
                            #-----------------------------------------------------------------
                            ?>

                            <div id="home-portfolio-items" class="home-portfolio-items tab-pane">

                                <div class="lambda-opttitle">
                                    <div class="lambda-opttitle-pad">
                                        <span class="miniicon">
                                            <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/add.png">
                                        </span>
                                        <?php _e('Portfolio Items', UT_THEME_NAME); ?>
                                    </div>
                                </div>
                                <div class="lambda-settings-pad">

                                    <div class="btn-group">

                                        <label><?php _e('Activate Portfolio', UT_THEME_NAME); ?></label>
                                        <?php $mb->the_field('activate_portfolio'); ?>

                                        <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                        <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                        <button data-state="activate_portfolio_on"
                                                class="btn <?php echo $activestate; ?> radio_active" type="button"
                                                value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                        <input id="activate_portfolio_on" type="radio" value="on"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                        <button data-state="activate_portfolio_off"
                                                class="btn <?php echo $deactivestate; ?> radio_inactive" type="button"
                                                value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                        <input id="activate_portfolio_off" type="radio" value="off"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                    </div>

                                </div>

                                <div class="lambda-opttitle">
                                    <div class="lambda-opttitle-pad">
                                        <span class="miniicon">
                                            <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/add.png">
                                        </span>
                                        <?php _e('Portfolio Settings', UT_THEME_NAME); ?>
                                    </div>
                                </div>
                                <div class="lambda-settings-pad">

                                    <p><?php $mb->the_field('portfolio_headline'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Headline', UT_THEME_NAME); ?></label>
                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/>
                                    </p>

                                    <p><?php $mb->the_field('portfolio_link'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Link to Portfolio', UT_THEME_NAME); ?></label>
                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/>
                                    </p>

                                    <p><?php $mb->the_field('portfolio_link_text'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Link Text', UT_THEME_NAME); ?></label>
                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/>
                                    </p>

                                    <p><?php $mb->the_field('portfolio_count'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Load the last x items out of the portfolio', UT_THEME_NAME); ?></label>
                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/>
                                    </p>

                                    <p><?php $mb->the_field('portfolio_grid'); ?>
                                        <label><?php _e('Portfolio Column Layout', UT_THEME_NAME); ?></label>
                                        <select name="<?php $mb->the_name(); ?>" class="select_testimonial_color">
                                            <option value=""><?php _e('Select Column Layout ...', UT_THEME_NAME); ?></option>
                                            <option value="portfolio-item eight columns"<?php $mb->the_select_state('portfolio-item eight columns'); ?>><?php _e('2 Columns', UT_THEME_NAME); ?></option>
                                            <option value="portfolio-item fivep columns"<?php $mb->the_select_state('portfolio-item fivep columns'); ?>><?php _e('3 Columns', UT_THEME_NAME); ?></option>
                                            <option value="portfolio-item four columns"<?php $mb->the_select_state('portfolio-item four columns'); ?>><?php _e('4 Columns', UT_THEME_NAME); ?></option>
                                        </select>
                                    </p>

                                    <p>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Display items out of the following category', UT_THEME_NAME); ?></label>
                                        <?php $taxonomys = get_terms('project-type', array(
                                            'hide_empty' => 0,
                                        ));
                                        if (is_array($taxonomys) && !empty($taxonomys)) {
                                            foreach ($taxonomys as $key => $item): ?>

                                                <?php $mb->the_field('project_type', WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); ?>
                                                <input type="checkbox" name="<?php $mb->the_name(); ?>"
                                                       value="<?php echo $taxonomys[$key]->slug; ?>"<?php $mb->the_checkbox_state($taxonomys[$key]->slug); ?>/>
                                                <?php echo $taxonomys[$key]->name; ?><br/>

                                            <?php endforeach;
                                        } else {
                                            echo '<div class="alert">' . __('No Portfolio Categories created yet!', UT_THEME_NAME) . '</div>';
                                        } ?></p>

                                    <div class="btn-group">

                                        <label><?php _e('Show Portfolio Item Title', UT_THEME_NAME); ?></label>
                                        <?php $mb->the_field('portfolio_item_title'); ?>

                                        <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                        <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                        <button data-state="portfolio_item_title_pb_on"
                                                class="btn <?php echo $activestate; ?> radio_active" type="button"
                                                value="on"><?php _e('on', UT_THEME_NAME); ?></button>
                                        <input id="portfolio_item_title_pb_on" type="radio" value="on"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                        <button data-state="portfolio_item_title_pb_off"
                                                class="btn <?php echo $deactivestate; ?> radio_inactive" type="button"
                                                value="off"><?php _e('off', UT_THEME_NAME); ?></button>
                                        <input id="portfolio_item_title_pb_off" type="radio" value="off"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                    </div>

                                </div><!-- end opt pad -->

                            </div><!-- end vertical tab portfolio items -->


                            <?php
                            #-----------------------------------------------------------------
                            # Blog Items
                            #-----------------------------------------------------------------
                            ?>

                            <div id="home-blog-excerpt" class="home-blog-excerpt tab-pane">

                                <div class="lambda-opttitle">
                                    <div class="lambda-opttitle-pad">
                                        <span class="miniicon">
                                            <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/add.png">
                                        </span>
                                        <?php _e('Blog Intro Box', UT_THEME_NAME); ?>
                                    </div>
                                </div>
                                <div class="lambda-settings-pad">

                                    <div class="btn-group">

                                        <label><?php _e('Activate latest Blog?', UT_THEME_NAME); ?></label>
                                        <?php $mb->the_field('activate_latest_blog'); ?>

                                        <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                        <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                        <button data-state="activate_latest_blog_on"
                                                class="btn <?php echo $activestate; ?> radio_active" type="button"
                                                value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                        <input id="activate_latest_blog_on" type="radio" value="on"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                        <button data-state="activate_latest_blog_off"
                                                class="btn <?php echo $deactivestate; ?> radio_inactive" type="button"
                                                value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                        <input id="activate_latest_blog_off" type="radio" value="off"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                    </div>

                                    <hr/>

                                    <p><?php $mb->the_field('blog_headline'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Headline', UT_THEME_NAME); ?></label>
                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/>
                                    </p>

                                    <p><?php $mb->the_field('blog_link'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Link to Blog', UT_THEME_NAME); ?></label>
                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/>
                                    </p>

                                    <p><?php $mb->the_field('blog_link_text'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Link Text', UT_THEME_NAME); ?></label>
                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/>
                                    </p>

                                    <hr/>

                                    <div class="btn-group">

                                        <label><?php _e('Activate featured Images?', UT_THEME_NAME); ?></label>
                                        <?php $mb->the_field('activate_blog_images'); ?>

                                        <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                        <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                        <button data-state="activate_blog_images_on"
                                                class="btn <?php echo $activestate; ?> radio_active" type="button"
                                                value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                        <input id="activate_blog_images_on" type="radio" value="on"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                        <button data-state="activate_blog_images_off"
                                                class="btn <?php echo $deactivestate; ?> radio_inactive" type="button"
                                                value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                        <input id="activate_blog_images_off" type="radio" value="off"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                    </div>

                                    <hr/>

                                    <div class="btn-group">

                                        <label><?php _e('Activate Blog Excerpt', UT_THEME_NAME); ?></label>
                                        <?php $mb->the_field('activate_blog_excerpt'); ?>

                                        <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                        <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                        <button data-state="activate_blog_excerpt_on"
                                                class="btn <?php echo $activestate; ?> radio_active" type="button"
                                                value="on"><?php _e('on', UT_THEME_NAME); ?></button>
                                        <input id="activate_blog_excerpt_on" type="radio" value="on"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                        <button data-state="activate_blog_excerpt_off"
                                                class="btn <?php echo $deactivestate; ?> radio_inactive" type="button"
                                                value="off"><?php _e('off', UT_THEME_NAME); ?></button>
                                        <input id="activate_blog_excerpt_off" type="radio" value="off"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                    </div>

                                    <hr/>

                                    <p><?php $mb->the_field('blog_excerpt_length'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Excerpt length', UT_THEME_NAME); ?></label>
                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/>
                                        <br/><span
                                                class="info badge badge-info">(<?php _e('for example: 55', UT_THEME_NAME); ?>)</span>
                                    </p>

                                    <p><?php $mb->the_field('blog_length'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Blog length', UT_THEME_NAME); ?></label>
                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/>
                                        <br/><span
                                                class="info badge badge-info">(<?php _e('how many items to display? for example: 6', UT_THEME_NAME); ?>)</span>
                                    </p>

                                    <p><?php $mb->the_field('post_not_in', WPALCHEMY_FIELD_HINT_SELECT_MULTI); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Exclude Post (optional)', UT_THEME_NAME); ?></label>
                                        <select name="<?php $mb->the_name(); ?>" class="select_post_not_in"
                                                multiple="multiple">
                                            <?php

                                            $homeposts = &get_posts(array('numberposts' => -1, 'orderby' => 'date'));

                                            if ($homeposts) {
                                                echo '<option value="">' . __('Choose posts to exclude', UT_THEME_NAME) . '</option>';
                                                foreach ($homeposts as $homepost) {
                                                    echo '<option value="' . $homepost->ID . '" ' . $mb->get_the_select_state($homepost->ID) . '>' . $homepost->post_title . '</option>';
                                                }
                                            } else {
                                                echo '<option value="0">' . __('No Pages Available', UT_THEME_NAME) . '</option>';
                                            } ?>
                                        </select>
                                        <br/>
                                        <span class="info badge badge-info">(<?php _e('use shift or control to select multiple items', UT_THEME_NAME); ?>)</span>
                                    </p>

                                    <hr/>

                                    <p><?php $mb->the_field('only_category', WPALCHEMY_FIELD_HINT_SELECT_MULTI); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Show only Posts of this category (optional)', UT_THEME_NAME); ?></label>
                                        <select name="<?php $mb->the_name(); ?>" class="select_only_category"
                                                multiple="multiple">
                                            <?php

                                            $categories = &get_categories(array('hide_empty' => false));

                                            if ($categories) {
                                                echo '<option value="">' . __('Choose', UT_THEME_NAME) . '</option>';
                                                foreach ($categories as $category) {
                                                    echo '<option value="' . $category->term_id . '" ' . $mb->get_the_select_state($category->term_id) . '>' . $category->name . '</option>';
                                                }
                                            } else {
                                                echo '<option value="0">' . __('No Categories Available', UT_THEME_NAME) . '</option>';
                                            } ?>
                                        </select>
                                        <br/>
                                        <span class="info badge badge-info">(<?php _e('use shift or control to select multiple items', UT_THEME_NAME); ?>)</span>
                                    </p>

                                </div><!-- end opt pad -->

                            </div><!-- end vertical tab portfolio items -->


                            <?php
                            #-----------------------------------------------------------------
                            # Testimonials
                            #-----------------------------------------------------------------
                            ?>

                            <div id="home-testimonials" class="home-testimonials tab-pane">

                                <div class="lambda-opttitle">
                                    <div class="lambda-opttitle-pad">
                                        <span class="miniicon">
                                            <img src="<?php echo $theme_path; ?>/lambda/assets/images/icons/add.png">
                                        </span>
                                        <?php _e('Toggles & Testimonials', UT_THEME_NAME); ?>
                                    </div>
                                </div>
                                <div class="lambda-settings-pad clearfix">

                                    <div class="btn-group">

                                        <label><?php _e('Activate Toggles & Testimonials', UT_THEME_NAME); ?></label>
                                        <?php $mb->the_field('activate_testimonials'); ?>

                                        <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>

                                        <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                        <button data-state="activate_testimonials_on"
                                                class="btn <?php echo $activestate; ?> radio_active" type="button"
                                                value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                        <input id="activate_testimonials_on" type="radio" value="on"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                        <button data-state="activate_testimonials_off"
                                                class="btn <?php echo $deactivestate; ?> radio_inactive" type="button"
                                                value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                        <input id="activate_testimonials_off" type="radio" value="off"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                    </div>

                                    <hr/>

                                    <p><?php $mb->the_field('toggle_headline'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Service Headline', UT_THEME_NAME); ?></label>
                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/>
                                        <br/><span
                                                class="info badge badge-info">(<?php _e('headline above service toggles', UT_THEME_NAME); ?>)</span>
                                    </p>

                                    <p><?php $mb->the_field('toggle_type'); ?>
                                        <label><?php _e('Toggle Content Type', UT_THEME_NAME); ?></label>
                                        <select name="<?php $mb->the_name(); ?>" class="select_toggle_type">
                                            <option value=""><?php _e('Select content ...', UT_THEME_NAME); ?></option>
                                            <option value="page"<?php $mb->the_select_state('page'); ?>><?php _e('from an existing page (Service Template)', UT_THEME_NAME); ?></option>
                                            <option value="own"<?php $mb->the_select_state('own'); ?>><?php _e('create own toggles', UT_THEME_NAME); ?></option>
                                        </select>
                                    </p>

                                    <div class="well select_toggle_page s-toggle">

                                        <p><?php $mb->the_field('service_load_last'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Load last X service elements', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </p>

                                        <p><label><?php _e('Choose Service Page', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('home_service_page'); ?>
                                            <select name="<?php $mb->the_name(); ?>">

                                                <?php $pages = query_posts(array(
                                                    'post_type' => 'page',
                                                    'meta_key' => '_wp_page_template',
                                                    'meta_value' => 'template-service.php',
                                                    'meta_compare' => '=='
                                                ));

                                                if ($pages) {
                                                    echo '<option value="">-- Choose One --</option>';
                                                    foreach ($pages as $page) {
                                                        //Create option
                                                        echo '<option value="' . $page->ID . '" ' . $mb->get_the_select_state($page->ID) . '>' . $page->post_title . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="0">No Pages Available</option>';
                                                } ?>

                                            </select>
                                            <br/>

                                            <span class="info badge badge-info"><?php _e('Choose Services from an existing <br /> Service Template', UT_THEME_NAME); ?></span>
                                        </p>

                                    </div>

                                    <div class="well select_toggle_own s-toggle">

                                        <?php while ($mb->have_fields_and_multi(UT_THEME_INITIAL . 'home_verticaltabs')): ?>
                                            <?php $mb->the_group_open(); ?>

                                            <?php $mb->the_field('tab_name'); ?>
                                            <div class="testimonial_item_name"><?php if ($mb->get_the_value()) {
                                                    $mb->the_value();
                                                } else {
                                                    _e('new tab', UT_THEME_NAME);
                                                }; ?></div>

                                            <div class="fancy_box testimonial_item">

                                                <p><?php $mb->the_field('tab_name'); ?>
                                                    <label for="<?php $mb->the_name(); ?>"><?php _e('Tab Name', UT_THEME_NAME); ?></label>
                                                    <input type="text" name="<?php $mb->the_name(); ?>"
                                                           value="<?php $mb->the_value(); ?>"/></p>

                                                <div class="customEditor">
                                                    <?php $mb->the_field('tab_content'); ?>
                                                    <div class="wp-editor-tools">
                                                        <div class="custom_upload_buttons hide-if-no-js wp-media-buttons"><?php do_action('media_buttons'); ?></div>
                                                    </div>
                                                    <textarea class="wysiwyg" rows="10" cols="50"
                                                              name="<?php $mb->the_name(); ?>"><?php echo wpautop(esc_html($mb->get_the_value())); ?></textarea>
                                                </div>

                                                <a href="#" class="dodelete btn red"><?php _e('Delete', UT_THEME_NAME); ?></a>

                                            </div>

                                            <?php $mb->the_group_close(); ?>
                                        <?php endwhile; ?>

                                        <div class="clear"></div>
                                        <p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-<?php echo UT_THEME_INITIAL . 'home_verticaltabs'; ?> btn btn-success"><i
                                                        class="icon-book icon-white"></i> <?php _e('add new tab', UT_THEME_NAME); ?></a>
                                        </p>

                                    </div>

                                    <hr/>

                                    <p><?php $mb->the_field('testimonial_headline'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Testimonial Headline', UT_THEME_NAME); ?></label>
                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/>
                                        <br/><span
                                                class="info badge badge-info">(<?php _e('headline above testimonials', UT_THEME_NAME); ?>)</span>
                                    </p>

                                    <hr/>

                                    <p><?php $mb->the_field('testimonial_type'); ?>
                                        <label><?php _e('Testimonial Type', UT_THEME_NAME); ?></label>
                                        <select name="<?php $mb->the_name(); ?>" class="select_testimonial_type">
                                            <option value=""><?php _e('Select testimonial type ...', UT_THEME_NAME); ?></option>
                                            <option value="page"<?php $mb->the_select_state('page'); ?>><?php _e('from an existing page', UT_THEME_NAME); ?></option>
                                            <option value="own"<?php $mb->the_select_state('own'); ?>><?php _e('create own testimonials', UT_THEME_NAME); ?></option>
                                        </select></p>

                                    <div class="well testimonial_type_page t-toggle">

                                        <p><label><?php _e('Choose Testimonial Page', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('home_testimonial_page'); ?>
                                            <select name="<?php $mb->the_name(); ?>">

                                                <?php $pages = query_posts(array(
                                                    'post_type' => 'page',
                                                    'meta_key' => '_wp_page_template',
                                                    'meta_value' => 'template-testimonials.php',
                                                    'meta_compare' => '=='
                                                ));

                                                if ($pages) {
                                                    echo '<option value="">-- Choose One --</option>';
                                                    foreach ($pages as $page) {
                                                        //Create option
                                                        echo '<option value="' . $page->ID . '" ' . $mb->get_the_select_state($page->ID) . '>' . $page->post_title . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="0">No Pages Available</option>';
                                                } ?>

                                            </select>
                                            <br/><span
                                                    class="info badge badge-info"><?php _e('Choose Testimonials from an existing Testimonial Template', UT_THEME_NAME); ?></span>
                                        </p>

                                        <div class="btn-group">

                                            <label><?php _e('Autoplay Testimonials', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('testimonials_autoplay'); ?>

                                            <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                            <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                            <button data-state="testimonials_autoplay_on"
                                                    class="btn <?php echo $activestate; ?> radio_active" type="button"
                                                    value="on"><?php _e('yes', UT_THEME_NAME); ?></button>
                                            <input id="testimonials_autoplay_on" type="radio" value="on"
                                                   name="<?php $mb->the_name(); ?>" style="display:none;"
                                                   class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>

                                            <button data-state="testimonials_autoplay_off"
                                                    class="btn <?php echo $deactivestate; ?> radio_inactive"
                                                    type="button" value="off"><?php _e('no', UT_THEME_NAME); ?></button>
                                            <input id="testimonials_autoplay_off" type="radio" value="off"
                                                   name="<?php $mb->the_name(); ?>" style="display:none;"
                                                   class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                        </div>

                                        <p><?php $mb->the_field('testimonial_time'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Playtime in miliseconds', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/></p>

                                    </div>

                                    <div class="well testimonial_type_own t-toggle">

                                        <?php while ($mb->have_fields_and_multi(UT_THEME_INITIAL . 'home_testimonials')): ?>
                                            <?php $mb->the_group_open(); ?>

                                            <?php $mb->the_field('author'); ?>
                                            <div class="faq_item_name"><?php if ($mb->get_the_value()) {
                                                    $mb->the_value();
                                                } else {
                                                    _e('new testimonial', UT_THEME_NAME);
                                                }; ?></div>
                                            <div class="fancy_box faq_item">

                                                <?php $mb->the_field('author_name'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Authorname', UT_THEME_NAME); ?></label>
                                                <p><input type="text" name="<?php $mb->the_name(); ?>"
                                                          value="<?php $mb->the_value(); ?>"/></p>

                                                <?php $mb->the_field('author_image'); ?>
                                                <?php $wpalchemy_media_access->setGroupName('img-auth-testimonial' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

                                                <img class="frame" src="<?php if ($mb->get_the_value()) {
                                                    echo aq_resize($mb->get_the_value(), 75, 75, true);
                                                } ?>"/>

                                                <label><?php _e('Author Image', UT_THEME_NAME); ?></label>
                                                <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                                <br/><span
                                                        class="info badge badge-info">(<?php _e('Image size should be 50x50', UT_THEME_NAME); ?>)</span><br/>
                                                <?php echo $wpalchemy_media_access->getButton(); ?>
                                                </p>

                                                <p><?php $mb->the_field('author_comment'); ?>
                                                    <label for="<?php $mb->the_name(); ?>"><?php _e('Testimonial', UT_THEME_NAME); ?></label>
                                                    <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                                              class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                                </p>

                                                <p><?php $mb->the_field('author_company'); ?>
                                                    <label for="<?php $mb->the_name(); ?>"><?php _e('Testimonial Authors Company', UT_THEME_NAME); ?></label>
                                                    <input type="text" name="<?php $mb->the_name(); ?>"
                                                           value="<?php $mb->the_value(); ?>"/></p>

                                                <a href="#" class="dodelete btn btn-danger"
                                                   style="float:right;"><?php _e('Delete', UT_THEME_NAME); ?></a>
                                                <div class="clear"></div>
                                            </div>

                                            <?php $mb->the_group_close(); ?>
                                        <?php endwhile; ?>

                                        <div class="clear"></div>
                                        <p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-<?php echo UT_THEME_INITIAL . 'home_testimonials'; ?> btn btn-success"><i
                                                        class="icon-book icon-white"></i> <?php _e('Add new testimonial', UT_THEME_NAME); ?></a>
                                        </p>

                                    </div>

                                </div><!-- end opt pad -->

                            </div><!-- end testimonial items -->


                            <?php
                            #-----------------------------------------------------------------
                            # Clients
                            #-----------------------------------------------------------------
                            ?>

                            <div id="home-clients" class="home-clients tab-pane">

                                <div class="lambda-opttitle">
                                    <div class="lambda-opttitle-pad">
                                        <span class="miniicon"><img
                                                    src="<?php echo $theme_path; ?>/lambda/assets/images/icons/add.png"></span><?php _e('Client Section', UT_THEME_NAME); ?>
                                    </div>
                                </div>
                                <div class="lambda-settings-pad clearfix">

                                    <div class="btn-group">

                                        <label><?php _e('Activate Clients', UT_THEME_NAME); ?></label>
                                        <?php $mb->the_field('activate_clients'); ?>

                                        <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>

                                        <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                        <button data-state="activate_clients_on"
                                                class="btn <?php echo $activestate; ?> radio_active" type="button"
                                                value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                        <input id="activate_clients_on" type="radio" value="on"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                        <button data-state="activate_clients_off"
                                                class="btn <?php echo $deactivestate; ?> radio_inactive" type="button"
                                                value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                        <input id="activate_clients_off" type="radio" value="off"
                                               name="<?php $mb->the_name(); ?>" style="display:none;"
                                               class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                    </div>

                                    <hr/>

                                    <p><?php $mb->the_field('client_headline'); ?>
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Client Headline', UT_THEME_NAME); ?></label>
                                        <input type="text" name="<?php $mb->the_name(); ?>"
                                               value="<?php $mb->the_value(); ?>"/>
                                        <br/><span
                                                class="info badge badge-info">(<?php _e('headline above client section', UT_THEME_NAME); ?>)</span>
                                    </p>

                                    <hr/>

                                    <?php $c_layouts = array('2column' => array('name' => __('Client - 4 Column', UT_THEME_NAME),
                                        'value' => '4',
                                        'id' => 'client_two_column'),
                                        '3column' => array('name' => __('Client - 5 Column', UT_THEME_NAME),
                                            'value' => '5',
                                            'id' => 'client_three_column'),
                                    ); ?>

                                    <p>
                                    <ul class="c_layouts">
                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Client Column Layout', UT_THEME_NAME); ?></label>
                                        <?php foreach ($c_layouts as $i => $c_layout): ?>
                                            <?php $mb->the_field(UT_THEME_INITIAL . 'home_client_layout'); ?>
                                            <li>
                                                <label class="radioimage" for="<?php echo $c_layout['id']; ?>">
                                                    <img src="<?php echo $theme_path; ?>/lambda/assets/images/<?php echo $c_layout['id']; ?>.png"
                                                         alt="<?php echo $c_layout['id']; ?>">
                                                </label>
                                                <br/>
                                                <input style="margin-right:10px;" type="radio"
                                                       name="<?php $mb->the_name(); ?>"
                                                       id="<?php echo $c_layout['id']; ?>"
                                                       value="<?php echo $c_layout['value']; ?>"<?php $mb->the_radio_state($c_layout['value']); ?>><?php echo $c_layout['name']; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    </p>

                                    <hr/>

                                    <p><?php $mb->the_field('client_type'); ?>
                                        <label><?php _e('Client Content Type', UT_THEME_NAME); ?></label>
                                        <select name="<?php $mb->the_name(); ?>" class="select_client_type">
                                            <option value=""><?php _e('Select content ...', UT_THEME_NAME); ?></option>
                                            <option value="page"<?php $mb->the_select_state('page'); ?>><?php _e('from an existing page (Client Template)', UT_THEME_NAME); ?></option>
                                            <option value="own"<?php $mb->the_select_state('own'); ?>><?php _e('create own client list', UT_THEME_NAME); ?></option>
                                        </select></p>

                                    <div class="well client_type_page c-toggle">

                                        <p><?php $mb->the_field('client_load_last'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Load last X client logos', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/>
                                        </p>

                                        <p><label><?php _e('Choose Client Page', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('home_client_page'); ?>
                                            <select name="<?php $mb->the_name(); ?>">

                                                <?php $pages = query_posts(array(
                                                    'post_type' => 'page',
                                                    'meta_key' => '_wp_page_template',
                                                    'meta_value' => 'template-clients.php',
                                                    'meta_compare' => '=='
                                                ));

                                                if ($pages) {

                                                    echo '<option value="">-- Choose One --</option>';
                                                    foreach ($pages as $page) {


                                                        //create option
                                                        echo '<option value="' . $page->ID . '" ' . $mb->get_the_select_state($page->ID) . '>' . $page->post_title . '</option>';

                                                    }
                                                } else {

                                                    echo '<option value="0">No Pages Available</option>';

                                                } ?>

                                            </select>
                                            <br/><span
                                                    class="info badge badge-info"><?php _e('Choose Clients from an existing <br /> Client Template', UT_THEME_NAME); ?></span>
                                        </p>

                                    </div>

                                    <div class="well client_type_own c-toggle">

                                        <?php $z = 1;
                                        while ($mb->have_fields_and_multi(UT_THEME_INITIAL . 'home_clients')): ?>
                                            <?php $mb->the_group_open(); ?>

                                            <?php $mb->the_field('imgurl'); ?>
                                            <?php $wpalchemy_media_access->setGroupName('img-n' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                            <div class="one_half <?php echo ($z % 2 == 0) ? 'last' : ''; ?>">
                                                <div class="fancy_box image_item client_highlight">
                                                    <p>

                                                        <img src="<?php if (!$mb->get_the_value()) {
                                                            echo $theme_path . '/lambda/assets/images/nopic.jpg';
                                                        } else {
                                                            echo aq_resize($mb->get_the_value(), 220, 120, true);
                                                        } ?>" class="slider-n<?php echo $z; ?>"/>

                                                    <p><label><?php _e('Image URL', UT_THEME_NAME); ?></label>
                                                        <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                                        <?php echo $wpalchemy_media_access->getButton(); ?>
                                                        <a ref="#" class="dodelete btn btn-danger"><?php _e('Remove', UT_THEME_NAME); ?></a>
                                                    </p>

                                                    <p><?php $mb->the_field('url'); ?>
                                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Client URL', UT_THEME_NAME); ?>
                                                            <span class="optional">(<?php _e('optional', UT_THEME_NAME); ?>)</span></label>
                                                        <input type="text" id="<?php $mb->the_name(); ?>"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/></p>

                                                    <p><?php $mb->the_field('title'); ?>
                                                        <label for="<?php $mb->the_name(); ?>"><?php _e('Set "alt" (for SEO)', UT_THEME_NAME); ?>
                                                            <span class="optional">(<?php _e('optional', UT_THEME_NAME); ?>)</span></label>
                                                        <input type="text" id="<?php $mb->the_name(); ?>"
                                                               name="<?php $mb->the_name(); ?>"
                                                               value="<?php $mb->the_value(); ?>"/></p>

                                                    </p>
                                                </div>
                                            </div>

                                            <?php $z++;
                                            $mb->the_group_close(); ?>
                                        <?php endwhile; ?>

                                        <div class="clear"></div>
                                        <p style="margin-bottom:15px; padding-top:5px;">
                                            <a href="#" class="docopy-<?php echo UT_THEME_INITIAL . 'home_clients'; ?> btn btn-success"><i
                                                        class="icon-book icon-white"></i> <?php _e('add new tab', UT_THEME_NAME); ?></a>
                                        </p>

                                    </div>

                                </div><!-- end opt pad -->

                            </div><!-- end client items -->


                            <?php
                            #-----------------------------------------------------------------
                            # CTA
                            #-----------------------------------------------------------------
                            ?>

                            <div id="home-cta" class="home-cta tab-pane">

                                <div class="btn-group">

                                    <label><?php _e('Activate Call to Action Box', UT_THEME_NAME); ?></label>
                                    <?php $mb->the_field('activate_cta'); ?>

                                    <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>

                                    <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                    <button data-state="activate_cta_on"
                                            class="btn <?php echo $activestate; ?> radio_active" type="button"
                                            value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                    <input id="activate_cta_on" type="radio" value="on" name="<?php $mb->the_name(); ?>"
                                           style="display:none;"
                                           class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                    <button data-state="activate_cta_off"
                                            class="btn <?php echo $deactivestate; ?> radio_inactive" type="button"
                                            value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                    <input id="activate_cta_off" type="radio" value="off"
                                           name="<?php $mb->the_name(); ?>" style="display:none;"
                                           class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                                </div>

                                <p><?php $mb->the_field('cta_main_headline'); ?>
                                    <label for="<?php $mb->the_name(); ?>"><?php _e('Headline', UT_THEME_NAME); ?></label>
                                    <input type="text" name="<?php $mb->the_name(); ?>"
                                           value="<?php $mb->the_value(); ?>"/>
                                    <br/><span
                                            class="info badge badge-info">(<?php _e('Headline above CTA Field', UT_THEME_NAME); ?>)</span>
                                </p>

                                <p><?php $mb->the_field('cta_headline'); ?>
                                    <label for="<?php $mb->the_name(); ?>"><?php _e('CTA Headline', UT_THEME_NAME); ?></label>
                                    <input type="text" name="<?php $mb->the_name(); ?>"
                                           value="<?php $mb->the_value(); ?>"/>
                                    <br/><span
                                            class="info badge badge-info">(<?php _e('Headline for CTA Field', UT_THEME_NAME); ?>)</span>
                                </p>

                                <p><?php $mb->the_field('cta_buttontext'); ?>
                                    <label for="<?php $mb->the_name(); ?>"><?php _e('Buttontext', UT_THEME_NAME); ?></label>
                                    <input type="text" name="<?php $mb->the_name(); ?>"
                                           value="<?php $mb->the_value(); ?>"/>
                                    <br/><span
                                            class="info badge badge-info">(<?php _e('optional', UT_THEME_NAME); ?>)</span>
                                </p>

                                <p><?php $mb->the_field('cta_buttonlink'); ?>
                                    <label for="<?php $mb->the_name(); ?>"><?php _e('Buttonlink', UT_THEME_NAME); ?></label>
                                    <input type="text" name="<?php $mb->the_name(); ?>"
                                           value="<?php $mb->the_value(); ?>"/>
                                    <br/><span
                                            class="info badge badge-info">(<?php _e('optional', UT_THEME_NAME); ?>)</span>
                                </p>

                                <p><?php $mb->the_field('cta_content'); ?>
                                    <label><?php _e('Content', UT_THEME_NAME); ?></label>
                                    <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                              class="lambdatextarea"><?php $mb->the_value(); ?></textarea></p>

                            </div>


                            <?php
                            #-----------------------------------------------------------------
                            # Order Items
                            #-----------------------------------------------------------------
                            ?>

                            <div id="home-item-order" class="home-item-order tab-pane">

                                <div class="lambda-opttitle">
                                    <div class="lambda-opttitle-pad">
                                        <span class="miniicon"><img
                                                    src="<?php echo $theme_path; ?>/lambda/assets/images/icons/add.png"></span><?php _e('Order the Start Elements', UT_THEME_NAME); ?>
                                    </div>
                                </div>

                                <div class="lambda-settings-pad">

                                    <div id="wpa_loop-nebraska_home_items">

                                        <div class="home_item_order simple_ui_box">
                                            <?php echo (!empty($meta['home_item'][0])) ? $meta['home_item'][0] : 'serviceboxes'; ?>
                                            <input type="hidden"
                                                   name="<?php echo UT_THEME_INITIAL . 'metapanel'; ?>[home_item][0]"
                                                   value="<?php echo (!empty($meta['home_item'][0])) ? $meta['home_item'][0] : 'serviceboxes'; ?>"/>
                                        </div>

                                        <div class="home_item_order simple_ui_box">
                                            <?php echo (!empty($meta['home_item'][1])) ? $meta['home_item'][1] : 'servicecolumns'; ?>
                                            <input type="hidden"
                                                   name="<?php echo UT_THEME_INITIAL . 'metapanel'; ?>[home_item][1]"
                                                   value="<?php echo (!empty($meta['home_item'][1])) ? $meta['home_item'][1] : 'servicecolumns'; ?>"/>
                                        </div>

                                        <div class="home_item_order simple_ui_box">
                                            <?php echo (!empty($meta['home_item'][2])) ? $meta['home_item'][2] : 'portfolio'; ?>
                                            <input type="hidden"
                                                   name="<?php echo UT_THEME_INITIAL . 'metapanel'; ?>[home_item][2]"
                                                   value="<?php echo (!empty($meta['home_item'][2])) ? $meta['home_item'][2] : 'portfolio'; ?>"/>
                                        </div>

                                        <div class="home_item_order simple_ui_box">
                                            <?php echo (!empty($meta['home_item'][3])) ? $meta['home_item'][3] : 'blog'; ?>
                                            <input type="hidden"
                                                   name="<?php echo UT_THEME_INITIAL . 'metapanel'; ?>[home_item][3]"
                                                   value="<?php echo (!empty($meta['home_item'][3])) ? $meta['home_item'][3] : 'blog'; ?>"/>
                                        </div>

                                        <div class="home_item_order simple_ui_box">
                                            <?php echo (!empty($meta['home_item'][4])) ? $meta['home_item'][4] : 'testimonials'; ?>
                                            <input type="hidden"
                                                   name="<?php echo UT_THEME_INITIAL . 'metapanel'; ?>[home_item][4]"
                                                   value="<?php echo (!empty($meta['home_item'][4])) ? $meta['home_item'][4] : 'testimonials'; ?>"/>
                                        </div>

                                        <div class="home_item_order simple_ui_box">
                                            <?php echo (!empty($meta['home_item'][5])) ? $meta['home_item'][5] : 'clients'; ?>
                                            <input type="hidden"
                                                   name="<?php echo UT_THEME_INITIAL . 'metapanel'; ?>[home_item][5]"
                                                   value="<?php echo (!empty($meta['home_item'][5])) ? $meta['home_item'][5] : 'clients'; ?>"/>
                                        </div>

                                        <div class="home_item_order simple_ui_box">
                                            <?php echo (!empty($meta['home_item'][6])) ? $meta['home_item'][6] : 'cta'; ?>
                                            <input type="hidden"
                                                   name="<?php echo UT_THEME_INITIAL . 'metapanel'; ?>[home_item][6]"
                                                   value="<?php echo (!empty($meta['home_item'][6])) ? $meta['home_item'][6] : 'cta'; ?>"/>
                                        </div>

                                    </div>

                                </div><!-- end opt pad -->

                            </div><!-- vertical-tab-content -->

                        </div>

                    </div>

                </div><!--Panel content-->

            </div>


            <?php
            #-----------------------------------------------------------------
            # Testimonials
            #-----------------------------------------------------------------
            ?>
            <div id="testimonials-settings" class="testimonials-settings tab-pane">

                <div class="lambda_overlay"></div>

                <div class="ui-panelcontent">

                    <div class="container block">

                        <div class="meta-headline">
                            <h1><?php _e('Manage Testimonial Template', UT_THEME_NAME); ?></h1>
                            <div class="clear"></div>
                        </div>

                        <div class="sixteen columns">

                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <span class="miniicon"><img
                                                src="<?php echo $theme_path; ?>/lambda/assets/images/icons/large/user_comment.png"></span><?php _e('Manage Testimonial', UT_THEME_NAME); ?>
                                </div>
                            </div>
                            <div class="lambda-settings-pad">

                                <?php while ($mb->have_fields_and_multi(UT_THEME_INITIAL . 'testimonial_items')): ?>
                                    <?php $mb->the_group_open(); ?>

                                    <?php $mb->the_field('author_name'); ?>
                                    <div class="testimonial_item_name"><?php if ($mb->get_the_value()) {
                                            $mb->the_value();
                                        } else {
                                            _e('new testimonial', UT_THEME_NAME);
                                        }; ?></div>
                                    <div class="fancy_box testimonial_item">

                                        <?php $mb->the_field('author_image'); ?>
                                        <?php $wpalchemy_media_access->setGroupName('img-auth-testimonial' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

                                        <img class="frame" src="<?php if ($mb->get_the_value()) {
                                            echo aq_resize($mb->get_the_value(), 75, 75, true);
                                        } ?>"/>

                                        <label><?php _e('Author Image', UT_THEME_NAME); ?></label>
                                        <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                        <br/><span
                                                class="info badge badge-info">(<?php _e('Image size should be 50x50', UT_THEME_NAME); ?>)</span><br/>
                                        <?php echo $wpalchemy_media_access->getButton(); ?>
                                        </p>

                                        <p><?php $mb->the_field('author_name'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Testimonial Author Name', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/></p>

                                        <p><label><?php _e('Testimonial Comment', UT_THEME_NAME); ?></label>
                                            <?php $mb->the_field('author_comment'); ?>
                                            <textarea name="<?php $mb->the_name(); ?>" rows="8" cols="75"
                                                      class="lambdatextarea"><?php $mb->the_value(); ?></textarea>
                                            <br/><span
                                                    class="info badge badge-info">(<?php _e('This field accepts shortcodes', UT_THEME_NAME); ?>)</span>
                                        </p>

                                        <p><?php $mb->the_field('author_company'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Testimonial Authors Company', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/></p>

                                        <a href="#" class="dodelete btn red"><?php _e('Remove', UT_THEME_NAME); ?></a>

                                    </div>

                                    <?php $mb->the_group_close(); ?>
                                <?php endwhile; ?>

                                <div class="clear"></div>
                                <p style="margin-bottom:15px; padding-top:5px;">
                                    <a href="#" class="docopy-<?php echo UT_THEME_INITIAL . 'testimonial_items'; ?> btn btn-inverse"><i
                                                class="icon-book icon-white"></i> <?php _e('add new testimonial', UT_THEME_NAME); ?></a>
                                </p>

                            </div>

                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <span class="miniicon"></span><?php _e('Additional Content to display beneath the Testimonials', UT_THEME_NAME); ?>
                                </div>
                            </div>
                            <div class="lambda-settings-pad">

                                <?php $mb->the_field('testimonails_additional_content');

                                $settings = array(
                                    'textarea_rows' => '20',
                                    'media_buttons' => 'true',
                                    'tabindex' => 2
                                );

                                $val = html_entity_decode($mb->get_the_value());
                                $id = $mb->get_the_name();

                                wp_editor($val, $id, $settings);

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            #-----------------------------------------------------------------
            # Vertical Tabs
            #-----------------------------------------------------------------
            ?>
            <div id="verticaltabs-settings" class="verticaltabs-settings tab-pane">

                <div class="lambda_overlay"></div>

                <div class="ui-panelcontent">

                    <div class="container block">

                        <div class="meta-headline">
                            <h1><?php _e('Manage Service Template', UT_THEME_NAME); ?></h1>
                            <div class="clear"></div>
                        </div>

                        <div class="sixteen columns">

                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <span class="miniicon"><img
                                                src="<?php echo $theme_path; ?>/lambda/assets/images/icons/tabbar.png"></span><?php _e('Manage Tabs', UT_THEME_NAME); ?>
                                </div>
                            </div>
                            <div class="lambda-settings-pad">

                                <?php while ($mb->have_fields_and_multi(UT_THEME_INITIAL . 'verticaltabs')): ?>
                                    <?php $mb->the_group_open(); ?>

                                    <?php $mb->the_field('tab_name'); ?>
                                    <div class="testimonial_item_name"><?php if ($mb->get_the_value()) {
                                            $mb->the_value();
                                        } else {
                                            _e('new tab', UT_THEME_NAME);
                                        }; ?></div>

                                    <div class="fancy_box testimonial_item">

                                        <p><?php $mb->the_field('tab_name'); ?>
                                            <label for="<?php $mb->the_name(); ?>"><?php _e('Tab Name', UT_THEME_NAME); ?></label>
                                            <input type="text" name="<?php $mb->the_name(); ?>"
                                                   value="<?php $mb->the_value(); ?>"/></p>

                                        <div class="customEditor">
                                            <?php $mb->the_field('tab_content'); ?>
                                            <div class="wp-editor-tools">
                                                <div class="custom_upload_buttons hide-if-no-js wp-media-buttons"><?php do_action('media_buttons'); ?></div>
                                            </div>
                                            <textarea class="wysiwyg" rows="10" cols="50"
                                                      name="<?php $mb->the_name(); ?>"><?php echo wpautop(esc_html($mb->get_the_value())); ?></textarea>

                                        </div>

                                        <a href="#" class="dodelete btn red"><?php _e('Delete', UT_THEME_NAME); ?></a>

                                    </div>

                                    <?php $mb->the_group_close(); ?>
                                <?php endwhile; ?>

                                <div class="clear"></div>

                                <p style="margin-bottom:15px; padding-top:5px;"><a href="#"
                                                                                   class="docopy-<?php echo UT_THEME_INITIAL . 'verticaltabs'; ?> btn btn-inverse"><i
                                                class="icon-book icon-white"></i> <?php _e('add new service tab', UT_THEME_NAME); ?>
                                    </a>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            #-----------------------------------------------------------------
            # Clients
            #-----------------------------------------------------------------
            ?>
            <div id="client-settings" class="client-settings tab-pane">

                <div class="lambda_overlay"></div>

                <div class="ui-panelcontent">

                    <div class="container block">

                        <div class="meta-headline">
                            <h1><?php _e('Manage Client Template', UT_THEME_NAME); ?></h1>
                            <div class="clear"></div>
                        </div>

                        <div class="sixteen columns">

                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <span class="miniicon"><img
                                                src="<?php echo $theme_path; ?>/lambda/assets/images/icons/tabbar.png"></span><?php _e('Manage Layout', UT_THEME_NAME); ?>
                                </div>
                            </div>

                            <div class="lambda-settings-pad">

                                <?php $c_layouts = array('2column' => array('name' => __('Client - 4 Column', UT_THEME_NAME),
                                    'value' => '4',
                                    'id' => 'client_two_column'),
                                    '3column' => array('name' => __('Client - 5 Column', UT_THEME_NAME),
                                        'value' => '5',
                                        'id' => 'client_three_column')
                                ); ?>

                                <p>
                                <ul class="c_layouts">
                                    <?php foreach ($c_layouts as $i => $c_layout): ?>
                                        <?php $mb->the_field(UT_THEME_INITIAL . 'client_layout'); ?>
                                        <li>
                                            <label class="radioimage" for="<?php echo $c_layout['id']; ?>">
                                                <img src="<?php echo $theme_path; ?>/lambda/assets/images/<?php echo $c_layout['id']; ?>.png"
                                                     alt="<?php echo $c_layout['id']; ?>">
                                            </label>
                                            <br/>
                                            <input style="margin-right:10px;" type="radio"
                                                   name="<?php $mb->the_name(); ?>" id="<?php echo $c_layout['id']; ?>"
                                                   value="<?php echo $c_layout['value']; ?>"<?php $mb->the_radio_state($c_layout['value']); ?>><?php echo $c_layout['name']; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                </p>

                            </div>

                            <div class="lambda-opttitle">
                                <div class="lambda-opttitle-pad">
                                    <span class="miniicon"><img
                                                src="<?php echo $theme_path; ?>/lambda/assets/images/icons/tabbar.png"></span><?php _e('Manage Clients', UT_THEME_NAME); ?>
                                </div>
                            </div>
                            <div class="lambda-settings-pad">

                                <span class="info badge badge-info"><?php _e('We recommend to use identical logo sizes for each client', UT_THEME_NAME); ?></span>

                                <hr/>

                                <?php $z = 1;
                                while ($mb->have_fields_and_multi(UT_THEME_INITIAL . 'client_images')): ?>
                                    <?php $mb->the_group_open(); ?>

                                    <?php $mb->the_field('imgurl'); ?>
                                    <?php $wpalchemy_media_access->setGroupName('img-n' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
                                    <div class="one_third <?php echo ($z % 3 == 0) ? 'last' : ''; ?>">
                                        <div class="fancy_box image_item client_highlight">
                                            <p>

                                                <img src="<?php if (!$mb->get_the_value()) {
                                                    echo $theme_path . '/lambda/assets/images/nopic.jpg';
                                                } else {
                                                    echo aq_resize($mb->get_the_value(), 220, 120, true);
                                                } ?>" class="slider-n<?php echo $z; ?>"/>

                                            <p><label><?php _e('Image URL', UT_THEME_NAME); ?></label>
                                                <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                                                <?php echo $wpalchemy_media_access->getButton(); ?>
                                                <a ref="#"
                                                   class="dodelete btn btn-danger"><?php _e('Remove', UT_THEME_NAME); ?></a>
                                            </p>

                                            <p><?php $mb->the_field('name'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Name for hover effect', UT_THEME_NAME); ?>
                                                    <span class="optional">(<?php _e('optional', UT_THEME_NAME); ?>)</span></label>
                                                <input type="text" id="<?php $mb->the_name(); ?>"
                                                       name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/></p>

                                            <p><?php $mb->the_field('url'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Client URL', UT_THEME_NAME); ?>
                                                    <span class="optional">(<?php _e('optional', UT_THEME_NAME); ?>)</span></label>
                                                <input type="text" id="<?php $mb->the_name(); ?>"
                                                       name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/></p>

                                            <p><?php $mb->the_field('title'); ?>
                                                <label for="<?php $mb->the_name(); ?>"><?php _e('Set "alt" (for SEO)', UT_THEME_NAME); ?>
                                                    <span class="optional">(<?php _e('optional', UT_THEME_NAME); ?>)</span></label>
                                                <input type="text" id="<?php $mb->the_name(); ?>"
                                                       name="<?php $mb->the_name(); ?>"
                                                       value="<?php $mb->the_value(); ?>"/></p>

                                            </p>
                                        </div>
                                    </div>

                                    <?php echo ($z % 3 == 0) ? '<div class="clear"></div>' : ''; ?>

                                    <?php $mb->the_group_close(); ?>
                                    <?php $z++; endwhile; ?>

                                <div class="clear"></div>
                                <p style="margin-bottom:15px; padding-top:5px;">
                                    <a href="#"
                                       class="docopy-<?php echo UT_THEME_INITIAL . 'client_images'; ?> btn btn-info"
                                       style="float:left;">
                                        <?php _e('Add New Client', UT_THEME_NAME); ?>
                                    </a>
                                    <a href="#"
                                       class="dodelete-<?php echo UT_THEME_INITIAL . 'client_images'; ?> btn btn-danger"
                                       style="float:right;">
                                        <?php _e('Remove All Clients', UT_THEME_NAME); ?>
                                    </a>
                                </p>
                                <div class="clear"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php
#-----------------------------------------------------------------
# Infinite Blog Template
#-----------------------------------------------------------------
            ?>
            <div id="infiniteblog-settings" class="infiniteblog-settings tab-pane">

                <div class="lambda_overlay"></div>

                <div class="ui-panelcontent">

                    <div class="container block">

                        <div class="meta-headline">
                            <h1><?php _e('Manage Infinite Blog', UT_THEME_NAME); ?></h1>
                            <div class="clear"></div>
                        </div>

                        <div class="sixteen columns">

                            <div class="btn-group">

                                <label><?php _e('Activate featured Images?', UT_THEME_NAME); ?></label>
                                <?php $mb->the_field('activate_iblog_images'); ?>

                                <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                <button data-state="activate_iblog_images_on"
                                        class="btn <?php echo $activestate; ?> radio_active" type="button"
                                        value="on"><?php _e('show', UT_THEME_NAME); ?></button>
                                <input id="activate_iblog_images_on" type="radio" value="on"
                                       name="<?php $mb->the_name(); ?>" style="display:none;"
                                       class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                <button data-state="activate_iblog_images_off"
                                        class="btn <?php echo $deactivestate; ?> radio_inactive" type="button"
                                        value="off"><?php _e('hide', UT_THEME_NAME); ?></button>
                                <input id="activate_iblog_images_off" type="radio" value="off"
                                       name="<?php $mb->the_name(); ?>" style="display:none;"
                                       class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                            </div>

                            <hr/>

                            <div class="btn-group">

                                <label><?php _e('Activate Blog Excerpt', UT_THEME_NAME); ?></label>
                                <?php $mb->the_field('activate_iblog_excerpt'); ?>

                                <?php $activestate = ($mb->get_the_value() == 'on') ? 'active btn-success' : 'inactive'; ?>
                                <?php $deactivestate = ($mb->get_the_value() == 'off') ? 'active btn-danger' : 'inactive'; ?>

                                <button data-state="activate_iblog_excerpt_on"
                                        class="btn <?php echo $activestate; ?> radio_active" type="button"
                                        value="on"><?php _e('on', UT_THEME_NAME); ?></button>
                                <input id="activate_iblog_excerpt_on" type="radio" value="on"
                                       name="<?php $mb->the_name(); ?>" style="display:none;"
                                       class="radiostate_active" <?php $mb->the_radio_state('on'); ?>>
                                <button data-state="activate_iblog_excerpt_off"
                                        class="btn <?php echo $deactivestate; ?> radio_inactive" type="button"
                                        value="off"><?php _e('off', UT_THEME_NAME); ?></button>
                                <input id="activate_iblog_excerpt_off" type="radio" value="off"
                                       name="<?php $mb->the_name(); ?>" style="display:none;"
                                       class="radiostate_inactive" <?php $mb->the_radio_state('off'); ?>>

                            </div>

                            <hr/>

                            <p><?php $mb->the_field('iblog_excerpt_length'); ?>
                                <label for="<?php $mb->the_name(); ?>"><?php _e('Excerpt length', UT_THEME_NAME); ?></label>
                                <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                                <br/><span class="info badge badge-info">(<?php _e('for example: 55', UT_THEME_NAME); ?>)</span>
                            </p>

                            <p><?php $mb->the_field('iblog_length'); ?>
                                <label for="<?php $mb->the_name(); ?>"><?php _e('Blog length', UT_THEME_NAME); ?></label>
                                <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                                <br/><span
                                        class="info badge badge-info">(<?php _e('how many items to display? for example: 6', UT_THEME_NAME); ?>)</span>
                            </p>

                            <p><?php $mb->the_field('ipost_not_in', WPALCHEMY_FIELD_HINT_SELECT_MULTI); ?>
                                <label for="<?php $mb->the_name(); ?>"><?php _e('Exclude Post (optional)', UT_THEME_NAME); ?></label>
                                <select name="<?php $mb->the_name(); ?>" class="select_post_not_in" multiple="multiple">

                                    <?php $homeposts = &get_posts(array('numberposts' => -1, 'orderby' => 'date'));

                                    if ($homeposts) {

                                        echo '<option value="">' . __('Choose posts to exclude', UT_THEME_NAME) . '</option>';
                                        foreach ($homeposts as $homepost) {
                                            echo '<option value="' . $homepost->ID . '" ' . $mb->get_the_select_state($homepost->ID) . '>' . $homepost->post_title . '</option>';
                                        }

                                    } else {
                                        echo '<option value="0">' . __('No Pages Available', UT_THEME_NAME) . '</option>';
                                    } ?>

                                </select>
                                <br/><span
                                        class="info badge badge-info">(<?php _e('use shift or control to select multiple items', UT_THEME_NAME); ?>)</span>
                            </p>

                            <hr/>

                            <p><?php $mb->the_field('ionly_category', WPALCHEMY_FIELD_HINT_SELECT_MULTI); ?>
                                <label for="<?php $mb->the_name(); ?>"><?php _e('Show only Posts of this category (optional)', UT_THEME_NAME); ?></label>
                                <select name="<?php $mb->the_name(); ?>" class="select_only_category"
                                        multiple="multiple">

                                    <?php $categories = &get_categories(array('hide_empty' => false));

                                    if ($categories) {

                                        echo '<option value="">' . __('Choose', UT_THEME_NAME) . '</option>';
                                        foreach ($categories as $category) {
                                            echo '<option value="' . $category->term_id . '" ' . $mb->get_the_select_state($category->term_id) . '>' . $category->name . '</option>';
                                        }

                                    } else {
                                        echo '<option value="0">' . __('No Categories Available', UT_THEME_NAME) . '</option>';
                                    } ?>
                                </select>
                                <br/><span
                                        class="info badge badge-info">(<?php _e('use shift or control to select multiple items', UT_THEME_NAME); ?>)</span>
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        <?php endif; ?>
    </div><!-- /.tabs -->
</div><!-- /#lambda -->
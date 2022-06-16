<?php

/**
 * Basic Slider Manager
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since framework v 2.0
 */

global $wpdb, $theme_path;

include_once('lambda.slider.class.php');
include_once('lambda.slider.init.php');

include_once('slider-plugins/lambda.flexslider.init.php');
include_once('slider-plugins/lambda.cameraslider.init.php');


#-----------------------------------------------------------------
# Needed JavaScript
#-----------------------------------------------------------------
function lambda_slider_admin_scripts()
{
    global $theme_path;

    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');

    wp_register_script('bootstrap', $theme_path . '/lambda/assets/js/bootstrap.js', array('jquery'), '2.0.3', true);
    wp_enqueue_script('bootstrap');

    wp_register_script('widget', $theme_path . '/lambda/assets/js/jquery.ui.widget.js', array('jquery'), '1.11.1', true);
    wp_enqueue_script('widget');

    wp_register_script('slidermanager', $theme_path . '/lambda/assets/js/lambda.slidermanager.js', array('jquery'), '1.0', true);
    wp_enqueue_script('slidermanager');

    wp_register_script('selectmenu', $theme_path . '/lambda/assets/js/jquery.ui.selectmenu.js', array('jquery'), '1.0', true);
    wp_enqueue_script('selectmenu');

    wp_register_script('tipTip', $theme_path . '/lambda/assets/js/jquery.tipTip.minified.js', array('jquery'), '1.3', true);
    wp_enqueue_script('tipTip');
}


#-----------------------------------------------------------------
# Additional styles
#-----------------------------------------------------------------
function lambda_slider_admin_add_styles()
{
    global $theme_path;

    wp_enqueue_style('thickbox');

    wp_register_style('tipTip', $theme_path . '/lambda/assets/css/tipTip.css');
    wp_enqueue_style('tipTip');

    wp_register_style('addui', $theme_path . '/lambda/assets/css/lambdamod/jquery.ui.all.css');
    wp_enqueue_style('addui');

    wp_register_style('standard-css', $theme_path . '/lambda/assets/css/lambda.ui.css', 999);
    wp_enqueue_style('standard-css');

    wp_register_style('lambda-select', $theme_path . '/lambda/assets/css/lambdamod/jquery.ui.selectmenu.css');
    wp_enqueue_style('lambda-select');
}


#-----------------------------------------------------------------
# Only load Scripts&Styles when needed
#-----------------------------------------------------------------
if (isset($_GET['page']) && $_GET['page'] == 'view_sliders') {
    add_action('admin_init', 'lambda_slider_admin_scripts');
    add_action('admin_print_styles', 'lambda_slider_admin_add_styles');
}


#-----------------------------------------------------------------
# General Output
#-----------------------------------------------------------------
function lambda_slider_admin_page()
{
    echo '<div id="lambda_framework_wrap">';

    //Show Slideroverview
    if ((isset($_GET['page']) && $_GET['page'] == 'view_sliders') && !isset($_GET['edit'])) {
        lambda_slider_overview();
    }

    //Show Slider Edit Page
    if ((isset($_GET['page']) && $_GET['page'] == 'view_sliders') && isset($_GET['edit'])) {
        lambda_slider_edit();
    }

    echo '</div>';
}


#-----------------------------------------------------------------
# Slider Overview - Table Block - will automatically
#-----------------------------------------------------------------
function lambda_slider_overview()
{ ?>
    <div id="lambda-option-panel" class="bootstrap-wpadmin">
        <div id="content_wrap" class="well form-horizontal">

            <div id="lambda-options-panel-title">
                <h1><?php echo _e('Manage your Sliders', UT_THEME_NAME) ?></h1>
                <div class="clear"></div>
            </div>

            <table cellspacing="0" class="table table-striped table-bordered table-condensed">
                <thead>
                <tr>
                    <th scope="col" id="name" colspan="7">
                        <?php _e('List of created sliders', UT_THEME_NAME) ?>
                    </th>
                </tr>
                <tr>
                    <td> <?php _e('ID', UT_THEME_NAME); ?> </td>
                    <td> <?php _e('Slider Name', UT_THEME_NAME); ?> </td>
                    <td> <?php _e('Slider Type', UT_THEME_NAME); ?> </td>
                    <td> <?php _e('Shortcode', UT_THEME_NAME); ?> </td>
                    <td> <?php _e('Edit', UT_THEME_NAME); ?> </td>
                    <td> <?php _e('Delete', UT_THEME_NAME); ?> </td>
                </tr>
                </thead>
                <tbody>
                <?php lambda_slider_view(); ?>
            </table>
        </div>
    </div>
    <?php
} // End Main Slider Function


#-----------------------------------------------------------------
# Display all existing Sliders
#-----------------------------------------------------------------
function lambda_slider_view()
{
    //globals
    global $wpdb, $theme_path, $sm_message;

    //internal counter
    $num = 1;
    $table_lambda_sliders = $wpdb->base_prefix . "lambda_sliders";
    $lambda_slider_data = $wpdb->get_results("SELECT * FROM $table_lambda_sliders ORDER BY id");

    if (is_array($lambda_slider_data)) :
        $id = '';
        foreach ($lambda_slider_data as $data) {

            echo '<tr>
	   			<td>
					' . $data->id . '
				</td>
				<td>
					' . $data->option_name . '
				</td>
				<td>
					' . $data->slidertype . '
				</td>
				<td>
					[lambdaslider id="' . $data->id . '"]
				</td>				
	   			<td>
					<button type="button" onClick="location=\'?page=view_sliders&slidertype=' . $data->slidertype . '&edit=' . $data->option_name . '\'" class="btn btn-mini btn-primary"><i class="icon-edit icon-white"></i></button>        
       			</td>
       			<td>
					<button onClick="location=\'?page=view_sliders&delete=' . $data->option_name . '\'" class="btn btn-mini btn-danger"><i class="icon-remove icon-white"></i></button>
				</td>
			</tr>';
            $num++;

            $id = $data->id;

        } ?>

    <?php endif; ?>

    <tr>
        <td>
            <?php echo($id + 1); ?>
        </td>
        <td colspan="6">
            <form method="post" action="?page=view_sliders&add=1" class="form-horizontal">

                <label class="control-label"><?php _e('Enter Slider Name', UT_THEME_NAME); ?></label>

                <div class="controls">
                    <input type="text" id="option_name" class="lambda_input" name="option_name" size="70"
                           placeholder="<?php _e('Slider Name', UT_THEME_NAME); ?>"/>
                    <br/>
                </div>

                <label class="control-label"><?php _e('Choose Slider Type', UT_THEME_NAME); ?></label>

                <div class="controls">
                    <select name="slidertype" class="lambdaselect">

                        <option value="0"><?php _e('Select Slidertype', UT_THEME_NAME); ?></option>
                        <option value="cameraslider"><?php _e('Camera Slider', UT_THEME_NAME); ?></option>

                    </select>
                    <button type="submit" class="btn btn-success" value="Add new"/>
                        <i class="icon-plus icon-white"></i>
                    </button>
                </div>

                <br/>

                <span class="info"><?php _e('* Do not use spaces or special characters in the name. This Name is only for internal use!', UT_THEME_NAME); ?></span>

            </form>
        </td>
    </tr>
    </tbody>
    <tfoot>

    <?php if ($sm_message) : ?>
        <tr>
            <th scope="col" colspan="7">
                <?php echo '<div class="alert alert-block" id="message"><p><strong>' . $sm_message . '</strong></p></div></div>'; ?>
            </th>
        </tr>
    <?php endif; ?>

    </tfoot>

    <?php
}


#-----------------------------------------------------------------
# Add Slider Item
#-----------------------------------------------------------------
if (isset($_GET['add'])) {

    //assign post data
    $option = isset($_POST['option_name']) ? $_POST['option_name'] : '';
    $slidertype = isset($_POST['slidertype']) ? $_POST['slidertype'] : '';

    if (!get_option($option)) {

        if ($option) {

            $option = preg_replace('/[^a-z0-9\s]/i', '', $option);
            $option = str_replace(" ", "_", $option);
            $table_lambda_sliders = $wpdb->base_prefix . "lambda_sliders";

            $options = get_option($option);

            if ($options || empty($slidertype)) {
                $sm_message = 'Unable to Add ' . $slidertype . ',  different name';
            } else {

                $sql = "INSERT INTO " . $table_lambda_sliders . " values (0,'" . $option . "','" . $slidertype . "','1');";
                if ($wpdb->query($sql)) {

                    add_option($option);
                    $sm_message = $slidertype . ' successfully added';

                } else {
                    $sm_message = 'Unable to Add ' . $slidertype . ', can not insert ' . $slidertype;
                }
            };
        } else {
            $sm_message = ' Unable to Add' . $slidertype;
        }
    } else {
        $sm_message = ' Unable to Add ' . $slidertype . ', try a different name';
    }
}


#-----------------------------------------------------------------
# Delete Slider Item
#-----------------------------------------------------------------
if (isset($_GET['delete'])) {
    $option = $_GET['delete'];
    delete_option($option);

    $table_lambda_sliders = $wpdb->base_prefix . "lambda_sliders";
    $sql = "DELETE FROM " . $table_lambda_sliders . " WHERE option_name='" . $option . "';";
    $wpdb->query($sql);

    $sm_message = __('Slider deleted', UT_THEME_NAME);
}


#-----------------------------------------------------------------
# Deactivate Slider Item
#-----------------------------------------------------------------
if (isset($_GET['deactivate']) && isset($_GET['slidertype'])) {
    $id = $_GET['deactivate'];
    $slidertype = $_GET['slidertype'];

    $table_lambda_sliders = $wpdb->base_prefix . "lambda_sliders";
    $sql = "UPDATE " . $table_lambda_sliders . " SET active='0' WHERE id='" . $id . "';";
    $wpdb->query($sql);

    $sm_message = __('Slider deactivated', UT_THEME_NAME);
}


#-----------------------------------------------------------------
# Activate Slider Item
#-----------------------------------------------------------------
if (isset($_GET['activate']) && isset($_GET['slidertype'])) {
    $id = $_GET['activate'];
    $slidertype = $_GET['slidertype'];

    $table_lambda_sliders = $wpdb->base_prefix . "lambda_sliders";
    $sql = "UPDATE " . $table_lambda_sliders . " SET active='1' WHERE id='" . $id . "';";
    $wpdb->query($sql);

    $sm_message = __('Slider activated', UT_THEME_NAME);
}


#-----------------------------------------------------------------
# Slider Item Edit Section
#-----------------------------------------------------------------
function lambda_slider_edit()
{ ?>

    <div id="lambda-option-panel" class="bootstrap-wpadmin">

        <script type="text/javascript">
            jQuery(document).ready(function ($) {

                /* ------------------------------------------------
                WordPress Media Upload
                ------------------------------------------------ */
                var formfield = "";

                $('.lambda_upload_slider').live('click', function () {
                    formfield = $(this).attr('title');
                    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
                    return false;
                });


                window.send_to_editor = function (html) {
                    imgurl = jQuery('img', html).attr('src');
                    jQuery('#' + formfield).val(imgurl);
                    tb_remove();
                }

            });
        </script>

        <form method="post" action="options.php" class="well form-inline">

            <?php wp_nonce_field('update-options');

            //get needed slider data
            $slider = $_GET['edit'];
            $options = (is_array(get_option($slider))) ? get_option($slider) : array();

            ?>

            <div class="lambda-opttitle">
                <div class="lambda-opttitle-pad settingstitle">
                    <h1><?php echo _e('Slider Manager', UT_THEME_NAME) ?></h1>
                    <input type="submit" class="lambda_save btn btn-success right"
                           value="<?php _e('Save Settings', UT_THEME_NAME) ?>"/>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container">

                        <ul class="options_tabs nav">
                            <li><a href="#general-settings"
                                   data-toggle="tab"><?php _e('General Slider Settings', UT_THEME_NAME); ?></a></li>

                            <?php //<li><a href="#image-settings" data-toggle="tab"><?php _e('Image Source Settings', UT_THEME_NAME); </a></li> ?>

                            <li><a href="#image-items"
                                   data-toggle="tab"><?php _e('Add Slider Items', UT_THEME_NAME); ?></a></li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="tab-content">

                <div id="general-settings" class="tab-pane active">

                    <?php

                    global $wpdb, $theme_path;

                    $table_name = $wpdb->base_prefix . "lambda_sliders";
                    $slider_result = $wpdb->get_row('SELECT * FROM ' . $table_name . ' WHERE option_name = "' . $slider . '"');

                    switch ($slider_result->slidertype) {

                        case "flexslider":
                            $slider_form_options = flexslider_form_array();
                            break;

                        case "supersized":
                            $slider_form_options = supersized_form_array();
                            break;

                        case "elasticslider":
                            $slider_form_options = elastic_form_array();
                            break;

                        case "cameraslider":
                            $slider_form_options = camera_form_array();
                            break;
                    }

                    foreach ($slider_form_options as $key => $value) {

                        $optionvalue = (isset($options[$key])) ? $options[$key] : '';

                        switch ($value['keytype']) {

                            case "input":
                                render_lambda_input($key, $value, $optionvalue, $slider);
                                break;

                            case "select":
                                render_lambda_select($key, $value, $optionvalue, $slider);
                                break;

                            case "radio":
                                render_lambda_radio($key, $value, $optionvalue, $slider);
                                break;

                        }


                    }
                    ?>
                </div><!-- /#general settings -->

                <div id="image-settings" class="tab-pane">
                    <?php

                    $slider_form_options = lambda_slider_source_tab();
                    foreach ($slider_form_options as $key => $value) {

                        $optionvalue = (isset($options[$key])) ? $options[$key] : '';

                        switch ($value['keytype']) {
                            case "input":
                                render_lambda_input($key, $value, $optionvalue, $slider);
                                break;

                            case "select":
                                render_lambda_select($key, $value, $optionvalue, $slider);
                                break;

                            case "radio":
                                render_lambda_radio($key, $value, $optionvalue, $slider);
                                break;
                        }
                    } ?>

                    <div class="lambda_row">
                        <label class="regular_label"><?php _e('Choose Category', UT_THEME_NAME); ?></label><br/>

                        <?php wp_dropdown_categories(array('selected' => $slider['imgCat'],
                                'name' => $slider . '[imgCat]',
                                'orderby' => 'Name',
                                'hierarchical' => 1,
                                'class' => 'lambda_select',
                                'show_option_all' => __("All Categories", UT_THEME_NAME),
                                'hide_empty' => '0')
                        );

                        ?>
                    </div>

                </div><!-- /#image settings -->

                <div id="image-items" class="tab-pane">

                    <button class="add_slider_item btn btn-success" title="<?php echo $_GET['slidertype']; ?>" name="<?php echo $slider; ?>">
                        <i class="icon-picture icon-white"></i> <?php _e('Add Slide', UT_THEME_NAME); ?>
                    </button>

                    <hr/>

                    <div id="single-items">

                        <?php
                        #-----------------------------------------------------------------
                        # Add Items for first call
                        #-----------------------------------------------------------------
                        if (empty($options['slides'])) {
                            $slider_basic_items = lambda_slider_item_array();
                        } else {
                            $slider_basic_items = $options['slides'];
                        }

                        foreach ($slider_basic_items as $key => $value) { ?>

                            <div id="lambda_<?php echo $key; ?>" class="slider_item">

                                <div class="slider-header"><?php echo $value['caption_text']; ?></div>

                                <div class="slider-content">

                                    <div class="lambda-opttitle">
                                        <div class="lambda-opttitle-pad">
                                            <?php _e("Choose an Image", UT_THEME_NAME); ?>
                                        </div>
                                    </div>
                                    <div class="lambda_row section">

                                        <input id="<?php echo $key; ?>" type="text"
                                               name="<?php echo $slider; ?>[slides][<?php echo $key; ?>][imgurl]"
                                               value="<?php echo $value['imgurl']; ?>"/>
                                        <button id="btn_<?php echo $key; ?>"
                                                class="lambda_upload_slider thickbox btn btn-mini btn-success"
                                                title="<?php echo $key; ?>">upload
                                        </button>
                                        <br/>
                                        <br/>
                                        <img src="<?php echo aq_resize($value['imgurl'], 150, 150, true); ?>"/>
                                    </div>


                                    <?php if ($_GET['slidertype'] == 'cameraslider') { ?>

                                        <div class="lambda-opttitle">
                                            <div class="lambda-opttitle-pad">
                                                <?php _e('or place an embedded video code', UT_THEME_NAME); ?>
                                            </div>
                                        </div>
                                        <div class="lambda_row section">

                                            <span class="badge badge-info"><?php _e('You can also insert an image if using a video, this will be used as a poster!', UT_THEME_NAME); ?></span><br/><br/>
                                            <textarea id="caption_<?php echo $key; ?>"
                                                      name="<?php echo $slider; ?>[slides][<?php echo $key; ?>][video]"><?php echo $value['video']; ?></textarea>
                                        </div>

                                    <?php } ?>

                                    <div class="lambda-opttitle">
                                        <div class="lambda-opttitle-pad">
                                            <?php _e('Caption Headline', UT_THEME_NAME); ?>
                                        </div>
                                    </div>
                                    <div class="lambda_row section">

                                        <input id="caption_<?php echo $key; ?>" type="text"
                                               name="<?php echo $slider; ?>[slides][<?php echo $key; ?>][caption_text]"
                                               value="<?php echo $value['caption_text']; ?>"/><br/>

                                    </div>

                                    <?php if ($_GET['slidertype'] == 'cameraslider') { ?>

                                        <div class="lambda-opttitle">
                                            <div class="lambda-opttitle-pad">
                                                <?php _e('Caption Text', UT_THEME_NAME); ?>
                                            </div>
                                        </div>
                                        <div class="lambda_row section">
                                            <textarea class="lambda_textarea" name="<?php echo $slider; ?>[slides][<?php echo $key; ?>][caption_desc]"><?php echo $value['caption_desc']; ?></textarea>
                                        </div>

                                        <?php

                                        $alignvalues['default'] = 'left';
                                        $alignvalues['fullname'] = 'Caption Align';
                                        $alignvalues['keyvalues'] = 'left;right';
                                        $savetarget = $slider . "[slides][" . $key . "][caption_align]";
                                        $captionalign = (isset($value['caption_align'])) ? $value['caption_align'] : 'left';

                                        render_lambda_radio($key, $alignvalues, $captionalign, $slider, true, $savetarget);

                                        ?>


                                        <?php

                                        $alignvalues['default'] = 'white';
                                        $alignvalues['fullname'] = 'Caption Color';
                                        $alignvalues['keyvalues'] = 'white;dark';
                                        $savetarget = $slider . "[slides][" . $key . "][caption_color]";
                                        $captioncolor = (isset($value['caption_color'])) ? $value['caption_color'] : 'white';

                                        render_lambda_radio($key, $alignvalues, $captioncolor, $slider, true, $savetarget);

                                        ?>

                                        <div class="lambda-opttitle">
                                            <div class="lambda-opttitle-pad">
                                                <?php _e('Buttonlink', UT_THEME_NAME); ?>
                                            </div>
                                        </div>
                                        <div class="lambda_row section">
                                            <input id="caption_link_<?php echo $key; ?>" type="text"
                                                   name="<?php echo $slider; ?>[slides][<?php echo $key; ?>][caption_link]"
                                                   value="<?php echo $value['caption_link']; ?>"/>
                                            <br/>
                                        </div>


                                        <div class="lambda-opttitle">
                                            <div class="lambda-opttitle-pad">
                                                <?php _e('Buttontext', UT_THEME_NAME); ?>
                                            </div>
                                        </div>
                                        <div class="lambda_row section">
                                            <input id="buttontext_<?php echo $key; ?>" type="text"
                                                   name="<?php echo $slider; ?>[slides][<?php echo $key; ?>][buttontext]"
                                                   value="<?php echo $value['buttontext']; ?>"/>
                                            <br/>
                                        </div>

                                    <?php } ?>

                                    <button id="btn_del_<?php echo $key; ?>"
                                            class="lambda_delete_slide btn btn-mini btn-danger"
                                            title="lambda_<?php echo $key; ?>">delete
                                    </button>

                                </div>

                            </div>
                        <?php } ?>

                    </div>

                </div><!-- /#image settings -->
            </div><!-- /#tab content -->

            <hr/>

            <div class="lambda-opttitle">
                <div class="lambda-opttitle-pad settingstitle">
                    <input type="hidden" name="action" value="update"/>
                    <input type="hidden" name="page_options" value="<?php echo $slider; ?>"/>
                    <input type="submit" class="lambda_save btn btn-success right"
                           value="<?php _e('Save Settings', UT_THEME_NAME) ?>"/>
                    <div class="clear"></div>
                </div>
            </div>
        </form>
    </div><!-- /#option panel -->
    <?php
}

if (!function_exists('render_lambda_input')) {
    function render_lambda_input($key, $value, $optionvalue, $slider)
    {
        //assign value
        (empty($optionvalue)) ? $input_value = 'value="' . $value['default'] . '"' : $input_value = 'value="' . $optionvalue . '"';

        $render_field = '<div class="lambda-opttitle"><div class="lambda-opttitle-pad">' . $value['fullname'] . '</div></div>
				<div class="lambda_row section">
				<input type="text" ' . $input_value . ' name="' . $slider . '[' . $key . ']" id="' . $key . '" class="left lambda_input_small">
				<div class="desc alert alert-success" style="display:block !important;">' . $value['description'] . '</div><div class="clear"></div></div>';

        echo $render_field;
    }
}

if (!function_exists('render_lambda_textarea')) {
    function render_lambda_textarea($key, $value, $optionvalue, $slider)
    {
        //assign value
        (empty($optionvalue)) ? $input_value = 'value="' . $value['default'] . '"' : $input_value = 'value="' . $optionvalue . '"';

        $render_field = '<div class="lambda-opttitle"><div class="lambda-opttitle-pad">' . $value['fullname'] . '</div></div>
				<textarea ' . $input_value . ' name="' . $slider . '[' . $key . ']" id="' . $key . '" class="left lambda_textarea"></textarea>
				<div class="desc alert alert-success" style="display:block !important;">' . $value['description'] . '</div><div class="clear"></div></div>';

        echo $render_field;
    }
}

if (!function_exists('render_lambda_select')) {

    function render_lambda_select($key, $value, $optionvalue, $slider)
    {
        $values = explode(";", $value['keyvalues']);

        if (is_array($values)) {

            $render_field = '<div class="lambda-opttitle"><div class="lambda-opttitle-pad">' . $value['fullname'] . '</div></div><div class="lambda_row section"><select name="' . $slider . '[' . $key . ']" id="' . $key . '" class="lambda_select">';

            foreach ($values as $singe_value) {

                $value_pair = explode('=', trim($singe_value));

                if (isset($value_pair[0]) && isset($value_pair[1])) {

                    //reset select value
                    $selected = '';

                    if ($optionvalue == $value_pair[1]) {
                        $selected = 'selected="selected"';
                    }

                    $render_field .= '<option ' . $selected . '  value="' . $value_pair[1] . '">' . $value_pair[0] . '</option>';

                } else {

                    //reset select value
                    $selected = '';

                    if ($optionvalue == $singe_value) {
                        $selected = 'selected="selected"';
                    }

                    $render_field .= '<option ' . $selected . '  value="' . $singe_value . '">' . $singe_value . '</option>';

                }
            }

            $render_field .= '</select>';

            if (isset($value['description']))
                $render_field .= '<div class="desc alert alert-success" style="display:block !important;">' . $value['description'] . '</div>';

            $render_field .= '<div class="clear"></div></div>';

            echo $render_field;
        }
    }
}

if (!function_exists('render_lambda_radio')) {
    function render_lambda_radio($key, $value, $optionvalue, $slider, $custom = false, $customarray = '')
    {
        $values = explode(";", $value['keyvalues']);

        if (is_array($values)) { ?>

            <?php

            $render_field = '<div class="lambda-opttitle"><div class="lambda-opttitle-pad">' . $value['fullname'] . '</div></div><div class="lambda_row section"><p class="btn-group left" data-toggle="buttons-radio">';
            $count = 0;

            foreach ($values as $singe_value) {

                ($singe_value == "true") ? $display_value = 'yes' : $display_value = 'no';

                if ($custom) {
                    $display_value = $singe_value;
                }

                //reset select value
                $checked = '';
                $checkedlabel = 'inactive';

                if ($optionvalue == $singe_value) {
                    $checkedlabel = 'active';
                    $checked = 'checked="checked"';
                }

                if (!$optionvalue && $singe_value == $value['default']) {
                    $checkedlabel = 'active';
                    $checked = 'checked="checked"';
                }

                $savetarget = (!empty($customarray)) ? $customarray : $slider . '[' . $key . ']';

                //$render_field .= '<input name="'.$slider.'['.$key.']" type="radio" '.$checked.' value="'.remove_trash($singe_value).'" id="'.$key.remove_trash($singe_value).'" /><label for="'.$key.remove_trash($singe_value).'">'.$display_value.'</label>';

                $render_field .= '<button value="' . $key . remove_trash($singe_value) . '_' . $count . '" type="button" class="btn ' . $checkedlabel . ' radio_' . $checkedlabel . '">' . $display_value . '</button>';
                $render_field .= '<input class="radiostate_' . $checkedlabel . '" style="display:none;" name="' . $savetarget . '" id="' . $key . remove_trash($singe_value) . '_' . $count . '" type="radio" value="' . remove_trash($singe_value) . '" ' . $checked . '/>';
                $count++;

            }
        }

        $render_field .= '</p>';

        if (isset($value['description']))
            $render_field .= '<div class="desc alert alert-success right" style="display:block !important;">' . $value['description'] . '</div>';

        $render_field .= '<div class="clear"></div></div>';

        echo $render_field;
    }
}

?>
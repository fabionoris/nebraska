<?php

$absolute_path = __FILE__;
$path_to_file = explode('wp-content', $absolute_path);
$path_to_wp = $path_to_file[0];

// Access to WordPress
require_once($path_to_wp . '/wp-load.php');
$themepath = get_template_directory_uri();

$slider = $_GET['slidername'];
$key = 'slide_' . $_GET['slideid'];

?>

<div id="lambda_<?php echo $key; ?>" class="slider_item">

    <div class="slider-header"></div>

    <div class="slider-content">

        <div class="lambda-opttitle">
            <div class="lambda-opttitle-pad">
                <?php _e("Choose an Image", UT_THEME_NAME); ?>
            </div>
        </div>
        <div class="lambda_row section">
            <input id="<?php echo $key; ?>" type="text"
                   name="<?php echo $slider; ?>[slides][<?php echo $key; ?>][imgurl]" value=""/>
            <button id="btn_<?php echo $key; ?>" class="lambda_upload_slider thickbox btn btn-mini btn-success"
                    title="<?php echo $key; ?>"><?php _e('upload', UT_THEME_NAME); ?></button>
        </div>

        <?php if ($_GET['slidertype'] == 'cameraslider') { ?>
            <div class="lambda-opttitle">
                <div class="lambda-opttitle-pad">
                    <?php _e('or place an embedded video code', UT_THEME_NAME); ?>
                </div>
            </div>
            <div class="lambda_row section">
                <span class="badge badge-info">
			        <?php _e('You can also insert an image if using a video, this will be used as a poster!', UT_THEME_NAME); ?>
			    </span>
                <br/>
                <br/>
                <textarea id="caption_<?php echo $key; ?>"
                          name="<?php echo $slider; ?>[slides][<?php echo $key; ?>][video]"></textarea>
            </div>
        <?php } ?>

        <div class="lambda-opttitle">
            <div class="lambda-opttitle-pad">
                <?php _e('Caption Headline', UT_THEME_NAME); ?>
            </div>
        </div>
        <div class="lambda_row section">
            <input id="caption_<?php echo $key; ?>" type="text"
                   name="<?php echo $slider; ?>[slides][<?php echo $key; ?>][caption_text]" value=""/>
            <br/>
        </div>

        <?php if ($_GET['slidertype'] == 'cameraslider') { ?>

            <div class="lambda-opttitle">
                <div class="lambda-opttitle-pad">
                    <?php _e('Caption Text', UT_THEME_NAME); ?>
                </div>
            </div>
            <div class="lambda_row section">
                <textarea class="lambda_textarea"
                          name="<?php echo $slider; ?>[slides][<?php echo $key; ?>][caption_desc]"></textarea>
            </div>

            <?php

            $alignvalues['default'] = 'left';
            $alignvalues['fullname'] = 'Caption Align';
            $alignvalues['keyvalues'] = 'left;right';
            $savetarget = $slider . "[slides][" . $key . "][caption_align]";

            render_lambda_radio($key, $alignvalues, $value['caption_align'], $slider, true, $savetarget);

            ?>

            <?php

            $alignvalues['default'] = 'white';
            $alignvalues['fullname'] = 'Caption Color';
            $alignvalues['keyvalues'] = 'white;dark';
            $savetarget = $slider . "[slides][" . $key . "][caption_color]";

            render_lambda_radio($key, $alignvalues, $value['caption_color'], $slider, true, $savetarget);

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
                <input id="caption_link_<?php echo $key; ?>" type="text"
                       name="<?php echo $slider; ?>[slides][<?php echo $key; ?>][buttontext]"
                       value="<?php echo $value['buttontext']; ?>"/>
                <br/>
            </div>

        <?php } ?>

        <button id="btn_del_<?php echo $key; ?>" class="lambda_delete_slide btn btn-mini btn-danger"
                title="lambda_<?php echo $key; ?>">delete
        </button>

    </div>
</div>
</div>
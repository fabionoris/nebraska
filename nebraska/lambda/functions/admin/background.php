<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');

/**
 * Background Option
 *
 * @access public
 * @param array $value
 * @param array $settings
 * @param int $int
 *
 * @return string
 * @since 1.1.8
 *
 */
function option_tree_background($value, $settings, $int)
{ ?>
    <div class="option option-background-upload" id="<?php echo $value->item_id; ?>_div">
        <div class="lambda-opttitle">
            <div class="lambda-opttitle-pad">
                <?php echo htmlspecialchars_decode($value->item_title); ?>
                <span class="infoButton right">
				<img class="infoImage" src="<?php echo OT_PLUGIN_URL; ?>/assets/images/info.png" width="40px"
                     height="20px" alt="Info" style="left: 0px;">
		</span>
            </div>
        </div>
        <div class="section">
            <div class="element">
                <script type="text/javascript">
                    jQuery(document).ready(function ($) {
                        $('#<?php echo $value->item_id; ?>-picker').ColorPicker({
                            onSubmit: function (hsb, hex, rgb) {
                                $('#<?php echo $value->item_id; ?>-picker').val('#' + hex);
                            },
                            onBeforeShow: function () {
                                $(this).ColorPickerSetColor(this.value);
                                return false;
                            },
                            onChange: function (hsb, hex, rgb) {
                                $('#cp_<?php echo $value->item_id; ?> div').css({
                                    'backgroundColor': '#' + hex,
                                    'backgroundImage': 'none',
                                    'borderColor': '#' + hex
                                });
                                $('#cp_<?php echo $value->item_id; ?>').prev('input').attr('value', '#' + hex);
                            }
                        })
                            .bind('keyup', function () {
                                $(this).ColorPickerSetColor(this.value);
                            });
                    });
                </script>

                <div class="select_wrapper">
                    <label><?php _e('Background-Color', UT_THEME_NAME); ?></label>
                    <input type="text" name="<?php echo $value->item_id; ?>[background-color]"
                           id="<?php echo $value->item_id; ?>-picker"
                           value="<?php echo (isset($settings[$value->item_id]['background-color'])) ? stripslashes($settings[$value->item_id]['background-color']) : ''; ?>"
                           class="cp_input"/>
                    <div id="cp_<?php echo $value->item_id; ?>" class="cp_box">
                        <div style="background-color:<?php echo (isset ($settings[$value->item_id]['background-color'])) ? $settings[$value->item_id]['background-color'] : '#ffffff'; ?>;<?php if (isset($settings[$value->item_id]['background-color'])) {
                            echo 'background-image:none;border-color:' . $settings[$value->item_id]['background-color'] . ';';
                        } ?>">
                        </div>
                    </div>
                </div>
                <div class="clear"></div>

                <div class="select_wrapper background-repeat">
                    <p>
                        <label><?php _e('Background-Repeat', UT_THEME_NAME); ?></label>
                        <select name="<?php echo $value->item_id; ?>[background-repeat]" class="select">
                            <?php
                            echo '<option value="">background-repeat</option>';
                            foreach (recognized_background_repeat() as $key => $repeat) {
                                echo '<option value="' . esc_attr($key) . '" ' . selected($settings[$value->item_id]['background-repeat'], $key, false) . '>' . esc_html($repeat) . '</option>';
                            }
                            ?>
                        </select>
                    </p>
                </div>

                <div class="select_wrapper background-attachment">
                    <p>
                        <label><?php _e('Background-Attachment', UT_THEME_NAME); ?></label>
                        <select name="<?php echo $value->item_id; ?>[background-attachment]" class="select">
                            <?php
                            echo '<option value="">background-attachment</option>';
                            foreach (recognized_background_attachment() as $key => $attachment) {
                                echo '<option value="' . esc_attr($key) . '" ' . selected($settings[$value->item_id]['background-attachment'], $key, false) . '>' . esc_html($attachment) . '</option>';
                            }
                            ?>
                        </select>
                    </p>
                </div>

                <div class="select_wrapper background-position">
                    <p>
                        <label><?php _e('Background-Position', UT_THEME_NAME); ?></label>
                        <select name="<?php echo $value->item_id; ?>[background-position]" class="select">
                            <?php
                            echo '<option value="">background-position</option>';
                            foreach (recognized_background_position() as $key => $position) {
                                echo '<option value="' . esc_attr($key) . '" ' . selected($settings[$value->item_id]['background-position'], $key, false) . '>' . esc_html($position) . '</option>';
                            }
                            ?>
                        </select>
                    </p>
                </div>
                <label><?php _e('Background-Image', UT_THEME_NAME); ?></label>
                <input type="text" name="<?php echo $value->item_id; ?>[background-image]"
                       id="<?php echo $value->item_id; ?>"
                       value="<?php if (isset($settings[$value->item_id]['background-image'])) {
                           echo $settings[$value->item_id]['background-image'];
                       } ?>" class="upload<?php if (isset($settings[$value->item_id]['background-image'])) {
                    echo ' has-file';
                } ?>"/>
                <input id="upload_<?php echo $value->item_id; ?>" class="upload_button" type="button" value="Upload"
                       rel="<?php echo $int; ?>"/>
                <?php if (is_array(@getimagesize($settings[$value->item_id]['background-image']))) { ?>
                    <div class="screenshot" id="<?php echo $value->item_id; ?>_image">
                        <?php
                        if (isset($settings[$value->item_id]['background-image']) && $settings[$value->item_id]['background-image'] != '') {
                            $remove = '<a href="javascript:(void);" class="remove">Remove</a>';
                            $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $settings[$value->item_id]['background-image']);
                            if ($image) {
                                echo '<img src="' . $settings[$value->item_id]['background-image'] . '" alt="" />' . $remove . '';
                            }
                        }
                        ?>
                    </div>
                <?php } ?>
            </div> <?php if ($value->item_desc) { ?>
                <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode($value->item_desc); ?></div>
                <div class="clear"></div>
            <?php } ?>
        </div>
    </div>
    <?php
}
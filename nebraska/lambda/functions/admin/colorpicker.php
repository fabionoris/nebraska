<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');

/**
 * ColorPicker Option
 *
 * @access public
 * @param array $value
 * @param array $settings
 * @param int $int
 *
 * @return string
 * @since 1.0.0
 *
 */
function option_tree_colorpicker($value, $settings, $int)
{
    ?>
    <div class="option option-colorpicker" id="<?php echo $value->item_id; ?>_div">
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
                        $('#<?php echo $value->item_id; ?>').ColorPicker({
                            onSubmit: function (hsb, hex, rgb) {
                                $('#<?php echo $value->item_id; ?>').val('#' + hex);
                            },
                            onBeforeShow: function () {
                                $(this).ColorPickerSetColor(this.value);
                                return false;
                            },
                            onChange: function (hsb, hex, rgb) {
                                $('#cp_<?php echo $value->item_id; ?> div').css({'backgroundColor': '#' + hex});
                                $('#cp_<?php echo $value->item_id; ?>').prev('input').attr('value', '#' + hex);

                                //Theme scheme color changer
                                if ("<?php echo $value->item_id; ?>" == "themecolor") {
                                    $('#color_scheme_1').val('#' + hex);
                                    $('.color_scheme_1').css('background-color', '#' + hex);
                                }
                            }
                        }).bind('keyup', function () {
                            $(this).ColorPickerSetColor(this.value);
                        });
                    });
                </script>
                <input type="text" name="<?php echo $value->item_id; ?>" id="<?php echo $value->item_id; ?>"
                       value="<?php echo (isset($settings[$value->item_id])) ? stripslashes($settings[$value->item_id]) : ''; ?>"
                       class="cp_input span3"/>
                <div id="cp_<?php echo $value->item_id; ?>" class="cp_box">
                    <div style="background-color:<?php echo (isset ($settings[$value->item_id])) ? $settings[$value->item_id] : '#ffffff'; ?>;">
                    </div>
                </div>

                <small>Click text box for color picker</small>
            </div> <?php if ($value->item_desc) { ?>
                <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode($value->item_desc); ?></div>
                <div class="clear"></div>
            <?php } ?>
        </div>
    </div>
    <?php
}
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
function option_tree_checkbox($value, $settings, $int)
{
    ?>
    <div class="option option-checbox">
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

                <div class="btn-group" data-toggle="buttons-checkbox">
                    <?php
                    // check for settings item value
                    if (isset($settings[$value->item_id])) {
                        $ch_values = (array)$settings[$value->item_id];
                    } else {
                        $ch_values = array();
                    }
                    $count = 0;
                    // loop through options array
                    foreach (explode(',', $value->item_options) as $option) {

                        $checked = '';
                        $active = __('Inactive', UT_THEME_NAME);

                        if (in_array(trim($option), $ch_values)) {
                            $checked = ' checked="checked"';
                            $active = __('Active', UT_THEME_NAME);
                        }

                        echo '<div class="input_wrap">
			<input style="float:left; margin-right:10px;" name="' . $value->item_id . '[' . $count . ']" id="' . $value->item_id . '_' . $count . '" type="checkbox" value="' . trim($option) . '"' . $checked . ' /><label for="' . $value->item_id . '_' . $count . '">' . trim($option) . '</label>
			</div>';
                        $count++;
                    }
                    ?>
                </div>

            </div> <?php if ($value->item_desc) { ?>
                <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode($value->item_desc); ?></div>
                <div class="clear"></div>
            <?php } ?>
        </div>
    </div>
    <?php
}
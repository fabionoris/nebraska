<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');

/**
 * Radio Option
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
function option_tree_radio($value, $settings, $int)
{
    ?>
    <div class="option option-radio">
        <div class="lambda-opttitle">
            <div class="lambda-opttitle-pad">
                <?php echo htmlspecialchars_decode($value->item_title); ?>
                <span class="infoButton right">
				<img class="infoImage" src="<?php echo OT_PLUGIN_URL; ?>/assets/images/info.png" alt="Info"
                     style="left: 0px;">
			</span>
            </div>
        </div>
        <div class="section">
            <div class="element">

                <p class="btn-group" data-toggle="buttons-radio">
                    <?php
                    // Check for settings item value
                    if (isset($settings[$value->item_id])) {
                        $ch_values = (array)$settings[$value->item_id];
                    } else {
                        $ch_values = array();
                    }
                    $count = 0;
                    // Loop through options array
                    foreach (explode(',', $value->item_options) as $option) {

                        $checkedlabel = 'inactive';
                        $checked = '';

                        if (in_array(trim($option), $ch_values)) {

                            $checkedlabel = 'active';
                            $checked = 'checked="checked"';

                        }
                        //<label for="'.$value->item_id.'_'.$count.'" class="'.$checkedlabel.'">'.trim( $option ).'</label>
                        echo '<button value="' . $value->item_id . '_' . $count . '" type="button" class="btn ' . $checkedlabel . ' radio_' . $checkedlabel . '">' . trim($option) . '</button>';
                        echo '<input class="radiostate_' . $checkedlabel . '" style="display:none;" name="' . $value->item_id . '" id="' . $value->item_id . '_' . $count . '" type="radio" value="' . trim($option) . '" ' . $checked . '/>';
                        $count++;
                    }
                    ?>
                </p>


            </div>

            <?php if ($value->item_desc) { ?>
                <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode($value->item_desc); ?></div>
                <div class="clear"></div>
            <?php } ?>

        </div>
    </div>

    <?php
}
<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');

/**
 * Select Option
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
function option_tree_select($value, $settings, $int)
{
    ?>
    <div class="option option-select" id="<?php echo $value->item_id; ?>_div">
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
                <?php $options_array = explode(',', $value->item_options); ?>
                <div class="select_wrapper">
                    <select name="<?php echo $value->item_id; ?>" id="<?php echo $value->item_id; ?>" class="select">
                        <?php
                        echo '<option value="">-- Choose One --</option>';
                        foreach ($options_array as $option) {
                            $selected = '';
                            $value_pair = explode('=', trim($option));
                            if (isset($value_pair[0]) && isset($value_pair[1])) {

                                echo '<option value="' . esc_attr($value_pair[0]) . '" ' . selected($settings[$value->item_id], $value_pair[0], false) . '>' . esc_html($value_pair[1]) . '</option>';

                            } else {

                                echo '<option value="' . esc_attr(trim($option)) . '" ' . selected($settings[$value->item_id], trim($option), false) . '>' . esc_html($option) . '</option>';

                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <?php if ($value->item_desc) { ?>
                <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode($value->item_desc); ?></div>
                <div class="clear"></div>
            <?php } ?>

        </div>
    </div>
    <?php
}
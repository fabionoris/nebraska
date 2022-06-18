<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');

/**
 * Image Start Effects
 *
 * @access public
 * @param array $value
 * @param array $settings
 * @param int $int
 *
 * @return string
 * @since lambda 2.1
 *
 */
function option_tree_image_hover($value, $settings, $int)
{
    ?>
    <div class="option option-select">
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

                    <select name="<?php echo $value->item_id; ?>[easing]" class="select">
                        <?php
                        echo '<option value="">' . __('-- Choose Image Hover Effect --', UT_THEME_NAME) . '</option>';
                        foreach (recognized_slice_effects() as $key => $variant) {
                            echo '<option value="' . esc_attr($key) . '" ' . selected($settings[$value->item_id]['easing'], $key, false) . '>' . esc_html($variant) . '</option>';
                        }
                        ?>
                    </select>

                </div>
            </div> <?php if ($value->item_desc) { ?>
                <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode($value->item_desc); ?></div>
                <div class="clear"></div>
            <?php } ?>
        </div>
    </div>
    <?php
}
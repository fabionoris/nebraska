<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');

/**
 * Color Scheme
 *
 * @param array $value
 * @param array $settings
 * @param int $int
 *
 * @return string
 * @since Lambda 2.0
 *
 */
function option_tree_color_scheme($value, $settings, $int)
{ ?>
    <div class="option">
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

            <fieldset id="choosecolor">
                <?php
                global $theme_path;
                $count = 1;

                foreach (recognized_color_schemes() as $key => $singlecolor) {

                    $checked = '';
                    if ($settings[$value->item_id] == $singlecolor) {
                        $checked = ' checked="checked"';
                    }

                    if ($key == 'Custom' && $value->item_id . '_' . $count == 'color_scheme_1') {
                        $singlecolor = get_option_tree('themecolor');
                        $singlecolor = $singlecolor['hex'];
                        $checked = ' checked="checked"';
                    }

                    $datascheme = str_replace(' ', '', $key);

                    echo '<div class="color-scheme-box" data-scheme="' . trim(strtolower($datascheme)) . '">
					  <input class="check-with-label" name="' . $value->item_id . '" id="' . $value->item_id . '_' . $count . '" type="radio" value="' . $singlecolor . '"' . $checked . ' />
					  <label class="label-for-color" for="' . $value->item_id . '_' . $count . '"><div class="color color_scheme_' . $count . '" style="background-color: ' . $singlecolor . ';"><img src="' . $theme_path . '/lambda/assets/images/colorlayer.png"></div></label>
					  <span class="colorbadge">' . $key . '</span>
					  </div>';

                    $count++;

                }

                ?>
            </fieldset>

            <?php if ($value->item_desc) { ?>
                <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode($value->item_desc); ?></div>
                <div class="clear"></div>
            <?php } ?>
        </div>
    </div>
    <?php
}
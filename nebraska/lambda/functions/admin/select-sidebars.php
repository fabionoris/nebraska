<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');

/**
 * select sidebars
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since Passion 1.0
 */
function option_tree_select_sidebars($value, $settings, $int)
{
    global $wp_registered_sidebars;

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
                <div class="select_wrapper">
                    <select name="<?php echo $value->item_id; ?>" id="<?php echo $value->item_id; ?>" class="select">
                        <?php
                        if (isset($settings[$value->item_id])) {
                            $chosensidebar = htmlspecialchars(stripslashes($settings[$value->item_id]), ENT_QUOTES);
                        }

                        echo '<option value="">-- Choose One --</option>';

                        $i = 1;
                        foreach ($wp_registered_sidebars as $sidebarkey => $sidebardetails) {
                            if ($chosensidebar == $sidebarkey) {
                                echo '<option value="' . $sidebarkey . '" selected="selected">' . esc_html($sidebardetails['name']) . '</option>';
                            } else {
                                echo '<option value="' . $sidebarkey . '">' . esc_html($sidebardetails['name']) . '</option>';
                            }

                            $i++;
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
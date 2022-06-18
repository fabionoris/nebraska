<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');

/**
 * Textarea Option
 *
 * @access public
 * @param array $value
 * @param array $settings
 * @param int $int
 *
 * @return string
 * @since 1.0.0
 */
function option_tree_textarea($value, $settings, $int)
{
    ?>
    <div class="option option-textarea">
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
        <textarea class="input-xlarge" name="<?php echo $value->item_id; ?>" rows="<?php echo $int; ?>"><?php
            if (isset($settings[$value->item_id]))
                echo stripslashes($settings[$value->item_id]);
            ?>
        </textarea>
            </div>
            <?php if ($value->item_desc) { ?>
            <div class="desc alert alert-neutral">
                <?php echo htmlspecialchars_decode($value->item_desc); ?>
            </div>
            <div class="clear"></div>
            <?php } ?>
        </div>
    </div>
    <?php
}
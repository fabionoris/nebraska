<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');

/**
 * JavaScript Group Opener
 */
function option_tree_jsgroupopen($value, $settings, $int)
{
    ?>

    <div class="lambda-opttitle">
        <div class="lambda-opttitle-pad">
            <?php echo htmlspecialchars_decode($value->item_title); ?>
        </div>
    </div>

    <div class="javagroup" id="<?php echo $value->item_id; ?>_div" style="padding-top:20px;">

    <?php if ($value->item_desc) : ?>
        <div class="alert alert-info"
             style="margin-bottom:20px;"><?php echo htmlspecialchars_decode($value->item_desc); ?></div>
    <?php endif; ?>

    <?php
}
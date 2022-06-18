<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');

/**
 * Image Clients Option
 */
function option_tree_clients($value, $settings, $int)
{
    ?>
    <div class="option option-option-tree-clients">
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
                <?php $count = 0; ?>
                <ul class="ui-sortable option-tree-clients-wrap" id="<?php echo $value->item_id; ?>_list">
                    <?php
                    if (!empty($settings[$value->item_id])) {
                        foreach ($settings[$value->item_id] as $image) { ?>
                            <li><?php option_tree_clients_view($value->item_id, $image, $int, $count); ?></li><?php
                            $count++;
                        }
                    }
                    ?>
                </ul>
                <a href="#" id="<?php echo $value->item_id; ?>" class="btn-mini btn-success add-clients right">Add
                    Clients Media</a>
            </div> <?php if ($value->item_desc) { ?>
                <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode($value->item_desc); ?></div>
                <div class="clear"></div>
            <?php } ?>
        </div>
    </div>
    <?php
}

/**
 * Clients HTML
 */
function option_tree_clients_view($id, $image, $int, $count)
{
    // required fileds
    $requred_fields = array(
        array(
            'name' => 'order',
            'type' => 'hidden',
            'label' => '',
            'class' => 'option-tree-clients-order'
        ),
        array(
            'name' => 'title',
            'type' => 'text',
            'label' => 'Title',
            'class' => 'option-tree-clients-title'
        )
    );

    // Optional fields
    $image_clients_fields = array(
        array(
            'name' => 'image',
            'type' => 'image',
            'label' => 'Image URL',
            'class' => ''
        ),
        array(
            'name' => 'link',
            'type' => 'text',
            'label' => 'Link URL',
            'class' => 'clients_url'
        )
    );

    // Filter the optional fields
    $image_clients_fields = apply_filters('image_clients_fields', $image_clients_fields, $id);

    // Merge required & optional arrays
    $image_clients_fields = array_merge($requred_fields, $image_clients_fields);
    ?>
    <div id="option-tree-clients-editor_<?php echo $count; ?>" class="option-tree-clients">

        <div class="open simple_ui_box">

	<span class="dynamictitle">
	<?php echo empty($image['title']) ? "Clients Icon " . ($count + 1) : stripslashes($image['title']); ?>
    </span>

            <a href="#" class="edit btn-mini btn-success"><i class="icon-edit icon-white"></i></a>
            <a href="#" class="trash remove-clients btn-mini btn-danger"><i class="icon-remove icon-white"></i></a>

            <div class="option-tree-clients-body">
                <?php
                foreach ($image_clients_fields as $field) {

                    if ($field['type'] == 'image' || $field['name'] == 'image') { ?>
                        <div>
                            <label><?php echo $field['label']; ?></label><br/>
                            <input type="text"
                                   name="<?php echo $id; ?>[<?php echo $count; ?>][<?php echo $field['name']; ?>]"
                                   id="<?php echo $id; ?>-<?php echo $count; ?>-<?php echo $field['name']; ?>"
                                   value="<?php echo(isset($image[$field['name']]) ? stripslashes($image[$field['name']]) : ''); ?>"
                                   class="upload<?php if (isset($image[$field['name']])) {
                                       echo ' has-file';
                                   } ?>"/>
                            <input id="upload_<?php echo $id ?>-<?php echo $count ?>-<?php echo $field['name'] ?>"
                                   class="upload_button" type="button" value="Upload" rel="<?php echo $int; ?>"/>
                            <div class="screenshot"
                                 id="<?php echo $id ?>-<?php echo $count ?>-<?php echo $field['name'] ?>_image">
                                <?php
                                if (isset($image[$field['name']]) && $image[$field['name']] != '') {
                                    $remove = '<a href="javascript:(void);" class="remove">Remove</a>';
                                    $screenshot_image = $image[$field['name']];
                                    $new_image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $image[$field['name']]);
                                    if ($new_image) {
                                        echo '<img src="' . $screenshot_image . '" alt="" />' . $remove . '';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <?php
                    } else if ($field['type'] == 'text') {
                        echo '
          <p>
            <label>' . $field['label'] . '</label><br /> 
            <input type="text" name="' . $id . '[' . $count . '][' . $field['name'] . ']" value="' . (isset($image[$field['name']]) ? stripslashes($image[$field['name']]) : '') . '" class="' . $field['class'] . '" />
          </p>';
                    } else if ($field['type'] == 'textarea') {
                        echo '
          <p>
            <label>' . $field['label'] . '</label><br /> 
            <textarea name="' . $id . '[' . $count . '][' . $field['name'] . ']" rows="6" class="' . $field['class'] . '">' . (isset($image[$field['name']]) ? stripslashes($image[$field['name']]) : '') . '</textarea>
          </p>';
                    } else if ($field['type'] == 'hidden') {
                        echo '<input type="hidden" name="' . $id . '[' . $count . '][' . $field['name'] . ']" value="' . (isset($image[$field['name']]) ? stripslashes($image[$field['name']]) : '') . '" class="' . $field['class'] . '" />';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
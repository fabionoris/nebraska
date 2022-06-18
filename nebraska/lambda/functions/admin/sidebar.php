<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');

/**
 * Image Sidebar Option
 *
 * @access public
 * @param array $value
 * @param array $settings
 * @param int $int
 *
 * @return string
 * @since Passion 1.0
 */
function option_tree_sidebar($value, $settings, $int)
{ ?>

    <div class="option option-option-tree-sidebar">
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
                <ul class="ui-sortable option-tree-sidebar-wrap" id="<?php echo $value->item_id; ?>_list">
                    <?php
                    if (!empty($settings[$value->item_id])) {
                        foreach ($settings[$value->item_id] as $image) { ?>
                            <li><?php option_tree_sidebar_view($value->item_id, $image, $int, $count); ?></li><?php
                            $count++;
                        }
                    }
                    ?>
                </ul>
                <a href="#" id="<?php echo $value->item_id; ?>" class="btn-mini btn-success add-sidebar right">Add
                    Sidebar</a>
            </div>

            <?php if ($value->item_desc) { ?>
                <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode($value->item_desc); ?></div>
                <div class="clear"></div>
            <?php } ?>

        </div>
    </div>
    <?php
}

/**
 * Sidebar HTML
 *
 * @access public
 * @param string $id
 * @param array $image
 * @param int $count
 *
 * @return string
 * @since Passion 1.0
 */
function option_tree_sidebar_view($id, $image, $int, $count)
{
    // Required fields
    $requred_fields = array(
        array(
            'name' => 'order',
            'type' => 'hidden',
            'label' => '',
            'class' => 'option-tree-sidebar-order'
        ),
        array(
            'name' => 'title',
            'type' => 'text',
            'label' => 'Title',
            'class' => 'option-tree-sidebar-title'
        )
    );

    // Optional fields
    $isidebar_fields = array(
        array(
            'name' => 'sidebardesc',
            'type' => 'textarea',
            'label' => 'Sidebar Description',
            'class' => ''
        )
    );

    // Filter the optional fields
    $isidebar_fields = apply_filters('image_sidebar_fields', $isidebar_fields, $id);

    // Merge required & optional arrays
    $isidebar_fields = array_merge($requred_fields, $isidebar_fields);
    ?>
    <div id="option-tree-sidebar-editor_<?php echo $count; ?>" class="option-tree-sidebar">
        <div class="open simple_ui_box">

	  	<span class="dynamictitle">
	  		<?php echo empty($image['title']) ? "Sidebar " . ($count + 1) : stripslashes($image['title']); ?>
	  	</span>

            <a href="#" class="edit btn-mini btn-success"><i class="icon-edit icon-white"></i></a>
            <a href="#" class="trash remove-sidebar btn-mini btn-danger"><i class="icon-remove icon-white"></i></a>

            <div class="option-tree-sidebar-body">
                <?php
                foreach ($isidebar_fields as $field) {
                    if ($field['type'] == 'text') {
                        echo '
          <p>
            <label>' . $field['label'] . '</label>
            <input type="text" name="' . $id . '[' . $count . '][' . $field['name'] . ']" value="' . (isset($image[$field['name']]) ? stripslashes($image[$field['name']]) : '') . '" class="' . $field['class'] . '" />
          </p>';
                    } else if ($field['type'] == 'textarea') {
                        echo '
          <p>
            <label>' . $field['label'] . '</label>
            <textarea name="' . $id . '[' . $count . '][' . $field['name'] . ']" rows="6" class="' . $field['class'] . '">' . (isset($image[$field['name']]) ? stripslashes($image[$field['name']]) : '') . '</textarea>
          </p>';
                    } else if ($field['type'] == 'checkbox') {
                        echo '
          <p>
            <label>' . $field['label'] . '</label>
            <input name="' . $id . '[' . $count . '][' . $field['name'] . ']" type="checkbox" class="' . $field['class'] . '" ' . (isset($image[$field['name']]) ? 'checked' : '') . '>
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
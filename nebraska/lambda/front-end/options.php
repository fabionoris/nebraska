<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');
global $theme_path;
?>

<div id="lambda-option-panel" class="bootstrap-wpadmin">

    <div id="content_wrap">

        <form method="post" id="the-theme-options" class="well form-horizontal">

            <div class="lambda-opttitle lambda-controls">
                <div class="lambda-opttitle-pad">
                    <button class="btn btn-mini btn-inverse right" data-toggle="modal"
                            href="#layoutsettings"><?php _e('Manage Preset', UT_THEME_NAME) ?></button>
                    <button type="submit" class="btn btn-mini btn-success save-options right" name="submit">
                        <?php _e('Save All Changes', UT_THEME_NAME) ?>
                    </button>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="clear"></div>

            <div class="modal hide" id="layoutsettings">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">X</button>
                    <h3><?php _e('Manage Layouts', UT_THEME_NAME) ?></h3>
                </div>
                <div class="modal-body">


                    <div class="save-layout-wrap">
                        <input type="text" name="options_name" value="" id="save_theme_layout"/>
                        <input type="submit" value="<?php _e('New Layout', UT_THEME_NAME) ?>"
                               class="button-framework user-save-layout" name="user-save-layout"/>
                    </div>

                    <hr/>

                    <?php
                    if (is_array($layouts) && !empty($layouts)) {
                        ?>
                        <?php
                        echo '<select name="active_theme_layout" id="active_theme_layout">';
                        echo '<option value="">-- Choose One --</option>';

                        $active_layout = $layouts['active_layout'];
                        foreach ($layouts as $key => $v) {
                            if ($key == 'active_layout')
                                continue;

                            $selected = '';
                            if ($active_layout == trim($key))
                                $selected = ' selected="selected"';

                            echo '<option' . $selected . '>' . trim($key) . '</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                    <input type="submit" value="<?php _e('Activate Layout', UT_THEME_NAME) ?>"
                           class="btn btn-success user-activate-layout" name="user-activate-layout"
                           style="margin-right:10px;"/>

                    <?php if ($this->has_xml) { ?>
                        <input type="submit" value="<?php _e('Reload XML', UT_THEME_NAME) ?>"
                               class="button-framework reload-options right" name="reload"
                               style="margin:5px 10px 0 20px;"/>
                    <?php } ?>


                    <div class="clear"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-dismiss="modal">close</button>
                </div>
            </div>

            <div id="lambda-options-panel-title">

                <h1><?php echo _e(' Theme Options', UT_THEME_NAME) ?></h1>
                <span class="lambda-version">Version 2.1 Fixed</span>
                <div class="clear"></div>

            </div>

            <div class="ajax-message<?php if (isset($message) || isset($_GET['updated']) || isset($_GET['layout']) || isset($_GET['layout_saved'])) {
                echo ' show';
            } ?>">
                <?php if (isset($_GET['updated'])) {
                    echo '<div class="message alert alert-success"><span>&nbsp;</span>Theme Options were updated.</div>';
                } ?>
                <?php if (isset($_GET['layout'])) {
                    echo '<div class="message"><span>&nbsp;</span>Your Layout has been activated.</div>';
                } ?>
                <?php if (isset($_GET['layout_saved'])) {
                    echo '<div class="message alert alert-success"><span>&nbsp;</span>Layout Saved Successfully.</div>';
                } ?>
                <?php if (isset($message)) {
                    echo $message;
                } ?>
            </div>
            <div id="content">

                <div id="options_tabs">

                    <div class="navbar">
                        <div class="navbar-inner">
                            <div class="container">


                                <?php
                                //Helper function
                                function object2Array($d)
                                {
                                    if (is_object($d)) {
                                        $d = get_object_vars($d);
                                    }

                                    if (is_array($d)) {
                                        return array_map(__FUNCTION__, $d);

                                    } else {
                                        return $d;
                                    }
                                }

                                //Create navigation

                                $parent = NULL;
                                $menuarray = object2Array($ot_array);

                                $ot_mainmenu = array();

                                foreach ($menuarray as $key => $value) {

                                    //Create first level
                                    if ($value['item_type'] == 'heading') {
                                        $parent = $value['id'];
                                        $ot_mainmenu[$parent] = $value;
                                    }

                                    //Create second level
                                    if ($value['item_type'] == 'subheading') {
                                        $subitem = $value;
                                        $ot_mainmenu[$parent]['childs'][$key] = $subitem;
                                        //array_push($ot_mainmenu, $subitem);
                                    }

                                } ?>

                                <ul class="options_tabs nav">
                                    <?php

                                    //Icon Sets
                                    $icons = array(
                                        "general_default" => "icon-home",
                                        "lambda_styling" => "icon-pencil",
                                        "sidebar_settings" => "icon-th-list",
                                        "image_options" => "icon-picture",
                                        "custom_scripts_css" => "icon-align-justify",
                                        "font_styling" => "icon-font",
                                        "settings" => "icon-cog"
                                    );

                                    foreach ($ot_mainmenu as $value) {

                                        //Create main menu
                                        if ($value['item_type'] == 'heading' && !isset($value['childs'])) {
                                            echo '<li><a href="#option_' . $value['item_id'] . '" data-toggle="tab"><i class="' . $icons[$value['item_id']] . ' icon-white"></i>' . htmlspecialchars_decode($value['item_title']) . '</a></li>';
                                        }

                                        //Create submenu
                                        if ($value['item_type'] == 'heading' && isset($value['childs'])) {
                                            $submenu = '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="' . $icons[$value['item_id']] . ' icon-white"></i>' . htmlspecialchars_decode($value['item_title']) . '<b class="caret"></b></a>';
                                            $submenu .= '<ul class="dropdown-menu">';

                                            foreach ($value['childs'] as $child) {
                                                $submenu .= ' <li><a href="#option_' . $child['item_id'] . '" data-toggle="tab">' . htmlspecialchars_decode($child['item_title']) . '</a></li>';
                                            }

                                            $submenu .= '</ul></li>';
                                            echo $submenu;
                                        }
                                    }

                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content">

                        <?php
                        // Set count
                        $count = 0;
                        $active = 0;

                        // Loop options & load corresponding function
                        foreach ($ot_array as $value) {
                            $count++;
                            if ($value->item_type == 'upload' || $value->item_type == 'background' || $value->item_type == 'slider') {
                                $int = $post_id;
                            } else if ($value->item_type == 'textarea' || $value->item_type == 'css') {
                                $int = (is_numeric(trim($value->item_options))) ? trim($value->item_options) : ($value->item_type == 'css' ? 24 : 8);
                            } else {
                                $int = $count;
                            }
                            call_user_func_array('option_tree_' . $value->item_type, array($value, $settings, $int, $active));
                            $active++;
                        }
                        // Close heading
                        echo '</div>';
                        ?>
                    </div>

                    <br class="clear"/>

                </div>
            </div>

            <div class="lambda-opttitle">
                <div class="lambda-opttitle-pad settingstitle">
                    <button type="submit" class="btn btn-success save-options right" name="submit">
                        <i class="icon-ok icon-white"></i>
                        <?php _e('Save All Changes', UT_THEME_NAME) ?>
                    </button>
                    <button type="submit" class="btn btn-danger save-options right" name="reset">
                        <i class="icon-remove icon-white"></i>
                        <?php _e('Reset Options', UT_THEME_NAME) ?>
                    </button>
                    <br class="clear"/>
                </div>
            </div>

            <?php wp_nonce_field('_theme_options', '_ajax_nonce', false); ?>

        </form>

    </div>

</div>
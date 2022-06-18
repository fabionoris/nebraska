<?php

$absolute_path = __FILE__;
$path_to_file = explode('wp-content', $absolute_path);
$path_to_wp = $path_to_file[0];

// Access to WordPress
require_once($path_to_wp . '/wp-load.php');
$themepath = get_template_directory_uri();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Insert Button</title>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
    <link rel="stylesheet" href="<?php echo $themepath; ?>/lambda/assets/css/lambda.ui.css"/>
    <link rel="stylesheet" href="<?php echo $themepath; ?>/lambda/tinymce/css/tinymce.css"/>

    <script type="text/javascript">

        var ButtonDialog = {

            local_ed: 'ed',

            init: function (ed, url) {
                ButtonDialog.local_ed = ed;
                tinyMCEPopup.resizeToInnerSize();
            },

            insert: function insertButton(ed) {

                // set up variables to contain our input values
                var url = jQuery('#button-dialog input#button-url').val();
                var text = jQuery('#button-dialog input#button-text').val();
                var color = jQuery('#button-dialog select#button-color').val();
                var size = jQuery('#button-dialog select#button-size').val();

                var output = '';

                // setup the output of our shortcode
                output = ' [button ';
                output += 'color=' + color + ' ';
                output += 'size=' + size;

                // only insert if the url field is not blank
                if (url)
                    output += ' link=' + url;

                // check to see if the TEXT field is blank
                if (text) {
                    output += ']' + text + '[/button] ';
                }
                // if it is blank, use the selected text, if present
                else {
                    output += ']' + ButtonDialog.local_ed.selection.getContent() + '[/button] ';
                }
                tinyMCEPopup.execCommand('mceReplaceContent', false, output);

                // Return
                tinyMCEPopup.close();
            }
        };

        tinyMCEPopup.onInit.add(ButtonDialog.init, ButtonDialog);

    </script>

</head>

<body>
    <div class="bootstrap-wpadmin">

        <div class="lambda-opttitle">
            <div class="lambda-opttitle-pad"><?php _e('Lambda Button Generator', UT_THEME_NAME); ?></div>
        </div>

        <div class="shortcode-content lambda-settings-pad">

            <div id="button-dialog">
                <form action="/" method="get" accept-charset="utf-8">

                    <p>
                        <label for="button-url">Button URL</label><br/>
                        <input type="text" name="button-url" value="" id="button-url"/>
                    </p>

                    <p>
                        <label for="button-text">Button Text</label><br/>
                        <input type="text" name="button-text" value="" id="button-text"/>
                    </p>

                    <p>
                        <label for="button-color">Color</label><br/>
                        <select name="button-color" id="button-color" size="1">
                            <option value="gray" selected="selected">Gray</option>
                            <option value="blue">Blue</option>
                            <option value="green">Green</option>
                            <option value="orange">Orange</option>
                            <option value="coffee">Coffee</option>
                            <option value="pink">Pink</option>
                            <option value="purple">Purple</option>
                            <option value="red">Red</option>
                            <option value="themebutton">Themebutton</option>
                        </select>
                    </p>

                    <p>
                        <label for="button-size">Size</label><br/>
                        <select name="button-size" id="button-size" size="1">
                            <option value="small" selected="selected">small</option>
                            <option value="medium"
                            =>medium</option>
                            <option value="large">large</option>
                        </select>
                    </p>

                </form>
            </div>
        </div>

        <p>
            <a class="btn btn-success" href="javascript:ButtonDialog.insert(ButtonDialog.local_ed)">Insert</a>
        </p>

        <div class="clear"></div>

    </div>
</body>
</html>
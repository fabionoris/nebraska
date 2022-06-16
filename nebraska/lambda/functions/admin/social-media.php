<?php if (!defined('OT_VERSION')) exit('No direct script access allowed');

/**
 * Image Social Option
 */
function option_tree_social($value, $settings, $int)
{
    ?>
    <div class="option option-option-tree-social">

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
                <?php
                $social = array(
                    'aim' => 'AIM',
                    'behance' => 'Behance',
                    'delicious' => 'Delicious',
                    'deviantart' => 'Deviantart',
                    'digg' => 'Digg',
                    'dribbble' => 'Dribbble',
                    'dropbox' => 'Dropbox',
                    'facebook' => 'Facebook',
                    'fivehundredpx' => '500px',
                    'flickr' => 'Flickr',
                    'forrst' => 'Forrst',
                    'foursquare' => 'Foursquare',
                    'github' => 'Github',
                    'googleplus' => 'GooglePlus',
                    'grooveshark' => 'Grooveshark',
                    'instagram' => 'Instagram',
                    'lastfm' => 'LastFM',
                    'linkedin' => 'Linkedin',
                    'maps' => 'Maps',
                    'picasa' => 'Picasa',
                    'pinterest' => 'Pinterest',
                    'rss' => 'RSS',
                    'soundcloud' => 'Soundcloud',
                    'steam' => 'Steam',
                    'tumblr' => 'Tumblr',
                    'twitter' => 'Twitter',
                    'vimeo' => 'Vimeo',
                    'whatsapp' => 'WhatsApp',
                    'wordpress' => 'Wordpress',
                    'xing' => 'Xing',
                    'yahoo' => 'Yahoo',
                    'youtube' => 'Youtube'
                );
                ?>

                <?php foreach ($social as $key => $socialname) { ?>
                    <div class="select_wrapper">
                        <label><?php echo $socialname; ?></label>
                        <input style="width:175px;" type="text"
                               name="<?php echo $value->item_id; ?>[<?php echo $key; ?>]"
                               id="<?php echo $value->item_id; ?>-<?php echo $key; ?>"
                               value="<?php echo (isset($settings[$value->item_id][$key])) ? stripslashes($settings[$value->item_id][$key]) : ''; ?>"/>
                    </div>
                    <div class="clear"></div>
                <?php } ?>

            </div>

            <?php if ($value->item_desc) { ?>
                <div class="desc alert alert-neutral"><?php echo htmlspecialchars_decode($value->item_desc); ?></div>
                <div class="clear"></div>
            <?php } ?>

        </div>
    </div>
    <?php
}
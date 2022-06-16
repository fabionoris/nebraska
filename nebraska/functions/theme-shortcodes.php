<?php

global $theme_options;

//Paragraph
function shortcode_paragraph($atts, $content = null)
{
    extract(shortcode_atts(array(
        'align' => ''
    ), $atts));

    $align = ($align) ? ' style="text-align: ' . $align . ' !important;"' : '';
    return '<p' . $align . '>' . do_shortcode($content) . '</p>';
}

add_shortcode('p', 'shortcode_paragraph');

// Call to Action
function shortcode_calltoaction($atts, $content = null)
{
    extract(shortcode_atts(array(
        'headline' => '',
        'buttonlink' => '',
        'buttontext' => '',
        'target' => '_blank',
        'ctaclass' => 'margin-20',
    ), $atts));

    $cta = '<section class="cta clearfix ' . $ctaclass . '"><div class="cta-inner drop-shadow lifted"><article class="cta-content clearfix">';

    if (!empty($buttontext))
        $cta .= '<div class="three_fourths remove-bottom">';

    $cta .= '<h3>' . $headline . '</h3>';
    $cta .= '<p>' . do_shortcode($content) . '</p>';

    if (!empty($buttontext))
        $cta .= '</div>';

    if (!empty($buttontext))
        $cta .= '<div class="cta-button-wrap remove-bottom one_fourth last"><a href="' . $buttonlink . '" class="button themebutton medium" target="' . $target . '">' . $buttontext . '</a></div>';

    $cta .= '</article></div></section>';
    return $cta;
}

add_shortcode('cta', 'shortcode_calltoaction');

//Break
function shortcode_break()
{
    return '<br />';
}

add_shortcode('br', 'shortcode_break');

//H1
function shortcode_headline_h1($atts, $content = null)
{
    return '<h1>' . do_shortcode($content) . '</h1>';
}

add_shortcode('h1', 'shortcode_headline_h1');

//H2
function shortcode_headline_h2($atts, $content = null)
{
    return '<h2>' . do_shortcode($content) . '</h2>';
}

add_shortcode('h2', 'shortcode_headline_h2');

//H3
function shortcode_headline_h3($atts, $content = null)
{
    return '<h3>' . do_shortcode($content) . '</h3>';
}

add_shortcode('h3', 'shortcode_headline_h3');

//H3 Special
function shortcode_headline_h3_special($atts, $content = null)
{
    return '<h3 class="home-title"><span>' . do_shortcode($content) . '</span></h3>';
}

add_shortcode('headline', 'shortcode_headline_h3_special');

//H4
function shortcode_headline_h4($atts, $content = null)
{
    return '<h4>' . do_shortcode($content) . '</h4>';
}

add_shortcode('h4', 'shortcode_headline_h4');

//H5
function shortcode_headline_h5($atts, $content = null)
{
    return '<h5>' . do_shortcode($content) . '</h5>';
}

add_shortcode('h5', 'shortcode_headline_h5');

//H6
function shortcode_headline_h6($atts, $content = null)
{
    return '<h6>' . do_shortcode($content) . '</h6>';
}

add_shortcode('h6', 'shortcode_headline_h6');

//Code
function shortcode_code($atts, $content = null)
{
    return '<pre>' . $content . '</pre>';
}

add_shortcode('code', 'shortcode_code');

//BlockQuotes
function shortcode_blockquote_left($atts, $content = null)
{
    return '<div class="blockquote-left"><blockquote><p>' . do_shortcode($content) . '</p></blockquote></div>';
}

add_shortcode('blockquote_left', 'shortcode_blockquote_left');

function shortcode_blockquote_right($atts, $content = null)
{
    return '<div class="blockquote-right"><blockquote><p>' . do_shortcode($content) . '</p></blockquote></div>';
}

add_shortcode('blockquote_right', 'shortcode_blockquote_right');

//Highlights
function shortcode_highlight_one($atts, $content = null)
{
    return '<span class="lambda-highlight1">' . do_shortcode($content) . '</span>';
}

add_shortcode('highlight_one', 'shortcode_highlight_one');

function shortcode_highlight_two($atts, $content = null)
{
    return '<span class="lambda-highlight2">' . do_shortcode($content) . '</span>';
}

add_shortcode('highlight_two', 'shortcode_highlight_two');

function shortcode_highlight_three($atts, $content = null)
{
    return '<span class="lambda-highlight3">' . do_shortcode($content) . '</span>';
}

add_shortcode('highlight_three', 'shortcode_highlight_three');

function shortcode_highlight_four($atts, $content = null)
{
    return '<span class="lambda-highlight4">' . do_shortcode($content) . '</span>';
}

add_shortcode('highlight_four', 'shortcode_highlight_four');

//Dropcaps
function shortcode_dropcap_one($atts, $content = null)
{
    return '<span class="lambda-dropcap1">' . do_shortcode($content) . '</span>';
}

add_shortcode('dropcap_one', 'shortcode_dropcap_one');

function shortcode_dropcap_two($atts, $content = null)
{
    return '<span class="lambda-dropcap2">' . do_shortcode($content) . '</span>';
}

add_shortcode('dropcap_two', 'shortcode_dropcap_two');

//Code
function shortcode_pre($atts, $content = null)
{
    return '<pre>' . $content . '</pre>';
}

add_shortcode('pre', 'shortcode_pre');

//List
function shortcode_listtype($atts, $content = null)
{

    extract(shortcode_atts(array(
        'type' => ''
    ), $atts));

    return '<div class="lambda-' . $type . '">' . do_shortcode($content) . '</div>';
}

add_shortcode('list', 'shortcode_listtype');

// Columns

// 1-3 col

function lambda_one_third($atts, $content = null)
{
    return '<div class="one_third">' . do_shortcode($content) . '</div>';
}

add_shortcode('one_third', 'lambda_one_third');

function lambda_one_third_last($atts, $content = null)
{
    return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

add_shortcode('one_third_last', 'lambda_one_third_last');

function lambda_two_thirds($atts, $content = null)
{
    return '<div class="two_thirds">' . do_shortcode($content) . '</div>';
}

add_shortcode('two_thirds', 'lambda_two_thirds');

function lambda_two_thirds_last($atts, $content = null)
{
    return '<div class="two_thirds last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

add_shortcode('two_thirds_last', 'lambda_two_thirds_last');

// 1-4 col

function lambda_one_half($atts, $content = null)
{
    return '<div class="one_half">' . do_shortcode($content) . '</div>';
}

add_shortcode('one_half', 'lambda_one_half');

function lambda_one_half_last($atts, $content = null)
{
    return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

add_shortcode('one_half_last', 'lambda_one_half_last');

function lambda_one_fourth($atts, $content = null)
{
    return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}

add_shortcode('one_fourth', 'lambda_one_fourth');

function lambda_one_fourth_last($atts, $content = null)
{
    return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

add_shortcode('one_fourth_last', 'lambda_one_fourth_last');

function lambda_three_fourths($atts, $content = null)
{
    return '<div class="three_fourths">' . do_shortcode($content) . '</div>';
}

add_shortcode('three_fourths', 'lambda_three_fourths');

function lambda_three_fourths_last($atts, $content = null)
{
    return '<div class="three_fourths last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

add_shortcode('three_fourths_last', 'lambda_three_fourths_last');

function lambda_one_fifth($atts, $content = null)
{
    return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}

add_shortcode('one_fifth', 'lambda_one_fifth');

function lambda_two_fifth($atts, $content = null)
{
    return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}

add_shortcode('two_fifth', 'lambda_two_fifth');

function lambda_three_fifth($atts, $content = null)
{
    return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}

add_shortcode('three_fifth', 'lambda_three_fifth');

function lambda_four_fifth($atts, $content = null)
{
    return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}

add_shortcode('four_fifth', 'lambda_four_fifth');

// one_fifth
function lambda_one_fifth_last($atts, $content = null)
{
    return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

add_shortcode('one_fifth_last', 'lambda_one_fifth_last');

function lambda_two_fifth_last($atts, $content = null)
{
    return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

add_shortcode('two_fifth_last', 'lambda_two_fifth_last');

function lambda_three_fifth_last($atts, $content = null)
{
    return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

add_shortcode('three_fifth_last', 'lambda_three_fifth_last');

function lambda_four_fifth_last($atts, $content = null)
{
    return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

add_shortcode('four_fifth_last', 'lambda_four_fifth_last');

// 1-6 col

// one_sixth
function lambda_one_sixth($atts, $content = null)
{
    return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}

add_shortcode('one_sixth', 'lambda_one_sixth');

function lambda_one_sixth_last($atts, $content = null)
{
    return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

add_shortcode('one_sixth_last', 'lambda_one_sixth_last');

// five_sixth
function lambda_five_sixth($atts, $content = null)
{
    return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}

add_shortcode('five_sixth', 'lambda_five_sixth');

function lambda_five_sixth_last($atts, $content = null)
{
    return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

add_shortcode('five_sixth_last', 'lambda_five_sixth_last');

// Buttons
function lambda_button($atts, $content = null)
{
    extract(shortcode_atts(array(
        'link' => '',
        'color' => '',
        'size' => 'small',
        'target' => '_self'
    ), $atts));

    $button = '';

    $btn = ($color != 'theme-button') ? 'button' : '';

    $button .= '<a target="' . $target . '" class="' . $btn . ' ' . $color . ' ' . $size . '" href="' . $link . '">';
    $button .= $content;
    $button .= '</a>';
    return $button;
}

add_shortcode('button', 'lambda_button');

// Theme color
function shortcode_themecolor($atts, $content = null)
{
    return '<span class="themecolor">' . do_shortcode($content) . '</span>';
}

add_shortcode('themecolor', 'shortcode_themecolor');


// Tabs
add_shortcode('tabgroup', 'lambda_tabgroup');

function lambda_tabgroup($atts, $content)
{

    $GLOBALS['tab_count'] = 0;
    $GLOBALS['tabs'] = array();

    do_shortcode($content);


    if (is_array($GLOBALS['tabs'])) {

        foreach ($GLOBALS['tabs'] as $tab) {
            $tabs[] = '<li><a href="#' . $tab['id'] . '">' . $tab['title'] . '</a></li>';
            $panes[] = '<li id="' . $tab['id'] . 'Tab">' . do_shortcode($tab['content']) . '</li>';

        }

        $return = "\n" . '<!-- the tabs --><ul class="tabs">' . implode("\n", $tabs) . '</ul>' . "\n" . '<!-- tab "panes" --><ul class="tabs-content entry-content">' . implode("\n", $panes) . '</ul>' . "\n";
    }

    return $return;

}

add_shortcode('tab', 'lambda_tab');

function lambda_tab($atts, $content)
{
    extract(shortcode_atts(array(
        'title' => '%d',
        'id' => '%d'
    ), $atts));

    $x = $GLOBALS['tab_count'];
    $GLOBALS['tabs'][$x] = array(
        'title' => sprintf($title, $GLOBALS['tab_count']),
        'content' => $content,
        'id' => $id);

    $GLOBALS['tab_count']++;
}

// Toggle
function lambda_toggle($atts, $content = null)
{
    extract(shortcode_atts(array(
        'title' => '',
        'style' => 'list',
        'state' => 'closed'
    ), $atts));
    $output = '';
    $output .= '<div class="' . $style . '"><p class="trigger"><span class="faq-marker"></span><a href="#">' . $title . '</a></p>';
    $output .= '<div class="toggle_container" data-state="' . $state . '"><div class="block clearfix">';
    $output .= do_shortcode($content);
    $output .= '</div></div></div>';

    return $output;
}

add_shortcode('toggle', 'lambda_toggle');

//Google Map
class Google_Map
{
    static $add_script;

    static function init()
    {
        add_shortcode('googlemap', array(__CLASS__, 'handle_shortcode'));
        add_action('init', array(__CLASS__, 'register_script'));
        add_action('wp_footer', array(__CLASS__, 'print_script'));
    }

    static function handle_shortcode($atts, $content = null)
    {
        self::$add_script = true;

        extract(shortcode_atts(array(
            'height' => '300',
            'address' => '100 Biscayne Blvd. (North) 21st Floor New World Tower Miami, Florida 33148',
            'zoom' => '14'
        ), $atts));

        $return = '<div class="googlemap row" style="width:100%; height:' . $height . 'px" data-zoom="' . $zoom . '" data-maptype="ROADMAP" data-address="' . $address . '"></div>';

        return $return;
    }

    static function register_script()
    {
        wp_register_script('googlemapsapi', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'), '1.0', true);
        wp_register_script('googlemap', get_template_directory_uri() . "/javascripts/google.init.js", array('jquery'), '1.0', true);
    }

    static function print_script()
    {
        if (!self::$add_script)
            return;

        wp_print_scripts('googlemapsapi');
        wp_print_scripts('googlemap');
    }
}

Google_Map::init();

// Break
function lambda_break($atts, $content = null)
{
    return '<div class="clear"></div>';
}

add_shortcode('clear', 'lambda_break');

// Line Break
function lambda_linebreak($atts, $content = null)
{
    return '<hr /><div class="clear"></div>';
}

add_shortcode('clearline', 'lambda_linebreak');

//Highlightbox
function lambda_highlight($atts, $content = null)
{
    return '<div class="homepage-highlight">' . do_shortcode($content) . '</div>';
}

add_shortcode('highlight', 'lambda_highlight');

//Notificationbox
function lambda_notification($atts, $content = null)
{
    extract(shortcode_atts(array(
        'color' => '5',
    ), $atts));

    return '<div class="alert ' . $color . '">' . do_shortcode($content) . '</div>';
}

add_shortcode('alert', 'lambda_notification');

//Vimeo
function lambda_video_vimeo($atts, $content = null)
{
    $content = str_replace(' ', '', $content);
    return str_replace('&', '&amp;', '<div class="lambda-video"><iframe src="http://player.vimeo.com/video/' . trim($content) . '" style="border:none" frameborder="0"></iframe></div>');
}

add_shortcode('vimeo_video', 'lambda_video_vimeo');

//Youtube
function lambda_video_youtube($atts, $content = null)
{
    $content = str_replace(' ', '', $content);
    return str_replace('&', '&amp;', '<div class="lambda-video"><iframe src="http://www.youtube.com/embed/' . trim($content) . '" style="border:none" frameborder="0"></iframe></div>');
}

add_shortcode('youtube_video', 'lambda_video_youtube');

#-----------------------------------------------------------------
# Pricing Table
#-----------------------------------------------------------------
class lambda_table_shortcode
{
    static $add_script;

    function init()
    {
        add_shortcode('lambdatable', array(__CLASS__, 'handle_table_shortcode'));
    }

    function handle_table_shortcode($atts)
    {
        extract(shortcode_atts(array("id" => ''), $atts));

        global $wpdb, $theme_path, $lambda_meta_data;

        $table_name = $wpdb->base_prefix . "lambda_tables";
        $table_result = $wpdb->get_row('SELECT * FROM ' . $table_name . ' WHERE id =' . $id);

        //no result? = escape
        if (!$table_result) return; ?>

        <?php $tabledata = get_option($table_result->table_name); ?>

        <?php $table = '<div class="lambda-pricingtable-wrap clearfix">';

        if (is_array($tabledata['columns'])) foreach ($tabledata['columns'] as $column) {

            if ($column['column_active'] == 'on') {

                $table .= '<div class="lambda-pricingtable-holder">';

                $featuredcol = ($column['featured'] == 'yes') ? 'featured' : '';

                $table .= '<div class="lambda-pricingtable ' . $featuredcol . '">
								<div class="lambda-pricingtable-top">
									<h2>' . $column['column_head'] . '</h2>
								</div>
								<ul>';

                foreach ($column['column_content'] as $feature) {
                    $table .= '<li>' . do_shortcode($feature) . '</li>';
                }

                $table .= '</ul>
								
								<h3><sup>' . $column['column_curr'] . '</sup>' . $column['column_price'] . '</h3>
								<p>' . $column['column_time'] . '</p>';

                if ($column['column_buttontext']) {

                    $table .= '<div class="lambda-pricingtable-button">
							<a href="' . $column['column_url'] . '" class="lambda-table-button" target="_self">' . $column['column_buttontext'] . '</a>
						</div>';

                }

                $table .= '</div>';
                $table .= '</div>';

            } ?>

        <?php }

        $table .= '</div>';
        return $table;
    }
}

lambda_table_shortcode::init();

//Fontface
function shortcode_fontface($atts, $content = null)
{

    extract(shortcode_atts(array(
        'face' => '',
        'size' => '',
        'color' => '',
        'weight' => 'normal',
        'style' => ''
    ), $atts));

    $fontstyle = '';
    $fontstyle .= 'style="';
    $fontstyle .= ($face) ? "font-family:'" . $face . "';" : '';
    $fontstyle .= ($size) ? 'font-size: ' . $size . 'px;' : '';
    $fontstyle .= ($color) ? 'font-color: ' . $color . ';' : '';
    $fontstyle .= ($weight) ? 'font-weight: ' . $weight . ';' : '';
    $fontstyle .= ($style) ? 'font-style: ' . $style . ';' : '';
    $fontstyle .= '"';

    return '<span ' . $fontstyle . '>' . do_shortcode($content) . '</span>';
}

add_shortcode('font', 'shortcode_fontface');

//Remove WP Gallery
function remove_shortcode_from_posts($content)
{

    if (!is_page())
        $content = preg_replace('/(.?)\[(gallery)\b(.*?)(?:(\/))?\](?:(.+?)\[\/\2\])?(.?)/s', '$1$6', $content);

    return $content;

}

add_filter('the_content', 'remove_shortcode_from_posts');

//Optional theme specified gallery shortcode
if (isset($theme_options['activate_lambdagallery']) && $theme_options['activate_lambdagallery'] == 'on')    :

    remove_shortcode('gallery', 'gallery_shortcode');

    function lambda_gallery_shortcode($attr)
    {
        #-----------------------------------------------------------------
        # Start modification
        #-----------------------------------------------------------------
        global $lambda_meta_data;

        $post = get_post();

        $metadata = get_post_meta($post->ID, $lambda_meta_data->get_the_id(), TRUE);
        $gallerytype = (isset($metadata['gallery_type']) && !empty($metadata['gallery_type'])) ? $metadata['gallery_type'] : '';

        if (isset($metadata['portfolio_gallery_type']) && $metadata['portfolio_gallery_type'] == 'slider_gallery') {
            $gallerytype = 'slider_gallery';
        }

        $additionalClass = ($gallerytype == 'slider_gallery') ? 'flexslider' : '';

        $gridsystem = array(
            '1' => 'full-width',
            '2' => 'one_half',
            '3' => 'one_third',
            '4' => 'one_fourth',
            '5' => 'one_fifth',
            '6' => 'one_sixth',
            '7' => 'one_seventh',
            '8' => 'one_eighth',
            '9' => 'one_ninth'
        );
        #-----------------------------------------------------------------
        # End modification
        #-----------------------------------------------------------------

        static $instance = 0;
        $instance++;

        if (!empty($attr['ids'])) {
            // 'ids' is explicitly ordered, unless you specify otherwise.
            if (empty($attr['orderby']))
                $attr['orderby'] = 'post__in';
            $attr['include'] = $attr['ids'];
        }

        // Allow plugins/themes to override the default gallery template.
        $output = apply_filters('post_gallery', '', $attr);
        if ($output != '')
            return $output;

        // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
        if (isset($attr['orderby'])) {
            $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
            if (!$attr['orderby'])
                unset($attr['orderby']);
        }

        extract(shortcode_atts(array(
            'order' => 'ASC',
            'orderby' => 'menu_order ID',
            'id' => $post->ID,
            'itemtag' => 'dl',
            'icontag' => 'dt',
            'captiontag' => 'dd',
            'columns' => 3,
            'size' => 'thumbnail',
            'include' => '',
            'exclude' => ''
        ), $attr));

        $id = intval($id);
        if ('RAND' == $order)
            $orderby = 'none';

        if (!empty($include)) {
            $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

            $attachments = array();
            foreach ($_attachments as $key => $val) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif (!empty($exclude)) {
            $attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
        } else {
            $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
        }

        if (empty($attachments))
            return '';

        if (is_feed()) {
            $output = "\n";
            foreach ($attachments as $att_id => $attachment)
                $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
            return $output;
        }

        $itemtag = tag_escape($itemtag);
        $captiontag = tag_escape($captiontag);
        $icontag = tag_escape($icontag);
        $valid_tags = wp_kses_allowed_html('post');

        $columns = intval($columns);
        $itemwidth = $columns > 0 ? floor(100 / $columns) : 100;
        $float = is_rtl() ? 'right' : 'left';

        $selector = "gallery-{$instance}";
        $gallery_style = $gallery_div = '';

        $size_class = sanitize_html_class($size);

        $gallery_class = (is_single() || is_page() || is_singular(UT_PORTFOLIO_SLUG)) ? 'gallery' : 'single-gallery';
        $gallery_div = "<div id='$selector' class='$gallery_class $additionalClass galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

        #-----------------------------------------------------------------
        # Start modification
        #-----------------------------------------------------------------
        if ($gallerytype == 'slider_gallery') {

            $gallery_div = $gallery_div . '<ul class="slides">';
            $itemtag = 'li';
            $icontag = 'div';
            $captiontag = 'span';
        }
        #-----------------------------------------------------------------
        # End modification
        #-----------------------------------------------------------------

        $output = apply_filters('gallery_style', $gallery_style . "\n\t\t" . $gallery_div);

        $i = 0;
        foreach ($attachments as $id => $attachment) {

            if (is_single() || is_page() || is_singular(UT_PORTFOLIO_SLUG)) {
                $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
                $hover = '<div class="hover-overlay"><span class="circle-hover"><img src="' . get_template_directory_uri() . '/images/lens-icon.png" alt="' . __('zoom icon', UT_THEME_INITIAL) . '"/></span></div>';
            } else {
                $alt_text = get_post_meta($id, '_wp_attachment_image_alt', true);
                $image_url = wp_get_attachment_image_src($id, $size);
                $link = '<img src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
                $hover = '<a href="' . get_permalink() . '">
							<div class="hover-overlay">' .
                    "<span class='circle-hover'>
									<img src='" . get_template_directory_uri() . "/images/circle-hover.png' alt='" . __('zoom icon', UT_THEME_INITIAL) . "'/>
								</span>
							</div>
						 </a>";
            }

            $output .= "<{$itemtag} class='gallery-item " . $gridsystem[$columns] . "'>";
            $output .= "<{$icontag} class='gallery-icon'>
							$link $hover
						</{$icontag}>";

            if ($captiontag && trim($attachment->post_excerpt)) {
                $output .= "
					<{$captiontag} class='wp-caption-text gallery-caption'>
					" . wptexturize($attachment->post_excerpt) . "
					</{$captiontag}>";
            }
            $output .= "</{$itemtag}>";
            if ($columns > 0 && ++$i % $columns == 0 && $gallerytype != "slider_gallery")
                $output .= '<div style="clear: both"></div>';
        }
        if ($gallerytype != "slider_gallery")
            $output .= "<div style='clear: both;'></div>";

        #-----------------------------------------------------------------
        # Start modification
        #-----------------------------------------------------------------
        if ($gallerytype == 'slider_gallery') {
            $output .= "</ul>\n";
        }
        #-----------------------------------------------------------------
        # End modification
        #-----------------------------------------------------------------

        $output .= "</div>\n";

        return $output;
    }

    add_shortcode('gallery', 'lambda_gallery_shortcode');

endif;
?>
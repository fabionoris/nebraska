<?php

#-----------------------------------------------------------------
# Register Menu & Navigation
#-----------------------------------------------------------------
if (!function_exists('register_menu')) {

    function register_menu()
    {
        register_nav_menu('primary-menu', __('Primary Navigation', UT_THEME_NAME));
        register_nav_menus(array('mobile-menu' => 'Mobile Menu'));
    }

    add_action('init', 'register_menu');

}

function apply_mobile_menu($menu_id)
{
    $menu_id = 'mobile-menu';
    return $menu_id;
}

add_filter('lambda_responsive_menu_location', 'apply_mobile_menu');

#-----------------------------------------------------------------
# Menu fallback
#-----------------------------------------------------------------
function default_menu()
{
    require_once(TEMPLATEPATH . '/functions/default-menu.php');
}


#-----------------------------------------------------------------
# WordPress Admin Login
#-----------------------------------------------------------------
add_action("login_head", "my_login_head");
function my_login_head()
{
    if (get_option_tree('login_logo')) {
        echo "<style>
		body.login #login h1 a {
			background: url('" . get_option_tree('login_logo') . "') no-repeat scroll center top transparent;
		}
		.login #nav a, .login #backtoblog a {
			color: " . get_option_tree('color_scheme') . " !important;
		}
		</style>";
    }
}

if (!function_exists('change_login_url')) {
    function change_login_url()
    {
        return (esc_url(home_url('/')));
    }

    add_filter('login_headerurl', 'change_login_url');
}

#-----------------------------------------------------------------
# Polish google font name
#-----------------------------------------------------------------
if (!function_exists('polish_font_name')) {
    function polish_font_name($fontname)
    {
        $fontname = str_replace('+', ' ', $fontname);
        if (preg_match("/:/", $fontname)) {
            $fontname = explode(':', $fontname);
            $fontname = $fontname[0];
        }
        return $fontname;
    }
}

#-----------------------------------------------------------------
# Get portfolio image URL
#-----------------------------------------------------------------
if (!function_exists('portfolio_image_url')) {
    function portfolio_image_url($pid)
    {
        $image_id = get_post_thumbnail_id($pid);
        $image_url = wp_get_attachment_image_src($image_id, '1col-image');
        return $image_url[0];
    }
}

#-----------------------------------------------------------------
# Continue reading link for excerpts
#-----------------------------------------------------------------
if (!function_exists('lambda_continue_reading_link')) {
    function lambda_continue_reading_link()
    {
        return '<a class="excerpt" href="' . get_permalink() . '">' . __('Read More', UT_THEME_NAME) . '</a>';
    }
}

#-----------------------------------------------------------------
# Custom functions for portfolio filter
#-----------------------------------------------------------------
if (!function_exists('cmp')) {
    function cmp($a, $b)
    {
        if ($a->parent == $b->parent) {
            return 0;
        }
        return ($a->parent < $b->parent) ? -1 : 1;
    }
}
if (!function_exists('sort_by_parent')) {
    function sort_by_parent($a, $b)
    {
        if ($a->parent == $b->parent) {
            return 0;
        }
        return ($a->parent < $b->parent) ? -1 : 1;
    }
}
if (!function_exists('sort_portfolio_filte')) {
    function sort_portfolio_filter($taxonomys)
    {
        usort($taxonomys, 'cmp');
        usort($taxonomys, 'sort_by_parent');

        return $taxonomys;
    }
}

#-----------------------------------------------------------------
# Excerpt length & more link
#-----------------------------------------------------------------
if (!function_exists('lambda_excerpt_length')) {
    function lambda_excerpt_length($length)
    {
        return get_option_tree('excerpt_blog_length');
    }

    add_filter('excerpt_length', 'lambda_excerpt_length');
}

function new_excerpt_more($more)
{
    global $post;

    $more = __('Read more <span class="meta-nav"></span>', UT_THEME_NAME);

    return '<a href="' . get_permalink($post->ID) . '" class="more-link">' . $more . '</a>';
}

add_filter('excerpt_more', 'new_excerpt_more');

#-----------------------------------------------------------------
# Portfolio pagination
#-----------------------------------------------------------------
if (!function_exists('paginate')) {
    function paginate($next = 'Next Works &#8658;', $prev = '&#8656; Previous Works')
    {
        global $wp_query, $wp_rewrite;
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
        $pagination = array(
            'base' => esc_url(@add_query_arg('page', '%#%')),
            'format' => '',
            'total' => $wp_query->max_num_pages,
            'current' => $current,
            'show_all' => true,
            'prev_text' => $prev,
            'next_text' => $next,
            'type' => 'list'
        );
        if ($wp_rewrite->using_permalinks()) $pagination['base'] = user_trailingslashit(trailingslashit(esc_url(remove_query_arg('s', get_pagenum_link(1)))) . 'page/%#%/', 'paged');
        if (!empty($wp_query->query_vars['s'])) $pagination['add_args'] = array('s' => get_query_var('s'));

        if ($pagination['total'] > 1)
            echo '<div class="pagination">' . paginate_links($pagination) . '</div>';
    }
}

#-----------------------------------------------------------------
# Slider Loop
#-----------------------------------------------------------------
if (!function_exists('callFlexslider')) {

    /*
    * Creates a standard flexslider
    * @param - $pagetype - single = home / portfolio / page
    */

    function callFlexslider($pagetype = 'home')
    {
        global $lambda_meta_data;
        $metadata = $lambda_meta_data->the_meta();

        //Sliderdata for Portfolio Single Pages
        if ($pagetype == 'portfolio') {
            $slides = $metadata[UT_THEME_INITIAL . 'portfolio_images'];
            $additional_class = 'class="portfolio_slider"';
        }
        //Sliderdata for Single Page
        if ($pagetype == 'page') {
            $slides = $metadata[UT_THEME_INITIAL . 'slider_images'];
            $additional_class = 'class="sixteen columns clearfix"';
        }

        if (is_array($slides)) {

            if ($pagetype == 'portfolio') {
                echo '<div class="thumb">';
            }

            echo "<div id=\"slider-wrap\" " . $additional_class . "><div class=\"flexslider\"><div class=\"frame\"><ul class=\"slides\">";
            foreach ($slides as $slide) {

                //home or blog slider (Option Tree)
                if ($pagetype == 'home') {
                    $imgurl = (isset($slide['image'])) ? $slide['image'] : '';
                    $link = (isset($slide['link'])) ? $slide['link'] : '#';
                    $caption = (isset($slide['description'])) ? $slide['description'] : '';
                    $title = (isset($slide['title'])) ? $slide['title'] : '';
                }

                //reasign array for portfolio images or page slider images
                if ($pagetype == 'portfolio' || $pagetype == 'page') {
                    $imgurl = (isset($slide['imgurl'])) ? $slide['imgurl'] : '';
                    $link = (isset($slide['slider_link'])) ? $slide['slider_link'] : '';
                    $caption = (isset($slide['caption'])) ? $slide['caption'] : '';
                    $title = (isset($slide['title'])) ? $slide['title'] : '';
                }

                echo '<li>
					<a href="' . $imgurl . '" data-rel="prettyPhoto[postgallery]"><img src="' . $imgurl . '" alt="' . $title . '" /></a>';

                if (!empty($caption)) {
                    echo '<p class="flex-caption">' . $caption . '</p>';
                }

                echo '</li>';
            }
            echo "</ul></div></div></div>";

            if ($pagetype == 'portfolio') {
                echo '</div>';
            }
        }
    }
}

#-----------------------------------------------------------------
# Main Slider
#-----------------------------------------------------------------
if (!function_exists('lambda_main_slider')) {

    function lambda_main_slider($slides)
    {
        $sliderinfo = explode('_', $slides['main_slider']);

        if ($sliderinfo[0] == 'revslider') {
            echo '<div id="lambda-featured-header-wrap" class="clearfix">' . do_shortcode('[rev_slider ' . $sliderinfo[1] . ']') . '</div>';
        } elseif ($sliderinfo[0] == 'lambda') {
            echo do_shortcode('[lambdaslider id="' . $sliderinfo[1] . '"]');
        }
    }
}

#-----------------------------------------------------------------
# Get an excerpt of a chosen page by ID
#-----------------------------------------------------------------

/*
* Gets the excerpt of a specific post ID or object
* @param - $post - object/int - the ID or object of the post to get the excerpt of
* @param - $length - int - the length of the excerpt in words
* @param - $tags - string - the allowed HTML tags. These will not be stripped out
* @param - $extra - string - text to append to the end of the excerpt
*/
if (!function_exists('excerpt_by_id')) {
    function excerpt_by_id($post, $length = 10, $tags = '<a><em><strong>', $extra = ' ...', $home = false)
    {
        if ($post) {
            // get the post object of the passed ID
            $post = get_post($post);
        } elseif (!is_object($post)) {
            return false;
        }

        if (has_excerpt($post->ID)) {
            $the_excerpt = $post->post_excerpt;
            return apply_filters('the_content', $the_excerpt);
        } else {
            $the_excerpt = $post->post_content;
        }

        $the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
        $the_excerpt = preg_split('/\s+/', $the_excerpt, $length * 2 + 1);
        $excerpt_waste = array_pop($the_excerpt);
        $the_excerpt = implode(" ", $the_excerpt);

        if (isset($the_excerpt) && !empty($the_excerpt)) {

            if ($home)
                $the_excerpt = '<p>' . $the_excerpt . '</p>' . $extra;

            if (!$home)
                $the_excerpt = '<p>' . $the_excerpt . ' ' . $extra . '</p>';

        } else {
            $the_excerpt = $extra;
        }

        //echo $the_excerpt;
        return $the_excerpt;
    }
}

#-----------------------------------------------------------------
# Get the title of a chosen page by ID
#-----------------------------------------------------------------
if (!function_exists('get_pagetitle_by_id')) {
    function get_pagetitle_by_id($page_id)
    {
        $title_data = get_page($page_id);
        $title = apply_filters('the_content', $title_data->post_title);

        //Return page title
        return $title;
    }
}

#-----------------------------------------------------------------
# Replaces "[...]" (appended to automatically generated excerpts)
#-----------------------------------------------------------------
if (!function_exists('lambda_auto_excerpt_more')) {

    function lambda_auto_excerpt_more($more)
    {
        return ' ' . lambda_continue_reading_link();
    }

    add_filter('excerpt_more', 'lambda_auto_excerpt_more');
}

#-----------------------------------------------------------------
# Adds a pretty "Continue Reading" link to custom post excerpts.
#-----------------------------------------------------------------  
if (!function_exists('lambda_custom_excerpt_more')) {

    function lambda_custom_excerpt_more($output)
    {
        if (has_excerpt() && !is_attachment()) {
            $output .= lambda_continue_reading_link();
        }
        return $output;
    }

    add_filter('get_the_excerpt', 'lambda_custom_excerpt_more');
}

#-----------------------------------------------------------------
# Removes More Jump Link
#-----------------------------------------------------------------
if (!function_exists('remove_more_jump_link')) {

    function remove_more_jump_link($link)
    {
        $offset = strpos($link, '#more-');
        if ($offset) {
            $end = strpos($link, '"', $offset);
        }
        if ($end) {
            $link = substr_replace($link, '', $offset, $end - $offset);
        }
        return $link;
    }

    add_filter('the_content_more_link', 'remove_more_jump_link');
}

#-----------------------------------------------------------------
# Rel Category
#-----------------------------------------------------------------
add_filter('the_category', 'add_nofollow_cat');

function add_nofollow_cat($rel)
{
    $rel = str_replace('rel="category"', 'data-rel="category"', $rel);
    return $rel;
}

#-----------------------------------------------------------------
# Get Image Size
#-----------------------------------------------------------------
if (!function_exists('getImageSizebyID')) {
    function getImageSizebyID($PostID, $columnset)
    {
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($PostID), $columnset . 'col-image');
        $size = getimagesize($thumb['0']);
        return $size;
    }
}

#-----------------------------------------------------------------
# Social Media
#-----------------------------------------------------------------
if (!function_exists('socialmedia')) {
    function socialmedia()
    {
        $icons = get_option_tree('social_media_icons', '', false, true);
        if (is_array($icons)) {
            echo '<ul id="socialmedia">';
            foreach ($icons as $icon) {
                echo '
				 <li>
					<a href="' . $icon['link'] . '"><img src="' . $icon['image'] . '" alt="' . $icon['title'] . '" class="tTip" title="' . $icon['title'] . '" /></a>
				 </li>';
            }
            echo '</ul>';
        }
    }
}


#-----------------------------------------------------------------
# Author Social Media
#-----------------------------------------------------------------
function lambda_contactmethods($contactmethods)
{
    //Add Twitter
    $contactmethods['twitter'] = 'Twitter';
    //Add Facebook
    $contactmethods['facebook'] = 'Facebook';

    return $contactmethods;
}

add_filter('user_contactmethods', 'lambda_contactmethods', 10, 1);


#-----------------------------------------------------------------
# Helper function
#-----------------------------------------------------------------
if (!function_exists('extractURL')) {
    function extractURL($url)
    {
        $finalurl = preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $url, $match);
        $finalurl = generatePPVideoURL($match['0']['0']);
        return $finalurl;
    }
}

if (!function_exists('generatePPVideoURL')) {
    function generatePPVideoURL($url)
    {
        $spliturl = explode("/", $url);

        if (substr_count($url, "youtube")) {
            $finalurl = 'http://www.youtube.com/watch?v=' . $spliturl[4];
        } elseif (substr_count($url, "vimeo")) {
            $finalurl = 'http://vimeo.com/' . $spliturl[4];
        } else {
            $finalurl = 'unknown';
        }

        return $finalurl;
    }
}

#-----------------------------------------------------------------
# This function is elementary important to keep the form JavaScript running
#-----------------------------------------------------------------
if (!function_exists('remove_trash')) {
    function remove_trash($cleanmeup)
    {
        $newValue = preg_replace('@[\.,\+\\\\/-;:<>\?!\[\] ()&%$]@', '', $cleanmeup);
        return $newValue;
    }
}

#-----------------------------------------------------------------
# Helper function to sort arrays 
#-----------------------------------------------------------------
if (!function_exists('array_sort')) {
    function array_sort($array, $on, $order = SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }
}

if (!function_exists('compareItems')) {
    function compareItems($a, $b)
    {
        if (empty($b->SortID)) return '1';

        if ($a->SortID < $b->SortID) return -1;
        if ($a->SortID > $b->SortID) return 1;

        return 0; // equality
    }
}

#-----------------------------------------------------------------
# Pretty Photo for Standard WP Images
#-----------------------------------------------------------------
if (!function_exists('add_rel_lightbox')) {
    function add_rel_lightbox($content)
    {
        global $theme_options;

        if (isset($theme_options['activate_prettyphoto']) && $theme_options['activate_prettyphoto'] == 'on') {

            $string = '/<a href="(.*?).(jpg|jpeg|png|gif|bmp|ico)"><img(.*?)class="(.*?)wp-image-(.*?)" \/><\/a>/i';
            preg_match_all($string, $content, $matches, PREG_SET_ORDER);

            //Check which attachment is referenced
            foreach ($matches as $val) {
                $slimbox_caption = '';
                $post = get_post($val[5]);
                $slimbox_caption = esc_attr($post->post_content);

                $string = '<a href="' . $val[1] . '.' . $val[2] . '"><img' . $val[3] . 'class="' . $val[4] . 'wp-image-' . $val[5] . '" /></a>';
                $replace = '<a href="' . $val[1] . '.' . $val[2] . '" data-rel="prettyPhoto[this_page]" title="' . $slimbox_caption . '"><img' . $val[3] . 'class="' . $val[4] . 'wp-image-' . $val[5] . '" /></a>';
                $content = str_replace($string, $replace, $content);
            }
        }
        return $content;
    }

    add_filter('the_content', 'add_rel_lightbox', 2);
}

#-----------------------------------------------------------------
# Header Search form
#-----------------------------------------------------------------
/*
if ( !function_exists( 'lambda_header_searchform' ) ) {
	
	function lambda_header_searchform()  { ?> 
	    
    <div class="searchlens"></div>
	
    <form role="search" method="get" id="header-searchform" action="<?php echo home_url( '/' ); ?>">
		<input type="text" value="<?php _e('Search...', UT_THEME_INITIAL); ?>" onblur="if(this.value=='')this.value='<?php _e('Search...', UT_THEME_INITIAL); ?>';" onfocus="if(this.value=='<?php _e('Search...', UT_THEME_INITIAL); ?>')this.value='';" name="s" id="s" />
	</form>
	
	<?php }
}
*/

if (!function_exists('lambda_header_searchform')) {
    function lambda_header_searchform()
    { ?>

        <div></div>

    <?php }
}

#-----------------------------------------------------------------
# Fix Shortcodes
#-----------------------------------------------------------------
if (!function_exists('lambda_fix_shortcodes')) {
    function lambda_fix_shortcodes($content)
    {
        $array = array(
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']'
        );
        $content = strtr($content, $array);
        return $content;
    }

    add_filter('the_content', 'lambda_fix_shortcodes');
}

?>
<?php

function lambda_regx_removal($buffer)
{
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}

#-----------------------------------------------------------------
# Custom CSS Stuff
#-----------------------------------------------------------------
if (!function_exists('lambda_custom_css')) {

    function lambda_custom_css()
    {

        global $lambda_meta_data, $slider_meta_data;

        $theme_path = get_template_directory_uri();
        $theme_options = get_option('option_tree');

        $finalcss = '<style type="text/css">';

        #-----------------------------------------------------------------
        # Needed variables
        #-----------------------------------------------------------------
        $color_scheme = $theme_options['themecolor'];

        // Get needed meta variables
        if (is_home()) {

            $homeid = get_option('page_for_posts');
            $pagemetadata = get_post_meta($homeid, $lambda_meta_data->get_the_id(), TRUE);
            $slidermetadata = get_post_meta($homeid, $slider_meta_data->get_the_id(), TRUE);

        } else {

            $pagemetadata = $lambda_meta_data->the_meta();
            $slidermetadata = $slider_meta_data->the_meta();
        }

        #-----------------------------------------------------------------
        # Sitelayout
        #-----------------------------------------------------------------
        if ($theme_options['sitelayout'] != 'boxed' && $theme_options['responsive'] == 'off') {

            $finalcss .=

                '@media only screen and (max-width: 959px) {
                    
            #wrap {
                        width:990px !important;
            }
                
        }
                
        @media only screen and (min-width: 960px) {
                   
        	#wrap {
                       width:100% !important;
            }
                
        }';

        }

        if ($theme_options['sitelayout'] == 'boxed' && $theme_options['responsive'] == 'on') {

            $finalcss .=

                '.boxed {
			
			max-width:100%;
			
		}';

        }

        if ($theme_options['responsive'] == 'on') {

            $finalcss .=

                'body {
			
			overflow-x: hidden;
			
		}';

        }
        #-----------------------------------------------------------------
        # Sidebar Alignment
        #-----------------------------------------------------------------
        $page_settings = (isset($pagemetadata['sidebar_align'])) ? $pagemetadata['sidebar_align'] : '';

        $sidebar_position = (!empty($page_settings)) ? $page_settings : $theme_options['sidebar_alignement'];
        $content_position = ($sidebar_position == "right" ? "left" : "right");
        $sidebar_margin = ($sidebar_position == "right" ? "left" : "right");
        $sidebar_second_margin = ($sidebar_position == "both" ? "left" : "right");

        $finalcss .= "
	        #wrap #content {float: $content_position;}
	        #wrap #sidebar {float: $sidebar_position;}
	        #wrap #sidebar .widget-container {margin-$sidebar_margin: 20px;margin-$sidebar_position: 0px;}
	
	        /* Second sidebar enhancement */	
	        #wrap #sidebar_second {float:$content_position;}
	        #wrap #sidebar_second .widget-container {margin-$sidebar_second_margin: 20px;margin-$content_position: 0px;}
	        ";


        #-----------------------------------------------------------------
        # Custom Background
        #-----------------------------------------------------------------
        if (isset($theme_options['sitelayout']) && $theme_options['sitelayout'] == 'boxed') :

            if ($theme_options['background_type'] == 'default_backgroundcolor') {

                $finalcss .= 'body { background: ' . $theme_options['default_backgroundcolor'] . ' !important; }';

            } elseif ($theme_options['background_type'] == 'default_backgroundpattern') {

                $finalcss .= 'body { background: #FFF url(' . $theme_path . '/images/pattern/' . $theme_options['default_backgroundpattern']['background-image'] . ') repeat; }';

            } elseif ($theme_options['background_type'] == 'default_backgroundtexture') {

                $finalcss .= 'body { background: #FFF url(' . $theme_path . '/images/bg-textured/' . $theme_options['default_backgroundtexture']['background-image'] . ') repeat-x; }';

            } elseif ($theme_options['background_type'] == 'default_backgroundimage') {

                $finalcss .= '
				body { 
					background: #FFF url(' . $theme_options['default_backgroundimage'] . ');
					background-attachment: scroll;
					background-repeat: no-repeat;
					background-position: center top;								
				}';

            }

        endif;

        #-----------------------------------------------------------------
        # Custom Wrap
        #-----------------------------------------------------------------
        if (isset($theme_options['wrap_background_type']) && $theme_options['wrap_background_type'] == 'wrap_default_backgroundcolor') {

            $finalcss .= '#vtabs > div, .home-title span, .home-title-link, .carousel-navi, #service-loader, body > #wrap { background: ' . $theme_options['wrap_default_backgroundcolor'] . ' !important; }';

        } elseif ($theme_options['wrap_background_type'] == 'wrap_default_backgroundpattern') {

            $finalcss .= '#vtabs > div, .home-title span, .home-title-link, .carousel-navi, #service-loader, body > #wrap { background: #FFF url(' . $theme_path . '/images/pattern/' . $theme_options['wrap_default_backgroundpattern']['background-image'] . ') repeat; }';

        } elseif ($theme_options['wrap_background_type'] == 'wrap_default_backgroundtexture') {

            $finalcss .= '#vtabs > div, .home-title span, .home-title-link, .carousel-navi, #service-loader, body > #wrap { background: #FFF url(' . $theme_path . '/images/bg-textured/' . $theme_options['wrap_default_backgroundtexture']['background-image'] . ') repeat; }';

        } elseif ($theme_options['wrap_background_type'] == 'wrap_default_backgroundimage') {

            $finalcss .= '#vtabs > div, .home-title span, .home-title-link, .carousel-navi, #service-loader, body > #wrap  { 
				
				background: #FFF url(' . $theme_options['wrap_default_backgroundimage'] . '); 
				background-attachment: scroll;
                background-repeat: no-repeat;
                background-position: center top;					
				
			}';

        }

        #-----------------------------------------------------------------
        # Custom Footer
        #-----------------------------------------------------------------
        if (isset($theme_options['footer_background_type']) && $theme_options['footer_background_type'] == 'footer_default_backgroundpattern') {

            $finalcss .= '#footer-wrap { background: url(' . $theme_path . '/images/pattern/' . $theme_options['footer_default_backgroundpattern']['background-image'] . '); }';

        }

        #-----------------------------------------------------------------
        # Custom Featured Header
        #-----------------------------------------------------------------
        $backgroundtype = (isset($theme_options['slider_background_type'])) ? $theme_options['slider_background_type'] : '';
        $backgroundpattern = (isset($theme_options['slider_default_backgroundpattern'])) ? $theme_options['slider_default_backgroundpattern']['background-image'] : '';
        $backgroundimage = (isset($theme_options['slider_default_backgroundimage'])) ? $theme_options['slider_default_backgroundimage'] : '';

        //overwrite default values coming from meta panel if necessary
        $backgroundtype = (isset($slidermetadata['slider_background_type'])) ? $slidermetadata['slider_background_type'] : $backgroundtype;
        $backgroundpattern = (isset($slidermetadata['slider_default_backgroundpattern'])) ? $slidermetadata['slider_default_backgroundpattern'] : $backgroundpattern;
        $backgroundimage['background-color'] = (isset($slidermetadata['slider_default_backgroundcolor'])) ? $slidermetadata['slider_default_backgroundcolor'] : $backgroundimage['background-color'];

        if (isset($slidermetadata['slider_default_background_image'])) {
            $backgroundimage['background-image'] = (isset($slidermetadata['slider_default_background_image'])) ? $slidermetadata['slider_default_background_image'] : $backgroundimage['background-image'];
            $backgroundimage['background-repeat'] = (isset($slidermetadata['slider_default_background_repeat'])) ? $slidermetadata['slider_default_background_repeat'] : $backgroundimage['background-repeat'];
            $backgroundimage['background-position'] = (isset($slidermetadata['slider_default_background_position'])) ? $slidermetadata['slider_default_background_position'] : $backgroundimage['background-position'];
            $backgroundimage['background-attachment'] = (isset($slidermetadata['slider_default_background_attachment'])) ? $slidermetadata['slider_default_background_attachment'] : $backgroundimage['background-attachment'];
        }

        if ($backgroundtype == 'slider_default_backgroundpattern') {

            $finalcss .= '#lambda-featured-header-wrap { background: url(' . $theme_path . '/images/pattern/' . $backgroundpattern . ') repeat; }';

        } elseif ($backgroundtype == 'slider_default_backgroundimage') {

            $finalcss .= '#lambda-featured-header-wrap { background:' . $backgroundimage['background-color'] . ' url(' . $backgroundimage['background-image'] . ') ' . $backgroundimage['background-repeat'] . ' ' . $backgroundimage['background-position'] . ' ' . $backgroundimage['background-attachment'] . '; }';

        }


        #-----------------------------------------------------------------
        # Declare CSS Font Stacks for reuse
        #-----------------------------------------------------------------
        $websafefonts = array(
            'arial' => 'Arial, Helvetica, sans-serif',
            'georgia' => 'Georgia, serif',
            'helvetica' => '"HelveticaNeue","Helvetica Neue",Helvetica,Arial,sans-serif',
            'tahoma' => 'Tahoma, Geneva, sans-serif',
            'times' => '"Times New Roman", Times, serif',
            'trebuchet' => '"Trebuchet MS", Helvetica, sans-serif',
            'verdana' => 'Verdana, Geneva, sans-serif',
            'impact' => 'Impact, Charcoal, sans-serif',
            'palatino' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
            'century' => 'Century Gothic, sans-serif',
            'lucida' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
            'luciaconsole' => '"Lucida Console", Monaco, monospace',
            'arialblack' => '"Arial Black", Gadget, sans-serif',
            'arialnarrow' => '"Arial Narrow", sans-serif',
            'copperplate' => 'Copperplate / Copperplate Gothic Light, sans-serif',
            'gillsans' => 'Gill Sans / Gill Sans MT, sans-serif',
            'courier' => '"Courier New", Courier, monospace'
        );


        #-----------------------------------------------------------------
        # Add Custom Font to font stack
        #-----------------------------------------------------------------
        if (isset($theme_options['custom_font']) && is_array($theme_options['custom_font'])) {
            foreach ($theme_options['custom_font'] as $key => $value) {
                $websafefonts[strtolower($value['title'])] = '"' . $value['title'] . '"';
            }
        }

        #-----------------------------------------------------------------
        # Color Helper Functions
        #-----------------------------------------------------------------
        function HexToRGB($hex)
        {

            $hex = preg_replace("/#/", "", $hex);
            $color = array();

            if (strlen($hex) == 3) {
                $color['r'] = hexdec(substr($hex, 0, 1) . $r);
                $color['g'] = hexdec(substr($hex, 1, 1) . $g);
                $color['b'] = hexdec(substr($hex, 2, 1) . $b);
            } else if (strlen($hex) == 6) {
                $color['r'] = hexdec(substr($hex, 0, 2));
                $color['g'] = hexdec(substr($hex, 2, 2));
                $color['b'] = hexdec(substr($hex, 4, 2));
            }

            $color = implode(',', $color);
            return $color;
        }

        function RGBToHex($r, $g, $b)
        {
            $hex = "#";
            $hex .= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
            $hex .= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
            $hex .= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);

            return $hex;
        }

        #-----------------------------------------------------------------
        # Load Cutom Font Face
        #-----------------------------------------------------------------
        if (isset($theme_options['custom_font']) && is_array($theme_options['custom_font'])) :

            foreach ($theme_options['custom_font'] as $key => $value) {

                $finalcss .= "@font-face {";

                if (isset($value['title']) && !empty($value['title']))
                    $finalcss .= "\t\t" . "font-family: '" . $value['title'] . "';";

                if (isset($value['embedded-opentype']) && !empty($value['embedded-opentype'])) {
                    $finalcss .= "\t\t" . "src: url('" . $value['embedded-opentype'] . "');";
                    $finalcss .= "\t\t" . "src: url('" . $value['embedded-opentype'] . "?#iefix') format('embedded-opentype'),";
                }

                if (isset($value['woff']) && !empty($value['woff']))
                    $finalcss .= "\t\t" . "url('" . $value['woff'] . "') format('woff'),";

                if (isset($value['truetype']) && !empty($value['truetype']))
                    $finalcss .= "\t\t" . "url('" . $value['truetype'] . "') format('truetype'),";

                if (isset($value['svg']) && !empty($value['svg']))
                    $finalcss .= "\t\t" . "url('" . $value['svg'] . "') format('svg');";

                $finalcss .= "}";

            }

        endif;

        #-----------------------------------------------------------------
        # Body Typography
        #-----------------------------------------------------------------

        if (isset($theme_options['bodyfont']) && !empty($theme_options['bodyfont'])) {

            $finalcss .= 'body {';

            $finalcss .= 'color:' . $theme_options['bodyfont']['font-color'] . ';';
            $finalcss .= 'font-size:' . $theme_options['bodyfont']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['bodyfont']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['bodyfont']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['bodyfont']['font-style'] . ';';

            $finalcss .= '}';

            //single elements which needs body font color
            $finalcss .= '.portfolio-info span {';

            $finalcss .= 'color:' . $theme_options['bodyfont']['font-color'] . ';';

            $finalcss .= '}';

        }

        #-----------------------------------------------------------------
        # Headlines
        #-----------------------------------------------------------------
        $fontface = ($theme_options['headline_font_face_type'] == 'headline_font_face_google') ? polish_font_name($theme_options['headline_font_face_google']['font-family']) : $websafefonts[$theme_options['headline_font_face_websafe']['font-family']];

        $finalcss .= 'h1 { font-family: ' . $fontface . ';
		 font-size: ' . $theme_options['h1_font_size']['0'] . $theme_options['h1_font_size']['1'] . ';
	}';

        $finalcss .= 'h2 { font-family: ' . $fontface . '; 
		 font-size: ' . $theme_options['h2_font_size']['0'] . $theme_options['h2_font_size']['1'] . ';
	}';

        $finalcss .= 'h3 { font-family: ' . $fontface . '; 
		 font-size: ' . $theme_options['h3_font_size']['0'] . $theme_options['h3_font_size']['1'] . ';
	}';

        $finalcss .= 'h4 { font-family: ' . $fontface . '; 
		 font-size: ' . $theme_options['h4_font_size']['0'] . $theme_options['h4_font_size']['1'] . ';
	}';

        $finalcss .= 'h5 { font-family: ' . $fontface . '; 
		 font-size: ' . $theme_options['h5_font_size']['0'] . $theme_options['h5_font_size']['1'] . ';
	}';

        $finalcss .= 'h6 { font-family: ' . $fontface . '; 
		 font-size: ' . $theme_options['h6_font_size']['0'] . $theme_options['h6_font_size']['1'] . ';
	}';

        $finalcss .= 'h1, h2, h3, h4, h5, h6 {
		color: ' . $theme_options['headline_font_color'] . ';
	}';

        if ($theme_options['headline_font_face_type'] == 'headline_font_face_websafe') {

            $finalcss .= ' h1, h2, h3, h4, h5, h6 {
			font-weight: ' . $theme_options['headline_font_face_websafe']['font-weight'] . ';
			font-style: ' . $theme_options['headline_font_face_websafe']['font-style'] . '; 
		}';

        }

        $finalcss .= 'span.client-title strong {
		font-family: ' . $fontface . '; 
	}';


        #-----------------------------------------------------------------
        # Misc Headlines
        #-----------------------------------------------------------------
        if (isset($theme_options['toggle_headline']) && !empty($theme_options['toggle_headline'])) {

            $finalcss .= 'h3.trigger, p.trigger, ul.tabs li {';

            $finalcss .= 'font-size:' . $theme_options['toggle_headline']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['toggle_headline']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['toggle_headline']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['toggle_headline']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['toggle_headline']['font-transform'] . ';';

            $finalcss .= '}';

            $finalcss .= 'h3.trigger a, p.trigger a, ul.tabs li a {';

            $finalcss .= 'color:' . $theme_options['toggle_headline']['font-color'] . ';';

            $finalcss .= '}';

        }

        if (isset($theme_options['member_name']) && !empty($theme_options['member_name'])) {

            $finalcss .= '.member-name {';

            $finalcss .= 'color:' . $theme_options['member_name']['font-color'] . ';';
            $finalcss .= 'font-size:' . $theme_options['member_name']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['member_name']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['member_name']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['member_name']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['member_name']['font-transform'] . ';';

            $finalcss .= '}';

        }

        if (isset($theme_options['archive_title']) && !empty($theme_options['archive_title'])) {

            $finalcss .= '.archiv-title {';

            $finalcss .= 'color:' . $theme_options['archive_title']['font-color'] . ';';
            $finalcss .= 'font-size:' . $theme_options['archive_title']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['archive_title']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['archive_title']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['archive_title']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['archive_title']['font-transform'] . ';';

            $finalcss .= '}';
        }

        if (isset($theme_options['servicecol_headline']) && !empty($theme_options['servicecol_headline'])) {
            $finalcss .= 'article.service h3 {';

            $finalcss .= 'font-size:' . $theme_options['servicecol_headline']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['servicecol_headline']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['servicecol_headline']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['servicecol_headline']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['servicecol_headline']['font-transform'] . ';';

            $finalcss .= '}';
        }

        if (isset($theme_options['servicebox_headline']) && !empty($theme_options['servicebox_headline'])) {
            $finalcss .= 'article.service-box h3 {';

            $finalcss .= 'font-size:' . $theme_options['servicebox_headline']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['servicebox_headline']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['servicebox_headline']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['servicebox_headline']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['servicebox_headline']['font-transform'] . ';';

            $finalcss .= '}';
        }

        if (isset($theme_options['service_tabs']) && !empty($theme_options['service_tabs'])) {
            $finalcss .= '#vmenu ul li h3 {';

            $finalcss .= 'color:' . $theme_options['service_tabs']['font-color'] . ';';
            $finalcss .= 'font-size:' . $theme_options['service_tabs']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['service_tabs']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['service_tabs']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['service_tabs']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['service_tabs']['font-transform'] . ';';

            $finalcss .= '}';
        }

        #-----------------------------------------------------------------
        # Page Title & Teaser
        #-----------------------------------------------------------------
        if (isset($theme_options['page_title']) && !empty($theme_options['page_title'])) {
            $finalcss .= '#page-title, .featured-header-title {';

            $finalcss .= 'color:' . $theme_options['page_title']['font-color'] . ';';
            $finalcss .= 'font-size:' . $theme_options['page_title']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['page_title']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['page_title']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['page_title']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['page_title']['font-transform'] . ';';

            $finalcss .= '}';
        }

        if (isset($theme_options['home_title']) && !empty($theme_options['home_title'])) {
            $finalcss .= '.home-title, .portfolio-info .home-title span {';

            $finalcss .= 'color:' . $theme_options['home_title']['font-color'] . ';';
            $finalcss .= 'font-size:' . $theme_options['home_title']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['home_title']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['home_title']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['home_title']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['home_title']['font-transform'] . ';';

            $finalcss .= '}';
        }

        if (isset($theme_options['page_teaser']) && !empty($theme_options['page_teaser'])) {
            $finalcss .= 'p.teaser-text {';

            $finalcss .= 'color:' . $theme_options['page_teaser']['font-color'] . ';';
            $finalcss .= 'font-size:' . $theme_options['page_teaser']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['page_teaser']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['page_teaser']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['page_teaser']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['page_teaser']['font-transform'] . ';';

            $finalcss .= '}';
        }

        #-----------------------------------------------------------------
        # Logo
        #-----------------------------------------------------------------
        if (isset($theme_options['logo_font']) && !empty($theme_options['logo_font'])) {
            $finalcss .= '#logo h1, #logo h1 a {';

            $finalcss .= 'color:' . $theme_options['logo_font']['font-color'] . ';';
            $finalcss .= 'font-size:' . $theme_options['logo_font']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['logo_font']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['logo_font']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['logo_font']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['logo_font']['font-transform'] . ';';

            $finalcss .= '}';
        }

        #-----------------------------------------------------------------
        # Widget Titles
        #-----------------------------------------------------------------
        if (isset($theme_options['sidebar_widget_title']) && !empty($theme_options['sidebar_widget_title'])) {
            $finalcss .= '#sidebar .widget-title, #reply-title, .comments-title, h3.author-name, #sidebar_second .widget-title, .widget-sidebar .widget-title, .lambda-header-widget .widget-title {';

            $finalcss .= 'color:' . $theme_options['sidebar_widget_title']['font-color'] . ';';
            $finalcss .= 'font-size:' . $theme_options['sidebar_widget_title']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['sidebar_widget_title']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['sidebar_widget_title']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['sidebar_widget_title']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['sidebar_widget_title']['font-transform'] . ';';

            $finalcss .= '}';

            $finalcss .= '.widget-title a { ';

            $finalcss .= 'color:' . $theme_options['sidebar_widget_title']['font-color'] . ';';

            $finalcss .= '}';
        }

        if (isset($theme_options['footer_widget_title']) && !empty($theme_options['footer_widget_title'])) {
            $finalcss .= '#footer .widget-title {';

            $finalcss .= 'color:' . $theme_options['footer_widget_title']['font-color'] . ';';
            $finalcss .= 'font-size:' . $theme_options['footer_widget_title']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['footer_widget_title']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['footer_widget_title']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['footer_widget_title']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['footer_widget_title']['font-transform'] . ';';

            $finalcss .= '}';
        }


        #-----------------------------------------------------------------
        # Blog Styling
        #-----------------------------------------------------------------
        if (isset($theme_options['blog_titles']) && !empty($theme_options['blog_titles'])) {
            $finalcss .= '.entry-title { ';

            $finalcss .= 'color:' . $theme_options['blog_titles']['font-color'] . ';';
            $finalcss .= 'font-size:' . $theme_options['blog_titles']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['blog_titles']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['blog_titles']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['blog_titles']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['blog_titles']['font-transform'] . ';';

            $finalcss .= '}';

            $finalcss .= '.entry-title a { ';

            $finalcss .= 'color:' . $theme_options['blog_titles']['font-color'] . ';';

            $finalcss .= '}';
        }

        if (isset($theme_options['blog_titles_home']) && !empty($theme_options['blog_titles_home'])) {
            $finalcss .= '.recent-post .entry-title { ';

            $finalcss .= 'color:' . $theme_options['blog_titles_home']['font-color'] . ';';
            $finalcss .= 'font-size:' . $theme_options['blog_titles_home']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['blog_titles_home']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['blog_titles_home']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['blog_titles_home']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['blog_titles_home']['font-transform'] . ';';

            $finalcss .= '}';
        }

        if (isset($theme_options['blog_titles']) && !empty($theme_options['blog_titles'])) {
            $finalcss .= '.link-post-title { ';

            $finalcss .= 'font-size:' . $theme_options['blog_titles']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['blog_titles']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['blog_titles']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['blog_titles']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['blog_titles']['font-transform'] . ';';

            $finalcss .= '}';

            $finalcss .= '.link-post-title a { ';

            $finalcss .= 'color:' . $theme_options['blog_titles']['font-color'] . ';';

            $finalcss .= '}';

        }

        if (isset($theme_options['blog_meta']) && !empty($theme_options['blog_meta'])) {
            $finalcss .= '.entry-meta, .entry-meta-single-post { ';

            $finalcss .= 'color:' . $theme_options['blog_meta']['font-color'] . ';';
            $finalcss .= 'font-size:' . $theme_options['blog_meta']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['blog_meta']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['blog_meta']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['blog_meta']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['blog_meta']['font-transform'] . ';';

            $finalcss .= '}';

            $finalcss .= '.entry-meta-single-post a, .entry-meta a { ';

            $finalcss .= 'color:' . $theme_options['blog_meta']['font-color'] . ';';

            $finalcss .= '}';


        }


        #-----------------------------------------------------------------
        # Revolution Slider Caption
        #----------------------------------------------------------------

        $finalcss .= '
	.caption.themecolor_background {
		background-color: ' . $color_scheme . ' ;
	}
	.caption.themecolor_normal {
		color: ' . $color_scheme . ';
	}
	.themecolor-background {
		background: ' . $color_scheme . ';
		-moz-border-radius: 2px;
		border-radius: 2px;
		padding: 5px 10px;
	}	
	.themebutton.button {
		background: ' . $color_scheme . ';
		color:#FFFFFF;
	}
	.themebutton2:hover {
		background: ' . $color_scheme . ';
	}';

        #-----------------------------------------------------------------
        # Navigation Customisation
        #-----------------------------------------------------------------

        //Navigation Level 1
        if (isset($theme_options['navigation_font']) && !empty($theme_options['navigation_font'])) {
            $finalcss .= '#navigation ul li a {';

            $finalcss .= 'color:' . $theme_options['navigation_font']['font-color'] . ';';
            $finalcss .= 'font-size:' . $theme_options['navigation_font']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['navigation_font']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['navigation_font']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['navigation_font']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['navigation_font']['font-transform'] . ';';

            $finalcss .= '}';
        }

        //Navigation Level 2 Link Style
        if (isset($theme_options['drop_down_font_color']) && !empty($theme_options['drop_down_font_color'])) {
            $finalcss .= '#navigation ul.sub-menu li a {';

            $finalcss .= 'color:' . $theme_options['drop_down_font_color']['font-color'] . ' !important;';
            $finalcss .= 'font-size:' . $theme_options['drop_down_font_color']['font-size'] . ';';
            $finalcss .= 'font-family:' . $websafefonts[$theme_options['drop_down_font_color']['font-family']] . ';';
            $finalcss .= 'font-weight:' . $theme_options['drop_down_font_color']['font-weight'] . ';';
            $finalcss .= 'font-style:' . $theme_options['drop_down_font_color']['font-style'] . ';';
            $finalcss .= 'text-transform:' . $theme_options['drop_down_font_color']['font-transform'] . ';';

            $finalcss .= '}';
        }


        $finalcss .= '
	#navigation ul a:hover {
		background: ' . $theme_options['main_navigation_dropdown_active_state'] . ';
		color: ' . $color_scheme . ' !important;
	}
	#navigation ul li:hover  {
		background: ' . $theme_options['main_navigation_dropdown_active_state'] . ';
	}
	#navigation ul.sub-menu li:hover, #navigation ul.sub-menu a:hover  {
		background: none !important;
	}
	#navigation ul li:hover a {
		color: ' . $color_scheme . ';
		border-top:1px solid ' . $color_scheme . ';
	}
	#navigation ul li ul li:hover a{
		color: ' . $theme_options['drop_down_font_color_hover'] . ' !important;
	}
	#navigation ul.sub-menu .current-menu-ancestor a {
		color: ' . $theme_options['drop_down_font_color_hover'] . ' !important;
	}
	#navigation ul.sub-menu .current-menu-ancestor ul a {
		color: ' . $theme_options['drop_down_font_color']['font-color'] . ' !important;
	}
	#navigation ul.sub-menu .current-menu-ancestor ul a:hover {
		color: ' . $theme_options['drop_down_font_color_hover'] . ' !important;
	}
	#navigation ul.sub-menu .current-menu-ancestor ul li.active > a {
		color: ' . $theme_options['drop_down_font_color_hover'] . ' !important;
	}	
	#navigation ul li ul li:hover ul li a {
		color: ' . $theme_options['drop_down_font_color']['font-color'] . ' !important;
	}
	#navigation ul.sub-menu a:hover {
		color: ' . $theme_options['drop_down_font_color_hover'] . ' !important;
	}
	#navigation ul > li.active > a {
		background: ' . $color_scheme . ' !important;
		color: ' . $theme_options['navigation_active'] . ' !important;		
	}
	#navigation ul > li ul li ul li.active > a,
	#navigation ul > li ul li.active > a {
		color: ' . $theme_options['drop_down_font_color_hover'] . ' !important;
		background: none !important;
	}
	#navigation ul.sub-menu {
		background-color: rgb(' . HexToRGB($color_scheme) . ');
		background-color: rgba(' . HexToRGB($color_scheme) . ',0.9);
	}
	#navigation ul li ul li:hover a.sf-with-ul:after, .sub-menu .sf-with-ul:after { left: 100%; margin-left:-10px; border: solid transparent; content: " "; height: 0; width: 0; position: absolute; pointer-events: none; }
	#navigation ul li ul li:hover a.sf-with-ul:after, .sub-menu .sf-with-ul:after { border-left-color: ' . $theme_options['drop_down_font_color']['font-color'] . '; border-width: 5px; top: 50%; margin-top: -5px; }';


        #-----------------------------------------------------------------
        # Color Variations
        #-----------------------------------------------------------------

        $finalcss .= '
	a,
	.widget-sidebar a:hover,
	#sidebar_second a:hover,
	#sidebar a:hover,
	ul.archive li a:hover,
	p.search-title span, 
	p.tag-title span,
	#logo h1 a:hover,
	.entry-content a,
	.portfolio-info a,
	ul.archive,
	.widget_categories li,
	.widget_links li,
	.widget_nav_menu li,
	.widget_pages li,
	.widget_meta li,
	.widget_archive li,
	.lambda_widget_portfolio li,
	.widget_recent_comments li,
	.widget_recent_entries li,
	.entry-title a:hover,
	#teaser-content a,  
	.themecolor,
	.tag-links a:hover,
	ul.page-numbers li span.current,
	ul.filter_portfolio a:hover,
	ul.filter_portfolio a.selected,
	#vmenu li.selected:hover h3,
	#vmenu li.selected h3,
	#mobile-menu li a,
	ul.tabs li a:hover,
	.testimonial-name span,
	#footer a:hover,
	.entry-meta a:hover,
	.mm-trigger.active,
	.mm-trigger:hover,
	.entry-meta-single-post a:hover  {
		color: ' . $color_scheme . ';
	}
	
	h3.trigger.active a,
	p.trigger.active a,
	h3.trigger:hover a ,
	p.trigger:hover a {
		color: ' . $color_scheme . ' !important;
	}
	.portfolio-title-below-wrap a,
	.tag_links a,
	.cta-button,
	.nevada-caption.dark .excerpt:hover,
	.nevada-caption.white .excerpt:hover,
	.quote,
	.link-post-title a,
	.entry-attachment .entry-caption,
	.gallery-caption,
	.lambda-pricingtable.featured .lambda-pricingtable-top,
	.testimonial-company,
	.tagcloud a,
	.lambda_widget_portfolio li:before,
	.widget_links li:before,
	.widget_nav_menu li:before,
	.widget_pages li:before,
	.widget_meta li:before,
	.widget_categories li:before,
	.widget_archive li:before,
	.widget_recent_entries li:before,
	.widget_recent_comments li:before,
	ul.archive li:before,
	.lambda-pricingtable.featured .lambda-table-button,
	ul.tabs li a.active {
		background: ' . $color_scheme . ';
	}
	
	.lambda-table-button:hover {
		background: ' . $color_scheme . ' !important;
	}
	
	.searchlens:hover {
	background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/search-icon.png); 
	background-repeat: no-repeat;
	background-position: center center;	
	}
	
	.member-info,
	.camera_wrap .camera_pag .camera_pag_ul li:hover > span,
	.camera_wrap .camera_pag .camera_pag_ul li.cameracurrent > span,
	.camera_bar_cont span,
	.lambda-dropcap2,
	.lambda-highlight1,
	.flex-control-nav li a:hover,
	.flex-control-nav li a.active,
	.edit-link a:hover,
	.permalink-hover:hover,
	#slider-nav a#slider-next:hover,
	#slider-nav a#slider-prev:hover,
	.post-slider-nav a.slider-prev:hover,
	.post-slider-nav a.slider-next:hover,
	#slider-bullets a.activeSlide,
	#slider-bullets a:hover,
	#wp-calendar td#today,
	.pformat,
	.lambda_widget_video .lambda-video,
	input[type="submit"], 
	input[type="reset"], 
	input[type="button"] {
		background-color: ' . $color_scheme . ';
	} 
	
	.camera_commands,
	.camera_prev,
	.camera_next,
	.flex-direction-nav a,
	.lambda-featured-header-caption {
		background-color:rgb(' . HexToRGB($color_scheme) . ');
		background-color:rgba(' . HexToRGB($color_scheme) . ',0.9);
	}
	.tp-caption.nebraska-style {
		background-color:rgb(' . HexToRGB($color_scheme) . ') !important;	
		background-color:rgba(' . HexToRGB($color_scheme) . ',0.9) !important;
	}
	.tp-bullets.simplebullets.round .bullet.selected,
	.tp-leftarrow.default,
	.tp-rightarrow.default {
		background-color:rgb(' . HexToRGB($color_scheme) . ') !important;	
		background-color:rgba(' . HexToRGB($color_scheme) . ',0.9) !important;
	}
	.tp-rightarrow.default:hover,
	.tp-leftarrow.default:hover {
		background-color:rgb(85,85,85) !important;
		background-color:rgba(85,85,85,0.9) !important;
		-webkit-transition:.2s all linear;
		-moz-transition:.2s  all linear;
		-o-transition:.2s  all linear;
		-ms-transition:.2s  all linear;
		transition:.2s  all linear;
	}
	
	::-moz-selection  {
		color: #FFFFFF !important;
		background: ' . $color_scheme . ';
	}
	::selection {
		color: #FFFFFF !important;
		background:' . $color_scheme . ';
	}
	
	ul.lambda-sociallinks li a.aim { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/aim.png); }
	ul.lambda-sociallinks li a.behance { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/behance.png); }
	ul.lambda-sociallinks li a.delicious { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/delicious.png); }
	ul.lambda-sociallinks li a.deviantart { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/deviantart.png); }
	ul.lambda-sociallinks li a.digg { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/digg.png); }
	ul.lambda-sociallinks li a.dribbble { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/dribbble.png); }
	ul.lambda-sociallinks li a.dropbox { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/dropbox.png); }
	ul.lambda-sociallinks li a.email { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/email.png); }
	ul.lambda-sociallinks li a.facebook { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/facebook.png); }
	ul.lambda-sociallinks li a.fivehundredpx { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/500px.png); }
	ul.lambda-sociallinks li a.flickr { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/flickr.png); }
	ul.lambda-sociallinks li a.forrst { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/forrst.png); }
	ul.lambda-sociallinks li a.foursquare { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/foursquare.png); }
	ul.lambda-sociallinks li a.github { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/github_alt.png); }
	ul.lambda-sociallinks li a.googleplus { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/google_plus.png); }
	ul.lambda-sociallinks li a.grooveshark { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/grooveshark.png); }
	ul.lambda-sociallinks li a.instagram { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/instagram.png); }
	ul.lambda-sociallinks li a.lastfm { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/lastfm.png); }
	ul.lambda-sociallinks li a.link { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/link.png); }
	ul.lambda-sociallinks li a.linkedin { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/linkedin.png); }
	ul.lambda-sociallinks li a.maps { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/maps.png); }
	ul.lambda-sociallinks li a.picasa { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/picasa.png); }
	ul.lambda-sociallinks li a.pinterest { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/pinterest.png); }
	ul.lambda-sociallinks li a.rss { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/feed.png); }
	ul.lambda-sociallinks li a.soundcloud { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/soundcloud.png); }
	ul.lambda-sociallinks li a.steam { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/steam.png); }
	ul.lambda-sociallinks li a.tumblr { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/tumblr.png); }
	ul.lambda-sociallinks li a.twitter { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/twitter.png); }
	ul.lambda-sociallinks li a.vimeo { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/vimeo.png); }
	ul.lambda-sociallinks li a.wordpress { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/wordpress.png); }
	ul.lambda-sociallinks li a.xing { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/xing.png); }
	ul.lambda-sociallinks li a.yahoo { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/yahoo.png); }
	ul.lambda-sociallinks li a.youtube { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/youtube.png); }
	ul.lambda-sociallinks li a.whatsapp { background: ' . $color_scheme . ' url(' . $theme_path . '/images/icons/social/whatsapp.png); }
	
	.hover-overlay {
		background-color: rgb(' . HexToRGB($theme_options['hover_color_rgb']) . ');
		background-color:rgba(' . HexToRGB($theme_options['hover_color_rgb']) . ',' . $theme_options['hover_opacity'] . ');
	}';

        if (isset($theme_options['responsive']) && $theme_options['responsive'] == 'on') {

            $finalcss .= '
		
		@media only screen and (min-width: 768px) and (max-width: 959px) { .nav-wrap {
			background: ' . $color_scheme . ' ;
		}}
		@media only screen and (max-width: 767px) { .nav-wrap {
			background: ' . $color_scheme . ' ;
		}}
		@media only screen and (min-width: 480px) and (max-width: 767px) { .nav-wrap {
			background: ' . $color_scheme . ' ;
		}}';

        };


        #-----------------------------------------------------------------
        # Custom CSS out of Theme Options Panel
        #-----------------------------------------------------------------
        $finalcss .= stripslashes($theme_options['custom_css']);
        $finalcss .= '</style>';

        #-----------------------------------------------------------------
        # Output minified CSS
        #-----------------------------------------------------------------
        echo lambda_regx_removal($finalcss);

    }

    add_action('wp_head', 'lambda_custom_css');
}
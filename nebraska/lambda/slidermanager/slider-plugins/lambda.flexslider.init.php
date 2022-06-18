<?php

/**
 * FlexSlider Java & HTML Markup
 * lambda framework v 2.0
 * by www.unitedthemes.com
 * since framework v 2.0
 */

#-----------------------------------------------------------------
# FlexSlider HTML Output
#-----------------------------------------------------------------
if (!function_exists('getFlexHTML')) {

    function getFlexHTML($slider_result)
    {
        $options = get_option($slider_result->option_name);

        $html = '<div class="sixteen columns clearfix ut-slider-wrap"><div class="flexslider_' . $slider_result->id . '"><ul class="slides">';

        if (is_array($options['slides'])):
            foreach ($options['slides'] as $slide) {

                $html .= '<li>';
                $html .= '<a href="' . $slide['caption_link'] . '"><img src="' . $slide['imgurl'] . '" alt="' . $slide['caption_text'] . '" /></a>';

                if (!empty($caption)) {
                    $html .= '<p class="flex-caption">' . $slide['caption_desc'] . '</p>';
                }

                $html .= '</li>';
            }
        endif;

        $html .= '</ul></div></div>';

        return $html;
    }
}

#-----------------------------------------------------------------
# General Tab - FlexSlider
#-----------------------------------------------------------------
function flexslider_form_array()
{
    $default = array(

        'animation' => array('default' => 'fade',
            'keyvalues' => 'fade;slide',
            'keytype' => 'select',
            'js' => 'char',
            'fullname' => 'Animation',
            'description' => 'Select your animation type, fade or slide'),

        'slideDirection' => array('default' => 'horizontal',
            'keyvalues' => 'horizontal;vertical',
            'keytype' => 'select',
            'js' => 'char',
            'fullname' => 'Slide Direction',
            'description' => 'Select the sliding direction, horizontal or vertical'),

        'slideshow' => array('default' => 'true',
            'keyvalues' => 'true;false',
            'keytype' => 'radio',
            'fullname' => 'Slide Show Mode',
            'description' => 'Animate slider automatically'),

        'slideshowSpeed' => array('default' => '7000',
            'keytype' => 'input',
            'fullname' => 'Slide Show Speed',
            'description' => 'Set the speed of the slideshow cycling, in milliseconds'),

        'animationDuration' => array('default' => '600',
            'keytype' => 'input',
            'fullname' => 'Animation Duration',
            'description' => 'Set the speed of animations, in milliseconds'),

        'directionNav' => array('default' => 'true',
            'keyvalues' => 'true;false',
            'keytype' => 'radio',
            'fullname' => 'Display Direction Nav',
            'description' => 'Create navigation for previous/next navigation?'),

        'controlNav' => array('default' => 'true',
            'keyvalues' => 'true;false',
            'keytype' => 'radio',
            'fullname' => 'Display Control Nav',
            'description' => 'Create navigation for paging control of each slide?'),

        'keyboardNav' => array('default' => 'true',
            'keyvalues' => 'true;false',
            'keytype' => 'radio',
            'fullname' => 'Activate Keyboard',
            'description' => 'Allow slider navigating via keyboard left/right keys?'),

        'mousewheel' => array('default' => 'true',
            'keyvalues' => 'true;false',
            'keytype' => 'radio',
            'fullname' => 'Activate Mousewheel',
            'description' => 'Allow slider navigating via mousewheel?'),

        'randomize' => array('default' => 'false',
            'keyvalues' => 'true;false',
            'keytype' => 'radio',
            'fullname' => 'Play random?',
            'description' => 'Randomize slide order'),

        'animationLoop' => array('default' => 'true',
            'keyvalues' => 'true;false',
            'keytype' => 'radio',
            'fullname' => 'Should the animation loop?',
            'description' => 'If No, directionNav will received -disable- classes at either end'),

        'pauseOnHover' => array('default' => 'false',
            'keyvalues' => 'true;false',
            'keytype' => 'radio',
            'fullname' => 'Pause on hover?',
            'description' => 'Pause the slideshow when hovering over slider, then resume when no longer hovering')
    );

    return $default;
}

#-----------------------------------------------------------------
# Callback Tab - FlexSlider
#-----------------------------------------------------------------
function flexslider_add_callback_array()
{
    global $theme_path;

    $default = array(

        'start' => array('default' => 'start',
            'keytype' => 'textarea',
            'fullname' => 'Callback on start',
            'description' => 'Fires when the slider loads the first slide'),

        'before' => array('default' => 'before',
            'keytype' => 'textarea',
            'fullname' => 'Callback before Slide',
            'description' => 'Fires asynchronously with each slider animation'),

        'after' => array('default' => 'after',
            'keytype' => 'textarea',
            'fullname' => 'Callback after Slide',
            'description' => 'Fires after each slider animation completes'),

        'end' => array('default' => 'end',
            'keytype' => 'textarea',
            'fullname' => 'Callback at end',
            'description' => 'Fires when the slider reaches the last slide (asynchronous)')
    );

    return $default;
}
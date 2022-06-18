<?php
#---------------------------------------------------------
# Fallback function
#---------------------------------------------------------
if (!function_exists('lambda_translate_meta')) :
    function lambda_translate_meta($content)
    {
        return $content;
    }
endif;
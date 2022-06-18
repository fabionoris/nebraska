<?php
if (!function_exists('lambda_translate_meta')) :
    function lambda_translate_meta($content)
    {
        #-----------------------------------------------------------------
        # Applies a special filer depending on the used plugin
        #-----------------------------------------------------------------
        return qtrans_useCurrentLanguageIfNotFoundShowAvailable($content);
    }
endif;
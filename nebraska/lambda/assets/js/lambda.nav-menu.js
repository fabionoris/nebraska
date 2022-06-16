//<![CDATA[
jQuery(document).ready(function () {

    jQuery('.mc-color-picker').each(function () {
        var $this = jQuery(this),
            id = $this.attr('rel');
        $this.farbtastic('#' + id);
    });

    jQuery(function () {
        jQuery(".colortabs").tabs();
    });

});
//]]>   

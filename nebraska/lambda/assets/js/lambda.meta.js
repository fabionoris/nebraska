/* ------------------------------------------------
 *	Lambda Framework 1.0
 *	by unitedthemes.com
 *	Author: Matthias Nettekoven
 * ------------------------------------------------ */

jQuery(document).ready(function ($) {

    // Move Editor and Meta Boxes
    $('#featuredheader').prependTo('#slider-settings');

    //globals
    var keepelement = '';

    /* ------------------------------------------------
    Helper functions
    ------------------------------------------------ */
    $.fn.slidebutton = function (settings) {
        settings = $.extend({
            property: "left",
            width: "50"
        }, settings);

        return this.each(function () {
            $(this).hover(function () {
                var drect = {};
                drect[settings.property] = "-" + settings.width + "px";
                $("img", this).stop().animate(drect, {queue: false, duration: 200});

            }, function () {
                var drect = {};
                drect[settings.property] = "0px";
                $("img", this).stop().animate(drect, {queue: false, duration: 200});
            });
        });
    };


    function close_box() {
        $('.backdrop, .box').animate({'opacity': '0'}, 300, 'linear', function () {

            $('.backdrop').css('display', 'none');
            $(keepelement).css('display', 'none')
            $('#pagetool').css('height', 'auto');

        });
    }


    function getgridname(gridsize) {

        var grids = {

            '220': '1/4',
            '300': '1/3',
            '460': '1/2',
            '620': '2/3',
            '700': '3/4',
            '940': 'Full Width'

        }

        return grids[gridsize];
    }


    $.fn.update_element = function (settings) {
        settings = $.extend({

            gridsize: '220'

        }, settings);

        return this.each(function () {

            //update grid input field
            $(this).parent().parent('.grid_item').find('.grid').attr('value', settings.gridsize);

            //update current grid badge
            $(this).parent().parent('.grid_item').find('.currentgrid').text(getgridname(settings.gridsize));

        });

    }

    /* ------------------------------------------------
    Resize elements on click
    ------------------------------------------------ */
    $(".resizeup").on('click', function () {
        var parentwidth = $(this).parent().parent('.grid_item').width();

        //one fourth element
        if (parentwidth == 220 && parentwidth < 300) {

            var newwidth = parentwidth + 80;

            $(this).parent().parent('.grid_item').width(newwidth);
            $(this).update_element({gridsize: newwidth});

        } else if (parentwidth == 300 && parentwidth < 460) {

            var newwidth = parentwidth + 160;

            $(this).parent().parent('.grid_item').width(newwidth);
            $(this).update_element({gridsize: newwidth});

        } else if (parentwidth == 460 && parentwidth < 620) {

            var newwidth = parentwidth + 160;

            $(this).parent().parent('.grid_item').width(newwidth);
            $(this).update_element({gridsize: newwidth});

        } else if (parentwidth == 620 && parentwidth < 700) {

            var newwidth = parentwidth + 80;

            $(this).parent().parent('.grid_item').width(newwidth);
            $(this).update_element({gridsize: newwidth});

        } else if (parentwidth == 700 && parentwidth < 940) {

            var newwidth = parentwidth + 240;

            $(this).parent().parent('.grid_item').width(newwidth).update_element(newwidth);
            $(this).update_element({gridsize: newwidth});

        }
        ;

    });

    $(".resizedown").on('click', function () {
        var parentwidth = $(this).parent().parent('.grid_item').width();

        if (parentwidth == 940 && parentwidth > 700) {

            var newwidth = parentwidth - 240;

            $(this).parent().parent('.grid_item').width(newwidth).update_element(newwidth);
            $(this).update_element({gridsize: newwidth});

        } else if (parentwidth == 700 && parentwidth > 620) {

            var newwidth = parentwidth - 80;

            $(this).parent().parent('.grid_item').width(newwidth).update_element(newwidth);
            $(this).update_element({gridsize: newwidth});

        } else if (parentwidth == 620 && parentwidth > 460) {

            var newwidth = parentwidth - 160;

            $(this).parent().parent('.grid_item').width(newwidth).update_element(newwidth);
            $(this).update_element({gridsize: newwidth});

        } else if (parentwidth == 460 && parentwidth > 300) {

            var newwidth = parentwidth - 160;

            $(this).parent().parent('.grid_item').width(newwidth).update_element(newwidth);
            $(this).update_element({gridsize: newwidth});

        } else if (parentwidth == 300 && parentwidth > 240) {

            var newwidth = parentwidth - 80;

            $(this).parent().parent('.grid_item').width(newwidth).update_element(newwidth);
            $(this).update_element({gridsize: newwidth});

        }
        ;


    });


    /* ------------------------------------------------
    Change boxname on input
    ------------------------------------------------ */
    $('.boxname').on("input propertychange", function () {
        var boxname = $(this).val();
        $(this).parent('.modal-body').parent().find('.modal-header').text(boxname);
        $(this).parent('.modal-body').parent().parent().find('.ui-widget-header').text(boxname);
    });


    /* ------------------------------------------------
    Change box content
    ------------------------------------------------ */
    $(".box_type").on("change", function () {

        var chosen_box_type = $(this).val();

        $(this).parent('.modal-body').children(".single_item").each(function () {

            if ($(this).hasClass(chosen_box_type)) {

                $(this).show();

                var new_pt_height = $(this).parent('.modal-body').parent('.itembox').actual('height');
                $('#pagetool').height(new_pt_height + 50);

            } else {

                $(this).hide();

            }

        });

    });


    /* ------------------------------------------------
    Display or hide box content after load
    ------------------------------------------------ */
    $(".box_type").each(function () {

        var chosen_box_type = $(this).val();

        if (chosen_box_type) {
            $(this).parent('.modal-body').find('.' + chosen_box_type).show();
        }

    });

    $("#sliderstyle_type").each(function () {

        var chosen_box_type = $(this).val();

        if (chosen_box_type) {
            $('#' + chosen_box_type).show();
        }

    });

    $("#bgstyle_type").each(function () {

        var chosen_box_type = $(this).val();

        if (chosen_box_type) {
            $('#' + chosen_box_type).show();
        }

    });

    $("#sbgstyle_type").each(function () {

        var chosen_box_type = $(this).val();

        if (chosen_box_type) {
            $('#' + chosen_box_type).show();
        }

    });

    $(".select_toggle_type").each(function () {

        var type = $(this).val();
        if (type) {
            $(".select_toggle_" + type).show()
        }

    });

    $(".select_testimonial_type").each(function () {

        var type = $(this).val();
        if (type) {
            $(".testimonial_type_" + type).show()
        }

    });

    $(".select_client_type").each(function () {

        var type = $(this).val();
        if (type) {
            $(".client_type_" + type).show()
        }

    });

    /* ------------------------------------------------
    Simple lightbox
    ------------------------------------------------ */
    $('.doedit').on('click', function () {

        //start with background
        $('.backdrop').animate({'opacity': '.50'}, 300, 'linear');
        $('.backdrop').css('display', 'block');

        //identify item parents
        $(this).parent('.itemedit').parent('.grid_item').next('.itembox').animate({'opacity': '1.00'}, 300, 'linear');
        $(this).parent('.itemedit').parent('.grid_item').next('.itembox').css('display', 'block');

        var new_pt_height = $(this).parent('.itemedit').parent('.grid_item').next('.itembox').actual('height');
        keepelement = $(this).parent('.itemedit').parent('.grid_item').next('.itembox');

        if ($('#pagetool').actual('height') < new_pt_height) {
            $('#pagetool').height(new_pt_height + 50);
        }

        if (!$(this).parent('.itemedit').parent('.grid_item').find('.grid').val()) {
            $(this).parent('.itemedit').parent('.grid_item').find('.grid').val('220')
        }

    });

    $('.doclose').on('click', function () {
        close_box();
    });

    $('.backdrop').on('click', function () {
        close_box();
    });


    /* ------------------------------------------------
    Radio Buttons
    ------------------------------------------------ */
    $(".radio_active").on('click', function () {

        $(this).addClass('active btn-success');

        var radio = $(this).data('state');
        var parent = $(this).parent('.btn-group');

        $('.radiostate_inactive', parent).attr('checked', false);
        $(".radio_inactive", parent).removeClass('active btn-danger');
        $('#' + radio, parent).attr('checked', true);

    });

    $(".radio_inactive").on('click', function () {

        $(this).addClass('active btn-danger');

        var radio = $(this).data('state');
        var parent = $(this).parent('.btn-group');

        $('.radiostate_active', parent).attr('checked', false);
        $(".radio_active", parent).removeClass('active btn-success');
        $('#' + radio, parent).attr('checked', true);
    });


    /* ------------------------------------------------
    Bootstrap dropdownmenu as selectfield
    ------------------------------------------------ */
    $('#sliderstyle_type').on("change", function () {

        var listvalue = $(this).val();

        $('.ss_box').hide();
        $('#' + listvalue).show('blind');

    });


    /* ------------------------------------------------
    Dragable Items
    ------------------------------------------------ */
    $("#wpa_loop-nebraska_team_member").sortable({
        placeholder: "member_highlight",
        cursor: 'pointer'
    });


    //check which error handling should be display or not when loading the page
    $(".required").each(function () {
        if ($(this).prop('checked')) {
            $(this).next('.error_handling').show();
        } else {
            $(this).next('.error_handling').hide();
        }
    });


    $(".select_form_type").each(function () {

        var chosen_fieldtype;
        chosen_fieldtype = $(this).val();

        if (chosen_fieldtype == "radio" || chosen_fieldtype == "select" || chosen_fieldtype == "checkbox") {
            $(this).next('.field_custom_values').show();
        } else {
            $(this).next('.field_custom_values').hide();
        }

    });

    // Post Format Settings
    $('.postf_box').hide();
    $.each($("input[name='post_format']:checked"), function () {
        $('#lambda-post-format-' + $(this).val()).show();
    });

    // hide all portfolio types and show the select one
    $('.p_box').hide();
    $("#portfolio_type option:selected").each(function () {
        $('#' + $(this).val()).show();
    });

    // Template Arrays
    var current_template;
    current_template = $("#page_template").val();

    //Display with Template connected MetaBoxes
    var archived = {
        ".lambdaeditor": "allow",
        ".pagetool": "deny",
        ".portfolio-settings": "deny",
        ".portfolio-items": "allow",
        ".contact-settings": "deny",
        ".team-settings": 'deny',
        ".faq-settings": "deny",
        ".home-settings": "deny",
        ".testimonials-settings": "deny",
        ".verticaltabs-settings": "deny",
        ".infiniteblog": "deny",
        ".client-settings": "deny"
    }

    var pagetools = {
        ".lambdaeditor": "deny",
        ".pagetool": "allow",
        ".portfolio-settings": "deny",
        ".portfolio-items": "deny",
        ".contact-settings": "deny",
        ".team-settings": 'deny',
        ".faq-settings": "deny",
        ".home-settings": "deny",
        ".testimonials-settings": "deny",
        ".verticaltabs-settings": "deny",
        ".infiniteblog": "deny",
        ".client-settings": "deny"
    }

    var contactform = {
        ".lambdaeditor": "allow",
        ".pagetool": "deny",
        ".portfolio-settings": "deny",
        ".portfolio-items": "deny",
        ".contact-settings": "allow",
        ".team-settings": 'deny',
        ".faq-settings": "deny",
        ".home-settings": "deny",
        ".testimonials-settings": "deny",
        ".verticaltabs-settings": "deny",
        ".infiniteblog": "deny",
        ".client-settings": "deny"
    }

    var faq = {
        ".lambdaeditor": "allow",
        ".pagetool": "deny",
        ".portfolio-settings": "deny",
        ".portfolio-items": "deny",
        ".contact-settings": "deny",
        ".team-settings": 'deny',
        ".faq-settings": "allow",
        ".home-settings": "deny",
        ".testimonials-settings": "deny",
        ".verticaltabs-settings": "deny",
        ".infiniteblog": "deny",
        ".client-settings": "deny"
    }

    var homepage = {
        ".lambdaeditor": "deny",
        ".pagetool": "deny",
        ".portfolio-settings": "deny",
        ".portfolio-items": "deny",
        ".contact-settings": "deny",
        ".team-settings": 'deny',
        ".faq-settings": "deny",
        ".home-settings": "allow",
        ".testimonials-settings": "deny",
        ".verticaltabs-settings": "deny",
        ".infiniteblog": "deny",
        ".client-settings": "deny"
    }

    var portfolio = {
        ".lambdaeditor": "allow",
        ".pagetool": "deny",
        ".portfolio-settings": "allow",
        ".portfolio-items": "deny",
        ".contact-settings": "deny",
        ".team-settings": 'deny',
        ".faq-settings": "deny",
        ".home-settings": "deny",
        ".testimonials-settings": "deny",
        ".verticaltabs-settings": "deny",
        ".infiniteblog": "deny",
        ".client-settings": "deny"
    }


    var team = {
        ".lambdaeditor": "allow",
        ".pagetool": "deny",
        ".portfolio-settings": "deny",
        ".portfolio-items": "deny",
        ".contact-settings": "deny",
        ".team-settings": 'allow',
        ".faq-settings": "deny",
        ".home-settings": "deny",
        ".testimonials-settings": "deny",
        ".verticaltabs-settings": "deny",
        ".infiniteblog": "deny",
        ".client-settings": "deny"
    }


    var testimonials = {
        ".lambdaeditor": "allow",
        ".pagetool": "deny",
        ".portfolio-settings": "deny",
        ".portfolio-items": "deny",
        ".contact-settings": "deny",
        ".team-settings": 'deny',
        ".faq-settings": "deny",
        ".home-settings": "deny",
        ".testimonials-settings": "allow",
        ".verticaltabs-settings": "deny",
        ".infiniteblog": "deny",
        ".client-settings": "deny"
    }

    var verticaltabs = {
        ".lambdaeditor": "allow",
        ".pagetool": "deny",
        ".portfolio-settings": "deny",
        ".portfolio-items": "deny",
        ".contact-settings": "deny",
        ".team-settings": 'deny',
        ".faq-settings": "deny",
        ".home-settings": "deny",
        ".testimonials-settings": "deny",
        ".verticaltabs-settings": "allow",
        ".infiniteblog": "deny",
        ".client-settings": "deny"
    }

    var clients = {
        ".lambdaeditor": "allow",
        ".pagetool": "deny",
        ".portfolio-settings": "deny",
        ".portfolio-items": "deny",
        ".contact-settings": "deny",
        ".team-settings": 'deny',
        ".faq-settings": "deny",
        ".home-settings": "deny",
        ".testimonials-settings": "deny",
        ".verticaltabs-settings": "deny",
        ".infiniteblog": "deny",
        ".client-settings": "allow"
    }

    var infiniteblog = {
        ".lambdaeditor": "allow",
        ".pagetool": "deny",
        ".portfolio-settings": "deny",
        ".portfolio-items": "deny",
        ".contact-settings": "deny",
        ".team-settings": 'deny',
        ".faq-settings": "deny",
        ".home-settings": "deny",
        ".testimonials-settings": "deny",
        ".verticaltabs-settings": "deny",
        ".client-settings": "deny",
        ".infiniteblog-settings": "allow"
    }


    switch (current_template) {

        //default
        case "default":
            var showmetaboxes = archived;
            break;

        //page creator
        case "template-pagecreator.php":
            var showmetaboxes = pagetools;
            break;

        //Archive
        case "template-archiv.php":
            var showmetaboxes = archived;
            break;

        //Contact Form
        case "dynamic-contact-form.php":
            var showmetaboxes = contactform;
            break;

        //FAQ
        case "template-faq.php":
            var showmetaboxes = faq;
            break;

        //Home
        case "template-home.php":
            var showmetaboxes = homepage;
            break;

        //Portfolio
        case "portfolio.php":
            var showmetaboxes = portfolio;
            break;

        //Team
        case "template-team.php":
            var showmetaboxes = team;
            break;

        //Testimonials
        case "template-testimonials.php":
            var showmetaboxes = testimonials;
            break;

        //Verticaltabs
        case "template-service.php":
            var showmetaboxes = verticaltabs;
            break;

        //clients
        case "template-clients.php":
            var showmetaboxes = clients;
            break;

        //infinite blog
        case "template-home-infinite.php":
            var showmetaboxes = infiniteblog;
            break;

        default:
            showmetaboxes = archived;

    }

    if (current_template == 'template-pagecreator.php') {
        $('#postdivrich').hide();
        $('#pagetool-wrap').addClass('active');
    }

    //set layers and deactivation classes on page load depending on choosen template
    for (var elem in showmetaboxes) {
        if (showmetaboxes[elem] == 'deny') {

            //hide menu point
            $(elem + "_menu").hide();

        } else {

            //show menu point
            $(elem + "_menu").show();

        }
    }

    /* ------------------------------------------------
    LIVE FUNCTIONS
    ------------------------------------------------ */
    // Display or hide Meta Options depending on the chosen template
    $("#page_template").change(function () {

        var chosen_template;
        chosen_template = $("#page_template").val();

        switch (chosen_template) {

            //default
            case "default":
                var showmetaboxes = archived;
                break;

            //page creator
            case "template-pagecreator.php":
                var showmetaboxes = pagetools;
                break;

            //Archive
            case "template-archiv.php":
                var showmetaboxes = archived;
                break;

            //Contact Form
            case "dynamic-contact-form.php":
                var showmetaboxes = contactform;
                break;

            //FAQ
            case "template-faq.php":
                var showmetaboxes = faq;
                break;

            //Home
            case "template-home.php":
                var showmetaboxes = homepage;
                break;

            //Portfolio
            case "portfolio.php":
                var showmetaboxes = portfolio;
                break;

            //Team
            case "template-team.php":
                var showmetaboxes = team;
                break;

            //Testimonials
            case "template-testimonials.php":
                var showmetaboxes = testimonials;
                break;

            //Verticaltabs
            case "template-service.php":
                var showmetaboxes = verticaltabs;
                break;

            //clients
            case "template-clients.php":
                var showmetaboxes = clients;
                break;

            //infinite blog
            case "template-home-infinite.php":
                var showmetaboxes = infiniteblog;
                break;

            default:
                showmetaboxes = archived;
        }

        if (chosen_template == 'template-pagecreator.php') {

            $('#postdivrich').hide();
            $('#pagetool-wrap').addClass('active');

        } else {

            $('#postdivrich').show();
            $('#pagetool-wrap').removeClass('active');
        }


        for (var elem in showmetaboxes) {
            if (showmetaboxes[elem] == 'deny') {

                //show overlay
                $(elem).find('.lambda_overlay').show();

                //hide menu point
                $(elem + "_menu").hide();

                //hide box
                $(elem).removeClass('active');


            }
            if (showmetaboxes[elem] == 'allow') {

                //hide overlay
                $(elem).find('.lambda_overlay').hide();

                //show menu point
                $(elem + "_menu").show();


            }
        }
    });


    $(".select_toggle_type").change(function () {

        var type = $(this).val();
        $(".s-toggle").hide();
        $(".select_toggle_" + type).show()

    });

    $(".select_testimonial_type").change(function () {

        var type = $(this).val();
        $(".t-toggle").hide();
        $(".testimonial_type_" + type).show()

    });

    $(".select_client_type").change(function () {

        var type = $(this).val();
        $(".c-toggle").hide();
        $(".client_type_" + type).show()

    });

    $(".openpc, .closepc").hide();


    if (($(window).width() <= "1440")) {
        $(".openpc, .closepc").show();
    }


    //page creator on lower screen resolutions
    $(".openpc").on('click', function () {

        $("#pagetool-wrap").removeClass('overflowx');

    });
    $(".closepc").on('click', function () {

        $("#pagetool-wrap").addClass('overflowx');

    });


    //show / hide WP Editor
    $(".options_tabs li a").on('click', function () {
        var postdiv = $(this).attr('href');

        if (postdiv == '#lambdaeditor') {
            $("#postdivrich").show();
        } else {
            $("#postdivrich").hide();
        }

    });


    //display or hide form field details
    $(".form_item_name").on('click', function () {
        $(this).next('.form_item').toggle();
    });

    //display or hide slide field details
    $(".slide_item_name").on('click', function () {
        $(this).next('.slide_item').toggle();
    });

    //display or hide work field details
    $(".work_item_name").on('click', function () {
        $(this).next('.work_item').toggle();
    });

    //display or hide faq field details
    $(".faq_item_name").on('click', function () {
        $(this).next('.faq_item').toggle();
    });

    //display or hide testimonial field details
    $(".testimonial_item_name").on('click', function () {
        $(this).next('.testimonial_item').toggle();
    });

    //display or hide member field details
    $(".member_item_name").on('click', function () {
        $(this).next('.member_item').toggle();
    });

    //display or hide error handling on form fields
    $(".required").on('click', function () {
        if ($(this).prop('checked')) {
            $(this).next('.error_handling').show('blind');
        } else {
            $(this).next('.error_handling').hide('blind');
        }
    });

    //display or hide values form field
    $(".select_form_type").on('change', function () {
        var chosen_fieldtype;
        chosen_fieldtype = $(this).val();

        if (chosen_fieldtype == "radio" || chosen_fieldtype == "select" || chosen_fieldtype == "checkbox") {
            $(this).next('.field_custom_values').show();
        } else {
            $(this).next('.field_custom_values').hide();
        }
    });

    $("#portfolio_type").change(function () {
        $('.p_box').hide();
        $('#' + $(this).val()).show('blind');
    });

    $("#bgstyle_type").change(function () {
        $('.s_box').hide();
        $('#' + $(this).val()).show('blind');
    });

    $("#sbgstyle_type").change(function () {
        $('.sbg_box').hide();
        $('#' + $(this).val()).show('blind');
    });


    $("input[name='post_format']").change(function () {
        $('.postf_box').hide();
        $('#lambda-post-format-' + $(this).val()).show();
    });


});


/*! Copyright 2011, Ben Lin (http://dreamerslab.com/)
* Licensed under the MIT License (LICENSE.txt).
*
* Version: 1.0.6
*
* Requires: jQuery 1.2.3 ~ 1.7.1
*/
;(function ($) {
    $.fn.extend({
        actual: function (method, options) {
            var $hidden, $target, configs, css, tmp, actual, fix, restore;

            // check if the jQuery method exist
            if (!this[method]) {
                throw '$.actual => The jQuery method "' + method + '" you called does not exist';
            }

            configs = $.extend({
                absolute: false,
                clone: false,
                includeMargin: undefined
            }, options);

            $target = this;

            if (configs.clone === true) {
                fix = function () {
                    // this is useful with css3pie
                    $target = $target.filter(':first').clone().css({
                        position: 'absolute',
                        top: -1000
                    }).appendTo('body');
                };

                restore = function () {
                    // remove DOM element after getting the width
                    $target.remove();
                };
            } else {
                fix = function () {
                    // get all hidden parents
                    $hidden = $target.parents().andSelf().filter(':hidden');

                    css = configs.absolute === true ?
                        {position: 'absolute', visibility: 'hidden', display: 'block'} :
                        {visibility: 'hidden', display: 'block'};

                    tmp = [];

                    // save the origin style props
                    // set the hidden el css to be got the actual value later
                    $hidden.each(function () {
                        var _tmp = {}, name;
                        for (name in css) {
                            // save current style
                            _tmp[name] = this.style[name];
                            // set current style to proper css style
                            this.style[name] = css[name];
                        }
                        tmp.push(_tmp);
                    });
                };

                restore = function () {
                    // restore origin style values
                    $hidden.each(function (i) {
                        var _tmp = tmp[i], name;
                        for (name in css) {
                            this.style[name] = _tmp[name];
                        }
                    });
                };
            }

            fix();
            // get the actual value with user specific methed
            // it can be 'width', 'height', 'outerWidth', 'innerWidth'... etc
            // configs.includeMargin only works for 'outerWidth' and 'outerHeight'
            actual = /(outer)/g.test(method) ?
                $target[method](configs.includeMargin) :
                $target[method]();

            restore();
            // IMPORTANT, this plugin only return the value of the first element
            return actual;
        }
    });
})(jQuery);
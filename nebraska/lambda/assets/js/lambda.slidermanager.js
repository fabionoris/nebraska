/* ------------------------------------------------
 *	Lambda Framework 2.0
 *	by unitedthemes.com
 *	Author: Matthias Nettekoven
 * ------------------------------------------------ */

jQuery(document).ready(function ($) {

    $("table tr:nth-child(odd)").addClass("odd-row");
    $("table td:first-child, table th:first-child").addClass("first");
    $("table td:last-child, table th:last-child").addClass("last");

    /* ------------------------------------------------
    Radio Buttons
    ------------------------------------------------ */
    $(".radio_active").click(function () {
        var radio = $(this).attr('value');
        var parent = $(this).parent('.btn-group');

        $('.radiostate_inactive', parent).attr('checked', false);
        $('#' + radio).attr('checked', true);

    });

    $(".radio_inactive").click(function () {
        var radio = $(this).attr('value');
        var parent = $(this).parent('.btn-group');

        $('.radiostate_active', parent).attr('checked', false);
        $('#' + radio).attr('checked', true);
    });


    //delete item on click with help of dialog
    $(".lambda_delete_slide").on('click', function () {

        var delitem = $(this).attr('title');
        $('#' + delitem).remove();

        return false;
    });


    //create sortable list and portlets
    $("#single-items").sortable();

    //toggle all items first
    $(".slider-content").toggle();

    //add necessary classes
    $(".slider_item").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
        .find(".slider-header")
        .addClass("ui-widget-header ui-corner-all")
        .prepend("<span class='left btn btn-mini btn-success drop-icon'><i class='icon-chevron-down icon-white'></i></span>")
        .end()
        .find(".slider-content");

    //add toggle click function with effect
    $(".slider-header .drop-icon").on('click', function () {
        $(this).find("i").toggleClass("icon-chevron-up").toggleClass("icon-chevron-down");
        $(this).parents(".slider_item:first").find(".slider-content").toggle('blind');
    });

    //hide all elements on page load
    $(".slider-content").each(function () {
        $(this).hide();
    });

});
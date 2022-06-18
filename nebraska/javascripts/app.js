(function ($) {
    $(document).ready(function () {

        /* Superfish
        ================================================== */
        $(function () { // Run after page loads
            $('#navigation ul.menu')
                .find('li.current_page_item,li.current_page_parent,li.current_page_ancestor,li.current-cat,li.current-cat-parent,li.current-menu-item')
                .addClass('active')
                .end()
                .superfish({autoArrows: true});
        });
        $(".flex-direction-nav").click(function (event) {
            event.stopPropagation();
        });

        /* FitVid
        ================================================== */
        $(".lambda-video, .entry-content, .lambda_widget_video, .thumb").fitVids();

        /* Service Column Hover
        ================================================== */
        $(".service-box").hover(
            function () {
                $(this).css('background-color', $(this).data('hovercolor'));
            },
            function () {
                $(this).css('background-color', $(this).data('bgcolor'));
            }
        );
        $(".service-box").hover(
            function () {
                $(this).find('a').css('color', $(this).find('a').data('texthovercolor'));
                $(this).find('h3').css('color', $(this).find('a').data('texthovercolor'));
            },
            function () {
                $(this).find('a').css('color', $(this).find('a').data('textcolor'));
                $(this).find('h3').css('color', $(this).find('a').data('textcolor'));
            }
        );

        /* Header Search Form Animation
        ================================================== */
        $('.searchlens').toggle(
            function () {
                $('#header-searchform input[type=text]').stop().animate({width: '150px'});
            },
            function () {
                $('#header-searchform input[type=text]').stop().animate({width: '0px'});
            });

        /* Last Child
        ================================================== */
        $('ul.archive li:last-child').addClass('last');
        $('.widget-container ul li:last-child').addClass('last');
        $('.faq .list:last-child').addClass('last');
        $('#footer li:last-child').addClass('last');

        /* Image Hover
        ================================================== */
        $("body").on("mouseenter", ".imagepost, #portfolioItems > li > .thumb, .gallery-item", function () {
            $(this).find('.hover-overlay').fadeIn(600);
        }).on("mouseleave", ".imagepost, #portfolioItems > li > .thumb, .gallery-item", function () {
            $(this).find('.hover-overlay').stop().fadeOut(50);
        })

        //Youtube WMode
        $('iframe').each(function () {
            var url = $(this).attr("src");
            if (url != undefined) {
                var youtube = url.search("youtube");
                splitable = url.split("?");
                if (youtube > 0 && splitable[1]) {
                    $(this).attr("src", url + "&wmode=transparent")
                }
                if (youtube > 0 && !splitable[1]) {
                    $(this).attr("src", url + "?wmode=transparent")
                }
            }
        });

        // Mobile Menu
        $(function () { // Run after page loads
            // Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
            $(".mm-trigger").click(function () {
                $(this).toggleClass("active").next().slideToggle(500);
                return false; // Prevent the browser jump to the link anchor
            });
        });
        $(window).smartresize(function () {
            if (($(window).width() > 959)) {
                $("#mobile-menu").hide();
            }
        });

        // Toggle Slides
        $(function () { // Run after page loads
            var togglestate = '';
            $(".toggle_container").each(function () {
                togglestate = '';
                togglestate = $(this).data('state');
                if (togglestate != "open")
                    $(this).hide();
            });
            // Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
            $("p.trigger, h3.trigger").click(function () {
                $(this).toggleClass("active").next().slideToggle(500);
                return false; //Prevent the browser jump to the link anchor
            });
        });

        // Valid XHTML method of target_blank
        $(function () { // run after page loads
            $('a[rel*=external]').click(function () {
                window.open(this.href);
                return false;
            });
        });

        /* Tabs Activation
        ================================================== */
        var tabs = $('ul.tabs');
        tabs.each(function (i) {
            // Get all tabs
            var tab = $(this).find('> li > a');
            $("ul.tabs li:first").addClass("active").fadeIn('fast'); //Activate first tab
            $("ul.tabs li:first a").addClass("active").fadeIn('fast'); //Activate first tab
            $("ul.tabs-content li:first").addClass("active").fadeIn('fast'); //Activate first tab
            var contentLocation = window.location.href.slice(window.location.href.indexOf('?') + 1).split('#');
            var contentLocator = "#" + contentLocation[1] + "Tab"
            if (contentLocation[1]) {
                tab.each(function (i) {
                    $("ul.tabs li").removeClass('active');
                    if ($(this).attr('href') + "Tab" == contentLocator)
                        $(this).parent().addClass('active');
                    // Show Tab Content & add active class
                    $(contentLocator).show().addClass('active').siblings().hide().removeClass('active');
                });
            }
            tab.click(function (e) {
                // Get Location of tab's content
                var contentLocation = $(this).attr('href') + "Tab";
                // Let go if not a hashed one
                if (contentLocation.charAt(0) == "#") {
                    e.preventDefault();
                    // Make Tab Active
                    tab.removeClass('active');
                    $(this).addClass('active');
                    // Show Tab Content & add active class
                    $(contentLocation).show().addClass('active').siblings().hide().removeClass('active');
                }
            });
        });

        /* Scroll to top
        ================================================== */
        $(window).scroll(function () {
            if ($(this).scrollTop() != 0) {
                $('#toTop').fadeIn();
            } else {
                $('#toTop').fadeOut();
            }
        });
        $('#toTop').click(function () {
            $('body,html').animate({scrollTop: 0}, 1000);
        });

        /* IE Fallback
        ================================================== */
        $('#clients li:last-child').css('margin-right', '0px');
    });
})(jQuery);
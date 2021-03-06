/* global screenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

(function ($) {
    var body, masthead, menuToggle, siteNavigation, resizeTimer, windowWidth = 1170;

    function initMainNavigation(container) {

        // Add dropdown toggle that displays child menu items.
        var dropdownToggle = $('<button />', {
            'class': 'dropdown-toggle',
            'aria-expanded': false
        }).append($('<span />', {
            'class': 'screen-reader-text',
            text: screenReaderText.expand
        }));

        container.find('.menu-item-has-children > a').after(dropdownToggle);

        // Toggle buttons and submenu items with active children menu items.
        container.find('.current-menu-ancestor > button').addClass('toggled');
        container.find('.current-menu-ancestor > .sub-menu').addClass('toggled');

        // Add menu items with submenus to aria-haspopup="true".
        container.find('.menu-item-has-children').attr('aria-haspopup', 'true');

        container.find('.dropdown-toggle').click(function (e) {
            var _this = $(this),
                screenReaderSpan = _this.find('.screen-reader-text');

            e.preventDefault();
            _this.toggleClass('toggled');
            _this.next('.children, .sub-menu').toggleClass('toggled');

            // jscs:disable
            _this.attr('aria-expanded', _this.attr('aria-expanded') === 'false' ? 'true' : 'false');
            // jscs:enable
            screenReaderSpan.text(screenReaderSpan.text() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand);
        });
    }

    initMainNavigation($('.main-navigation'));

    masthead = $('#masthead');
    menuToggle = masthead.find('#menu-toggle');
    siteNavigation = masthead.find('#site-navigation');

    // Enable menuToggle.
    (function () {

        // Return early if menuToggle is missing.
        if (!menuToggle.length) {
            return;
        }

        // Add an initial values for the attribute.
        menuToggle.add(siteNavigation).attr('aria-expanded', 'false');

        menuToggle.on('click.ndotone', function () {
            $( this ).add( siteNavigation ).toggleClass( 'toggled' );

            // jscs:disable
            $(this).add(siteNavigation).attr('aria-expanded', $(this).add(siteNavigation).attr('aria-expanded') === 'false' ? 'true' : 'false');
            // jscs:enable
        });
    })();

    // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
    (function () {
        if (!siteNavigation.length || !siteNavigation.children().length) {
            return;
        }

        // Toggle `focus` class to allow submenu access on tablets.
        function toggleFocusClassTouchScreen() {
            if (window.innerWidth >= windowWidth) {
                $(document.body).on('touchstart.ndotone', function (e) {
                    if (!$(e.target).closest('.main-navigation li').length) {
                        $('.main-navigation li').removeClass('focus');
                    }
                });
                siteNavigation.find('.menu-item-has-children > a').on('touchstart.ndotone', function (e) {
                    var el = $(this).parent('li');

                    if (!el.hasClass('focus')) {
                        e.preventDefault();
                        el.toggleClass('focus');
                        el.siblings('.focus').removeClass('focus');
                    }
                });
            } else {
                siteNavigation.find('.menu-item-has-children > a').unbind('touchstart.ndotone');
            }
        }

        if ('ontouchstart' in window) {
            $(window).on('resize.ndotone', toggleFocusClassTouchScreen);
            toggleFocusClassTouchScreen();
        }

        siteNavigation.find('a').on('focus.ndotone blur.ndotone', function () {
            $(this).parents('.menu-item').toggleClass('focus');
        });
    })();

    // Add the default ARIA attributes for the menu toggle and the navigations.
    function onResizeARIA() {
        if (window.innerWidth < windowWidth) {
            if (menuToggle.hasClass('toggled')) {
                menuToggle.attr('aria-expanded', 'true');
            } else {
                menuToggle.attr('aria-expanded', 'false');
            }

            if (siteNavigation.hasClass('toggled')) {
                siteNavigation.attr('aria-expanded', 'true');
            } else {
                siteNavigation.attr('aria-expanded', 'false');
            }

            menuToggle.attr('aria-controls', 'site-navigation social-navigation');
        } else {
            menuToggle.removeAttr('aria-expanded');
            siteNavigation.removeAttr('aria-expanded');
            menuToggle.removeAttr('aria-controls');
            if (siteNavigation.hasClass('toggled')) {
                $(this).add(siteNavigation).removeClass('toggled');
                $(this).add(menuToggle).removeClass('toggled');
            }
        }
    }

    // Add 'below-entry-meta' class to elements.
    function belowEntryMetaClass(param) {
        if (body.hasClass('page') || body.hasClass('search') || body.hasClass('single-attachment') || body.hasClass('error404')) {
            return;
        }

        $('.entry-content').find(param).each(function () {
            var element = $(this),
                elementPos = element.offset(),
                elementPosTop = elementPos.top,
                entryFooter = element.closest('article').find('.entry-footer'),
                entryFooterPos = entryFooter.offset(),
                entryFooterPosBottom = entryFooterPos.top + ( entryFooter.height() + 28 ),
                caption = element.closest('figure'),
                newImg;

            // Add 'below-entry-meta' to elements below the entry meta.
            if (elementPosTop > entryFooterPosBottom) {

                // Check if full-size images and captions are larger than or equal to 840px.
                if ('img.size-full' === param) {

                    // Create an image to find native image width of resized images (i.e. max-width: 100%).
                    newImg = new Image();
                    newImg.src = element.attr('src');

                    $(newImg).load(function () {
                        if (newImg.width >= 840) {
                            element.addClass('below-entry-meta');

                            if (caption.hasClass('wp-caption')) {
                                caption.addClass('below-entry-meta');
                                caption.removeAttr('style');
                            }
                        }
                    });
                } else {
                    element.addClass('below-entry-meta');
                }
            } else {
                element.removeClass('below-entry-meta');
                caption.removeClass('below-entry-meta');
            }
        });
    }

    /**
     * Make sure content isn't too high
     */

    function adjustPosts() {
        $('.hfeed .post-content').each( function() {
            var $contain = $(this),
                $innerContainHeight = 210,
                $header = $('.entry-header', this),
                $headerHeight = $header.innerHeight(),
                $content = $('.entry-content', this),
                $contentHeight = $content.innerHeight(),
                $wholeContentHeight = $headerHeight + $contentHeight;

            if ( $innerContainHeight < $wholeContentHeight && (window.innerWidth >= 900)) {
                $contain.parent().addClass('overflow');
            } else {
                $contain.parent().removeClass('overflow');
            }
        } );
    }

    $(document).ready(function () {
        body = $(document.body);

        $(window)
            .on('load.ndotone', function() {
                onResizeARIA();
                adjustPosts();
            })
            .on('resize.ndotone', function () {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function () {
                    belowEntryMetaClass('img.size-full');
                    belowEntryMetaClass('blockquote.alignleft, blockquote.alignright');
                }, 300);
                onResizeARIA();
                adjustPosts();
            });

        belowEntryMetaClass('img.size-full');
        belowEntryMetaClass('blockquote.alignleft, blockquote.alignright');

    });

})(jQuery);

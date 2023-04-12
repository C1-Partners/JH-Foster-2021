// 1.0.16
(function ($) {

    $.fn.objectVisualLock = function(offset, autoOn) {

        offset = typeof offset !== 'undefined' ? offset : 0;
        var object = $(this);

        autoOn = typeof autoOn !== 'undefined' ? autoOn : false;

        if(object.length) {

            var controlPageObject = '<!-- Object Visual Lock -->' +
                '<script src="https://use.fontawesome.com/b47b7f257b.js"></script>' +
                '<div class="lock-window-object" style="position: fixed; top: 10px; right: 10px; height: 40px; width: 60px; z-index: 100000000; background: white; line-height: 21px;">' +
                '<div style="width: 40px; height: 40px; float: left;">' +
                '<div class="lock-window-set-to-top-left lock-window-position-button" style="height: 20px; width: 20px; text-align: center; background: grey; border: 1px solid black; float: left; cursor: pointer; text-align: center; padding-top: 0px; font-size: 12px; color: black;">' +
                '<i style="transform: rotate(-45deg);" class="fa fa-arrow-up" aria-hidden="true"></i>' +
                '</div>' +
                '<div class="lock-window-set-to-top-right lock-window-position-button" style="height: 20px; width: 20px; text-align: center; background: grey; border: 1px solid black; float: left; cursor: pointer; text-align: center; padding-top: 0px; font-size: 12px; color: yellow;">' +
                '<i style="transform: rotate(45deg);" class="fa fa-arrow-up" aria-hidden="true"></i>' +
                '</div>' +
                '<div class="lock-window-set-to-bottom-left lock-window-position-button" style="height: 20px; width: 20px; text-align: center; background: grey; border: 1px solid black; float: left; cursor: pointer; text-align: center; padding-top: 0px; font-size: 12px; color: black;">' +
                '<i style="transform: rotate(45deg);" class="fa fa-arrow-down" aria-hidden="true"></i>' +
                '</div>' +
                '<div class="lock-window-set-to-bottom-right lock-window-position-button" style="height: 20px; width: 20px; text-align: center; background: grey; border: 1px solid black; float: left; cursor: pointer; text-align: center; padding-top: 0px; font-size: 12px; color: black;">' +
                '<i style="transform: rotate(-45deg);" class="fa fa-arrow-down" aria-hidden="true"></i>' +
                '</div>' +
                '</div>' +
                '<div class="lock-window-on-off" style="height: 40px; width: 20px; float: left; text-align: center; background: grey; border: 1px solid black; float: left; cursor: pointer; text-align: center; padding-top: 10px; font-size: 12px; color: black;">' +
                '<i class="fa fa-power-off" aria-hidden="true"></i>' +
                '</div>' +
                '</div>';

            $('body').append(controlPageObject);

            var lockWindowObject = $('.lock-window-object'),
                lockWindowOnOff = $('.lock-window-object .lock-window-on-off'),
                lockWindowToTopLeft = $('.lock-window-object .lock-window-set-to-top-left'),
                lockWindowToTopRight = $('.lock-window-object .lock-window-set-to-top-right'),
                lockWindowToBottomLeft = $('.lock-window-object .lock-window-set-to-bottom-left');
            lockWindowToBottomRight = $('.lock-window-object .lock-window-set-to-bottom-right');

            // Set up up and down control buttons and on and off. and then get the scroll lock
            lockWindowOnOff.on('click', function() {
                if(lockWindowObject.hasClass('active')) {
                    lockWindowObject.removeClass('active');
                    $(this).css('color', 'black');
                } else {
                    lockWindowObject.addClass('active');
                    $(this).css('color', 'lime');

                    $('html, body').animate({
                        scrollTop: object.offset().top - offset
                    }, 500);
                }
            });

            lockWindowToTopLeft.on('click', function() {
                lockWindowObject.css({ 'top': '10px', 'bottom': 'auto', 'left': '10px', 'right': 'auto' });
                $('.lock-window-position-button').not(lockWindowToTopLeft).css('color', 'black');
                lockWindowToTopLeft.css('color', 'yellow');
            });

            lockWindowToTopRight.on('click', function() {
                lockWindowObject.css({ 'top': '10px', 'bottom': 'auto', 'left': 'auto', 'right': '10px' });
                $('.lock-window-position-button').not(lockWindowToTopRight).css('color', 'black');
                lockWindowToTopRight.css('color', 'yellow');
            });

            lockWindowToBottomLeft.on('click', function() {
                lockWindowObject.css({ 'top': 'auto', 'bottom': '10px', 'left': '10px', 'right': 'auto' });
                $('.lock-window-position-button').not(lockWindowToBottomLeft).css('color', 'black');
                lockWindowToBottomLeft.css('color', 'yellow');
            });

            lockWindowToBottomRight.on('click', function() {
                lockWindowObject.css({ 'top': 'auto', 'bottom': '10px', 'left': 'auto', 'right': '10px' });
                $('.lock-window-position-button').not(lockWindowToBottomRight).css('color', 'black');
                lockWindowToBottomRight.css('color', 'yellow');
            });

            $(window).on('resize', function() {
                if(lockWindowObject.hasClass('active')) {
                    $('html, body').animate({
                        scrollTop: object.offset().top - offset
                    }, 0);
                }
            });

            $(window).on('load', function () {
                if(autoOn) {
                    lockWindowObject.addClass('active');
                    lockWindowOnOff.css('color', 'lime');

                    $('html, body').animate({
                        scrollTop: object.offset().top - offset
                    }, 500);
                }
            });

        } else {

            console.warn('DOM Object not found');

        }

    };

}( jQuery ));
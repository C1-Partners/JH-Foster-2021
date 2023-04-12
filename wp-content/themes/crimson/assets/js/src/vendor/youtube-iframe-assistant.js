// 1.0.10
(function ($) {

    $.fn.scopedYoutubeIframeAssistant = function(options) {

    };

    youtubeIframeAssistant = function(options) {

        var settings = $.extend({
            useBootstrapModal: false,
            startVideoOnModalOpen: true,
            stopVideoOnModalClose: true,
            useIframeClass: false,
            videoTogglesClass: ".video-toggle",
            videoModalsClass: ".video-modal",
            iframeClass: ".iframe-video"
        }, options );

        $('head').append("<style>.embed-container{position:relative;height:0;overflow:hidden;max-width:100%;}.embed-container iframe,.embed-container object,.embed-container embed{position:absolute;top:0;left:0;width:100%;height:100%;}</style>");

        // Get all video iframe objects
        var allVideos = (settings.useIframeClass) ? $('iframe' + settings.iframeClass) : $('iframe');

        if(!allVideos.length) return;

        // Check if utilizing Bootstrap modals as popups
        if(settings.useBootstrapModal) {

            // Stops the video when the modal closes
            if(settings.stopVideoOnModalClose && $('.modal' + settings.videoModalsClass).length) {
                $('.modal' + settings.videoModalsClass).on('hidden.bs.modal', function () {
                    var iframes = $(this).find('iframe'),
                        iframe = iframes[0];

                    stopIframe(iframe);
                });
            }

            // Starts the video when the modal opens
            if(settings.startVideoOnModalOpen && $(settings.videoTogglesClass).length) {
                $(settings.videoTogglesClass).on('click', function () {
                    var target = $(this).data('target');
                    var iframes = $(target).find('iframe'),
                        iframe = iframes[0];

                    startIframe(iframe);
                });
            }

        }

        allVideos.each(function () {
            var video = $(this),
                videoParent = $(this).parent(),
                src = video.attr('src'),
                aspectRatio = video.actual('height') / video.actual('width');

            if(!videoParent.is('figure')) {
                video.wrap('<figure class="embed-container"></figure>');
            } else {
                if(!videoParent.hasClass('embed-container')) videoParent.addClass('embed-container');
            }

            // Failsafe for attaching the autoplay attribute later on. If there isn't already a variable the video will break.
            if(src.indexOf("?") < 0) video.attr('src', src + '?rel=0');

            // video.attr('data-aspect-ratio', aspectRatio);
            video.parent('figure').css('padding-bottom', (aspectRatio * 100) + '%');
            video.removeAttr('height').removeAttr('width');
        });

    };

    function startIframe(iframe) {
        iframe.src += "&autoplay=1";
    }

    function stopIframe(iframe) {
        var newSrc = iframe.src;
        newSrc = newSrc.replace('&autoplay=1', '');
        iframe.src = newSrc;
    }

}( jQuery ));
export function initFancybox(element) {
    if (element.attr('data-fancybox') === undefined) {
        let settings = element.attr('data-fancybox-settings') ? JSON.parse(element.attr('data-fancybox-settings')) : {};

        settings.afterLoad = function (instance, current) {
            let individualSettings = $(current.opts.$orig).attr('data-fancybox-settings') ? JSON.parse($(current.opts.$orig).attr('data-fancybox-settings')) : {};

            if (individualSettings['customClass']) {
                current.$content.addClass(individualSettings['customClass']);
            }

            if (settings.loop) {
                if (current.type === 'video') {
                    let video = current.$content.find('video')[0];
                    if (video) {
                        video.addEventListener('timeupdate', function () {
                            if (video.currentTime >= video.duration - 0.2) {
                                video.currentTime = 0;
                                video.play();
                            }
                        });
                    }
                }
            }

            current.$content.find('.fancybox-custom-html').remove();

            if (individualSettings['customHtml']) {
                const wrappedHtml = $('<div class="fancybox-custom-html"></div>').html(settings.customHtml);
                current.$content.append(wrappedHtml);

                document.dispatchEvent(new CustomEvent("growtypeFancyboxShowCustomHtml", {
                    detail: {
                        html: wrappedHtml,
                    },
                }));
            }
        };

        settings.afterShow = function (instance, current) {
            if (settings.muted) {
                if (current.type === 'video') {
                    const videoElement = current.$content.find('video')[0];
                    if (videoElement) {
                        videoElement.muted = true;
                    }
                }
            }
        };

        element.fancybox(settings);
    }
}

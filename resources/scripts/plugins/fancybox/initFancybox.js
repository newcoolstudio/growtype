export function initFancybox(element) {
    if (element.attr('data-fancybox') === undefined) {
        let settings = element.attr('data-fancybox-settings') !== undefined ? JSON.parse(element.attr('data-fancybox-settings')) : {};

        if (settings.loop) {
            settings.afterLoad = function (instance, current) {
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
        }

        if (settings.muted) {
            settings.afterShow = function (instance, current) {
                if (current.type === 'video') {
                    var videoElement = current.$content.find('video')[0];
                    if (videoElement) {
                        videoElement.muted = true;
                    }
                }
            }
        }

        if (settings.group) {
            settings.selector = settings.group;
        }

        element.fancybox(settings);
    }
}

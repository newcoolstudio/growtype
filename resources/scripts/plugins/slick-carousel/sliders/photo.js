function photoSlider() {
    (function ($) {
        $('.photoslider').each(function () {
            let slider_settings = {
                infinite: true,
                slidesToShow: 1,
                centerMode: false,
                slidesToScroll: 1,
                accessibility: false,
                arrows: false
            };

            if ($(this).hasClass('has-buttons')) {
                slider_settings.dots = true;
            }

            if ($(this).hasClass('has-arrows')) {
                slider_settings.arrows = true;
            }

            if ($(this).hasClass('photoslider-automatic')) {
                slider_settings.autoplay = true;
                slider_settings.speed = 1000;
                slider_settings.autoplaySpeed = 2000;
            }

            if ($(this).hasClass('photoslider-logos')) {
                slider_settings.slidesToShow = 5;
                slider_settings.dots = false;
                slider_settings.responsive = [{
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 2,
                    },
                }];
            }

            if ($(this).find('.photoslider-slide').length > 1) {
                $(this).find('.photoslider-inner').slick(slider_settings);
            } else {
                $(this).find('.photoslider-inner').addClass('slick-initialized');
            }
        });
    })(jQuery);
}

export {photoSlider};



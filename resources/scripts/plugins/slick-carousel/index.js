jQuery(document).ready(() => {
    $('.growtype-theme-slider').each(function () {
        let sliderSettings = $(this).attr('data-gslick');

        if (sliderSettings) {
            sliderSettings = JSON.parse(sliderSettings);
            $(this).slick(sliderSettings);
        }
    });
});

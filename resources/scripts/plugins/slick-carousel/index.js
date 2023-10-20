jQuery(document).ready(() => {
    $('.growtype-theme-slider').each(function () {
        let sliderSettings = $(this).attr('data-slick');

        $(this).slick(JSON.parse(sliderSettings));
    });
});

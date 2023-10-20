jQuery(document).ready(() => {
    $('.growtype-theme-fancybox').each(function () {
        if ($(this).attr('data-fancybox') === undefined) {
            let settings = $(this).attr('data-fancybox-settings') !== undefined ? JSON.parse($(this).attr('data-fancybox-settings')) : {};
            $(this).fancybox(settings);
        }
    });
});

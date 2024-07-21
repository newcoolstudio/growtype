function sidebar() {
    $('.g-btn-close-sidebar').click(function () {
        $('body').toggleClass('sidebar-is-open');

        if ($('.sidebar').find('.growtype-theme-slider').length > 0) {
            $('.sidebar').find('.growtype-theme-slider').slick('refresh');
        }
    });
}

export {sidebar};

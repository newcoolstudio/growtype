function sidebar() {
    $('.sidebar .btn-close-sidebar').click(function () {
        $('body').toggleClass('sidebar-is-open');

        if ($(this).closest('.sidebar').find('.growtype-theme-slider').length > 0) {
            $(this).closest('.sidebar').find('.growtype-theme-slider').slick('refresh');
        }
    });
}

export {sidebar};

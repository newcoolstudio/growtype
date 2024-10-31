function sidebar() {
    /**
     * Message returned
     */
    document.addEventListener('growtypeInitSidebar', function (event) {
        initSidebarTrigger(event.detail.trigger);
    });

    function initSidebarTrigger(trigger = $('.g-btn-close-sidebar')) {
        trigger.click(function () {
            $('body').toggleClass('sidebar-is-open');

            if ($('.sidebar').find('.growtype-theme-slider').length > 0) {
                $('.sidebar').find('.growtype-theme-slider').slick('refresh');
            }
        });
    }

    initSidebarTrigger();
}

export {sidebar};

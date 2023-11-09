function sidebar() {
    $('.sidebar .btn-close-sidebar').click(function () {
        $('body').toggleClass('sidebar-is-open');
    });
}

export {sidebar};

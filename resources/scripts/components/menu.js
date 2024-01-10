function menu() {
    /**
     * Menu children show
     */
    $('.main-navigation-mobile.menu-item-parent-disabled .menu-item-has-children:not(.is-active-parent) > a').click(function (e) {
        e.preventDefault();
        if (!$(this).parent().hasClass('is-active')) {
            $('.main-navigation-mobile li').removeClass('is-active');
            $(this).parent().addClass('is-active');
        } else {
            $('.main-navigation-mobile li').removeClass('is-active');
        }
    })
}

export {menu};

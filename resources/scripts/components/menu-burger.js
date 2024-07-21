function menuBurger() {
    let menuWasClicked = false;
    $('.btn-menu-mobile').on('click', function () {
        if (menuWasClicked == false) {
            menuWasClicked = true;
            setTimeout(function () {
                menuWasClicked = false;
            }, 700);
            if ($(this).hasClass('is-pasive')) {
                window.growtypeBurgerOpen()
            } else {
                window.growtypeBurgerClose()
            }
        }
    })

    $('.main-navigation-mobile').on('click', function () {
        window.growtypeBurgerClose();
    });

    $('.main-navigation-mobile .main-navigation-mobile-inner').on('click', function () {
        event.stopPropagation();
    });

    $('.main-navigation-mobile a').on('click', function () {
        if ($(this).text().indexOf("#") === -1 && !$(this).closest('li').hasClass('active') && $(this).closest('.menu-item-parent-disabled').length === 0) {
            window.growtypeBurgerClose();
        }
    });

    window.growtypeBurgerClose = function () {
        $('.btn-menu-mobile').addClass('is-pasive').removeClass('is-active');
        $('body, html').removeClass('burger-open');
        $('body, html').removeClass('stopscroll');
        $('.main-navigation-mobile').removeClass('is-active').addClass('is-pasive').fadeOut();
        $('body').unbind('touchmove');
    }

    window.growtypeBurgerOpen = function () {
        $('.btn-menu-mobile').removeClass('is-pasive').addClass('is-active');
        $('body, html').addClass('stopscroll');
        $('body, html').addClass('burger-open');

        if ($('.main-navigation-mobile').hasClass('main-navigation-mobile-animation-slide-in-left') || $('.main-navigation-mobile').hasClass('main-navigation-mobile-animation-slide-in-right')) {
            $('.main-navigation-mobile').show();

            setTimeout(function () {
                $('.main-navigation-mobile').addClass('is-active').removeClass('is-pasive')
            }, 1)
        } else {
            $('.main-navigation-mobile').addClass('is-active').removeClass('is-pasive').fadeIn();
        }
    }
}

export {menuBurger};

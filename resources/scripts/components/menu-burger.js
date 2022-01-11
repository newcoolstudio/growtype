function menuBurger() {
    let menuWasClicked = false;
    $('.hamburger').on('click', function () {
        // e.preventDefault();
        if (menuWasClicked == false) {
            menuWasClicked = true;
            setTimeout(function () {
                menuWasClicked = false;
            }, 700);
            if ($(this).hasClass('is-pasive')) {
                window.burgerOpen()
            } else {
                window.burgerClose()
            }
        }
    })

    $('.main-navigation-mobile').on('click', function () {
        window.burgerClose();
    });

    $('.main-navigation-mobile .main-navigation-mobile-content').on('click', function () {
        event.stopPropagation();
    });

    window.burgerClose = function () {
        $('.hamburger').addClass('is-pasive').removeClass('is-active');
        $('body', 'html').removeClass('burger-open');
        $('body', 'html').removeClass('stopscroll');
        $('.main-navigation-mobile').removeClass('is-active').addClass('is-pasive').fadeOut();
        $('body').unbind('touchmove');
    }

    window.burgerOpen = function () {
        $('.hamburger').removeClass('is-pasive').addClass('is-active');
        $('body', 'html').addClass('stopscroll');
        $('body', 'html').addClass('burger-open');
        $('.main-navigation-mobile').addClass('is-active').removeClass('is-pasive').fadeIn();
        // $('body').bind('touchmove', function () {
        //     event.preventDefault()
        // });
    }
}

export {menuBurger};

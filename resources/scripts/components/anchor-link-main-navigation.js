function anchorLinkMainNavigation() {
    if ($('.main-navigation').hasClass('main-navigation-anchored')) {
        /**
         * Add active class to menu element
         */
        $('.main-navigation li a[href="/' + window.location.hash + '"]').addClass('is-active')

        $(document).bind('scroll', function (e) {
            $('section').each(function (index, element) {
                if (
                    $(this).offset().top < window.pageYOffset + 170
                    && $(this).offset().top + $(this).height() > window.pageYOffset + 170
                ) {
                    if (typeof $(this).attr('id') !== "undefined") {
                        if (window.scrollSection !== index) {
                            window.history.replaceState(null, null, "/#" + $(this).attr('id'));
                            window.scrollSection = index;
                        }
                        $('.main-navigation li a').removeClass('is-active');
                        $('.main-navigation li a[href="/#' + $(this).attr('id') + '"]').addClass('is-active');
                    } else {
                        if (index === 0) {
                            if (window.scrollSection !== index) {
                                window.history.replaceState(null, null, "/");
                                window.scrollSection = index;
                            }
                            $('.main-navigation li a').removeClass('is-active');
                        }
                    }
                    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                        $('.main-navigation li a').removeClass('is-active');
                        $('.main-navigation li:last-child a').addClass('is-active');
                    }
                }
            });
        });
    }
}

export {anchorLinkMainNavigation};

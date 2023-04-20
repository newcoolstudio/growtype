function headerFixed() {
    let scrollableElements = $('.has-fixed-header .site-header');

    if (scrollableElements.length > 0) {
        scrollableElements.each(function (index, element) {
            let scrollableElement = $(element);
            let clonedScrollableElement = scrollableElement.clone().hide();
            $(clonedScrollableElement).insertAfter(scrollableElement);

            let stickyOffset = scrollableElement.offset().top;

            $(window).on("load", function () {
                if ($(window).scrollTop() > stickyOffset) {
                    scrollableElement.css('opacity', 0);
                    clonedScrollableElement.addClass("is-fixed").show();
                }
            })

            let lastScrollTop = 0;
            $(window).scroll(function () {
                let scroll = $(window).scrollTop();

                if ($('body').hasClass('header-hide-onscroll')) {
                    if (scroll > 100 && scroll > lastScrollTop) {
                        $('.site-header.is-fixed').addClass('hide-onscroll')
                    } else {
                        $('.site-header:visible').removeClass('hide-onscroll')
                    }
                }

                if (scroll > stickyOffset) {
                    scrollableElement.css('opacity', 0);
                    clonedScrollableElement.addClass("is-fixed").show();
                } else {
                    scrollableElement.css('opacity', 1);
                    clonedScrollableElement.removeClass("is-fixed").hide();
                }

                lastScrollTop = scroll;
            });
        });
    }
}

export {headerFixed};

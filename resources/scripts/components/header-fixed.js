function headerFixed() {
    let scrollableElements = $('.has-fixed-header .site-header');
    let clonedScrollableElements = {};

    if (scrollableElements.length > 0) {
        scrollableElements.each(function (index, element) {
            let scrollableElement = $(element);
            let clonedScrollableElement = scrollableElement
                .clone()
                .removeAttr('id')
                .hide();

            $(clonedScrollableElement).insertAfter(scrollableElement);

            clonedScrollableElements[index] = clonedScrollableElement;

            let stickyOffset = scrollableElement.offset().top;

            $(window).on("load", function () {
                if ($(window).scrollTop() > stickyOffset) {
                    scrollableElement.css('opacity', 0);
                    clonedScrollableElement.addClass("is-fixed").fadeIn();
                }
            });

            let showOnScrollWasShowed = true;
            let headerIsFixed = false;
            let lastScrollTop = 0;
            $(window).scroll(function () {
                let scroll = $(window).scrollTop();

                if ($('body').hasClass('header-hide-onscroll')) {
                    if (scroll > 100 && scroll > lastScrollTop) {
                        if (showOnScrollWasShowed) {
                            $('.site-header.is-fixed').removeClass('show-onscroll').addClass('hide-onscroll')
                            showOnScrollWasShowed = false;
                        }
                    } else {
                        if (!showOnScrollWasShowed) {
                            showOnScrollWasShowed = true;
                            $('.site-header.is-fixed').addClass('show-onscroll');
                            setTimeout(function () {
                                $('.site-header.is-fixed').removeClass('show-onscroll')
                            }, 400);

                            $('.site-header:visible').removeClass('hide-onscroll')
                        }
                    }
                }

                if (scroll > stickyOffset) {
                    if (!headerIsFixed) {
                        headerIsFixed = true;
                        scrollableElement.css('opacity', 0);
                        clonedScrollableElement
                            .show()
                            .addClass("is-fixed")
                            .addClass("has-transition");
                        setTimeout(function () {
                            clonedScrollableElement.removeClass('has-transition')
                        }, 400);
                    }
                } else {
                    if (headerIsFixed) {
                        scrollableElement.animate({opacity: 1}, 100)
                        clonedScrollableElement.fadeOut(200).promise().done(function () {
                            $(this).removeClass("is-fixed");
                        });
                        headerIsFixed = false;
                    }
                }

                lastScrollTop = scroll;
            });
        }).promise().done(function () {
            document.dispatchEvent(new CustomEvent("growtypeHeaderFixedLoaded", {
                detail: {
                    scrollableElements: scrollableElements,
                    clonedScrollableElements: clonedScrollableElements,
                },
            }));
        });
    }
}

export {headerFixed};

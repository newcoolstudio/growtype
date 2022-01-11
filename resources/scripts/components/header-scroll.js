function headerScroll() {
    let scrollableElement = $('.has-fixed-header .site-header');

    $(window).on("load", function () {
        if ($(window).scrollTop() !== 0) {
            scrollableElement.addClass("is-scroll");
            scrollableElement.addClass("is-fixed-bg");
        }
    })

    $(window).scroll(function () {
        let scroll = $(window).scrollTop();

        if (scroll >= 50) {
            scrollableElement.addClass("is-scroll");
        } else {
            scrollableElement.removeClass("is-scroll").removeClass("is-fixed-bg");
        }
    });
}

export {headerScroll};

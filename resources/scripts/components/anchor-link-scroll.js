function anchorLinkScroll() {
    $(document).on('click', 'a[href*="#"]', function (event) {
        event.preventDefault();

        let hashIndex = $.attr(this, 'href').indexOf("#");
        let hashAttribute = '#';

        if (hashIndex !== -1) {
            let hash = $.attr(this, 'href').substring(hashIndex + 1);
            hashAttribute = '#' + hash;
        }

        if (hashAttribute !== '#' && typeof $(hashAttribute) !== 'undefined' && typeof $(hashAttribute).offset() !== 'undefined') {

            /**
             * Check if mobile menu
             */
            if ($(this).closest('.main-navigation-mobile').length > 0) {
                window.burgerClose();
            }

            $('html, body').animate({
                scrollTop: $(hashAttribute).offset().top - 100
            }, 500);
        } else {
            window.location.href = $.attr(this, 'href');
        }
    });

    /**
     * Update initial position
     */
    if (window.location.hash) {
        let hash = window.location.hash;
        if (typeof $(hash).offset() !== "undefined") {
            setTimeout(function () {
                let offset = screen.width < 600 ? 80 : 90;
                document.documentElement.scrollTop = $(window.location.hash).offset().top - offset
            }, 100)
        }
    }
}

export {anchorLinkScroll};
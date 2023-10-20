function anchorLinkScroll() {
    $(document).on('click', 'a[href*="#"]', function (event) {
        try {
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
                    scrollTop: ($(hashAttribute).offset().top - 100)
                }, 500);
            } else {
                window.location.href = $.attr(this, 'href');
            }
        } catch (err) {
            window.history.pushState(null, null, $(this).attr('href'));
        }
    });

    /**
     * Update initial position
     */
    if (window.location.hash) {
        try {
            let hash = window.location.hash;
            if ($(decodeURI(hash)).length > 1 && typeof $(hash).offset() !== "undefined") {
                setTimeout(function () {
                    let offset = screen.width < 600 ? 80 : 90;
                    document.documentElement.scrollTop = $(window.location.hash).offset().top - offset
                }, 100)
            }
        } catch (err) {
            console.log(err)
        }
    }
}

export {anchorLinkScroll};

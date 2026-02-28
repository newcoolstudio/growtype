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

            let $target = null;
            if (hashAttribute.length > 1 && !hashAttribute.includes('=') && !hashAttribute.includes(':')) {
                try {
                    $target = $(hashAttribute);
                } catch (e) {
                    $target = null;
                }
            }

            if ($target && $target.length > 0 && typeof $target.offset() !== 'undefined') {
                /**
                 * Check if mobile menu
                 */
                if ($(this).closest('.main-navigation-mobile').length > 0) {
                    window.growtypeBurgerClose();
                }

                $('html, body').animate({
                    scrollTop: ($target.offset().top - 10)
                }, 500);
            } else {
                if (hashAttribute.length > 1 && !hashAttribute.includes('=')) {
                    window.location.href = $.attr(this, 'href');
                }
            }
        } catch (err) {
            try {
                window.history.pushState(null, null, $(this).attr('href'));
            } catch (err) {
                window.location.href = $(this).attr('href');
            }
        }
    });

    /**
     * Update initial position
     */
    if (window.location.hash && window.location.hash !== '#') {
        try {
            let hash = window.location.hash;

            // Skip complex hashes that aren't simple element IDs (e.g., our tab state)
            if (hash.includes('=') || hash.includes(':') || hash.includes('[') || hash.includes('(')) {
                return;
            }

            let $target = $(hash);
            if ($target.length > 0 && typeof $target.offset() !== "undefined") {
                setTimeout(function () {
                    let offset = screen.width < 600 ? 80 : 90;
                    $('html, body').animate({
                        scrollTop: $target.offset().top - offset
                    }, 100);
                }, 100);
            }
        } catch (err) {
            // Ignore errors for invalid selectors
        }
    }
}

export { anchorLinkScroll };

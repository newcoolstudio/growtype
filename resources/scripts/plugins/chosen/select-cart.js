function selectCart() {
    (function($) {
        window.cartSelect = $('.cart select');

        window.selectCartArgs = {
            disable_search_threshold: 20
        };

        if (window.cartSelect.length > 0) {
            window.cartSelect.chosen(window.selectCartArgs);
        }
    })(jQuery);
}

export {selectCart};

function select() {
    (function ($) {
        jQuery(document).ready(function () {
            window.select = jQuery('select');

            window.select.map(function (index, element) {
                window.selectArgs = {
                    disable_search_threshold: 20,
                };

                if (!jQuery(element).is(':visible')) {
                    window.selectArgs.width = '100%';
                }

                jQuery(element).chosen(window.selectArgs);
            });
        })
    })(jQuery);
}

export {select};

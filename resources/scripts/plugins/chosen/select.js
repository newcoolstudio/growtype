function select() {
    (function ($) {
        jQuery(document).ready(function () {
            window.select = jQuery('select');

            window.select.map(function (index, element) {

                let searchThreshold = jQuery(element).attr('data-search-threshold') ? jQuery(element).attr('data-search-threshold') : 20;

                window.selectArgs = {
                    disable_search_threshold: searchThreshold,
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

function select() {
    (function ($) {
        jQuery(document).ready(function () {
            window.select = jQuery('select');

            window.select.map(function (index, element) {
                let params = jQuery(element).attr('data-params') === undefined ? {} : JSON.parse(jQuery(element).attr('data-params'));

                if (params.searchThreshold === undefined) {
                    params.disable_search_threshold = 20;
                }

                if (!jQuery(element).is(':visible')) {
                    params.width = '100%';
                }

                jQuery(element).chosen(params);
            });
        })
    })(jQuery);
}

export {select};

function select() {
    (function ($) {
        window.select = $('select');

        window.select.map(function (index, element) {
            window.selectArgs = {
                disable_search_threshold: 20,
            };

            if (!$(element).is(':visible')) {
                window.selectArgs.width = '100%';
            }

            $(element).chosen(window.selectArgs);
        });
    })(jQuery);
}

export {select};

function price() {
    const filterProductsByPriceEvent = new Event('filterProductsByPrice');
    var price_values = 0;

    $(".price_slider").on("slidestart", function (event, ui) {
        price_values = ui.values;
    });

    $(".price_slider").on("slidestop", function (event, ui) {
        if (JSON.stringify(price_values) == JSON.stringify(ui.values)) {
            return false;
        }

        woocommerce_params_widgets.min_price = ui.values[0];
        woocommerce_params_widgets.max_price = ui.values[1];

        var filter = $('.widget_price_filter form');
        var existing_products = $('body').find('.products');
        var existing_main = $('body').find('#main');

        $.ajax({
            url: filter.attr('action'),
            data: filter.serialize(), // form data
            type: filter.attr('method'), // POST
            beforeSend: function (xhr) {
                existing_products.addClass('is-loading');
            },
            success: function (data) {
                existing_products.removeClass('is-loading');
                var filtered_products = $(data).find('.products');
                var filtered_main = $(data).find('#main');
                window.history.pushState('page-url', 'url', filter.attr('action') + '?' + filter.serialize());
                $('.woocommerce-info').remove();
                if (filtered_products.html().length === 1) {
                    $('#main').prepend($(data).find('.woocommerce-info'));
                }
                existing_main.replaceWith(filtered_main);
                document.dispatchEvent(filterProductsByPriceEvent);
            }
        });
    });

}

export {price};

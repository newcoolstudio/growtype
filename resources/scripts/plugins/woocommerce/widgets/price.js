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
        var filter = $('.widget_price_filter form');
        var existing_products = $('body').find('.products');
        var existing_main = $('body').find('.site-main');

        $.ajax({
            url: filter.attr('action'),
            data: filter.serialize(), // form data
            type: filter.attr('method'), // POST
            beforeSend: function (xhr) {
                existing_products.addClass('is-loading');
            },
            success: function (data) {
                var filtered_products = $(data).find('.products');
                var filtered_main = $(data).find('.site-main');
                window.history.pushState('page-url', 'url', filter.attr('action') + '?' + filter.serialize());
                $('.woocommerce-info').remove();
                if (filtered_products.html().length === 1) {
                    $('.site-main').prepend($(data).find('.woocommerce-info'));
                }
                existing_main.replaceWith(filtered_main);
                document.dispatchEvent(filterProductsByPriceEvent);
            }
        });
    });

}

export {price};

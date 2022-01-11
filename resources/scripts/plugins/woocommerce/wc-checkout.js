(function ($) {
    "use strict";

    /**
     * Update state select after country change
     */
    $('select#billing_country, select#shipping_country').on('change', function () {
        window.select.chosen("destroy");
        setTimeout(function () {
            window.select = $('select:visible');
            window.select.chosen(window.selectArgs);
        }, 200)
    });

    /**
     * Clear payment methods empty description boxes
     */
    $('body').on('updated_checkout', function () {
        $('.wc_payment_methods .payment_box').each(function (index, element) {
            if ($(element).find('p').length === 0 && $(this).hasClass('payment_method_braintree_paypal')) {
                $(this).addClass('is-disabled');
            }
        })
    });
})(jQuery);

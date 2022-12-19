import updateURLParameter from '../../../util/update-url-parameter';

function sorting() {
    const filterProductsByOrderEvent = new Event('filterProductsByOrder');

    document.addEventListener('filterProductsByPrice', widgetOrderInit)
    document.addEventListener('filterProductsByCategories', widgetOrderInit)

    function widgetOrderInit() {

        if ($('.woocommerce-ordering .chosen-container').length === 0) {
            setTimeout(function () {
                $('.woocommerce-ordering select').chosen(window.selectArgs);
            }, 200)
        }

        $('.woocommerce-ordering').submit(function (e) {
            e.preventDefault();
        });

        /**
         * Initiate select
         */

        $('.woocommerce-ordering select').change(function (e) {
            const searchParams = new URLSearchParams(window.location.search)
            const orderingName = $(this).attr('name')
            const orderingValue = $(this).val()
            const current_products_group = $('.products').attr('data-group');
            const current_products_base = $('.products').attr('data-base');

            let categoryId = '';

            woocommerce_params_widgets.min_price = searchParams.get('min_price');
            woocommerce_params_widgets.max_price = searchParams.get('max_price');

            /**
             * Set current orderby value
             */
            woocommerce_params_widgets.orderby = searchParams.get('orderby');

            if ($(this).val().length > 0) {
                woocommerce_params_widgets.orderby = $(this).val();
            }

            if (typeof $('body')[0] !== undefined && $('body')[0].className.match(/term-\d+/) !== null) {
                categoryId = $('body')[0].className.match(/term-\d+/)[0];
                categoryId = categoryId.replace("term-", "");
            }

            if (categoryId.length > 0) {
                woocommerce_params_widgets.categories_ids = [categoryId];
            }

            /**
             * Replace window location params
             */
            window.history.replaceState('', '', updateURLParameter(window.location.href, orderingName, orderingValue));

            $('.woocommerce-pagination .page-numbers').each(function (index, element) {
                if (typeof $(element).attr('href') !== 'undefined') {
                    let regex = new RegExp('(' + orderingName + '=)[^\&]+');
                    $(element).attr('href', $(element).attr('href').replace(regex, '$1' + orderingValue));
                }
            });

            /**
             * Get products
             */
            $.ajax({
                url: woocommerce_params.ajax_url,
                type: "post",
                data: {
                    orderby: woocommerce_params_widgets.orderby,
                    action: 'filter_products',
                    categories_ids: woocommerce_params_widgets.categories_ids,
                    page_nr: growtype_params.page_nr,
                    products_group: current_products_group,
                    min_price: woocommerce_params_widgets.min_price,
                    max_price: woocommerce_params_widgets.max_price,
                    base: current_products_base,
                },
                beforeSend: function () {
                    /**
                     * Spinner add
                     */
                    $('.products').append("<span class='spinner-border'><div></div><div></div></span>").addClass('is-loading');
                },
                success: function (data) {
                    /**
                     * Spinner remove
                     */
                    $('.products .spinner-border').remove();

                    $('.products').removeClass('is-loading').html("").append(data.products).promise().done(function () {
                        document.dispatchEvent(filterProductsByOrderEvent);
                    });

                    if ($('.woocommerce-pagination').length > 0) {
                        $('.woocommerce-pagination').replaceWith(data.pagination);
                    } else {
                        $('.products').after(data.pagination);
                    }

                    if (growtype_params.page_nr > 1 && data.pagination.length === 0) {
                        window.location = current_products_base + '?orderby=' + woocommerce_params_widgets.orderby;
                    }
                }
            });
        });
    }

    widgetOrderInit();
}

export {sorting};



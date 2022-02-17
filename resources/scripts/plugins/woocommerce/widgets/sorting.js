import updateURLParameter from '../../../util/update-url-parameter';

function sorting() {
    const filterProductsByOrderEvent = new Event('filterProductsByOrder');

    document.addEventListener('filterProductsByPrice', widgetOrderInit)
    document.addEventListener('filterProductsByCategories', widgetOrderInit)

    function widgetOrderInit() {

        $('.woocommerce-ordering').submit(function (e) {
            e.preventDefault();
        });

        /**
         * Initiate select
         */

        $('.woocommerce-ordering select').change(function (e) {
            let orderby = $(this).val();
            let categoryId = '';
            let orderingName = $(this).attr('name')
            let orderingValue = $(this).val()

            if (typeof $('body')[0] !== undefined && $('body')[0].className.match(/term-\d+/) !== null) {
                categoryId = $('body')[0].className.match(/term-\d+/)[0];
                categoryId = categoryId.replace("term-", "");
            }

            window.history.replaceState('', '', updateURLParameter(window.location.href, orderingName, orderingValue));

            $('.woocommerce-pagination .page-numbers').each(function (index, element) {
                if (typeof $(element).attr('href') !== 'undefined') {
                    let regex = new RegExp('(' + orderingName + '=)[^\&]+');
                    $(element).attr('href', $(element).attr('href').replace(regex, '$1' + orderingValue));
                }
            });

            /**
             * Redirect if not first page
             */
            // if (window.location.pathname.includes("/page/")) {
            //     window.location = $('a.page-numbers').first().attr('href');
            //     return false;
            // }

            /**
             * Set current orderby value
             */
            woocommerce_params_widgets.orderby = orderby;

            if (categoryId.length > 0) {
                woocommerce_params_widgets.categories_ids = [categoryId];
            }

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
                },
                beforeSend: function () {
                    $('.products').addClass('is-loading');
                },
                success: function (data) {
                    $('.products').removeClass('is-loading').html("").append(data).promise().done(function () {
                        document.dispatchEvent(filterProductsByOrderEvent);
                    });
                }
            });
        });
    }

    widgetOrderInit();
}

export {sorting};



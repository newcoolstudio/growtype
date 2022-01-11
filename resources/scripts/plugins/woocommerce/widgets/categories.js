import updateURLParameter from "../../../util/update-url-parameter";

function categories() {
    const filterProductsByCategories = new Event('filterProductsByCategories');

    // document.addEventListener('filterProductsByPrice', widgetCategoriesInit)
    // document.addEventListener('filterProductsByOrder', widgetCategoriesInit)

    widgetCategoriesInit();

    /**
     *
     */
    function widgetCategoriesInit() {
        if ($('.product-categories[data-multiple="true"]').length > 0) {

            let currentCategoriesIds = getCurrentCategoriesIds();

            if (currentCategoriesIds.length > 0) {
                currentCategoriesIds.map(function (id) {
                    $('.product-categories .cat-item-' + id).addClass('current-cat');
                });

                getFilteredProductsByCategory(currentCategoriesIds);
            }

            /**
             * Cat click
             */
            $('.product-categories[data-multiple="true"] a').click(function (e) {
                e.preventDefault();
                const parent = $(this).closest('.cat-item');
                const classes = parent.attr('class').split(' ');
                let catId = null;
                let currentCategoriesIds = [];
                let newCategoriesIds = [];

                /**
                 * Disable parent
                 */
                if ($('.product-categories[data-multiple-include-parent="true"]').length === 0) {
                    if (parent.hasClass('cat-parent')) {
                        return false;
                    }
                }

                /**
                 * Get categories
                 */
                if (classes.length >= 2) {
                    catId = classes[1];
                    catId = catId.split("cat-item-").pop();
                }

                /**
                 * If no categories found, redirect
                 */
                if (catId === null) {
                    window.redirect($(this).attr('href'))
                }

                currentCategoriesIds = getCurrentCategoriesIds();
                newCategoriesIds = getCurrentCategoriesIds();

                /**
                 * Update categories with new ids
                 */
                if (parent.hasClass('current-cat')) {
                    parent.removeClass('current-cat');

                    let index = newCategoriesIds.indexOf(catId);
                    if (index !== -1) {
                        newCategoriesIds.splice(index, 1);
                    }
                } else {
                    parent.addClass('current-cat');
                    newCategoriesIds.push(catId)
                }

                updateSearchUrl(currentCategoriesIds, newCategoriesIds);

                getFilteredProductsByCategory(newCategoriesIds);
            });

            /**
             * Clear selections
             */
            $('.btn-clear-cat-filter').click(function () {
                let currentCategoriesIds = getCurrentCategoriesIds();

                if (currentCategoriesIds.length > 0) {
                    updateSearchUrl(currentCategoriesIds);

                    getFilteredProductsByCategory();

                    $('.product-categories .cat-item').removeClass('current-cat');
                }
            });
        }
    }

    /**
     * @param categoriesIds
     */
    function getFilteredProductsByCategory(categoriesIds = []) {

        woocommerce_params_widgets.categories_ids = categoriesIds;

        $.ajax({
            url: woocommerce_params.ajax_url,
            type: "post",
            data: {
                orderby: woocommerce_params_widgets.orderby,
                action: 'filter_products',
                categories_ids: categoriesIds,
            },
            beforeSend: function () {
                $('.products').addClass('is-loading');
            },
            success: function (data) {
                $('.products').removeClass('is-loading').html("").append(data).promise().done(function () {
                    // document.dispatchEvent(filterProductsByOrderEvent);
                });
            }
        });
    }

    /**
     * Update url
     */
    function updateSearchUrl(currentCategoriesIds = [], newCategoriesIds = []) {
        const currentUrl = window.location.href;
        let newUrl = null;

        if (newCategoriesIds.length > 0) {
            if (currentUrl.includes("categories")) {
                newUrl = currentUrl.replace("categories=" + currentCategoriesIds.toString(), "categories=" + newCategoriesIds.toString());
            } else if (window.location.search.length > 0) {
                newUrl = currentUrl + '&categories=' + newCategoriesIds.toString() + '';
            } else {
                newUrl = currentUrl + '?categories=' + newCategoriesIds.toString() + '';
            }
        } else {
            newUrl = currentUrl
                .replace("&categories=" + currentCategoriesIds.toString(), "")
                .replace("?categories=" + currentCategoriesIds.toString() + '&', "?")
                .replace("?categories=" + currentCategoriesIds.toString(), "")
        }

        if (newUrl.length > 0) {
            window.history.pushState('page-url', 'url', newUrl);
        }
    }

    /**
     * Get categories ids
     */
    function getCurrentCategoriesIds() {
        const currentUrl = window.location.href;
        const site = new URL(currentUrl);
        const params = new URLSearchParams(site.search);
        let currentCategoriesIds = [];

        for (const param of params) {
            if (param[0].length > 0 && param[0] === 'categories') {
                currentCategoriesIds = param[1].split(",");
            }
        }

        return currentCategoriesIds;
    }
}

export {categories};

<?php

/**
 * Default catalog products ordering
 */
add_filter('woocommerce_default_catalog_orderby', 'default_catalog_orderby');
function default_catalog_orderby($sort_by)
{
    return 'menu_order';
}

/**
 * Products filtering by specific properties
 */
add_action('woocommerce_product_query', 'archive_product_query');
function archive_product_query($query)
{
    $uri = $_SERVER['REQUEST_URI'];

    if (strstr($uri, 'cat=sale')) {

        $grouped_products = wc_get_products(array (
            'limit' => -1,
            'type' => 'grouped',
            'status' => 'publish'
        ));

        $grouped_products_on_sale = [];
        foreach ($grouped_products as $grouped_product) {
            if ($grouped_product->is_on_sale()) {
                array_push($grouped_products_on_sale, $grouped_product->get_id());
            }
        }

        $product_ids_on_sale = array_merge(wc_get_product_ids_on_sale(), $grouped_products_on_sale);

        $query->set('post__in', (array)$product_ids_on_sale);
    }

    if (strstr($uri, 'cat=new')) {
        $query->set('date_query', array (
            array (
                'after' => "15 day ago"
            )
        ));
    }
}

/**
 * Disable shop page access if enabled
 */
add_action('template_redirect', 'catalog_disable_access');
function catalog_disable_access()
{
    if (is_shop() && get_theme_mod('catalog_disable_access')) {
        wp_redirect(home_url());
        exit();
    }
}

/**
 * Disable product category access if enabled
 */
add_action('template_redirect', 'product_category_disable_access');
function product_category_disable_access()
{
    if (get_theme_mod('catalog_disable_access') && is_product_category()) {
        wp_redirect(home_url());
        exit();
    }
}

/**
 * Remove product count label
 */
add_action('wp_loaded', 'woocommerce_template_loop_result_count_remove');
function woocommerce_template_loop_result_count_remove()
{
    if (get_theme_mod('wc_catalog_result_count_hide')) {
        remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    }
}

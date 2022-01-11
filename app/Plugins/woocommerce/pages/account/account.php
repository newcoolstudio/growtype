<?php

/**
 * @param $items
 * @return mixed
 * Account tabs
 */
add_filter('woocommerce_account_menu_items', 'woocommerce_account_extend_menu_items');
function woocommerce_account_extend_menu_items($items)
{
    /**
     * Reorder menu
     */
    $new_items = [];
    foreach ($items as $key => $item) {
        if (get_theme_mod('woocommerce_account_downloads_tab_disabled') && $key === 'downloads') {
            continue;
        }

        if (get_theme_mod('woocommerce_account_logout_tab_disabled') && $key === 'customer-logout') {
            continue;
        }

        if (get_theme_mod('woocommerce_account_addresses_tab_disabled') && $key === 'edit-address') {
            continue;
        }

        $new_items[$key] = $item;

        /**
         * Purchased products tab
         */
        if (!get_theme_mod('woocommerce_account_purchased_products_tab_disabled') && $key === 'dashboard') {
            $new_items['purchased-products'] = __('Purchased products', 'growtype');
        }

        /**
         * Purchased products tab
         */
        if (!get_theme_mod('woocommerce_account_uploaded_products_tab_disabled') && $key === 'dashboard') {
            $new_items['uploaded-products'] = __('Uploaded products', 'growtype');
        }
    }

    return $new_items;
}

/**
 * Add New Tab on the My Account page
 */
add_action('init', 'woocommerce_account_extend_endpoints');
function woocommerce_account_extend_endpoints()
{
    if (!get_theme_mod('woocommerce_account_purchased_products_tab_disabled')) {
        add_rewrite_endpoint('purchased-products', EP_ROOT | EP_PAGES);
    }

    if (!get_theme_mod('woocommerce_account_uploaded_products_tab_disabled')) {
        add_rewrite_endpoint('uploaded-products', EP_ROOT | EP_PAGES);
    }
}

/**
 *
 */
add_filter('query_vars', 'woocommerce_account_extend_query_vars', 0);
function woocommerce_account_extend_query_vars($vars)
{
    if (!get_theme_mod('woocommerce_account_purchased_products_tab_disabled')) {
        $vars[] = 'purchased-products';
    }

    if (!get_theme_mod('woocommerce_account_uploaded_products_tab_disabled')) {
        $vars[] = 'uploaded-products';
    }

    return $vars;

}

/**
 * Products tab
 */
if (!get_theme_mod('woocommerce_account_purchased_products_tab_disabled')) {
    include('tabs/purchased-products.php');
}

/**
 * Products tab
 */
if (!get_theme_mod('woocommerce_account_uploaded_products_tab_disabled')) {
    include('tabs/uploaded-products.php');
}



<?php

include('subpages/edit-account.php');

function get_account_subpage_intro_details($subpage)
{
    $details = [
        'orders' => __('Orders', 'growtype') . ' <div class="e-subtitle">' . __('Purchase history', 'growtype') . '</div>',
        'edit-account' => __('Profile', 'growtype') . ' <div class="e-subtitle">' . __('Profile & business details', 'growtype') . '</div>',
        'edit-address' => __('Addresses', 'growtype') . ' <div class="e-subtitle">' . __('Shipping and billing details', 'growtype') . '</div>',
        'auctions-endpoint' => __('Auctions', 'growtype') . ' <div class="e-subtitle">' . __('Auctions details', 'growtype') . '</div>',
        'purchased-products' => __('Purchased products', 'growtype') . ' <div class="e-subtitle">' . __('Your products', 'growtype') . '</div>',
        'uploaded-products' => __('Uploaded products', 'growtype') . ' <div class="e-subtitle">' . __('Your uploads', 'growtype') . '</div>'
    ];

    return $details[$subpage] ?? null;
}

/**
 * Add intro section
 */
add_action('woocommerce_before_account_orders', 'growtype_woocommerce_before_edit_account_form');
add_action('woocommerce_before_edit_account_form', 'growtype_woocommerce_before_edit_account_form');
add_action('woocommerce_before_edit_account_address_form', 'growtype_woocommerce_before_edit_account_form');
function growtype_woocommerce_before_edit_account_form()
{
    $url_slug = Growtype_Post::get_url_slug();

    echo \App\template('woocommerce.myaccount.sections.info-header', ['intro_details' => get_account_subpage_intro_details($url_slug)]);
}

/**
 *
 */
add_action('wp_loaded', 'woocommerce_account_remove_navigation');
function woocommerce_account_remove_navigation()
{
    $navigation_enabled = Growtype_User_Account::is_dashboard_page();

    if (!$navigation_enabled) {
        remove_action('woocommerce_account_navigation', 'woocommerce_account_navigation', 10, 1);
    }
}

/**
 * @param $items
 * @return mixed
 * Account tabs
 */
add_filter('woocommerce_account_menu_items', 'woocommerce_account_extend_menu_items', 20);
function woocommerce_account_extend_menu_items($items)
{
    /**
     * Reorder menu
     */
    $new_items = [];
    foreach ($items as $key => $item) {

        if ($key === 'orders' || $key === 'edit-account' || $key === 'edit-address' || $key === 'auctions-endpoint') {
            $item = get_account_subpage_intro_details($key);
        }

        if ($key === 'dashboard') {
            $get_id = get_option('woocommerce_myaccount_page_id');
            $item = get_the_title($get_id);
        }

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
            $new_items['purchased-products'] = get_account_subpage_intro_details('purchased-products');
        }

        /**
         * Uploaded products tab
         */
        if (!get_theme_mod('woocommerce_account_uploaded_products_tab_disabled') && $key === 'dashboard') {
            $new_items['uploaded-products'] = get_account_subpage_intro_details('uploaded-products');
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
    add_rewrite_endpoint('purchased-products', EP_ROOT | EP_PAGES);

    add_rewrite_endpoint('uploaded-products', EP_ROOT | EP_PAGES);
}

/**
 * Add query variable
 */
add_filter('query_vars', 'woocommerce_account_extend_query_vars', 0);
function woocommerce_account_extend_query_vars($vars)
{
    $vars[] = 'purchased-products';

    $vars[] = 'uploaded-products';

    return $vars;
}

/**
 * Products tab
 */
include('subpages/purchased-products.php');

/**
 * Products tab
 */
include('subpages/uploaded-products.php');

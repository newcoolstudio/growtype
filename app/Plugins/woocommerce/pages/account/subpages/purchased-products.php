<?php

/**
 *
 */
add_action('woocommerce_account_purchased-products_endpoint', 'woocommerce_account_extend_purchased_products_endpoint');
function woocommerce_account_extend_purchased_products_endpoint()
{
    $product_types = wc_get_product_types();

    /**
     * Skip subscriptions
     */
    unset($product_types['subscription']);

    /**
     * Ger purchased products ids
     */
    $products_ids = Growtype_Product::get_user_purchased_products_ids(get_current_user_id(), array_keys($product_types));

    $products_ids = !empty($products_ids) ? implode(',', $products_ids) : null;

    echo \App\template('woocommerce.myaccount.purchased-products', ['products_ids' => $products_ids]);
}

<?php

/**
 *
 */
add_action('woocommerce_account_purchased-products_endpoint', 'woocommerce_account_extend_purchased_products_endpoint');
function woocommerce_account_extend_purchased_products_endpoint()
{
    $products_ids = Growtype_Product::get_user_purchased_products_ids();
    $products_ids = !empty($products_ids) ? implode(',', $products_ids) : null;

    echo \App\template('woocommerce.myaccount.purchased-products', ['products_ids' => $products_ids]);
}

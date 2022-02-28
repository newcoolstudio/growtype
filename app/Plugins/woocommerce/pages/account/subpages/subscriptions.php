<?php

/**
 *
 */
add_action('woocommerce_account_subscriptions_endpoint', 'woocommerce_account_subscriptions_endpoint_extend');
function woocommerce_account_subscriptions_endpoint_extend()
{
    $products_ids = Growtype_Product::get_user_plans_ids();
    $products_ids = !empty($products_ids) ? implode(',', $products_ids) : null;;
    echo \App\template('woocommerce.myaccount.subscriptions', ['products_ids' => $products_ids]);
}

<?php

/**
 *
 */
add_action('woocommerce_account_subscriptions_endpoint', 'woocommerce_account_subscriptions_endpoint_extend');
function woocommerce_account_subscriptions_endpoint_extend()
{
    $products = Growtype_Product::get_user_subscriptions();

    echo \App\template('woocommerce.myaccount.subscriptions', ['products' => $products]);
}

<?php

/**
 *
 */
add_action('woocommerce_account_uploaded-products_endpoint', 'woocommerce_account_extend_uploaded_products_endpoint');
function woocommerce_account_extend_uploaded_products_endpoint()
{
    $products_ids = get_user_uploaded_products_ids();
    $products_ids = !empty($products_ids) ? implode(',', $products_ids) : null;

    echo \App\template('woocommerce.myaccount.custom.uploaded-products', ['products_ids' => $products_ids]);
}
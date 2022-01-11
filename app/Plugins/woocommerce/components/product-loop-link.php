<?php

/**
 * Product general link
 */
add_filter('woocommerce_loop_product_link', 'change_product_link', 99, 2);
function change_product_link($link, $product)
{
    $product_type = $product->get_type();

    switch ($product_type) {
        case 'external':
            $link = $product->get_product_url();
            break;
        case 'simple':
            $instant_checkout = get_post_meta($product->get_id(), '_instant_checkout_enabled', true);
            if (!empty($instant_checkout) && $instant_checkout === 'yes') {
                $link = $product->add_to_cart_url();
            }
            break;
    }

    /***
     * Check if permalink query is set
     */
    if (!empty(get_query_var('permalink'))) {
        $link = get_query_var('permalink');
    }

    return $link;
}

/**
 * Add to cart link adjusting if individual product is in the cart
 */
add_filter('woocommerce_product_add_to_cart_url', 'adjust_add_to_cart_button_link', 10, 2);
function adjust_add_to_cart_button_link($add_to_cart_url, $product)
{
    if (empty(WC()->cart)) {
        return null;
    }

    $product_in_cart = product_is_in_cart($product);

    if ($product->is_purchasable()
        && $product_in_cart
        && $product->is_in_stock()) {
        $add_to_cart_url = wc_get_checkout_url();
    }

    return $add_to_cart_url;
}

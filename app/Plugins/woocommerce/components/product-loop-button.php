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
<?php

/**
 * Product general link
 */
add_filter('woocommerce_loop_product_link', 'change_product_link', 99, 2);
function change_product_link($link, $product)
{
    if (empty($product)) {
        return $link;
    }

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

    /**
     * Permalink update
     */
    if ($link === get_permalink($product->get_id())) {
        $link = Growtype_Product::permalink($product->get_id());
    }

    return $link;
}

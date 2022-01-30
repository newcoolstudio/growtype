<?php

/**
 * Auction status
 */
add_action('woocommerce_before_shop_loop_item', 'growtype_child_woocommerce_before_shop_loop_item', 10);
function growtype_child_woocommerce_before_shop_loop_item()
{
    global $product;

    if ($product->is_type('auction')) {
        echo Growtype_Auction::status_badge();
    }
}

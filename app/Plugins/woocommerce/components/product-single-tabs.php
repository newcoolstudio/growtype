<?php

/**
 * Remove product data tabs
 */
add_filter('woocommerce_product_tabs', 'growtype_woocommerce_product_tabs', 98);
function growtype_woocommerce_product_tabs($tabs)
{
    global $product;

    if (!empty($product) && $product->is_type('auction')) {
        if (class_exists('WC_Product_Auction')) {
            $auction_history = apply_filters('woocommerce__auction_history_data', $product->auction_history());
            if (empty($auction_history)) {
                unset($tabs['simle_auction_history']);
            }
        }
    }

    unset($tabs['description']);        // Remove the description tab
    unset($tabs['reviews']);            // Remove the reviews tab
    unset($tabs['additional_information']);    // Remove the additional information tab

    return $tabs;
}


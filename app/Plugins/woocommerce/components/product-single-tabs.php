<?php

/**
 * Remove product data tabs
 */
add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);

function woo_remove_product_tabs($tabs)
{

    unset($tabs['description']);        // Remove the description tab
    unset($tabs['reviews']);            // Remove the reviews tab
    unset($tabs['additional_information']);    // Remove the additional information tab

    return $tabs;
}


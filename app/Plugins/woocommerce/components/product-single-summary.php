<?php

/**
 * Summary section
 */
add_filter('woocommerce_after_single_product_summary', 'growtype_woocommerce_after_single_product_summary', 5);
function growtype_woocommerce_after_single_product_summary()
{
    $single_description = \App\template('woocommerce.components.product-single-description');
    $single_details = \App\template('woocommerce.components.product-single-details');

    echo apply_filters('growtype_woocommerce_after_single_product_summary_description', $single_description);
    echo apply_filters('growtype_woocommerce_after_single_product_summary_details', $single_details);
}

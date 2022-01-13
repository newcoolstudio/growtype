<?php

/**
 * Description section
 */
add_filter('woocommerce_after_single_product_summary', 'add_details_section', 5);
function add_details_section()
{
    echo \App\template('woocommerce.components.product-single-details');
}

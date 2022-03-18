<?php

/**
 * Description section
 */
add_filter('woocommerce_after_single_product_summary', 'add_description_section', 1);
function add_description_section()
{
    echo \App\template('woocommerce.components.product-single-description');
}

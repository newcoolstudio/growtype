<?php

/**
 * Custom fields in product single page
 */
add_action('woocommerce_product_options_general_product_data', 'growtype_woocommerce_product_options_general_product_data');

function growtype_woocommerce_product_options_general_product_data()
{
    global $product_object;
}

/**
 * Save data
 */
add_action('woocommerce_admin_process_product_object', 'growtype_woocommerce_admin_process_product_object_general');
function woocommerce_product_product_data_extra_fields_save_data($product)
{
}


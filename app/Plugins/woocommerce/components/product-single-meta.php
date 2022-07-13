<?php

/**
 * Meta data
 */
add_action('wp_loaded', 'growtype_woocommerce_product_page_meta_data');
function growtype_woocommerce_product_page_meta_data()
{
    if (!get_theme_mod('woocommerce_product_page_meta_data_enabled')) {
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    }
}

<?php

/**
 * Meta data status
 */
add_action('wp_loaded', 'woocommerce_product_page_meta_data_disabled');

function woocommerce_product_page_meta_data_disabled()
{
//    d(get_theme_mod('woocommerce_product_page_meta_data_disabled'));
    if (get_theme_mod('woocommerce_product_page_meta_data_disabled')) {
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    }
}

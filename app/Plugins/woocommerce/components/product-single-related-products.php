<?php

/**
 * Remove related products output
 */
add_action('wp_loaded', 'woocommerce_related_products_controller');

function woocommerce_related_products_controller()
{
    if (get_theme_mod('woocommerce_product_page_related_products_status')) {
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    }
}

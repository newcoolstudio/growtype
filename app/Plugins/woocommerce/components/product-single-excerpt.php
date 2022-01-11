<?php

/**
 * Change product excerpt position
 */
add_action('wp_loaded', 'woocommerce_product_page_excerpt_position');
function woocommerce_product_page_excerpt_position()
{
    if (get_theme_mod('woocommerce_product_page_excerpt_position') === 'position-2') {
        remove_action("woocommerce_single_product_summary", "woocommerce_template_single_add_to_cart", 30);
        add_action("woocommerce_single_product_summary", "woocommerce_template_single_add_to_cart", 15);
    }
}

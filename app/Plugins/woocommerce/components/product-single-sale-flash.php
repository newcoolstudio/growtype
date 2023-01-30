<?php

/**
 * Sale flash product single page
 */
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

if (!get_theme_mod('woocommerce_product_page_sale_flash_disabled')) {
    add_action('woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 1);
}

/**
 * Sale flash product loop
 */
if (get_theme_mod('woocommerce_product_preview_sale_flash_disabled')) {
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
}

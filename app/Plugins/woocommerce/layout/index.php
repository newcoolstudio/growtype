<?php

/**
 * Add classes to body
 */
add_filter('body_class', 'growtype_woocommerce_extend_body_classes');
function growtype_woocommerce_extend_body_classes($classes)
{
    if (is_account_page()) {
        $url_slug = Growtype_Page::get_url_slug();
        $classes[] = 'page-' . $url_slug;
    }

    if (get_option('woocommerce_cart_redirect_after_add') !== 'yes') {
        $classes[] = 'ajaxcart-enabled';
    }

    if (get_theme_mod('woocommerce_cart_enabled', true)) {
        $classes[] = 'cart-enabled';
    }

    $classes[] = get_theme_mod('woocommerce_product_page_gallery_type', 'woocommerce-product-gallery-type-2');

    return $classes;
}

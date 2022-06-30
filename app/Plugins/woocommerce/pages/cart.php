<?php

/**
 * Coupon scripts
 */
add_action('wp_enqueue_scripts', 'coupon_scripts_styles');
function coupon_scripts_styles()
{
    if(class_exists( 'woocommerce' ) && is_cart()){
        if (wc_coupons_enabled()) {
            wp_enqueue_script('wc-coupon', growtype_get_parent_theme_public_path() . '/scripts/plugins/woocommerce/wc-coupon.js', '', '', true);
        }
    }
}

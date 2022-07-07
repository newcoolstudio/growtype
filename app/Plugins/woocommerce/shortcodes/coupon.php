<?php

/**
 * Woocommerce coupon discount
 */
add_shortcode('growtype_featured_coupon_discount', 'growtype_featured_coupon_discount');
function growtype_featured_coupon_discount($atts)
{
    global $woocommerce;

    $coupon_id = get_theme_mod('shop_featured_coupon_select');

    if (!empty($coupon_id)) {
        $coupon = new WC_Coupon($coupon_id);
        if ($coupon->get_discount_type() === 'percent') {
            return $coupon->get_amount() . '%';
        }
    }
}

/**
 * Woocommerce coupon discount
 */
add_shortcode('growtype_featured_coupon_code', 'growtype_featured_coupon_code');
function growtype_featured_coupon_code($atts)
{
    global $woocommerce;

    $coupon_id = get_theme_mod('shop_featured_coupon_select');

    if (!empty($coupon_id)) {
        $coupon = new WC_Coupon($coupon_id);
        return $coupon->get_code();
    }
}

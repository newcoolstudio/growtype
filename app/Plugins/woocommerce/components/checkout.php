<?php

/**
 * Scripts
 */
function checkout_scripts_styles()
{
    if (class_exists('woocommerce') && is_checkout()) {;
        wp_enqueue_script( 'wc-custom-checkout', get_template_public_path() . '/scripts/plugins/woocommerce/wc-checkout.js', [], '1.0.0', true );
    }
}

add_action('wp_enqueue_scripts', 'checkout_scripts_styles');

/**
 * Remove cart notice
 */
function sv_remove_cart_notice_on_checkout()
{
    if (function_exists('wc_cart_notices')) {
        remove_action('woocommerce_before_checkout_form', array (wc_cart_notices(), 'add_cart_notice'));
    }
}

add_action('wp_loaded', 'sv_remove_cart_notice_on_checkout');

/**
 * Change checkout button text  "Place Order" to custom text in checkout page
 * @param $button_text
 * @return $string
 */
add_filter('woocommerce_order_button_text', 'change_checkout_button_text');
function change_checkout_button_text($button_text)
{
    $woocommerce_checkout_billing_section_title = !empty(get_theme_mod('woocommerce_checkout_place_order_button_title')) ? get_theme_mod('woocommerce_checkout_place_order_button_title') : 'Place order';
    return $woocommerce_checkout_billing_section_title;
}

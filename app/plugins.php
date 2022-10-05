<?php

namespace App;

/**
 * Woocommerce
 */
if (class_exists('WooCommerce')) {
    include('Plugins/woocommerce/main.php');
}

/**
 * Acf
 */
if (class_exists('ACF')) {
    include('Plugins/acf/acf.php');
}

/**
 * Qtranslate-x
 */
if (class_exists('QTX_Modules_Handler')) {
    include('Plugins/qtranslate-xt/qtranslate.php');
}

/**
 * Extended-cpts
 */
include('Plugins/extended-cpts/index.php');

/**
 * Woo-checkout-field-editor
 */
if (class_exists('THWCFD')) {
    include('Plugins/woo-checkout-field-editor/woo-checkout-field-editor.php');
}

/**
 * woo-payment-gateway / braintree payments
 */
if (class_exists('WC_Braintree_Manager')) {
    include('Plugins/woo-payment-gateway/braintree.php');
}

/**
 * woo-payment-gateway-paysera
 */
if (class_exists('Wc_Paysera_Init')) {
    include('Plugins/woo-payment-gateway-paysera/paysera.php');
}

/**
 * wordpress-seo
 */
if (in_array('wordpress-seo/wp-seo.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    include(__DIR__ . "/Plugins/wordpress-seo/main.php");
}

/**
 * Buddypress
 */
if (class_exists('Buddypress')) {
    include(__DIR__ . "/Plugins/buddypress/main.php");
}

/**
 * Bbpress
 */
if (class_exists('Bbpress')) {
    include(__DIR__ . "/Plugins/bbpress/main.php");
}

<?php

use function App\config;

/*
 * Disable default woocommerce scripts
 */
add_action('wp_enqueue_scripts', 'growtype_disable_woocommerce_scripts');
function growtype_disable_woocommerce_scripts()
{
    if (class_exists('woocommerce')) {

        ## Dequeue WooCommerce styles
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-smallscreen');

        ## Dequeue WooCommerce scripts
//        wp_dequeue_script('wc-cart-fragments');
//        wp_dequeue_script('woocommerce');
//        wp_dequeue_script('wc-add-to-cart');
//        wp_deregister_script('js-cookie');
//        wp_dequeue_script('js-cookie');

        /**
         * Deregister default wc variations script. Custom scripts "wc-main.js -> select-variation.js" script is used. If enabled, on select error occurs.
         */
        wp_deregister_script('wc-add-to-cart-variation');
        wp_dequeue_script('wc-add-to-cart-variation');

        /**
         * Flexslider
         */
        //remove_theme_support( 'wc-product-gallery-slider' );

        /**
         * Select
         */
        wp_dequeue_style('selectWoo');
        wp_deregister_style('selectWoo');

        wp_dequeue_script('selectWoo');
        wp_deregister_script('selectWoo');
    }
}

/**
 * Default scrips
 */
add_action('wp_enqueue_scripts', 'growtype_default_woocommerce_scripts', 10);
function growtype_default_woocommerce_scripts()
{
    if (class_exists('woocommerce') && !is_admin()) {
        wp_enqueue_style('growtype/woocommerce/woocommerce-styles', growtype_get_parent_theme_public_path() . '/styles/plugins/woocommerce/woocommerce.css', false, null);
    }
}

/**
 * Custom scrips
 */
add_action('wp_enqueue_scripts', 'growtype_custom_woocommerce_scripts', 100);
function growtype_custom_woocommerce_scripts()
{
    if (class_exists('woocommerce') && !is_admin()) {
        /**
         * External Scripts
         */
        wp_enqueue_script('sweetalert2', 'https://cdn.jsdelivr.net/npm/sweetalert2@9', ['jquery'], null, true);

        /**
         * Local scripts
         */
        wp_enqueue_script('growtype/woocommerce/wc-main', growtype_get_parent_theme_public_path() . '/scripts/plugins/woocommerce/wc-main.js', ['jquery'], config('theme.version'), true);
    }
}

/**
 * Ajax
 */

add_filter('woocommerce_ajax_variation_threshold', 'growtype_woocommerce_ajax_variation_threshold');
function growtype_woocommerce_ajax_variation_threshold()
{
    return 150;
}

/**
 * Register theme support
 */
add_action('after_setup_theme', function () {
    if (class_exists('WooCommerce')) {
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
    }
}, 20);

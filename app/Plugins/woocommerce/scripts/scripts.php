<?php

/*
 * DISABLE DEFAULT WOOCOMMERCE SCRIPTS
 */

use function App\config;

add_action('wp_enqueue_scripts', 'crunchify_disable_woocommerce_loading_css_js');

function crunchify_disable_woocommerce_loading_css_js()
{
    if (function_exists('is_woocommerce')) {

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
    }
}

add_action('wp_enqueue_scripts', 'alter_woocommerce_select2', 100);

function alter_woocommerce_select2()
{
    if (class_exists('woocommerce')) {
        wp_dequeue_style('selectWoo');
        wp_deregister_style('selectWoo');

        wp_dequeue_script('selectWoo');
        wp_deregister_script('selectWoo');
    }
}

/**
 * Custom scrips
 */
add_action('wp_enqueue_scripts', 'custom_woocommerce_scripts', 100);
function custom_woocommerce_scripts()
{
    if (class_exists('woocommerce') && !is_admin()) {

        /**
         * External Scripts
         */
        wp_enqueue_script('sweetalert2', 'https://cdn.jsdelivr.net/npm/sweetalert2@9', ['jquery'], null, true);

        /**
         * Local scripts
         */
        wp_enqueue_style('growtype/woocommerce/woocommerce-styles', get_parent_template_public_path() . '/styles/plugins/woocommerce/woocommerce.css', false, null);
        wp_enqueue_script('growtype/woocommerce/wc-main', get_parent_template_public_path() . '/scripts/plugins/woocommerce/wc-main.js', ['jquery'], config('theme.version'), true);
    }
}

/**
 * Ajax
 */

add_filter('woocommerce_ajax_variation_threshold', 'marce_wc_inc_ajax_threshold');
function marce_wc_inc_ajax_threshold()
{
    return 150;
}

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * WOOCOMMERCE
     */
    if (class_exists('WooCommerce')) {
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
    }
}, 20);

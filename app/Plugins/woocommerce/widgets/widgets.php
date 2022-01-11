<?php

/**
 * Enqueue scripts
 */
add_action('wp_enqueue_scripts', 'wc_widgets_scripts');
function wc_widgets_scripts()
{
    if (class_exists('woocommerce') && !is_admin()) {
        wp_enqueue_script('wc-widgets', get_template_directory_uri() . '/../public/scripts/plugins/woocommerce/wc-widgets.js', '', '', true);
        wp_localize_script(
            'wc-widgets',
            'woocommerce_params_widgets',
            array (
                'orderby' => 'menu_order',
                'categories_ids' => [],
            )
        );
    }
}

/**
 * Ajax
 */
include('ajax/products-filtering.php');

/**
 * Widgets
 */
add_action('widgets_init', 'override_woocommerce_widgets', 15);
function override_woocommerce_widgets()
{
    /**
     * WC_Widget_Layered_Nav_Filters
     */
    if (class_exists('WC_Widget_Layered_Nav_Filters')) {
        unregister_widget('WC_Widget_Layered_Nav_Filters');
        include('components/Custom_WC_Widget_Layered_Nav_Filters.php');
        register_widget('Custom_WC_Widget_Layered_Nav_Filters');
    }

    /**
     * WC_Widget_Product_Categories
     */
    if (class_exists('WC_Widget_Product_Categories')) {
        unregister_widget('WC_Widget_Product_Categories');
        include('components/Custom_WC_Widget_Product_Categories.php');
        register_widget('Custom_WC_Widget_Product_Categories');
    }
}

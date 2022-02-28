<?php

/**
 * Custom fields in product single page
 */
add_action('woocommerce_product_options_general_product_data', 'growtype_woocommerce_product_options_general_product_data', 1);
function growtype_woocommerce_product_options_general_product_data()
{
    global $product_object;

    /**
     * Subscription regular price
     */
    echo '<div class="options_group show_if_subscription">';

    woocommerce_wp_text_input(
        array (
            'id' => '_regular_price',
            'value' => $product_object->get_regular_price('edit'),
            'label' => __('Regular price', 'woocommerce') . ' (' . get_woocommerce_currency_symbol() . ')',
            'data_type' => 'price',
        )
    );

    echo '</div>';

    /**
     * Subscription sale price
     */
    echo '<div class="options_group show_if_subscription">';

    woocommerce_wp_text_input(
        array (
            'id' => '_sale_price',
            'value' => $product_object->get_sale_price('edit'),
            'data_type' => 'price',
            'label' => __('Sale price', 'woocommerce') . ' (' . get_woocommerce_currency_symbol() . ')',
            'description' => '<a href="#" class="sale_schedule">' . __('Schedule', 'woocommerce') . '</a>',
        )
    );

    echo '</div>';

    /**
     * Subscription sale price
     */
    echo '<div class="options_group show_if_subscription">';

    woocommerce_wp_text_input(array (
        'id' => '_subscription_duration',
        'label' => __('Duration (months)', 'woocommerce'),
        'description' => '',
        'desc_tip' => 'false',
        'placeholder' => '',
    ));

    echo '</div>';
}

/**
 * Save data
 */
add_action('woocommerce_admin_process_product_object', 'growtype_woocommerce_admin_process_product_object_general');
function growtype_woocommerce_admin_process_product_object_general($product)
{
    /**
     * Cases
     */
    $product->update_meta_data('_subscription_duration', $_POST['_subscription_duration'] ?? 1);
}


<?php

/**
 * Custom fields in product single page, woocommerce general section
 */
add_action('woocommerce_product_options_general_product_data', 'growtype_woocommerce_product_options_general_product_data', 9999, 0);
function growtype_woocommerce_product_options_general_product_data()
{
    global $post;

    /**
     * Subscription product variation, subscription duration
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
    $product->update_meta_data('_subscription_duration', $_POST['_subscription_duration'] ?? 1);
}


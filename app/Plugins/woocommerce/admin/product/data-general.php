<?php

/**
 * Custom fields in product single page
 */
add_action('woocommerce_product_options_general_product_data', 'growtype_woocommerce_product_options_general_product_data');
function growtype_woocommerce_product_options_general_product_data()
{
    global $product_object;

    /**
     * Volume
     */
    echo '<div class="options_group">';

    // External Url
    woocommerce_wp_text_input(array (
        'id' => '_product_volume',
        'label' => 'Volume (L)',
        'description' => 'Set product volume in litres.',
        'desc_tip' => 'true',
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
     * Volume
     */
    $product->update_meta_data('_product_volume', $_POST['_product_volume'] ?? 0);
}


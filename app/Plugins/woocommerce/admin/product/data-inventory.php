<?php

/**
 * Custom fields in product single page
 */
add_action('woocommerce_product_options_inventory_product_data', 'growtype_woocommerce_product_options_inventory_product_data');
function growtype_woocommerce_product_options_inventory_product_data()
{
    global $product_object;

    /**
     * Units
     */
    echo '<div class="options_group">';

    // External Url
    woocommerce_wp_text_input(array (
        'id' => '_amount_in_units',
        'label' => 'Units (amount)',
        'description' => 'Product amount in units.',
        'desc_tip' => 'true',
        'placeholder' => '',
    ));

    echo '</div>';

    /**
     * Cases
     */
    echo '<div class="options_group">';

    // External Url
    woocommerce_wp_text_input(array (
        'id' => '_amount_in_cases',
        'label' => 'Cases (amount)',
        'description' => 'Product amount in cases.',
        'desc_tip' => 'true',
        'placeholder' => '',
    ));

    echo '</div>';

    /**
     * Cases per pallet
     */
    echo '<div class="options_group">';

    // External Url
    woocommerce_wp_text_input(array (
        'id' => '_cases_per_pallet',
        'label' => 'Cases per pallet',
        'description' => '',
        'desc_tip' => 'false',
        'placeholder' => '',
    ));

    echo '</div>';
}

/**
 * Save data
 */
add_action('woocommerce_admin_process_product_object', 'growtype_woocommerce_admin_process_product_object_inventory');
function growtype_woocommerce_admin_process_product_object_inventory($product)
{
    /**
     * Units
     */
    $product->update_meta_data('_amount_in_units', $_POST['_amount_in_units'] ?? 0);

    /**
     * Cases
     */
    $product->update_meta_data('_amount_in_cases', $_POST['_amount_in_cases'] ?? 0);

    /**
     * Cases per pallete
     */
    $product->update_meta_data('_cases_per_pallet', $_POST['_cases_per_pallet'] ?? 0);
}


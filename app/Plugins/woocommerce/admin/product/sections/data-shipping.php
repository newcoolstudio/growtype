<?php

/**
 * Custom fields in product single page
 */
add_action('woocommerce_product_options_shipping_product_data', 'growtype_woocommerce_product_options_shipping_product_data');
function growtype_woocommerce_product_options_shipping_product_data()
{
    global $post, $thepostid, $product_object;

    /**
     * Volume
     */
    echo '<div class="options_group">';

    woocommerce_wp_text_input(array (
        'id' => '_product_volume',
        'label' => 'Volume (L)',
        'description' => 'Set product volume in litres.',
        'desc_tip' => 'true',
        'placeholder' => '',
    ));

    echo '</div>';

    /**
     *
     */
    $field_options = array ('' => __('Select a country / region&hellip;', 'growtype')) + WC()->countries->get_allowed_countries();

    /**
     * Country
     */
    echo '<div class="options_group">';

    woocommerce_wp_select(array (
        'id' => '_product_location_country',
        'label' => 'Product location - Country',
        'options' => $field_options,
        'value' => get_post_meta($_GET['post'], '_product_location_country', true),
    ));

    echo '</div>';

    /**
     * City
     */
    echo '<div class="options_group">';

    woocommerce_wp_text_input(array (
        'id' => '_product_location_city',
        'label' => 'Product location - City',
        'description' => '',
        'desc_tip' => 'false',
        'placeholder' => '',
    ));

    echo '</div>';

    /**
     * Documents table
     */
    require 'shipping/documents-table.php';
}

/**
 * Save data
 */
add_action('woocommerce_admin_process_product_object', 'growtype_woocommerce_admin_process_product_object_shipping');
function growtype_woocommerce_admin_process_product_object_shipping($product)
{
    /**
     * Volume
     */
    $product->update_meta_data('_product_volume', $_POST['_product_volume'] ?? 0);

    /**
     * Country
     */
    $product->update_meta_data('_product_location_country', $_POST['_product_location_country'] ?? 0);

    /**
     * City
     */
    $product->update_meta_data('_product_location_city', $_POST['_product_location_city'] ?? 0);

    /**
     * Documents
     */
    $downloads = Growtype_Product::prepare_shipping_documents(
        isset($_POST['_wc_shipping_file_names']) ? wp_unslash($_POST['_wc_shipping_file_names']) : array (),
        isset($_POST['_wc_shipping_file_urls']) ? wp_unslash($_POST['_wc_shipping_file_urls']) : array (),
        isset($_POST['_wc_shipping_file_hashes']) ? wp_unslash($_POST['_wc_shipping_file_hashes']) : array (),
        isset($_POST['_wc_shipping_file_keys']) ? wp_unslash($_POST['_wc_shipping_file_keys']) : array ()
    );

    if (empty($downloads)) {
        $product->delete_meta_data('_shipping_documents');
    } else {
        $product->update_meta_data('_shipping_documents', $downloads, true);
    }
}

<?php

/**
 * Adjust css
 */
add_action('admin_head', 'growtype_admin_head_product');
function growtype_admin_head_product()
{
    echo '<style>
    .woocommerce_options_panel textarea {
     height:initial;
    } 
  </style>';
}

/**
 * Custom fields
 */
add_action('woocommerce_product_options_advanced', 'growtype_woocommerce_product_options_advanced');
function growtype_woocommerce_product_options_advanced()
{
    global $product_object;

    /**
     * Preview style
     */
    echo '<div class="options_group previe_style">';

    // External Url
    woocommerce_wp_select(array (
        'id' => '_preview_style',
        'label' => 'Preview style',
        'description' => 'Product preview style visible in frontend.',
        'desc_tip' => 'true',
        'options' => [
            'default' => 'Default',
            'plan' => 'Plan'
        ]
    ));

    echo '</div>';

    /**
     * Img placeholder
     */
    echo '<div class="options_group img_placeholder">';

    // External Url
    woocommerce_wp_checkbox(array (
        'id' => '_img_placeholder_enabled',
        'label' => 'Image placeholder',
        'description' => 'Show default image placeholder in products loop.',
        'desc_tip' => 'true'
    ));

    echo '</div>';

    /**
     * Add to cart button custom text
     */
    echo '<div class="options_group">';

    // External Url
    woocommerce_wp_text_input(array (
        'id' => '_add_to_cart_button_custom_text',
        'label' => 'Custom "Add to cart" button text',
        'description' => 'Set unique "Add to cart" button label.',
        'desc_tip' => 'true',
        'placeholder' => 'Enter button text',
    ));

    echo '</div>';

    /**
     * Instant checkout
     */
    echo '<div class="options_group instant_checkout">';

    // External Url
    woocommerce_wp_checkbox(array (
        'id' => '_instant_checkout_enabled',
        'label' => 'Instant checkout',
        'description' => 'Check this if you want to enable "Add to cart" instant redirect to checkout',
        'desc_tip' => 'true'
    ));

    echo '</div>';

    /**
     * Single purchase
     */
    echo '<div class="options_group only_as_single_purchase">';

    // External Url
    woocommerce_wp_checkbox(array (
        'id' => '_only_as_single_purchase',
        'label' => 'Allow only as single purchase',
        'description' => 'Check this if you want to allow this product only as single purchase.',
        'desc_tip' => 'true'
    ));

    echo '</div>';

    /**
     * Hide price
     */
    echo '<div class="options_group hide_product_price">';

    // External Url
    woocommerce_wp_checkbox(array (
        'id' => '_hide_product_price',
        'label' => 'Hide product price',
        'description' => 'Check this if you want to hide product price',
        'desc_tip' => 'true'
    ));

    echo '</div>';

    /**
     * Extra details about price
     */
    echo '<div class="options_group price_details">';

    // External Url
    woocommerce_wp_text_input(array (
        'id' => '_price_details',
        'label' => 'Extra details about price',
        'description' => 'F.e. how ofter this price will be charged',
        'desc_tip' => 'true'
    ));

    echo '</div>';

    /**
     * Promo label
     */
    echo '<div class="options_group promo_label">';

    // External Url
    woocommerce_wp_text_input(array (
        'id' => '_promo_label',
        'label' => 'Promo label',
        'description' => 'F.e. label form discount or promo info',
        'desc_tip' => 'true'
    ));

    echo '</div>';

    /**
     * Product creator
     */
    echo '<div class="options_group author">';

    // External Url
    woocommerce_wp_text_input(array (
        'id' => '_product_creator_id',
        'label' => 'Product creator id',
        'description' => 'Who created product user id',
        'desc_tip' => 'true'
    ));

    echo '</div>';

    /**
     * Extra details
     */
    echo '<div class="options_group extra_details">';

    // External Url
    woocommerce_wp_textarea_input(array (
        'id' => '_extra_details',
        'label' => 'Extra details about product',
        'description' => 'F.e. when, why, who created product',
        'desc_tip' => 'true',
        'rows' => '20'
    ));

    echo '</div>';
}

/**
 * Save data
 */
add_action('woocommerce_admin_process_product_object', 'growtype_woocommerce_admin_process_product_object_advanced');
function growtype_woocommerce_admin_process_product_object_advanced($product)
{
    /**
     * Add to cart button custom text
     */
    if (isset($_POST['_add_to_cart_button_custom_text'])) {
        $product->update_meta_data('_add_to_cart_button_custom_text', $_POST['_add_to_cart_button_custom_text']);
    }

    /**
     * Instant checkout
     */
    $product->update_meta_data('_instant_checkout_enabled', $_POST['_instant_checkout_enabled'] ?? false);

    /**
     * Only as single purchase
     */
    $product->update_meta_data('_only_as_single_purchase', $_POST['_only_as_single_purchase'] ?? false);

    /**
     * Img placeholder
     */
    $product->update_meta_data('_img_placeholder_enabled', $_POST['_img_placeholder_enabled'] ?? false);

    /**
     * Hide price
     */
    $product->update_meta_data('_hide_product_price', $_POST['_hide_product_price'] ?? false);

    /**
     * Extra details about price
     */
    if (isset($_POST['_price_details'])) {
        $product->update_meta_data('_price_details', stripslashes($_POST['_price_details']));
    }

    /**
     * Extra details about price
     */
    if (isset($_POST['_promo_label'])) {
        $product->update_meta_data('_promo_label', stripslashes($_POST['_promo_label']));
    }

    /**
     * Extra details
     */
    if (isset($_POST['_extra_details'])) {
        $product->update_meta_data('_extra_details', stripslashes($_POST['_extra_details']));
    }

    /**
     * Preview style
     */
    if (isset($_POST['_preview_style'])) {
        $product->update_meta_data('_preview_style', $_POST['_preview_style']);
    }

    /**
     * Product creator id
     */
    if (empty($product->get_meta('_product_creator_id')) && $product->get_date_modified() == $product->get_date_created()) {
        $product->update_meta_data('_product_creator_id', get_current_user_id());
    } elseif (isset($_POST['_product_creator_id'])) {
        $product->update_meta_data('_product_creator_id', $_POST['_product_creator_id']);
    }
}


<?php

/**
 * Product preview
 */
add_filter('woocommerce_blocks_product_grid_item_html', 'woocommerce_blocks_product_grid_item_html_custom', 9999, 3);
function woocommerce_blocks_product_grid_item_html_custom($content, $data, $product)
{
    $preview_style = get_post_meta($product->get_id(), '_preview_style', true);

    $data->classes = [];

    if ($preview_style === 'plan') {
        /**
         * Remove placeholder image
         */
        if (str_contains($data->image, 'placeholder')) {
            $data->image = null;
        }

        $data->description = $product->get_short_description();
        $data->classes[] = 'wc-block-grid__product_plan';
    }

    /**
     * Change button text if different
     */
    $default_add_to_cart_text = '';
    $default_add_to_cart_text = apply_filters('woocommerce_product_single_add_to_cart_text', $default_add_to_cart_text);

    if (!empty(get_add_to_cart_btn_text($product))) {
        $data->button = str_replace($default_add_to_cart_text, get_add_to_cart_btn_text($product), $data->button);
    }

    $price_disabled = get_post_meta($product->get_id(), '_hide_product_price', true);

    if ($price_disabled) {
        $data->price = null;
    }

    if (product_preview_cta_disabled() && $preview_style !== 'plan') {
        $data->button = null;
    }

    return \App\template('woocommerce.blocks.product-preview', ['data' => $data]);
}

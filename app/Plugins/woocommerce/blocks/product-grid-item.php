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

    if (!empty(Growtype_Product::get_add_to_cart_btn_text($product))) {
        $data->button = str_replace($default_add_to_cart_text, Growtype_Product::get_add_to_cart_btn_text($product), $data->button);
    }

    if (Growtype_Product::price_is_hidden($product->get_id())) {
        $data->price = null;
    }

    if (Growtype_Product::product_preview_cta_disabled() && $preview_style !== 'plan') {
        $data->button = null;
    }

    /**
     * Promo label
     */
    if (!empty(Growtype_Product::get_promo_label_formatted($product->get_id()))) {
        $data->promo_label = Growtype_Product::get_promo_label_formatted($product->get_id());
    }

    /**
     * Price details
     */
    $price_details = Growtype_Product::get_price_details($product->get_id());

    if (!empty($price_details)) {
        $data->price_details = $price_details;
    }

    return \App\template('woocommerce.blocks.product-preview', ['data' => $data]);
}

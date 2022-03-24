<?php
/**
 * Bid increment
 */
add_action('growtype_form_wc_crud_product_update', 'growtype_growtype_form_wc_crud_product_update', 10, 3);
function growtype_growtype_form_wc_crud_product_update($product, $product_data)
{
    $auction_bid_increment = get_post_meta($product->get_id(), '_auction_bid_increment', true);
    $regular_price = $product_data['data']['_regular_price'] ?? null;
    $price_per_unit_buy_now = $product_data['data']['_price_per_unit_buy_now'] ?? null;

    if (empty($auction_bid_increment)) {
        $product->update_meta_data('_auction_bid_increment', Growtype_Auction::bid_increase_value());
    }

    if (empty($regular_price)) {
        $amount_in_units = $product_data['data']['_amount_in_units'] ?? null;
        if (!empty($price_per_unit_buy_now) && !empty($amount_in_units)) {
            $regular_price = $price_per_unit_buy_now * $amount_in_units;
        }
    }

    if (!empty($regular_price)) {
        update_post_meta($product->get_id(), '_regular_price', wc_format_decimal(wc_clean($regular_price)));
        update_post_meta($product->get_id(), '_price', wc_format_decimal(wc_clean($regular_price)));
    }

    return $product;
}

/**
 * Customizer default sorting
 */
add_filter('woocommerce_default_catalog_orderby_options', 'growtype_woocommerce_default_catalog_orderby_options');
function growtype_woocommerce_default_catalog_orderby_options($options)
{
    $options['auction_end'] = esc_html__('Sort auction by ending soonest', 'wc_simple_auctions');

    return $options;
}

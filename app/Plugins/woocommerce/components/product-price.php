<?php

/**
 * Show smaller price for variable product
 */
add_filter('woocommerce_variable_sale_price_html', 'wc_shop_variable_product_price', 10, 2);
add_filter('woocommerce_variable_price_html', 'wc_shop_variable_product_price', 10, 2);
function wc_shop_variable_product_price($price, $product)
{
    $variation_min_reg_price = $product->get_variation_regular_price('min', true);
    $variation_min_sale_price = $product->get_variation_sale_price('min', true);
    if ($product->is_on_sale() && !empty($variation_min_sale_price)) {
        if (!empty($variation_min_sale_price)) {
            $price = '<del class="strike">' . wc_price($variation_min_reg_price) . '</del>
        <ins class="highlight">' . wc_price($variation_min_sale_price) . '</ins>';
        }
    } else {
        if (!empty($variation_min_reg_price)) {
            $price = '<ins class="highlight">' . wc_price($variation_min_reg_price) . '</ins>';
        } else {
            $price = '<ins class="highlight">' . wc_price($product->regular_price) . '</ins>';
        }
    }
    return $price;
}

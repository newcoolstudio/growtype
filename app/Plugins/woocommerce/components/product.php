<?php

/**
 * Main title
 */

if (get_theme_mod('catalog_featured_intro_enabled')) {
    add_filter('woocommerce_before_shop_loop', 'wc_catalog_featured_intro', 5);
}

function catalog_featured_intro_enabled()
{
    global $wp_query;
    $cat = $wp_query->get_queried_object();

    $featured_image = null;

    if (isset($cat->term_id)) {
        $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
        $featured_image = wp_get_attachment_url($thumbnail_id);
    }

    if (empty($featured_image)) {
        $shopPage = get_post(wc_get_page_id('shop'));
        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($shopPage->ID), 'large')[0] ?? '';
    }

    if (!empty($featured_image)) {
        ?>
        <div class="shop-header-featured" style="background: url(<?php echo $featured_image ?>);background-position: center;background-size: cover;"></div>
        <?php
    }

}

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

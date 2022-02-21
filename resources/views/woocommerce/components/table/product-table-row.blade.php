<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Check if visability is set with shortcode function
 */
if (get_query_var('visibility') === 'any') {
    $is_visible = true;
} else {
    $is_visible = $product->is_visible();
}

/**
 * Ensure visability
 */
if (empty($product) || !$is_visible) {
    return;
}

/**
 * Remove firs,last classes
 */
$classes = wc_get_product_class(get_theme_mod('woocommerce_product_preview_style'), $product);

/**
 * Cta disabled class
 */
if (Growtype_Product::product_preview_cta_disabled() && !get_query_var('cta_btn')) {
    array_push($classes, 'cta-disabled');
}

/**
 * Add auction classes
 */
if (Growtype_Auction::has_started()) {
    array_push($classes, 'auction-has-started');
}

$classes = implode(' ', $classes);

if ($filterClasses ?? '') {
    $classes = str_replace('first', '', $classes);
    $classes = str_replace('last', '', $classes);
}

$classes = 'class="' . $classes . '"';
?>

@include('woocommerce.components.table.product-table-row-content')

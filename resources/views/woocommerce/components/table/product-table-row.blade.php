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
if (get_query_var('is_visible') === 'any') {
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

<tr {!! $classes !!}>
    <td>
        {{ do_action('woocommerce_before_shop_loop_item') }}
    </td>
    <td>
        <div class="e-img" style="{!! get_featured_image_tag(get_post()) !!}"></div>
    </td>
    <td>
        <a class="e-title e-heading" href="{!! get_permalink($product->get_id()) !!}">{!! $product->get_title() !!}</a>
        <div class="e-details e-description">
            <span>{!! Growtype_Product::amount_in_units_formatted() !!}</span>
            <span class="e-separator">•</span>
            <span>{!! Growtype_Product::volume_formatted() !!}</span>
        </div>
    </td>
    <td>
        <div class="e-heading">{!! Growtype_Auction::price_per_unit_formatted() !!}</div>
        <div class="e-description">{!! __('Price per bottle', 'growtype') !!}</div>
    </td>
    <td>
        <div class="e-heading">{!! Growtype_Auction::bid_value_formatted() !!}</div>
        <div class="e-description">{!! __('Full price', 'growtype') !!}</div>
    </td>
    <td>
        <div class="e-heading">{!! Growtype_Auction::buy_now_price_formatted() !!}</div>
        <div class="e-description">{!! __('Buy now price', 'growtype') !!}</div>
    </td>
    <td>
        @if (Growtype_Auction::has_started())
            <div class="e-heading">{!! Growtype_Auction::time_remaining() !!}</div>
            <div class="e-description">{!! __('Time left until end', 'growtype') !!}</div>
        @else
            <div class="e-heading">{!! Growtype_Auction::time_to_auction() !!}</div>
            <div class="e-description">{!! __('Time left until start', 'growtype') !!}</div>
        @endif
    </td>
    <td>
        <div class="e-heading">{!! Growtype_Auction::duration_formatted() !!}</div>
        <div class="e-description">{!! __('Auction duration', 'growtype') !!}</div>
    </td>
</tr>

<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

@if(is_single())
    @php
        $customizer_preview_style = !get_theme_mod('woocommerce_product_page_related_products_preview_style') ? 'grid' : get_theme_mod('woocommerce_product_page_related_products_preview_style');
        $preview_style_class = 'preview-style--' . (isset($preview_style) && !empty($preview_style) ? $preview_style : $customizer_preview_style);
    @endphp
@else
    @php
        $customizer_preview_style = !get_theme_mod('wc_catalog_products_preview_style') ? 'grid' : get_theme_mod('wc_catalog_products_preview_style');
        $preview_style_class = 'preview-style--' . (isset($preview_style) && !empty($preview_style) ? $preview_style : $customizer_preview_style);
    @endphp
@endif

<ul class="products columns-<?php echo esc_attr(wc_get_loop_prop('columns')); ?> {!! $preview_style_class !!}" data-group="{!! $products_group ?? 'default' !!}">

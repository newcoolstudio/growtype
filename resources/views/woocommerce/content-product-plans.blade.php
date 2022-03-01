<?php
defined('ABSPATH') || exit;

global $product;

/**
 * Check if visibility is set with shortcode function
 */
if (get_query_var('visibility') === 'any') {
    $is_visible = true;
} else {
    $is_visible = $product->is_visible();
}

/**
 * Remove firs,last classes
 */
$classes = wc_get_product_class(get_theme_mod('woocommerce_product_preview_style'), $product);
$classes = implode(' ', $classes);

if ($filterClasses ?? '') {
    $classes = str_replace('first', '', $classes);
    $classes = str_replace('last', '', $classes);
}

$classes = 'class="' . $classes . '"';

?>
<li {!! $classes !!}>
    <div class="content-wrapper">
        {!! Growtype_Product::get_promo_label_formatted($product->get_id()) !!}

        <?php do_action('woocommerce_shop_loop_item_title'); ?>

        <div class="b-details">
            <div class="b-price-details">
                <?php echo get_the_excerpt($product->get_id()) ?>
            </div>
            @if(!Growtype_Product::price_is_hidden($product->get_id()))
                <div class="price-wrapper">
                    <?php do_action('woocommerce_after_shop_loop_item_title');?>
                    @if(!empty(Growtype_Product::get_price_details()))
                        <span class="price-details">{!! Growtype_Product::get_price_details() !!}</span>
                    @endif
                </div>
            @endif
        </div>

        <?php echo get_the_content($product->get_id()) ?>

        {{ woocommerce_template_loop_add_to_cart() }}
    </div>
</li>

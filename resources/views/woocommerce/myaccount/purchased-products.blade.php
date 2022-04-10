<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_account_purchased_products');

$products = do_shortcode('[products_growtype ids="' . $products_ids . '"]');
?>

@if(!empty($products))
    {!! do_shortcode('[products_growtype ids="'.$products_ids.'" visibility="any"]') !!}
@else
    @include('partials.content.404.general', ['subtitle' => __('You have no products purchased.', 'growtype')])
@endif

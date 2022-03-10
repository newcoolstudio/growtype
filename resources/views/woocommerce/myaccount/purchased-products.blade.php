<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_account_purchased_products');
?>

@if(!empty($products_ids))
    <p>{!! __('Below you can see your purchased products:', 'growtype') !!}</p>
    {!! do_shortcode('[products ids="'.$products_ids.'"]') !!}
@else
    @include('partials.content.404.general', ['subtitle' => __('You have no products purchased.', 'growtype')])
@endif

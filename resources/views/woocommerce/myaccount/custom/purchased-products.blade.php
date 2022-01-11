<?php
defined('ABSPATH') || exit;
?>

@if(!empty($products_ids))
    <p>{!! __('Below you can see your purchased products:', 'growtype') !!}</p>
    {!! do_shortcode('[products ids="'.$products_ids.'"]') !!}
@else
    <p>{!! __('You have no products purchased.', 'growtype') !!}</p>
@endif

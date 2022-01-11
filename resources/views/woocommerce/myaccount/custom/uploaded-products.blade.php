<?php
defined('ABSPATH') || exit;
?>

@if(!empty($products_ids))
    <p>{!! __('Below you can see your uploaded products:', 'growtype') !!}</p>
    {!! do_shortcode('[products_custom ids="'.$products_ids.'" type="edit"]') !!}
@else
    <p>{!! __('You have no products uploaded.', 'growtype') !!}</p>
@endif

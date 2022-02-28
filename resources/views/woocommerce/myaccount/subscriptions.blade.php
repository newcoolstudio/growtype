<?php
defined('ABSPATH') || exit;

$products = '';

if (!empty($products_ids)) {
    $products = do_shortcode('[products_growtype ids="' . $products_ids . '" visibility="any" products_group="' . ($products_group ?? null) . '" preview_style="subscription"]');
}

?>

@if(!empty($products))
    {!! $products !!}
@endif

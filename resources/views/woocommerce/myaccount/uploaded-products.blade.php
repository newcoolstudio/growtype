<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_account_uploaded_products');

$uploaded_product_content = '';

if (!empty($products_ids)) {
    $uploaded_product_content = do_shortcode('[products_growtype ids="' . $products_ids . '" visibility="any" products_group="' . ($products_group ?? null) . '" edit_product="true" preview_style="table" before_shop_loop="true"]');
}

?>

@if(!empty($uploaded_product_content))
    {!! $uploaded_product_content !!}
@else
    @include('partials.content.404.general', ['cta' => class_exists('Growtype_Form') ? '<a href="'.growtype_form_product_upload_page_url().'" class="btn btn-primary mt-3">'.__('Upload a new product','growtype').'</a>' : '', 'subtitle' => __('You have no products uploaded.','growtype')])
@endif

<?php
defined('ABSPATH') || exit;

$uploaded_product_content = '';

if (!empty($products_ids)) {
    $uploaded_product_content = do_shortcode('[products_growtype ids="' . $products_ids . '" visibility="any" edit_product="true" preview_style="table" before_shop_loop="true"]');
}

?>

@if(!empty($uploaded_product_content))
    {!! $uploaded_product_content !!}
@else
    <p>{!! __('You have no uploaded content yet.','growtype') !!}</p>

    @if(class_exists('Growtype_Form'))
        <a href="{!! growtype_form_product_upload_page_url() !!}" class="btn btn-primary mt-3">{!! __('Upload a new product','growtype') !!}</a>
    @endif
@endif

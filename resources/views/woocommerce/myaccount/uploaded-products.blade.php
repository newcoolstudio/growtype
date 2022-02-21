<?php
defined('ABSPATH') || exit;

$uploaded_product_content = '';

if (!empty($products_ids)) {
    $uploaded_product_content = do_shortcode('[products_growtype ids="' . $products_ids . '" visibility="any" products_group="' . ($products_group ?? null) . '" edit_product="true" preview_style="table" before_shop_loop="true"]');
}

?>

@if(!empty($uploaded_product_content))
    {!! $uploaded_product_content !!}
@else
    @if(class_exists('Growtype_Form'))
        @php
            $extra_data['cta'] = '<a href="'.growtype_form_product_upload_page_url().'" class="btn btn-primary mt-3">'.__('Upload a new product','growtype').'</a>';
        @endphp
    @endif
    @include('partials.content.404.general', $extra_data ?? null)
@endif

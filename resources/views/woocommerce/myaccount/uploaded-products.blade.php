<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_account_uploaded_products');

$not_found_cta = class_exists('Growtype_Form') ? '<a href="' . Growtype_Product::upload_page_url() . '" class="btn btn-primary mt-3">' . __('Upload a new product',
        'growtype') . '</a>' : '';
?>

{!! do_shortcode('[products_growtype ids="' . $products_ids . '" visibility="any" products_group="' . $products_group . '" edit_product="true" preview_style="table" before_shop_loop="true" not_found_subtitle="'.__('You have no products uploaded.','growtype').'" not_found_cta="'.urlencode($not_found_cta).'"]') !!}

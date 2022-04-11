<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_account_purchased_products');

?>

{!! do_shortcode('[products_growtype ids="'.$products_ids.'" visibility="any" not_found_subtitle="'.__('You have no products purchased.', 'growtype').'"]') !!}

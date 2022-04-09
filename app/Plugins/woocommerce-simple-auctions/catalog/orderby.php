<?php

/**
 * Customizer default sorting
 */
add_filter('woocommerce_default_catalog_orderby_options', 'growtype_woocommerce_default_catalog_orderby_options');
function growtype_woocommerce_default_catalog_orderby_options($options)
{
    $options['auction_end'] = esc_html__('Sort auction by ending soonest', 'wc_simple_auctions');

    return $options;
}

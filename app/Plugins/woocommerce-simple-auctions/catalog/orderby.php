<?php

/**
 * Customizer default sorting
 */
add_filter('woocommerce_default_catalog_orderby_options', 'growtype_woocommerce_simple_auction_default_catalog_orderby_options');
function growtype_woocommerce_simple_auction_default_catalog_orderby_options($options)
{
    $options['ending_soonest'] = esc_html__('Sort auction by ending soonest', 'growtype');

    return $options;
}

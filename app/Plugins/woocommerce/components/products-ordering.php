<?php

/**
 * @param $orderby
 * @return mixed
 * Edit WooCommerce orderby dropdown menu items of shop page
 */
function my_woocommerce_catalog_orderby($orderby)
{
    $disabled_options = explode(',', get_theme_mod('catalog_orderby_switch_disabled_options')) ?? null;

    if (!empty($disabled_options)) {
        foreach ($disabled_options as $option) {
            unset($orderby[$option]);
        }
    }

    return $orderby;
}

add_filter("woocommerce_catalog_orderby", "my_woocommerce_catalog_orderby", 20);

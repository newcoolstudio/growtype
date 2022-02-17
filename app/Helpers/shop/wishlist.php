<?php

/**
 * @return bool
 */
function wishlist_page_icon()
{
    $disabled = get_theme_mod('woocommerce_wishlist_page_icon_disabled') ?? false;

    return class_exists( 'woocommerce' ) && !$disabled ? true : false;
}

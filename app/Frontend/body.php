<?php

/**
 * Add classes to body
 */
add_filter('body_class', 'add_extra_classes_to_body');
function add_extra_classes_to_body($classes)
{
    $classes[] = get_theme_mod('header_navbar_switch') == true ? 'has-navbar' : null;
    $classes[] = Growtype_Header::is_fixed() === true ? 'has-fixed-header' : 'has-static-header';
    $classes[] = 'header-' . get_theme_mod('header_type_select');
    $classes[] = header_has_extra_space() === true ? 'has-extraspace-header' : null;
    $classes[] = display_panel() ? 'has-panel' : null;
    $classes[] = display_sidebar_primary() ? 'has-sidebar-primary' : null;
    $classes[] = display_shop_catalog_sidebar() ? 'has-sidebar-catalog' : null;
    $classes[] = Growtype_Product::sidebar() ? 'has-sidebar-product' : null;
    $classes[] = Growtype_Post::is_front() ? 'is-front-post' : null;
    $classes[] = header_is_absolute() ? 'has-absolute-header' : null;
    $classes[] = Growtype_Header::is_fixed() ? 'has-fixed-header' : null;
    $classes[] = get_theme_mod('burger_always_visible') ? 'has-always-visible-burger' : null;
    $classes[] = Growtype_Header::has_promo() ? 'has-promo-header' : null;
    $classes[] = is_main_site() ? 'is-main-site' : null;

    if (class_exists('woocommerce')) {
        if (is_account_page()) {
            $url_slug = Growtype_Post::get_url_slug();
            $classes[] = 'page-' . $url_slug;
        }

        if (get_option('woocommerce_cart_redirect_after_add') !== 'yes') {
            $classes[] = 'ajaxcart-enabled';
        }
    }

    return $classes;
}

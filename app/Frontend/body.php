<?php

/**
 * Add classes to body
 */
add_filter('body_class', 'growtype_extend_body_classes');
function growtype_extend_body_classes($classes)
{
    $classes[] = get_theme_mod('header_navbar_switch') === true ? 'has-navbar' : null;
    $classes[] = 'header-' . growtype_get_header_type();
    $classes[] = growtype_header_has_extra_space() === true ? 'has-extraspace-header' : null;
    $classes[] = growtype_display_panel() ? 'has-panel' : null;
    $classes[] = display_sidebar_primary() ? 'has-sidebar-primary' : null;
    $classes[] = function_exists('growtype_post_is_front_post') && growtype_post_is_front_post() ? 'is-front-post' : null;
    $classes[] = growtype_header_is_absolute() ? 'has-absolute-header' : null;
    $classes[] = Growtype_Header::is_fixed() ? 'has-fixed-header' : 'has-static-header';
    $classes[] = get_theme_mod('burger_always_visible') ? 'has-always-visible-burger' : null;
    $classes[] = Growtype_Header::has_promo() ? 'has-promo-header' : null;
    $classes[] = get_theme_mod('header_hide_on_scroll_down') === true ? 'header-hide-onscroll' : null;

    if (is_multisite()) {
        $classes[] = Growtype_Site::is_multisite_main_site() ? 'is-main-site' : 'is-child-site';
    }

    return $classes;
}

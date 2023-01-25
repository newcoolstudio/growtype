<?php

/**
 * @return false|mixed
 */
if (!function_exists('growtype_get_header_type')) {
    function growtype_get_header_type()
    {
        return !empty(get_theme_mod('header_type_select')) ? get_theme_mod('header_type_select') : 'type-1';
    }
}

/**
 * @return false|mixed
 */
if (!function_exists('growtype_header_is_absolute')) {
    function growtype_header_is_absolute()
    {
        $absoluteHeader = !empty(get_theme_mod('header_is_absolute_switch')) ? get_theme_mod('header_is_absolute_switch') : false;

        return $absoluteHeader;
    }
}

/**
 * @return bool
 */
if (!function_exists('growtype_header_is_enabled')) {
    function growtype_header_is_enabled()
    {
        $disabled = !empty(get_theme_mod('header_is_disabled')) ? get_theme_mod('header_is_disabled') : false;

        return $disabled === true ? false : true;
    }
}

/**
 * @return bool
 */
if (!function_exists('growtype_header_has_extra_space')) {
    function growtype_header_has_extra_space()
    {
        $has_extra_space = !empty(get_theme_mod('header_extra_space_switch')) ? get_theme_mod('header_extra_space_switch') : false;
        $extra_space_disabled_pages = get_theme_mod('extra_space_disabled_dropdown_control');

        if ($has_extra_space && !empty($extra_space_disabled_pages)) {
            $has_extra_space = page_is_among_enabled_pages($extra_space_disabled_pages) ? false : true;
        }

        return $has_extra_space === true ? true : false;
    }
}

/**
 * @return bool
 * Check if login menu is enabled
 */
if (!function_exists('growtype_header_login_menu_is_enabled')) {
    function growtype_header_login_menu_is_enabled()
    {
        return get_theme_mod('login_menu_enabled');
    }
}

/**
 * @return bool
 * Check if login menu is enabled
 */
if (!function_exists('growtype_header_mobile_menu_is_enabled')) {
    function growtype_header_mobile_menu_is_enabled()
    {
        return !get_theme_mod('mobile_menu_disabled');
    }
}

/**
 * @return bool
 * Check if main menu is enabled
 */
if (!function_exists('growtype_header_main_menu_is_enabled')) {
    function growtype_header_main_menu_is_enabled()
    {
        $enabled = has_nav_menu('header');
        $header_menu_enabled_pages = get_theme_mod('header_menu_enabled_pages');

        if ($enabled && !empty($header_menu_enabled_pages)) {
            $enabled = page_is_among_enabled_pages($header_menu_enabled_pages);
        }

        return $enabled === true ? true : false;
    }
}

/**
 * @return bool
 * Check if main menu is enabled
 */
if (!function_exists('growtype_mobile_menu_burger_color')) {
    function growtype_mobile_menu_burger_color()
    {
        $colors_scheme = growtype_get_theme_current_colors_scheme();
        return get_theme_mod('mobile_menu_burger_color', $colors_scheme['mobile_menu_burger_color']);
    }
}


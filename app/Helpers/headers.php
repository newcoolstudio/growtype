<?php

/**
 * @return false|mixed
 */
function header_is_absolute()
{
    $absoluteHeader = !empty(get_theme_mod('header_is_absolute_switch')) ? get_theme_mod('header_is_absolute_switch') : false;

    return $absoluteHeader;
}

/**
 * @return bool
 */
function header_is_enabled()
{
    $disabled = !empty(get_theme_mod('header_is_disabled')) ? get_theme_mod('header_is_disabled') : false;

    return $disabled === true ? false : true;
}

/**
 * @return bool
 */
function header_has_extra_space()
{
    $has_extra_space = !empty(get_theme_mod('header_extra_space_switch')) ? get_theme_mod('header_extra_space_switch') : false;
    $extra_space_disabled_pages = get_theme_mod('extra_space_disabled_dropdown_control');

    if ($has_extra_space && !empty($extra_space_disabled_pages)) {
        $has_extra_space = page_is_among_enabled_pages($extra_space_disabled_pages) ? false : true;
    }

    return $has_extra_space === true ? true : false;
}

/**
 * @return bool
 * Check if login menu is enabled
 */
function header_login_menu_is_enabled()
{
    return get_theme_mod('login_menu_enabled');
}

/**
 * @return bool
 * Check if login menu is enabled
 */
function header_mobile_menu_is_enabled()
{
    return !get_theme_mod('mobile_menu_disabled');
}

/**
 * @return bool
 * Check if main menu is enabled
 */
function header_main_menu_is_enabled()
{
    $enabled = has_nav_menu('header');
    $header_menu_enabled_pages = get_theme_mod('header_menu_enabled_pages');

    if ($enabled && !empty($header_menu_enabled_pages)) {
        $enabled = page_is_among_enabled_pages($header_menu_enabled_pages);
    }

    return $enabled === true ? true : false;
}


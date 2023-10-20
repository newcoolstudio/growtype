<?php

/**
 * Primary button main color
 */
if (!function_exists('growtype_theme_color')) {
    function growtype_theme_color()
    {
        $colors_scheme = growtype_get_theme_current_colors_scheme();
        return get_theme_mod('main_color', isset($colors_scheme['main_color']) ? $colors_scheme['main_color'] : 'black');
    }
}

/**
 * Primary button main color
 */
if (!function_exists('growtype_primary_button_border_radius')) {
    function growtype_primary_button_border_radius()
    {
        $colors_scheme = growtype_get_theme_current_colors_scheme();
        return get_theme_mod('button_border_radius', isset($colors_scheme['button_border_radius']) ? $colors_scheme['button_border_radius'] : '5px');
    }
}

/**
 * Primary button main color
 */
if (!function_exists('growtype_primary_button_main_color')) {
    function growtype_primary_button_main_color()
    {
        $colors_scheme = growtype_get_theme_current_colors_scheme();
        return get_theme_mod('primary_button_main_color', $colors_scheme['primary_button_main_color']);
    }
}

/**
 * Primary button text color
 */
if (!function_exists('growtype_primary_button_text_color')) {
    function growtype_primary_button_text_color()
    {
        $colors_scheme = growtype_get_theme_current_colors_scheme();
        return get_theme_mod('primary_button_text_color', $colors_scheme['primary_button_text_color']);
    }
}

/**
 * Primary button background color
 */
if (!function_exists('growtype_primary_button_background_color')) {
    function growtype_primary_button_background_color()
    {
        $colors_scheme = growtype_get_theme_current_colors_scheme();
        return get_theme_mod('primary_button_background_color', $colors_scheme['primary_button_background_color']);
    }
}

/**
 * Secondary button main color
 */
if (!function_exists('growtype_secondary_button_background_color')) {
    function growtype_secondary_button_background_color()
    {
        $colors_scheme = growtype_get_theme_current_colors_scheme();
        return get_theme_mod('secondary_button_background_color', $colors_scheme['secondary_button_background_color']);
    }
}

/**
 * Secondary button main color
 */
if (!function_exists('growtype_secondary_button_text_color')) {
    function growtype_secondary_button_text_color()
    {
        $colors_scheme = growtype_get_theme_current_colors_scheme();
        return get_theme_mod('secondary_button_text_color', $colors_scheme['secondary_button_text_color']);
    }
}

/**
 * Secondary button main color
 */
if (!function_exists('growtype_secondary_button_text_color_active')) {
    function growtype_secondary_button_text_color_active()
    {
        $colors_scheme = growtype_get_theme_current_colors_scheme();
        return get_theme_mod('secondary_button_text_color_active', $colors_scheme['secondary_button_text_color_active']);
    }
}

/**
 * Secondary button main color
 */
if (!function_exists('growtype_secondary_button_border_color')) {
    function growtype_secondary_button_border_color()
    {
        $colors_scheme = growtype_get_theme_current_colors_scheme();
        return get_theme_mod('secondary_button_border_color', $colors_scheme['secondary_button_border_color']);
    }
}

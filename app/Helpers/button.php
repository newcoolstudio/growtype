<?php

/**
 *
 */
if (!function_exists('growtype_primary_button_main_color')) {
    function growtype_primary_button_main_color()
    {
        $colors_scheme = growtype_get_theme_current_colors_scheme();
        return get_theme_mod('primary_button_main_color', $colors_scheme['primary_button_main_color']);
    }
}

/**
 *
 */
if (!function_exists('growtype_primary_button_text_color')) {
    function growtype_primary_button_text_color()
    {
        $colors_scheme = growtype_get_theme_current_colors_scheme();
        return get_theme_mod('primary_button_text_color', $colors_scheme['primary_button_text_color']);
    }
}

/**
 *
 */
if (!function_exists('growtype_primary_button_background_color')) {
    function growtype_primary_button_background_color()
    {
        $colors_scheme = growtype_get_theme_current_colors_scheme();
        return get_theme_mod('primary_button_background_color', $colors_scheme['primary_button_background_color']);
    }
}

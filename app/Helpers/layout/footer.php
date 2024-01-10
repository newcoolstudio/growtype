<?php

/**
 *
 */
if (!function_exists('growtype_get_footer_type')) {
    function growtype_get_footer_type()
    {
        return !empty(get_theme_mod('footer_type_select')) ? get_theme_mod('footer_type_select') : 'type-1';
    }
}

if (!function_exists('growtype_get_footer_bg_color')) {
    function growtype_get_footer_bg_color()
    {
        $colors_scheme = growtype_get_theme_current_colors_scheme();
        return get_theme_mod('footer_background_color', $colors_scheme['footer_background_color']);
    }
}

if (!function_exists('growtype_get_footer_text_color')) {
    function growtype_get_footer_text_color()
    {
        $colors_scheme = growtype_get_theme_current_colors_scheme();
        return get_theme_mod('footer_text_color', $colors_scheme['footer_text_color']);
    }
}

if (!function_exists('growtype_get_footer_copyright')) {
    function growtype_get_footer_copyright()
    {
        $content = get_theme_mod('footer_copyright', '© 2020 Company Name. Trademarks and brands are the property of their respective owners.');
        $content = str_replace('{year}', date('Y'), $content);

        return !empty($content) ? apply_filters('the_content', $content) : $content;
    }
}

/**
 *
 */
if (!function_exists('growtype_get_footer_extra_content')) {
    function growtype_get_footer_extra_content()
    {
        $content = get_theme_mod('footer_extra_content', '');
        return !empty($content) ? apply_filters('the_content', $content) : $content;
    }
}

if (!function_exists('growtype_get_footer_credits')) {
    function growtype_get_footer_credits()
    {
        $theme_general_credits_content = get_theme_mod('theme_general_credits_content');

        if (!empty($theme_general_credits_content)) {
            return apply_filters('the_content', $theme_general_credits_content);
        }

        return __('Created by - newcoolstudio.com', 'growtype');
    }
}

/**
 *
 */
if (!function_exists('growtype_footer_is_enabled')) {
    function growtype_footer_is_enabled()
    {
        return get_theme_mod('footer_is_enabled', true);
    }
}

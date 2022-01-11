<?php

/**
 * @return array
 */
function get_fonts_details()
{
    $primaryFontDetails = json_decode(get_theme_mod('primary_font_select'));
    $secondaryFontDetails = json_decode(get_theme_mod('secondary_font_select'));
    $secondaryFontSwitch = get_theme_mod('secondary_font_select_switch');

    $fonts = [
        'primaryFontDetails' => $primaryFontDetails,
        'secondaryFontDetails' => $secondaryFontDetails,
        'secondaryFontSwitch' => $secondaryFontSwitch,
    ];

    return $fonts;
}

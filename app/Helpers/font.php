<?php

/**
 * @param $font_type
 * @return mixed
 */
function growtype_get_font_details($font_type)
{
    $primaryFontDetails = json_decode(get_theme_mod('primary_font_select'));
    $secondaryFontDetails = json_decode(get_theme_mod('secondary_font_select'));
    $secondaryFontSwitch = get_theme_mod('secondary_font_select_switch');

    $fonts = [
        'primary_font' => $primaryFontDetails,
        'secondary_font' => $secondaryFontDetails
    ];

    return $fonts[$font_type];
}

/**
 * @return mixed
 */
function growtype_secondary_font_is_active()
{
    return !empty(get_theme_mod('secondary_font_select_switch')) && get_theme_mod('secondary_font_select_switch') === true ? true : false;
}

/**
 * @return array
 */
function growtype_get_font_url($font_details)
{
    $google_font_url = 'https://fonts.googleapis.com/css?family=' . urlencode($font_details->font) . ':';
    $google_font_url_weights = [];

    if (growtype_get_font_details('primary_font')->lightweight !== 'none') {
        $google_font_url_weights[] = urlencode($font_details->lightweight);
    }

    if (growtype_get_font_details('primary_font')->regularweight !== 'none') {
        $google_font_url_weights[] = urlencode($font_details->regularweight);
    }

    if (growtype_get_font_details('primary_font')->semiboldweight !== 'none') {
        $google_font_url_weights[] = urlencode($font_details->semiboldweight);
    }

    if (growtype_get_font_details('primary_font')->boldweight !== 'none') {
        $google_font_url_weights[] = urlencode($font_details->boldweight);
    }

    if (growtype_get_font_details('primary_font')->italicweight !== 'none') {
        $google_font_url_weights[] = urlencode($font_details->italicweight);
    }

    return $google_font_url . implode(',', $google_font_url_weights);
}

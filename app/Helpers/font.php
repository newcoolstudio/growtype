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

    if (isset(growtype_get_font_details('primary_font')->lightweight) && growtype_get_font_details('primary_font')->lightweight !== 'none' && isset($font_details->lightweight)) {
        $google_font_url_weights[] = urlencode($font_details->lightweight);
    }

    if (isset(growtype_get_font_details('primary_font')->regularweight) && growtype_get_font_details('primary_font')->regularweight !== 'none' && isset($font_details->regularweight)) {
        $google_font_url_weights[] = urlencode($font_details->regularweight);
    }

    if (isset(growtype_get_font_details('primary_font')->mediumweight) && growtype_get_font_details('primary_font')->mediumweight !== 'none' && isset($font_details->mediumweight)) {
        $google_font_url_weights[] = urlencode($font_details->mediumweight);
    }

    if (isset(growtype_get_font_details('primary_font')->semiboldweight) && growtype_get_font_details('primary_font')->semiboldweight !== 'none' && isset($font_details->semiboldweight)) {
        $google_font_url_weights[] = urlencode($font_details->semiboldweight);
    }

    if (isset(growtype_get_font_details('primary_font')->boldweight) && growtype_get_font_details('primary_font')->boldweight !== 'none' && isset($font_details->boldweight)) {
        $google_font_url_weights[] = urlencode($font_details->boldweight);
    }

    if (isset(growtype_get_font_details('primary_font')->italicweight) && growtype_get_font_details('primary_font')->italicweight !== 'none' && isset($font_details->italicweight)) {
        $google_font_url_weights[] = urlencode($font_details->italicweight);
    }

    return $google_font_url . implode(',', $google_font_url_weights);
}

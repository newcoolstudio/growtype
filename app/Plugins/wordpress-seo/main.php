<?php

add_filter('wpseo_canonical', 'change_canonical');
function change_canonical($url)
{
    global $post;

    if (function_exists('qtranxf_getLanguage') && is_singular('post')) {
        return get_permalink();
    } else {
        return $url;
    }
}

/**
 * Qtranslate translate
 */
add_filter('wpseo_title', 'qtranslate_filter', 10, 1);
add_filter('wpseo_metadesc', 'qtranslate_filter', 10, 1);
add_filter('wpseo_metakey', 'qtranslate_filter', 10, 1);
add_filter('wpseo_opengraph_title', 'qtranslate_filter', 10, 1);
add_filter('wpseo_opengraph_desc', 'qtranslate_filter', 10, 1);
function qtranslate_filter($text)
{
    return __($text);
}

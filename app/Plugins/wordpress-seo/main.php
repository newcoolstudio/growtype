<?php

add_filter('wpseo_canonical', 'growtype_wpseo_change_canonical');
function growtype_wpseo_change_canonical($url)
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
add_filter('wpseo_title', 'growtype_wpseo_qtranslate_filter', 10, 1);
add_filter('wpseo_metadesc', 'growtype_wpseo_qtranslate_filter', 10, 1);
add_filter('wpseo_metakey', 'growtype_wpseo_qtranslate_filter', 10, 1);
add_filter('wpseo_opengraph_title', 'growtype_wpseo_qtranslate_filter', 10, 1);
add_filter('wpseo_opengraph_desc', 'growtype_wpseo_qtranslate_filter', 10, 1);
function growtype_wpseo_qtranslate_filter($text)
{
    return __($text);
}

/**
 * Hide promo
 */
add_action('admin_head', 'growtype_wpseo_admin_head');
function growtype_wpseo_admin_head()
{
    echo '<style>.wp-admin .wrap .yoast-notification.notice.is-dismissible {display: none!important;}</style>';
}

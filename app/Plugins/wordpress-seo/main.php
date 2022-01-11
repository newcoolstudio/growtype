<?php

function change_canonical($url)
{
    global $post;

    if (function_exists('qtranxf_getLanguage') && is_singular('post')) {
        return get_permalink();
    } else {
        return $url;
    }
}

add_filter('wpseo_canonical', 'change_canonical');

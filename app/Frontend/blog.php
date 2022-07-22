<?php

/**
 *
 */
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);
function wpdocs_custom_excerpt_length($length)
{
    return 40;
}

/**
 *
 */
add_filter('excerpt_more', 'custom_excerpt_more');
function custom_excerpt_more($more) {
    global $post;
    $more_text = '...';

    return $more_text;
}

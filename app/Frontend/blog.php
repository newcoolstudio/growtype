<?php

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length($length)
{
    return 40;
}

add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);

function custom_excerpt_more($more) {
    global $post;
    $more_text = '...';

    return $more_text;
}
add_filter('excerpt_more', 'custom_excerpt_more');

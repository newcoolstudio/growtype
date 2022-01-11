<?php

/**
 * This function modifies the main WordPress query to include an array of
 * post types instead of the default 'post' post type.
 *
 * @param object $query The main WordPress query.
 */
add_action('pre_get_posts', 'tg_include_custom_post_types_in_search_results');
function tg_include_custom_post_types_in_search_results($query)
{
    $search_post_types = get_theme_mod('search_post_types_enabled');

    if (!empty($search_post_types) && $query->is_main_query() && $query->is_search() && !is_admin()) {
        $query->set('post_type', $search_post_types);
    }
}

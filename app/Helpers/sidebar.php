<?php

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar_primary($display = false)
{
    $sidebar_enabled = !empty(get_theme_mod('sidebar_primary_is_enabled')) ? get_theme_mod('sidebar_primary_is_enabled') : false;
    $sidebar_primary_pages = get_theme_mod('sidebar_primary_pages');

    if ($sidebar_enabled && !empty($sidebar_primary_pages)) {
        global $wp_query;
        $post_id = !empty($wp_query->get_queried_object_id()) ? $wp_query->get_queried_object_id() : (!empty($wp_query->query_vars['page_id']) ? $wp_query->query_vars['page_id'] : get_the_ID());

        $sidebar_primary_pages = explode(",", str_replace(' ', '', $sidebar_primary_pages));
        $sidebar_enabled = in_array($post_id, $sidebar_primary_pages);

        if (is_single()) {
            $sidebar_enabled = in_array('single', $sidebar_primary_pages) || in_array(get_post_type() . '_single', $sidebar_primary_pages);
        }

        $sidebar_enabled = apply_filters('growtype_sidebar_primary_enabled', $sidebar_enabled, $sidebar_primary_pages);
    }

    return $sidebar_enabled;
}

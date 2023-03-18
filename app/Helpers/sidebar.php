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
            $sidebar_enabled = in_array('single', $sidebar_primary_pages);
        }

        /**
         * Bbpress check if forum page included
         */

        if (class_exists('bbpress')) {
            $forum_slug = explode('/', bbp_get_forum_slug())[0] ?? null;
            $forum_page = get_page_by_path($forum_slug);

            if (!empty($forum_page)) {
                $forum_page_enabled = in_array($forum_page->ID, $sidebar_primary_pages);
                if ($forum_page_enabled && str_contains($_SERVER['PHP_SELF'], $forum_slug)) {
                    $sidebar_enabled = true;
                }
            }
        }
    }

    $condition = [
        $sidebar_enabled
    ];

    $display = in_array(true, $condition);

    return $display;
}

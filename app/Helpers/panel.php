<?php

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_panel($display = false)
{
    $panel_enabled = !empty(get_theme_mod('panel_is_enabled')) ? get_theme_mod('panel_is_enabled') : false;
    $panel_enabled_pages = get_theme_mod('panel_enabled_pages');

    if ($panel_enabled && !empty($panel_enabled_pages)) {
        $panel_enabled = page_is_among_enabled_pages($panel_enabled_pages);
    }

    /**
     * Check if user is logged in
     */
    if (!is_user_logged_in()) {
        $panel_enabled = false;
    }

    /**
     * Check conditions
     */
    $condition = [
        $panel_enabled
    ];

    $display = in_array(true, $condition);

    return $display;
}
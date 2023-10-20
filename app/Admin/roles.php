<?php

/**
 * Add extra abilities to roles
 */
add_action('admin_menu', 'growtype_users_roles_update', 10);
function growtype_users_roles_update()
{
    $user = wp_get_current_user();

    if (in_array('editor', (array)$user->roles)) {
        if (!current_user_can('edit_theme_options')) {
            $role_object = get_role('editor');
            $role_object->add_cap('edit_theme_options');
        }
    }
}

/**
 * Enable unfiltered_html capability for Specific users
 * VERY IMPORTANT
 */
add_filter('map_meta_cap', 'growtype_wc_add_unfiltered_html_capability_to_users', 1, 3);
function growtype_wc_add_unfiltered_html_capability_to_users($caps, $cap, $user_id)
{
    if ('unfiltered_html' === $cap && growtype_user_can_edit_frontend()) {
        $caps = array ('unfiltered_html');
    }

    return $caps;
}

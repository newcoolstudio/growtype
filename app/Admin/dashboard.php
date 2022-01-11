<?php

/**
 *
 */
function remove_dashboard_widgets()
{
    $current_user_roles = wp_get_current_user()->roles;

    /**
     * Remove widgets for subscriber role
     */
    if (in_array('subscriber', wp_get_current_user()->roles)) {
        remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Quick Press widget
        remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); //Recent Drafts
        remove_meta_box('dashboard_primary', 'dashboard', 'side'); //WordPress.com Blog
        remove_meta_box('dashboard_secondary', 'dashboard', 'side'); //Other WordPress News
        remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); //Incoming Links
        remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); //Plugins
        remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Right Now
        remove_meta_box('rg_forms_dashboard', 'dashboard', 'normal'); //Gravity Forms
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); //Recent Comments
        remove_meta_box('icl_dashboard_widget', 'dashboard', 'normal'); //Multi Language Plugin
        remove_meta_box('dashboard_activity', 'dashboard', 'normal'); //Activity
        remove_action('welcome_panel', 'wp_welcome_panel');
    }
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

/**
 * Redirect after login
 */
if (!function_exists('custom_login_redirect') &&
    !function_exists('growtype_form_login_redirect') &&
    !empty(get_theme_mod('theme_access_redirect_url_after_login'))) {

    add_filter('login_redirect', 'custom_login_redirect', 10, 3);
    function custom_login_redirect($redirect_to, $request, $user)
    {
        $redirect_url = !empty(get_theme_mod('theme_access_redirect_url_after_login')) ? get_theme_mod('theme_access_redirect_url_after_login') : admin_url('edit.php?post_type=page');

        return $redirect_url;
    }
}


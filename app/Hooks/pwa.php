<?php

/**
 * Handle PWA settings upon user authentication
 */
add_action('wp_login', 'growtype_pwa_attach_subscription_on_login', 10, 2);
add_action('user_register', 'growtype_pwa_attach_subscription_on_signup');

function growtype_pwa_attach_subscription_on_login($user_login, $user)
{
    growtype_pwa_process_pending_subscription($user->ID);
}

function growtype_pwa_attach_subscription_on_signup($user_id)
{
    growtype_pwa_process_pending_subscription($user_id);
}

function growtype_pwa_process_pending_subscription($user_id)
{
    $pending_subscription = $_COOKIE['pwa_pending_subscription'] ?? '';

    if (!empty($pending_subscription)) {
        $subscription_payload = function_exists('growtype_pwa_decode_subscription_payload')
            ? growtype_pwa_decode_subscription_payload($pending_subscription)
            : json_decode(stripslashes($pending_subscription), true);

        if (function_exists('growtype_pwa_upsert_user_subscription') && !empty($subscription_payload)) {
            // Attach the pending device subscription without overwriting other devices.
            growtype_pwa_upsert_user_subscription($user_id, $subscription_payload);
        } else {
            // Fallback for legacy environments.
            update_user_meta($user_id, 'pwa_push_subscription', stripslashes($pending_subscription));
        }

        // Remove cookie
        setcookie('pwa_pending_subscription', '', time() - 3600, '/');

        if ((defined('WP_ENV') && WP_ENV === 'development') || (\App\config('wp.env') === 'development')) {
            error_log("PWA: Successfully attached pending subscription to user $user_id upon authentication.");
        }
    }
}

/**
 * PWA Install Banner Configuration & Visibility
 */
add_filter('growtype_theme_args', function ($args) {
    $args['pwa_show_banner'] = growtype_pwa_should_show_install_banner();
    return $args;
});

function growtype_pwa_should_show_install_banner() {
    if (!apply_filters('growtype_pwa_install_banner_enabled', true)) {
        return false;
    }

    $allowed_pages = apply_filters('growtype_pwa_install_banner_pages', ['front_page']);
    $is_allowed = false;
    
    foreach ($allowed_pages as $page) {
        if ($page === 'all') {
            $is_allowed = true;
            break;
        }
        if ($page === 'front_page' && is_front_page()) {
            $is_allowed = true;
            break;
        }
    }

    return apply_filters('growtype_pwa_install_banner_should_show', $is_allowed);
}

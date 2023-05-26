<?php

/**
 *
 */
class Growtype_User
{
    /**
     * @return array
     */
    public static function meta_details($filtered = true)
    {
        $user_id = get_current_user_id();
        $skip_fields = [];

        $skip_fields = [
            'rich_editing',
            'last_update',
            '_order_count',
            'wp_user_level',
            'locale',
            'show_admin_bar_front',
            'use_ssl',
            'syntax_highlighting',
            'comment_shortcuts',
            'admin_color',
            'session_tokens',
            'wc_last_active',
            '_woocommerce_persistent_cart_1',
            'wp_capabilities',
            'company',
            'nickname',
            'first_name',
            'last_name',
            'description',
            'address_1',
            'country',
            'city',
        ];

        $user_meta = [];
        if (current_user_can('manage_options') && isset($user_id)) {
            $user_meta = get_user_meta($user_id);
        }

        $filtered_meta_values = [];
        foreach ($user_meta as $key => $user_field) {

            if ($filtered) {
                if (in_array($key, $skip_fields) || str_contains($key, 'billing_') || str_contains($key, 'shipping_')) {
                    continue;
                }
            }

            $filtered_meta_values[$key] = $user_field[0] ?? null;
        }

        return $filtered_meta_values;
    }

    /**
     * @return false|string
     */
    public static function display_name()
    {
        $current_user = wp_get_current_user();

        if (isset($current_user->display_name) && !empty($current_user->display_name)) {
            return $current_user->display_name;
        }

        return false;
    }

    /**
     * @return bool|mixed
     */
    public static function account_icon_enabled()
    {
        $status = get_theme_mod('user_account_icon_enabled', false);

        return $status ? true : false;
    }

    /**
     * @return false|string
     */
    public static function login_name()
    {
        $current_user = wp_get_current_user();

        if (isset($current_user->display_name) && !empty($current_user->display_name)) {
            return $current_user->display_name;
        }

        return false;
    }

    /**
     * Check profile menu status
     */
    public static function profile_menu_is_enabled()
    {
        $status = get_theme_mod('profile_menu_enabled');

        /**
         * Check if user can access platform
         */
        if (!is_user_logged_in()) {
            $status = false;
        }

        return $status;
    }

    /**
     * Check profile menu status
     */
    public static function account_permalink()
    {
        $permalink = get_theme_mod('user_account_permalink');
        $permalink = apply_filters('growtype_user_account_permalink', $permalink);

        return $permalink;
    }
}

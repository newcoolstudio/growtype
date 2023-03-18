<?php

/**
 * @return bool
 */
function user_can_edit_frontend()
{
    return user_can(get_current_user_id(), 'editor') ||
        user_can(get_current_user_id(), 'editor_plus_shop_manager') ||
        user_can(get_current_user_id(), 'administrator');
}

/**
 * Theme redirect. Controlled in customizer "accesses" section.
 */
function growtype_custom_page_redirect()
{
    /**
     * Prevent redirect if
     */
    if (current_user_can('administrator') || is_404()) {
        return null;
    }

    /**
     * Check if login redirect is applied
     */
    $login_redirect_enabled = get_theme_mod('theme_access_login_redirect');

    if ($login_redirect_enabled) {
        $login_redirect_url = !empty(get_theme_mod('theme_access_login_redirect_url')) ? get_theme_mod('theme_access_login_redirect_url') : '/login';
        $after_login_redirect_url = !empty(get_theme_mod('theme_access_redirect_url_after_login')) ? get_theme_mod('theme_access_redirect_url_after_login') : '/';
        $pages_available_when_not_logged_in = !empty(get_theme_mod('theme_access_pages_available_when_not_logged_in')) ? get_theme_mod('theme_access_pages_available_when_not_logged_in') : '';
        $page_is_available_when_not_logged_in = page_is_among_enabled_pages($pages_available_when_not_logged_in);
        $prevented_roles_redirect_url = !empty(get_theme_mod('theme_access_disabled_roles_redirect_url')) ? get_theme_mod('theme_access_disabled_roles_redirect_url') : get_home_url();

        if (!is_user_logged_in()) {
            if (!$page_is_available_when_not_logged_in) {
                wp_redirect($login_redirect_url);
                exit();
            }
        } else {
            if (class_exists('Growtype_Wc_Product')) {
                $user_has_bought_required_products = Growtype_Wc_Product::user_has_bought_required_products();
                $redirect_page = get_theme_mod('theme_access_must_have_products_redirect_page');
                $redirect_page = !empty($redirect_page) ? get_permalink($redirect_page) : null;

                /**
                 * Check if user bought required products
                 */
                if (!$user_has_bought_required_products) {
                    if (!empty($redirect_page) && !$page_is_available_when_not_logged_in && $redirect_page !== get_permalink()) {
                        wp_redirect($redirect_page);
                        exit();
                    }
                } else {
                    if (!$page_is_available_when_not_logged_in) {
                        if (!user_has_required_role_to_access_platform()) {
                            wp_redirect($prevented_roles_redirect_url);
                            exit();
                        }
                    } elseif (!$page_is_available_when_not_logged_in || $redirect_page === get_permalink()) {
                        wp_redirect(get_home_url_custom());
                        exit();
                    }
                }
            } else {
                if (str_contains($_SERVER['REQUEST_URI'], parse_url($login_redirect_url)['path'])) {
                    wp_redirect($after_login_redirect_url);
                    exit();
                }
            }
        }
    }

    /**
     * Check if home redirect is applied
     */
    $home_redirect_enabled = get_theme_mod('theme_access_logged_in_home_page_redirect');

    if ($home_redirect_enabled && is_front_page() && is_user_logged_in() && get_home_url_custom() !== home_url()) {
        wp_redirect(get_home_url_custom());
        exit();
    }

    add_action('growtype_custom_page_redirect');
}

/**
 * @param $user_id
 * @return bool
 */
function user_has_required_role_to_access_platform($user_id = null)
{
    $user_id = !empty($user_id) ? $user_id : get_current_user_id();

    if (empty($user_id)) {
        return false;
    }

    $user = get_user_by('id', $user_id);

    $roles = ( array )$user->roles;
    $prevented_roles = !empty(get_theme_mod('theme_access_disabled_roles')) ? explode(',', get_theme_mod('theme_access_disabled_roles')) : [];

    if (!empty($prevented_roles)) {
        foreach ($roles as $role) {
            if (in_array($role, $prevented_roles)) {
                return false;
            }
        }
    }

    return true;
}

/**
 * @param $user
 * @return bool
 */
function user_can_access_platform()
{
    if (class_exists('Growtype_Wc_Product')) {
        return Growtype_Wc_Product::user_has_bought_required_products() && user_has_required_role_to_access_platform();
    }

    return user_has_required_role_to_access_platform();
}

/**
 * @return false|string|WP_Error
 */
function get_home_url_custom()
{
    if (is_user_logged_in() && !empty(get_theme_mod('theme_access_home_page_id_after_login')) && user_can_access_platform()) {
        return get_permalink(get_theme_mod('theme_access_home_page_id_after_login'));
    }

    return get_home_url();
}

/**
 * @param $enabled_pages
 * @return bool
 * Check if page is among enabled pages
 */
function page_is_among_enabled_pages($enabled_pages)
{
    global $wp_query;

    $page_id = !empty($wp_query->get_queried_object_id()) ? $wp_query->get_queried_object_id() : (!empty($wp_query->query_vars['page_id']) ? $wp_query->query_vars['page_id'] : get_the_ID());

    if (class_exists('woocommerce')) {
        if (is_shop()) {
            $page_id = wc_get_page_id('shop');
        }
    }

    $enabled_pages = explode(",", $enabled_pages);

    $page_enabled = false;

    /**
     * Check if exists among enabled pages
     */

    if (!empty($page_id)) {
        return in_array($page_id, $enabled_pages);
    }

    /**
     * Check lost password page
     */
    if (in_array('lost_password_page', $enabled_pages)) {
        if (str_contains($_SERVER['REQUEST_URI'], 'lost-password') || str_contains($_SERVER['REQUEST_URI'], 'lostpassword')) {
            return true;
        }
    }

    /**
     * Check search results
     */
    if (in_array('search_results', $enabled_pages) && is_search()) {
        return true;
    }

    /**
     * Check search results
     */
    $post = get_post($page_id);
    if (!empty($post) && $post->post_name === 'my-account' && in_array(Growtype_Page::get_url_slug(), $enabled_pages)) {
        return true;
    }

    /**
     * Posts
     */
    if (in_array('posts', $enabled_pages)) {
        if (is_single() && get_post_type() === 'post') {
            return true;
        }
    }

    $page_enabled = apply_filters('growtype_page_is_among_enabled_pages', $enabled_pages);

    return $page_enabled;
}

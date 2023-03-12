<?php

add_action('wp_enqueue_scripts', 'growtype_woocommerce_login_scripts');
function growtype_woocommerce_login_scripts()
{
    global $post;
    if (isset($post) && $post->ID == get_option('woocommerce_myaccount_page_id')) {
        wp_enqueue_script('login-main', growtype_get_parent_theme_public_path() . '/scripts/plugins/woocommerce/wc-login.js', [], '1.0.0', true);
    }
}

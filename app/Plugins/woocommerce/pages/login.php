<?php

function login_scripts_styles()
{
    global $post;
    if (isset($post) && $post->ID == get_option('woocommerce_myaccount_page_id')) {
        wp_enqueue_script('login-main', get_parent_template_public_path() . '/scripts/plugins/woocommerce/wc-login.js', [], '1.0.0', true);
    }
}

add_action('wp_enqueue_scripts', 'login_scripts_styles');

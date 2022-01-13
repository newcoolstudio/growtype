<?php

use function App\config;

add_action('wp_enqueue_scripts', 'custom_buddypress_scripts', 100);

function custom_buddypress_scripts()
{
    if (class_exists('buddypress')) {
//        dd(get_parent_template_public_path());
        wp_enqueue_style('growtype/buddypress/buddypress-styles', get_parent_template_public_path() . '/styles/plugins/buddypress/buddypress.css', false, null);

        wp_enqueue_script('bp-like', get_parent_template_public_path() . '/scripts/plugins/buddypress/like.js', '', '', true);
        wp_enqueue_script('bp-general', get_parent_template_public_path() . '/scripts/plugins/buddypress/general.js', ['jquery','growtype/flexmenu'], '', true);

        wp_localize_script('bp-like', 'buddypress_data', get_buddypress_data());
    }
}

function get_buddypress_data()
{

    // Script data.
    $obj_data = array (
        'ajaxurl' => admin_url('admin-ajax.php'),
        'buddypress_search_nonce' => wp_create_nonce('buddypress_search_nonce'),
        'avatar' => get_avatar(get_current_user_id(), 24),
        'more_text' => esc_html__('More', 'growtype'),
        'read_more' => esc_html__('Read more', 'growtype'),
        'read_close' => esc_html__('Close', 'growtype'),
        'like_msg' => esc_html__('Like this', 'growtype'),
        'unlike_msg' => esc_html__('Unlike this', 'growtype'),
        'attachment_text' => esc_html__('Attach media', 'growtype'),
        'redirecturl' => '',
        'bp_is_active' => function_exists('bp_is_active'),
    );

    // Return data.
    return apply_filters('buddypress_localize_script_data', $obj_data);

}

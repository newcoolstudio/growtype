<?php

add_action('init', 'alter_qtranslate_xt_config');
function alter_qtranslate_xt_config()
{
    global $q_config;

    $user = wp_get_current_user();

    if (!user_can($user, 'manage_options')) {
        $q_config['highlight_mode'] = 0;
    }
}

/**
 * Define locale for wp_ajax requests
 */
add_filter('pre_determine_locale', function () {
    if (wp_doing_ajax()) {
        return get_locale();
    }
});

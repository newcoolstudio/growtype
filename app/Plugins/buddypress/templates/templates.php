<?php

/**
 * @return string
 */
function get_bp_template_path()
{
    return growtype_get_parent_theme_app_path() . '/Plugins/buddypress/templates';
}

/**
 * Change default template location
 */
add_action('bp_init', function () {
    if (function_exists('bp_register_template_stack')) {
        bp_register_template_stack('get_bp_template_path', 1);
    }
});

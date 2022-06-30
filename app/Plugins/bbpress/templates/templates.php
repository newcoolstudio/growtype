<?php
/**
 * @return string
 * Template path
 */
function get_bbp_template_path()
{
    return growtype_get_parent_theme_app_path() . '/Plugins/bbpress/templates';
}

/**
 * Change default template location
 */
add_action('bbp_init', function () {
    if (function_exists('bbp_register_template_stack')) {
        bbp_register_template_stack('get_bbp_template_path',1);
    }
});

<?php

/**
 *
 */
add_action('wp_default_scripts', 'growtype_dequeue_wp_default_scripts');
function growtype_dequeue_wp_default_scripts($scripts)
{
    if (!is_admin() && !empty($scripts->registered['jquery'])) {
        $jquery_dependencies = $scripts->registered['jquery']->deps;
        $scripts->registered['jquery']->deps = array_diff($jquery_dependencies, array ('jquery-migrate'));
    }
}

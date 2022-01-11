<?php

/**
 * Grid button
 */

function extra_styles_button()
{
    if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
        add_filter('mce_buttons', 'extra_styles_button_register');
        add_filter('mce_external_plugins', 'extra_styles_add');
    }
}

add_action('admin_init', 'extra_styles_button');

function extra_styles_button_register($buttons)
{
    array_push($buttons, "extra_styles");
    return $buttons;
}

function extra_styles_add($plugin_array)
{
    $plugin_array['extra_styles_script'] = get_template_directory_uri() . '/../app/Admin/editor/standard/visual/tinymce/js/extra-styles.js';

    return $plugin_array;
}

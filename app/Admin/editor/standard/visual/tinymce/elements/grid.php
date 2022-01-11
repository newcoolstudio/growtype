<?php

/**
 * Grid button
 */

function tiny_grid_buttons()
{
    if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
        add_filter('mce_buttons', 'tiny_grid_buttons_register');
        add_filter('mce_external_plugins', 'tiny_grid_add');
    }
}

add_action('admin_init', 'tiny_grid_buttons');

function tiny_grid_buttons_register($buttons)
{
    array_push($buttons, "grid", "visualblocks");
    return $buttons;
}

function tiny_grid_add($plugin_array)
{
    $plugin_array['tiny_grid_scripts'] = get_template_directory_uri() . '/../app/Admin/editor/standard/visual/tinymce/js/grid.js';
    $plugin_array['visualblocks'] = get_template_directory_uri() . '/../app/Admin/editor/standard/visual/tinymce/js/grid-visualblocks.js';

    return $plugin_array;
}

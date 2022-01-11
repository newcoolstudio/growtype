<?php

/**
 * Registers an editor stylesheet for the theme.
 */
function add_custom_standart_editor_styles()
{
    add_editor_style(dirname(get_template_directory_uri()) . '/public/styles/backend-standard-editor.css');
}

add_action('admin_init', 'add_custom_standart_editor_styles');

/**
 * Font awesome
 */
function add_editor_font_awesome_support()
{
    add_editor_style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css');
}

add_action('admin_init', 'add_editor_font_awesome_support');

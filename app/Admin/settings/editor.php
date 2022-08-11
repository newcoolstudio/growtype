<?php

/**
 * Editor settings
 */

add_action('admin_menu', 'editor_options_page');

function editor_options_page()
{
    add_options_page(
        __('Editor', 'growtype'),
        __('Growtype - Editor', 'growtype'),
        'manage_options',
        'editor-options',
        'editor_options_content',
        1
    );
}

function editor_options_content()
{
    echo '<div class="wrap">
	<h1>Editor options</h1>
	<form method="post" action="options.php">';

    settings_fields('editor_options_settings'); // settings group name
    do_settings_sections('editor-options'); // just a page slug
    submit_button();

    echo '</form></div>';
}

add_action('admin_init', 'editor_options_setting');

function editor_options_setting()
{
    add_settings_section(
        'editor_options_settings', // section ID
        'Gutenberg editor', // title (if needed)
        '', // callback function (if needed)
        'editor-options' // page slug
    );

    /**
     * Gutenberg block editor
     */
    register_setting(
        'editor_options_settings', // settings group name
        'gutenberg_block_editor_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'gutenberg_block_editor_enabled',
        'Gutenberg Block Editor',
        'gutenberg_block_editor_enabled_callback',
        'editor-options',
        'editor_options_settings'
    );

    /**
     * Widget block editor
     */
    register_setting(
        'editor_options_settings', // settings group name
        'widget_block_editor_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'widget_block_editor_enabled',
        'Widget Block Editor',
        'widget_block_editor_enabled_callback',
        'editor-options',
        'editor_options_settings'
    );

    /**
     * Autosaving
     */
    register_setting(
        'editor_options_settings', // settings group name
        'autosaving_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'autosaving_enabled',
        'Autosaving',
        'autosaving_enabled_callback',
        'editor-options',
        'editor_options_settings'
    );

    /**
     * Theme styles
     */
    register_setting(
        'editor_options_settings', // settings group name
        'theme_styles_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'theme_styles_enabled',
        'Apply Theme Styles',
        'theme_styles_enabled_callback',
        'editor-options',
        'editor_options_settings'
    );

    /**
     * Editor apply theme font
     */
    register_setting(
        'editor_options_settings', // settings group name
        'theme_font_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'theme_font_enabled',
        'Apply Theme Font',
        'theme_font_enabled_callback',
        'editor-options',
        'editor_options_settings'
    );

    /**
     * Reusable blocks bar in admin nav
     */
    register_setting(
        'editor_options_settings', // settings group name
        'reusable_blocks_in_admin_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'reusable_blocks_in_admin_enabled',
        'Reusable blocks bar in admin nav',
        'reusable_blocks_in_admin_enabled_callback',
        'editor-options',
        'editor_options_settings'
    );
}

/**
 * Gutenberg block editor
 */
function gutenberg_block_editor_enabled_callback()
{
    $html = '<input type="checkbox" name="gutenberg_block_editor_enabled" value="1" ' . checked(1, get_option('gutenberg_block_editor_enabled'), false) . ' />';
    echo $html;
}

/**
 * Widget block editor
 */
function widget_block_editor_enabled_callback()
{
    $html = '<input type="checkbox" name="widget_block_editor_enabled" value="1" ' . checked(1, get_option('widget_block_editor_enabled'), false) . ' />';
    echo $html;
}

/**
 * Posts autosaving
 */
function autosaving_enabled_callback()
{
    $html = '<input type="checkbox" name="autosaving_enabled" value="1" ' . checked(1, get_option('autosaving_enabled'), false) . ' />';
    echo $html;
}

/**
 * Theme styles
 */
function theme_styles_enabled_callback()
{
    $html = '<input type="checkbox" name="theme_styles_enabled" value="1" ' . checked(1, get_option('theme_styles_enabled'), false) . ' />';
    echo $html;
}

/**
 * Theme font in editor
 */
function theme_font_enabled_callback()
{
    $html = '<input type="checkbox" name="theme_font_enabled" value="1" ' . checked(1, get_option('theme_font_enabled'), false) . ' />';
    echo $html;
}

/**
 * Reusable blocks in admin
 */
function reusable_blocks_in_admin_enabled_callback()
{
    $html = '<input type="checkbox" name="reusable_blocks_in_admin_enabled" value="1" ' . checked(1, get_option('reusable_blocks_in_admin_enabled'), false) . ' />';
    echo $html;
}

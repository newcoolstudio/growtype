<?php

class Growtype_Admin_Theme_Settings_Editor
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array ($this, 'admin_assets'));
        add_action('admin_menu', array ($this, 'admin_menu_tabs'));
        add_action('admin_init', array ($this, 'admin_settings'));
    }

    public static function admin_menu_tabs()
    {
        add_submenu_page(
            'growtype-theme-settings',
            __('Editor', 'growtype'),
            __('Editor', 'growtype'),
            'manage_options',
            'growtype-editor-settings',
            array (__CLASS__, 'menu_page'),
            1
        );
    }

    public static function menu_page()
    {
        if (is_file(__DIR__ . '/includes/layout.php')) {
            include_once __DIR__ . '/includes/layout.php';
        }
    }

    public static function getSettings()
    {
    }

    public static function admin_assets()
    {
        if (isset($_GET['page']) && !empty($_GET['page']) && 'growtype-theme-settings' === $_GET['page']) {
        }
    }

    public function admin_settings()
    {
        add_settings_section(
            'editor_options_settings', // section ID
            'Gutenberg editor', // title (if needed)
            '', // callback function (if needed)
            'growtype-editor-settings' // page slug
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
            array ($this, 'gutenberg_block_editor_enabled_callback'),
            'growtype-editor-settings',
            'editor_options_settings'
        );

        /**
         * Gutenberg block editor
         */
        register_setting(
            'editor_options_settings', // settings group name
            'growtype_gutenberg_block_editor_load_remote_block_patterns', // option name
            'sanitize_text_field' // sanitization function
        );

        add_settings_field(
            'growtype_gutenberg_block_editor_load_remote_block_patterns',
            'Load Remote Block Patterns',
            array ($this, 'growtype_gutenberg_block_editor_load_remote_block_patterns_callback'),
            'growtype-editor-settings',
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
            array ($this, 'widget_block_editor_enabled_callback'),
            'growtype-editor-settings',
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
            array ($this, 'autosaving_enabled_callback'),
            'growtype-editor-settings',
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
            array ($this, 'theme_styles_enabled_callback'),
            'growtype-editor-settings',
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
            array ($this, 'theme_font_enabled_callback'),
            'growtype-editor-settings',
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
            'Show Reusable blocks nav tab in admin',
            array ($this, 'reusable_blocks_in_admin_enabled_callback'),
            'growtype-editor-settings',
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
     * Gutenberg block editor remote patterns
     */
    function growtype_gutenberg_block_editor_load_remote_block_patterns_callback()
    {
        $html = '<input type="checkbox" name="growtype_gutenberg_block_editor_load_remote_block_patterns" value="1" ' . checked(1, get_option('growtype_gutenberg_block_editor_load_remote_block_patterns'), false) . ' />';
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
}

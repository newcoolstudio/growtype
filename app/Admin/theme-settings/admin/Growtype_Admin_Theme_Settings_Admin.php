<?php

class Growtype_Admin_Theme_Settings_Admin
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
            __('Admin', 'growtype'),
            __('Admin', 'growtype'),
            'manage_options',
            'growtype-admin-settings',
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
            'admin_options_settings', // section ID
            'Columns', // title (if needed)
            '', // callback function (if needed)
            'growtype-admin-settings' // page slug
        );

        /**
         * Gutenberg block editor
         */
        register_setting(
            'admin_options_settings', // settings group name
            'admin_excerpt_enabled', // option name
            'sanitize_text_field' // sanitization function
        );

        add_settings_field(
            'admin_excerpt_enabled',
            'Excerpt column enabled',
            array ($this, 'admin_excerpt_enabled_callback'),
            'growtype-admin-settings',
            'admin_options_settings'
        );
    }

    /**
     * Gutenberg block editor
     */
    function admin_excerpt_enabled_callback()
    {
        $html = '<input type="checkbox" name="admin_excerpt_enabled" value="1" ' . checked(1, get_option('admin_excerpt_enabled', false), false) . ' />';
        echo $html;
    }
}

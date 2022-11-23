<?php

class Growtype_Admin_Theme_Settings_System
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
            __('System', 'growtype'),
            __('System', 'growtype'),
            'manage_options',
            'growtype-system-settings',
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
        /**
         * Framework
         */
        add_settings_section(
            'framework_options_settings', // section ID
            'Framework', // title (if needed)
            '', // callback function (if needed)
            'growtype-system-settings' // page slug
        );

        /**
         * Indexing notice
         */
        register_setting(
            'framework_options_settings', // settings group name
            'bedrock_indexing_notice_enabled', // option name
            'sanitize_text_field' // sanitization function
        );

        add_settings_field(
            'bedrock_indexing_notice_enabled',
            'Bedrock Indexing Notice Visible',
            array ($this, 'bedrock_indexing_notice_enabled_callback'),
            'growtype-system-settings',
            'framework_options_settings'
        );
    }

    /**
     * Bedrock status checkbox
     */
    function bedrock_indexing_notice_enabled_callback()
    {
        $html = '<input type="checkbox" name="bedrock_indexing_notice_enabled" value="1" ' . checked(1, get_option('bedrock_indexing_notice_enabled'), false) . ' />';
        echo $html;
    }
}

new Growtype_Admin_Theme_Settings_System();

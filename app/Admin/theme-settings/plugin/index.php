<?php

class Growtype_Admin_Theme_Settings_Plugin
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
            __('Plugin', 'growtype'),
            __('Plugin', 'growtype'),
            'manage_options',
            'growtype-plugin-settings',
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
         * Acf settings
         */
        add_settings_section(
            'acf_options_settings', // section ID
            'Acf', // title (if needed)
            '', // callback function (if needed)
            'growtype-plugin-settings' // page slug
        );

        /**
         * ACF Api key
         */
        register_setting(
            'plugin_options_settings', // settings group name
            'acf_maps_api_key_value', // option name
            'sanitize_text_field' // sanitization function
        );

        add_settings_field(
            'acf_maps_api_key_value',
            'Maps Api Key',
            array ($this, 'acf_maps_api_key_value_callback'),
            'growtype-plugin-settings',
            'acf_options_settings'
        );

        /**
         * Woocommerce settings
         */
        add_settings_section(
            'woocommerce_options_settings', // section ID
            'Woocommerce', // title (if needed)
            '', // callback function (if needed)
            'growtype-plugin-settings' // page slug
        );

        /**
         * Woocommerce main menu title
         */
        register_setting(
            'plugin_options_settings', // settings group name
            'woocommerce_main_menu_title', // option name
            'sanitize_text_field' // sanitization function
        );

        add_settings_field(
            'woocommerce_main_menu_title',
            'Woocommerce menu title',
            array ($this, 'woocommerce_main_menu_title_callback'),
            'growtype-plugin-settings',
            'woocommerce_options_settings'
        );

        /**
         * Woocommerce products menu title
         */
        register_setting(
            'plugin_options_settings', // settings group name
            'woocommerce_products_menu_title', // option name
            'sanitize_text_field' // sanitization function
        );

        add_settings_field(
            'woocommerce_products_menu_title',
            'Products menu title',
            array ($this, 'woocommerce_products_menu_title_callback'),
            'growtype-plugin-settings',
            'woocommerce_options_settings'
        );
    }

    /**
     * Maps api key input
     */
    function acf_maps_api_key_value_callback()
    {
        $html = '<input type="text" name="acf_maps_api_key_value" style="min-width:400px;" value="' . get_option('acf_maps_api_key_value') . '" />';
        echo $html;
    }

    /**
     * Woocommerce mian menu title
     */
    function woocommerce_main_menu_title_callback()
    {
        $html = '<input type="text" name="woocommerce_main_menu_title" style="min-width:400px;" value="' . get_option('woocommerce_main_menu_title') . '" />';
        echo $html;
    }

    /**
     * Woocommerce products menu title
     */
    function woocommerce_products_menu_title_callback()
    {
        $html = '<input type="text" name="woocommerce_products_menu_title" style="min-width:400px;" value="' . get_option('woocommerce_products_menu_title') . '" />';
        echo $html;
    }
}

new Growtype_Admin_Theme_Settings_Plugin();

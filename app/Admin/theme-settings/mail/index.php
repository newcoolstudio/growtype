<?php

class Growtype_Admin_Theme_Settings_Mail
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
            __('Mail', 'growtype'),
            __('Mail', 'growtype'),
            'manage_options',
            'growtype-mail-settings',
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
            'mail_options_settings', // section ID
            'Email', // title (if needed)
            '', // callback function (if needed)
            'growtype-mail-settings' // page slug
        );

        /**
         * Mail sender name
         */
        register_setting(
            'mail_options_settings', // settings group name
            'mail_sender_name_value', // option name
            'sanitize_text_field' // sanitization function
        );

        add_settings_field(
            'mail_sender_name_value',
            'Sender Name',
            array ($this, 'mail_sender_name_value_callback'),
            'growtype-mail-settings',
            'mail_options_settings'
        );

        /**
         * Mail sender email
         */
        register_setting(
            'mail_options_settings', // settings group name
            'mail_sender_email_value', // option name
            'sanitize_text_field' // sanitization function
        );

        add_settings_field(
            'mail_sender_email_value',
            'Sender Email',
            array ($this, 'mail_sender_email_value_callback'),
            'growtype-mail-settings',
            'mail_options_settings'
        );
    }

    /**
     * Mail sender name
     */
    function mail_sender_name_value_callback()
    {
        $html = '<input type="text" name="mail_sender_name_value" style="width:100%;" value="' . get_option('mail_sender_name_value') . '" />';
        echo $html;
    }

    /**
     * Mail sender email
     */
    function mail_sender_email_value_callback()
    {
        $html = '<input type="text" name="mail_sender_email_value" style="width:100%;" value="' . get_option('mail_sender_email_value') . '" />';
        echo $html;
    }
}

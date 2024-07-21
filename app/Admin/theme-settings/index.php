<?php

class Growtype_Admin_Theme_Settings
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array ($this, 'admin_assets'));
        add_action('admin_menu', array ($this, 'admin_menu_tabs'));

        $this->load_submenu();
    }

    public static function admin_menu_tabs()
    {
        add_menu_page(
            __('Theme Settings', 'growtype'),
            __('Theme Settings', 'growtype'),
            'manage_options',
            'growtype-theme-settings',
            array (__CLASS__, 'menu_page'),
            'dashicons-admin-settings',
            90
        );
    }

    public static function menu_page()
    {
        if (is_file(plugin_dir_path(__FILE__) . 'includes/layout.php')) {
            include_once plugin_dir_path(__FILE__) . 'includes/layout.php';
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

    public function load_submenu()
    {
        include_once('system/index.php');
        new Growtype_Admin_Theme_Settings_System();

        include_once('editor/index.php');
        new Growtype_Admin_Theme_Settings_Editor();

        include_once('admin/index.php');
        new Growtype_Admin_Theme_Settings_Admin();

        include_once('extra-scripts/index.php');
        new Growtype_Admin_Theme_Settings_Extra_Scripts();
    }
}

new Growtype_Admin_Theme_Settings();

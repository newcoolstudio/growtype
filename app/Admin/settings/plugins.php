<?php

/**
 * cpt settings
 */

if (class_exists('woocommerce') || class_exists('ACF')) {
    add_action('admin_menu', 'plugins_options_page');
    add_action('admin_init', 'plugins_options_setting');
}

function plugins_options_page()
{
    add_options_page(
        'plugins', // page <title>Title</title>
        'Growtype - Plugins', // menu link text
        'manage_options', // capability to access the page
        'plugins-options', // page URL slug
        'plugins_options_content', // callback function with content
        3 // priority
    );

}

function plugins_options_content()
{
    echo '<div class="wrap">
	<h1>Plugins options</h1>
	<form method="post" action="options.php">';

    settings_fields('plugins_options_settings');

    do_settings_sections('plugins-options');
    submit_button();

    echo '</form></div>';
}

function plugins_options_setting()
{
    /**
     * Acf settings
     */
    add_settings_section(
        'acf_options_settings', // section ID
        'Acf', // title (if needed)
        '', // callback function (if needed)
        'plugins-options' // page slug
    );

    /**
     * ACF Api key
     */
    register_setting(
        'plugins_options_settings', // settings group name
        'acf_maps_api_key_value', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'acf_maps_api_key_value',
        'Maps Api Key',
        'acf_maps_api_key_value_callback',
        'plugins-options',
        'acf_options_settings'
    );

    /**
     * Woocommerce settings
     */
    add_settings_section(
        'woocommerce_options_settings', // section ID
        'Woocommerce', // title (if needed)
        '', // callback function (if needed)
        'plugins-options' // page slug
    );

    /**
     * Woocommerce main menu title
     */
    register_setting(
        'plugins_options_settings', // settings group name
        'woocommerce_main_menu_title', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'woocommerce_main_menu_title',
        'Woocommerce menu title',
        'woocommerce_main_menu_title_callback',
        'plugins-options',
        'woocommerce_options_settings'
    );

    /**
     * Woocommerce products menu title
     */
    register_setting(
        'plugins_options_settings', // settings group name
        'woocommerce_products_menu_title', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'woocommerce_products_menu_title',
        'Products menu title',
        'woocommerce_products_menu_title_callback',
        'plugins-options',
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

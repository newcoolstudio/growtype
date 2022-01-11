<?php

/**
 * cpt settings
 */

add_action('admin_menu', 'cpt_options_page');

function cpt_options_page()
{
    add_options_page(
        'cpt', // page <title>Title</title>
        'Growtype - CPT', // menu link text
        'manage_options', // capability to access the page
        'cpt-options', // page URL slug
        'cpt_options_content', // callback function with content
        1 // priority
    );
}

function cpt_options_content()
{
    echo '<div class="wrap">
	<h1>CPT options</h1>
	<form method="post" action="options.php">';

    settings_fields('cpt_options_settings'); // settings group name
    do_settings_sections('cpt-options'); // just a page slug
    submit_button();

    echo '</form></div>';
}

add_action('admin_init', 'cpt_register_settings');

function cpt_register_settings()
{
    add_settings_section(
        'cpt_options_settings', // section ID
        'Cpt 1', // title (if needed)
        '', // callback function (if needed)
        'cpt-options' // page slug
    );

    /**
     * Cpt 1
     */
    /**
     * Block editor
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_1_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_1_enabled',
        'Post Type Enabled',
        'cpt_1_enabled_callback',
        'cpt-options',
        'cpt_options_settings'
    );

    /**
     * Block editor
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_1_value', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_1_value',
        'Value',
        'cpt_1_value_callback',
        'cpt-options',
        'cpt_options_settings'
    );

    /**
     * Block editor
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_1_label', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_1_label',
        'Label',
        'cpt_1_label_callback',
        'cpt-options',
        'cpt_options_settings'
    );

    /**
     * Cpt slug
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_1_slug', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_1_slug',
        'Slug',
        'cpt_1_slug_callback',
        'cpt-options',
        'cpt_options_settings'
    );

    /**
     * Archive
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_1_archive_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_1_archive_enabled',
        'Archive Enabled',
        'cpt_1_archive_enabled_callback',
        'cpt-options',
        'cpt_options_settings'
    );

    /**
     * Single page
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_1_single_page_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_1_single_page_enabled',
        'Single Page Enabled',
        'cpt_1_single_page_enabled_callback',
        'cpt-options',
        'cpt_options_settings'
    );

    /**
     * Tags
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_1_tags_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_1_tags_enabled',
        'Tags Enabled (Same tags for posts)',
        'cpt_1_tags_enabled_callback',
        'cpt-options',
        'cpt_options_settings'
    );

    /**
     * Intro title
     */
    add_settings_section(
        'cpt_options_settings_2', // section ID
        'Cpt 2', // title (if needed)
        '', // callback function (if needed)
        'cpt-options' // page slug
    );

    /**
     * Cpt 2
     */
    /**
     * Block editor
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_2_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_2_enabled',
        'Custom Post 2 - Enabled',
        'cpt_2_enabled_callback',
        'cpt-options',
        'cpt_options_settings_2'
    );

    /**
     * Block editor
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_2_value', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_2_value',
        'Custom Post 2 - Value',
        'cpt_2_value_callback',
        'cpt-options',
        'cpt_options_settings_2'
    );

    /**
     * Block editor
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_2_label', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_2_label',
        'Custom Post 2 - Label',
        'cpt_2_label_callback',
        'cpt-options',
        'cpt_options_settings_2'
    );

    /**
     * Archive
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_2_archive_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_2_archive_enabled',
        'Archive Enabled',
        'cpt_2_archive_enabled_callback',
        'cpt-options',
        'cpt_options_settings_2'
    );

    /**
     * Single page
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_2_single_page_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_2_single_page_enabled',
        'Single Page Enabled',
        'cpt_2_single_page_enabled_callback',
        'cpt-options',
        'cpt_options_settings_2'
    );

    /**
     * Cpt 3
     */
    /**
     * Intro title
     */
    add_settings_section(
        'cpt_options_settings_3', // section ID
        'Cpt 3', // title (if needed)
        '', // callback function (if needed)
        'cpt-options' // page slug
    );

    /**
     * Block editor
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_3_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_3_enabled',
        'Custom Post 3 - Enabled',
        'cpt_3_enabled_callback',
        'cpt-options',
        'cpt_options_settings_3'
    );

    /**
     * Block editor
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_3_value', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_3_value',
        'Custom Post 3 - Value',
        'cpt_3_value_callback',
        'cpt-options',
        'cpt_options_settings_3'
    );

    /**
     * Block editor
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_3_label', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_3_label',
        'Custom Post 3 - Label',
        'cpt_3_label_callback',
        'cpt-options',
        'cpt_options_settings_3'
    );

    /**
     * Archive
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_3_archive_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_3_archive_enabled',
        'Archive Enabled',
        'cpt_3_archive_enabled_callback',
        'cpt-options',
        'cpt_options_settings_3'
    );

    /**
     * Single page
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_3_single_page_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_3_single_page_enabled',
        'Single Page Enabled',
        'cpt_3_single_page_enabled_callback',
        'cpt-options',
        'cpt_options_settings_3'
    );

    /**
     * Cpt 4
     */
    /**
     * Intro title
     */
    add_settings_section(
        'cpt_options_settings_4', // section ID
        'Cpt 4', // title (if needed)
        '', // callback function (if needed)
        'cpt-options' // page slug
    );

    /**
     * Block editor
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_4_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_4_enabled',
        'Custom Post 4 - Enabled',
        'cpt_4_enabled_callback',
        'cpt-options',
        'cpt_options_settings_4'
    );

    /**
     * Block editor
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_4_value', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_4_value',
        'Custom Post 4 - Value',
        'cpt_4_value_callback',
        'cpt-options',
        'cpt_options_settings_4'
    );

    /**
     * Block editor
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_4_label', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_4_label',
        'Custom Post 4 - Label',
        'cpt_4_label_callback',
        'cpt-options',
        'cpt_options_settings_4'
    );

    /**
     * Archive
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_4_archive_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_4_archive_enabled',
        'Archive Enabled',
        'cpt_4_archive_enabled_callback',
        'cpt-options',
        'cpt_options_settings_4'
    );

    /**
     * Single page
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_4_single_page_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_4_single_page_enabled',
        'Single Page Enabled',
        'cpt_4_single_page_enabled_callback',
        'cpt-options',
        'cpt_options_settings_4'
    );

    /**
     * Cpt 5
     */
    /**
     * Intro title
     */
    add_settings_section(
        'cpt_options_settings_5', // section ID
        'Cpt 5', // title (if needed)
        '', // callback function (if needed)
        'cpt-options' // page slug
    );

    /**
     * Block editor
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_5_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_5_enabled',
        'Custom Post 5 - Enabled',
        'cpt_5_enabled_callback',
        'cpt-options',
        'cpt_options_settings_5'
    );

    /**
     * Block editor
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_5_value', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_5_value',
        'Custom Post 5 - Value',
        'cpt_5_value_callback',
        'cpt-options',
        'cpt_options_settings_5'
    );

    /**
     * Block editor
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_5_label', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_5_label',
        'Custom Post 5 - Label',
        'cpt_5_label_callback',
        'cpt-options',
        'cpt_options_settings_5'
    );

    /**
     * Archive
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_5_archive_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_5_archive_enabled',
        'Archive Enabled',
        'cpt_5_archive_enabled_callback',
        'cpt-options',
        'cpt_options_settings_5'
    );

    /**
     * Single page
     */
    register_setting(
        'cpt_options_settings', // settings group name
        'cpt_5_single_page_enabled', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'cpt_5_single_page_enabled',
        'Single Page Enabled',
        'cpt_5_single_page_enabled_callback',
        'cpt-options',
        'cpt_options_settings_5'
    );
}

/**
 * Cpt 1
 */
function cpt_1_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_1_enabled" value="1" ' . checked(1, get_option('cpt_1_enabled'), false) . ' />';
    echo $html;
}

function cpt_1_value_callback()
{
    $html = '<input type="text" name="cpt_1_value" value="' . (!empty(get_option('cpt_1_value')) ? get_option('cpt_1_value') : 'project') . '"/>';
    echo $html;
}

function cpt_1_label_callback()
{
    $html = '<input type="text" name="cpt_1_label" value="' . (!empty(get_option('cpt_1_label')) ? get_option('cpt_1_label') : 'Projects') . '"/>';
    echo $html;
}

function cpt_1_slug_callback()
{
    $html = '<input type="text" name="cpt_1_slug" value="' . (!empty(get_option('cpt_1_slug')) ? get_option('cpt_1_slug') : 'project') . '"/>';
    echo $html;
}

function cpt_1_archive_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_1_archive_enabled" value="1" ' . checked(1, get_option('cpt_1_archive_enabled'), false) . ' />';
    echo $html;
}

function cpt_1_single_page_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_1_single_page_enabled" value="1" ' . checked(1, get_option('cpt_1_single_page_enabled'), false) . ' />';
    echo $html;
}

function cpt_1_tags_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_1_tags_enabled" value="1" ' . checked(1, get_option('cpt_1_tags_enabled'), false) . ' />';
    echo $html;
}

/**
 * Cpt 2
 */
function cpt_2_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_2_enabled" value="1" ' . checked(1, get_option('cpt_2_enabled'), false) . ' />';
    echo $html;
}

function cpt_2_value_callback()
{
    $html = '<input type="text" name="cpt_2_value" value="' . (!empty(get_option('cpt_2_value')) ? get_option('cpt_2_value') : 'testimonial') . '"/>';
    echo $html;
}

function cpt_2_label_callback()
{
    $html = '<input type="text" name="cpt_2_label" value="' . (!empty(get_option('cpt_2_label')) ? get_option('cpt_2_label') : 'Testimonials') . '"/>';
    echo $html;
}

function cpt_2_archive_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_2_archive_enabled" value="1" ' . checked(1, get_option('cpt_2_archive_enabled'), false) . ' />';
    echo $html;
}

function cpt_2_single_page_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_2_single_page_enabled" value="1" ' . checked(1, get_option('cpt_2_single_page_enabled'), false) . ' />';
    echo $html;
}

/**
 * Cpt 3
 */
function cpt_3_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_3_enabled" value="1" ' . checked(1, get_option('cpt_3_enabled'), false) . ' />';
    echo $html;
}

function cpt_3_value_callback()
{
    $html = '<input type="text" name="cpt_3_value" value="' . (!empty(get_option('cpt_3_value')) ? get_option('cpt_3_value') : 'membership') . '"/>';
    echo $html;
}

function cpt_3_label_callback()
{
    $html = '<input type="text" name="cpt_3_label" value="' . (!empty(get_option('cpt_3_label')) ? get_option('cpt_3_label') : 'Membership') . '"/>';
    echo $html;
}

function cpt_3_archive_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_3_archive_enabled" value="1" ' . checked(1, get_option('cpt_3_archive_enabled'), false) . ' />';
    echo $html;
}

function cpt_3_single_page_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_3_single_page_enabled" value="1" ' . checked(1, get_option('cpt_3_single_page_enabled'), false) . ' />';
    echo $html;
}

/**
 * Cpt 4
 */
function cpt_4_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_4_enabled" value="1" ' . checked(1, get_option('cpt_4_enabled'), false) . ' />';
    echo $html;
}

function cpt_4_value_callback()
{
    $html = '<input type="text" name="cpt_4_value" value="' . (!empty(get_option('cpt_4_value')) ? get_option('cpt_4_value') : 'office') . '"/>';
    echo $html;
}

function cpt_4_label_callback()
{
    $html = '<input type="text" name="cpt_4_label" value="' . (!empty(get_option('cpt_4_label')) ? get_option('cpt_4_label') : 'Offices') . '"/>';
    echo $html;
}

function cpt_4_archive_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_4_archive_enabled" value="1" ' . checked(1, get_option('cpt_4_archive_enabled'), false) . ' />';
    echo $html;
}

function cpt_4_single_page_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_4_single_page_enabled" value="1" ' . checked(1, get_option('cpt_4_single_page_enabled'), false) . ' />';
    echo $html;
}

/**
 * Cpt 5
 */
function cpt_5_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_5_enabled" value="1" ' . checked(1, get_option('cpt_5_enabled'), false) . ' />';
    echo $html;
}

function cpt_5_value_callback()
{
    $html = '<input type="text" name="cpt_5_value" value="' . (!empty(get_option('cpt_5_value')) ? get_option('cpt_5_value') : 'service') . '"/>';
    echo $html;
}

function cpt_5_label_callback()
{
    $html = '<input type="text" name="cpt_5_label" value="' . (!empty(get_option('cpt_5_label')) ? get_option('cpt_5_label') : 'Services') . '"/>';
    echo $html;
}

function cpt_5_archive_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_5_archive_enabled" value="1" ' . checked(1, get_option('cpt_5_archive_enabled'), false) . ' />';
    echo $html;
}

function cpt_5_single_page_enabled_callback()
{
    $html = '<input type="checkbox" name="cpt_5_single_page_enabled" value="1" ' . checked(1, get_option('cpt_5_single_page_enabled'), false) . ' />';
    echo $html;
}

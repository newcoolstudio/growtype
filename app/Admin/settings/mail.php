<?php

/**
 * Editor settings
 */

add_action('admin_menu', 'mail_options_page');

function mail_options_page()
{
    add_options_page(
        __('Mail', 'growtype'),
        __('Growtype - Mail', 'growtype'),
        'manage_options',
        'mail-options',
        'mail_options_content',
        1
    );
}

function mail_options_content()
{
    echo '<div class="wrap">
	<h1>Mail options</h1>
	<form method="post" action="options.php">';

    settings_fields('mail_options_settings'); // settings group name
    do_settings_sections('mail-options'); // just a page slug
    submit_button();

    echo '</form></div>';
}

add_action('admin_init', 'mail_options_setting');

function mail_options_setting()
{
    add_settings_section(
        'mail_options_settings', // section ID
        'Email', // title (if needed)
        '', // callback function (if needed)
        'mail-options' // page slug
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
        'mail_sender_name_value_callback',
        'mail-options',
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
        'mail_sender_email_value_callback',
        'mail-options',
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

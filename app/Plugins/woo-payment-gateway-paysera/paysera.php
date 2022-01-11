<?php

add_action('admin_init', 'payments_paysera_options_settings');

function payments_paysera_options_settings()
{
    add_settings_section(
        'payments_paysera_options_settings', // section ID
        'Paysera', // title (if needed)
        '', // callback function (if needed)
        'payments-options' // page slug
    );

    /**
     * Block editor
     */
    register_setting(
        'payments_paysera_options_settings', // settings group name
        'paysera_verification_meta_code', // option name
        'sanitize_text_field' // sanitization function
    );

    add_settings_field(
        'paysera_verification_meta_code',
        'Verification meta code',
        'paysera_verification_meta_code_callback',
        'payments-options',
        'payments_paysera_options_settings'
    );
}

function paysera_verification_meta_code_callback()
{
    $html = '<input type="text" name="paysera_verification_meta_code" value="' . get_option('paysera_verification_meta_code') . '"/>';
    echo $html;
}

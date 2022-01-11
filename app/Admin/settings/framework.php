<?php

/**
 * cpt settings
 */

add_action('admin_menu', 'framework_options_page');

function framework_options_page()
{
    add_options_page(
        'framework', // page <title>Title</title>
        'Growtype - Framework', // menu link text
        'manage_options', // capability to access the page
        'framework-options', // page URL slug
        'framework_options_content', // callback function with content
        3 // priority
    );

}

function framework_options_content()
{
    echo '<div class="wrap">
	<h1>Framework options</h1>
	<form method="post" action="options.php">';

    settings_fields('framework_options_settings'); // settings group name
    do_settings_sections('framework-options'); // just a page slug
    submit_button();

    echo '</form></div>';
}

add_action('admin_init', 'framework_options_setting');

function framework_options_setting()
{
    /**
     * Framework
     */
    add_settings_section(
        'framework_options_settings', // section ID
        'Framework', // title (if needed)
        '', // callback function (if needed)
        'framework-options' // page slug
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
        'bedrock_indexing_notice_enabled_callback',
        'framework-options',
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

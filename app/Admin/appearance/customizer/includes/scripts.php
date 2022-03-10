<?php

function my_customizer_script_styles()
{
    wp_enqueue_style('customizer', get_template_directory_uri() . '/../app/Admin/appearance/customizer/assets/css/customizer-theme.css');
}

add_action('customize_controls_enqueue_scripts', 'my_customizer_script_styles');

/*
* Customizer preview js
*/
function customizer_preview()
{
    wp_enqueue_script('customizer_preview', get_template_directory_uri() . '/../app/Admin/appearance/customizer/assets/js/customizer-preview.js', array ('jquery'));

    if (function_exists('get_theme_color_schemes')) {
        wp_localize_script('customizer_preview', 'colorScheme', get_theme_color_schemes()); // color schemes global variable
    }

    wp_localize_script('customizer_preview', 'ajax_object',
        array (
            'ajaxurl' => admin_url('admin-ajax.php'),
        )
    );
}

add_action('customize_preview_init', 'customizer_preview');

/*
* Customizer admin control js
*/
function customizer_translate()
{
    wp_enqueue_script('customizer_translate', get_template_directory_uri() . '/../app/Admin/appearance/customizer/assets/js/customizer-translate.js', array ('jquery'), null, true);
    wp_localize_script('customizer_translate', 'ajax_object',
        array (
            'ajaxurl' => admin_url('admin-ajax.php'),
        )
    );
}

add_action('customize_controls_enqueue_scripts', 'customizer_translate');

/*
* Customizer admin colors
*/
function customizer_control_colors()
{
    wp_enqueue_script('customizer_control_colors', get_template_directory_uri() . '/../app/Admin/appearance/customizer/assets/js/customizer-control-colors.js', array ('jquery', 'customize-preview', 'wp-color-picker'));

    if (function_exists('get_theme_color_schemes')) {
        wp_localize_script('customizer_control_colors', 'colorScheme', get_theme_color_schemes()); // color schemes global variable
    }

    wp_localize_script('customizer_control_colors', 'ajax_object',
        array (
            'ajaxurl' => admin_url('admin-ajax.php'),
        )
    );
}

add_action('customize_controls_enqueue_scripts', 'customizer_control_colors');

/*
* Customizer email preview
*/
function customizer_control_email_preview()
{
    wp_enqueue_script('customizer_control_email_preview', get_template_directory_uri() . '/../app/Admin/appearance/customizer/assets/js/customizer-control-email-preview.js', array ('jquery', 'customize-preview', 'wp-color-picker'));
    wp_localize_script('customizer_control_email_preview', 'ajax_object',
        array (
            'ajaxurl' => admin_url('admin-ajax.php'),
        )
    );
}

add_action('customize_controls_enqueue_scripts', 'customizer_control_email_preview');

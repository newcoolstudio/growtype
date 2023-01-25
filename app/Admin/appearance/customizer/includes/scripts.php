<?php

/**
 * Add sripts
 */
add_action('customize_controls_enqueue_scripts', 'growtype_customize_controls_enqueue_scripts');
function growtype_customize_controls_enqueue_scripts()
{
    wp_enqueue_style('customizer', get_template_directory_uri() . '/../app/Admin/appearance/customizer/assets/css/customizer-theme.css');
}

/*
* Customizer preview js
*/
add_action('customize_preview_init', 'growtype_customizer_preview');
function growtype_customizer_preview()
{
    wp_enqueue_script('customizer_preview', get_template_directory_uri() . '/../app/Admin/appearance/customizer/assets/js/customizer-preview.js', array ('jquery'));

    if (function_exists('growtype_get_theme_colors_schemes')) {
        wp_localize_script('customizer_preview', 'colorScheme', growtype_get_theme_colors_schemes()); // color schemes global variable
    }

    wp_localize_script('customizer_preview', 'ajax_object',
        array (
            'ajaxurl' => admin_url('admin-ajax.php'),
        )
    );
}

/*
* Customizer admin control js
*/
add_action('customize_controls_enqueue_scripts', 'growtype_customizer_translate');
function growtype_customizer_translate()
{
    wp_enqueue_script('customizer_translate', get_template_directory_uri() . '/../app/Admin/appearance/customizer/assets/js/customizer-translate.js', array ('jquery'), null, true);
    wp_localize_script('customizer_translate', 'ajax_object',
        array (
            'ajaxurl' => admin_url('admin-ajax.php'),
        )
    );
}

/*
* Customizer admin colors
*/
add_action('customize_controls_enqueue_scripts', 'growtype_customizer_control_colors');
function growtype_customizer_control_colors()
{
    wp_enqueue_script('customizer_control_colors', get_template_directory_uri() . '/../app/Admin/appearance/customizer/assets/js/customizer-control-colors.js', array ('jquery', 'customize-preview', 'wp-color-picker'));

    if (function_exists('growtype_get_theme_colors_schemes')) {
        wp_localize_script('customizer_control_colors', 'colorScheme', growtype_get_theme_colors_schemes()); // color schemes global variable
    }

    wp_localize_script('customizer_control_colors', 'ajax_object',
        array (
            'ajaxurl' => admin_url('admin-ajax.php'),
        )
    );
}

/*
* Customizer email preview
*/
add_action('customize_controls_enqueue_scripts', 'growtype_customizer_control_email_preview');
function growtype_customizer_control_email_preview()
{
    wp_enqueue_script('customizer_control_email_preview', get_template_directory_uri() . '/../app/Admin/appearance/customizer/assets/js/customizer-control-email-preview.js', array ('jquery', 'customize-preview', 'wp-color-picker'));
    wp_localize_script('customizer_control_email_preview', 'ajax_object',
        array (
            'ajaxurl' => admin_url('admin-ajax.php'),
        )
    );
}

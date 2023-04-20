<?php

/**
 *
 */
add_action("customize_register", "theme_colors_customize_register");
function theme_colors_customize_register($wp_customize)
{
    $color_scheme = growtype_get_theme_current_colors_scheme();

    $wp_customize->add_section('theme-colors', array (
        "title" => __("Colors", "growtype"),
        "priority" => 20,
    ));

    $wp_customize->add_setting('theme_colors_simple_notice',
        array (
            'default' => '',
            'transport' => 'postMessage'
        )
    );

    $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'theme_colors_simple_notice',
        array (
            'label' => __('Theme'),
            'description' => __('Below you can change theme colors'),
            'section' => 'theme-colors'
        )
    ));

    $wp_customize->add_setting("bg_color_scheme", array (
        "default" => "default",
        "sanitize_callback" => "growtype_sanitize_color_scheme",
        "transport" => "postMessage",
    ));

    $wp_customize->add_control("bg_color_scheme", array (
        "label" => __("Color Scheme", "growtype"),
        "section" => "theme-colors",
        "type" => "select",
        "choices" => growtype_get_theme_colors_scheme_choices(),
//        'priority' => 1,
    ));

    /**
     * Main
     */
    $wp_customize->add_setting('main_color', array (
        'default' => $color_scheme['main_color'],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'main_color', array (
        'label' => __('Main', 'growtype'),
        'section' => 'theme-colors',
        'alpha' => true,
    )));

    /**
     * Body background
     */
    $wp_customize->add_setting('body_background_color', array (
        'default' => $color_scheme['body_background_color'],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'body_background_color', array (
        'label' => __('Body Background', 'growtype'),
        'section' => 'theme-colors',
        'alpha' => true,
    )));

    /**
     * Body text color
     */
    $wp_customize->add_setting('body_text_color', array (
        'default' => $color_scheme['body_text_color'],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'body_text_color', array (
        'label' => __('Body Text', 'growtype'),
        'section' => 'theme-colors',
        'alpha' => true,
    )));
}

/**
 * @param $checked
 * @return bool
 */
if (!function_exists('growtype_get_theme_colors_scheme_choices')) {
    function growtype_get_theme_colors_scheme_choices()
    {
        $bg_color_schemes = growtype_get_theme_colors_schemes();
        $bg_color_scheme_control_options = array ();
        foreach ($bg_color_schemes as $color_scheme => $value) {
            $bg_color_scheme_control_options[$color_scheme] = $value['label'];
        }
        return $bg_color_scheme_control_options;
    }
}

/**
 * Theme colors schemes
 */
if (!function_exists('growtype_get_theme_colors_schemes')) {
    function growtype_get_theme_colors_schemes()
    {
        return apply_filters('growtype_color_schemes', array (
            'default' => array (
                'label' => __('Default', 'growtype'),
                'general' => array (
                    'main_color' => '#5561e2',
                    'body_background_color' => '#ffffff',
                    'body_text_color' => '#212529',
                    'header_background_color' => '',
                    'header_home_background_color' => '',
                    'header_scroll_background_color' => '#ffffff',
                    'header_text_color' => '#000000',
                    'header_text_color_scroll' => '#000000',
                    'header_text_color_home' => '#000000',
                    'footer_background_color' => '#1f1c1b',
                    'footer_text_color' => 'white',
                    'header_navbar_background_color' => '#000000',
                    'header_navbar_elements_color' => '#ffffff',
                    'header_promo_background_color' => '#000000',
                    'header_promo_elements_color' => '#ffffff',
                    'mobile_menu_text_color' => '#ffffff',
                    'mobile_menu_burger_color' => '#000000',
                    'mobile_menu_burger_active_color' => '#ffffff',
                    'mobile_menu_bg_color' => '#000000',
                    'primary_button_main_color' => '#000000',
                    'primary_button_text_color' => '#ffffff',
                    'primary_button_background_color' => '#000000'
                ),
            ),
            'dark' => array (
                'label' => __('Dark', 'growtype'),
                'general' => array (
                    'main_color' => '#5561e2',
                    'body_background_color' => '#ffffff',
                    'body_text_color' => '#212529',
                    'header_background_color' => '#000000',
                    'header_scroll_background_color' => '#000000',
                    'header_text_color' => '#ffffff',
                    'header_text_color_scroll' => '#ffffff',
                    'header_text_color_home' => '#ffffff',
                    'header_home_background_color' => '#000000',
                    'footer_background_color' => '#000000',
                    'footer_text_color' => '#ffffff',
                    'header_navbar_background_color' => '#000000',
                    'header_navbar_elements_color' => '#ffffff',
                    'header_promo_background_color' => '#000000',
                    'header_promo_elements_color' => '#ffffff',
                    'mobile_menu_text_color' => '#ffffff',
                    'mobile_menu_burger_color' => '#ffffff',
                    'mobile_menu_burger_active_color' => '#ffffff',
                    'mobile_menu_bg_color' => '#000000',
                    'primary_button_main_color' => '#000000',
                    'primary_button_text_color' => '#ffffff',
                    'primary_button_background_color' => '#000000'
                ),
            ),
            'light' => array (
                'label' => __('Light', 'growtype'),
                'general' => array (
                    'main_color' => '#5561e2',
                    'body_background_color' => '#ffffff',
                    'body_text_color' => '#212529',
                    'header_background_color' => '#ffffff',
                    'header_scroll_background_color' => '#ffffff',
                    'header_text_color' => '#000000',
                    'header_text_color_scroll' => '#000000',
                    'header_text_color_home' => '#000000',
                    'header_home_background_color' => '#ffffff',
                    'footer_background_color' => '#ffffff',
                    'footer_text_color' => '#000000',
                    'header_navbar_background_color' => '#ffffff',
                    'header_navbar_elements_color' => '#000000',
                    'header_promo_background_color' => '#ffffff',
                    'header_promo_elements_color' => '#000000',
                    'mobile_menu_text_color' => '#ffffff',
                    'mobile_menu_burger_color' => '#ffffff',
                    'mobile_menu_burger_active_color' => '#ffffff',
                    'mobile_menu_bg_color' => '#000000',
                    'primary_button_main_color' => '#000000',
                    'primary_button_text_color' => '#ffffff',
                    'primary_button_background_color' => '#000000'
                ),
            ),
        ));
    }
}

/**
 * Handles sanitization color schemes after update theme color
 */
if (!function_exists('growtype_sanitize_color_scheme')) {
    function growtype_sanitize_color_scheme($value)
    {
        $color_schemes = growtype_get_theme_colors_scheme_choices();

        if (!array_key_exists($value, $color_schemes)) {
            return 'default';
        }

        return $value;
    }
}

/**
 * Retrieves the current color scheme.
 */
if (!function_exists('growtype_get_theme_current_colors_scheme')) {
    function growtype_get_theme_current_colors_scheme()
    {
        $color_scheme_option = get_theme_mod('bg_color_scheme', 'default');
        $color_schemes = growtype_get_theme_colors_schemes();
        if (array_key_exists($color_scheme_option, $color_schemes)) {
            return $color_schemes[$color_scheme_option]['general'];
        }
        return $color_schemes['default']['general'];
    }
}

<?php

add_action("customize_register", "typography_customize_register");
function typography_customize_register($wp_customize)
{
    /**
     * Typography
     */
    $wp_customize->add_section('typography', array (
        "title" => __("Typography", "growtype"),
        "priority" => 90,
    ));

    /**
     * Primary font
     */
    $wp_customize->add_setting('primary_font_select',
        array (
            'default' => '{"font":"Open Sans","lightweight":"300","regularweight":"regular","italicweight":"italic","medium":"500", "semiboldweight":"600","boldweight":"700","category":"sans-serif"}',
            'sanitize_callback' => 'skyrocket_google_font_sanitization'
        )
    );

    $wp_customize->add_control(new Skyrocket_Google_Font_Select_Custom_Control($wp_customize, 'primary_font_select',
        array (
            'label' => __('Primary font'),
            'description' => esc_html__('Sample custom control description'),
            'section' => 'typography',
            'input_attrs' => array (
                'font_count' => 'all',
                'orderby' => 'alpha',
            ),
        )
    ));

    /**
     * Secondary font switch
     */
    $wp_customize->add_setting('secondary_font_select_switch',
        array (
            'default' => 0,
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'secondary_font_select_switch',
        array (
            'label' => esc_html__('Secondary font switch'),
            'section' => 'typography',
            'description' => __('Enable or disable secondary font', 'growtype'),
        )
    ));

    /**
     * Secondary font
     */
    $wp_customize->add_setting('secondary_font_select',
        array (
            'default' => '{"font":"Open Sans","lightweight":"300","regularweight":"regular","italicweight":"italic","medium":"500","semiboldweight":"600","boldweight":"700","category":"sans-serif"}',
            'sanitize_callback' => 'skyrocket_google_font_sanitization'
        )
    );

    $wp_customize->add_control(new Skyrocket_Google_Font_Select_Custom_Control($wp_customize, 'secondary_font_select',
        array (
            'label' => __('Secondary font'),
            'description' => esc_html__('Sample custom control description'),
            'section' => 'typography',
            'input_attrs' => array (
                'font_count' => 'all',
                'orderby' => 'alpha',
            ),
        )
    ));

    /**
     * Explanation
     */

    $wp_customize->add_setting('typography_font_size_notice',
        array (
            'default' => '',
            'transport' => 'postMessage',
        )
    );

    $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'typography_font_size_notice',
        array (
            'label' => __('Font sizes'),
            'description' => __('Below you can change font sizes'),
            'section' => 'typography'
        )
    ));

    /**
     * Font sizes
     */
    $wp_customize->add_setting('typography_font_size_h1',
        array (
            'default' => 48,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_h1',
        array (
            'label' => esc_html__('h1 size (px)'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 8, // Required. Minimum value for the slider
                'max' => 90, // Required. Maximum value for the slider
                'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
            ),
        )
    ));

    $wp_customize->add_setting('typography_font_size_h2',
        array (
            'default' => 37,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_h2',
        array (
            'label' => esc_html__('h2 size (px)'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 8, // Required. Minimum value for the slider
                'max' => 90, // Required. Maximum value for the slider
                'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
            ),
        )
    ));

    $wp_customize->add_setting('typography_font_size_h3',
        array (
            'default' => 24,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_h3',
        array (
            'label' => esc_html__('h3 size (px)'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 8, // Required. Minimum value for the slider
                'max' => 90, // Required. Maximum value for the slider
                'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
            ),
        )
    ));

    $wp_customize->add_setting('typography_font_size_h4',
        array (
            'default' => 18,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_h4',
        array (
            'label' => esc_html__('h4 size (px)'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 8, // Required. Minimum value for the slider
                'max' => 90, // Required. Maximum value for the slider
                'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
            ),
        )
    ));

    $wp_customize->add_setting('typography_font_size_h5',
        array (
            'default' => 16,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_h5',
        array (
            'label' => esc_html__('h5 size (px)'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 8, // Required. Minimum value for the slider
                'max' => 90, // Required. Maximum value for the slider
                'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
            ),
        )
    ));

    $wp_customize->add_setting('typography_font_size_p',
        array (
            'default' => 16,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_p',
        array (
            'label' => esc_html__('p size (px)'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 8, // Required. Minimum value for the slider
                'max' => 90, // Required. Maximum value for the slider
                'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
            ),
        )
    ));
}

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
     * Font size unit
     */
    $wp_customize->add_setting("typography_font_size_unit", array (
        "default" => "px",
    ));

    $wp_customize->add_control('typography_font_size_unit', array (
        'label' => esc_html__('Font size unit'),
        'section' => 'typography',
        'description' => __('What units should be used.', 'growtype'),
    ));

    /**
     * Body font size
     */
    $wp_customize->add_setting('typography_font_size_body',
        array (
            'default' => '16',
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_body',
        array (
            'label' => esc_html__('Body font size'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 0.01,
                'max' => 90,
                'step' => 0.01,
            ),
        )
    ));

    /**
     * Font h1
     */
    $wp_customize->add_setting('typography_font_size_h1',
        array (
            'default' => 56,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_h1',
        array (
            'label' => esc_html__('h1 size (px)'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 0.01,
                'max' => 200,
                'step' => 0.01,
            ),
        )
    ));

    /**
     * Font h1 mobile
     */
    $wp_customize->add_setting('typography_font_size_h1_mobile',
        array (
            'default' => 36,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_h1_mobile',
        array (
            'label' => esc_html__('h1 size (px) - mobile'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 0.01,
                'max' => 200,
                'step' => 0.01,
            ),
        )
    ));

    $wp_customize->add_setting('typography_font_size_h2',
        array (
            'default' => 48,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_h2',
        array (
            'label' => esc_html__('h2 size (px)'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 0.01,
                'max' => 200,
                'step' => 0.01,
            ),
        )
    ));

    /**
     * Font h2 mobile
     */
    $wp_customize->add_setting('typography_font_size_h2_mobile',
        array (
            'default' => 32,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_h2_mobile',
        array (
            'label' => esc_html__('h2 size (px) - mobile'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 0.01,
                'max' => 200,
                'step' => 0.01,
            ),
        )
    ));

    $wp_customize->add_setting('typography_font_size_h3',
        array (
            'default' => 36,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_h3',
        array (
            'label' => esc_html__('h3 size (px)'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 0.01,
                'max' => 200,
                'step' => 0.01,
            ),
        )
    ));

    /**
     * Font h3 mobile
     */
    $wp_customize->add_setting('typography_font_size_h3_mobile',
        array (
            'default' => 28,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_h3_mobile',
        array (
            'label' => esc_html__('h3 size (px) - mobile'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 0.01,
                'max' => 200,
                'step' => 0.01,
            ),
        )
    ));

    $wp_customize->add_setting('typography_font_size_h4',
        array (
            'default' => 28,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_h4',
        array (
            'label' => esc_html__('h4 size (px)'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 0.01,
                'max' => 200,
                'step' => 0.01,
            ),
        )
    ));

    /**
     * Font h4 mobile
     */
    $wp_customize->add_setting('typography_font_size_h4_mobile',
        array (
            'default' => 22,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_h4_mobile',
        array (
            'label' => esc_html__('h4 size (px) - mobile'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 0.01,
                'max' => 200,
                'step' => 0.01,
            ),
        )
    ));

    $wp_customize->add_setting('typography_font_size_h5',
        array (
            'default' => 22,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_h5',
        array (
            'label' => esc_html__('h5 size (px)'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 0.01,
                'max' => 200,
                'step' => 0.01,
            ),
        )
    ));

    /**
     * Font h5 mobile
     */
    $wp_customize->add_setting('typography_font_size_h5_mobile',
        array (
            'default' => 18,
            'transport' => 'postMessage',
            'sanitize_callback' => 'skyrocket_sanitize_integer'
        )
    );

    $wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'typography_font_size_h5_mobile',
        array (
            'label' => esc_html__('h5 size (px) - mobile'),
            'section' => 'typography',
            'input_attrs' => array (
                'min' => 0.01,
                'max' => 200,
                'step' => 0.01,
            ),
        )
    ));
}

<?php

add_action("customize_register", "language_customize_register");
function language_customize_register($wp_customize)
{
    $color_scheme = get_theme_color_scheme();

    /**
     * Section initialize
     */

    $wp_customize->add_section('language', array (
        "title" => __("Language", "growtype"),
        "priority" => 100,
    ));

    /**
     *
     */
    $wp_customize->add_setting('language_selector_disabled',
        array (
            'default' => 0,
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'language_selector_disabled',
        array (
            'label' => esc_html__('Language Selector Disabled'),
            'description' => __('Enable/disable language selector.', 'growtype'),
            'section' => 'language',
        )
    ));
}

<?php

/**
 * Setup
 */

add_action("customize_register", "search_customize_register");
function search_customize_register($wp_customize)
{
    $color_scheme = get_theme_color_scheme();

    /**
     * Header section initialize
     */

    $wp_customize->add_section('search', array (
        "title" => __("Search", "growtype"),
        "priority" => 100,
    ));

    /**
     *
     */
    $wp_customize->add_setting('search_icon_enabled',
        array (
            'default' => 0,
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'search_icon_enabled',
        array (
            'label' => esc_html__('Search Icon'),
            'description' => __('Enable/disable search icon in header.', 'growtype'),
            'section' => 'search',
        )
    ));

    /**
     * Search post types
     */
    $post_types_args = apply_filters(
        'wpes_post_types_args',
        array (
            'show_ui' => true,
            'public' => true,
        )
    );

    $all_post_types = apply_filters('wpes_post_types', get_post_types($post_types_args, 'objects'));

    $post_types = [];
    foreach ($all_post_types as $key => $post_type) {
        $post_types[$key] = $post_type->label;
    }

    $wp_customize->add_setting('search_post_types_enabled',
        array (
            'default' => '',
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'search_post_types_enabled',
        array (
            'label' => __('Post types included', 'growtype'),
            'description' => esc_html__('In which post types search should be conducted.', 'growtype'),
            'section' => 'search',
            'input_attrs' => array (
                'placeholder' => __('Please select post types...', 'growtype'),
                'multiselect' => true,
            ),
            'choices' => $post_types
        )
    ));
}

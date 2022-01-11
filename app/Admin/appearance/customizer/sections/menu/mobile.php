<?php

/**
 * Mobile menu
 */

$mobile_menu = wp_get_nav_menu_object('mobile-menu');

if (!empty($mobile_menu)) {
    $mobile_menu_section = 'nav_menu[' . $mobile_menu->term_id . ']';

    /**
     * Menu enabled
     */
    $wp_customize->add_setting('mobile_menu_disabled',
        array (
            'default' => 0,
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'mobile_menu_disabled',
        array (
            'label' => esc_html__('Menu is disabled'),
            'section' => $mobile_menu_section,
            'description' => __('Enable or disable', 'growtype'),
            'priority' => 1000000,
        )
    ));

    /**
     * Menu always visible
     */
    $wp_customize->add_setting('burger_always_visible',
        array (
            'default' => 0,
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'burger_always_visible',
        array (
            'label' => esc_html__('Burger Always Visible'),
            'section' => $mobile_menu_section,
            'description' => __('Enable or disable', 'growtype'),
            'priority' => 1000000,
        )
    ));

    /**
     * Menu type selector
     */
    $wp_customize->add_setting('header_mobile_menu_style',
        array (
            'default' => 'type-1',
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'header_mobile_menu_style',
        array (
            'label' => __('Mobile Menu Style', 'growtype'),
            'description' => esc_html__('Choose mobile menu style', 'growtype'),
            'section' => $mobile_menu_section,
            'input_attrs' => array (
                'placeholder' => __('Please select ...', 'growtype'),
                'multiselect' => false,
            ),
            'choices' => array (
                'type-1' => __('Style 1', 'growtype'),
                'type-2' => __('Style 2', 'growtype'),
                'type-3' => __('Style 3', 'growtype'),
            ),
            'priority' => 1000000,
        )
    ));
}

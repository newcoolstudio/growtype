<?php

/**
 * Header menu
 */

$header_menu = wp_get_nav_menu_object('header-menu');

if (!empty($header_menu)) {
    $header_menu_section = 'nav_menu[' . $header_menu->term_id . ']';

    /**
     * Menu type
     */
    $wp_customize->add_setting('main_navigation_menu_type_select',
        array (
            'default' => 'standard',
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'main_navigation_menu_type_select',
        array (
            'label' => __('Header Menu Links', 'growtype'),
            'description' => __('Choose how header menu links should function.', 'growtype'),
            'section' => $header_menu_section,
            'input_attrs' => array (
                'multiselect' => false,
            ),
            'choices' => array (
                'standard' => __('Standard', 'growtype'),
                'anchored' => __('Anchored', 'growtype')
            ),
            'priority' => 1000000,
        )
    ));

    /**
     * Menu uppercase
     */
    $wp_customize->add_setting('header_menu_uppercase',
        array (
            'default' => 0,
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'header_menu_uppercase',
        array (
            'label' => esc_html__('Menu Uppercase'),
            'section' => $header_menu_section,
            'description' => __('Menu items will be uppercase style.', 'growtype'),
            'priority' => 1000000,
        )
    ));

    /**
     * Menu always visible
     */
    $wp_customize->add_setting('header_menu_always_visible',
        array (
            'default' => 0,
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'header_menu_always_visible',
        array (
            'label' => esc_html__('Menu Always Visible'),
            'section' => $header_menu_section,
            'description' => __('Menu will be visible both on desktop and mobile resolution.', 'growtype'),
            'priority' => 1000000,
        )
    ));

    /**
     * Header menu pages
     */
    $wp_customize->add_setting('header_menu_enabled_pages',
        array (
            'default' => '',
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'header_menu_enabled_pages',
        array (
            'label' => __('Menu visibility', 'growtype'),
            'description' => esc_html__('In which pages menu should be visible. If empty, header menu will be visible in all pages.', 'growtype'),
            'section' => $header_menu_section,
            'input_attrs' => array (
                'placeholder' => __('Please select pages...', 'growtype'),
                'multiselect' => true,
            ),
            'choices' => $this->customizer_available_pages,
            'priority' => 1000000,
        )
    ));
}

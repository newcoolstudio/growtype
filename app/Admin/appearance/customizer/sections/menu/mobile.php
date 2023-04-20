<?php

/**
 * Mobile menu
 */

$mobile_menu = !empty(wp_get_nav_menu_object('mobile-menu')) ? wp_get_nav_menu_object('mobile-menu') : wp_get_nav_menu_object('mobile');

if (empty($mobile_menu)) {
    $wp_customize->add_section(
        'mobile_menu_section',
        array (
            'title' => __('Mobile menu', 'growtype'),
            'priority' => 5,
            'panel' => 'nav_menus',
        )
    );

    $mobile_menu_section = 'mobile_menu_section';
} else {
    $mobile_menu_section = 'nav_menu[' . $mobile_menu->term_id . ']';
}

$color_scheme = growtype_get_theme_current_colors_scheme();

/**
 * Mobile menu text color
 */
$wp_customize->add_setting('theme_general_mobile_menu_settings_notice',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'theme_general_mobile_menu_settings_notice',
    array (
        'label' => __('Settings'),
        'description' => __('Below you can change mobile menu settings'),
        'section' => $mobile_menu_section,
        'priority' => 1000000,
    )
));

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

/**
 * Menu position
 */
$wp_customize->add_setting('header_mobile_menu_position',
    array (
        'default' => 'type-1',
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'header_mobile_menu_position',
    array (
        'label' => __('Mobile Menu Position', 'growtype'),
        'description' => esc_html__('Choose mobile menu position', 'growtype'),
        'section' => $mobile_menu_section,
        'input_attrs' => array (
            'placeholder' => __('Please select ...', 'growtype'),
            'multiselect' => false,
        ),
        'choices' => array (
            'right' => __('Right', 'growtype'),
            'left' => __('Left', 'growtype'),
        ),
        'priority' => 1000000,
    )
));

/**
 * Menu animation
 */
$wp_customize->add_setting('header_mobile_menu_animation',
    array (
        'default' => 'type-1',
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'header_mobile_menu_animation',
    array (
        'label' => __('Mobile Menu Animation', 'growtype'),
        'description' => esc_html__('Choose mobile menu animation', 'growtype'),
        'section' => $mobile_menu_section,
        'input_attrs' => array (
            'placeholder' => __('Please select ...', 'growtype'),
            'multiselect' => false,
        ),
        'choices' => array (
            'fade-in' => __('Fade in', 'growtype'),
            'slide-in-left' => __('Slide in left', 'growtype'),
            'slide-in-right' => __('Slide in right', 'growtype'),
        ),
        'priority' => 1000000,
    )
));

/**
 * Mobile burger logo
 */
$wp_customize->add_setting("mobile_burger_logo", array (
    "type" => "theme_mod",
    "capability" => "edit_theme_options",
    "default" => '',
    "transport" => "postMessage",
));

$wp_customize->add_control(new WP_Customize_Media_Control(
    $wp_customize, 'mobile_burger_logo',
    array (
        'label' => __('Logo', 'growtype'),
        'section' => $mobile_menu_section,
        'priority' => 1000000,
    )
));

/**
 * Mobile menu text color
 */
$wp_customize->add_setting('theme_general_mobile_menu_simple_notice',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'theme_general_mobile_menu_simple_notice',
    array (
        'label' => __('Colors'),
        'description' => __('Below you can change mobile menu colors'),
        'section' => $mobile_menu_section,
        'priority' => 1000000,
    )
));

/**
 * Background color
 */
$wp_customize->add_setting('mobile_menu_bg_color', array (
    'default' => $color_scheme['mobile_menu_bg_color'],
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_menu_bg_color', array (
    'label' => __('Background Color', 'growtype'),
    'section' => $mobile_menu_section,
    'alpha' => true,
    'priority' => 1000000,
)));

/**
 * Burger color
 */
$wp_customize->add_setting('mobile_menu_burger_color', array (
    'default' => $color_scheme['mobile_menu_burger_color'],
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_menu_burger_color', array (
    'label' => __('Burger Color', 'growtype'),
    'section' => $mobile_menu_section,
    'alpha' => true,
    'priority' => 1000000,
)));

/**
 * Burger active color
 */
$wp_customize->add_setting('mobile_menu_burger_active_color', array (
    'default' => $color_scheme['mobile_menu_burger_active_color'],
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_menu_burger_active_color', array (
    'label' => __('Burger Active Color', 'growtype'),
    'section' => $mobile_menu_section,
    'alpha' => true,
    'priority' => 1000000,
)));

/**
 * Text color
 */
$wp_customize->add_setting('mobile_menu_text_color', array (
    'default' => $color_scheme['mobile_menu_text_color'],
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mobile_menu_text_color', array (
    'label' => __('Text Color', 'growtype'),
    'section' => $mobile_menu_section,
    'alpha' => true,
    'priority' => 1000000,
)));

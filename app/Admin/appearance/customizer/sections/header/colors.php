<?php

/**
 * Section
 */
$wp_customize->add_section(
    'header_colors',
    array (
        'title' => __('Colors', 'growtype'),
        'priority' => 5,
        'panel' => 'header',
    )
);

/**
 * HEADER GENERAL COLORS SECTION
 */

/**
 * Header general Explanation
 */
$wp_customize->add_setting('header_colors_simple_notice',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'header_colors_simple_notice',
    array (
        'label' => __('Colors - General '),
        'description' => __('Below you can adjust header general colors'),
        'section' => 'header_colors'
    )
));

/**
 * Header bg color
 */
$wp_customize->add_setting('header_background_color', array (
    'default' => $color_scheme['header_background_color'],
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_background_color', array (
    'label' => __('Header Background', 'growtype'),
    'section' => 'header_colors',
    'alpha' => true,
)));

/**
 * Header text color
 */
$wp_customize->add_setting('header_text_color', array (
    'default' => $color_scheme['header_text_color'],
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_text_color', array (
    'label' => __('Header Text', 'growtype'),
    'section' => 'header_colors',
    'alpha' => true,
)));

/**
 * Header scroll bg color
 */
$wp_customize->add_setting('header_scroll_background_color', array (
    'default' => $color_scheme['header_scroll_background_color'],
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_scroll_background_color', array (
    'label' => __('Header Scroll Background', 'growtype'),
    'section' => 'header_colors',
    'alpha' => true,
)));

/**
 * Header scroll text color
 */
$wp_customize->add_setting('header_text_color_scroll', array (
    'default' => $color_scheme['header_text_color_scroll'],
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_text_color_scroll', array (
    'label' => __('Header Scroll Text', 'growtype'),
    'section' => 'header_colors',
    'alpha' => true,
)));

/**
 * HOME PAGE COLORS SECTION
 */

/**
 * Header general Explanation
 */
$wp_customize->add_setting('theme_general_header_home_simple_notice',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'theme_general_header_home_simple_notice',
    array (
        'label' => __('Colors - Home Page'),
        'description' => __('Below you can adjust home page header colors'),
        'section' => 'header_colors'
    )
));

/**
 * Header bg color
 */
$wp_customize->add_setting('header_home_background_color', array (
    'default' => $color_scheme['header_home_background_color'],
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_home_background_color', array (
    'label' => __('Home Page Header Background', 'growtype'),
    'section' => 'header_colors',
    'alpha' => true,
)));

/**
 * Header scroll text color
 */
$wp_customize->add_setting('header_text_color_home', array (
    'default' => $color_scheme['header_text_color_home'],
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_text_color_home', array (
    'label' => __('Home Page Header Text', 'growtype'),
    'section' => 'header_colors',
    'alpha' => true,
)));

/**
 * Navbar colors
 */

/**
 * Header navbar general Explanation
 */
$wp_customize->add_setting('theme_general_header_navbar_simple_notice',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'theme_general_header_navbar_simple_notice',
    array (
        'label' => __('Colors - Navbar'),
        'description' => __('Below you can change navbar colors'),
        'section' => 'header_colors'
    )
));

/**
 * Navbar general
 */
$wp_customize->add_setting('header_navbar_background_color', array (
    'default' => $color_scheme['header_navbar_background_color'],
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_navbar_background_color', array (
    'label' => __('Header Navbar Background', 'growtype'),
    'section' => 'header_colors',
    'alpha' => true,
)));

/**
 * Navbar elements general
 */
$wp_customize->add_setting('header_navbar_elements_color', array (
    'default' => $color_scheme['header_navbar_elements_color'],
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_navbar_elements_color', array (
    'label' => __('Header Navbar Elements', 'growtype'),
    'section' => 'header_colors',
    'alpha' => true,
)));

/**
 * Promo colors
 */

/**
 * Header navbar general Explanation
 */
$wp_customize->add_setting('header_colors_promo_intro',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'header_colors_promo_intro',
    array (
        'label' => __('Colors - Promo'),
        'description' => __('Below you can change promo colors'),
        'section' => 'header_colors'
    )
));

/**
 * Navbar general
 */
$wp_customize->add_setting('header_promo_background_color', array (
    'default' => $color_scheme['header_promo_background_color'],
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_promo_background_color', array (
    'label' => __('Header Promo Background', 'growtype'),
    'section' => 'header_colors',
    'alpha' => true,
)));

/**
 * Navbar elements general
 */
$wp_customize->add_setting('header_promo_elements_color', array (
    'default' => $color_scheme['header_promo_elements_color'],
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_promo_elements_color', array (
    'label' => __('Header Promo Elements', 'growtype'),
    'section' => 'header_colors',
    'alpha' => true,
)));


<?php

/**
 * Section
 */
$wp_customize->add_section(
    'header_logo',
    array (
        'title' => __('Logo', 'growtype'),
        'priority' => 5,
        'panel' => 'header',
    )
);

/**
 * Intro
 */
$wp_customize->add_setting('header_logo_simple_notice',
    array (
        'default' => '',
        'transport' => 'postMessage',
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'header_logo_simple_notice',
    array (
        'label' => __('Logo Details'),
        'description' => __('Below you can change header logo settings'),
        'section' => 'header_logo'
    )
));

/**
 * Header main logo
 */
$wp_customize->add_setting("header_logo", array (
    "type" => "theme_mod", // or 'option'
    "capability" => "edit_theme_options",
    "transport" => "postMessage",
    'sanitize_callback' => '',
    'sanitize_js_callback' => '' // Basically to_json.
));

$wp_customize->add_control(new WP_Customize_Media_Control(
    $wp_customize, 'header_logo',
    array (
        'label' => __('Logo - Main', 'growtype'),
        'section' => 'header_logo',
    )
));

/**
 * Header scroll logo
 */
$wp_customize->add_setting("header_logo_scroll", array (
    "type" => "theme_mod", // or 'option'
    "capability" => "edit_theme_options",
    "default" => get_template_directory_uri() . '/assets/images/logo/simple.svg',
    "transport" => "postMessage",
    'sanitize_callback' => '',
    'sanitize_js_callback' => '' // Basically to_json.
));

$wp_customize->add_control(new WP_Customize_Media_Control(
    $wp_customize, 'header_logo_scroll',
    array (
        'label' => __('Logo - Scrolling Header', 'growtype'),
        'section' => 'header_logo',
    )
));

/**
 * Home main logo
 */
$wp_customize->add_setting("header_logo_home", array (
    "type" => "theme_mod", // or 'option'
    "capability" => "edit_theme_options",
    "default" => get_template_directory_uri() . '/assets/images/logo/simple.svg',
    "transport" => "postMessage",
    'sanitize_callback' => '',
    'sanitize_js_callback' => '' // Basically to_json.
));

$wp_customize->add_control(new WP_Customize_Media_Control(
    $wp_customize, 'header_logo_home',
    array (
        'label' => __('Logo - Home Page', 'growtype'),
        'section' => 'header_logo',
    )
));

/**
 * Header logo dimensions
 */
$wp_customize->add_setting("header_logo_size_desktop", array (
    "default" => "270",
));

$wp_customize->add_control('header_logo_size_desktop', array (
    'label' => __('Logo Width - Desktop', 'growtype'),
    'description' => __('In pixels', 'growtype'),
    'section' => 'header_logo',
    'type' => 'number',
));

$wp_customize->add_setting("header_logo_size_mobile", array (
    "default" => "200",
));

$wp_customize->add_control('header_logo_size_mobile', array (
    'label' => __('Logo Width - Mobile', 'growtype'),
    'description' => __('In pixels', 'growtype'),
    'section' => 'header_logo',
    'type' => 'number',
));

/**
 * Logo margin desktop
 */
$wp_customize->add_setting("header_logo_position_vertical_desktop", array (
    "default" => "5",
));

$wp_customize->add_control('header_logo_position_vertical_desktop', array (
    'label' => __('Logo Position Vertical - Desktop', 'growtype'),
    'description' => __('In pixels', 'growtype'),
    'section' => 'header_logo',
    'type' => 'number',
));

/**
 * Logo margin mobile
 */
$wp_customize->add_setting("header_logo_position_vertical_mobile", array (
    "default" => "5",
));

$wp_customize->add_control('header_logo_position_vertical_mobile', array (
    'label' => __('Logo Position Vertical - Mobile', 'growtype'),
    'description' => __('In pixels', 'growtype'),
    'section' => 'header_logo',
    'type' => 'number',
));

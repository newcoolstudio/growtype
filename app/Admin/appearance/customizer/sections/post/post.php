<?php

/**
 * Single posts page settings
 */
$wp_customize->add_section(
    'post_single_page',
    array (
        'title' => __('Single Post Page', 'growtype'),
        'priority' => 5,
        'panel' => 'posts',
    )
);

/**
 * Intro
 */
$wp_customize->add_setting('post_single_page_details',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'post_single_page_details',
    array (
        'label' => __('Post Single Page'),
        'description' => __('Below you can change post single page settings.'),
        'section' => 'post_single_page'
    )
));

/**
 * Reading time
 */
$wp_customize->add_setting('post_single_page_reading_time_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'post_single_page_reading_time_disabled',
    array (
        'label' => esc_html__('Disabled'),
        'section' => 'post_single_page',
        'description' => __('Reading time is disabled', 'growtype'),
    )
));

/**
 * Section intro
 */
$wp_customize->add_setting('post_single_page_related_posts_details',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'post_single_page_related_posts_details',
    array (
        'label' => __('Related Posts'),
        'description' => __('Below you can change related posts settings.'),
        'section' => 'post_single_page'
    )
));

/**
 * Related posts
 */
$wp_customize->add_setting('post_single_page_related_posts_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'post_single_page_related_posts_disabled',
    array (
        'label' => esc_html__('Disabled'),
        'section' => 'post_single_page',
        'description' => __('Related posts are disabled', 'growtype'),
    )
));

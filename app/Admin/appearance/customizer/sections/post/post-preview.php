<?php

/**
 * Posts preview settings
 */
$wp_customize->add_section(
    'post_preview',
    array (
        'title' => __('Post Preview', 'growtype'),
        'panel' => 'posts',
    )
);

/**
 * Intro
 */
$wp_customize->add_setting('post_preview_details',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'post_preview_details',
    array (
        'label' => __('Post Preview'),
        'description' => __('Below you can change post preview settings.'),
        'section' => 'post_preview'
    )
));


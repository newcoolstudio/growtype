<?php

add_action("customize_register", "posts_customize_register");
function posts_customize_register($wp_customize)
{
    /**
     * Posts panel
     */
    $wp_customize->add_panel(
        'posts',
        array (
            'priority' => 150,
            'capability' => '',
            'theme_supports' => '',
            'title' => __('Posts', 'growtype'),
        )
    );

    require_once 'post/post.php';
    require_once 'post/post-preview.php';
}

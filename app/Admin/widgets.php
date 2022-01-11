<?php

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'description' => esc_html__('Add widgets here.', 'growtype'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ];

    register_sidebar([
            'name' => __('Primary', 'sage'),
            'id' => 'sidebar-primary'
        ] + $config);

    register_sidebar([
            'name' => __('Footer', 'sage'),
            'id' => 'sidebar-footer'
        ] + $config);

    register_sidebar([
            'name' => __('Shop sidebar', 'growtype'),
            'id' => 'sidebar-shop'
        ] + $config);
});

<?php

$wp_customize->add_section(
    'woocommerce_wishlist_page',
    array (
        'title' => __('Wishlist', 'growtype'),
        'panel' => 'woocommerce',
    )
);

/**
 * Intro
 */
$wp_customize->add_setting('woocommerce_wishlist_page_details',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'woocommerce_wishlist_page_details',
    array (
        'label' => __('Wishlist Settings'),
        'description' => __('Below you can change wishlist details.'),
        'section' => 'woocommerce_wishlist_page'
    )
));

/**
 *
 */
$wp_customize->add_setting('woocommerce_wishlist_page_icon_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_wishlist_page_icon_disabled',
    array (
        'label' => esc_html__('Wishlist Disabled'),
        'description' => __('Enable/disable wishlist.', 'growtype'),
        'section' => 'woocommerce_wishlist_page',
    )
));

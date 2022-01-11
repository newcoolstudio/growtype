<?php

$wp_customize->add_section(
    'woocommerce_cart_page',
    array (
        'title' => __('Cart', 'growtype'),
        'panel' => 'woocommerce',
    )
);

/**
 *
 */
$wp_customize->add_setting('woocommerce_cart_page_icon_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_cart_page_icon_disabled',
    array (
        'label' => esc_html__('Cart Page Icon Disabled'),
        'description' => __('Enable/disable cart page icon.', 'growtype'),
        'section' => 'woocommerce_cart_page',
    )
));

/**
 *
 */
$wp_customize->add_setting('woocommerce_skip_cart_page',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_skip_cart_page',
    array (
        'label' => esc_html__('Skip Cart Page'),
        'description' => __('Skip cart page and go directly to checkout', 'growtype'),
        'section' => 'woocommerce_cart_page',
    )
));

<?php

$wp_customize->add_section(
    'woocommerce_thankyou_page',
    array (
        'title' => __('Thank You Page', 'growtype'),
        'panel' => 'woocommerce',
    )
);

/**
 * Intro
 */
$wp_customize->add_setting('woocommerce_thankyou_page_details',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'woocommerce_thankyou_page_details',
    array (
        'label' => __('Thank You Page'),
        'description' => __('Below you can change "thank you" page settings. Page will be visible after checkout.'),
        'section' => 'woocommerce_thankyou_page'
    )
));

/**
 * Style
 */
$wp_customize->add_setting('woocommerce_thankyou_page_style',
    array (
        'default' => '',
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'woocommerce_thankyou_page_style',
    array (
        'label' => __('Page Style', 'growtype'),
        'description' => esc_html__('Choose page style', 'growtype'),
        'section' => 'woocommerce_thankyou_page',
        'input_attrs' => array (
            'multiselect' => false,
        ),
        'choices' => array (
            'default' => __('Default', 'growtype'),
            'centered' => __('Centered', 'growtype')
        )
    )
));

/**
 * Intro content
 */
$wp_customize->add_setting('woocommerce_thankyou_page_intro_content',
    array (
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'woocommerce_thankyou_page_intro_content_translation'
    )
);

$wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'woocommerce_thankyou_page_intro_content',
    array (
        'label' => __('Intro Content'),
        'description' => __('Intro details.'),
        'section' => 'woocommerce_thankyou_page',
        'priority' => 10,
        'input_attrs' => array (
            'class' => 'qtranxs-translatable',
            'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
            'toolbar2' => 'formatselect',
            'mediaButtons' => true,
        )
    )
));

/**
 * Intro content not active account
 */
$wp_customize->add_setting('woocommerce_thankyou_page_intro_content_disabled_account',
    array (
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'woocommerce_thankyou_page_intro_content_disabled_account_translation'
    )
);

$wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'woocommerce_thankyou_page_intro_content_disabled_account',
    array (
        'label' => __('Intro Content - Disabled Account'),
        'description' => __('Extra details when account is not activated.'),
        'section' => 'woocommerce_thankyou_page',
        'priority' => 10,
        'input_attrs' => array (
            'class' => 'qtranxs-translatable',
            'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
            'toolbar2' => 'formatselect',
            'mediaButtons' => true,
        )
    )
));

/**
 *
 */
$wp_customize->add_setting('woocommerce_thankyou_page_order_overview_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_thankyou_page_order_overview_disabled',
    array (
        'label' => esc_html__('Order Overview Disabled'),
        'section' => 'woocommerce_thankyou_page',
        'description' => __('Enable/disable order overview.', 'growtype'),
    )
));

/**
 *
 */
$wp_customize->add_setting('woocommerce_thankyou_page_order_details_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_thankyou_page_order_details_disabled',
    array (
        'label' => esc_html__('Order Details Disabled'),
        'section' => 'woocommerce_thankyou_page',
        'description' => __('Enable/disable order details.', 'growtype'),
    )
));

/**
 *
 */
$wp_customize->add_setting('woocommerce_thankyou_page_customer_details_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_thankyou_page_customer_details_disabled',
    array (
        'label' => esc_html__('Customer Details Disabled'),
        'section' => 'woocommerce_thankyou_page',
        'description' => __('Enable/disable customer details.', 'growtype'),
    )
));

/**
 *
 */
$wp_customize->add_setting('woocommerce_thankyou_page_download_details_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_thankyou_page_download_details_disabled',
    array (
        'label' => esc_html__('Download Details Disabled'),
        'section' => 'woocommerce_thankyou_page',
        'description' => __('Enable/disable download details.', 'growtype'),
    )
));

/**
 *
 */
$wp_customize->add_setting('woocommerce_thankyou_page_order_again_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_thankyou_page_order_again_disabled',
    array (
        'label' => esc_html__('Order Again Disabled'),
        'section' => 'woocommerce_thankyou_page',
        'description' => __('Enable/disable order again link.', 'growtype'),
    )
));

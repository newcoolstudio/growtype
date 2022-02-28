<?php

$wp_customize->add_section(
    'woocommerce_account_page',
    array (
        'title' => __('Account', 'growtype'),
        'panel' => 'woocommerce',
    )
);

/**
 * Intro
 */
$wp_customize->add_setting('woocommerce_account_page_details',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'woocommerce_account_page_details',
    array (
        'label' => __('Account Settings'),
        'description' => __('Below you can change account page details.'),
        'section' => 'woocommerce_account_page'
    )
));

/**
 * Account icon
 */
$wp_customize->add_setting('woocommerce_account_page_icon_enabled',
    array (
        'default' => 1,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_account_page_icon_enabled',
    array (
        'label' => esc_html__('User Account Icon'),
        'description' => __('Enable/disable user account page icon in header.', 'growtype'),
        'section' => 'woocommerce_account_page',
    )
));

/**
 * Intro
 */
$wp_customize->add_setting('woocommerce_account_page_tabs_intro',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'woocommerce_account_page_tabs_intro',
    array (
        'label' => __('Account Tabs'),
        'description' => __('Below you can change account page tabs settings.'),
        'section' => 'woocommerce_account_page'
    )
));

/**
 * Downloads tab
 */

$wp_customize->add_setting('woocommerce_account_downloads_tab_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_account_downloads_tab_disabled',
    array (
        'label' => esc_html__('Downloads Disabled'),
        'description' => __('Enable/disable downloads tab in user account.', 'growtype'),
        'section' => 'woocommerce_account_page',
    )
));

/**
 * Purchased products tab
 */
$wp_customize->add_setting('woocommerce_account_purchased_products_tab_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_account_purchased_products_tab_disabled',
    array (
        'label' => esc_html__('Purchased Products Disable'),
        'description' => __('Enable/disable purchased products tab in user account.', 'growtype'),
        'section' => 'woocommerce_account_page',
    )
));

/**
 * Uploaded products tab
 */
$wp_customize->add_setting('woocommerce_account_uploaded_products_tab_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_account_uploaded_products_tab_disabled',
    array (
        'label' => esc_html__('Uploaded Products Disable'),
        'description' => __('Enable/disable uploaded products tab in user account.', 'growtype'),
        'section' => 'woocommerce_account_page',
    )
));

/**
 * Subscriptions tab
 */
$wp_customize->add_setting('woocommerce_account_subscriptions_tab_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_account_subscriptions_tab_disabled',
    array (
        'label' => esc_html__('Subscriptions Disable'),
        'description' => __('Enable/disable subscriptions tab in user account.', 'growtype'),
        'section' => 'woocommerce_account_page',
    )
));

/**
 * Logout tab
 */
$wp_customize->add_setting('woocommerce_account_logout_tab_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_account_logout_tab_disabled',
    array (
        'label' => esc_html__('Logout Tab Disabled'),
        'description' => __('Enable/disable logout tab in user account.', 'growtype'),
        'section' => 'woocommerce_account_page',
    )
));

/**
 * Addresses tab
 */
$wp_customize->add_setting('woocommerce_account_addresses_tab_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_account_addresses_tab_disabled',
    array (
        'label' => esc_html__('Addresses Disabled'),
        'description' => __('Enable/disable addresses tab in user account.', 'growtype'),
        'section' => 'woocommerce_account_page',
    )
));

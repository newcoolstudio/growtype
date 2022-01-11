<?php

$wp_customize->add_section(
    'woocommerce_email_page',
    array (
        'title' => __('Emails', 'growtype'),
        'panel' => 'woocommerce',
    )
);

/**
 * Intro
 */
$wp_customize->add_setting('woocommerce_email_page_details',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'woocommerce_email_page_details',
    array (
        'label' => __('Email Settings'),
        'description' => __('Below you can change email details. You cant find ' . '<a href="' . admin_url() . 'admin.php?page=wc-settings&tab=email" target="_blank">full settings here</a>.'),
        'section' => 'woocommerce_email_page'
    )
));

/**
 * Email templates select
 */
$wp_customize->add_setting('woocommerce_email_page_template',
    array (
        'default' => 'WC_Email_Customer_Invoice',
        'transport' => 'refresh'
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'woocommerce_email_page_template',
    array (
        'label' => __('Preview Email Template', 'growtype'),
        'section' => 'woocommerce_email_page',
        'input_attrs' => array (
            'multiselect' => false,
        ),
        'choices' => get_email_options()
    )
));

/**
 * Email Intro content Successful
 */
$wp_customize->add_setting('wc_email_customer_invoice_successful_main_content',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'wc_email_customer_invoice_successful_main_content',
    array (
        'label' => __('Customer Invoice "Successful Order" Intro Content'),
        'description' => __('Available variables: {customer_name} , {date_created}'),
        'section' => 'woocommerce_email_page',
        'input_attrs' => array (
            'class' => 'qtranxs-translatable',
            'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
            'toolbar2' => 'formatselect',
            'mediaButtons' => true,
        )
    )
));

/**
 * Email Intro content Pending
 */
$wp_customize->add_setting('wc_email_customer_invoice_pending_main_content',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'wc_email_customer_invoice_pending_main_content',
    array (
        'label' => __('Customer Invoice "Pending Order" Intro Content'),
        'description' => __('Available variables: {customer_name} , {date_created}'),
        'section' => 'woocommerce_email_page',
        'input_attrs' => array (
            'class' => 'qtranxs-translatable',
            'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
            'toolbar2' => 'formatselect',
            'mediaButtons' => true,
        )
    )
));

/**
 * Email successful order
 */
$wp_customize->add_setting('wc_email_customer_completed_order_main_content',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'wc_email_customer_completed_order_main_content',
    array (
        'label' => __('"Completed Order" Intro Content'),
        'description' => __('Available variables: {customer_name} , {date_created}'),
        'section' => 'woocommerce_email_page',
        'input_attrs' => array (
            'class' => 'qtranxs-translatable',
            'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
            'toolbar2' => 'formatselect',
            'mediaButtons' => true,
        )
    )
));

/**
 * Extra content
 */
$wp_customize->add_setting('wc_email_customer_processing_order_main_content',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'wc_email_customer_processing_order_main_content',
    array (
        'label' => __('"Processing Order" Content'),
        'description' => __('Email which customer receives after successful purchase.'),
        'section' => 'woocommerce_email_page',
        'input_attrs' => array (
            'class' => 'qtranxs-translatable',
            'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
            'toolbar2' => 'formatselect',
            'mediaButtons' => true,
        )
    )
));

/**
 * Intro
 */
$wp_customize->add_setting('woocommerce_email_page_general_settings_intro',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'woocommerce_email_page_general_settings_intro',
    array (
        'label' => __('General Settings'),
        'description' => __('Below you can change general settings For All Email Templates.'),
        'section' => 'woocommerce_email_page'
    )
));

/**
 * Header content
 */
$wp_customize->add_setting('woocommerce_email_page_header_title_switch',
    array (
        'default' => 1,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_email_page_header_title_switch',
    array (
        'label' => esc_html__('Show Header Title'),
        'section' => 'woocommerce_email_page',
        'description' => __('Enable/disable email header tittle.', 'growtype'),
    )
));

/**
 *
 */
$wp_customize->add_setting('woocommerce_email_page_order_overview_switch',
    array (
        'default' => 1,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_email_page_order_overview_switch',
    array (
        'label' => esc_html__('Show Order Overview'),
        'section' => 'woocommerce_email_page',
        'description' => __('Enable/disable order overview for all email templates.', 'growtype'),
    )
));

/**
 *
 */
$wp_customize->add_setting('woocommerce_email_page_customer_details_switch',
    array (
        'default' => 1,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_email_page_customer_details_switch',
    array (
        'label' => esc_html__('Show Billing Details'),
        'section' => 'woocommerce_email_page',
        'description' => __('Enable/disable billing details for all email templates.', 'growtype'),
    )
));

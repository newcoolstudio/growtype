<?php

/**
 * Checkout style
 */
$wp_customize->add_setting('woocommerce_checkout_style_select',
    array (
        'default' => 'default',
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'woocommerce_checkout_style_select',
    array (
        'label' => __('Checkout style', 'growtype'),
        'section' => 'woocommerce_checkout',
        'priority' => 9,
        'input_attrs' => array (
            'multiselect' => false,
        ),
        'choices' => array (
            'default' => __('Default', 'growtype'),
            'vertical' => __('Vertical', 'growtype')
        )
    )
));

/**
 * Order notes
 */
$wp_customize->add_setting('woocommerce_checkout_order_notes',
    array (
        'default' => 'hidden',
        'transport' => 'refresh'
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'woocommerce_checkout_order_notes',
    array (
        'label' => __('Order notes', 'growtype'),
        'section' => 'woocommerce_checkout',
        'input_attrs' => array (
            'multiselect' => false,
        ),
        'choices' => [
            'hidden' => 'Hidden',
            'optional' => 'Optional',
            'required' => 'Required'
        ],
        'priority' => 10
    )
));

/**
 * Email
 */
$wp_customize->add_setting('woocommerce_checkout_email',
    array (
        'default' => 'required',
        'transport' => 'refresh'
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'woocommerce_checkout_email',
    array (
        'label' => __('Email', 'growtype'),
        'section' => 'woocommerce_checkout',
        'input_attrs' => array (
            'multiselect' => false,
        ),
        'choices' => [
            'hidden' => 'Hidden',
            'optional' => 'Optional',
            'required' => 'Required'
        ],
        'priority' => 10
    )
));

/**
 * Postcode
 */
$wp_customize->add_setting('woocommerce_checkout_postcode',
    array (
        'default' => 'required',
        'transport' => 'refresh'
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'woocommerce_checkout_postcode',
    array (
        'label' => __('Postcode', 'growtype'),
        'section' => 'woocommerce_checkout',
        'input_attrs' => array (
            'multiselect' => false,
        ),
        'choices' => [
            'hidden' => 'Hidden',
            'optional' => 'Optional',
            'required' => 'Required'
        ],
        'priority' => 10
    )
));

/**
 * Order review
 */
$wp_customize->add_setting('woocommerce_checkout_order_review_table',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_checkout_order_review_table',
    array (
        'label' => esc_html__('Order review table'),
        'section' => 'woocommerce_checkout',
        'description' => __('Enabled/disable order review table', 'growtype'),
    )
));

/**
 * Show 'optional' input labels
 */
$wp_customize->add_setting('woocommerce_checkout_optional_label', array (
    'default' => '0'
));

$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'woocommerce_checkout_optional_label',
        array (
            'label' => __('Highlight optional fields with label', 'growtype'),
            'section' => 'woocommerce_checkout',
            'settings' => 'woocommerce_checkout_optional_label',
            'type' => 'checkbox',
            'priority' => 9,
        )
    )
);

/**
 * Order review heading
 */
$wp_customize->add_setting('woocommerce_checkout_order_review_heading',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_checkout_order_review_heading',
    array (
        'label' => esc_html__('Order review heading'),
        'section' => 'woocommerce_checkout',
        'description' => __('Enabled/disable order review heading', 'growtype'),
    )
));

/**
 * Order review background
 */
$wp_customize->add_setting('woocommerce_checkout_order_review_background',
    array (
        'default' => 1,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_checkout_order_review_background',
    array (
        'label' => esc_html__('Payments background'),
        'section' => 'woocommerce_checkout',
        'description' => __('Enabled/disable payment methods background', 'growtype'),
    )
));

/**
 * Intro
 */
$wp_customize->add_setting('woocommerce_checkout_section_titles_notice',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'woocommerce_checkout_section_titles_notice',
    array (
        'label' => __('Texts'),
        'description' => __('Below you can change main texts'),
        'section' => 'woocommerce_checkout'
    )
));

/**
 * Checkout intro
 */
$wp_customize->add_setting('woocommerce_checkout_intro_text',
    array (
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'woocommerce_checkout_intro_text_translation'
    )
);

$wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'woocommerce_checkout_intro_text',
    array (
        'label' => __('Intro Content'),
        'description' => __('Intro details.'),
        'section' => 'woocommerce_checkout',
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
 * Billing section title
 */
$wp_customize->add_setting('woocommerce_checkout_billing_section_title', array (
    'capability' => 'edit_theme_options',
    'default' => 'Billing details',
    'sanitize_callback' => 'woocommerce_checkout_billing_section_title_translation'
));

$wp_customize->add_control('woocommerce_checkout_billing_section_title', array (
    'type' => 'text',
    'section' => 'woocommerce_checkout', // Add a default or your own section
    'label' => __('"Billing Details" Section Title'),
    'description' => __('Default: Billing details')
));

/**
 * Additional section title
 */
$wp_customize->add_setting('woocommerce_checkout_additional_section_title', array (
    'capability' => 'edit_theme_options',
    'default' => 'Additional details',
    'sanitize_callback' => 'woocommerce_checkout_additional_section_title_translation'
));

$wp_customize->add_control('woocommerce_checkout_additional_section_title', array (
    'type' => 'text',
    'section' => 'woocommerce_checkout', // Add a default or your own section
    'label' => __('"Additional Details" Section Title'),
    'description' => __('Default: Additional details')
));

/**
 * Account section title
 */
$wp_customize->add_setting('woocommerce_checkout_account_section_title', array (
    'capability' => 'edit_theme_options',
    'default' => 'Account details',
    'sanitize_callback' => 'woocommerce_checkout_account_section_title_translation'
));

$wp_customize->add_control('woocommerce_checkout_account_section_title', array (
    'type' => 'text',
    'section' => 'woocommerce_checkout', // Add a default or your own section
    'label' => __('"Account details" Section Title'),
    'description' => __('Default: Additional details')
));

/**
 * Place order button title
 */
$wp_customize->add_setting('woocommerce_checkout_place_order_button_title', array (
    'capability' => 'edit_theme_options',
    'default' => 'Place order',
    'sanitize_callback' => 'woocommerce_checkout_place_order_button_title_translation'
));

$wp_customize->add_control('woocommerce_checkout_place_order_button_title', array (
    'type' => 'text',
    'section' => 'woocommerce_checkout', // Add a default or your own section
    'label' => __('"Place order" Button Title'),
    'description' => __('Default: Place order')
));

/**
 * Create account
 */
$wp_customize->add_setting('woocommerce_checkout_create_account_checked',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_checkout_create_account_checked',
    array (
        'label' => esc_html__('Create Account Checked'),
        'section' => 'woocommerce_checkout',
        'description' => __('Create account checkbox checked by default.', 'growtype'),
    )
));

<?php

/**
 * Section
 */
$wp_customize->add_section(
    'header_general',
    array (
        'title' => __('General', 'growtype'),
        'priority' => 5,
        'panel' => 'header',
    )
);

/**
 * Header explanation
 */
$wp_customize->add_setting('header_general_simple_notice',
    array (
        'default' => '',
        'transport' => 'postMessage',
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'header_general_simple_notice',
    array (
        'label' => __('General Details'),
        'description' => __('Below you can change header settings'),
        'section' => 'header_general'
    )
));

/**
 * Header enabled
 */
$wp_customize->add_setting('header_is_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'header_is_disabled',
    array (
        'label' => esc_html__('Header Disabled'),
        'section' => 'header_general',
        'description' => __('Header is disabled', 'growtype'),
    )
));

/**
 * Header type selector
 */
$wp_customize->add_setting('header_type_select',
    array (
        'default' => 'type-1',
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'header_type_select',
    array (
        'label' => __('Header Style', 'growtype'),
        'description' => esc_html__('Choose header style', 'growtype'),
        'section' => 'header_general',
        'input_attrs' => array (
            'placeholder' => __('Please select a header...', 'growtype'),
            'multiselect' => false,
        ),
        'choices' => array (
            'type-1' => __('Style 1', 'growtype'),
            'type-2' => __('Style 2', 'growtype'),
            'type-3' => __('Style 3', 'growtype'),
        )
    )
));

/**
 * Header is absolute
 */
$wp_customize->add_setting('header_is_absolute_switch',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'header_is_absolute_switch',
    array (
        'label' => esc_html__('Absolute Header'),
        'section' => 'header_general',
        'description' => __('Header is absolute', 'growtype'),
    )
));

/**
 * Header is fixed switch
 */
$wp_customize->add_setting('header_is_fixed_switch',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'header_is_fixed_switch',
    array (
        'label' => esc_html__('Sticky Header'),
        'section' => 'header_general',
        'description' => __('Header is fixed', 'growtype'),
    )
));

/**
 * Header fixed pages
 */
$wp_customize->add_setting('header_fixed_dropdown_control',
    array (
        'default' => '',
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'header_fixed_dropdown_control',
    array (
        'label' => __('Sticky header pages', 'growtype'),
        'description' => esc_html__('In which pages header should be sticky/fixed. If empty, header fill be fixed in ALL pages.', 'growtype'),
        'section' => 'header_general',
        'input_attrs' => array (
            'placeholder' => __('Please select pages...', 'growtype'),
            'multiselect' => true,
        ),
        'choices' => $this->available_pages
    )
));

/**
 * Page title switch
 */
$wp_customize->add_setting('header_page_title_enabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'header_page_title_enabled',
    array (
        'label' => esc_html__('Page Title'),
        'section' => 'header_general',
        'description' => __('Header has page title', 'growtype'),
    )
));

/**
 * Page title pages
 */
$wp_customize->add_setting('header_page_title_pages',
    array (
        'default' => '',
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'header_page_title_pages',
    array (
        'label' => __('Page Title Pages', 'growtype'),
        'description' => esc_html__('In which pages, page title should be visible.', 'growtype'),
        'section' => 'header_general',
        'input_attrs' => array (
            'placeholder' => __('Please select pages...', 'growtype'),
            'multiselect' => true,
        ),
        'choices' => $this->available_pages
    )
));

/**
 * Header extra space
 */
$wp_customize->add_setting('header_extra_space_switch',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'header_extra_space_switch',
    array (
        'label' => esc_html__('Extra Header Space'),
        'section' => 'header_general',
        'description' => __('Give extra space for header', 'growtype'),
    )
));

/**
 * Extra space pages
 */
$wp_customize->add_setting('extra_space_disabled_dropdown_control',
    array (
        'default' => get_option('page_on_front'),
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'extra_space_disabled_dropdown_control',
    array (
        'label' => __('Extra space disabled pages', 'growtype'),
        'description' => esc_html__('In which pages extra space should be disabled. If empty, every page will have extra header space.', 'growtype'),
        'section' => 'header_general',
        'input_attrs' => array (
            'placeholder' => __('Please select pages...', 'growtype'),
            'multiselect' => true,
        ),
        'choices' => $this->available_pages
    )
));

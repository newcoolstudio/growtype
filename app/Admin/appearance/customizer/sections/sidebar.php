<?php

add_action("customize_register", "sidebar_customize_register");
function sidebar_customize_register($wp_customize)
{
    $color_scheme = get_theme_color_scheme();

    /**
     * Sidebar
     */

    $wp_customize->add_section('sidebar', array (
        "title" => __("Sidebar", "growtype"),
        "priority" => 60,
    ));

    /**
     * Footr explanation
     */

    $wp_customize->add_setting('sidebar_simple_notice',
        array (
            'default' => '',
            'transport' => 'postMessage',
        )
    );

    $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'sidebar_simple_notice',
        array (
            'label' => __('"Primary" Sidebar Details'),
            'description' => __('Below you can change primary sidebar settings'),
            'section' => 'sidebar'
        )
    ));

    /**
     * Sidebar enabled
     */
    $wp_customize->add_setting('sidebar_primary_is_enabled',
        array (
            'default' => 0,
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'sidebar_primary_is_enabled',
        array (
            'label' => esc_html__('"Primary" Sidebar Enabled'),
            'section' => 'sidebar',
            'description' => __('Enable primary sidebar', 'growtype'),
        )
    ));

    /**
     * Sidebar pages
     */
    $wp_customize->add_setting('sidebar_primary_pages',
        array (
            'default' => '',
            'transport' => 'refresh',
        )
    );

    $sidebar_primary_pages = [];
    $all_pages = get_pages();

    if (!empty($all_pages)) {
        foreach ($all_pages as $single_page) {
            $sidebar_primary_pages[$single_page->ID] = $single_page->post_title . ' (' . $single_page->post_name . ')';
        }
    }

    /**
     * Single pages
     */
    $sidebar_primary_pages['single'] = 'Single pages';

    $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'sidebar_primary_pages',
        array (
            'label' => __('"Primary" Sidebar Pages', 'growtype'),
            'description' => esc_html__('In which pages primary sidebar should be visible. If empty, primary sidebar will be visible in all pages.', 'growtype'),
            'section' => 'sidebar',
            'input_attrs' => array (
                'placeholder' => __('Please select pages...', 'growtype'),
                'multiselect' => true,
            ),
            'choices' => $sidebar_primary_pages
        )
    ));

    /**
     * Sidebar position
     */
    $wp_customize->add_setting('sidebar_primary_position',
        array (
            'default' => 'left',
            'transport' => 'refresh',
        )
    );
    $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'sidebar_primary_position',
        array (
            'label' => __('"Primary" Sidebar Position', 'growtype'),
            'description' => esc_html__('Choose primary sidebar position', 'growtype'),
            'section' => 'sidebar',
            'input_attrs' => array (
                'placeholder' => __('Choose position...', 'growtype'),
                'multiselect' => false,
            ),
            'choices' => array (
                'left' => __('Left', 'growtype'),
                'right' => __('Right', 'growtype'),
            )
        )
    ));
}

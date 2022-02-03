<?php

/**
 * Setup
 */
class Search_Customizer_Register
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $customizer_available_data = new Customizer_Available_Data();
        $this->customizer_available_pages = $customizer_available_data->get_available_pages();
        $this->customizer_available_post_types = $customizer_available_data->get_available_post_types();

        add_action('customize_register', array ($this, 'customizer_init'));
    }

    function customizer_init($wp_customize)
    {
        /**
         * Header section initialize
         */
        $wp_customize->add_section('search', array (
            "title" => __("Search", "growtype"),
            "priority" => 100,
        ));

        /**
         *
         */
        $wp_customize->add_setting('search_enabled',
            array (
                'default' => 0,
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'search_enabled',
            array (
                'label' => esc_html__('Enabled'),
                'description' => __('Enable/disable search.', 'growtype'),
                'section' => 'search',
            )
        ));

        /**
         *
         */
        $wp_customize->add_setting('search_icon_enabled',
            array (
                'default' => 0,
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'search_icon_enabled',
            array (
                'label' => esc_html__('Icon Header'),
                'description' => __('Enable/disable search icon in header.', 'growtype'),
                'section' => 'search',
            )
        ));

        /**
         * Search style
         */
        $wp_customize->add_setting('search_style',
            array (
                'default' => '',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'search_style',
            array (
                'label' => __('Search Style', 'growtype'),
                'description' => esc_html__('Choose search style', 'growtype'),
                'section' => 'search',
                'input_attrs' => array (
                    'multiselect' => false,
                ),
                'choices' => array (
                    'inline' => __('Inline', 'growtype'),
                    'fixed' => __('Fixed', 'growtype')
                )
            )
        ));

        /**
         * Search post types
         */
        $wp_customize->add_setting('search_post_types_enabled',
            array (
                'default' => '',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'search_post_types_enabled',
            array (
                'label' => __('Post types included', 'growtype'),
                'description' => esc_html__('In which post types search should be conducted.', 'growtype'),
                'section' => 'search',
                'input_attrs' => array (
                    'placeholder' => __('Please select post types...', 'growtype'),
                    'multiselect' => true,
                ),
                'choices' => $this->customizer_available_post_types
            )
        ));

        /**
         * Search pages
         */
        $wp_customize->add_setting('search_enabled_pages',
            array (
                'default' => '',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'search_enabled_pages',
            array (
                'label' => __('Pages', 'growtype'),
                'description' => esc_html__('In which pages search available.', 'growtype'),
                'section' => 'search',
                'input_attrs' => array (
                    'placeholder' => __('Please select pages...', 'growtype'),
                    'multiselect' => true,
                ),
                'choices' => $this->customizer_available_pages
            )
        ));
    }
}

new Search_Customizer_Register();

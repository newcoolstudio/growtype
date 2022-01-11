<?php

class Panel_Customizer_Register
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $customizer_available_data = new Customizer_Available_Data();
        $this->customizer_available_pages = $customizer_available_data->get_available_pages();

        add_action('customize_register', array ($this, 'customizer_init'));
    }

    function customizer_init($wp_customize)
    {
        /**
         * Panel explanation
         */

        $wp_customize->add_setting('panel_simple_notice',
            array (
                'default' => '',
                'transport' => 'postMessage',
            )
        );

        $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'panel_simple_notice',
            array (
                'label' => __('Panel Details'),
                'description' => __('Below you can change panel settings'),
                'section' => 'panel'
            )
        ));

        /**
         * Panel
         */

        $wp_customize->add_section('panel', array (
            "title" => __("Panel", "growtype"),
            "priority" => 60,
        ));

        /**
         * Panel enabled
         */
        $wp_customize->add_setting('panel_is_enabled',
            array (
                'default' => 0,
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'panel_is_enabled',
            array (
                'label' => esc_html__('Panel Enabled'),
                'section' => 'panel',
                'description' => __('Panel is enabled', 'growtype'),
            )
        ));

        /**
         * Panel pages
         */
        $wp_customize->add_setting('panel_enabled_pages',
            array (
                'default' => '',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'panel_enabled_pages',
            array (
                'label' => __('Panel pages', 'growtype'),
                'description' => esc_html__('In which pages panel should be visible. If empty, panel will be visible in all pages.', 'growtype'),
                'section' => 'panel',
                'input_attrs' => array (
                    'placeholder' => __('Please select pages...', 'growtype'),
                    'multiselect' => true,
                ),
                'choices' => $this->customizer_available_pages
            )
        ));

        /**
         * Panel position
         */
        $wp_customize->add_setting('panel_position',
            array (
                'default' => 'left',
                'transport' => 'refresh',
            )
        );
        $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'panel_position',
            array (
                'label' => __('Panel position', 'growtype'),
                'description' => esc_html__('Choose panel position', 'growtype'),
                'section' => 'panel',
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

        /**
         * Panel logo
         */

        $wp_customize->add_setting('panel_logo_simple_notice',
            array (
                'default' => '',
                'transport' => 'postMessage',
            )
        );

        $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'panel_logo_simple_notice',
            array (
                'label' => __('Logo Details'),
                'description' => __('Below you can change panel logo settings'),
                'section' => 'panel'
            )
        ));

        /**
         * panel main logo
         */
        $wp_customize->add_setting("panel_logo", array (
            "type" => "theme_mod", // or 'option'
            "capability" => "edit_theme_options",
            "default" => get_template_directory_uri() . '/assets/images/logo/simple.svg',
            "transport" => "postMessage",
            'sanitize_callback' => '',
            'sanitize_js_callback' => '' // Basically to_json.
        ));

        $wp_customize->add_control(new WP_Customize_Media_Control(
            $wp_customize, 'panel_logo',
            array (
                'label' => __('Logo', 'growtype'),
                'section' => 'panel',
            )
        ));
    }
}

new Panel_Customizer_Register();




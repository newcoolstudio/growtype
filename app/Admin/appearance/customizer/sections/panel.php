<?php

class Panel_Customizer_Register extends Growtype_Customizer
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

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
         * Panel sticky
         */
        $wp_customize->add_setting('panel_is_sticky',
            array (
                'default' => 0,
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'panel_is_sticky',
            array (
                'label' => esc_html__('Panel Sticky'),
                'section' => 'panel',
                'description' => __('Panel is sticky', 'growtype'),
            )
        ));

        /**
         * Auto height
         */
        $wp_customize->add_setting('panel_auto_adjust_height',
            array (
                'default' => 1,
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'panel_auto_adjust_height',
            array (
                'label' => esc_html__('Panel Auto Height'),
                'section' => 'panel',
                'description' => __('Panel auto adjust height', 'growtype'),
            )
        ));

        /**
         * Panel has header
         */
        $wp_customize->add_setting('panel_has_header',
            array (
                'default' => 0,
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'panel_has_header',
            array (
                'label' => esc_html__('Panel Header'),
                'section' => 'panel',
                'description' => __('Panel has header', 'growtype'),
            )
        ));

        /**
         * Panel style
         */
        $wp_customize->add_setting('panel_style',
            array (
                'default' => 'style-1',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'panel_style',
            array (
                'label' => __('Panel Style', 'growtype'),
                'description' => esc_html__('Choose panel style', 'growtype'),
                'section' => 'panel',
                'input_attrs' => array (
                    'placeholder' => __('Please select a panel style...', 'growtype'),
                    'multiselect' => false,
                ),
                'choices' => array (
                    'style-1' => __('Style 1', 'growtype'),
                    'style-2' => __('Style 2', 'growtype')
                )
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
                'label' => __('Panel Pages', 'growtype'),
                'description' => esc_html__('In which pages panel should be visible. If empty, panel will be visible in all pages.', 'growtype'),
                'section' => 'panel',
                'input_attrs' => array (
                    'placeholder' => __('Please select pages...', 'growtype'),
                    'multiselect' => true,
                ),
                'choices' => $this->available_pages
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
                'label' => __('Panel Position', 'growtype'),
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

        /**
         * Panel user profile
         */
        $wp_customize->add_setting('panel_show_user_profile',
            array (
                'default' => 0,
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'panel_show_user_profile',
            array (
                'label' => esc_html__('Show User Profile'),
                'section' => 'panel',
                'description' => __('Enable user profile in panel', 'growtype'),
            )
        ));
    }
}

new Panel_Customizer_Register();




<?php

class General_Customizer_Register
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        add_action('customize_register', array ($this, 'customizer_init'));
    }

    function customizer_init($wp_customize)
    {
        $wp_customize->add_section('theme-general', array (
            "title" => __("General", "growtype"),
            "description" => __('Change general settings'),
            "priority" => 20,
        ));

        /**
         * Under construction
         */
        $wp_customize->add_setting('theme_general_construction_notice',
            array (
                'default' => '',
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'theme_general_construction_notice',
            array (
                'label' => __('Construction'),
                'description' => __('Below you can change under construction settings'),
                'section' => 'theme-general'
            )
        ));

        $wp_customize->add_setting('under_construction_switch',
            array (
                'default' => 0,
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'under_construction_switch',
            array (
                'label' => esc_html__('Under Construction'),
                'section' => 'theme-general',
                'description' => __('Page is under construction for non logged users', 'growtype'),
            )
        ));
    }
}

new General_Customizer_Register();

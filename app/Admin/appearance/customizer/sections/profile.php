<?php

class Profile_Customizer_Register
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
        $wp_customize->add_section('profile', array (
            "title" => __("User Profile", "growtype"),
            "priority" => 20,
        ));

        /**
         * Profile menu settings
         */
        $wp_customize->add_setting('profile_simple_notice',
            array (
                'default' => '',
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'profile_simple_notice',
            array (
                'label' => __('User Profile'),
                'description' => __('Below you can change user profile details'),
                'section' => 'profile'
            )
        ));

        $wp_customize->add_setting('profile_menu_enabled',
            array (
                'default' => 0,
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'profile_menu_enabled',
            array (
                'label' => esc_html__('User Profile Menu'),
                'section' => 'profile',
                'description' => __('Enable or disable user profile menu', 'growtype'),
            )
        ));

        /**
         * Account icon
         */
        $wp_customize->add_setting('user_account_icon_enabled',
            array (
                'default' => 0,
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'user_account_icon_enabled',
            array (
                'label' => esc_html__('User Account Icon'),
                'description' => __('Enable/disable user account page icon in header.', 'growtype'),
                'section' => 'profile',
            )
        ));

        /**
         * Profile name
         */
        $wp_customize->add_setting("user_account_name", array (
            "default" => "#user_display_name",
        ));

        $wp_customize->add_control('user_account_name', array (
            'label' => esc_html__('User Account Name'),
            'section' => 'profile',
            'description' => __('F.e. can use #user_display_name', 'growtype'),
        ));

        /**
         * Redirect after login
         */
        $wp_customize->add_setting("user_account_permalink", array (
            "default" => "",
        ));

        $wp_customize->add_control('user_account_permalink', array (
            'label' => esc_html__('User Account Url'),
            'section' => 'profile',
            'description' => __('User account url without domain', 'growtype'),
        ));
    }
}

new Profile_Customizer_Register();

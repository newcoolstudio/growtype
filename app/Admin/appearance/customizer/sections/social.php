<?php

class Social_Customizer_Register
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
        $wp_customize->add_section('social', array (
            "title" => __("Social", "growtype"),
            "priority" => 90,
        ));

        /**
         * Social explanation
         */

        $wp_customize->add_setting('social_simple_notice',
            array (
                'default' => '',
                'transport' => 'postMessage',
            )
        );

        $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'social_simple_notice',
            array (
                'label' => __('Social Details'),
                'description' => __('Below you can change social settings'),
                'section' => 'social'
            )
        ));

        /**
         * Navbar social icon facebook
         */

        $wp_customize->add_setting('header_navbar_social_facebook', array (
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control('header_navbar_social_facebook', array (
            'type' => 'checkbox',
            'section' => 'social',
            'label' => __('Facebook', 'growtype')
        ));

        $wp_customize->add_setting("header_navbar_social_facebook_url", array (
            "default" => "",
        ));

        $wp_customize->add_control('header_navbar_social_facebook_url', array ( // setting id
            'label' => __('Facebook Url', 'growtype'),
            'section' => 'social',
            'type' => 'text',
        ));

        /**
         * Navbar social icon twitter
         */
        $wp_customize->add_setting('header_navbar_social_twitter', array (
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control('header_navbar_social_twitter', array (
            'type' => 'checkbox',
            'section' => 'social',
            'label' => __('Twitter', 'growtype')
        ));

        $wp_customize->add_setting("header_navbar_social_twitter_url", array (
            "default" => "",
        ));

        $wp_customize->add_control('header_navbar_social_twitter_url', array ( // setting id
            'label' => __('Twitter Url', 'growtype'),
            'section' => 'social',
            'type' => 'text',
        ));

        /**
         * Navbar social icon instagram
         */
        $wp_customize->add_setting('header_navbar_social_instagram', array (
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control('header_navbar_social_instagram', array (
            'type' => 'checkbox',
            'section' => 'social',
            'label' => __('Instagram', 'growtype')
        ));

        $wp_customize->add_setting("header_navbar_social_instagram_url", array (
            "default" => "",
        ));

        $wp_customize->add_control('header_navbar_social_instagram_url', array ( // setting id
            'label' => __('Instagram Url', 'growtype'),
            'section' => 'social',
            'type' => 'text',
        ));

        /**
         * Navbar social icon pinterest
         */
        $wp_customize->add_setting('header_navbar_social_pinterest', array (
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control('header_navbar_social_pinterest', array (
            'type' => 'checkbox',
            'section' => 'social',
            'label' => __('Pinterest', 'growtype')
        ));

        $wp_customize->add_setting("header_navbar_social_pinterest_url", array (
            "default" => "",
        ));

        $wp_customize->add_control('header_navbar_social_pinterest_url', array ( // setting id
            'label' => __('Pinterest Url', 'growtype'),
            'section' => 'social',
            'type' => 'text',
        ));

        /**
         * Navbar social icon linkedin
         */
        $wp_customize->add_setting('header_navbar_social_linkedin', array (
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control('header_navbar_social_linkedin', array (
            'type' => 'checkbox',
            'section' => 'social',
            'label' => __('Linkedin', 'growtype')
        ));

        $wp_customize->add_setting("header_navbar_social_linkedin_url", array (
            "default" => "",
        ));

        $wp_customize->add_control('header_navbar_social_linkedin_url', array ( // setting id
            'label' => __('Linkedin Url', 'growtype'),
            'section' => 'social',
            'type' => 'text',
        ));

        /**
         * Navbar social icon youtube
         */
        $wp_customize->add_setting('header_navbar_social_youtube', array (
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control('header_navbar_social_youtube', array (
            'type' => 'checkbox',
            'section' => 'social',
            'label' => __('Youtube', 'growtype')
        ));

        $wp_customize->add_setting("header_navbar_social_youtube_url", array (
            "default" => "",
        ));

        $wp_customize->add_control('header_navbar_social_youtube_url', array ( // setting id
            'label' => __('Youtube Url', 'growtype'),
            'section' => 'social',
            'type' => 'text',
        ));
    }
}

new Social_Customizer_Register();

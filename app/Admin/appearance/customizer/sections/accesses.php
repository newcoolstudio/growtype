<?php

/**
 *
 */
class Growtype_Customizer_Accesses_Section extends Growtype_Customizer
{
    /**
     * Constructor.
     */
    public $available_pages;
    public $available_roles;

    public function __construct()
    {
        parent::__construct();

        add_action('customize_register', array ($this, 'customizer_init'));
    }

    /**
     * @param $wp_customize
     * Initiate customizer
     */
    function customizer_init($wp_customize)
    {
        $wp_customize->add_section('theme-access', array (
            "title" => __("Accesses", "growtype"),
            "priority" => 20,
        ));

        /**
         * Notice
         */
        $wp_customize->add_setting('theme_access_login_notice',
            array (
                'default' => '',
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'theme_access_login_notice',
            array (
                'label' => __('Login'),
                'description' => __('Below you can change login settings'),
                'section' => 'theme-access'
            )
        ));

        /**
         * Login redirect
         */
        $wp_customize->add_setting('theme_access_login_redirect',
            array (
                'default' => 0,
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'theme_access_login_redirect',
            array (
                'label' => esc_html__('Not Logged In User Redirect'),
                'section' => 'theme-access',
                'description' => __('Redirect user to specific url if not logged in', 'growtype'),
            )
        ));

        /**
         * Login redirect url
         */
        $wp_customize->add_setting("theme_access_login_redirect_url", array (
            "default" => "/login",
        ));

        $wp_customize->add_control('theme_access_login_redirect_url', array (
            'label' => esc_html__('Redirect Url'),
            'section' => 'theme-access',
            'description' => __('Redirect url if user is not logged in', 'growtype'),
//        'type' => 'number',
        ));

        /**
         * Pages available when not grated
         */
        $wp_customize->add_setting('theme_access_pages_available_when_not_logged_in',
            array (
                'default' => '',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'theme_access_pages_available_when_not_logged_in',
            array (
                'label' => __('Pages available', 'growtype'),
                'description' => esc_html__('Which pages should be available when user is not loged in or granted access to platform.', 'growtype'),
                'section' => 'theme-access',
                'input_attrs' => array (
                    'placeholder' => __('Please select pages...', 'growtype'),
                    'multiselect' => true,
                ),
                'choices' => $this->available_pages
            )
        ));

        /**
         * Redirect after login
         */
        $wp_customize->add_setting("theme_access_redirect_url_after_login", array (
            "default" => "",
        ));

        $wp_customize->add_control('theme_access_redirect_url_after_login', array (
            'label' => esc_html__('Redirect Url After Login'),
            'section' => 'theme-access',
            'description' => __('Redirect url after login', 'growtype'),
//        'type' => 'number',
        ));

        /**
         * Requirements
         */
        $wp_customize->add_setting('theme_access_requirements_notice',
            array (
                'default' => '',
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'theme_access_requirements_notice',
            array (
                'label' => __('Requirements'),
                'description' => __('Below you can change login requirements settings'),
                'section' => 'theme-access'
            )
        ));

        /**
         * Prevented roles from access
         */
        $wp_customize->add_setting('theme_access_disabled_roles',
            array (
                'default' => '',
                'transport' => '',
            )
        );

        $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'theme_access_disabled_roles',
            array (
                'label' => __('Roles Prevented', 'growtype'),
                'description' => esc_html__('Roles prevented from platform access.', 'growtype'),
                'section' => 'theme-access',
                'input_attrs' => array (
                    'multiselect' => true,
                ),
                'choices' => $this->available_roles
            )
        ));

        /**
         * Roles prevented redirect url
         */
        $wp_customize->add_setting("theme_access_disabled_roles_redirect_url", array (
            "default" => "",
        ));

        $wp_customize->add_control('theme_access_disabled_roles_redirect_url', array (
            'label' => esc_html__('"Roles Prevented" Redirect Url'),
            'section' => 'theme-access',
            'description' => __('Redirect url if user does not have a specific role.', 'growtype'),
        ));

        /**
         * Home
         */
        $wp_customize->add_setting('theme_access_home_notice',
            array (
                'default' => '',
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'theme_access_home_notice',
            array (
                'label' => __('Home'),
                'description' => __('Below you can change home page settings'),
                'section' => 'theme-access'
            )
        ));

        /**
         * Home url after login
         */
        $wp_customize->add_setting('theme_access_home_page_id_after_login',
            array (
                'default' => '',
                'transport' => '',
            )
        );

        $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'theme_access_home_page_id_after_login',
            array (
                'label' => __('Home Page When Logged In', 'growtype'),
                'description' => esc_html__('Default home page when user is logged in.', 'growtype'),
                'section' => 'theme-access',
                'input_attrs' => array (
                    'multiselect' => false,
                ),
                'choices' => $this->available_pages
            )
        ));

        /**
         * Home page redirect
         */
        $wp_customize->add_setting('theme_access_logged_in_home_page_redirect',
            array (
                'default' => 0,
                'transport' => '',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'theme_access_logged_in_home_page_redirect',
            array (
                'label' => esc_html__('Change Home Page Url'),
                'section' => 'theme-access',
                'description' => __('Change default home page for logged in users to "Home Page When Logged In" . ', 'growtype'),
            )
        ));

        /**
         * Home
         */
        $wp_customize->add_setting('theme_access_logo_notice',
            array (
                'default' => '',
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'theme_access_logo_notice',
            array (
                'label' => __('Logo'),
                'description' => __('Below you can change logo settings'),
                'section' => 'theme-access'
            )
        ));

        /**
         * Login logo
         */
        $wp_customize->add_setting("login_logo", array (
            "type" => "theme_mod", // or 'option'
            "capability" => "edit_theme_options",
            "default" => get_template_directory_uri() . ' / assets / images / logo / simple . svg',
            "transport" => "postMessage",
            'sanitize_callback' => '',
            'sanitize_js_callback' => '' // Basically to_json.
        ));

        $wp_customize->add_control(new WP_Customize_Media_Control(
            $wp_customize, 'login_logo',
            array (
                'label' => __('Logo - Login', 'growtype'),
                'section' => 'theme-access',
            )
        ));

        apply_filters('growtype_theme_access_customizer', $wp_customize, $this->available_pages, $this->available_roles);
    }
}

new Growtype_Customizer_Accesses_Section();

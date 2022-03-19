<?php

class Header_Customizer_Register
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $customizer_available_data = new Customizer_Available_Data();
        $this->customizer_available_pages = $customizer_available_data->get_available_pages();

        add_action('customize_register', array ($this, 'customizer_init'));
        add_action('customize_controls_print_styles', array ($this, 'my_customizer_styles'), 999);
    }

    function customizer_init($wp_customize)
    {
        $color_scheme = get_theme_color_scheme();

        /**
         * Panel
         */
        $wp_customize->add_panel(
            'header',
            array (
                'priority' => 30,
                'capability' => '',
                'theme_supports' => '',
                'title' => __('Header', 'growtype'),
            )
        );

        require_once 'header/general.php';
        require_once 'header/logo.php';
        require_once 'header/navbar.php';
        require_once 'header/colors.php';
        require_once 'header/promo.php';
        require_once 'header/extra.php';
    }

    /**
     * This function adds some styles to the WordPress Customizer
     */
    function my_customizer_styles()
    { ?>
        <style>
            .thumbnail-image {
                max-width: 150px;
            }
        </style>
        <?php
    }
}

new Header_Customizer_Register();

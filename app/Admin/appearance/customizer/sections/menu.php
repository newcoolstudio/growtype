<?php

class Menu_Customizer_Extension
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

    /**
     * @param $wp_customize
     */
    public function customizer_init($wp_customize)
    {
        require_once 'menu/header.php';
        require_once 'menu/mobile.php';
        require_once 'menu/login.php';
    }
}

new Menu_Customizer_Extension();

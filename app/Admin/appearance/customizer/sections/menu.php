<?php

class Menu_Customizer_Extension extends Growtype_Customizer
{
    /**
     * Constructor.
     */
    public $available_pages;

    public function __construct()
    {
        parent::__construct();

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

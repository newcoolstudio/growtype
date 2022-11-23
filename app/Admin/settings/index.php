<?php

class Growtype_Admin_Settings
{
    public function __construct()
    {
        $this->load_submenu();
    }

    public function load_submenu()
    {
        include_once('discussion/index.php');
    }
}

new Growtype_Admin_Settings();

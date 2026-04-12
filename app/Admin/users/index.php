<?php

/**
 *
 */
class Growtype_Admin_Users
{
    /**
     * Let's get this party started
     *
     * @since 3.4
     * @access public
     */
    public function __construct()
    {
        $this->load_partials();
    }

    /**
     * Load partial classes.
     */
    public function load_partials()
    {
        include_once 'partials/columns.php';
        include_once 'partials/roles.php';
        include_once 'partials/profile.php';
    }
}

new Growtype_Admin_Users();

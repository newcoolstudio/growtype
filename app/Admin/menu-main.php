<?php

class Growtype_Admin_Menu
{
    public function __construct()
    {
        add_action('admin_menu', array ($this, 'admin_menu_order'));
    }

    public static function admin_menu_order()
    {
        global $menu, $submenu;

        $removed = [];

        /**
         * Move media tab before posts tab
         */
        foreach ($menu as $key => $value) {
            if (isset($value[2]) && in_array($value[2], $removed)) {
                unset($menu[$key]);
            }
            if (isset($value[2]) && $value[2] === 'upload.php') {
                unset($menu[$key]);
                $oldkey = $value;
            }
        }

        ksort($menu);

        /**
         * Users ordering
         */
        if (isset($submenu["users.php"][5][2]) && "users.php" == $submenu["users.php"][5][2]) {
            $submenu["users.php"][5][2] .= "?orderby=registered&order=desc";
        }

        /**
         * Final reorder menu
         */
        $reordered_menu = [];
        $increament_nr = 0;
        foreach ($menu as $key => $value) {
            if (isset($value[2]) && $value[2] === 'edit.php') {
                $reordered_menu[$key] = $oldkey;
                $increament_nr++;
            }
            if (is_int($key)) {
                $key = $key + $increament_nr;
            }
            $reordered_menu[$key] = $value;
        }

        $menu = $reordered_menu;
    }
}

new Growtype_Admin_Menu();

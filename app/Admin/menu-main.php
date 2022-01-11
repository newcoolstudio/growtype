<?php

/**
 * Change menu items order
 */
add_action('admin_menu', 'admin_menu_items');
function admin_menu_items()
{
    global $menu, $submenu;

    $removed = [];

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

    if (class_exists('woocommerce')) {
        /**
         * Woocommerce product menu custom title
         */
        if (!empty(get_option('woocommerce_products_menu_title'))) {
            $menu['26'][0] = get_option('woocommerce_products_menu_title');
            $submenu['edit.php?post_type=product'][5][0] = 'All ' . get_option('woocommerce_products_menu_title');
        }

        /**
         * Woocommerce wooocommerce menu custom title
         */
        if (!empty(get_option('woocommerce_main_menu_title'))) {
            $menu['55.5'][0] = get_option('woocommerce_main_menu_title');
        }
    }

    /**
     * Reorder menu
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

/**
 * Change default posts order
 */
add_action('admin_menu', 'admin_menu_change_default_posts_order');
function admin_menu_change_default_posts_order()
{
    global $submenu;

    if (isset($submenu["users.php"][5][2]) && "users.php" == $submenu["users.php"][5][2]) {
        $submenu["users.php"][5][2] .= "?orderby=registered&order=desc";
    }

    return $submenu;
}

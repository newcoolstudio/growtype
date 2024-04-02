<?php

/**
 * @param $menu_location
 * @return array
 * Get menu parent items
 */
function growtype_get_menu_parent_items($menu_location)
{
    $locations = get_nav_menu_locations();

    if (isset($locations[$menu_location])) {
        $menu = get_term($locations[$menu_location], 'nav_menu');
    }

    $parent_menu_elements = [];

    if (isset($menu) && isset($menu->term_id)) {
        $menu_items = wp_get_nav_menu_items($menu->term_id, array ('menu_item_parent' => '0'));

        foreach ($menu_items as $menu_item) {
            if ($menu_item->menu_item_parent === '0') {
                array_push($parent_menu_elements, $menu_item);
            }
        }
    }

    return $parent_menu_elements;
}


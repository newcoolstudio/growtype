<?php

/**
 * Footer menu walker
 */
class Custom_Nav_Walker extends Walker_Nav_Menu
{
    function start_el(&$output, $menu_item, $depth = 0, $args = array (), $current_object_id = 0)
    {
        global $wp_query;

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $menu_icon = get_post_meta($menu_item->ID, 'menu-item-icon-class', true);

        $class_names = $value = '';
        $classes = empty($menu_item->classes) ? array () : (array)$menu_item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $menu_item));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $output .= $indent . '<li id="menu-item-' . $menu_item->ID . '"' . $value . $class_names . '>';

        $attributes = !empty($menu_item->attr_title) ? ' title="' . esc_attr($menu_item->attr_title) . '"' : '';
        $attributes .= !empty($menu_item->target) ? ' target="' . esc_attr($menu_item->target) . '"' : '';
        $attributes .= !empty($menu_item->xfn) ? ' rel="' . esc_attr($menu_item->xfn) . '"' : '';
        $attributes .= !empty($menu_item->url) ? ' href="' . esc_attr($menu_item->url) . '"' : '';

        $menu_item_output = '';

        if (!empty($args) && is_object($args)) {
            $menu_item_output = $args->before;
            $menu_item_output .= '<a' . $attributes . '>';
            $menu_item_output .= !empty($menu_icon) ? '<i class="' . $menu_icon . '"></i>' : '';
            $menu_item_output .= $args->link_before . '<span>' . apply_filters('the_title', $menu_item->title, $menu_item->ID) . '</span>';
            $menu_item_output .= $args->link_after;
            $menu_item_output .= '</a>';
            if (isset($extraContent) && !empty($extraContent)) {
                $menu_item_output .= '<ul class="sub-menu">' . $extraContent . '</ul>';
            }
            $menu_item_output .= $args->after;
        }

        $output .= apply_filters('walker_nav_menu_start_el', $menu_item_output, $menu_item, $depth, $args);
    }
}

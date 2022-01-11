<?php

/**
 * Admin top navigation, navbar
 */
function admin_bar_remove_menus()
{
    global $wp_admin_bar;

    $liked = __('Liked', 'growtype');

    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('updates');
}

add_action('wp_before_admin_bar_render', 'admin_bar_remove_menus', 0);

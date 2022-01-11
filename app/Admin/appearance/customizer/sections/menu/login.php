<?php

/**
 * Login menu
 */

$login_menu = wp_get_nav_menu_object('login-menu');

if (!empty($login_menu)) {
    $mobile_menu_section = 'nav_menu[' . $login_menu->term_id . ']';

    /**
     * Login menu settings
     */
    $wp_customize->add_setting('login_menu_enabled',
        array (
            'default' => 0,
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'login_menu_enabled',
        array (
            'label' => esc_html__('Login Menu Enabled'),
            'section' => $mobile_menu_section,
            'description' => __('Login menu will be visible in header. To display menu: create menu in admin section, and add it to header-login section.', 'growtype'),
            'priority' => 1000000,
        )
    ));
}

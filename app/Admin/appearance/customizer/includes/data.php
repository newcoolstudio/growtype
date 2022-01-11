<?php

class Customizer_Available_Data
{
    /**
     * Pages
     */
    function get_available_pages()
    {
        $customizer_available_pages = [];
        $available_pages = get_pages();

        if (!empty($available_pages)) {
            foreach ($available_pages as $single_page) {
                $customizer_available_pages[$single_page->ID] = $single_page->post_title . ' (' . $single_page->post_name . ')';
            }
        }

        if (class_exists('woocommerce')) {
            $customizer_available_pages['single_shop_page'] = 'Single shop page (important: no id)';
        }

        return $customizer_available_pages;
    }

    /**
     * Wc products
     */
    function get_available_products()
    {
        if (class_exists('woocommerce')) {
            $wc_products = wc_get_products(array ('limit' => -1));

            $products_map = [];
            if (!empty($wc_products)) {
                foreach ($wc_products as $product) {
                    $products_map[$product->get_id()] = $product->get_title();
                }
            }

            return $products_map;
        }

        return null;
    }

    /**
     * Wc products
     */
    function get_available_roles()
    {
        global $wp_roles;
        $roles = $wp_roles->roles;

        $roles_map = [];
        foreach ($roles as $role => $role_details) {
            $roles_map[$role] = $role_details['name'];
        }

        return $roles_map;
    }
}

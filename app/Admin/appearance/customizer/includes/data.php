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

        $customizer_available_pages['lost_password_page'] = 'Lost password page (important: no id)';
        $customizer_available_pages['search_results'] = 'Search results (important: no id)';

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

    /**
     * Wc product preview styles
     */
    function get_available_product_preview_styles()
    {
        return array (
            'grid' => __('Grid', 'growtype'),
            'list' => __('List', 'growtype'),
            'table' => __('Table', 'growtype')
        );
    }

    /**
     * Post types
     */
    function get_available_post_types()
    {
        $post_types_args = apply_filters(
            'wpes_post_types_args',
            array (
                'show_ui' => true,
                'public' => true,
            )
        );

        $all_post_types = apply_filters('wpes_post_types', get_post_types($post_types_args, 'objects'));

        $post_types = [];
        foreach ($all_post_types as $key => $post_type) {
            $post_types[$key] = $post_type->label;
        }

        return $post_types;
    }
}

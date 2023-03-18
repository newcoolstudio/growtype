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

        $customizer_available_pages['lost_password_page'] = 'Lost password page (important: no id)';
        $customizer_available_pages['search_results'] = 'Search results (important: no id)';

        /**
         * For Growtype_Extended_Cpt
         */
        if (class_exists('Growtype_Extended_Cpt')) {
            foreach (Growtype_Extended_Cpt::get_active_post_types() as $active_post_type) {
                $customizer_available_pages[$active_post_type['key']] = 'CPT - ' . $active_post_type['label'];
            }
        }

        /**
         * Posts
         */
        $customizer_available_pages['posts'] = 'CPT - Posts';

        /**
         * External pages
         */
        $customizer_available_pages = apply_filters('growtype_customizer_extend_available_pages', $customizer_available_pages);

        return $customizer_available_pages;
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

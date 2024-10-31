<?php

/**
 *
 */
abstract class Growtype_Customizer
{
    public $available_pages;
    public $available_roles;
    public $available_post_types;

    public function __construct()
    {
        $this->available_pages = [];
        $this->available_roles = $this->get_available_roles();
        $this->available_post_types = $this->get_available_post_types();

        add_action('init', function () {
            $this->available_pages = $this->get_available_pages();
        });
    }

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
         * Posts
         */
        $customizer_available_pages['posts'] = 'CPT - Posts';

        /**
         * Custom Post Types
         */
        $args = array (
            'public' => true,
            '_builtin' => false
        );

        $custom_post_types = get_post_types($args, 'objects');

        foreach ($custom_post_types as $post_type) {
            $customizer_available_pages['cpt_' . $post_type->name] = 'CPT - ' . $post_type->labels->name;
            $customizer_available_pages['cpt_single_' . $post_type->name] = 'CPT Single - ' . $post_type->labels->name;
        }

        /**
         * Custom taxonomies
         */
        $args = array (
            'public' => true,
            '_builtin' => false,
        );

        $custom_taxonomies = get_taxonomies($args, 'objects');

        foreach ($custom_taxonomies as $custom_tax) {
            $customizer_available_pages['tax_' . $custom_tax->name] = 'Tax - ' . $custom_tax->labels->name;
        }

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

/**
 * Controls
 */
include('includes/custom-controls.php');

/**
 * Styles
 */
include('includes/styles-applied.php');

/**
 * Scripts
 */
include('includes/scripts.php');

/**
 * Colors
 */
include('includes/colors.php');

/**
 *
 */
include('sections/header.php');

include('sections/footer.php');

include('sections/general.php');

include('sections/gdpr.php');

include('sections/fonts.php');
include('sections/buttons.php');
include('sections/menu.php');

include('sections/sidebar.php');
include('sections/panel.php');
include('sections/accesses.php');
include('sections/profile.php');

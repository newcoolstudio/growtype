<?php

class Growtype_Extended_Cpt_Init
{
    public function __construct()
    {
        add_action('init', array ($this, 'growtype_extended_cpt_init'));

        add_action('template_redirect', array ($this, 'growtype_extended_cpt_template_redirect'));
    }

    function growtype_extended_cpt_init()
    {
        $cpt_keys = Growtype_Extended_Cpt::get_keys();

        foreach ($cpt_keys as $cpt_key) {

            $key_name = $cpt_key['name'];
            $key_value = $cpt_key['value'];

            $enabled = get_option($key_value . '_enabled');

            if (!$enabled || empty($key_name) || empty($key_value)) {
                continue;
            }

            $cpt_name = get_option($key_value . '_value');
            $cpt_name = str_replace(' ', '_', $cpt_name);
            $cpt_name = strtolower($cpt_name);
            $cpt_label = get_option($key_value . '_label');

            if (empty($cpt_name) || !$cpt_name || empty($cpt_label) || !$cpt_label) {
                continue;
            }

            $cpt_slug = get_option($key_value . '_slug') ? get_option($key_value . '_slug') : $cpt_name;

            $archive_enabled = get_option($key_value . '_archive_enabled') ? true : false;

            $tags_enabled = get_option($key_value . '_tags_enabled') ? true : false;

            register_extended_post_type($cpt_name, array (

                # Add the post type to the site's main RSS feed:
                'show_in_feed' => false,

                'has_archive' => $archive_enabled, //Hides archive page

                'show_in_rest' => true,

//        'menu_icon' => 'dashicons-admin-users',

//        'menu_position' => 4,

                'supports' => array ('title', 'thumbnail', 'editor', 'page-attributes', 'excerpt', 'author', 'custom-fields'),

                'taxonomies' => $tags_enabled ? array ('post_tag') : [],

                'hierarchical' => true,

                # Show all posts on the post type archive:
                'archive' => array (
                    'nopaging' => true,
                    'order_by' => 'menu_order',
                ),

                # Add some custom columns to the admin screen:
                'admin_cols' => [
                    'published' => [
                        'title' => 'Published',
                        'meta_key' => 'published_date',
                        'date_format' => 'd/m/Y'
                    ],
                    'taxonomy' => [
                        'taxonomy' => $cpt_name . '_tax'
                    ],
                ],

                'admin_filters' => [
                    'taxonomy' => [
                        'taxonomy' => $cpt_name . '_tax'
                    ],
                    'rating' => [
                        'meta_key' => 'star_rating',
                    ],
                ],
            ), array (
                # Override the base names used for labels:
                'singular' => $cpt_label,
                'plural' => $cpt_label,
                'slug' => $cpt_slug
            ));

            /**
             * Tax
             */
            register_extended_taxonomy($cpt_name . '_tax', $cpt_name, array (
                'checked_ontop' => true,
                'dashboard_glance' => true,
                'show_in_rest' => true,
                'admin_cols' => array (
                    'title',
                    'published' => array (
                        'title' => 'Published',
                        'meta_key' => 'published_date',
                        'date_format' => 'd/m/Y'
                    ),

                ),
                'allow_hierarchy' => false
            ),
                array (
                    'singular' => 'Category',
                    'plural' => 'Categories',
                    'slug' => 'categories'
                ));

            /**
             * Extend post type 1
             */
            apply_filters('growtype_' . $key_value . '_extend', $cpt_name);
        }
    }

    function growtype_extended_cpt_template_redirect()
    {
        if (is_single()) {
            $cpt_keys = Growtype_Extended_Cpt::get_keys();

            foreach ($cpt_keys as $cpt_key) {
                $key_value = $cpt_key['value'];

                if (!empty(get_option($key_value . '_value')) && is_singular(get_option($key_value . '_value')) && !get_option($key_value . '_single_page_enabled')) {
                    global $wp_query;
                    $wp_query->posts = [];
                    $wp_query->post = null;
                    $wp_query->set_404();
                    status_header(404);
                    nocache_headers();
                }
            }
        }
    }
}

<?php

class Growtype_Extended_Cpt_Init
{
    public function __construct()
    {
        $this->cpt_keys = Growtype_Extended_Cpt::get_keys();

        add_action('init', array ($this, 'growtype_extended_cpt_init'));

        add_action('template_redirect', array ($this, 'growtype_extended_cpt_template_redirect'));

        foreach ($this->cpt_keys as $cpt_key) {
            $cpt_name = $this->get_cpt_name($cpt_key['value']);
            add_filter('manage_' . $cpt_name . '_posts_columns', array ($this, 'growtype_extended_cpt_columns'));
            add_action('manage_' . $cpt_name . '_posts_custom_column', array ($this, 'growtype_extended_cpt_custom_columns'), 10, 2);
        }
    }

    function get_cpt_name($key_value)
    {
        $cpt_name = get_option($key_value . '_value');
        $cpt_name = str_replace(' ', '_', $cpt_name);
        $cpt_name = strtolower($cpt_name);

        return $cpt_name;
    }

    function smashing_filter_posts_columns($columns)
    {
        $columns['image'] = __('Image');
        $columns['price'] = __('Price', 'smashing');
        $columns['area'] = __('Area', 'smashing');
        return $columns;
    }

    /**
     * @param $columns
     * @return mixed
     * Custom columns
     */
    function growtype_extended_cpt_columns($columns)
    {
        $columns['taxonomy'] = __('Taxonomy', 'growtype');

        return $columns;
    }

    /**
     * @param $column
     * @param $post_id
     * @return void
     * Custom column values
     */
    function growtype_extended_cpt_custom_columns($column, $post_id)
    {
        if ('taxonomy' === $column) {
            $post_type = get_post_type();
            $taxonomies = get_taxonomies(['object_type' => [$post_type]]);

            foreach ($taxonomies as $taxonomy) {
                $terms = wp_get_post_terms($post_id, $taxonomy);

                foreach ($terms as $term) {
                    echo '<a href="' . admin_url('edit.php?post_type=' . $post_type . '&' . $taxonomy . '=' . $term->slug) . '">' . __($term->name) . '</a>';
                }
            }
        }
    }

    function growtype_extended_cpt_init()
    {
        foreach ($this->cpt_keys as $cpt_key) {

            $key_name = $cpt_key['name'];
            $key_value = $cpt_key['value'];

            $enabled = get_option($key_value . '_enabled');

            if (!$enabled || empty($key_name) || empty($key_value)) {
                continue;
            }

            $cpt_name = $this->get_cpt_name($key_value);
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
                    ]
                ],

                'admin_filters' => [
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
            foreach ($this->cpt_keys as $cpt_key) {
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

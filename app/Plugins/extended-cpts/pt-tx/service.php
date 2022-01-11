<?php

add_action('init', function () {
    $cpt_name = !empty(get_option('cpt_5_value')) ? get_option('cpt_5_value') : 'service';
    $cpt_name = str_replace(' ', '_', $cpt_name);;
    $cpt_name = strtolower($cpt_name);

    $cpt_label = !empty(get_option('cpt_5_label')) ? get_option('cpt_5_label') : 'Services';

    register_extended_post_type($cpt_name, array (

        # Add the post type to the site's main RSS feed:
        'show_in_feed' => false,

        'has_archive' => get_option('cpt_5_archive_enabled') ? true : false, //Hides archive page

        'show_in_rest' => true,

//        'menu_icon' => 'dashicons-admin-users',

//        'menu_position' => 4,

        'supports' => array ('title', 'thumbnail', 'editor', 'page-attributes', 'excerpt'),

        # Show all posts on the post type archive:
        'archive' => array (
            'nopaging' => false
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
        'slug' => $cpt_name

    ));
});


add_action('init', function () {
    $cpt_name = !empty(get_option('cpt_5_value')) ? get_option('cpt_5_value') : 'service';
    $cpt_name = str_replace(' ', '_', $cpt_name);;
    $cpt_name = strtolower($cpt_name);

    register_extended_taxonomy($cpt_name . '_tax', $cpt_name, array (
        'checked_ontop' => true,
        'dashboard_glance' => true,
        'show_in_rest' => true,
        'admin_cols' => array (
            'title',
            // A meta field column:
            'published' => array (
                'title' => 'Published',
                'meta_key' => 'published_date',
                'date_format' => 'd/m/Y'
            ),

        ),
        'allow_hierarchy' => true
    ),
        array (
            'singular' => 'Category',
            'plural' => 'Categories',
            'slug' => 'categories'
        ));
});

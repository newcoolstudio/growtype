<?php

/**
 * Preview Column
 */
add_filter('manage_posts_columns', 'extra_admin_columns', 5);
add_filter('manage_pages_columns', 'extra_admin_columns', 5);
function extra_admin_columns($columns)
{
    if (!class_exists('WooCommerce') || get_post_type() !== 'product') {
        $columns['featured_image'] = __('Featured image');
        $columns['slug'] = __('Slug');
    }

    return $columns;
}

/**
 * Column content
 */
add_action('manage_posts_custom_column', 'extra_admin_columns_custom', 5, 2);
add_action('manage_pages_custom_column', 'extra_admin_columns_custom', 5, 2);
function extra_admin_columns_custom($column_name)
{
    if ($column_name === 'featured_image') {
        echo the_post_thumbnail('thumbnail');
    }

    if ($column_name === 'slug') {
        global $post;
        echo $post->post_name;
    }
}

/**
 * Column style
 */

add_action('admin_head', 'wp_admin_custom_column_style');

function wp_admin_custom_column_style() {
    echo '<style>';
    echo '.woocommerce-embed-page table #language { width:8%; }';
    echo '.woocommerce-embed-page table #featured_image { width:8%; }';
    echo '</style>';
}



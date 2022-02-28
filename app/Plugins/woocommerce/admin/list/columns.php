<?php

/**
 *
 */
add_filter('manage_edit-product_columns', 'admin_products_type_column');
function admin_products_type_column($columns)
{
    $columns['product_type'] = 'Type';
    return $columns;
}

/**
 *
 */
add_action('manage_product_posts_custom_column', 'admin_products_type_column_content', 10, 2);
function admin_products_type_column_content($column, $product_id)
{
    if ($column == 'product_type') {
        $product = wc_get_product($product_id);
        echo get_the_terms($product_id, 'product_type')[0]->slug;
    }
}

/**
 *
 */
#todo filtering products
//add_action('pre_get_posts', 'growtype_wc__pre_get_posts');
function growtype_wc__pre_get_posts($query)
{
    if (!is_admin() && !is_main_query()) {
        return;
    }

    $post_type = $query->query['post_type'] ?? null;

    if (!empty($post_type) && $post_type === 'product') {
        $query->set('meta_query', array (
                'meta_value' => array (
                    'key' => '_preview_style',
                    'value' => 'plan',
                    'compare' => '!=',
                )
            )
        );
    }
}

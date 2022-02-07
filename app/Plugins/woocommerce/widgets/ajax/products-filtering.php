<?php

/**
 * Catelog product select filter
 */
add_action('wp_ajax_filter_products', 'get_filtered_products');
add_action('wp_ajax_nopriv_filter_products', 'get_filtered_products');
function get_filtered_products()
{
    $orderby = isset($_POST['orderby']) && !empty($_POST['orderby']) ? $_POST['orderby'] : 'menu_order title';
    $categories_ids = isset($_POST['categories_ids']) && !empty($_POST['categories_ids']) ? $_POST['categories_ids'] : [];

    $products = get_ordered_wc_products($orderby, $categories_ids);

    if ($products->have_posts()) {
        if (get_theme_mod('wc_catalog_products_preview_style') === 'table') {
            echo \App\template('woocommerce.components.table.product-table', ['products' => $products]);
        } else {
            while ($products->have_posts()) : $products->the_post();
                wc_get_template_part('content', 'product');
            endwhile;
        }
        wp_reset_postdata();
    } else {
        do_action('woocommerce_no_products_found');
    }

    exit();
}

/**
 * @param $orderby
 * @param $categories_ids
 * @return WP_Query
 */
function get_ordered_wc_products($orderby, $categories_ids)
{
    $meta_key = '';
    $order = 'ASC';

    if (!empty($orderby)) {
        switch ($orderby) {
            case 'menu_order':
                $meta_key = '';
                $order = 'ASC';
                $orderby = 'menu_order title';
                break;
            case 'popularity':
                $meta_key = 'total_sales';
                $order = 'DESC';
                break;
            case 'price':
                $meta_key = '_price';
                $order = 'ASC';
                $orderby = 'meta_value_num';
                break;
            case 'price-desc':
                $meta_key = '_price';
                $order = 'DESC';
                $orderby = 'meta_value_num';
                break;
            case 'date':
                $meta_key = '';
                $order = 'DESC';
                $orderby = 'date';
                break;
            case 'rating':
                $meta_key = '_wc_average_rating';
                $order = 'DESC';
                $orderby = 'meta_value_num title';
                break;
        }
    }

    $args = array (
        'post_type' => 'product',
        'post_status' => 'publish',
        'orderby' => $orderby,
        'order' => $order,
        'paginate' => true,
        'featured' => false,
        'visibility' => 'catalog'
    );

    if (!empty($meta_key)) {
        $args['meta_query'] = array (
            'meta_value' => array (
                'key' => $meta_key,
            )
        );
    }

    if (!empty($categories_ids)) {
        $args['tax_query'] = array (
            array (
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $categories_ids
            ),
        );

        if (count($categories_ids) > 1) {
            $args['tax_query'][0]['operator'] = 'AND';
        }
    }

    $args['page'] = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
    $args['limit'] = apply_filters('loop_shop_per_page', wc_get_default_products_per_row() * wc_get_default_product_rows_per_page());

    /**
     * Extend arguments
     */
    $args = apply_filters('extend_growtype_woocommerce_catalog_ordering_args', $args);

    return new WP_Query($args);
}

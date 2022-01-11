<?php

add_action('wp_ajax_filter_products', 'get_filtered_products');
add_action('wp_ajax_nopriv_filter_products', 'get_filtered_products');
function get_filtered_products()
{
    $orderby = isset($_POST['orderby']) && !empty($_POST['orderby']) ? $_POST['orderby'] : 'menu_order title';
    $categories_ids = isset($_POST['categories_ids']) && !empty($_POST['categories_ids']) ? $_POST['categories_ids'] : [];

    $filtered_products = get_filtered_wc_products($orderby, $categories_ids);

    if (!empty($filtered_products->products)) {
        foreach ($filtered_products->products as $filtered_product) {
            $post_object = get_post($filtered_product);
            setup_postdata($GLOBALS['post'] =& $post_object);
            wc_get_template_part('content', 'product');
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
 * @return array|stdClass
 */
function get_filtered_wc_products($orderby, $categories_ids)
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
        'status' => 'publish',
        'meta_key' => $meta_key,
        'orderby' => $orderby,
        'order' => $order,
        'return' => 'ids',
        'paginate' => true,
        'featured' => false,
        'visibility' => 'catalog',
    );

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

    return wc_get_products($args);
}

<?php

/**
 * Woocommerce custom products shortcode
 */
add_shortcode('products_growtype', 'products_growtype_shortcode');
function products_growtype_shortcode($atts, $content = null)
{
    global $woocommerce_loop;

    if (!function_exists('wc_get_products')) {
        return '';
    }

    /**
     * Get properties from shortcode
     */
    extract(shortcode_atts(array (
        'ids' => '',
        'category' => '',
        'per_page' => '',
        'columns' => '',
        'orderby' => 'date',
        'order' => 'desc',
        'visibility' => 'catalog',
        'products_group' => 'default',
        'preview_style' => '',
        'edit_product' => false,
        'post_status' => 'publish',
        'cta_btn' => '',
        'before_shop_loop' => '',
        'after_shop_loop' => '',
    ), $atts));

    $args = array (
        'post_type' => 'product',
        'post_status' => $post_status,
        'orderby' => $orderby,
        'order' => $order
    );

    if (!empty($ids)) {
        $args['post__in'] = explode(',', $ids);
    }

    if (!empty($per_page)) {
        $args['posts_per_page'] = $per_page;
    } else {
        $per_page = wc_get_default_products_per_row() * wc_get_default_product_rows_per_page();
    }

    /**
     * Display type
     */
    if ($products_group === 'active-auctions') {
        $args['meta_query'] = [
            array (
                'key' => '_auction_has_started',
                'compare' => '1'
            )
        ];
    } elseif ($products_group === 'active-upcoming-auctions') {
        $args['meta_query'] = [
            array (
                'key' => '_auction_closed',
                'compare' => 'NOT EXISTS'
            ),
            array (
                'key' => '_auction_start_price',
                'compare' => 'EXISTS'
            )
        ];
    } elseif ($products_group === 'watchlist') {
        $user_ID = get_current_user_id();
        $watchlist_ids = get_user_meta($user_ID, '_auction_watch');

        if (!empty($watchlist_ids)) {
            $args['orderby'] = 'meta_value';
            $args['meta_key'] = '_auction_dates_to';
            $args['post__in'] = $watchlist_ids;
        } else {
            return '';
        }
    }

    /**
     * Page
     */
    $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
    $args['page'] = $paged;

    /**
     * Get products
     */
    $products = new WP_Query($args);

    if ($products->have_posts()) {
        wc_set_loop_prop('current_page', $paged);
        wc_set_loop_prop('is_paginated', wc_string_to_bool(true));
        wc_set_loop_prop('page_template', get_page_template_slug());
        wc_set_loop_prop('per_page', $per_page);
        wc_set_loop_prop('total', $products->post_count);
        wc_set_loop_prop('total_pages', $products->max_num_pages);

        if (!empty($columns)) {
            $woocommerce_loop['columns'] = $columns;
        }

        if ($cta_btn) {
            set_query_var('cta_btn', $cta_btn);
        }

        /**
         * Render
         */
        ob_start();

        if (isset($before_shop_loop) && $before_shop_loop) {
            do_action('woocommerce_before_shop_loop');
        }

        wc_get_template('loop/loop-start.php', ['preview_style' => $preview_style, 'products_group' => $products_group]);

        set_query_var('is_visible', $visibility ?? 'catalog');

        if (isset($edit_product) && $edit_product) {
            set_query_var('preview_permalink', true);
        }

        if ($preview_style === 'table') {
            echo \App\template('woocommerce.components.table.product-table', ['products' => $products]);
        } else {
            while ($products->have_posts()) : $products->the_post();
                wc_get_template_part('content', 'product');
            endwhile;
        }

        wc_get_template('loop/loop-end.php');

        if (isset($after_shop_loop) && $after_shop_loop) {
            do_action('woocommerce_after_shop_loop');
        }

        wp_reset_postdata();

        $render = '<div class="woocommerce">' . ob_get_clean() . '</div>';
    }

    return $render ?? '';
}

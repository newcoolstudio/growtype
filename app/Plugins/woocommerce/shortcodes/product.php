<?php

/**
 * Woocommerce custom products shortcode
 */
add_shortcode('products_custom', 'products_custom_shortcode');
function products_custom_shortcode($atts, $content = null)
{
    global $woocommerce_loop;

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
        'products_cat' => 'default',
        'preview_style' => '',
        'edit_product' => false,
        'post_status' => 'publish',
        'cta_btn' => '',
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
    }

    /**
     * Display type
     */
    if ($products_cat === 'active-auctions') {
        $args['meta_query'] = [
            array (
                'key' => '_auction_has_started',
                'compare' => '1'
            )
        ];
    } elseif ($products_cat === 'active-upcoming-auctions') {
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
    }

    /**
     * Permalink
     */
    $permalink = null;

    /**
     * Render
     */
    ob_start();

    $products = new WP_Query($args);

    if (!empty($columns)) {
        $woocommerce_loop['columns'] = $columns;
    }

    if ($cta_btn) {
        set_query_var('cta_btn', $cta_btn);
    }

    if ($products->have_posts()) : ?>

        <?php wc_get_template('loop/loop-start.php', ['preview_style' => $preview_style]); ?>

        <?php while ($products->have_posts()) : $products->the_post(); ?>

            <?php
            /**
             * Permalink change
             */
            if ($edit_product) {
                $permalink = get_permalink() . '?customize=preview';
            }

            set_query_var('is_visible', $visibility);
            set_query_var('permalink', $permalink);

            wc_get_template_part('content', 'product');
            ?>

        <?php endwhile; // end of the loop. ?>

        <?php wc_get_template('loop/loop-end.php'); ?>

    <?php endif;

    wp_reset_postdata();

    return '<div class="woocommerce">' . ob_get_clean() . '</div>';
}

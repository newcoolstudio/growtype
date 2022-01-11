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
        'visibility' => 'any',
        'type' => '',
        'post_status' => '',
    ), $atts));

    $args = array (
        'post_type' => 'product',
        'post_status' => $post_status,
        'orderby' => $orderby,
        'order' => $order,
//        'meta_query' => array (
//            array (
//                'key' => '_visibility',
//                'value' => array ('catalog', 'visible'),
//                'compare' => 'IN'
//            ),
//            array (
//                'key' => '_featured',
//                'value' => 'yes'
//            )
//        ),
//        'tax_query' => array (
//            array (
//                'taxonomy' => 'product_cat',
//                'terms' => array (esc_attr($category)),
//                'field' => 'slug',
//                'operator' => 'IN'
//            )
//        )
    );

    if (!empty($ids)) {
        $args['post__in'] = explode(',', $ids);
    }

    if (!empty($per_page)) {
        $args['posts_per_page'] = $per_page;
    }

    $permalink = null;

    ob_start();

    $products = new WP_Query($args);

    if (!empty($columns)) {
        $woocommerce_loop['columns'] = $columns;
    }

    if ($products->have_posts()) : ?>

        <?php wc_get_template('loop/loop-start.php'); ?>

            <?php while ($products->have_posts()) : $products->the_post(); ?>

                <?php
                if ($type === 'edit') {
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

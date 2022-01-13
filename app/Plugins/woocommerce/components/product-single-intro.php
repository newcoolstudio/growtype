<?php

/**
 * Main title
 */
add_filter('woocommerce_before_shop_loop', 'wc_catalog_featured_intro', 5);
function wc_catalog_featured_intro()
{
    if (!get_theme_mod('catalog_featured_intro_enabled')) {
        return null;
    }

    global $wp_query;
    $cat = $wp_query->get_queried_object();

    $featured_image = null;

    if (isset($cat->term_id)) {
        $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
        $featured_image = wp_get_attachment_url($thumbnail_id);
    }

    if (empty($featured_image)) {
        $shopPage = get_post(wc_get_page_id('shop'));
        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($shopPage->ID), 'large')[0] ?? '';
    }

    if (!empty($featured_image)) {
        ?>
        <div class="shop-header-featured" style="background: url(<?php echo $featured_image ?>);background-position: center;background-size: cover;"></div>
        <?php
    }

}

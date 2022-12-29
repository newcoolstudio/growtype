<?php

/**
 * WooCommerce Loop Product Thumbs
 */
if (!function_exists('woocommerce_template_loop_product_thumbnail')) {
    function woocommerce_template_loop_product_thumbnail()
    {
        echo woocommerce_get_product_thumbnail();
    }
}

/**
 * WooCommerce Product Thumbnail
 */
if (!function_exists('woocommerce_get_product_thumbnail')) {
    function woocommerce_get_product_thumbnail($size = 'woocommerce_thumbnail', $attr = array (), $placeholder = true)
    {
        global $product;

        if (!is_array($attr)) {
            $attr = array ();
        }

        if (!is_bool($placeholder)) {
            $placeholder = true;
        }

        $image_size = apply_filters('single_product_archive_thumbnail_size', $size);

        $current_user = wp_get_current_user();
        $current_user_wishlist_ids = get_user_meta($current_user->ID, 'wishlist_ids', true);
        $current_user_wishlist_ids = explode(',', $current_user_wishlist_ids);

        $productInWishlist = in_array($product->get_id(), $current_user_wishlist_ids);
        ?>

        <div class="imagewrapper">
            <?php echo $product ? $product->get_image($image_size, $attr, $placeholder) : ''; ?>
            <?php if (wishlist_page_icon()) { ?>
                <div class="wishlist-toggle <?php echo $productInWishlist ? 'is-active' : '' ?>" data-product="<?php echo esc_attr($product->get_id()) ?>" title="<?php echo esc_attr__("Add to Wishlist", "growtype") ?>">
                    <span class="e-text"><?php echo esc_attr__("Add to Wishlist", "growtype") ?></span>
                </div>
            <?php } ?>
        </div>

        <?php
    }
}

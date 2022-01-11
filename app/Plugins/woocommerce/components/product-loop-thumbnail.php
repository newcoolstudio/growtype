<?php

/**
 * WooCommerce Loop Product Thumbs
 **/

if (!function_exists('woocommerce_template_loop_product_thumbnail')) {
    function woocommerce_template_loop_product_thumbnail()
    {
        echo woocommerce_get_product_thumbnail();
    }
}

/**
 * WooCommerce Product Thumbnail
 **/
if (!function_exists('woocommerce_get_product_thumbnail')) {
    function woocommerce_get_product_thumbnail($size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0)
    {
        global $post, $woocommerce;

        if (!$placeholder_width) {
            $placeholder_width = wc_get_image_size('shop_catalog')['width'];
        }

        if (!$placeholder_height) {
            $placeholder_height = wc_get_image_size('shop_catalog')['height'];
        }

        $current_user = wp_get_current_user();
        $current_user_wishlist_ids = get_user_meta($current_user->ID, 'wishlist_ids', true);
        $current_user_wishlist_ids = explode(',', $current_user_wishlist_ids);

        $productInWishlist = in_array($post->ID, $current_user_wishlist_ids);

        /**
         * Image placeholder status
         */
        $img_placeholder = get_post_meta(get_the_ID(), '_img_placeholder_enabled', true);
        ?>

        <div class="imagewrapper">
            <?php
            if (has_post_thumbnail()) {
                echo get_the_post_thumbnail($post->ID, $size);
            } elseif ($img_placeholder) {
                echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';
            }
            ?>
            <?php
            if (wishlist_page_icon()) { ?>
                <div class="wishlist-toggle <?php echo $productInWishlist ? 'is-active' : '' ?>" data-product="<?php echo esc_attr($post->ID) ?>" title="<?php echo esc_attr__("Add to Wishlist", "text-domain") ?>">
                    <span class="e-text"><?php echo esc_attr__("Add to Wishlist", "text-domain") ?></span>
                </div>
            <?php } ?>
        </div>

        <?php
    }
}

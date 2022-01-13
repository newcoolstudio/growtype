<?php

/**
 * Product rating
 */
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_after_shop_loop_item_title_extend', 5);
function woocommerce_after_shop_loop_item_title_extend()
{
    global $product;

    $rating = $product->get_average_rating();

    if (wc_review_ratings_enabled() && $rating == 0) {
        echo '<div class="star-rating ehi-star-rating"><span style="width:' . (($rating / 5) * 100) . '%"></span></div>';
    }
}

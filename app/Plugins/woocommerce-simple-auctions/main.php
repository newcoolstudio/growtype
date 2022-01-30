<?php

add_action('save_post_product', 'growtype_save_post_product_auction', 10, 3);
function growtype_save_post_product_auction($post_id, $post, $update)
{
    $product = wc_get_product($post_id);
    $default_bid_increament = '1';

    if (isset($_POST['_auction_bid_increment']) && empty($_POST['_auction_bid_increment'])) {
        update_post_meta($post_id, '_auction_bid_increment', $default_bid_increament);
    }
}

<?php
/**
 * Bid increment
 */
add_action('save_post_product', 'growtype_save_post_product_auction', 10, 3);
function growtype_save_post_product_auction($post_id, $post, $update)
{
    if (isset($_POST['_auction_bid_increment']) && empty($_POST['_auction_bid_increment'])) {
        update_post_meta($post_id, '_auction_bid_increment', Growtype_Auction::bid_increase_value());
    }
}

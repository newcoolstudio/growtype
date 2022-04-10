<?php

/**
 * Notices
 */
add_action('woocommerce_before_main_content', 'growtype_woocommerce_init_notices');
function growtype_woocommerce_init_notices()
{
    $product = wc_get_product(get_the_ID());

    if (!empty($product) && $product->is_type('auction')) {
        if (Growtype_Auction::is_reserved($product->get_id())) {
            if (Growtype_Auction::is_reserved_for_user($product->get_id(), get_current_user_id())) {
                wc_add_notice('Congratulations, we have reserved this deal for you. You can <a href="' . Growtype_Auction::get_checkout_url() . '" class="btn-link">pay for it here</a>.', 'success');
            } else {
                wc_add_notice('Unfortunately, another user pressed "Buy now" and we reserved this offer for him. We wish you better luck next time.', 'error');
            }
        }
    }
}

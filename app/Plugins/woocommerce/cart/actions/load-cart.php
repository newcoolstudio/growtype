<?php

/**
 * Load cart ajax
 */
add_action('wp_ajax_load_cart_ajax', 'load_cart_ajax_callback');
add_action('wp_ajax_nopriv_load_cart_ajax', 'load_cart_ajax_callback');
function load_cart_ajax_callback()
{
    $data = array (
        'fragments' => apply_filters(
            'woocommerce_add_to_cart_fragments', array (
                'shopping_cart_content' => '<div class="b-shoppingcart-main">' . growtype_render_cart_content() . '</div>',
            )
        ),
        'cart_contents_count' => WC()->cart->cart_contents_count,
    );

    wp_send_json($data);
}

/**
 * Get cart details ajax
 */
add_action('wp_ajax_get_cart_details_ajax', 'get_cart_details_ajax_callback');
add_action('wp_ajax_nopriv_get_cart_details_ajax', 'get_cart_details_ajax_callback');
function get_cart_details_ajax_callback()
{
    $data = array (
        'products_amount' => WC()->cart !== null ? WC()->cart->get_cart_contents_count() : 0,
    );

    wp_send_json($data);
}

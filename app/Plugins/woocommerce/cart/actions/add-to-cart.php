<?php

/**
 * Add to cart action
 */
add_action('wp_ajax_add_to_cart_ajax', 'add_to_cart_ajax_callback');
add_action('wp_ajax_nopriv_add_to_cart_ajax', 'add_to_cart_ajax_callback');
function add_to_cart_ajax_callback()
{
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : null;
    $quantity = $_POST['quantity'] ?? 0;

    $variation_id = isset($_POST['variation_id']) ? (int)$_POST['variation_id'] : '';
    $product_cart_quantity = 0;

    if (empty($product_id)) {
        $data = [
            'error' => true,
            'message' => 'Missing info.',
        ];
        return wp_send_json($data);
    }

    foreach (WC()->cart->get_cart() as $cart_item) {
        if ($product_id === $cart_item['product_id']) {
            $product_cart_quantity += $cart_item['quantity'];
        }
    }

    $product = wc_get_product($product_id);
    $product_stock = $product->get_stock_quantity();
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    /**
     * Auction product
     */
    if ($product->is_type('auction') && !empty($_REQUEST['place-bid'])) {
        $data = [
            'message' => __('Bid added.', 'growtype'),
        ];

        return wp_send_json($data);
    }

    /**
     * Variable product
     */
    $variation_attributes = [];
    $variation_stock_quantity_enabled = false;
    if ($product->is_type('variable')) {
        $variation_attributes = wc_get_product_variation_attributes($variation_id);
        $variation = new WC_Product_Variation($variation_id);
        $variation_stock = $variation->get_stock_quantity();
        if ($variation->get_manage_stock() === true) {
            $variation_stock_quantity_enabled = true;
            foreach (WC()->cart->get_cart() as $cart_item) {
                if ($variation_id === $cart_item['variation_id']) {
                    if ($cart_item['quantity'] >= $variation_stock) {
                        $data = [
                            'error' => true,
                            'message' => __('Not enough items exist in stock.', 'growtype'),
                        ];
                        return wp_send_json($data);
                    }
                }
            }
        }
    }

    if (!$variation_stock_quantity_enabled && isset($product_stock) && $product_stock < $product_cart_quantity + $_POST['quantity']) {

        $message = __('Not enough items exist in stock.', 'growtype');

        if ($product->is_type('auction')) {
            $message = __('Somebody already placed an order to buy this product.', 'growtype');
        }

        $data = [
            'error' => true,
            'message' => $message,
        ];

        return wp_send_json($data);
    }

    /**
     * Grouped product
     */
    if ($product->is_type('grouped')) {
        foreach ($_POST['quantity'] as $product_id => $single_quantity) {
            if (!empty($single_quantity)) {
                $quantity += (int)$single_quantity;
                $validation_status = $passed_validation && false !== WC()->cart->add_to_cart($product_id, wc_stock_amount($single_quantity), $variation_id, $variation_attributes) && 'publish' === $product_status;
            }
        }
    } else {
        $validation_status = $passed_validation && false !== WC()->cart->add_to_cart($product_id, wc_stock_amount($quantity), $variation_id, $variation_attributes) && 'publish' === $product_status;
    }

    /**
     * Clear woocommerce notices
     */
    wc_clear_notices();

    if ($product->is_type('grouped') && empty($quantity) || !$product->is_type('grouped') && empty($quantity)) {
        $data = [
            'message' => 'Please select product amount',
            'quantity' => 0
        ];
        return wp_send_json($data);
    }

    if ($validation_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array ($product_id => $quantity), true);
        }

        foreach (WC()->cart->get_cart() as $cart_item) {
            $cart_item_variation_id = $cart_item['variation_id'] ?? '';
            if (!empty($cart_item_variation_id) && !empty($variation_id)) {
                if ($cart_item['variation_id'] === $variation_id) {
                    $cart_item_key = $cart_item['key'];
                }
            } else {
                if ($cart_item['product_id'] === $product_id) {
                    $cart_item_key = $cart_item['key'];
                }
            }
        }

        $data = array (
            'cart_contents_count' => WC()->cart->cart_contents_count,
            'cart_subtotal' => WC()->cart->get_cart_subtotal(),
            'cart_item_key' => $cart_item_key,
            'response_text' => __('Added', 'growtype'),
            'fragments' => apply_filters(
                'woocommerce_add_to_cart_fragments', array (
                    'shopping_cart_single_item' => render_current_cart_single_item(WC()->cart->get_cart_item($cart_item_key)),
                )
            ),
            'cart_hash' => apply_filters('woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5(json_encode(WC()->cart->get_cart_for_session())) : '', WC()->cart->get_cart_for_session()),
        );
    } else {
        $data = array (
            'error' => true,
            'message' => 'The selected product is out of stock.',
        );
    }

    wp_send_json($data);
}

/**
 * Add to cart ajax
 */
add_filter('woocommerce_add_cart_item_data', 'growtype_woocommerce_add_cart_item_data');
function growtype_woocommerce_add_cart_item_data($cart_item_data)
{
    global $woocommerce;

    /**
     * Check product type
     */
    if (isset($_POST['product_id'])) {
        $only_as_single_purchase = Growtype_Product::only_as_single_purchase($_POST['product_id']);

        if ($only_as_single_purchase) {
            $woocommerce->cart->empty_cart();
        }
    }

    /**
     * If selling type single clear all other products and add a new one
     */
    if (Growtype_Shop::selling_type_single()) {
        $woocommerce->cart->empty_cart();
    }

    return $cart_item_data;
}

/**
 * Added to cart ajax
 */
add_action('woocommerce_ajax_added_to_cart', 'growtype_woocommerce_ajax_added_to_cart');
function growtype_woocommerce_ajax_added_to_cart($product_id)
{
    global $woocommerce;

    $instant_checkout_status = get_post_meta($product_id, '_instant_checkout_enabled', true);
    $instant_checkout = !empty($instant_checkout_status) && $instant_checkout_status === 'yes';

    $user_can_buy = get_theme_mod('only_registered_users_can_buy') ? is_user_logged_in() : true;

    $is_required_product = Growtype_Product::product_is_among_required_products($product_id);
    /**
     * Check if user can buy product and redirect accordingly
     */
    if ($instant_checkout || !$user_can_buy || !Growtype_Product::user_has_bought_required_products()) {

        /**
         * Check if user can buy and if product is required and user did not buy required product already
         */
        if (!$user_can_buy || (!$is_required_product && !Growtype_Product::user_has_bought_required_products())) {
            $woocommerce->cart->empty_cart();
            $custom_redirect_url = get_permalink(wc_get_page_id('myaccount'));
        } elseif ($instant_checkout) {
            $custom_redirect_url = wc_get_checkout_url();
        }

        $data = array (
            'error' => true,
            'product_url' => $custom_redirect_url
        );

        wp_send_json($data);

        exit;
    }
}

/**
 * Redirect after add to cart
 */
add_action('woocommerce_add_to_cart_redirect', 'wc_add_to_cart_redirect');
function wc_add_to_cart_redirect($url = false)
{
    if (!class_exists('woocommerce')) {
        return false;
    }

    $instant_checkout = 'no';
    $sold_individually = false;

    if (isset($_REQUEST['add-to-cart'])) {
        $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_REQUEST['add-to-cart']));
        $instant_checkout = get_post_meta($product_id, '_instant_checkout_enabled', true);
        $product = wc_get_product($product_id);
        $sold_individually = $product->is_sold_individually();
    }

    if ((!empty($instant_checkout) && $instant_checkout === 'yes') || $sold_individually || Growtype_Shop::selling_type_single()) {
        $url = wc_get_checkout_url();
    }

    if (isset($url) && !empty($url) || get_option('woocommerce_cart_redirect_after_add') === 'yes') {
        return $url;
    }

    return get_bloginfo('url') . add_query_arg(array (), remove_query_arg('add-to-cart'));
}

/**
 * Redirect after add to cart
 */
add_action('woocommerce_cart_redirect_after_error', 'woocommerce_cart_redirect_after_error_extend');
function woocommerce_cart_redirect_after_error_extend($url)
{
    $product_id = $_REQUEST['product_id'] ?? null;

    if (!empty($product_id)) {
        $product = wc_get_product($product_id);

        if ($product->is_sold_individually() && product_is_in_cart($product)) {

            wc_clear_notices();

            if (skip_cart_page()) {
                return wc_get_checkout_url();
            } else {
                return wc_get_cart_url();
            }
        }
    }
}

/**
 * Add to cart link
 */
add_filter('woocommerce_product_add_to_cart_url', 'adjust_add_to_cart_button_link', 10, 2);
function adjust_add_to_cart_button_link($add_to_cart_url, $product)
{
    if (empty(WC()->cart)) {
        return null;
    }

    /**
     * Permalink update
     */
    if ($add_to_cart_url === get_permalink($product->get_id())) {
        $add_to_cart_url = Growtype_Product::permalink($product->get_id());
    }

    return $add_to_cart_url;
}

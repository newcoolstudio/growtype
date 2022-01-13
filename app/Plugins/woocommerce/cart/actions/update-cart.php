<?php

/**
 * Update cart ajax
 */
add_action('wp_ajax_update_cart_ajax', 'update_cart_ajax_callback');
add_action('wp_ajax_nopriv_update_cart_ajax', 'update_cart_ajax_callback');
function update_cart_ajax_callback()
{
    $cart_item_key = $_POST['cart_item_key'] ?? '';

    if (empty($cart_item_key)) {
        $data = [
            'error' => true,
            'message' => 'Not enough data',
        ];
        return wp_send_json($data);
    }

    if ($_POST['status'] === 'change_quantity') {

        $quantity = !isset($_POST['quantity']) || empty($_POST['quantity']) ? 0 : (int)$_POST['quantity'];

        $selected_cart_item = WC()->cart->get_cart_item($cart_item_key);
        $product = wc_get_product($selected_cart_item['product_id']);
        $product_stock = $product->get_stock_quantity();

        $product_quantity_in_cart = 0;
        $variation_stock_quantity_enabled = false;
        foreach (WC()->cart->get_cart() as $cart_item) {
            if ($product->get_id() === $cart_item['product_id']) {
                if ($selected_cart_item['variation_id'] === $cart_item['variation_id']) {
                    $variation = new WC_Product_Variation($cart_item['variation_id']);
                    $variation_stock = $variation->get_stock_quantity();
                    if ($variation->get_manage_stock() === true) {
                        $variation_stock_quantity_enabled = true;
                        if ($quantity > $variation_stock) {
                            $data = [
                                'error' => true,
                                'message' => __('Not enough items exist in stock.', 'growtype'),
                            ];
                            return wp_send_json($data);
                        }
                    }
                    $cart_item['quantity'] = $quantity;
                }
                $product_quantity_in_cart += $cart_item['quantity'];
            }
        }

        if (isset($product_stock) && !$variation_stock_quantity_enabled) {
            if ($product_quantity_in_cart > $product_stock || $quantity > $product_stock) {
                $data = [
                    'error' => true,
                    'message' => __('Not enough items exist in stock.', 'growtype'),
                ];
                return wp_send_json($data);
            }
        }

        WC()->cart->set_quantity($cart_item_key, $quantity);

        $data['message'] = 'Item quantity updated';
    }

    if ($_POST['status'] === 'remove_from_cart') {
        WC()->cart->remove_cart_item($cart_item_key);
        $data['message'] = 'Item removed';
    }

    $data = array (
        'cart_contents_count' => WC()->cart->cart_contents_count,
        'cart_subtotal' => WC()->cart->get_cart_subtotal(),
        'cart_item_key' => $cart_item_key,
        'fragments' => apply_filters(
            'woocommerce_add_to_cart_fragments', array (
                'shopping_cart_single_item' => render_current_cart_single_item(WC()->cart->get_cart_item($cart_item_key)),
            )
        ),
        'cart_hash' => apply_filters('woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5(json_encode(WC()->cart->get_cart_for_session())) : '', WC()->cart->get_cart_for_session())
    );

    return wp_send_json($data);
}

/**
 * Display items in stock notice
 */
add_filter('woocommerce_update_cart_validation', 'show_items_in_stock_notice', 20, 4);
function show_items_in_stock_notice($passed, $cart_item_key, $productData, $updated_quantity)
{
    $product = wc_get_product($productData['product_id']);
    $hold_stock_minutes = (int)get_option('woocommerce_hold_stock_minutes', 0);

    if ($product->managing_stock() || !$product->backorders_allowed()) {
        global $woocommerce;
        $items = $woocommerce->cart->get_cart();
        $totalProductAmount = 0;

        foreach ($items as $item => $values) {
            if ($values['product_id'] === $productData['product_id']) {
                if ($values['variation_id'] === $productData['variation_id']) {
                    $totalProductAmount += $updated_quantity;
                } else {
                    $totalProductAmount += $values['quantity'];
                }
            }
        }

        if (!empty($product->get_stock_quantity())) {
            $held_stock = ($hold_stock_minutes > 0) ? wc_get_held_stock_quantity($product) : 0;
            $availableProductAmount = $product->get_stock_quantity() - $held_stock;

            if ($totalProductAmount > $availableProductAmount) {
                $passed = false;
                wc_add_notice(__("Sorry, we do not have enough items in stock.", "woocommerce"), "error");
            }
        }
    }

    return $passed;
}

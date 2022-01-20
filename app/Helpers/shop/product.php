<?php

/**
 * @param $product
 * @return mixed|string|void
 */
function get_add_to_cart_btn_text($product = null)
{
    $add_to_cart_button_custom_text = get_theme_mod('woocommerce_product_preview_cta_label');

    if (empty($product)) {
        if (!empty($add_to_cart_button_custom_text)) {
            return $add_to_cart_button_custom_text;
        } else {
            return __('Add to bag', 'growtype');
        }
    }

    $button_text_custom_product = get_post_meta($product->get_id(), '_add_to_cart_button_custom_text', true);

    if (!empty($button_text_custom_product)) {
        $add_to_cart_button_custom_text = $button_text_custom_product;
    }

    return !empty($add_to_cart_button_custom_text) ? $add_to_cart_button_custom_text : __('Add to bag', 'growtype');
}

/**
 * @param $products
 * @return bool
 */
function product_is_among_required_products($product_id)
{
    $must_have_products_list = get_theme_mod('theme_access_user_must_have_products_list');
    $must_have_products_list = !empty($must_have_products_list) ? explode(',', $must_have_products_list) : [];

    return in_array($product_id, $must_have_products_list);
}

/**
 * @param $products
 * @return bool
 */
function user_has_bought_required_products($user_id = null)
{
    $user_id = !empty($user_id) ? $user_id : get_current_user_id();
    $must_have_products = get_theme_mod('theme_access_user_must_have_products');

    if ($must_have_products) {
        $must_have_products_list = get_theme_mod('theme_access_user_must_have_products_list');
        $must_have_products_list = !empty($must_have_products_list) ? explode(',', $must_have_products_list) : null;

        $customer_has_bought_products = user_has_bought_wc_products($user_id, $must_have_products_list);

        return $customer_has_bought_products;
    }

    return true;
}

/**
 * @param $products_ids
 * @param $user_var
 * @return bool
 */
function user_has_bought_wc_products($user_id, $products_ids, $one_is_enough = true, $user_var = null)
{
    global $wpdb;

    if (empty($user_var) || is_numeric($user_var)) {
        $meta_key = '_customer_user';
        $meta_value = $user_var ? (int)$user_var : (int)$user_id;
    } else {
        $meta_key = '_billing_email';
        $meta_value = sanitize_email($user_var);
    }

    $paid_statuses_list = class_exists('woocommerce') ? wc_get_is_paid_statuses() : ['completed'];
    $paid_statuses = array_map('esc_sql', $paid_statuses_list);

    $product_ids = is_array($products_ids) ? implode(',', $products_ids) : $products_ids;

    $line_meta_value = $product_ids != (0 || '') ? 'AND woim.meta_value IN (' . $product_ids . ')' : 'AND woim.meta_value != 0';

    /**
     * Number of products
     */
    $count = $wpdb->get_var("
        SELECT COUNT(p.ID) FROM {$wpdb->prefix}posts AS p
        INNER JOIN {$wpdb->prefix}postmeta AS pm ON p.ID = pm.post_id
        INNER JOIN {$wpdb->prefix}woocommerce_order_items AS woi ON p.ID = woi.order_id
        INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS woim ON woi.order_item_id = woim.order_item_id
        WHERE p.post_status IN ( 'wc-" . implode("','wc-", $paid_statuses) . "' )
        AND pm.meta_key = '$meta_key'
        AND pm.meta_value = '$meta_value'
        AND woim.meta_key IN ( '_product_id', '_variation_id' ) $line_meta_value 
    ");

    if ($one_is_enough) {
        return $count > 0 ? true : false;
    }

    return $count === count($product_ids) ? true : false;
}

/**
 * @return void
 */
function get_user_purchased_products_ids($user_id = null)
{
    $user_id = !empty($user_id) ? $user_id : get_current_user_id();

    if (empty($user_id)) {
        return null;
    }

    $customer_orders = get_posts(array (
        'numberposts' => -1,
        'meta_key' => '_customer_user',
        'meta_value' => $user_id,
        'post_type' => wc_get_order_types(),
        'post_status' => array_keys(wc_get_is_paid_statuses()),
    ));

    if (!$customer_orders) {
        return null;
    }

    $product_ids = array ();
    foreach ($customer_orders as $customer_order) {
        $order = wc_get_order($customer_order->ID);
        $items = $order->get_items();
        foreach ($items as $item) {
            $product_id = $item->get_product_id();
            $product_ids[] = $product_id;
        }
    }

    $product_ids = !empty($product_ids) ? array_values(array_unique($product_ids)) : null;

    return $product_ids;
}

/**
 * @return void
 */
function get_user_uploaded_products_ids($user_id = null)
{
    $user_id = !empty($user_id) ? $user_id : get_current_user_id();

    if (empty($user_id)) {
        return null;
    }

    $args = array (
        'limit' => -1,
    );

    $products = wc_get_products($args);

    $product_ids = array ();
    foreach ($products as $product) {
        $creator_id = get_post_meta($product->get_id(), '_product_creator_id', true);
        if ($creator_id == $user_id) {
            array_push($product_ids, $product->get_id());
        }
    }

    return !empty($product_ids) ? array_values(array_unique($product_ids)) : null;
}

/**
 * @param $product_id
 * @param $user_id
 * @return bool
 */
function user_has_uploaded_product($product_id, $user_id = null)
{
    $user_id = !empty($user_id) ? $user_id : get_current_user_id();

    if (empty($user_id)) {
        return false;
    }

    $creator_id = (int)get_post_meta($product_id, '_product_creator_id', true);

    return $creator_id === $user_id;
}

/**
 * @return bool
 */
function product_preview_cta_disabled()
{
    return empty(get_theme_mod('woocommerce_product_preview_add_to_cart_btn')) || !get_theme_mod('woocommerce_product_preview_add_to_cart_btn');
}

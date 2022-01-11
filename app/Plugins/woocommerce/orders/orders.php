<?php

/**
 * Extending new order creation process
 */
add_action('woocommerce_new_order', 'action_woocommerce_new_order', 10, 3);
function action_woocommerce_new_order($order_id, $order)
{
    /**
     * Add extra meta data
     */
    update_post_meta($order->get_id(), '_customer_full_name', $order->get_billing_last_name() . ' ' . $order->get_billing_first_name());
}

/**
 * @return int[]|WP_Post[]
 */
function get_user_orders()
{
    $customer_orders = get_posts(array (
        'numberposts' => -1,
        'order' => 'ASC',
        'meta_key' => '_customer_user',
        'meta_value' => get_current_user_id(),
        'post_type' => wc_get_order_types(),
        'post_status' => array_keys(wc_get_order_statuses()),
    ));

    return $customer_orders;
}

/**
 * @return bool|WC_Order|WC_Order_Refund
 */
function get_user_first_order()
{
    $order = isset(get_user_orders()[0]) ? wc_get_order(get_user_orders()[0]->ID) : false;

    return $order;
}

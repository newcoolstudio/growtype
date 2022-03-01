<?php

/**
 * Wc growtype
 */
add_action('init', 'growtype_wc_register_subscription_type');
function growtype_wc_register_subscription_type()
{
    class WC_Product_Subscription extends WC_Product
    {
        public function __construct($product = 0)
        {
            $this->supports[] = 'ajax_add_to_cart';
            $this->product_type = 'subscription';
            parent::__construct($product);
        }

        public function add_to_cart_url()
        {
            $url = $this->is_purchasable() && $this->is_in_stock() ? remove_query_arg(
                'added-to-cart',
                add_query_arg(
                    array (
                        'add-to-cart' => $this->get_id(),
                    ),
                    (function_exists('is_feed') && is_feed()) || (function_exists('is_404') && is_404()) ? $this->get_permalink() : ''
                )
            ) : $this->get_permalink();
            return apply_filters('woocommerce_product_add_to_cart_url', $url, $this);
        }
    }
}

/**
 *
 */
add_filter('product_type_selector', 'growtype_wc_product_type_selector');
function growtype_wc_product_type_selector($type)
{
    $type['subscription'] = __('Subscription');
    return $type;
}

<?php

/**
 * Wc growtype
 */
add_action('plugins_loaded', 'growtype_wc_register_subscription_type');
function growtype_wc_register_subscription_type()
{
    class WC_Product_Subscription extends WC_Product
    {
        public function __construct($product)
        {
            $this->product_type = 'subscription';
            parent::__construct($product);
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

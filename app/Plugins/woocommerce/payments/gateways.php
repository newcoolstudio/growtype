<?php

/**
 * Add payment method
 */
add_filter('woocommerce_payment_gateways', 'growtype_woocommerce_payment_gateways');
function growtype_woocommerce_payment_gateways($gateways)
{
    $gateways[] = 'WC_Gateway_Free';

    return $gateways;
}

/**
 * Class WC_Gateway_Free
 * No charge payment method
 */
class WC_Gateway_Free extends WC_Payment_Gateway
{
    public $domain;

    /**
     * Constructor for the gateway.
     */
    public function __construct()
    {
        $this->id = 'free';
        $this->has_fields = false;
        $this->method_title = __('Free', 'growtype');
        $this->method_description = __('Allow to make orders without charging any money.', 'growtype');

        $this->supports = array (
            'products'
        );

        $this->init_form_fields();
        $this->init_settings();

        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');
        $this->enabled = $this->get_option('enabled');
        $this->visible_in_frontend = $this->get_option('visible_in_frontend');

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array ($this, 'process_admin_options'));
    }

    /**
     * Initialise Gateway Settings Form Fields
     */
    public function init_form_fields()
    {
        $this->form_fields = array (
            'enabled' => array (
                'title' => __('Enable/Disable', 'growtype'),
                'type' => 'checkbox',
                'label' => __('Method is enabled', 'growtype'),
                'default' => 'yes'
            ),
            'visible_in_frontend' => array (
                'title' => __('Visibility', 'growtype'),
                'type' => 'checkbox',
                'label' => __('Method is visible in frontend', 'growtype'),
                'default' => 'no'
            ),
            'title' => array (
                'title' => __('Method title', 'growtype'),
                'type' => 'text',
                'description' => __('This controls the title which the user sees during checkout.', 'growtype'),
                'default' => __('Free', 'growtype'),
                'desc_tip' => true,
            ),
            'description' => array (
                'title' => __('Description', 'growtype'),
                'type' => 'textarea',
                'description' => __('Payment method description that the customer will see on your checkout.', 'growtype'),
                'default' => __('Test product without paying any money.', 'growtype'),
                'desc_tip' => true,
            )
        );
    }

    /**
     * Process the payment and return the result
     *
     * @param int $order_id
     * @return array
     */
    public function process_payment($order_id)
    {
        global $woocommerce;

        $order = wc_get_order($order_id);

        $order->payment_complete();

        wc_reduce_stock_levels($order_id);

        $order->update_status('completed');

        $woocommerce->cart->empty_cart();

        return array (
            'result' => 'success',
            'redirect' => $this->get_return_url($order)
        );
    }

    /**
     * Output for the order received page.
     */
    public function thankyou_page()
    {
        if ($this->instructions) {
            echo wpautop(wptexturize($this->instructions));
        }
    }

    /**
     * Add content to the WC emails.
     *
     * @access public
     * @param WC_Order $order
     * @param bool $sent_to_admin
     * @param bool $plain_text
     */
    public function email_instructions($order, $sent_to_admin, $plain_text = false)
    {
        if ($this->instructions && !$sent_to_admin && 'offline' === $order->payment_method && $order->has_status('on-hold')) {
            echo wpautop(wptexturize($this->instructions)) . PHP_EOL;
        }
    }
}

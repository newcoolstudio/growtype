<?php

/**
 * Hide braintree from admin menu section
 */
add_action('admin_head', 'woo_checkout_field_editor_admin_scripts');

function woo_checkout_field_editor_admin_scripts()
{
    echo '<style>
    #message.wc-connect.updated.thpladmin-notice {
      display: none;
    } 
   #message.wc-connect.updated.thpladmin-notice + p{
      display: none;
    } 
  </style>';
}

/**
 * Hide woocommerce customizer options to hide input fields
 */
add_action('customize_controls_print_scripts', 'woo_checkout_field_editor_customizer_extend', 30);
function woo_checkout_field_editor_customizer_extend()
{
    ?>
    <style>
        #customize-control-woocommerce_checkout_company_field, #customize-control-woocommerce_checkout_address_2_field, #customize-control-woocommerce_checkout_phone_field {
            display: none;
        }
    </style>
    <?php
}

<?php

/**
 * Scripts
 */
function checkout_scripts_styles()
{
    if (class_exists('woocommerce') && is_checkout()) {
        wp_enqueue_script('wc-custom-checkout', get_parent_template_public_path() . '/scripts/plugins/woocommerce/wc-checkout.js', [], '1.0.0', true);
    }
}

add_action('wp_enqueue_scripts', 'checkout_scripts_styles');

/**
 * Remove cart notice
 */
function sv_remove_cart_notice_on_checkout()
{
    if (function_exists('wc_cart_notices')) {
        remove_action('woocommerce_before_checkout_form', array (wc_cart_notices(), 'add_cart_notice'));
    }
}

add_action('wp_loaded', 'sv_remove_cart_notice_on_checkout');

/**
 * Change checkout button text  "Place Order" to custom text in checkout page
 * @param $button_text
 * @return $string
 */
add_filter('woocommerce_order_button_text', 'change_checkout_button_text');
function change_checkout_button_text($button_text)
{
    $woocommerce_checkout_billing_section_title = !empty(get_theme_mod('woocommerce_checkout_place_order_button_title')) ? get_theme_mod('woocommerce_checkout_place_order_button_title') : 'Place order';
    return $woocommerce_checkout_billing_section_title;
}

/**
 * Extend checkout fields
 */
add_filter('woocommerce_checkout_fields', 'woocommerce_checkout_fields_extend');
function woocommerce_checkout_fields_extend($fields)
{
    /**
     * Order notes
     */
    $order_notes = get_theme_mod('woocommerce_checkout_order_notes');

    switch ($order_notes) {
        case 'required':
            $fields['order']['order_comments']['required'] = true;
            break;
        case 'hidden':
            unset($fields['order']['order_comments']);
    }

    return $fields;
}

/**
 * Billing fields
 */
add_filter('woocommerce_billing_fields', 'growtype_woocommerce_billing_fields');
function growtype_woocommerce_billing_fields($fields)
{
    /**
     * Email
     */
    $email = get_theme_mod('woocommerce_checkout_email');

    switch ($email) {
        case 'required':
            $fields['billing_email']['required'] = true;
            break;
        case 'hidden':
            array_push($fields['billing_email']['class'], 'd-none');
    }

    /**
     * State
     */
    $state = get_theme_mod('woocommerce_checkout_state');

    switch ($state) {
        case 'required':
            $fields['billing_state']['required'] = true;
            break;
        case 'optional':
            $fields['billing_state']['required'] = false;
            break;
        case 'hidden':
            unset($fields['billing_state']);
    }

    /**
     * Postcode
     */
    $postcode = get_theme_mod('woocommerce_checkout_postcode');

    switch ($postcode) {
        case 'required':
            $fields['billing_postcode']['required'] = true;
            break;
        case 'hidden':
            unset($fields['billing_postcode']);
    }

    /**
     * Set default billing values
     */
    if (!empty(get_current_user_id())) {
        if (!empty(get_user_meta(get_current_user_id(), 'first_name', true))) {
            $fields['billing_first_name']['default'] = get_user_meta(get_current_user_id(), 'first_name', true);
        }
        if (!empty(get_user_meta(get_current_user_id(), 'last_name', true))) {
            $fields['billing_last_name']['default'] = get_user_meta(get_current_user_id(), 'last_name', true);
        }
        if (!empty(get_user_meta(get_current_user_id(), 'address_1', true))) {
            $fields['billing_address_1']['default'] = get_user_meta(get_current_user_id(), 'address_1', true);
        }
        if (!empty(get_user_meta(get_current_user_id(), 'city', true))) {
            $fields['billing_city']['default'] = get_user_meta(get_current_user_id(), 'city', true);
        }
        if (!empty(get_user_meta(get_current_user_id(), 'postcode', true))) {
            $fields['billing_postcode']['default'] = get_user_meta(get_current_user_id(), 'postcode', true);
        }
    }

    return $fields;
}

/**
 * Shipping fields
 */
add_filter('woocommerce_shipping_fields', 'growtype_woocommerce_shipping_fields');
function growtype_woocommerce_shipping_fields($fields)
{
    return $fields;
}

/**
 * Set default country
 */
add_filter('default_checkout_billing_country', 'growtype_default_checkout_billing_country');
function growtype_default_checkout_billing_country($country)
{
    if (!empty(get_user_meta(get_current_user_id(), 'country', true))) {
        return get_user_meta(get_current_user_id(), 'country', true);
    }

    return $country;
}

/**
 *
 */
add_filter('wp_loaded', 'extend_checkout_create_account_settings');
function extend_checkout_create_account_settings()
{
    if (get_theme_mod('woocommerce_checkout_create_account_checked')) {
        add_filter('woocommerce_create_account_default_checked', '__return_true');
    }
}


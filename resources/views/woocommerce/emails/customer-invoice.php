<?php
/**
 * Customer invoice email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-invoice.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Executes the e-mail header.
 *
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action('woocommerce_email_header', $email_heading, $email);

$intro_content_successful = get_theme_mod('wc_email_customer_invoice_successful_main_content');

if (!empty($intro_content_successful)) {
    $intro_content_successful = str_replace("{customer_name}", esc_html($order->get_billing_first_name()), $intro_content_successful);
    $intro_content_successful = str_replace("{date_created}", esc_html(wc_format_datetime($order->get_date_created())), $intro_content_successful);
    $intro_content_successful = nl2br($intro_content_successful);
}

$intro_content_pending = get_theme_mod('wc_email_customer_invoice_pending_main_content');
if (!empty($intro_content_pending)) {
    $intro_content_pending = str_replace("{customer_name}", esc_html($order->get_billing_first_name()), $intro_content_pending);
    $intro_content_pending = str_replace("{date_created}", esc_html(wc_format_datetime($order->get_date_created())), $intro_content_pending);
    $intro_content_pending = nl2br($intro_content_pending);
}

?>

<?php /* translators: %s: Customer first name */ ?>
<?php if ($order->has_status('pending')) { ?>

    <?php
    if (empty($intro_content_pending)) { ?>
        <div class="b-intro" style="margin-bottom: 30px;">
            <p><?php printf(esc_html__('Hi %s,', 'growtype'), esc_html($order->get_billing_first_name())); ?></p>

            <p>
                <?php
                printf(
                    wp_kses(
                    /* translators: %1$s Site title, %2$s Order pay link */
                        __('An order has been created for you on %1$s. Your invoice is below, with a link to make payment when you’re ready: %2$s', 'growtype'),
                        array (
                            'a' => array (
                                'href' => array (),
                            ),
                        )
                    ),
                    esc_html(get_bloginfo('name', 'display')),
                    '<a href="' . esc_url($order->get_checkout_payment_url()) . '">' . esc_html__('Pay for this order', 'growtype') . '</a>'
                );
                ?>
            </p>
        </div>
    <?php } else { ?>
        <div class="b-intro" style="margin-bottom: 30px;">
            <?php echo $intro_content_pending ?>
        </div>
    <?php } ?>

<?php } else { ?>

    <?php
    if (empty($intro_content_successful)) { ?>
        <div class="b-intro" style="margin-bottom: 30px;">
            <p>
                <?php
                /* translators: %s Order date */
                printf( esc_html__( 'Here are the details of your order placed on %s:', 'growtype' ), esc_html( wc_format_datetime( $order->get_date_created() ) ) );
                ?>
            </p>
        </div>
    <?php } else { ?>
        <div class="b-intro" style="margin-bottom: 30px;">
            <?php echo $intro_content_successful ?>
        </div>
    <?php } ?>

    <?php
}

/**
 * Hook for the woocommerce_email_order_details.
 *
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
if (get_theme_mod('woocommerce_email_page_order_overview_switch') !== false) {
    do_action('woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email);
}

/**
 * Hook for the woocommerce_email_order_meta.
 *
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
if (get_theme_mod('woocommerce_email_page_order_overview_switch') !== false) {
    do_action('woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email);
}


/**
 * Hook for woocommerce_email_customer_details.
 *
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
if (get_theme_mod('woocommerce_email_page_customer_details_switch') !== false) {
    do_action('woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email);
}

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ($additional_content) {
    echo wp_kses_post(wpautop(wptexturize($additional_content)));
}

/**
 * Executes the email footer.
 *
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action('woocommerce_email_footer', $email);

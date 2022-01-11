<!doctype html>
<html>
<body>

<?php
global $woocommerce;

if (!user_can_manage_shop()) {
    return null;
}

$mailer = $woocommerce->mailer();
$email_options = array ();

foreach ($mailer->emails as $key => $obj) {
    $email_options[$key] = $obj->title;
}

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
$in_email_type = isset($_GET['email_type']) ? $_GET['email_type'] : '';

if (empty($order_id)) {
    $order_id = get_user_first_order() ? get_user_first_order()->get_id() : '';
}

$order_number = is_numeric($order_id) ? (int)$order_id : '';
$email_class = isset($email_options[$in_email_type]) ? $in_email_type : '';
$order = $order_number ? wc_get_order($order_number) : false;

$error = '';
$email_html = '';

if (!$order_id && !$in_email_type) {
    $error = '<p>Please select an email type and enter an order #!!!!</p>';
} elseif (!$email_class) {
    $error = '<p>Bad email type!!!!</p>';
} elseif (!$order) {
    $error = '<p>No orders were found. Please make a test order to be able edit email templates.</p>';
} else {
    $email = $mailer->emails[$email_class];
    $email->object = $order;
    $email_html = apply_filters('woocommerce_mail_content', $email->style_inline($email->get_content_html()));
}
?>

<?php
if ($error) {
    echo "<div class='erro' style='padding-top: 50px;text-align: center;'>$error</div>";
} else {
    echo $email_html;
}
?>

@php wp_footer() @endphp
</body>
</html>

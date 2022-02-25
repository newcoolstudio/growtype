<?php

/**
 * Mail failed details
 */
add_action('wp_mail_failed', 'growtype_wp_mail_failed', 10, 1);
function growtype_wp_mail_failed($wp_error)
{
    return error_log(print_r($wp_error, true));
}

/**
 * @param $phpmailer
 * custom mailer
 */
if (!empty(getenv('SMTP_HOST'))) {
    add_action('phpmailer_init', 'growtype_setup_phpmailer');
}

/**
 * @param $phpmailer
 * wp mailer
 */
function growtype_setup_phpmailer($phpmailer)
{
    $phpmailer->Host = getenv('SMTP_HOST');
    $phpmailer->Port = getenv('SMTP_PORT'); // could be different
    $phpmailer->Username = getenv('SMTP_USERNAME'); // if required
    $phpmailer->Password = getenv('SMTP_PASSWORD'); // if required
    $phpmailer->SMTPAuth = getenv('SMTP_AUTH') === 'true' ? true : false; // if required
    $phpmailer->SMTPSecure = getenv('SMTP_SECURE'); // enable if required, 'tls' is another possible value

    $phpmailer->IsSMTP();
}

/**
 * Function to change mail sender name
 * @param $original_email_from
 * @return string
 */
function mail_sender_name($original_email_from)
{
    $mail_sender_name = get_option('mail_sender_name_value');

    return !empty($mail_sender_name) ? $mail_sender_name : get_bloginfo('name');
}

function mail_sender_email($original_email_address)
{
    $administrator = get_users('role=Administrator')[0] ?? null;
    $administrator_email = $administrator->user_email ?? null;
    $mail_sender_email_value = get_option('mail_sender_email_value');

    return !empty($mail_sender_email_value) ? $mail_sender_email_value : $administrator_email;
}

/**
 * Hooking up functions
 * @param $original_email_from
 * @return string
 */
add_filter('wp_mail_from', 'mail_sender_email');
add_filter('wp_mail_from_name', 'mail_sender_name');

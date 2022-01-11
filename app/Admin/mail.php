<?php

/**
 * @param $phpmailer
 * custom mailer
 */
if (!empty(getenv('SMTP_HOST'))) {
    add_action('phpmailer_init', 'setup_phpmailer');
}

/**
 * @param $phpmailer
 * wp mailer
 */
function setup_phpmailer($phpmailer)
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
    return get_option('mail_sender_name_value') ?? get_bloginfo('name');
}

function mail_sender_email($original_email_address)
{
    $administrator = get_users('role=Administrator')[0] ?? null;
    return get_option('mail_sender_email_value') ?? ($administrator->user_email ?? null);
}

/**
 * Hooking up functions
 * @param $original_email_from
 * @return string
 */
add_filter('wp_mail_from', 'mail_sender_email');
add_filter('wp_mail_from_name', 'mail_sender_name');

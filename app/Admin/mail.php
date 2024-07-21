<?php

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

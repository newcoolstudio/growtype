<?php

/**
 * Newsletter shortcode
 */
add_shortcode('growtype_newsletter', 'growtype_newsletter_shortcode');
function growtype_newsletter_shortcode($attr = [])
{
    $attr = !empty($attr) ? $attr : [];

    return \App\template('partials.components.newsletter', $attr);
}

/**
 * Catalog product select filter
 */
add_action('wp_ajax_newsletter_submission', 'growtype_newsletter_submission');
add_action('wp_ajax_nopriv_newsletter_submission', 'growtype_newsletter_submission');
function growtype_newsletter_submission()
{
    $newsletter_email = isset($_REQUEST['newsletter_email']) ? $_REQUEST['newsletter_email'] : '';

    $data = [
        'email' => $newsletter_email
    ];

    $response = apply_filters('growtype_newsletter_submission_save_data', $data);

    if (class_exists('Flamingo_Contact')) {
        $response = Flamingo_Contact::add($data);
    }

    if (!empty($response) && !$response) {
        return wp_send_json(
            [
                'message' => __('Something went wrong. Please contact us for help.', 'growtype')
            ], 400);
    }

    return wp_send_json(
        [
            'message' => __('Your subscription is successful. Thank you.', 'growtype')
        ], 200);
}

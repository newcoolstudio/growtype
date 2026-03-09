<?php

/**
 * PWA Push Notification Subscription handler
 */
add_action('wp_ajax_growtype_save_pwa_subscription', 'growtype_save_pwa_subscription');
add_action('wp_ajax_nopriv_growtype_save_pwa_subscription', 'growtype_save_pwa_subscription');

function growtype_save_pwa_subscription()
{
    $subscription_json = $_POST['subscription'] ?? '';

    if (empty($subscription_json)) {
        wp_send_json_error(['message' => 'No subscription data provided']);
    }

    $subscription = json_decode(stripslashes($subscription_json), true);
    if (!$subscription) {
        $subscription = json_decode($subscription_json, true);
    }

    if (!$subscription) {
        wp_send_json_error(['message' => 'Invalid subscription JSON']);
    }

    $user_id = get_current_user_id();

    if ($user_id) {
        // Logged in: direct update
        update_user_meta($user_id, 'pwa_push_subscription', $subscription_json);
        // Clear any previous pending cookie
        setcookie('pwa_pending_subscription', '', time() - 3600, '/');
    }
    else {
        // Guest user: store in cookie for a year
        setcookie('pwa_pending_subscription', $subscription_json, time() + (365 * 24 * 60 * 60), '/');
    }

    // Debugging
    if ((defined('WP_ENV') && WP_ENV === 'development') || (\App\config('wp.env') === 'development')) {
        error_log("PWA: Received subscription. Status: " . ($user_id ? "Saved to user $user_id" : "Saved to cookie"));
    }

    wp_send_json_success([
        'message' => 'Subscription received',
        'status' => $user_id ? 'saved' : 'pending'
    ]);
}

/**
 * Send a PWA Push Notification
 */
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

function growtype_send_pwa_notification($user_id, $title, $body, $data = [])
{
    $subscription_data = get_user_meta($user_id, 'pwa_push_subscription', true);
    if (!$subscription_data) {
        return false;
    }

    $auth = [
        'VAPID' => [
            'subject' => getenv('PWA_VAPID_SUBJECT') ?: 'mailto:' . getenv('ADMIN_EMAIL'),
            'publicKey' => getenv('PWA_VAPID_PUBLIC_KEY'),
            'privateKey' => getenv('PWA_VAPID_PRIVATE_KEY'),
        ],
    ];

    try {
        $webPush = new WebPush($auth);
        $subscription = Subscription::create(json_decode($subscription_data, true));

        $payload = apply_filters('growtype_pwa_notification_payload', [
            'title' => $title,
            'body' => $body,
            'icon' => '/app/themes/growtype/public/images/logo.png', // Default parent icon
            'badge' => '/app/themes/growtype/public/images/logo.png', // Default parent badge
        ], $user_id, $data);

        $payload = array_merge($payload, $data);

        $webPush->queueNotification($subscription, json_encode($payload));

        foreach ($webPush->flush() as $report) {
            if ($report->isSuccess()) {
                return true;
            }
            else {
                error_log("PWA: Push notification failed: " . $report->getReason());
                return false;
            }
        }
    }
    catch (\Exception $e) {
        error_log("PWA: Error sending push: " . $e->getMessage());
        return false;
    }

    return false;
}
<?php

/**
 * PWA Push Notification Subscription handler
 */
add_action('wp_ajax_growtype_save_pwa_subscription', 'growtype_save_pwa_subscription');
add_action('wp_ajax_nopriv_growtype_save_pwa_subscription', 'growtype_save_pwa_subscription');

function growtype_pwa_decode_subscription_payload($raw_subscription)
{
    if (is_array($raw_subscription)) {
        return $raw_subscription;
    }

    if (!is_string($raw_subscription)) {
        return null;
    }

    $raw_subscription = trim($raw_subscription);
    if ($raw_subscription === '') {
        return null;
    }

    $decoded = json_decode(stripslashes($raw_subscription), true);
    if (!$decoded) {
        $decoded = json_decode($raw_subscription, true);
    }

    if ($decoded) {
        return $decoded;
    }

    $maybe_serialized = maybe_unserialize($raw_subscription);
    if (is_array($maybe_serialized)) {
        return $maybe_serialized;
    }

    return null;
}

function growtype_pwa_normalize_subscription($subscription)
{
    if (!is_array($subscription)) {
        return null;
    }

    $endpoint = isset($subscription['endpoint']) ? trim((string)$subscription['endpoint']) : '';
    $p256dh = $subscription['keys']['p256dh'] ?? '';
    $auth = $subscription['keys']['auth'] ?? '';

    if ($endpoint === '' || $p256dh === '' || $auth === '') {
        return null;
    }

    $normalized = [
        'endpoint' => $endpoint,
        'keys' => [
            'p256dh' => $p256dh,
            'auth' => $auth,
        ],
    ];

    if (!empty($subscription['contentEncoding'])) {
        $normalized['contentEncoding'] = $subscription['contentEncoding'];
    } elseif (!empty($subscription['content_encoding'])) {
        $normalized['contentEncoding'] = $subscription['content_encoding'];
    }

    return $normalized;
}

function growtype_pwa_get_user_subscriptions($user_id)
{
    $raw_sources = [
        get_user_meta($user_id, 'pwa_push_subscriptions', true),
        get_user_meta($user_id, 'pwa_push_subscription', true),
    ];

    $subscriptions_by_endpoint = [];

    foreach ($raw_sources as $raw_source) {
        $decoded = growtype_pwa_decode_subscription_payload($raw_source);
        if (!$decoded) {
            continue;
        }

        // Single subscription payload
        if (isset($decoded['endpoint'])) {
            $normalized = growtype_pwa_normalize_subscription($decoded);
            if ($normalized) {
                $subscriptions_by_endpoint[$normalized['endpoint']] = $normalized;
            }
            continue;
        }

        // List of subscriptions
        if (is_array($decoded)) {
            foreach ($decoded as $subscription) {
                $normalized = growtype_pwa_normalize_subscription($subscription);
                if ($normalized) {
                    $subscriptions_by_endpoint[$normalized['endpoint']] = $normalized;
                }
            }
        }
    }

    return array_values($subscriptions_by_endpoint);
}

function growtype_pwa_store_user_subscriptions($user_id, $subscriptions)
{
    $subscriptions_by_endpoint = [];

    if (is_array($subscriptions)) {
        foreach ($subscriptions as $subscription) {
            $normalized = growtype_pwa_normalize_subscription($subscription);
            if ($normalized) {
                $subscriptions_by_endpoint[$normalized['endpoint']] = $normalized;
            }
        }
    }

    $subscriptions = array_values($subscriptions_by_endpoint);

    if (empty($subscriptions)) {
        delete_user_meta($user_id, 'pwa_push_subscriptions');
        delete_user_meta($user_id, 'pwa_push_subscription');
        return;
    }

    update_user_meta($user_id, 'pwa_push_subscriptions', wp_json_encode($subscriptions));
    update_user_meta($user_id, 'pwa_push_subscription', wp_json_encode(end($subscriptions)));
}

function growtype_pwa_upsert_user_subscription($user_id, $subscription)
{
    $normalized = growtype_pwa_normalize_subscription($subscription);
    if (!$normalized) {
        return growtype_pwa_get_user_subscriptions($user_id);
    }

    $subscriptions = growtype_pwa_get_user_subscriptions($user_id);
    $subscriptions_by_endpoint = [];

    foreach ($subscriptions as $existing_subscription) {
        $subscriptions_by_endpoint[$existing_subscription['endpoint']] = $existing_subscription;
    }

    $subscriptions_by_endpoint[$normalized['endpoint']] = $normalized;
    $subscriptions = array_values($subscriptions_by_endpoint);

    growtype_pwa_store_user_subscriptions($user_id, $subscriptions);

    return $subscriptions;
}

function growtype_save_pwa_subscription()
{
    $subscription_json = $_POST['subscription'] ?? '';

    if (empty($subscription_json)) {
        wp_send_json_error(['message' => 'No subscription data provided']);
    }

    $subscription = growtype_pwa_decode_subscription_payload($subscription_json);
    $subscription = growtype_pwa_normalize_subscription($subscription);

    if (!$subscription) {
        wp_send_json_error(['message' => 'Invalid subscription JSON']);
    }

    $user_id = get_current_user_id();

    if ($user_id) {
        // Logged in: store/update by endpoint, keep all active devices.
        $subscriptions = growtype_pwa_upsert_user_subscription($user_id, $subscription);

        // Clear any previous pending cookie
        setcookie('pwa_pending_subscription', '', time() - 3600, '/');
    } else {
        // Guest user: store in cookie for a year
        setcookie('pwa_pending_subscription', $subscription_json, time() + (365 * 24 * 60 * 60), '/');
    }

    // Debugging
    if ((defined('WP_ENV') && WP_ENV === 'development') || (\App\config('wp.env') === 'development')) {
        $log_status = $user_id ? "Saved to user $user_id (" . count($subscriptions ?? []) . " active subscriptions)" : "Saved to cookie";
        error_log("PWA: Received subscription. Status: " . $log_status);
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
    $subscriptions = growtype_pwa_get_user_subscriptions($user_id);
    if (empty($subscriptions)) {
        error_log("PWA: Cannot send push to User $user_id. No subscription token found in user_meta.");
        return false;
    }

    error_log("PWA: Attempting to send push to User $user_id (" . count($subscriptions) . " subscriptions)...");

    $auth = [
        'VAPID' => [
            'subject' => getenv('PWA_VAPID_SUBJECT') ?: 'mailto:' . getenv('ADMIN_EMAIL'),
            'publicKey' => getenv('PWA_VAPID_PUBLIC_KEY'),
            'privateKey' => getenv('PWA_VAPID_PRIVATE_KEY'),
        ],
    ];

    try {
        $webPush = new WebPush($auth);

        $payload = apply_filters('growtype_pwa_notification_payload', [
            'title' => $title,
            'body' => $body,
            'icon' => '/app/themes/growtype/public/images/logo.png', // Default parent icon
            'badge' => '/app/themes/growtype/public/images/logo.png', // Default parent badge
        ], $user_id, $data);

        $payload = array_merge($payload, $data);

        foreach ($subscriptions as $subscription_data) {
            $webPush->queueNotification(Subscription::create($subscription_data), json_encode($payload));
        }

        $sent_successfully = false;
        $expired_endpoints = [];

        foreach ($webPush->flush() as $report) {
            if ($report->isSuccess()) {
                $sent_successfully = true;
            } else {
                error_log("PWA: Push notification failed for endpoint {$report->getEndpoint()}: " . $report->getReason());

                if ($report->isSubscriptionExpired()) {
                    $expired_endpoints[] = $report->getEndpoint();
                }
            }
        }

        // Clean up expired subscriptions to avoid repeated failures.
        if (!empty($expired_endpoints)) {
            $active_subscriptions = array_values(array_filter($subscriptions, function ($subscription) use ($expired_endpoints) {
                return !in_array($subscription['endpoint'], $expired_endpoints, true);
            }));
            growtype_pwa_store_user_subscriptions($user_id, $active_subscriptions);
        }

        return $sent_successfully;
    } catch (\Exception $e) {
        error_log("PWA: Error sending push: " . $e->getMessage());
        return false;
    }
}

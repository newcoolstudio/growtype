<?php

/**
 * Disable marketing
 */
add_filter('woocommerce_admin_features', 'disable_features');
function disable_features($features)
{
    $features = array_filter($features, function ($var) {
        return ($var !== 'marketing');
    });

    return $features;
}

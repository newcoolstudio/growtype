<?php

/**
 *
 */
if (!function_exists('growtype_get_main_container_classes')) {
    function growtype_get_main_container_classes()
    {
        $classes = [
            'main',
            'post-' . get_the_ID(),
            'type-' . get_post_type(),
            'status-' . get_post_status(),
        ];

        $classes = apply_filters('growtype_extend_main_container_classes', $classes);

        return implode(' ', $classes);
    }
}

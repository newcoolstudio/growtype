<?php

add_action('save_post', 'save_post_data', 10, 3);

function save_post_data($post_ID, $post, $update)
{
    if (!empty(getenv('HOOK_EXTERNAL_URL'))) {
        if (!(wp_is_post_revision($post_ID) || wp_is_post_autosave($post_ID))) {
            $body = array (
                'slug' => $post->post_name,
                'type' => get_post_type($post),
            );

            $args = array (
                'body' => $body,
            );

            wp_remote_post(getenv('HOOK_EXTERNAL_URL'), $args);
        }
    }
}

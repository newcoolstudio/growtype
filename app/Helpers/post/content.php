<?php

/**
 * Post reading time
 */
if (!function_exists('growtype_get_post_content_reading_time')) {
    function growtype_get_post_content_reading_time($post_id)
    {
        if (empty($post_id)) {
            return false;
        }

        $content = get_post_field('post_content', $post_id);
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200);

        if ($reading_time == 1) {
            $timer = " min";
        } else {
            $timer = " min";
        }

        return $reading_time . $timer . ' ' . __('read', 'growtype');
    }
}

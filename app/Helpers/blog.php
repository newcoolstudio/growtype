<?php

/**
 * @param $initial_content
 * @param int $length
 * @return string
 */
function growtype_get_post_content($postId)
{
    $content_post = get_post($postId);
    $content = $content_post->post_content;
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);

    return $content;
}

/**
 * @param $initial_content
 * @param int $length
 * @return string
 */
function growtype_get_post_content_limited($initial_content, $length = 125)
{
    $content = $initial_content;
    $content = strip_shortcodes($content);
    $content = strip_tags($content);
    $content = substr($content, 0, $length);
    $content = substr($content, 0, strripos($content, " "));
    $content = trim(preg_replace('/\s+/', ' ', $content));
    $content = $content . '...';

    return $content;
}

/**
 * @param $post
 * @return string
 */
function growtype_get_post_reading_time($post)
{
    if (!isset($post->ID)) {
        return false;
    }

    $content = get_post_field('post_content', $post->ID);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);

    if ($reading_time == 1) {
        $timer = " min";
    } else {
        $timer = " min";
    }

    return $reading_time . $timer . ' ' . __('read', 'growtype');
}

/**
 * @param null $custom_query
 */
function growtype_get_pagination($custom_query = null)
{
    if (empty($custom_query)) {
        global $wp_query;
        $custom_query = $wp_query;
    }

    $total_pages = $custom_query->max_num_pages;
    $big = 999999999;

    if ($total_pages > 1) {
        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array (
            'prev_text' => '<span class="dashicons dashicons-arrow-left-alt"></span>',
            'next_text' => '<span class="dashicons dashicons-arrow-right-alt"></span>',
            'type' => 'list',
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?page=%#%',
            'current' => $current_page,
            'total' => $total_pages,
        ));
    }
}

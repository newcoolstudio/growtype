<?php

/**
 * @return bool
 */
function is_front_post()
{
    return get_option('page_on_front') == get_current_post_ID(get_post());
}

/**
 * Get current post/page ID
 */
function get_current_post_ID($post)
{
    $post_id = $post->ID ?? null;

    if (empty($post_id)) {
        $post_name = $post->post_name ?? null;
        $post = get_page_by_path($post_name);
        $post_id = $post->ID ?? null;
    }

    return $post_id;
}

/**
 * @return string
 * Get posts order by start_time
 */
function get_posts_ordered_by_start_time($limit = -1, $single_post_id = null, $post_type = 'activity')
{
    $args = array (
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'orderby' => 'end_date',
        'order' => 'ASC',
        'meta_query' => array (
            'relation' => 'OR',
            array (
                'key' => 'start_date',
                'value' => date('Y-m-d H:i:s'),
                'compare' => '>'
            ),
            array (
                'key' => 'end_date',
                'value' => date('Y-m-d H:i:s'),
                'compare' => '>'
            ),
        )
    );

    $first_tag = null;
    if (!empty($single_post_id)) {
        $first_tag = !empty(wp_get_post_tags(get_the_id())) ? wp_get_post_tags(get_the_id())[0]->term_id : '';
        $args['post__not_in'] = array ($single_post_id);
    }

    if (!empty($first_tag)) {
        $args['tag__in'] = array ($first_tag);
    }

    $the_query = new WP_Query($args);
    $valid_posts = $the_query->get_posts();
    $posts_available = $valid_posts;

    if ($limit === -1) {
        $extra_posts = true;
    } else {
        $extra_posts = count($valid_posts) < $limit;
    }

    if ($extra_posts) {

        $post_not_in = array_pluck($valid_posts, 'ID');

        if (!empty($single_post_id)) {
            $post_not_in = array_merge($post_not_in, [$single_post_id]);
        }

        $args = array (
            'post_type' => $post_type,
            'post__not_in' => $post_not_in,
            'post_status' => 'publish',
            'posts_per_page' => $limit,
            'orderby' => 'start_date',
            'order' => 'DESC',
            'meta_query' => array (
                array (
                    'key' => 'start_date',
                ),
            )
        );

        if (!empty($first_tag)) {
            $args['tag__in'] = array ($first_tag);
        }

        $the_query = new WP_Query($args);
        $expired_posts = $the_query->get_posts();

        $posts_available = array_merge($valid_posts, $expired_posts);
    }

    if ($limit !== -1) {
        $posts_available = array_slice($posts_available, 0, $limit);
    }

    return $posts_available;
}

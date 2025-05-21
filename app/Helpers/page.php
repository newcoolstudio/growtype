<?php

function growtype_is_home_page()
{
    return apply_filters('growtype_is_home_page', is_front_page());
}

/**
 * Render post content
 */
add_shortcode('growtype_render_post_content', 'growtype_render_post_content_callback');
function growtype_render_post_content_callback($atts)
{
    $id = isset($atts['id']) ? $atts['id'] : null;

    if (empty($id)) {
        return 'Post not found';
    }

    return growtype_render_post_content($id);
}

function growtype_render_post_content($id)
{
    $post = get_post($id);

    if (empty($post)) {
        return '';
    }

    $content = $post->post_content;

    return __(apply_filters('growtype_the_content', $content), 'growtype');
}

/**
 * Custom the_content filter
 */
add_filter('growtype_the_content', 'growtype_the_content_callback');
add_filter('growtype_the_content', 'do_blocks', 9);
add_filter('growtype_the_content', 'wptexturize');
add_filter('growtype_the_content', 'convert_smilies', 20);
add_filter('growtype_the_content', 'shortcode_unautop');
add_filter('growtype_the_content', 'prepend_attachment');
add_filter('growtype_the_content', 'wp_replace_insecure_home_url');
add_filter('growtype_the_content', 'do_shortcode', 11);
add_filter('growtype_the_content', 'wp_filter_content_tags', 12);

function growtype_the_content_callback($content)
{
    return $content;
}

function growtype_page_is_under_construction()
{
    $under_construction_enabled = get_theme_mod('growtype_is_under_construction');

    if ($under_construction_enabled) {
        $is_wp_json = isset($_SERVER['REQUEST_URI']) ? strpos($_SERVER['REQUEST_URI'], 'wp-json') : false;
        $is_login_page = isset($_SERVER['REQUEST_URI']) ? strpos($_SERVER['REQUEST_URI'], 'wp-login.php') : false;
        $is_callback = isset($_SERVER['REQUEST_URI']) ? strpos($_SERVER['REQUEST_URI'], 'callback') : false;

        return !$is_login_page && !$is_wp_json && !$is_callback && !is_user_logged_in();
    }

    return false;
}

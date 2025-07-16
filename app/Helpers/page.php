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

function growtype_page_is_under_construction() {
    // Feature toggle in Customizer
    if ( ! get_theme_mod( 'growtype_is_under_construction', false ) ) {
        return false;
    }

    // Let administrators through
    if ( current_user_can( 'manage_options' ) ) {
        return false;
    }

    // Don’t break JSON endpoints, login, or OAuth callbacks
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    if (
        strpos( $uri, 'wp-login.php' ) !== false ||
        strpos( $uri, 'wp-json' )     !== false ||
        strpos( $uri, 'callback' )    !== false
    ) {
        return false;
    }

    // Everyone else sees “under construction”
    return true;
}

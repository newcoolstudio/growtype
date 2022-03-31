<?php
/**
 * Modify default rest url prefix
 */
if (!empty(getenv('rest_url_prefix'))) {
    add_filter('rest_url_prefix', 'rest_url_prefix_update');
}

function rest_url_prefix_update($slug)
{
    return 'wp/wp-json';
}

/**
 * @param $response
 * @param $post
 * Reading Add custom fields to rest
 */
add_action('rest_api_init', 'add_custom_fields');
function add_custom_fields()
{
    register_rest_field(
        'post',
        'reading_time',
        array (
            'get_callback' => 'growtype_rest_api_get_post_reading_time',
            'update_callback' => null,
            'schema' => null,
        )
    );

    register_rest_field(
        'post',
        'featured_image',
        array (
            'get_callback' => 'get_featured_image',
            'update_callback' => null,
            'schema' => null,
        )
    );

    /**
     * @param $post
     * @return false|string
     */
    function growtype_rest_api_get_post_reading_time($post)
    {
        return Growtype_Post::reading_time($post['id']);
    }
}

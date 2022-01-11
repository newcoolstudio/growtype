<?php

/**
 * @param $class
 * @param $id
 * @param $align
 * @param $size
 * @return mixed
 */
function extend_image_tag_class($class, $id, $align, $size)
{
    return $class . ' img-fluid';
}

add_filter('get_image_tag_class', 'extend_image_tag_class', 0, 4);

/**
 * Metadata
 */
add_filter('wp_generate_attachment_metadata', 'manipulate_metadata_wpse_91177', 10, 2);
function manipulate_metadata_wpse_91177($metadata, $attachment_id)
{
    update_post_meta($attachment_id, 'upload_site', $_SERVER["HTTP_HOST"]);
    return $metadata;
}

add_filter('manage_upload_columns', 'camera_info_column_wpse_91177');
function camera_info_column_wpse_91177($columns)
{
    /**
     * Show only for administrator user
     */
    if (current_user_can('administrator')) {
        $columns['upload_site'] = 'Upload site';
    }
    return $columns;
}

add_action('manage_media_custom_column', 'camera_info_display_wpse_91177', 10, 2);
function camera_info_display_wpse_91177($column_name, $post_id)
{
    if ('upload_site' != $column_name || !wp_attachment_is_image($post_id)) {
        return;
    }

    $upload_site = !empty(get_post_meta($post_id, 'upload_site', true)) ? get_post_meta($post_id, 'upload_site', true) : '-';
    echo $upload_site;
}

<?php

/**
 * Growtype site
 * Requires:
 */
class Growtype_Site
{
    /**
     * @param $id
     * @return array|object|stdClass[]|null
     */
    public static function get_settings_fields($id): array
    {
        global $wpdb;

        $blog_prefix = $wpdb->get_blog_prefix($id);
        $sql = "SELECT * FROM {$blog_prefix}options
			WHERE option_name NOT LIKE %s
			AND option_name NOT LIKE %s";
        $query = $wpdb->prepare(
            $sql,
            $wpdb->esc_like('_') . '%',
            '%' . $wpdb->esc_like('user_roles')
        );

        return $wpdb->get_results($query);
    }

    /**
     * @param $id
     * @param $field_name
     * @return object
     */
    public static function get_settings_field_details($id, $field_name): object
    {
        $options = self::get_settings_fields($id);

        $blogname_details = array_where($options, function ($value) use ($field_name) {
            return $value->option_name === $field_name;
        });

        $blogname_details = !empty($blogname_details) ? array_values($blogname_details)[0] : (object)[
            'option_value' => '',
            'option_name' => $field_name
        ];

        return $blogname_details;
    }

    /**
     * @param $id
     * @param $field_name
     * @return object
     */
    public static function is_multisite_main_site(): bool
    {
        $is_main_site = is_main_site();

        if (!is_multisite() || (!empty(getenv('REMOTE_DOMAIN_TO_REPLICATE_TYPE')) && getenv('REMOTE_DOMAIN_TO_REPLICATE_TYPE') !== 'parent')) {
            $is_main_site = false;
        }

        return $is_main_site;
    }
}

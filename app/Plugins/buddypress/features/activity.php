<?php

/**
 *
 */
add_action('bp_activity_entry_content', 'bp_mini_activity_entry_contents');

if (!function_exists('bp_mini_activity_entry_contents')) {
    /**
     * Renders mini activity contents
     *
     * @return void
     * @since 1.0.0
     */
    function bp_mini_activity_entry_contents()
    {

        // Acitivity template global.
        global $activities_template;

        // Get Activity.
        $activity = $activities_template->activity;

//        d($activity->type);

        // Get templates.
        switch ($activity->type) {
            case 'new_member':
                include get_bp_template_path() . '/partials/user-activity-entries.php';
                break;

            case 'friendship_created':
                include get_bp_template_path() . '/partials/user-activity-entries.php';
                break;

            case 'updated_profile':
                include get_bp_template_path() . '/partials/user-activity-entries.php';
                break;

            case 'new_avatar':
                include get_bp_template_path() . '/partials/user-activity-entries.php';
                break;

            case 'created_group':
                include get_bp_template_path() . '/partials/group-activity-entries.php';
                break;

            case 'joined_group':
                if (bp_is_groups_component()) {
                    include get_bp_template_path() . '/partials/user-activity-entries.php';
                } else {
                    include get_bp_template_path() . '/partials/group-activity-entries.php';
                }
                break;
        }
    }
}

/**
 * @param $query
 * @return mixed|string
 * Activity filter
 */
add_filter('bp_ajax_querystring', 'bp_filter_default_activity', 999);

function bp_filter_default_activity($query)
{
    /**
     * Main feed filter
     *  // Possible filters
     * // 'new_member'
     * // 'updated_profile'
     * // 'activity_update'
     * // 'friendship_accepted'
     * //'friendship_created'
     * // 'created_group'
     * // 'joined_group'
     * // 'new_blog_post'
     * // 'rtmedia_update'
     * // 'new_blog_comment' etc.
     */
    if (bp_is_activity_directory() && isset($_POST["scope"]) && $_POST["scope"] === 'all') {
//        $query = 'action=rtmedia_update';
//        $query = 'scope=mentions';
    }

    return $query;
}

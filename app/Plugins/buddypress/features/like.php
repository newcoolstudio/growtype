<?php


/** Do not allow directly accessing this file. */
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

// Return if component is not active.
if (!bp_is_active('activity')) {
    return;
}

/**
 * Actions
 *
 * @since 1.0.0
 */
// Insert like button.
add_action('bp_activity_entry_meta', 'bp_like_button');
// Process ajax like.
add_action('wp_ajax_activity_like', 'bp_like_process_ajax');

if (!function_exists('bp_like_is_liked')) :
    /**
     * Checks to see whether the user has liked a given item.
     *
     * @param int $item_id id of the item.
     * @param string $type type of activity.
     * @param int $user_id user id.
     * @return bool
     * @since 1.0.0
     */
    function bp_like_is_liked($item_id, $type, $user_id)
    {

        // Return early.
        if (!$type || !$item_id) {
            return false;
        }

        // Assign user id if not assigned.
        if (isset($user_id)) {
            if (!$user_id) {
                $user_id = get_current_user_id();
            }
        }

        // Get likes for a given user.
        if ('activity_update' === $type) {
            $user_likes = get_user_meta($user_id, 'liked_activities', true);
        }

        // Return bool.
        if (!isset($user_likes) || !$user_likes) {
            return false;
        } elseif (!array_key_exists($item_id, $user_likes)) {
            return false;
        } else {
            return true;
        }
    }
endif;

if (!function_exists('bp_like_add_user_like')) :
    /**
     * Adds a like to a given activity
     *
     * @param int $item_id item id.
     * @param string $type activity type.
     * @return bool
     * @since 1.0.0
     */
    function bp_like_add_user_like($item_id, $type)
    {

        // Return early.
        if (!$item_id || !is_user_logged_in()) {
            return false;
        }

        // like count.
        $liked_count = 0;

        // User id.
        $user_id = get_current_user_id();

        // Update like.
        if ('activity_update' === $type) {

            // Add to the  users liked activities.
            $user_likes = get_user_meta($user_id, 'liked_activities', true);
            if (!is_array($user_likes)) {
                $user_likes = array ();
            }
            $user_likes[$item_id] = 'activity_liked';
            update_user_meta($user_id, 'liked_activities', $user_likes);

            // Add to the total likes for this activity.
            $users_who_like = bp_activity_get_meta($item_id, 'liked_count', true);
            if (!is_array($users_who_like)) {
                $users_who_like = array ();
            }
            $users_who_like[$user_id] = 'user_likes';
            bp_activity_update_meta($item_id, 'liked_count', $users_who_like);

            $liked_count = count($users_who_like);

        }

        // Frontend live update.
        if ($liked_count) {
            printf('<i class ="icon-like"></i>%s<span class="count">%u</span>', __('Liked', 'growtype'), esc_html($liked_count));
        } else {
            printf('<i class ="icon-like"></i>%s', __('Liked', 'growtype'));
        }
    }
endif;

if (!function_exists('bp_like_remove_user_like')) :
    /**
     * Remove a like from a given activity
     *
     * @param int $item_id item id.
     * @param string $type activity type.
     * @return bool
     * @since 1.0.0
     */
    function bp_like_remove_user_like($item_id = '', $type = '')
    {

        // Return false if item_id is empty.
        if (!$item_id || !is_user_logged_in()) {
            return false;
        }

        // Like count.
        $liked_count = 0;

        // User id.
        $user_id = get_current_user_id();

        if ('activity_update' === $type) {

            // Remove this from the users liked activities.
            $user_likes = get_user_meta($user_id, 'liked_activities', true);
            if (!is_array($user_likes)) {
                return false;
            }
            unset($user_likes[$item_id]);
            update_user_meta($user_id, 'liked_activities', $user_likes);

            // Update the total number of users who have liked this activity.
            $users_who_like = bp_activity_get_meta($item_id, 'liked_count', true);
            if (!is_array($users_who_like)) {
                return false;
            }
            unset($users_who_like[$user_id]);

            // If nobody likes the activity, delete the meta for it to save space, otherwise, update the meta.
            if (empty($users_who_like)) {
                bp_activity_delete_meta($item_id, 'liked_count');
            } else {
                bp_activity_update_meta($item_id, 'liked_count', $users_who_like);
            }

            $liked_count = count($users_who_like);

        }

        // Frontend live update.
        if ($liked_count) {
            printf('<i class ="icon-like"></i>%s<span class="count">%u</span>', __('Like', 'growtype'), esc_html($liked_count));
        } else {
            printf('<i class ="icon-like"></i>%s', __('Like', 'growtype'));
        }
    }
endif;

if (!function_exists('bp_like_get_some_likes')) :
    /**
     * Returns html string containing who likes the post
     * It's here for future use
     *
     * @param int $id like id.
     * @param string $type activity type.
     * @return bool
     * @since 1.0.0
     */
    function bp_like_get_some_likes($id, $type)
    {

        // Check the type, then execute or return.
        if ('activity_update' === $type) {
            $users_who_like = array_keys((array)(bp_activity_get_meta($id, 'liked_count', true)));
        } else {
            return;
        }

        // Html.
        $html = '';

        if (isset($users_who_like) && is_array($users_who_like) && !empty($users_who_like)) {
            $html .= '<div class="see-who-likes-this">';
            $html .= '<ul id="users-who-like-' . $id . '" class="users-who-like">';
            foreach ($users_who_like as $user) {
                $html .= '<li>';
                $html .= '<a href="' . bp_core_get_user_domain($user) . '" target="_blank">';
                $html .= bp_core_get_user_displayname($user);
                $html .= '</a>';
                $html .= '</li>';
            }
            $html .= '</ul>';
            $html .= '</div>';
        }

        // Return html.
        return $html;
    }
endif;

if (!function_exists('bp_like_button')) :
    /**
     * Renders the like button
     *
     * @return void
     * @since 1.0.0
     */
    function bp_like_button()
    {

        // Like count.
        $liked_count = 0;
        // Html.
        $html = '';

        // Run this only for logged in users.
        if (is_user_logged_in()) {

            // Get like count.
            $activity_liked_count = bp_activity_get_meta(bp_get_activity_id(), 'liked_count', true);
            if (is_array($activity_liked_count) & !empty($activity_liked_count)) {
                $users_who_like = array_keys(bp_activity_get_meta(bp_get_activity_id(), 'liked_count', true));
                $liked_count = count($users_who_like);
            }

            // Like button.
            if (!bp_like_is_liked(bp_get_activity_id(), 'activity_update', get_current_user_id())) {
                $html .= '<div class="generic-button btn-like">';
                $html .= '<a href="#" class="button bp-primary-action like" id="like-activity-' . bp_get_activity_id() . '">';
                $html .= '<i class="icon-like"></i>';
                $html .= '<span class="like-text">' . esc_attr__('Like', 'growtype') . '</span>';
                if ($liked_count) {
                    $html .= ' <span class="count">' . $liked_count . '</span>';
                }
                $html .= '</a>';
                $html .= '</div>';
            } else {
                $html .= '<div class="generic-button btn-like">';
                $html .= '<a href="#" class="button bp-primary-action unlike" id="unlike-activity-' . bp_get_activity_id() . '" title="' . esc_attr__('Unlike this', 'growtype') . '">';
                $html .= '<i class="icon-like"></i>';
                $html .= '<span class="like-text">' . __('Liked', 'growtype') . '</span>';
                if ($liked_count) {
                    $html .= '<span class="count">' . $liked_count . '</span>';
                }
                $html .= '</a>';
                $html .= '</div>';
            }

            // Echo html.
            echo wp_kses_post($html);

        }
    }
endif;

if (!function_exists('bp_like_process_ajax')) :
    /**
     * Process ajax like
     *
     * @return void
     * @since 1.0.0
     */
    function bp_like_process_ajax()
    {

        // Kill it if required data not passed.
        if (!isset($_POST['id']) || !isset($_POST['id'])) { // phpcs:ignore WordPress.Security.NonceVerification
            die();
        }

        // Ensuring $id only contains an integer.
        $id = preg_replace('/\D/', '', $_POST['id']); // @codingStandardsIgnoreLine

        // Add user like.
        if ('activity_update like' === $_POST['type']) { // @codingStandardsIgnoreLine
            bp_like_add_user_like($id, 'activity_update');
        }

        // Remove user like.
        if ('activity_update unlike' === $_POST['type']) { // @codingStandardsIgnoreLine
            bp_like_remove_user_like($id, 'activity_update');
        }

        die();

    }
endif;

if (!function_exists('bp_like_ajax_process_who_likes')) :
    /**
     * Ajax processing function for getting who likes the post
     * It's here for future use
     *
     * @return void
     * @since 1.0.0
     */
    function bp_like_ajax_process_who_likes()
    {

        // Kill it if required data not passed.
        if (!isset($_POST['id'])) { // @codingStandardsIgnoreLine
            die();
        }

        // ensuring $id only contains an integer.
        $id = preg_replace('/\D/', '', $_POST['id']); // @codingStandardsIgnoreLine

        bp_like_get_some_likes($id, 'activity_update');

        die();
    }
endif;

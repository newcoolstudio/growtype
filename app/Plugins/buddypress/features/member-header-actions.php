<?php

add_action('bp_member_header_actions', 'bp_logged_in_user_actions', 10, 1);

if (!function_exists('bp_logged_in_user_actions')) :
    /**
     * Logged in user profile actions
     *
     * @return void
     * @since 1.0.0
     */
    function bp_logged_in_user_actions()
    {
        if (bp_is_my_profile()) {
            echo '<li class = "generic-button"><a class="edit-profile" href ="' . esc_url(bp_get_members_component_link('profile', 'edit')) . '">' . __('Edit profile', 'growtype') . '</a><li>';
            if (!bp_disable_cover_image_uploads()) {
                echo '<li class = "generic-button"><a class="update-cover" href="' . esc_url(bp_get_members_component_link('profile', 'change-cover-image')) . '">' . __('Update cover', 'growtype') . '</a></li>';
            } else {
                echo '<li class = "generic-button"><a class="profile-settings" href="' . esc_url(bp_get_members_component_link('settings')) . '">' . __('Profile settings', 'growtype') . '</a></li>';
            }
        }
    }

endif;

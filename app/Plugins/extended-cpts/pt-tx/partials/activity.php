<?php

add_action('init', function () {
    $cpt_name = !empty(get_option('cpt_1_value')) ? get_option('cpt_1_value') : 'activity';
    $cpt_name_2 = !empty(get_option('cpt_2_value')) ? get_option('cpt_2_value') : 'activity';
    $cpt_name_3 = !empty(get_option('cpt_3_value')) ? get_option('cpt_3_value') : 'activity';
    $cpt_name_4 = !empty(get_option('cpt_4_value')) ? get_option('cpt_4_value') : 'activity';

    if ($cpt_name === 'activity' || $cpt_name_2 === 'activity' || $cpt_name_3 === 'activity' || $cpt_name_4 === 'activity') {
        /**
         * External Url
         */
        add_action('add_meta_boxes', 'activity_location');
        function activity_location($post)
        {
            add_meta_box('activity_location', __('Location', 'growtype'), 'activity_location_output', 'activity', 'normal', 'low');
        }

        function activity_location_output($post)
        {
            wp_nonce_field(basename(__FILE__), 'activity_location_nonce'); //used later for security
            echo '<input type="text" name="activity_location" style="width:100%;margin-top:5px;" value="' . get_post_meta($post->ID, 'activity_location', true) . '"/>';
//            echo '<div id="timestampdiv" class="hide-if-js">' . touch_time(1, 1, 4) . '</div>';
        }

        /**
         * Save output
         */
        add_action('save_post', 'activity_location_save_meta_boxes_data', 10, 2);
        function activity_location_save_meta_boxes_data($post_id)
        {
            // check for nonce to top xss
            if (!isset($_POST['activity_location_nonce']) || !wp_verify_nonce($_POST['activity_location_nonce'], basename(__FILE__))) {
                return;
            }

            // check for correct user capabilities - stop internal xss from customers
            if (!current_user_can('edit_post', $post_id)) {
                return;
            }

            // update fields
            if (isset($_REQUEST['activity_location'])) {
                update_post_meta($post_id, 'activity_location', sanitize_text_field($_POST['activity_location']));
            }
        }
    }
});

<?php

add_action('init', function () {
    $cpt_name = !empty(get_option('cpt_1_value')) ? get_option('cpt_1_value') : 'project';
    $cpt_name_2 = !empty(get_option('cpt_2_value')) ? get_option('cpt_2_value') : 'project';
    $cpt_name_3 = !empty(get_option('cpt_3_value')) ? get_option('cpt_3_value') : 'project';
    $cpt_name_4 = !empty(get_option('cpt_4_value')) ? get_option('cpt_4_value') : 'project';

    if ($cpt_name === 'project' || $cpt_name_2 === 'project' || $cpt_name_3 === 'project' || $cpt_name_4 === 'project') {
        /**
         * External Url
         */
        add_action('add_meta_boxes', 'project_external_url');
        function project_external_url($post)
        {
            add_meta_box('project_external_url', __('External url', 'growtype'), 'project_external_url_output', 'project', 'normal', 'low');
        }

        function project_external_url_output($post)
        {
            wp_nonce_field(basename(__FILE__), 'project_external_url_nonce'); //used later for security
            echo '<input type="text" name="project_external_url" style="width:100%;margin-top:5px;" value="' . get_post_meta($post->ID, 'project_external_url', true) . '"/>';
        }

        /**
         * Open in lightbox
         */
        add_action('add_meta_boxes', 'meta_box_for_project');
        function meta_box_for_project($post)
        {
            add_meta_box('project_open_in_lightbox', __('Open project in lightbox', 'growtype'), 'project_open_in_lightbox_output', 'project', 'normal', 'low');
        }

        function project_open_in_lightbox_output($post)
        {
            wp_nonce_field(basename(__FILE__), 'project_open_in_lightbox_nonce'); //used later for security
            echo '<input type="checkbox" name="project_open_in_lightbox" ' . (get_post_meta($post->ID, 'project_open_in_lightbox', true) ? 'checked' : '') . '/>';
        }

        /**
         * Save output
         */
        add_action('save_post', 'project_external_url_save_meta_boxes_data', 10, 2);
        function project_external_url_save_meta_boxes_data($post_id)
        {
            // check for nonce to top xss
            if (!isset($_POST['project_external_url_nonce']) || !wp_verify_nonce($_POST['project_external_url_nonce'], basename(__FILE__))) {
                return;
            }

            // check for nonce to top xss
            if (!isset($_POST['project_open_in_lightbox_nonce']) || !wp_verify_nonce($_POST['project_open_in_lightbox_nonce'], basename(__FILE__))) {
                return;
            }

            // check for correct user capabilities - stop internal xss from customers
            if (!current_user_can('edit_post', $post_id)) {
                return;
            }

            // update fields
            if (isset($_REQUEST['project_external_url'])) {
                update_post_meta($post_id, 'project_external_url', sanitize_text_field($_POST['project_external_url']));
            }

            // update fields
            if (isset($_REQUEST['project_open_in_lightbox'])) {
                update_post_meta($post_id, 'project_open_in_lightbox', sanitize_text_field($_REQUEST['project_open_in_lightbox']));
            } else {
                update_post_meta($post_id, 'project_open_in_lightbox', false);
            }
        }
    }
});

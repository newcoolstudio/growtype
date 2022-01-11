<?php

/**
 * cpt redirect
 */

add_action(
    'template_redirect',
    function () {
        if (is_single()) {
            if (!empty(get_option('cpt_1_value')) && is_singular(get_option('cpt_1_value')) && !get_option('cpt_1_single_page_enabled')) {
                global $wp_query;
                $wp_query->posts = [];
                $wp_query->post = null;
                $wp_query->set_404();
                status_header(404);
                nocache_headers();
            } elseif (!empty(get_option('cpt_2_value')) && is_singular(get_option('cpt_2_value')) && !get_option('cpt_2_single_page_enabled')) {
                global $wp_query;
                $wp_query->posts = [];
                $wp_query->post = null;
                $wp_query->set_404();
                status_header(404);
                nocache_headers();
            } elseif (!empty(get_option('cpt_3_value')) && is_singular(get_option('cpt_3_value')) && !get_option('cpt_3_single_page_enabled')) {
                global $wp_query;
                $wp_query->posts = [];
                $wp_query->post = null;
                $wp_query->set_404();
                status_header(404);
                nocache_headers();
            } elseif (!empty(get_option('cpt_4_value')) && is_singular(get_option('cpt_4_value')) && !get_option('cpt_4_single_page_enabled')) {
                global $wp_query;
                $wp_query->posts = [];
                $wp_query->post = null;
                $wp_query->set_404();
                status_header(404);
                nocache_headers();
            } elseif (!empty(get_option('cpt_5_value')) && is_singular(get_option('cpt_5_value')) && !get_option('cpt_5_single_page_enabled')) {
                global $wp_query;
                $wp_query->posts = [];
                $wp_query->post = null;
                $wp_query->set_404();
                status_header(404);
                nocache_headers();
            }
        }
    }
);

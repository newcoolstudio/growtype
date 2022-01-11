<?php

/**
 * Content indexing notice
 */
if (!get_option('bedrock_indexing_notice_enabled')) {
    add_filter('roots/bedrock/disallow_indexing_admin_notice', function () {
        return false;
    });
}

/**
 * Admin notices
 */
function hide_update_notice_to_all_but_admin_users()
{
    if (!current_user_can('update_core')) {
        remove_action('admin_notices', 'update_nag', 3);
    }
}

add_action('admin_head', 'hide_update_notice_to_all_but_admin_users', 1);

/**
 * Page is under construction
 */
function page_under_construction()
{
    if ($GLOBALS['pagenow'] !== 'wp-login.php') {
        if (!current_user_can('administrator')) {
            if (get_theme_mod('under_construction_switch')) {
                ?>
                <div style="display: inline-block;width: 100%;text-align: center;">
                    <h1>404</h1>
                    <p>What you are looking for doesn't exists.</p>
                </div>
                <?php
                die();
            }
        }
    }
}

add_action('init', 'page_under_construction');

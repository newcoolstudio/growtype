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
add_action('admin_head', 'growtype_hide_update_notice_to_all_but_admin_users', 1);
function growtype_hide_update_notice_to_all_but_admin_users()
{
    if (!current_user_can('update_core')) {
        remove_action('admin_notices', 'update_nag', 3);
    }
}

/**
 * Page is under construction
 */
add_action('wp', 'growtype_website_is_under_construction');
function growtype_website_is_under_construction()
{
    $is_wp_json = isset($_SERVER['REQUEST_URI']) ? strpos($_SERVER['REQUEST_URI'], 'wp-json') : false;
    $is_login_page = isset($_SERVER['REQUEST_URI']) ? strpos($_SERVER['REQUEST_URI'], 'wp-login.php') : false;

    if (!$is_login_page
        &&
        !$is_wp_json
        &&
        !is_user_logged_in()
        &&
        get_theme_mod('growtype_is_under_construction')
    ) {

        $content = get_theme_mod('growtype_is_under_construction_content');
        ?>
        <div style="display: inline-block;width: 100%;text-align: center;padding-top: 4vh;">
            <?php if (empty($content)) { ?>
                <h1><?php echo __('404', 'growtype') ?></h1>
                <p><?php echo __("What you are looking for doesn't exists.", 'growtype') ?></p>
            <?php } else {
                echo $content;
            } ?>
        </div>
        <?php
        die();
    }
}

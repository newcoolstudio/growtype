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
add_action('wp_body_open', 'growtype_website_is_under_construction');
function growtype_website_is_under_construction()
{
    if (growtype_page_is_under_construction()) {
        $content = get_theme_mod('growtype_is_under_construction_content'); ?>
        <div class="main-content">
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

add_filter('body_class', 'growtype_website_is_under_construction_body_class');
function growtype_website_is_under_construction_body_class($classes)
{
    if (growtype_page_is_under_construction()) {
        $classes[] = 'page-under-construction';
    }

    return $classes;
}

add_filter('wp_die_handler', 'growtype_wp_die_message');
function growtype_wp_die_message()
{
    $custom_message = 'Oops! Something went wrong. Please try again later.';

    wp_die($custom_message, 'Error');
}

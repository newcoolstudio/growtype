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

/**
 * Custom die message
 */
add_filter('wp_die_handler', function () {
    return 'growtype_wp_die_message';
});

function growtype_wp_die_message($message, $title = '', $args = array ())
{
    $intro_message = 'Oops! Something went wrong. Please try again.';

    error_log(sprintf('Growtype die message - %s', print_r([
        $message,
        $title,
        $args
    ], true)));

    echo '<div style="text-align:center; padding:50px;">';
    echo '<h1>' . esc_html($intro_message) . '</h1>';
    echo '<p>' . esc_html($message) . '</p>';
    echo '</div>';

    exit;
}

<?php

add_action('admin_init', 'discussion_custom_setting');

/**
 * Tell WP we use a setting - and where.
 */
function discussion_custom_setting()
{
    add_settings_section(
        'comments_fully_disabled_id',
        'Growtype - Extra Settings',
        'extra_description',
        'discussion'
    );

    // Register a callback
    register_setting(
        'discussion',
        'comments_fully_disabled',
        'trim'
    );

    // Register the field for the "avatars" section.
    add_settings_field(
        'comments_fully_disabled',
        'Comments fully disabled',
        'show_settings',
        'discussion',
        'comments_fully_disabled_id',
        array ('label_for' => 'comments_fully_disabled_id')
    );
}

/**
 * Print the text before our field.
 */
function extra_description()
{
    ?><p class="description">Extra settings for discussion</p><?php
}

/**
 * Show our field.
 *
 * @param array $args
 */
function show_settings($args)
{
    $disabled = get_option('comments_fully_disabled') ?? 1;
    $html = '<input type="checkbox" name="comments_fully_disabled" value="1" ' . checked(1, $disabled, false) . ' />';
    echo $html;
}

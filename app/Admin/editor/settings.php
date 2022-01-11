<?php

function disable_autosave()
{
    wp_deregister_script('autosave');
}

/**
 * Disable Autosaving
 */
if (empty(get_option('autosaving_enabled'))) {
    add_action('admin_init', 'disable_autosave');
}

/**
 * Reusable blocks in admin nav
 */
function be_reusable_blocks_admin_menu()
{
    add_menu_page('Reusable Blocks', 'Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22);
}

if (get_option('reusable_blocks_in_admin_enabled')) {
    add_action('admin_menu', 'be_reusable_blocks_admin_menu');
}


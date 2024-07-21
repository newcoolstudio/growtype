<?php
/**
 * Disable Autosaving
 */
if (empty(get_option('autosaving_enabled'))) {
    add_action('admin_init', 'disable_autosave');
    function disable_autosave()
    {
        wp_deregister_script('autosave');
    }
}

/**
 * Reusable blocks in admin nav
 */
if (get_option('reusable_blocks_in_admin_enabled')) {
    add_action('admin_menu', 'be_reusable_blocks_admin_menu');
    function be_reusable_blocks_admin_menu()
    {
        if (!current_user_can('edit_posts')) {
            add_menu_page('Reusable Blocks', 'Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22);
        }
    }
}

/**
 * Disable layout styles
 */
if (get_option('growtype_disable_layout_styles', false)) {
    add_theme_support('disable-layout-styles');
}

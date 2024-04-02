<?php

/**
 * Check if gutenberg is enabled
 * @return mixed
 */
function growtype_gutenberg_block_editor_is_active()
{
    return !empty(get_option('gutenberg_block_editor_enabled')) && get_option('gutenberg_block_editor_enabled');
}

/**
 * Check if gutenberg is enabled
 * @return mixed
 */
function growtype_widget_block_editor_is_active()
{
    return !empty(get_option('widget_block_editor_enabled')) && get_option('widget_block_editor_enabled');
}

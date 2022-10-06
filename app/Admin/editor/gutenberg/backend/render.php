<?php

/**
 * Disable widget block editor
 */
if (!widget_block_editor_is_active()) {
    add_filter('use_widgets_block_editor', '__return_false');
}

/**
 * Disable gutenberg block editor
 */
if (!gutenberg_block_editor_is_active()) {
    add_filter('use_block_editor_for_post', '__return_false');
}

/**
 * Gutenberg styles support
 */
add_action('enqueue_block_editor_assets', 'growtype_enqueue_block_editor_assets', 10);
function growtype_enqueue_block_editor_assets()
{
    if (get_post_type()) {
        wp_enqueue_style(
            'growtype-block-editor-styles',
            growtype_get_parent_theme_public_path() . '/styles/backend-block-editor.css',
            false,
        );

        wp_enqueue_style(
            'growtype-block-editor-styles-child',
            growtype_get_child_theme_public_path() . '/styles/backend-block-editor-child.css',
            false
        );

        wp_enqueue_script('growtype-block-editor-scripts',
            growtype_get_parent_theme_public_path() . '/scripts/backend-block-editor.js',
            ['wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'],
            '0.1.0'
        );
    }

    if (!empty(growtype_get_font_details('primary_font'))) {
        wp_enqueue_style(
            'body-primary-font',
            growtype_get_font_url(growtype_get_font_details('primary_font')),
            false
        );
    }

    if (growtype_secondary_font_is_active()) {
        $skip_seccondary_font = false;
        if (!empty(growtype_get_font_details('primary_font'))) {
            if (growtype_get_font_details('primary_font')->font === growtype_get_font_details('secondary_font')->font) {
                $skip_seccondary_font = true;
            }
        }

        if (!$skip_seccondary_font) {
            wp_enqueue_style(
                'body-secondary-font',
                growtype_get_font_url(growtype_get_font_details('secondary_font')),
                false
            );
        }
    }

    /**
     * Disable fullscreen mode by default
     */
    $script = "window.onload = function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } }";
    wp_add_inline_script('wp-blocks', $script);
}

/**
 * Apply styles
 */
add_action('admin_enqueue_scripts', 'admin_enqueue_custom_scripts');
function admin_enqueue_custom_scripts()
{
    $inlineCss = '';

    if (get_option('theme_font_enabled') && !empty(growtype_get_font_details('primary_font'))) {
        $inlineCss .= 'body.wp-admin .block-editor-block-list__layout {
            font-family: "' . growtype_get_font_details('primary_font')->font . '", sans-serif;
            font-weight: ' . urlencode(growtype_get_font_details('primary_font')->regularweight) . ';
        }';
    }

    if (get_option('theme_styles_enabled')) {
        if (!empty(get_theme_mod('primary_button_background_color'))) {
            $inlineCss .= '.editor-styles-wrapper .wp-block-button__link {
            background: ' . get_theme_mod('primary_button_background_color') . ';
            border: 1px solid ' . get_theme_mod('primary_button_background_color') . ';
        }';
        }

        if (!empty(get_theme_mod('primary_button_text_color'))) {
            $inlineCss .= '.editor-styles-wrapper .wp-block-button__link {
            color: ' . get_theme_mod('primary_button_text_color') . ';
        }';
        }

        if (!empty(get_theme_mod('body_background_color'))) {
            $inlineCss .= 'body.wp-admin .editor-styles-wrapper {
            background: ' . get_theme_mod('body_background_color') . ';
        }';
        }

        if (get_theme_mod('fonts_font_size_h1')) {
            $inlineCss .= 'body.wp-admin .block-editor-block-list__layout h1 {
    font-size:' . get_theme_mod('fonts_font_size_h1') . 'px;
        }';
        }

        if (get_theme_mod('fonts_font_size_h2')) {
            $inlineCss .= 'body.wp-admin .block-editor-block-list__layout h2 {
    font-size:' . get_theme_mod('fonts_font_size_h2') . 'px;
        }';
        }

        if (get_theme_mod('fonts_font_size_h3')) {
            $inlineCss .= 'body.wp-admin .block-editor-block-list__layout h3 {
    font-size:' . get_theme_mod('fonts_font_size_h3') . 'px;
        }';
        }

        if (get_theme_mod('fonts_font_size_h4')) {
            $inlineCss .= 'body.wp-admin .block-editor-block-list__layout h4 {
    font-size:' . get_theme_mod('fonts_font_size_h4') . 'px;
        }';
        }

        if (get_theme_mod('fonts_font_size_h5')) {
            $inlineCss .= 'body.wp-admin .block-editor-block-list__layout h5 {
    font-size:' . get_theme_mod('fonts_font_size_h5') . 'px;
        }';
        }

        if (get_theme_mod('fonts_font_size_p')) {
            $inlineCss .= 'body.wp-admin .block-editor-block-list__layout p {
    font-size:' . get_theme_mod('fonts_font_size_p') . 'px;
        }';
        }

        if (get_theme_mod('primary_button_background_color')) {
            $inlineCss .= '.wp-block-button__link {
    background:' . get_theme_mod('primary_button_background_color') . ';
        border: 1px solid ' . get_theme_mod('primary_button_background_color') . ';
        }';
        }

        if (get_theme_mod('primary_button_text_color')) {
            $inlineCss .= '.wp-block-button__link {
    color:' . get_theme_mod('primary_button_text_color') . ';
        }';
        }
    }

    wp_add_inline_style('gutenberg-block-editor-styles', $inlineCss);
}

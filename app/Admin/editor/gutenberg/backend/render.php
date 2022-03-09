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
add_action('enqueue_block_editor_assets', 'gutenberg_block_editor_assets', 10);
function gutenberg_block_editor_assets()
{
    if (get_post_type()) {
        wp_enqueue_style(
            'gutenberg-block-editor-styles',
            get_parent_template_public_path() . '/styles/backend-block-editor.css',
            false,
        );

        wp_enqueue_style(
            'gutenberg-block-editor-styles-child',
            get_child_template_public_path() . '/styles/backend-block-editor-child.css',
            false
        );

        wp_enqueue_script('gutenberg-block-editor-scripts',
            get_parent_template_public_path() . '/scripts/backend-block-editor.js',
            [], '1.0.0', true);
    }

    if (!empty(get_fonts_details()['primaryFontDetails'])) {
        wp_enqueue_style(
            'body-primary-font',
            'https://fonts.googleapis.com/css?family=' . urlencode(get_fonts_details()['primaryFontDetails']->font) . ':' . urlencode(get_fonts_details()['primaryFontDetails']->regularweight) . ',' . urlencode(get_fonts_details()['primaryFontDetails']->boldweight) . ',' . urlencode(get_fonts_details()['primaryFontDetails']->italicweight) . '',
            false
        );
    }

    if (!empty(get_fonts_details()['secondaryFontSwitch'])) {
        $skipSeccondaryFont = false;
        if (!empty(get_fonts_details()['primaryFontDetails'])) {
            if (get_fonts_details()['primaryFontDetails']->font === get_fonts_details()['secondaryFontDetails']->font) {
                $skipSeccondaryFont = true;
            }
        }

        if (!$skipSeccondaryFont) {
            wp_enqueue_style(
                'body-secondary-font',
                'https://fonts.googleapis.com/css?family=' . urlencode(get_fonts_details()['secondaryFontDetails']->font) . ':' . urlencode(get_fonts_details()['secondaryFontDetails']->regularweight) . ',' . urlencode(get_fonts_details()['secondaryFontDetails']->boldweight) . ',' . urlencode(get_fonts_details()['secondaryFontDetails']->italicweight) . '',
                false
            );
        }
    }
}

/**
 * Apply styles
 */
add_action('admin_enqueue_scripts', 'admin_enqueue_custom_scripts');

function admin_enqueue_custom_scripts()
{
    $inlineCss = '';

    if (get_option('theme_font_enabled') && !empty(get_fonts_details()['primaryFontDetails'])) {
        $inlineCss .= 'body.wp-admin .block-editor-block-list__layout {
            font-family: "' . get_fonts_details()['primaryFontDetails']->font . '", sans-serif;
            font-weight: ' . urlencode(get_fonts_details()['primaryFontDetails']->regularweight) . ';
        }';
    }

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
        $inlineCss .= 'body.wp-admin .block-editor-block-list__layout {
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

    wp_add_inline_style('gutenberg-block-editor-styles', $inlineCss);
}

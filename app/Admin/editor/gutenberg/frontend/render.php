<?php

/**
 * @param $block_content
 * @param $block
 * @return mixed|string
 */
add_filter('render_block', 'growtype_extend_blocks', 10, 2);
function growtype_extend_blocks($block_content, $block)
{
    $max_width_blocks = [
        'core/paragraph',
        'core/heading',
        'core/image',
        'core/group'
    ];

    $custom_attributes_blocks = [
        'core/button'
    ];

    $div_wrapper_blocks = [
        'core/columns'
    ];

    $typography_blocks = [
        'core/paragraph',
        'core/heading',
        'core/list',
        'core/list-item',
        'core/quote',
        'core/button',
        'core/code',
        'core/preformatted'
    ];

    /**
     * Add max-width attribute
     */
    if (in_array($block['blockName'], $max_width_blocks)
        && (isset($block['attrs']['maxWidth']) || isset($block['attrs']['position']))) {
        $inlineCss = '';

        if (isset($block['attrs']['position'])) {
            if ($block['attrs']['position'] === 'left') {
                $inlineCss .= 'margin-right:auto!important;';
                $inlineCss .= 'margin-left:0!important;';
            } elseif ($block['attrs']['position'] === 'right') {
                $inlineCss .= 'margin-left:auto!important;';
                $inlineCss .= 'margin-right:0!important;';
            } elseif ($block['attrs']['position'] === 'auto') {
                $inlineCss .= 'margin-left:auto!important;';
                $inlineCss .= 'margin-right:auto!important;';
            }
        }

        if (isset($block['attrs']['maxWidth'])) {
            $inlineCss .= 'max-width:' . $block['attrs']['maxWidth'] . 'px;';
        }

        $content = '<div class="wp-' . str_replace('core/', 'block-', $block['blockName']) . '-wrapper" style="' . $inlineCss . '">';
        $content .= $block_content;
        $content .= '</div>';

        $block_content = $content;
    }

    /**
     * Add custom attributes
     */
    if (in_array($block['blockName'], $custom_attributes_blocks)) {
        $custom_attributes = $block['attrs']['customAttributes'] ?? '';
        if (!empty($custom_attributes)) {
            $block_content = preg_replace('/(<a\b[^><]*)>/i', '$1 ' . $custom_attributes . '>', $block_content);
        }
    }

    /**
     * Add extra div
     */
    if (in_array($block['blockName'], $div_wrapper_blocks)) {
        $block_content = '<div class="wp-block">' . $block_content . '</div>';
    }

    /**
     * Buttons
     */
    if ('core/buttons' === $block['blockName']) {
        $dom = new DOMDocument('1.0', 'UTF-8');

        // Wrap content in a full HTML structure to avoid issues with DOMDocument
        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>' . $block_content . '</body></html>';

        // Suppress warnings when loading HTML, in case the HTML isn't perfect
        libxml_use_internal_errors(true);
        $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Get all the <a> tags inside the buttons block
        $buttons = $dom->getElementsByTagName('a');
        $button_count = $buttons->length;

        // Add a data-attribute to the wrapper div with the count of buttons
        $divs = $dom->getElementsByTagName('div');
        if ($divs->length > 0) {
            $divs->item(0)->setAttribute('data-button-count', $button_count);
        }

        // Extract back only the body content (without the added <html> and <body> tags)
        $body = $dom->getElementsByTagName('body')->item(0);
        $block_content = '';
        foreach ($body->childNodes as $child) {
            $block_content .= $dom->saveHTML($child);
        }

        // Clean up any generated HTML errors
        libxml_clear_errors();
    }

    /**
     * Typography
     */
    if (in_array($block['blockName'], $typography_blocks)) {
        $font_size = isset($block['attrs']['mobile_font_size']) ? esc_attr($block['attrs']['mobile_font_size']) : '';

        if ($font_size) {
            $dom = new DOMDocument();
            @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $block_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $xpath = new DOMXPath($dom);
            $tags = $xpath->query('//h1 | //h2 | //h3 | //h4 | //h5 | //a | //h6 | //p | //ul | //ol | //li | //blockquote | //button | //code | //pre');

            foreach ($tags as $tag) {
                $unique_class = 'responsive-typography-' . wp_generate_password(8, false);
                $existing_class = $tag->getAttribute('class');
                $new_class = trim($existing_class . ' ' . $unique_class);
                $tag->setAttribute('class', $new_class);
            }

            if ($tags instanceof DOMNodeList && $tags->length > 0) {
                $mobile_css = '@media only screen and (max-width: 768px) {';
                foreach ($tags as $tag) {
                    $mobile_css .= '.' . str_replace(' ', '.', $tag->getAttribute('class')) . ' { font-size: ' . $font_size . '!important; }';
                }
                $mobile_css .= '}';

                $block_content = $dom->saveHTML() . '<style>' . $mobile_css . '</style>';
            }
        }
    }

    return $block_content;
}

function growtype_add_parent_class_to_css_classes($css_string, $parent_class)
{
    $css_string = str_replace('@media only screen', '@mediaonlyscreen', $css_string);
    $lines = explode("\n", $css_string);

    foreach ($lines as &$line) {
        if (strpos($line, "{") !== false) {
            $selector = strstr($line, "{", true);
            $selectors = explode(",", $selector);

            foreach ($selectors as &$sel) {
                if (strpos($sel, '@media') !== false) {
                    continue;
                }

                $sel = "." . $parent_class . ' ' . trim($sel);
            }

            $selector = implode(",", $selectors);

            $line = str_replace(strstr($line, "{", true), $selector, $line);
        }
    }

    $modified_css = implode("\n", $lines);

    $modified_css = str_replace('@mediaonlyscreen', '@media only screen', $modified_css);

    return $modified_css;
}

/**
 * Add inline custom block styles
 */
add_filter('render_block', function ($block_content, $block) {
    $code_blocks = ['core/group'];

    if (
        in_array($block['blockName'], $code_blocks, true) &&
        !empty($block['attrs']['customStyles'])
    ) {
        $block_parent_class = 'growtype-customcss-' . sanitize_html_class(wp_generate_password(12, false));
        $block_css = growtype_add_parent_class_to_css_classes(
            $block['attrs']['customStyles'],
            $block_parent_class
        );

        // Check if first tag is suitable for injection
        if (preg_match('/^<([a-z0-9\-]+)([^>]*)>/i', $block_content, $matches)) {
            $first_tag = $matches[0];
            $new_tag = preg_replace(
                '/^<([a-z0-9\-]+)([^>]*)>/i',
                '<$1 class="' . esc_attr($block_parent_class) . '"$2>',
                $first_tag
            );
            $block_content = str_replace($first_tag, $new_tag, $block_content);
        } else {
            // fallback if content is raw or lacks wrapper
            $block_content = '<div class="' . esc_attr($block_parent_class) . '">' . $block_content . '</div>';
        }

        // Append style tag after block (outside content flow)
        $block_content .= '<style>' . wp_strip_all_tags($block_css) . '</style>';
    }

    return $block_content;
}, 10, 2);

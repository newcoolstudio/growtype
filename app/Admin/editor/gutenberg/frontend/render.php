<?php

/**
 * @param $block_content
 * @param $block
 * @return mixed|string
 */
add_filter('render_block', 'growtype_extend_blocks', 10, 2);
function growtype_extend_blocks($block_content, $block)
{
    $max_width_blocks = ['core/paragraph', 'core/heading', 'core/image', 'core/group'];
    $code_blocks = ['core/group'];
    $custom_attributes_blocks = ['core/button'];
    $div_wrapper_blocks = ['core/columns'];

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
     * Add inline custom block styles
     */
    if (in_array($block['blockName'], $code_blocks) && isset($block['attrs']['customStyles']) && !empty($block['attrs']['customStyles'])) {
        $block_parent_class = 'growtype-customcss-' . wp_generate_password(12, false);
        $block_css = $block['attrs']['customStyles'];
        $block_css = growtype_add_parent_class_to_css_classes($block_css, $block_parent_class);
        $block_content = '<!-- Custom css for block ' . $block_parent_class . ' --><style>' . $block_css . '</style>' . '<div class="' . $block_parent_class . '">' . $block_content . '</div>';
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

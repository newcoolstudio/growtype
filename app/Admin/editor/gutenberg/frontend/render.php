<?php

/**
 * @param $block_content
 * @param $block
 * @return mixed|string
 */
add_filter('render_block', 'growtype_render_block', 10, 2);
function growtype_render_block($block_content, $block)
{
    $max_width_blocks = ['core/paragraph', 'core/heading', 'core/image', 'core/group'];
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
                $inlineCss .= 'margin-right:auto;';
            } elseif ($block['attrs']['position'] === 'right') {
                $inlineCss .= 'margin-left:auto;';
            } elseif ($block['attrs']['position'] === 'auto') {
                $inlineCss .= 'margin-left:auto;';
                $inlineCss .= 'margin-right:auto;';
            }
        }

        if (isset($block['attrs']['maxWidth'])) {
            $inlineCss .= 'max-width:' . $block['attrs']['maxWidth'] . 'px;';
        }

        $content = '<div class="wp-' . str_replace('core/', 'block-', $block['blockName']) . '-wrapper" style="' . $inlineCss . '">';
        $content .= $block_content;
        $content .= '</div>';

        return $content;
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

    return $block_content;
}

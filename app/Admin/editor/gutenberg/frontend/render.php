<?php

/**
 * Frontend render fix
 */
add_filter('render_block', 'wrap_block_extra_div', 10, 2);
function wrap_block_extra_div($block_content, $block)
{
    if ('core/columns' !== $block['blockName']) {
        return $block_content;
    }

    $return = '<div class="wp-block">';
    $return .= $block_content;
    $return .= '</div>';

    return $return;
}

/**
 * @param $block_content
 * @param $block
 * @return mixed|string
 */
add_filter('render_block', 'growtype_render_block_frontent', 10, 2);
function growtype_render_block_frontent($block_content, $block)
{
    if ($block['blockName'] === 'core/paragraph' || $block['blockName'] === 'core/heading') {
        $inlineCss = '';

        if (isset($block['attrs'])) {
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
        }
    }

    if ($block['blockName'] === 'core/paragraph') {
        $content = '<div class="wp-block-paragraph-wrapper" style="' . $inlineCss . '">';
        $content .= $block_content;
        $content .= '</div>';
        return $content;
    } elseif ($block['blockName'] === 'core/heading') {
        $content = '<div class="wp-block-heading-wrapper" style="' . $inlineCss . '">';
        $content .= $block_content;
        $content .= '</div>';

        return $content;
    }

    return $block_content;
}

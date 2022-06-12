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
add_filter('render_block', 'growtype_render_block_frontend', 10, 2);
function growtype_render_block_frontend($block_content, $block)
{
    $blocks_included = ['core/paragraph', 'core/heading', 'core/image', 'core/group'];

    if (in_array($block['blockName'], $blocks_included)
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

    return $block_content;
}

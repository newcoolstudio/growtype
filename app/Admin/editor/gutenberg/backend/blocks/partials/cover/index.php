<?php

/**
 * Teaser element
 */
add_action('init', function () {
    register_block_style('core/media-text', [
        'name' => 'cover-element',
        'label' => __('Cover', 'growtype'),
    ]);
});

/**
 * Mobile image rendering
 */
add_filter('render_block_core/cover', 'growtype_responsive_cover_render', 10, 2);

function growtype_responsive_cover_render($content, $block)
{
    if (isset($block['attrs']['mobileImageURL'])) {
        $image = $block['attrs']['mobileImageURL'];

        preg_match('/<div role="img"/', $content, $is_fixed);

        if ($is_fixed) {
            $content = preg_replace(
                '/(<div role="img".+style=".+)(">)/Ui',
                "$1;--mobileImageURL:url({$image});$2",
                $content
            );
        } else {
            $content = preg_replace(
                '/<img class="wp-block-cover__image.+\/>/Ui',
                "<picture><source srcset='{$image}' media='(max-width:767px)'>$0</picture>",
                $content
            );
        }
    }

    return $content;
}

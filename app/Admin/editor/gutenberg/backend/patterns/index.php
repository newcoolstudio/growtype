<?php

/**
 * Block patterns
 */
add_action('init', 'growtype_wp_block_patterns');
function growtype_wp_block_patterns()
{
    register_block_pattern_category('growtype-patterns', array (
        'label' => __('Growtype', 'text-domain')
    ));

    register_block_pattern(
        'growtype-patterns/block-categories',
        array (
            'title' => __('Categories', 'growtype'),
            'description' => _x('A block to present categories.', 'Block pattern description', 'page-intro-block'),
            'content' => file_get_contents(__DIR__ . '/partials/categories.php'),
            'categories' => array ('growtype-patterns'),
            'keywords' => array ('category'),
        )
    );
}

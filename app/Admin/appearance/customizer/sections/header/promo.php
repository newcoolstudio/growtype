<?php

/**
 * Section
 */
$wp_customize->add_section(
    'header_promo',
    array (
        'title' => __('Promo', 'growtype'),
        'priority' => 10,
        'panel' => 'header',
    )
);

/**
 * Header explanation
 */
$wp_customize->add_setting('header_promo_simple_notice',
    array (
        'default' => '',
        'transport' => 'postMessage',
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'header_promo_simple_notice',
    array (
        'label' => __('Promo Details'),
        'description' => __('Below you can change header promo settings'),
        'section' => 'header_promo'
    )
));

/**
 * Header enabled
 */
$wp_customize->add_setting('header_promo_enabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'header_promo_enabled',
    array (
        'label' => esc_html__('Promo Enabled'),
        'section' => 'header_promo',
        'description' => __('Promo is enabled', 'growtype'),
    )
));

/**
 * Extra content
 */
$wp_customize->add_setting('header_promo_content',
    array (
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'header_promo_content_translation'
    )
);

$wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'header_promo_content',
    array (
        'label' => __('Promo Content'),
        'description' => __('This is for promo details'),
        'section' => 'header_promo',
        'input_attrs' => array (
            'class' => 'qtranxs-translatable',
            'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
            'toolbar2' => 'formatselect',
            'mediaButtons' => true,
        )
    )
));

/**
 * @param $checked
 * Translate text input textarea
 */
function header_promo_content_translation($value)
{
    if (class_exists('QTX_Translator') && function_exists('growtype_format_translation')) {
        $translation = get_theme_mod('header_promo_content');
        return growtype_format_translation($_COOKIE['qtrans_front_language'], $translation, $value, true);
    }

    return $value;
}

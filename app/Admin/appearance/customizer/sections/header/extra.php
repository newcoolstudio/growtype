<?php

/**
 * Section
 */
$wp_customize->add_section(
    'header_extra',
    array (
        'title' => __('Extra', 'growtype'),
        'priority' => 5,
        'panel' => 'header',
    )
);

/**
 * Intro
 */
$wp_customize->add_setting('header_extra_simple_notice',
    array (
        'default' => '',
        'transport' => 'postMessage',
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'header_extra_simple_notice',
    array (
        'label' => __('Extra Details'),
        'description' => __('Below you can change header extra details'),
        'section' => 'header_extra'
    )
));

/**
 * Extra content
 */
$wp_customize->add_setting('header_extra_content',
    array (
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'header_extra_content_translation'
    )
);

$wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'header_extra_content',
    array (
        'label' => __('Extra Content'),
        'description' => __('This is for extra info f.e. logos'),
        'section' => 'header_extra',
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
function header_extra_content_translation($value)
{
    if (class_exists('QTX_Translator') && function_exists('growtype_format_translation')) {
        $translation = get_theme_mod('header_extra_content');
        return growtype_format_translation($_COOKIE['qtrans_front_language'], $translation, $value, true);
    }

    return $value;
}

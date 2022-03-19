<?php
/**
 * Section
 */
$wp_customize->add_section(
    'header_navbar',
    array (
        'title' => __('Navbar', 'growtype'),
        'priority' => 5,
        'panel' => 'header',
    )
);

/**
 * Navbar explanation
 */
$wp_customize->add_setting('header_navbar_simple_notice',
    array (
        'default' => '',
        'transport' => 'postMessage',
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'header_navbar_simple_notice',
    array (
        'label' => __('Navbar Details'),
        'description' => __('Below you can change navbar settings'),
        'section' => 'header_navbar'
    )
));

/**
 * Navbar switch
 */
$wp_customize->add_setting('header_navbar_switch',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'header_navbar_switch',
    array (
        'label' => esc_html__('Navbar Enabled'),
        'section' => 'header_navbar',
        'description' => __('Enable or disable navbar', 'growtype'),
    )
));

/**
 * Navbar text
 */
$wp_customize->add_setting('header_navbar_text',
    array (
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'header_navbar_text_translation'
    )
);

$wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'header_navbar_text',
    array (
        'label' => __('Header - Navbar Message', 'growtype'),
        'description' => __('This is short navbar message', 'growtype'),
        'section' => 'header_navbar',
        'input_attrs' => array (
            'class' => 'qtranxs-translatable',
            'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
            'toolbar2' => 'formatselect',
            'mediaButtons' => false,
        )
    )
));

/**
 * @param $checked
 * Translate text input copyright
 */
function header_navbar_text_translation($value)
{
    if (class_exists('QTX_Translator')) {
        $translation = get_theme_mods()["header_navbar_text"];
        return formatTranslation($translation, $value);
    }

    return $value;
}

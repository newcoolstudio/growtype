<?php

/**
 *
 */

add_action("customize_register", "theme_general_customize_register");
function theme_general_customize_register($wp_customize)
{
    $wp_customize->add_section('theme-general', array (
        "title" => __("General", "growtype"),
//        "description" => __('Change general theme'),
        "priority" => 20,
    ));

    /**
     * Under construction
     */
    $wp_customize->add_setting('theme_general_construction_notice',
        array (
            'default' => '',
            'transport' => 'postMessage'
        )
    );

    $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'theme_general_construction_notice',
        array (
            'label' => __('Construction'),
            'description' => __('Below you can change under construction settings'),
            'section' => 'theme-general'
        )
    ));

    $wp_customize->add_setting('under_construction_switch',
        array (
            'default' => 0,
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'under_construction_switch',
        array (
            'label' => esc_html__('Under Construction'),
            'section' => 'theme-general',
            'description' => __('Page is under construction for non logged users', 'growtype'),
        )
    ));

    /**
     * GDPR
     */
    $wp_customize->add_setting('theme_general_gdpr_notice',
        array (
            'default' => '',
            'transport' => 'postMessage'
        )
    );

    $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'theme_general_gdpr_notice',
        array (
            'label' => __('GDPR'),
            'description' => __('Below you can change GDPR settings'),
            'section' => 'theme-general'
        )
    ));

    /**
     * GDPR switch
     */
    $wp_customize->add_setting('theme_general_gdpr_switch',
        array (
            'default' => 0,
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'theme_general_gdpr_switch',
        array (
            'label' => esc_html__('GDPR Status'),
            'section' => 'theme-general',
            'description' => __('GDPR enabled/disabled', 'growtype'),
        )
    ));

    /**
     * GDPR position
     */
    $wp_customize->add_setting('theme_general_gdpr_position',
        array (
            'default' => 'bottom',
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'theme_general_gdpr_position',
        array (
            'label' => __('GDPR Position', 'skyrocket'),
            'description' => esc_html__('Choose GDPR position', 'growtype'),
            'section' => 'theme-general',
            'input_attrs' => array (
                'placeholder' => __('Please select GDPR position...', 'growtype'),
                'multiselect' => false,
            ),
            'choices' => array (
                'top' => __('Top', 'growtype'),
                'bottom' => __('Bottom', 'growtype'),
            )
        )
    ));

    /**
     * GDPR content
     */
    $wp_customize->add_setting('theme_general_gdpr_content',
        array (
            'default' => '',
            'transport' => 'postMessage',
            'sanitize_callback' => 'gdpr_content_text_translation'
        )
    );

    $wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'theme_general_gdpr_content',
        array (
            'label' => __('GDPR Content'),
            'description' => __('This is GDPR content'),
            'section' => 'theme-general',
            'input_attrs' => array (
                'class' => 'qtranxs-translatable',
                'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
                'toolbar2' => 'formatselect',
                'mediaButtons' => true,
            )
        )
    ));
}


/**
 * @param $checked
 * Translate text
 */
function gdpr_content_text_translation($value)
{
    if (function_exists('qtrans_getLanguage')) {
        $translation = get_theme_mods()["theme_general_gdpr_content"];
        return formatTranslation($translation, $value);
    }

    return $value;
}
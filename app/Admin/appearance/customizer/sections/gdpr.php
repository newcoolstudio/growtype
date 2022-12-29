<?php

/**
 *
 */

add_action("customize_register", "growtype_gdpr_customize_register");
function growtype_gdpr_customize_register($wp_customize)
{
    $wp_customize->add_section('growtype-gdpr', array (
        "title" => __("GDPR", "growtype"),
        "priority" => 20,
    ));

    /**
     * GDPR switch
     */
    $wp_customize->add_setting('growtype_gdpr_alert_enabled',
        array (
            'default' => 0,
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'growtype_gdpr_alert_enabled',
        array (
            'label' => esc_html__('Alert Enabled'),
            'section' => 'growtype-gdpr',
            'description' => __('GDPR alert enabled/disabled', 'growtype'),
        )
    ));

    /**
     * GDPR style
     */
    $wp_customize->add_setting('growtype_gdpr_alert_style',
        array (
            'default' => 'horizontal',
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'growtype_gdpr_alert_style',
        array (
            'label' => __('Alert Style', 'growtype'),
            'description' => esc_html__('Choose GDPR alert style', 'growtype'),
            'section' => 'growtype-gdpr',
            'input_attrs' => array (
                'placeholder' => __('Please select style...', 'growtype'),
                'multiselect' => false,
            ),
            'choices' => array (
                'horizontal' => __('Horizontal', 'growtype'),
                'vertical' => __('Vertical', 'growtype'),
            )
        )
    ));

    /**
     * GDPR position
     */
    $wp_customize->add_setting('growtype_gdpr_alert_position',
        array (
            'default' => 'bottom',
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'growtype_gdpr_alert_position',
        array (
            'label' => __('Alert Position', 'growtype'),
            'description' => esc_html__('Choose GDPR alert position', 'growtype'),
            'section' => 'growtype-gdpr',
            'input_attrs' => array (
                'placeholder' => __('Please select position...', 'growtype'),
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
    $wp_customize->add_setting('growtype_gdpr_alert_content',
        array (
            'default' => '',
            'transport' => 'postMessage',
            'sanitize_callback' => 'growtype_gdpr_alert_content_translation'
        )
    );

    $wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'growtype_gdpr_alert_content',
        array (
            'label' => __('GDPR Alert Content'),
            'description' => __('Enter GDPR alert content here', 'growtype'),
            'section' => 'growtype-gdpr',
            'input_attrs' => array (
                'class' => 'qtranxs-translatable',
//                'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
//                'toolbar2' => 'formatselect',
                'mediaButtons' => true,
            )
        )
    ));

    /**
     * GDPR agree button
     */
    $wp_customize->add_setting('growtype_gdpr_alert_agree_btn_enabled',
        array (
            'default' => 0,
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'growtype_gdpr_alert_agree_btn_enabled',
        array (
            'label' => esc_html__('Agree Button Enabled'),
            'section' => 'growtype-gdpr',
            'description' => __('GDPR agree button enabled', 'growtype'),
        )
    ));

    /**
     * GDPR agree button text
     */
    $wp_customize->add_setting("growtype_gdpr_alert_agree_btn_text", array (
        "default" => "",
        'sanitize_callback' => 'growtype_gdpr_alert_agree_btn_text_translation'
    ));

    $wp_customize->add_control('growtype_gdpr_alert_agree_btn_text', array (
        'label' => __('Agree Button Text', 'growtype'),
        'section' => 'growtype-gdpr',
        'type' => 'text',
    ));
}

/**
 * @param $checked
 * Translate text
 */
function growtype_gdpr_alert_content_translation($value)
{
    if (class_exists('QTX_Translator')) {
        $translation = get_theme_mods()["growtype_gdpr_alert_content"] ?? '';
        return growtype_format_translation($_COOKIE['qtrans_front_language'], $translation, $value);
    }

    return $value;
}

/**
 * @param $checked
 * Translate text
 */
function growtype_gdpr_alert_agree_btn_text_translation($value)
{
    if (class_exists('QTX_Translator')) {
        $translation = get_theme_mods()["growtype_gdpr_alert_agree_btn_text"] ?? '';
        return growtype_format_translation($_COOKIE['qtrans_front_language'], $translation, $value);
    }

    return $value;
}

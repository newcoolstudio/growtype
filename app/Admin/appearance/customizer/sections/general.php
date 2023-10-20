<?php

class General_Customizer_Register
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        add_action('customize_register', array ($this, 'customizer_init'));
    }

    function customizer_init($wp_customize)
    {
        $wp_customize->add_section('theme-general', array (
            "title" => __("General", "growtype"),
            "description" => __('Change general settings'),
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

        $wp_customize->add_setting('growtype_is_under_construction',
            array (
                'default' => 0,
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'growtype_is_under_construction',
            array (
                'label' => esc_html__('Under Construction'),
                'section' => 'theme-general',
                'description' => __('Page is under construction for non logged users', 'growtype'),
            )
        ));

        /**
         * Under construction text
         */
        $wp_customize->add_setting('growtype_is_under_construction_content',
            array (
                'default' => '',
                'transport' => 'postMessage',
                'sanitize_callback' => array ($this, 'growtype_is_under_construction_content_translation')
            )
        );

        $wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'growtype_is_under_construction_content',
            array (
                'label' => __('Under Construction Content'),
                'description' => __('Enter under construction text here', 'growtype'),
                'section' => 'theme-general',
                'input_attrs' => array (
                    'class' => 'qtranxs-translatable',
                    'toolbar1' => 'formatselect bold italic bullist numlist alignleft aligncenter alignright link',
                    'mediaButtons' => true,
                )
            )
        ));
    }

    /**
     * @param $checked
     * Translate text
     */
    function growtype_is_under_construction_content_translation($value)
    {
        if (class_exists('QTX_Translator') && function_exists('growtype_format_translation')) {
            $translation = get_theme_mods()["growtype_is_under_construction_content"] ?? '';
            return growtype_format_translation($_COOKIE['qtrans_front_language'], $translation, $value);
        }

        return $value;
    }
}

new General_Customizer_Register();

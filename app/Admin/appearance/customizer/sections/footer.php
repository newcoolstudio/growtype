<?php

class Footer_Customizer_Register extends Growtype_Customizer
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        add_action('customize_register', array ($this, 'customizer_init'));
        add_action('customize_controls_print_styles', array ($this, 'growtype_customizer_header_styles'), 999);

        add_action('wp_ajax_update-logo-customizer', array ($this, 'update_logo'));
        add_action('wp_ajax_nopriv_update-logo-customizer', array ($this, 'update_logo'));
    }

    function customizer_init($wp_customize)
    {
        $color_scheme = growtype_get_theme_current_colors_scheme();

        /**
         * Footer explanation
         */

        $wp_customize->add_setting('footer_simple_notice',
            array (
                'default' => '',
                'transport' => 'postMessage',
            )
        );

        $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'footer_simple_notice',
            array (
                'label' => __('Footer Details'),
                'description' => __('Below you can change footer settings'),
                'section' => 'footer'
            )
        ));

        /**
         * Footer
         */

        $wp_customize->add_section('footer', array (
            "title" => __("Footer", "growtype"),
            "priority" => 60,
        ));

        /**
         * Footer disabled
         */
        $wp_customize->add_setting('footer_is_enabled',
            array (
                'default' => 1,
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'footer_is_enabled',
            array (
                'label' => esc_html__('Enabled'),
                'section' => 'footer',
                'description' => __('Enable/disable footer.', 'growtype'),
            )
        ));

        /**
         * Footer type selector
         */
        $wp_customize->add_setting('footer_type_select',
            array (
                'default' => 'type-1',
                'transport' => 'refresh',
            )
        );
        $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'footer_type_select',
            array (
                'label' => __('Footer Style', 'growtype'),
                'description' => esc_html__('Choose footer style', 'growtype'),
                'section' => 'footer',
                'input_attrs' => array (
                    'placeholder' => __('Please select a footer...', 'growtype'),
                    'multiselect' => false,
                ),
                'choices' => array (
                    'type-1' => __('Style - Vertical', 'growtype'),
                    'type-2' => __('Style - Horizontal', 'growtype'),
                    'type-3' => __('Style - Vertical reverse', 'growtype'),
                )
            )
        ));

        /**
         * Footer logo
         */

        $wp_customize->add_setting("footer_logo", array (
            "type" => "theme_mod", // or 'option'
            "capability" => "edit_theme_options",
            "default" => "",
            "transport" => "postMessage",
            'sanitize_callback' => '',
            'sanitize_js_callback' => '' // Basically to_json.
        ));

        $wp_customize->add_control(new WP_Customize_Media_Control(
            $wp_customize, 'footer_logo',
            array ( // setting id
                'label' => __('Logo', 'growtype'),
                'section' => 'footer',
//            'priority' => 1,
            )
        ));

        /**
         * Footer textarea
         */

        $wp_customize->add_setting('footer_extra_content',
            array (
                'default' => '',
                'transport' => 'postMessage',
                'sanitize_callback' => array ($this, 'footer_extra_content_translation'),
            )
        );

        $wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'footer_extra_content',
            array (
                'label' => __('Extra Content'),
                'description' => __('This is for extra info f.e. contacts'),
                'section' => 'footer',
//            'priority' => 10,
                'input_attrs' => array (
                    'class' => 'qtranxs-translatable',
                    'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
                    'toolbar2' => 'formatselect',
                    'mediaButtons' => true,
                )
            )
        ));

        /**
         * Footer COLORS
         */

        $wp_customize->add_setting('theme_general_footer_simple_notice',
            array (
                'default' => '',
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'theme_general_footer_simple_notice',
            array (
                'label' => __('Colors'),
                'description' => __('Below you can adjust colors'),
                'section' => 'footer'
            )
        ));

        /**
         * Footer bg color
         */

        $wp_customize->add_setting('footer_background_color', array (
            'default' => $color_scheme['footer_background_color'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_background_color', array (
            'label' => __('Footer Background', 'growtype'),
            'section' => 'footer',
        )));

        /**
         * Footer text color
         */

        $wp_customize->add_setting('footer_text_color', array (
            'default' => $color_scheme['footer_text_color'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_text_color', array (
            'label' => __('Footer Text', 'growtype'),
            'section' => 'footer',
        )));

        /**
         * COPYRIGHT
         */
        $wp_customize->add_setting('footer_copyright_notice',
            array (
                'default' => '',
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'footer_copyright_notice',
            array (
                'label' => __('Copyright'),
                'description' => __('Below you can change copyright details'),
                'section' => 'footer'
            )
        ));

        /**
         * Footer copyright disabled
         */
        $wp_customize->add_setting('footer_copyright_enabled',
            array (
                'default' => 1,
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'footer_copyright_enabled',
            array (
                'label' => esc_html__('Copyright'),
                'section' => 'footer',
                'description' => __('Disable copyright section.', 'growtype'),
            )
        ));

        /**
         * Footer copyright
         */
        $wp_customize->add_setting('footer_copyright',
            array (
                'default' => '',
                'transport' => 'postMessage',
                'sanitize_callback' => array ($this, 'footer_copyright_translation')
            )
        );

        $wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'footer_copyright',
            array (
                'label' => __('Copyright Section'),
                'description' => __('Copyright details etc.'),
                'section' => 'footer',
                'input_attrs' => array (
                    'class' => 'qtranxs-translatable',
                    'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
                    'toolbar2' => 'formatselect',
                    'mediaButtons' => false,
                )
            )
        ));

        /**
         * CREATED BY
         */
        $wp_customize->add_setting('theme_general_credits_notice',
            array (
                'default' => '',
                'transport' => 'postMessage'
            )
        );

        $wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'theme_general_credits_notice',
            array (
                'label' => __('Credits'),
                'description' => __('Below you can change credits details'),
                'section' => 'footer'
            )
        ));

        /**
         * Created by switch
         */
        $wp_customize->add_setting('theme_general_credits_enabled',
            array (
                'default' => 1,
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'theme_general_credits_enabled',
            array (
                'label' => esc_html__('Enabled'),
                'section' => 'footer',
                'description' => __('Created by enabled/disabled', 'growtype'),
            )
        ));

        /**
         * Created by content
         */
        $wp_customize->add_setting('theme_general_credits_content',
            array (
                'default' => '',
                'transport' => 'postMessage',
                'sanitize_callback' => array ($this, 'theme_general_credits_content_translation')
            )
        );

        $wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'theme_general_credits_content',
            array (
                'label' => __('Content'),
                'description' => __(''),
                'section' => 'footer',
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
     * Translate text input copyright
     */
    function footer_copyright_translation($value)
    {
        if (class_exists('QTX_Translator') && function_exists('growtype_format_translation')) {
            $translation = get_theme_mods()["footer_copyright"];
            return growtype_format_translation($_COOKIE['qtrans_front_language'], $translation, $value);
        }

        return $value;
    }

    /**
     * @param $checked
     * Translate text
     */
    function theme_general_credits_content_translation($value)
    {
        if (class_exists('QTX_Translator') && function_exists('growtype_format_translation')) {
            $translation = get_theme_mods()["theme_general_credits_content"];
            return growtype_format_translation($_COOKIE['qtrans_front_language'], $translation, $value);
        }

        return $value;
    }

    /**
     * @param $checked
     * Translate text input textarea
     */
    function footer_extra_content_translation($value)
    {
        if (class_exists('QTX_Translator') && function_exists('growtype_format_translation')) {
            $translation = get_theme_mod('footer_extra_content');
            return growtype_format_translation($_COOKIE['qtrans_front_language'], $translation, $value, true);
        }

        return $value;
    }

    /**
     * This function adds some styles to the WordPress Customizer
     */
    function growtype_customizer_header_styles()
    { ?>
        <style>
            .thumbnail-image {
                max-width: 150px;
            }
        </style>
        <?php
    }

    function update_logo()
    {
        $att_id = $_POST['attachment_id'];
        if ($att_id != '') {
            $img_src = '<img style="max-width: 100%" src="' . wp_get_attachment_url($att_id) . '" alt="footer_image">';
            echo $img_src;
        }
        exit;
    }
}

new Footer_Customizer_Register();

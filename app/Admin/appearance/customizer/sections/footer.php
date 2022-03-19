<?php

add_action("customize_register", "footer_customize_register");
function footer_customize_register($wp_customize)
{
    $color_scheme = get_theme_color_scheme();

    /**
     * Footr explanation
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
     * Footer enabled
     */
    $wp_customize->add_setting('footer_is_disabled',
        array (
            'default' => 0,
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'footer_is_disabled',
        array (
            'label' => esc_html__('Footer Disabled'),
            'section' => 'footer',
            'description' => __('Footer is disabled', 'growtype'),
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
                'type-1' => __('Style 1', 'growtype'),
                'type-2' => __('Style 2', 'growtype'),
                'type-3' => __('Style 3', 'growtype'),
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

    $wp_customize->add_setting('footer_textarea',
        array (
            'default' => '',
            'transport' => 'postMessage',
            'sanitize_callback' => 'footer_textarea_translation'
        )
    );

    $wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'footer_textarea',
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
     * @param $checked
     * Translate text input textarea
     */
    function footer_textarea_translation($value)
    {
        if (class_exists('QTX_Translator')) {
            $translation = get_theme_mod('footer_textarea');
            return formatTranslation($translation, $value, true);
        }

        return $value;
    }

    /**
     * Footer copyright
     */
    $wp_customize->add_setting('footer_copyright',
        array (
            'default' => '© 2020 Company Name. Trademarks and brands are the property of their respective owners.',
            'transport' => 'postMessage',
            'sanitize_callback' => 'footer_copyright_translation'
        )
    );

    $wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'footer_copyright',
        array (
            'label' => __('Copyright Text'),
            'description' => __('This is for copyright details'),
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
     * @param $checked
     * Translate text input copyright
     */
    function footer_copyright_translation($value)
    {
        if (class_exists('QTX_Translator')) {
            $translation = get_theme_mods()["footer_copyright"];
            return formatTranslation($translation, $value);
        }

        return $value;
    }

    /**
     * Footer general Explanation
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
}

/**
 * Update logo on upload
 */
add_action('wp_ajax_update-logo-customizer', 'update_footer_logo');
add_action('wp_ajax_nopriv_update-logo-customizer', 'update_footer_logo');
function update_footer_logo()
{
    $att_id = $_POST['attachment_id'];
    if ($att_id != '') {
        $img_src = '<img style="max-width: 100%" src="' . wp_get_attachment_url($att_id) . '" alt="footer_image">';
        echo $img_src;
    }
    exit;

}

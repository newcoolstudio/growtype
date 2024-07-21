<?php

add_action("customize_register", "buttons_customize_register");
function buttons_customize_register($wp_customize)
{
    $wp_customize->add_section('buttons', array (
        "title" => __("Buttons", "growtype"),
        "priority" => 100,
    ));

    /**
     * Button text transform
     */
    $wp_customize->add_setting('button_text_transform',
        array (
            'default' => 'uppercase',
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'button_text_transform',
        array (
            'label' => __('Button "Text Transform"', 'growtype'),
            'description' => esc_html__('Choose button text transform', 'growtype'),
            'section' => 'buttons',
            'input_attrs' => array (
                'multiselect' => false,
            ),
            'choices' => array (
                'initial' => __('Initial', 'growtype'),
                'uppercase' => __('Uppercase', 'growtype')
            )
        )
    ));

    /**
     * Border radius
     */
    $wp_customize->add_setting("button_border_radius", array (
        "default" => "5px",
    ));

    $wp_customize->add_control('button_border_radius', array (
        'label' => esc_html__('Button "Border Radius"'),
        'section' => 'buttons',
        'description' => __('Choose button border radius', 'growtype'),
    ));

    /**
     * Button style 1
     */
    $wp_customize->add_setting('primary_button_style_select',
        array (
            'default' => 'button_style_1',
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'primary_button_style_select',
        array (
            'label' => __('"Primary" Button Style', 'growtype'),
            'description' => esc_html__('Choose primary button style', 'growtype'),
            'section' => 'buttons',
            'input_attrs' => array (
                'multiselect' => false,
            ),
            'choices' => array (
                'button_style_1' => __('Style 1', 'growtype'),
                'button_style_2' => __('Style 2', 'growtype')
            )
        )
    ));

    /**
     * Primary btn color
     */

    $wp_customize->add_setting('primary_button_background_color', array (
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_button_background_color', array (
        'label' => __('"Primary" button background color', 'growtype'),
        'section' => 'buttons',
        'alpha' => true,
    )));

    $wp_customize->add_setting('primary_button_text_color', array (
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_button_text_color', array (
        'label' => __('"Primary" button text color', 'growtype'),
        'section' => 'buttons',
        'alpha' => true,
    )));

    /**
     * Active color
     */
    $wp_customize->add_setting('primary_button_text_color_active', array (
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_button_text_color_active', array (
        'label' => __('"Primary" button text color active', 'growtype'),
        'section' => 'buttons',
        'alpha' => true,
    )));

    /**
     * Border
     */
    $wp_customize->add_setting('primary_button_border_color', array (
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_button_border_color', array (
        'label' => __('Primary button border color', 'growtype'),
        'section' => 'buttons',
        'alpha' => true,
    )));

    /**
     * Button style 2
     */
    $wp_customize->add_setting('secondary_button_style_select',
        array (
            'default' => 'button_style_1',
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'secondary_button_style_select',
        array (
            'label' => __('"Secondary" Button Style', 'growtype'),
            'description' => esc_html__('Choose secondary button style', 'growtype'),
            'section' => 'buttons',
            'input_attrs' => array (
                'multiselect' => false,
            ),
            'choices' => array (
                'button_style_1' => __('Style 1', 'growtype'),
                'button_style_2' => __('Style 2', 'growtype')
            )
        )
    ));

    /**
     * Secondary btn color
     */

    $wp_customize->add_setting('secondary_button_background_color', array (
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_button_background_color', array (
        'label' => __('"Secondary" button background color', 'growtype'),
        'section' => 'buttons',
        'alpha' => true,
    )));

    /**
     * Text
     */
    $wp_customize->add_setting('secondary_button_text_color', array (
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_button_text_color', array (
        'label' => __('Secondary button text color', 'growtype'),
        'section' => 'buttons',
        'alpha' => true,
    )));

    /**
     * Text
     */
    $wp_customize->add_setting('secondary_button_text_color_active', array (
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_button_text_color_active', array (
        'label' => __('Secondary button text color active', 'growtype'),
        'section' => 'buttons',
        'alpha' => true,
    )));

    /**
     * Border
     */
    $wp_customize->add_setting('secondary_button_border_color', array (
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_button_border_color', array (
        'label' => __('Secondary button border color', 'growtype'),
        'section' => 'buttons',
        'alpha' => true,
    )));

    /**
     * Add to cart style
     */
    $wp_customize->add_setting('addtocart_button_style_select',
        array (
            'default' => 'button_style_1',
            'transport' => 'refresh',
        )
    );
    $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'addtocart_button_style_select',
        array (
            'label' => __('"Add to cart" Button Style', 'growtype'),
            'description' => esc_html__('Choose "Add to cart" button style', 'growtype'),
            'section' => 'buttons',
            'input_attrs' => array (
                'multiselect' => false,
            ),
            'choices' => array (
                'button_style_1' => __('Style 1', 'growtype'),
                'button_style_2' => __('Style 2', 'growtype')
            )
        )
    ));

    /**
     * Add to cart btn color
     */
    $wp_customize->add_setting('add_to_cart_button_background_color', array (
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'add_to_cart_button_background_color', array (
        'label' => __('"Add to cart" button background color', 'growtype'),
        'section' => 'buttons',
        'alpha' => true,
    )));

    $wp_customize->add_setting('add_to_cart_button_text_color', array (
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'add_to_cart_button_text_color', array (
        'label' => __('"Add to cart" button text color', 'growtype'),
        'section' => 'buttons',
        'alpha' => true,
    )));

    /**
     * Checkout btn style
     */
    $wp_customize->add_setting('checkout_button_style_select',
        array (
            'default' => 'button_style_1',
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'checkout_button_style_select',
        array (
            'label' => __('"Checkout" Button Style', 'growtype'),
            'description' => esc_html__('Choose checkout button style', 'growtype'),
            'section' => 'buttons',
            'input_attrs' => array (
                'multiselect' => false,
            ),
            'choices' => array (
                'button_style_1' => __('Style 1', 'growtype'),
                'button_style_2' => __('Style 2', 'growtype')
            )
        )
    ));

    $wp_customize->add_setting('checkout_button_background_color', array (
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'checkout_button_background_color', array (
        'label' => __('"Checkout" button background color', 'growtype'),
        'section' => 'buttons',
        'alpha' => true,
    )));

    $wp_customize->add_setting('checkout_button_text_color', array (
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'checkout_button_text_color', array (
        'label' => __('"Checkout" button text color', 'growtype'),
        'section' => 'buttons',
        'alpha' => true,
    )));
}

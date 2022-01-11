<?php

$wp_customize->add_section(
    'woocommerce_product_page',
    array (
        'title' => __('Single Product Page', 'growtype'),
        'priority' => 5,
        'panel' => 'woocommerce',
    )
);

/**
 * Breadcrumb
 */
$wp_customize->add_setting('woocommerce_product_page_breadcrumb_details',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'woocommerce_product_page_breadcrumb_details',
    array (
        'label' => __('Breadcrumb'),
        'description' => __('Below you can change breadcrumb settings'),
        'section' => 'woocommerce_product_page'
    )
));

/**
 * Breadcrumb status
 */
$wp_customize->add_setting('woocommerce_product_page_breadcrumb_status',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_product_page_breadcrumb_status',
    array (
        'label' => esc_html__('Status'),
        'section' => 'woocommerce_product_page',
        'description' => __('Enabled/disabled', 'growtype'),
    )
));

/**
 * Main IMG
 */
$wp_customize->add_setting('single_page_gallery_main_img',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'single_page_gallery_main_img',
    array (
        'label' => __('Main IMG'),
        'description' => __('Below you can change main IMG settings'),
        'section' => 'woocommerce_product_page'
    )
));

/**
 * Width
 */
$wp_customize->add_setting("single_page_gallery_main_img_width", array (
    "default" => "700",
    'type' => 'option',
    'capability' => 'manage_woocommerce',
));

$wp_customize->add_control('single_page_gallery_main_img_width', array (
    'label' => __('Main IMG Width', 'growtype'),
    'description' => __('In pixels', 'growtype'),
    'section' => 'woocommerce_product_page',
    'type' => 'number',
));

/**
 * Height
 */
$wp_customize->add_setting("single_page_gallery_main_img_height", array (
    "default" => "600",
    'type' => 'option',
    'capability' => 'manage_woocommerce',
));

$wp_customize->add_control('single_page_gallery_main_img_height', array (
    'label' => __('Main IMG Height', 'growtype'),
    'description' => __('In pixels', 'growtype'),
    'section' => 'woocommerce_product_page',
    'type' => 'number',
));

/**
 * Cropped
 */
$wp_customize->add_setting('single_page_gallery_main_img_cropped',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'single_page_gallery_main_img_cropped',
    array (
        'label' => esc_html__('Main IMG Cropped'),
        'section' => 'woocommerce_product_page',
        'description' => __('Main IMG is cropped', 'growtype'),
    )
));

/**
 * Gallery
 */
$wp_customize->add_setting('single_page_gallery_details',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'single_page_gallery_details',
    array (
        'label' => __('Gallery'),
        'description' => __('Below you can change gallery settings'),
        'section' => 'woocommerce_product_page'
    )
));

/**
 * Shop gallery type
 */
$wp_customize->add_setting('woocommerce_product_page_gallery_type',
    array (
        'default' => 'woocommerce-product-gallery-type-1',
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'woocommerce_product_page_gallery_type',
    array (
        'label' => __('Product Gallery Type', 'growtype'),
        'description' => esc_html__('Choose product gallery type', 'growtype'),
        'section' => 'woocommerce_product_page',
        'input_attrs' => array (
            'multiselect' => false,
        ),
        'choices' => array (
            'woocommerce-product-gallery-type-1' => __('Type 1', 'growtype'),
            'woocommerce-product-gallery-type-2' => __('Type 2', 'growtype')
        )
    )
));

/**
 * Adaptive gallery thumbnails height
 */
$wp_customize->add_setting('woocommerce_product_page_gallery_thumbnails_adaptive_height',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_product_page_gallery_thumbnails_adaptive_height',
    array (
        'label' => esc_html__('Adaptive thumbnails height'),
        'section' => 'woocommerce_product_page',
        'description' => __('Adaptive gallery thumbnails height', 'growtype'),
    )
));

/**
 * Zoom icon
 */
$wp_customize->add_setting('woocommerce_product_page_gallery_trigger_icon',
    array (
        'default' => 1,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_product_page_gallery_trigger_icon',
    array (
        'label' => esc_html__('Image zoom icon'),
        'section' => 'woocommerce_product_page',
        'description' => __('Icon which zooms image', 'growtype'),
    )
));

/**
 * Content
 */
$wp_customize->add_setting('woocommerce_product_page_main_information_details',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'woocommerce_product_page_main_information_details',
    array (
        'label' => __('Main Information'),
        'description' => __('Below you can change main information settings'),
        'section' => 'woocommerce_product_page'
    )
));

/**
 * Payment details
 */
$wp_customize->add_setting('woocommerce_product_page_payment_details',
    array (
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'woocommerce_product_page_payment_details_translation'
    )
);

$wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'woocommerce_product_page_payment_details',
    array (
        'label' => __('Payment Details'),
        'description' => __('Extra payments information'),
        'section' => 'woocommerce_product_page',
        'input_attrs' => array (
            'class' => 'qtranxs-translatable',
            'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
            'toolbar2' => 'formatselect',
            'mediaButtons' => true,
        )
    )
));

/**
 * Summary position
 */
$wp_customize->add_setting('woocommerce_product_page_excerpt_position',
    array (
        'default' => 'position-1',
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control($wp_customize, 'woocommerce_product_page_excerpt_position',
    array (
        'label' => __('Excerpt Position', 'growtype'),
        'description' => esc_html__('Choose product summary/excerpt position', 'growtype'),
        'section' => 'woocommerce_product_page',
        'input_attrs' => array (
            'multiselect' => false,
        ),
        'choices' => array (
            'position-1' => __('Above "Add to cart"', 'growtype'),
            'position-2' => __('Below "Add to cart"', 'growtype')
        )
    )
));

/**
 *
 */
$wp_customize->add_setting('woocommerce_product_page_description_section_title',
    array (
        'default' => 1,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_product_page_description_section_title',
    array (
        'label' => esc_html__('Long Description Title'),
        'section' => 'woocommerce_product_page',
        'description' => __('Enable/disable section title.', 'growtype'),
    )
));

/**
 * Meta data
 */
$wp_customize->add_setting('woocommerce_product_page_meta_data_disabled',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_product_page_meta_data_disabled',
    array (
        'label' => esc_html__('Meta data disabled'),
        'section' => 'woocommerce_product_page',
        'description' => __('Enable/disable meta data.', 'growtype'),
    )
));


/**
 * Related products
 */
$wp_customize->add_setting('woocommerce_product_page_related_products_details',
    array (
        'default' => '',
        'transport' => 'postMessage'
    )
);

$wp_customize->add_control(new Skyrocket_Simple_Notice_Custom_control($wp_customize, 'woocommerce_product_page_related_products_details',
    array (
        'label' => __('Related products'),
        'description' => __('Below you can change related products settings'),
        'section' => 'woocommerce_product_page'
    )
));

/**
 * Breadcrumb status
 */
$wp_customize->add_setting('woocommerce_product_page_related_products_status',
    array (
        'default' => 0,
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'woocommerce_product_page_related_products_status',
    array (
        'label' => esc_html__('Disabled'),
        'section' => 'woocommerce_product_page',
        'description' => __('Is disabled', 'growtype'),
    )
));
